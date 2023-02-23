import React, { Component } from "react";

export default class List extends Component {
  constructor() {
    setTimeout(function() {
      load_table_data();
    }, 1000);
    super();
    this.state = {
      data: [],
      loading: false,
      pages: 0,
    };
  }

  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <Row>
            <Col>
              <Card>
                <CardHeader>
                  <CardTitle>Branch Setup List</CardTitle>
                  <button className="btnRefresh" id="btnRefresh">
                    <i className="fa fa-refresh" aria-hidden="true" />
                  </button>
                </CardHeader>
                <div className="search_box" style={{ border: "none" }}>
                  <Form className="form">
                    <div className="row">
                      <Col md="4" sm="6" xs="6">
                        <div id="searchBypage">
                          <Label>Branch Name:</Label>
                          <Input
                            type="text"
                            name="branch_name"
                            id="branch_name"
                            PlaceHolder="Branch Name"
                            className=""
                          />
                        </div>
                      </Col>
                      <Col md="4" sm="6" xs="6">
                        <div>
                          <Label>Is Active:</Label>
                          <Input type="select" name="is_active" id="is_active">
                            <option value="">-- All --</option>
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                          </Input>
                        </div>
                      </Col>
                      <div className="col-md-3 align-self-end">
                        <a
                          href="javascript:void(0)"
                          className="btn btn-info main-btn"
                          id="searchByDate"
                        >
                          <i className="fa fa-search" aria-hidden="true" />
                          &nbsp;&nbsp; Search
                        </a>
                      </div>
                    </div>
                  </Form>
                </div>

                <table id="myTable" className="table table-striped">
                  <thead>
                    <tr>
                      <th width="5%">S.No.</th>
                      <th width="10%">Branch Name</th>
                      <th width="10%">Branch Location</th>
                      <th width="10%">Branch Address</th>
                      <th width="10%">Is Main</th>
                      <th width="10%">Is Active</th>
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
  var is_active = $("#is_active").val();
  var branch_name = $("#branch_name").val();

  var dataurl = constvar.api_url + "branch_setup/list";
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
        { data: "branch_name" },
        { data: "branch_location" },
        { data: "branch_address" },
        { data: "is_main" },
        { data: "is_active" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        aoData.push({ name: "branch_name", value: branch_name });

        aoData.push({ name: "is_active", value: is_active });
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
        { type: null },
        { type: null },
        { type: null },
      ],
    });

  $(document).off("click", "#searchByDate");
  $(document).on("click", "#searchByDate", function() {
    is_active = $("#is_active").val();
    branch_name = $("#branch_name").val();
    dtablelist.fnDraw();
  });
}
