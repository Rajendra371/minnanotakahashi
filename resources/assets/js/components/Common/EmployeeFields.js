import React, { Component } from "react";

export default class EmployeeFields extends Component {
  constructor(props) {
    super(props);
    this.state = {
      designationList: [],
      departmentList: [],
      employeeList: [],
      locationList: [],
      designationid: "",
      departmentid: "",
      locationid: "",
    };
  }
  componentDidMount() {
    axios
      .get(
        constvar.api_url + `general_data/list?status=${this.props.status || ""}`
      )
      .then((response) => {
        if (response.data.status == "success") {
          this.setState({ designationList: response.data.designation_list });
          this.setState({ departmentList: response.data.dep_list });
          this.setState({ employeeList: response.data.employee_list });
          this.setState({ locationList: response.data.location_list });
          this.setState({ locationid: response.data.user_location });
        }
      });
  }

  onChange = (e) => {
    this.setState({ [e.target.name]: e.target.value }, () => {
      axios
        .post(constvar.api_url + "general_data/get_employee", {
          designationid: this.state.designationid,
          departmentid: this.state.departmentid,
          status: this.props.status || "",
          locationid: this.state.locationid,
        })
        .then((response) => {
          if (response.data.status == "success") {
            this.setState({ employeeList: response.data.employee_list });
          } else {
            this.setState({ employeeList: [] });
          }
          $("#employee")
            .val(null)
            .trigger("change");
        });
    });
  };

  render() {
    return (
      <React.Fragment>
        <Col md={`${this.props.cols}`} sm="3" xs="3" className="locationDiv">
          <Label>Location</Label>
          <Input
            type="select"
            name="locationid"
            id="location"
            className="form-control"
            onChange={this.onChange}
            value={this.state.locationid}
          >
            <option value="">-- All --</option>
            {this.state.locationList.length > 0
              ? this.state.locationList.map((location) => {
                  return (
                    <option key={location.id} value={location.id}>
                      {location.loccode + "-" + location.locname}
                    </option>
                  );
                })
              : ""}
          </Input>
        </Col>
        <Col md={`${this.props.cols}`} sm="3" xs="3" className="designationdiv">
          <Label>Designation</Label>
          <Input
            type="select"
            name="designationid"
            id="designation"
            className="form-control"
            onChange={this.onChange}
            value={this.state.designationid}
          >
            <option value="">-- All --</option>
            {this.state.designationList.length > 0
              ? this.state.designationList.map((designation) => {
                  return (
                    <option key={designation.id} value={designation.id}>
                      {designation.designation_name}
                    </option>
                  );
                })
              : ""}
          </Input>
        </Col>
        <Col md={`${this.props.cols}`} sm="3" xs="3" className="departmentdiv">
          <Label>Department</Label>
          <Input
            type="select"
            name="departmentid"
            id="department"
            className="form-control"
            value={this.state.departmentid}
            onChange={this.onChange}
          >
            <option value="">-- All --</option>
            {this.state.departmentList.length > 0
              ? this.state.departmentList.map((department) => {
                  return (
                    <option key={department.id} value={department.id}>
                      {department.depname}
                    </option>
                  );
                })
              : ""}
          </Input>
        </Col>
        <Col md={`${this.props.cols}`} sm="3" xs="3" className="employeediv">
          <Label>Employee</Label>
          <Input
            type="select"
            name="employeeid"
            id="employee"
            className="select2"
          >
            <option value="">-- All --</option>
            {this.state.employeeList.length > 0
              ? this.state.employeeList.map((employee) => {
                  return (
                    <option key={employee.id} value={employee.id}>
                      {employee.full_name}
                    </option>
                  );
                })
              : ""}
          </Input>
        </Col>
      </React.Fragment>
    );
  }
}
