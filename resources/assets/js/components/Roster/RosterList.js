import React, { Component } from "react";
import "react-table/react-table.css";
import EmployeeFields from "../common/EmployeeFields";

export default class RosterList extends Component {
  constructor() {
    super();
    this.state = {};
    load_datepicker();
    load_select2();
    setTimeout(function() {
      load_table_data();
    }, 1500);
  }

  render() {
    return (
      <div>
        <div className="search_box">
          <Form className="form" id="rosterReportForm">
            <div className="row">
              <EmployeeFields cols={2} status={"Y"} />

              <div className="col-md-2">
                <Label>Date Type</Label>
                <Input
                  type="select"
                  name="date_type"
                  id="date_type"
                  className="form-control"
                >
                  <option value="range">Range</option>
                  <option value="all">All</option>
                </Input>
              </div>

              <div className="col-md-2 roster_rangediv">
                <Label>From</Label>
                <Input
                  type="text"
                  className="datepicker"
                  id="fromdate"
                  name="fromdate"
                />
              </div>

              <div className="col-md-2 roster_rangediv">
                <Label>To</Label>
                <Input
                  type="text"
                  className="datepicker"
                  id="todate"
                  name="todate"
                />
              </div>

              {/* <div className="col-md-2">
                <Label>Print Orientation</Label>
                <Input
                  type="select"
                  name="page_orientation"
                  className="form-control"
                >
                  <option value="P">Potrait</option>
                  <option value="L">Landscape</option>
                </Input>
              </div> */}

              <div className="col-md-1">
                <a
                  href="javascript:void(0)"
                  className="btn btn-info main-btn mt-4"
                  id="searchEmployeeRoster"
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
              <CardHeader>
                <div className="d-flex justify-content-between">
                  <CardTitle>Employee Roster List</CardTitle>
                </div>
              </CardHeader>
              <table
                id="rosterListTable"
                className="table table-striped table-responsive"
              >
                <thead>
                  <tr>
                    <th width="5%">
                      <input
                        type="checkbox"
                        id="selectAll"
                        style={{ width: "20px" }}
                      />
                    </th>
                    <th width="5%">Refno</th>
                    <th width="5%">Type</th>
                    <th width="8%">Emp. Code </th>
                    <th width="10%">Emp. Name</th>
                    <th width="5%">Department </th>
                    <th width="5%">Designation </th>
                    <th width="8%">Start Date</th>
                    <th width="8%">Start Time</th>
                    <th width="8%">End Date</th>
                    <th width="8%">End Time</th>
                    <th width="8%">Duration</th>
                    <th width="10%">Place</th>
                    <th width="10%">Remarks</th>
                    <th width="8%">Work Status</th>
                    <th width="8%">Checkin</th>
                    <th width="8%">Checkout</th>
                    <th width="8%">Progress Note</th>
                    {/* <th width="5%">Action </th> */}
                  </tr>
                </thead>
                <tbody />
              </table>
            </Card>
          </Col>
        </Row>
        <div
          className="row p-4"
          style={{ display: "none" }}
          id="rosterStatusDiv"
        >
          <div className="col-md-3">
            <Label>Status</Label>
            <Input type="select" id="roster_status">
              <option value="P">Pending</option>
              <option value="V">Needs Verification</option>
              <option value="CO">Completed</option>
              <option value="C">Cancelled</option>
            </Input>
          </div>
          <div className="col-md-2">
            <a
              href="javascript:void(0)"
              className="btn btn-info main-btn mt-24"
              id="saveStatus"
            >
              Save
            </a>
          </div>
        </div>
      </div>
    );
  }
}

