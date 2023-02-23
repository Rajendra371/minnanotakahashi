import React, { Component } from "react";

export default class List extends Component {
  render() {
    return (
      <div>
        <div className="search_box">
          <Form className="form" id="aprove_shift_form">
            <div className="row">
              <div className="col-md-2">
                <Label>Roster Type</Label>
                <Input
                  type="select"
                  className="required_field"
                  id="report_type"
                  name="gen_type"
                  defaultValue="E"
                >
                  <option value="E">Employeeless</option>
                </Input>
              </div>

              <div className="col-md-2">
                <Label>Refno.</Label>
                <Input
                  type="text"
                  name="refno"
                  id="refno"
                  className="required_field"
                />
              </div>
              <div className="col-md-1">
                <a
                  href="javascript:void(0)"
                  className="btn btn-info main-btn mt-24 searchReport"
                  data-url={constvar.api_url + "roster/get_booked_shift_list"}
                  data-displayid="bookedShiftDiv"
                  id="btnShiftBookForm"
                >
                  <i className="fa fa-search" aria-hidden="true" /> Filter
                </a>
              </div>
            </div>
          </Form>
        </div>
        <div id="bookedShiftDiv" />
      </div>
    );
  }
}
