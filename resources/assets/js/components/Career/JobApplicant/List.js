import React, { Component } from "react";
import "react-table/react-table.css";

export default class List extends Component {
  constructor() {
    super();
    this.state = {
      data: [],
      gender: [],
    };
    load_datepicker();
    load_select2();
    setTimeout(function() {
      load_table_data();
    }, 1000);
  }

  componentDidMount() {}

  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <div className="search_box">
            <Form className="form">
              <div className="row">
                <div className="col-md-2">
                  <Label>Search Text</Label>
                  <Input
                    type="text"
                    name="search_text"
                    id="search_text"
                    placeholder="Search"
                  />
                </div>
                <div className="col-md-1">
                  <a
                    href="javascript:void(0)"
                    className="btn btn-info main-btn mt-4"
                    id="searchEmployeeList"
                  >
                    <i className="fa fa-search" aria-hidden="true" />
                  </a>
                </div>
              </div>
            </Form>
          </div>

          <Row>
            <Col>
              <Card>
                <table id="careerListTable" className="table table-striped">
                  <thead>
                    <tr>
                      <th width="5%">S.N </th>
                      <th width="15%">Job Code</th>
                      <th width="20%">Job Title </th>
                      <th width="20%">Applicant Name </th>
                      <th width="10%">Contact No.</th>
                      <th width="10%">Email</th>
                      <th width="10%">Applied Date</th>
                      <th width="10%">Action </th>
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

  var dataurl = constvar.api_url + "job_applicant_list/list";
  console.log(dataurl);
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";

  var dtablelist = $("#careerListTable")
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
            Authorization:
              "Bearer " + localStorage.getItem("backend-jwt-token"),
          },
          url: sSource,
          data: aoData,
          success: fnCallback,
          error: function(xhr, error, code) {
            if (xhr.status == 401) {
              message = "Please reload the page";
            }
            console.log(error, code);
          },
        });
      },
      oLanguage: {
        sEmptyTable: message,
      },

      aoColumnDefs: [
        {
          bSortable: false,
          aTargets: [0, 6],
        },
      ],

      aoColumns: [
        { data: null },
        { data: "jobcode" },
        { data: "job_title" },
        { data: "applicant_name" },
        { data: "contact_no" },
        { data: "email" },
        { data: "posted_date" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        aoData.push({ name: "search_text", value: search_text });
      },

      fnRowCallback: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
        return nRow;
      },

      fnCreatedRow: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        var cur_status = aData.cstatus;
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
        { type: null },
      ],
    });

  $(document).off("keyup", "#search_text");
  $(document).on("keyup", "#search_text", function() {
    search_text = $("#search_text").val();
    dtablelist.fnDraw();
  });

  $(document).off("click", "#searchEmployeeList");
  $(document).on("click", "#searchEmployeeList", function() {
    search_text = $("#search_text").val();
    dtablelist.fnDraw();
  });
}
