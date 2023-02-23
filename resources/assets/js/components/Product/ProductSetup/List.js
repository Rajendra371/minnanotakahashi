import React, { Component } from "react";
import { Link, Route } from "react-router-dom";

export default class List extends Component {
  constructor() {
    load_datepicker();
    setTimeout(function() {
      load_table_data();
    }, 1000);
    super();
    this.state = {
      seo: [],
      parentcat: [],
      // deplist:[],
      data: [],
      loading: false,
      pages: 0,
    };
  }
  componentDidMount() {
    axios
      .get(constvar.api_url + "product_setup/get_parentcat")
      .then((response) => {
        if (response.data.status == "success") {
          this.setState({ parentcat: response.data.data });
        } else {
          this.setState({ parentcat: "" });
        }
      });
  }

  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <Row>
            <Col>
              <Card>
                <CardHeader>
                  <CardTitle>Product List</CardTitle>
                  <button className="btnRefresh" id="btnRefresh">
                    <i className="fa fa-refresh" aria-hidden="true" />
                  </button>

                  {/* <Button color="danger" onClick={this.toggle}>Model</Button> */}
                </CardHeader>
                <div className="search_box" style={{ border: "none" }}>
                  <Form className="form">
                    <div className="row">
                      <Col md="3" sm="6" xs="6">
                        <Label>Category</Label>

                        <div
                          dangerouslySetInnerHTML={{
                            __html: this.state.parentcat,
                          }}
                        />
                      </Col>

                      <Col md="3" sm="6" xs="6">
                        <div class="">
                          <label>Search</label>
                          <input
                            type="text"
                            id="search_txt"
                            name="search_txt"
                            placeholder="Search..."
                            className="form-control"
                          />
                        </div>
                      </Col>
                      <Col md="3" sm="6" xs="6" className="align-self-end">
                        <div>
                          <a
                            href="javascript:void(0)"
                            className="btn btn-info main-btn "
                            id="searchByDate"
                          >
                            <i className="fa fa-search" aria-hidden="true" />
                            &nbsp;&nbsp; Search
                          </a>
                        </div>
                      </Col>
                    </div>
                  </Form>
                </div>
                <div className="row">
                  <div className="col-md-12 mt-2">
                    <div className="white-box pad-5 noborder d-flex justify-content-end">
                      <span
                        className="btn btn-sm btn-warning"
                        style={{ color: "#fff" }}
                      >
                        Ordered
                      </span>

                      <span className="btn btn-sm btn-success">Confirmed </span>

                      <span className="btn btn-sm btn-primary">Delivered </span>
                    </div>
                  </div>
                </div>
                <table id="myTable" className="table table-striped">
                  <thead>
                    <tr>
                      <th width="5%">S.No.</th>
                      <th width="10%">Category</th>
                      <th width="10%">Product ID</th>
                      <th width="10%">Product Code</th>
                      <th width="15%">Product Title</th>
                      <th width="10%">Image</th>
                      <th width="15%">Product Description</th>
                      <th width="10%">Price</th>
                      <th width="5%">Discount(%)</th>
                      <th width="10%">Price After Discount</th>
                      <th width="10%">Order</th>
                      <th width="10%">Views</th>
                      <th width="5%">Stock</th>
                      <th width="10%">Publish</th>
                      <th width="5%">Action</th>
                    </tr>
                  </thead>
                  <tbody />
                </table>
              </Card>
            </Col>
          </Row>
        </div>
      </div>
    );
  }
}

function load_table_data() {
  var filter_date = $("#filter_date").val();
  var frmDate = $("#frmDate").val();
  var toDate = $("#toDate").val();
  var search_txt = $("#search_txt").val();
  var category = $("#category").val();
  // alert('category');

  var dataurl = constvar.api_url + "product_setup/productsetup_list";
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";
  var dtablelist = $("#myTable")
    .dataTable({
      sPaginationType: "full_numbers",
      bSearchable: false,
      lengthMenu: [
        [15, 30, 45, 60, 100, 200, 500, -1],
        [15, 30, 45, 60, 100, 200, 500, "All"],
      ],

      iDisplayLength: 10,
      sDom: "ltipr",
      bAutoWidth: false,
      autoWidth: true,
      aaSorting: [[0, "desc"]],
      bProcessing: true,
      bServerSide: true,
      sAjaxSource: dataurl,

      fnServerData: function(sSource, aoData, fnCallback) {
        $.ajax({
          dataType: "json",
          type: "GET",
          headers: {
            Authorization: "Bearer" + localStorage.getItem("backend-jwt-token"),
          },
          url: sSource,
          data: aoData,
          success: fnCallback,
        });
      },
      oLanguage: {
        sEmptyTable: message,
      },
      aoColumnDefs: [
        {
          bSortable: false,
          aTargets: [0],
        },
      ],

      aoColumns: [
        { data: null },
        { data: "parentid" },
        { data: "product_id" },
        { data: "product_code" },
        { data: "product_title" },
        { data: "image" },
        { data: "product_description" },
        { data: "price" },
        { data: "discount_pc" },
        { data: "discount_amount" },
        { data: "order" },
        { data: "views" },
        { data: "stock" },
        { data: "is_publish" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        aoData.push({ name: "filter_date", value: filter_date });
        aoData.push({ name: "frmDate", value: frmDate });
        aoData.push({ name: "toDate", value: toDate });
        aoData.push({ name: "search_txt", value: search_txt });
        aoData.push({ name: "category", value: category });
      },

      fnRowCallback: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
        return nRow;
      },

      fnCreatedRow: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        var tblid = oSettings._iDisplayStart + iDisplayIndex + 1;
        $(nRow).attr("id", "listid_" + tblid);
      },
    })

    .columnFilter({
      sPlaceHolder: "head:after",
      aoColumns: [
        { type: null },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: null },
        { type: "text" },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
      ],
    });
  $(document).off("click", "#searchByDate");
  $(document).on("click", "#searchByDate", function() {
    filter_date = $("#filter_date").val();
    frmDate = $("#frmDate").val();
    toDate = $("#toDate").val();
    search_txt = $("#search_txt").val();
    category = $("#category").val();

    dtablelist.fnDraw();
  });
}
