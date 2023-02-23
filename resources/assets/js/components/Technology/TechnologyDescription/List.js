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
      category: [],
      // deplist:[],
      data: [],
      loading: false,
      pages: 0,
    };
  }
  componentDidMount() {
    axios.get(constvar.api_url + "technology_description").then((response) => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({ category: response.data.data["category"] });
      } else {
        this.setState({ category: "" });
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
                  <CardTitle>Technology Description List</CardTitle>
                  <button className="btnRefresh" id="btnRefresh">
                    <i className="fa fa-refresh" aria-hidden="true" />
                  </button>

                  {/* <Button color="danger" onClick={this.toggle}>Model</Button> */}
                </CardHeader>
                <div className="search_box" style={{ border: "none" }}>
                  <Form className="form">
                    <div className="row">
                      <Col md="4" sm="6" xs="6">
                        <div id="searchBypage">
                          <Label>Technology Category:</Label>
                          <Input
                            type="select"
                            name="category"
                            id="category"
                            className="mb-2"
                          >
                            <option value="">-- All --</option>
                            {this.state.category.length > 0
                              ? this.state.category.map((datas) => {
                                  return (
                                    <option key={datas.id} value={datas.id}>
                                      {datas.cat_name}
                                    </option>
                                  );
                                })
                              : ""}
                          </Input>
                        </div>
                      </Col>
                    </div>
                  </Form>
                </div>

                <table
                  id="myTable"
                  className="table table-striped table-responsive"
                >
                  <thead>
                    <tr>
                      <th width="5%">S.No.</th>
                      <th width="20%">Technology Category</th>
                      <th width="20%">Technology Title</th>
                      <th width="10%">Icon</th>
                      <th width="20%">Image</th>
                      <th width="10%">Order</th>
                      <th width="10%">Is Publish</th>
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
  var category = $("#category").val();

  var dataurl =
    constvar.api_url + "technology_description/technologydescription_list";
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
        { data: "technology_catid" },
        { data: "title" },
        { data: "icon" },
        { data: "image" },
        { data: "order" },
        { data: "is_publish" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        // aoData.push({ name: "frmDate", value: frmDate });

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
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
      ],
    });

  $(document).off("change", "#searchBypage");
  $(document).on("change", "#searchBypage", function() {
    category = $("#category").val();

    dtablelist.fnDraw();
  });
}
