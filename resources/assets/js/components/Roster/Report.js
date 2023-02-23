import React, { Component } from "react";
import Employee from "../common/EmployeeFields";
export default class Report extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  componentDidMount() {
    load_datepicker();
    load_select2();
  }

  render() {
    return (
      <div>
        <div className="search_box">
          <Form className="form" id="rosterReportForm">
            <div className="row">
              <Employee cols={2} />

              <div className="col-md-2">
                <Label>Report Wise</Label>
                <Input
                  type="select"
                  name="report_wise"
                  id="report_wise"
                  className="form-control"
                >
                  <option value="employee">Employee Wise</option>
                  <option value="date">Date wise</option>
                </Input>
              </div>

              <div className="col-md-2">
                <Label>Report Type</Label>
                <Input
                  type="select"
                  name="report_type"
                  id="report_type"
                  className="form-control"
                >
                  <option value="summary">Summary</option>
                  <option value="detail">Detail</option>
                </Input>
              </div>

              <div className="col-md-2">
                <Label>Date Type</Label>
                <Input
                  type="select"
                  name="date_type"
                  id="roster_date_type"
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

              <div className="col-md-2">
                <Label>Print Orientation</Label>
                <Input
                  type="select"
                  name="page_orientation"
                  className="form-control"
                >
                  <option value="P">Potrait</option>
                  <option value="L">Landscape</option>
                </Input>
              </div>

              <div className="col-md-1">
                <a
                  href="javascript:void(0)"
                  className="btn btn-info main-btn mt-24 searchReport"
                  data-url={constvar.api_url + "roster/roster_report"}
                  data-displayid="roster_report_div"
                  id="btnGenRosterReport"
                >
                  <i className="fa fa-search" aria-hidden="true" /> Filter
                </a>
              </div>
            </div>
          </Form>
        </div>
        <div id="roster_report_div" />
      </div>
    );
  }
}

$(document).off("change", "#roster_date_type");
$(document).on("change", "#roster_date_type", function(e) {
  let value = $(this).val();
  if (value == "range") {
    $(".roster_rangediv").show(500);
  } else {
    $(".roster_rangediv").hide(500);
  }
});
