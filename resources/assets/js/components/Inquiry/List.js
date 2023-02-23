import React, { Component } from "react";

export default class List extends Component {
  constructor() {
    load_datepicker();
    setTimeout(function() {
      load_table_data();
    }, 1000);
    super();
    this.state = {
      product: [],
      data: [],
      loading: false,
      pages: 0,
    };
  }
  componentDidMount() {
    axios.get(constvar.api_url + "ourproduct_enquiry").then((response) => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({ product: response.data.data["product"] });
      } else {
        this.setState({ product: "" });
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
                  <CardTitle>Quick Survey Record</CardTitle>
                  <button className="btnRefresh" id="btnRefresh">
                    <i className="fa fa-refresh" aria-hidden="true" />
                  </button>
                </CardHeader>
                <div className="search_box" style={{ border: "none" }}>
                  <Form className="form">
                    <div className="row">
                      <Col md="2" sm="6" xs="6">
                        <div id="searchBypage">
                          <Label>Product:</Label>
                          <Input
                            type="select"
                            name="product"
                            id="product"
                            className="mb-1"
                          >
                            <option value="">-- All --</option>
                            {this.state.product.length > 0
                              ? this.state.product.map((datas) => {
                                  return (
                                    <option
                                      key={datas.title}
                                      value={datas.title}
                                    >
                                      {datas.title}
                                    </option>
                                  );
                                })
                              : ""}
                          </Input>
                        </div>
                      </Col>
                      <Col md="2" sm="6" xs="6">
                        <div>
                          <Label>Date:</Label>
                          <Input
                            type="select"
                            name="filter_date"
                            id="filter_date"
                          >
                            <option value="">-- All --</option>
                            <option value="range">Range</option>
                          </Input>
                        </div>
                      </Col>
                      <Col
                        md="2"
                        sm="6"
                        xs="6"
                        className="customopt"
                        style={{ display: "none" }}
                      >
                        <div>
                          <label>From Date</label>
                          <input
                            type="text"
                            id="frmDate"
                            placeholder="YYYY-MM-DD"
                            className="datepicker"
                            name="startdate"
                          />
                        </div>
                      </Col>
                      <Col
                        md="2"
                        sm="6"
                        xs="6"
                        className="customopt"
                        style={{ display: "none" }}
                      >
                        <div>
                          <label>To Date</label>
                          <input
                            type="text"
                            id="toDate"
                            placeholder="YYYY-MM-DD"
                            className="datepicker"
                            name="enddate"
                          />
                        </div>
                      </Col>
                      <Col md="2" sm="6" xs="6">
                        <div>
                          <label>Search:</label>
                          <input
                            type="text"
                            id="search_text"
                            name="search_text"
                            placeholder="Type to search"
                            className=""
                            defaultValue=""
                          />
                        </div>
                      </Col>
                      <Col md="3" sm="6" xs="6" className="align-self-end">
                        <div className="col-md-2">
                          <a
                            href="javascript:void(0)"
                            className="btn btn-info main-btn"
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

                <table
                  id="inquiryTable"
                  className="table table-striped table-responsive"
                >
                  <thead>
                    <tr>
                      <th width="5%">S.No.</th>
                      <th width="10%">Name</th>
                      <th width="10%">Company Name</th>
                      <th width="10%">Email</th>
                      <th width="10%">Mobile No.</th>
                      <th width="10%">Product</th>
                      <th width="10%">Subject</th>
                      <th width="20%">Message</th>
                      <th width="10%">Time</th>
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
  var search_text = $("#search_text").val();
  var product = $("#product").val();
  var filter_date = $("#filter_date").val();
  var frmDate = $("#frmDate").val();
  var toDate = $("#toDate").val();
  var dataurl = constvar.api_url + "inquiry/inquiry_list";
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";
  var dtablelist = $("#inquiryTable")
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
        { data: "fullname" },
        { data: "company_name" },
        { data: "email" },
        { data: "mobile_no" },
        { data: "product_name" },
        { data: "subject" },
        { data: "message" },
        { data: "postdatead" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        aoData.push({ name: "search_text", value: search_text });
        aoData.push({ name: "product", value: product });
        aoData.push({ name: "filter_date", value: filter_date });
        aoData.push({ name: "frmDate", value: frmDate });
        aoData.push({ name: "toDate", value: toDate });
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
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: null },
        { type: null },
      ],
    });
  $(document).off("click", "#searchByDate");
  $(document).on("click", "#searchByDate", function() {
    search_text = $("#search_text").val();
    product = $("#product").val();
    filter_date = $("#filter_date").val();
    frmDate = $("#frmDate").val();
    toDate = $("#toDate").val();
    dtablelist.fnDraw();
  });
}