function load_table_data() {
  var location_id = $("#location").val();
  var department_id = $("#department").val();
  var designation_id = $("#designation").val();
  var employee_id = $("#employee").val();
  var date_type = $("#date_type").val();
  var fromdate = $("#fromdate").val();
  var todate = $("#todate").val();
  var page_orientation = $("#page_orientation").val();

  var dataurl = constvar.api_url + "roster/employee_roster_list";
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";

  var dtablelist = $("#rosterListTable")
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
          aTargets: [0],
        },
      ],

      aoColumns: [
        { data: null },
        { data: "refno" },
        { data: "type" },
        { data: "empcode" },
        { data: "full_name" },
        { data: "department" },
        { data: "designation" },
        { data: "start_date" },
        { data: "start_time" },
        { data: "end_date" },
        { data: "end_time" },
        { data: "duration" },
        { data: "place" },
        { data: "remarks" },
        { data: "status" },
        { data: "checkin" },
        { data: "checkout" },
        { data: "work_details" },
        // { data: "action" },
      ],

      fnServerParams: function(aoData) {
        aoData.push({ name: "location_id", value: location_id });
        aoData.push({ name: "department_id", value: department_id });
        aoData.push({ name: "designation_id", value: designation_id });
        aoData.push({ name: "employee_id", value: employee_id });
        aoData.push({ name: "date_type", value: date_type });
        aoData.push({ name: "from_date", value: fromdate });
        aoData.push({ name: "to_date", value: todate });
        aoData.push({ name: "page_orientation", value: page_orientation });
      },

      fnRowCallback: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        var id = aData.id;
        $("td:first", nRow).html(
          `<input type="checkbox" name="shift_detail_id[]" class="shift_ids" value="${id}"></input>`
        );
        // $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
        return nRow;
      },

      fnCreatedRow: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        var status_color = aData.status_color;
        var tblid = oSettings._iDisplayStart + iDisplayIndex + 1;
        $(nRow).attr("id", "listid_" + tblid);
        $(nRow).attr("style", `background:${status_color} !important`);
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
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        // { type: null },
      ],
    });

  $(document).off("click", "#searchEmployeeRoster");
  $(document).on("click", "#searchEmployeeRoster", function() {
    location_id = $("#location").val();
    department_id = $("#department").val();
    designation_id = $("#designation").val();
    employee_id = $("#employee").val();
    date_type = $("#date_type").val();
    fromdate = $("#fromdate").val();
    todate = $("#todate").val();
    page_orientation = $("#page_orientation").val();
    dtablelist.fnDraw();
  });
}

$(document).off("change", "#date_type");
$(document).on("change", "#date_type", function(e) {
  let value = $(this).val();
  if (value == "range") {
    $(".roster_rangediv").show(500);
  } else {
    $(".roster_rangediv").hide(500);
  }
});

$(document).off("click", "#selectAll");
$(document).on("click", "#selectAll", function(e) {
  if (this.checked) {
    $(".shift_ids").each(function() {
      this.checked = true;
      $("#rosterStatusDiv").show();
    });
  } else {
    $(".shift_ids").each(function() {
      this.checked = false;
      $("#rosterStatusDiv").hide();
    });
  }
});

$(document).off("click", ".shift_ids");
$(document).on("click", ".shift_ids", function(e) {
  if (this.checked) {
    this.checked = true;
    $("#rosterStatusDiv").show();
  } else {
    var check = $(".shift_ids:checkbox").filter(":checked");
    this.checked = false;
    if (check.length >= 1) {
      $("#rosterStatusDiv").show();
    } else {
      $("#rosterStatusDiv").hide();
    }
  }
});

$(document).off("click", "#saveStatus");
$(document).on("click", "#saveStatus", function(e) {
  var conf = confirm("Change Status? ");
  if (conf) {
    var shift_detail_ids = [];
    $.each($("input[name='shift_detail_id[]']:checked"), function() {
      shift_detail_ids.push($(this).val());
    });
    var status_id = $("#roster_status").val();
    var url = constvar.api_url + "roster/change_status";
    axios
      .post(url, { shift_detail_ids: shift_detail_ids, status_id: status_id })
      .then((response) => {
        $("#searchEmployeeRoster").trigger("click");
      });
    $("#rosterStatusDiv").hide();
    $("#selectAll").removeAttr("checked");
  }
});
