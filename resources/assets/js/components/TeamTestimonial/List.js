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
                  <CardTitle>Team/Testimonial List</CardTitle>
                  <button className="btnRefresh" id="btnRefresh">
                    <i className="fa fa-refresh" aria-hidden="true" />
                  </button>
                </CardHeader>
                <div className="search_box" style={{ border: "none" }}>
                  <Form className="form">
                    <div className="row">
                      <Col md="4" sm="6" xs="6">
                        <div id="searchBypage">
                          <Label>Name:</Label>
                          <Input type="text" id="list_name" className="" />
                        </div>
                      </Col>
                      <Col md="4" sm="6" xs="6">
                        <Label>Type:</Label>
                        <Input type="select" id="list_type">
                          <option value="1">Team</option>
                          <option value="2">Testinomials</option>
                          <option value="3">Message</option>
                        </Input>
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

                <table
                  id="myTable"
                  className="table table-striped table-responsive"
                >
                  <thead>
                    <tr>
                      <th width="5%">S.No.</th>
                      <th width="15%">Name</th>
                      <th width="15%">Designation</th>
                      <th width="5%">Type</th>
                      <th width="10%">Image</th>
                      <th width="10%">Contact</th>
                      <th width="10%">Email</th>
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
  var name = $("#list_name").val();
  var type = $("#list_type").val();

  var dataurl = constvar.api_url + "teamtestimonial/teamtestimonial_list";
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
          aTargets: [0, 4, 7],
        },
      ],

      aoColumns: [
        { data: null },
        { data: "name" },
        { data: "designation" },
        { data: "type" },
        { data: "image" },
        { data: "contactno" },
        { data: "email" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        aoData.push({ name: "name", value: name });
        aoData.push({ name: "type", value: type });
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
        { type: "text" },
        { type: "text" },
        { type: null },
      ],
    });
  $(document).off("click", "#searchByDate");
  $(document).on("click", "#searchByDate", function() {
    name = $("#list_name").val();
    type = $("#list_type").val();
    dtablelist.fnDraw();
  });
}
