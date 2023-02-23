import React, { Component } from "react";
import { Input } from "reactstrap";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      employee_code: "",
      gender: [],
      blood_group: [],
      department: [],
      designation: [],
      employee_type: [],
      location: [],
      is_edit: true,
      same_address: false,
      employee: {},
    };
  }

  componentDidMount() {
    axios.get(constvar.api_url + "employee/get_form_data").then((response) => {
      if (response.data.status == "success") {
        this.setState({ department: response.data.data["department"] });
        this.setState({ designation: response.data.data["designation"] });
        this.setState({ gender: response.data.data["gender"] });
        this.setState({ blood_group: response.data.data["blood_group"] });
        this.setState({ employee_code: response.data.data["employee_code"] });
        this.setState({ employee_type: response.data.data["employee_type"] });
        this.setState({ location: response.data.data["location"] });
      }
    });
    var qrystring = window.location.search;
    var res = qrystring.split("=");
    var id = res[1];
    if (id) {
      axios
        .post(constvar.api_url + "employee/edit", { id: id })
        .then((response) => {
          if (response.data.status == "success") {
            console.log(response.data.employee);
            this.setState({ employee: response.data.employee });
          } else {
            this.setState({ employee: {} });
          }
        });
      load_datepicker("N");
    } else {
      load_datepicker();
    }
  }

  changeAddress = (e) => {
    this.setState({ same_address: !this.state.same_address }, () => {
      if (this.state.same_address) {
        $("#temp_state").val($("#perma_state").val());
        $("#temp_city").val($("#perma_city").val());
        $("#temp_address1").val($("#perma_address1").val());
        $("#temp_address2").val($("#perma_address2").val());
      }
    });
  };

  changeLocation = (e) => {
    let locationid = e.target.value;
    let url = constvar.api_url + "employee/get_loc_emp_code";
    axios.post(url, { locationid: locationid }).then((res) => {
      if (res.data.status == "success") {
        $("#empcode").val("");
        if (res.data.loc_data.loc_code != "") {
          $("#empcode").val(
            res.data.loc_data.loc_code + "-" + res.data.loc_data.emp_code
          );
        }
      } else {
        console.log("fail");
      }
    });
  };

  render() {
    const { employee } = this.state;
    return (
      <div>
        <CardHeader>
          <CardTitle>
            {employee.id !== undefined
              ? "Employee Edit"
              : "Employee Information"}{" "}
          </CardTitle>
        </CardHeader>
        <Card>
          <CardBody>
            <Form
              className="form-horizontal"
              id="employeeForm"
              action={constvar.api_url + "employee/store"}
            >
              <Input
                type="hidden"
                name="id"
                value={employee.id !== undefined ? employee.id : ""}
              />
              <h5 className="card-title">Personal Information </h5>

              <FormGroup row>
                <Col md="3" sm="3" xs="3">
                  <Label>
                    Location<code>*</code>:
                  </Label>
                  <Input
                    type="select"
                    name="locationid"
                    id="locationid"
                    className="required_field"
                    onChange={this.changeLocation}
                  >
                    <option value=""> -- Select --</option>
                    {this.state.location.length > 0
                      ? this.state.location.map((datas) => {
                          let selected =
                            employee.locationid !== undefined &&
                            employee.locationid == datas.id
                              ? "selected"
                              : "";
                          return (
                            <option
                              key={datas.id}
                              value={datas.id}
                              selected={selected}
                            >
                              {`${datas.loccode} - ${datas.locname}`}
                            </option>
                          );
                        })
                      : ""}
                  </Input>
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>
                    Emp. Code<code>*</code>:
                  </Label>
                  <Input
                    type="text"
                    name="empcode"
                    id="empcode"
                    readOnly="readonly"
                    defaultValue={
                      employee.empcode !== undefined
                        ? employee.empcode
                        : this.state.employee_code
                    }
                  />
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>
                    First Name<code>*</code>:
                  </Label>
                  <Input
                    type="text"
                    name="first_name"
                    placeholder="First Name"
                    className="required_field"
                    defaultValue={
                      employee.first_name !== undefined
                        ? employee.first_name
                        : ""
                    }
                  />
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>Middle Name:</Label>
                  <Input
                    type="text"
                    name="middle_name"
                    placeholder="Middle Name"
                    defaultValue={
                      employee.middle_name !== undefined
                        ? employee.middle_name
                        : null
                    }
                  />
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>
                    Last Name<code>*</code>:
                  </Label>
                  <Input
                    type="text"
                    name="last_name"
                    placeholder="Last Name"
                    className="required_field"
                    defaultValue={
                      employee.last_name !== undefined ? employee.last_name : ""
                    }
                  />
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>
                    Gender<code>*</code>:
                  </Label>
                  <Input
                    type="select"
                    name="gender_id"
                    id="gender_id"
                    className="required_field"
                  >
                    <option value=""> -- Select --</option>
                    {this.state.gender.length > 0
                      ? this.state.gender.map((datas) => {
                          let selected =
                            employee.gender_id !== undefined &&
                            employee.gender_id == datas.id
                              ? "selected"
                              : "";
                          return (
                            <option
                              key={datas.id}
                              value={datas.id}
                              selected={selected}
                            >
                              {datas.gend_name}
                            </option>
                          );
                        })
                      : ""}
                  </Input>
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>Date Of Birth:</Label>
                  <Input
                    type="text"
                    name="birth_date"
                    id="birth_date"
                    className="datepicker"
                    placeholder="YYYY/MM/DD"
                    autoComplete="null"
                    defaultValue={
                      employee.birth_datead !== undefined
                        ? employee.birth_datead
                        : null
                    }
                  />
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>Blood Group:</Label>
                  <Input
                    type="select"
                    name="blood_group_id"
                    id="blood_group_id"
                    onChange={this.handleOther}
                  >
                    <option value="">-- Select --</option>
                    {this.state.blood_group.length > 0
                      ? this.state.blood_group.map((datas) => {
                          let selected =
                            employee.blood_group_id !== undefined &&
                            employee.blood_group_id == datas.id
                              ? "selected"
                              : "";
                          return (
                            <option
                              key={datas.id}
                              value={datas.id}
                              selected={selected}
                            >
                              {datas.blood_group}
                            </option>
                          );
                        })
                      : ""}
                  </Input>
                </Col>
                {/* <Col md="3" sm="3" xs="3">
                  <Label>Martial Status:</Label>
                  <Input
                    type="select"
                    name="martial_status_id"
                    id="martial_status_id"
                    onChange={this.handleOther}
                  >
                    <option value="">-- Select --</option>
                    {this.state.martial_status.length > 0
                      ? this.state.martial_status.map((datas) => {
                          return (
                            <option key={datas.id} value={datas.id}>
                              {datas.mast_name}
                            </option>
                          );
                        })
                      : ""}
                  </Input>
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>Nationality:</Label>
                  <Input
                    type="text"
                    name="nationality"
                    placeholder="Nationality"
                    
                  />
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>Citizenship No.:</Label>
                  <Input
                    type="text"
                    name="citizenship_no"
                    placeholder="Nationality"
                    
                  />
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>Place of Issue:</Label>
                  <Input
                    type="text"
                    name="issue_place"
                    placeholder="Place of Issue"
                    
                  />
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>Date Of Issue:</Label>
                  <Input
                    type="text"
                    name="issue_date"
                    id="issue_date"
                    className="datepicker"
                    
                  />
                </Col>
                <Col md="3" sm="3" xs="3">
                  <Label>Religion:</Label>
                  <Input
                    type="select"
                    name="religion_id"
                    id="religion_id"
                    onChange={this.handleOther}
                  >
                    <option value="">-- Select --</option>
                    {this.state.religion.length > 0
                      ? this.state.religion.map((datas) => {
                          return (
                            <option
                              key={datas.id}
                              value={datas.id}
                              data-hasother={datas.has_other}
                            >
                              {datas.reli_name}
                            </option>
                          );
                        })
                      : ""}
                  </Input>
                  {this.state.religion_id == true ? (
                    <div>
                      <Label>अन्य धर्म: </Label>
                      <Input
                        type="text"
                        name="religion_other"
                        placeholder="अन्य धर्म"
                        
                      />
                    </div>
                  ) : null}
                </Col> */}
              </FormGroup>

              <div className="position-relative">
                <h5 className="card-title ml-3 pt-3">Department Information</h5>
                <FormGroup row>
                  <Col md="3" sm="3" xs="3">
                    <Label>Department:</Label>
                    <Input
                      type="select"
                      name="department_id"
                      id="department_id"
                    >
                      <option value="">-- Select --</option>
                      {this.state.department.length > 0
                        ? this.state.department.map((datas) => {
                            let selected =
                              employee.department_id !== undefined &&
                              employee.department_id == datas.id
                                ? "selected"
                                : "";
                            return (
                              <option
                                key={datas.id}
                                value={datas.id}
                                selected={selected}
                              >
                                {datas.depname}
                              </option>
                            );
                          })
                        : ""}
                    </Input>
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>
                      Designation<code>*</code>:
                    </Label>
                    <Input
                      type="select"
                      name="designation_id"
                      id="designation_id"
                      className="required_field"
                    >
                      <option value="">-- Select --</option>
                      {this.state.designation.length > 0
                        ? this.state.designation.map((datas) => {
                            let selected =
                              employee.designation_id !== undefined &&
                              employee.designation_id == datas.id
                                ? "selected"
                                : "";
                            return (
                              <option
                                key={datas.id}
                                value={datas.id}
                                selected={selected}
                              >
                                {datas.designation_name}
                              </option>
                            );
                          })
                        : ""}
                    </Input>
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>Employee Type:</Label>
                    <Input
                      type="select"
                      name="employee_type_id"
                      id="employee_type_id"
                    >
                      <option value="">-- Select --</option>
                      {this.state.employee_type.length > 0
                        ? this.state.employee_type.map((datas) => {
                            let selected =
                              employee.employee_type_id !== undefined &&
                              employee.employee_type_id == datas.id
                                ? "selected"
                                : "";
                            return (
                              <option
                                key={datas.id}
                                value={datas.id}
                                selected={selected}
                              >
                                {datas.employee_type}
                              </option>
                            );
                          })
                        : ""}
                    </Input>
                  </Col>
                </FormGroup>
              </div>
              <div className="position-relative">
                <h5 className="card-title ml-3 pt-3">Address</h5>
                <h6>Permanent Address</h6>
                <FormGroup row>
                  <Col md="3" sm="3" xs="3">
                    <Label>State:</Label>
                    <Input
                      type="text"
                      name="perma_state"
                      id="perma_state"
                      placeholder="Enter State"
                      defaultValue={
                        employee.perma_state !== undefined
                          ? employee.perma_state
                          : null
                      }
                    />
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>City:</Label>
                    <Input
                      type="text"
                      name="perma_city"
                      id="perma_city"
                      placeholder="Enter City"
                      defaultValue={
                        employee.perma_city !== undefined
                          ? employee.perma_city
                          : null
                      }
                    />
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>Address 1:</Label>
                    <Input
                      type="text"
                      name="perma_address1"
                      id="perma_address1"
                      placeholder="Enter Address"
                      defaultValue={
                        employee.perma_address1 !== undefined
                          ? employee.perma_address1
                          : null
                      }
                    />
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>Address 2:</Label>
                    <Input
                      type="text"
                      name="perma_address2"
                      id="perma_address2"
                      placeholder="Enter Address"
                      defaultValue={
                        employee.perma_address2 !== undefined
                          ? employee.perma_address2
                          : null
                      }
                    />
                  </Col>
                </FormGroup>
                <h6>Temporary Address</h6>
                <FormGroup row>
                  <Col md="6" sm="6" xs="6">
                    <div className="checkbox">
                      <Input
                        type="checkbox"
                        id="sameAddress"
                        name="same_address"
                        checked={this.state.same_address}
                        value="Y"
                        onChange={this.changeAddress}
                      />
                      <Label for="sameAddress" />
                      Same as Permanent
                    </div>
                  </Col>
                </FormGroup>
                <FormGroup row>
                  <Col md="3" sm="3" xs="3">
                    <Label>State:</Label>
                    <Input
                      type="text"
                      name="temp_state"
                      id="temp_state"
                      placeholder="Enter State"
                      defaultValue={
                        employee.temp_state !== undefined
                          ? employee.temp_state
                          : null
                      }
                    />
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>City:</Label>
                    <Input
                      type="text"
                      name="temp_city"
                      id="temp_city"
                      placeholder="Enter City"
                      defaultValue={
                        employee.temp_city !== undefined
                          ? employee.temp_city
                          : null
                      }
                    />
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>Address 1:</Label>
                    <Input
                      type="text"
                      name="temp_address1"
                      id="temp_address1"
                      placeholder="Enter Address"
                      defaultValue={
                        employee.temp_address1 !== undefined
                          ? employee.temp_address1
                          : null
                      }
                    />
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>Address 2:</Label>
                    <Input
                      type="text"
                      name="temp_address2"
                      id="temp_address2"
                      placeholder="Enter Address"
                      defaultValue={
                        employee.temp_address2 !== undefined
                          ? employee.temp_address2
                          : null
                      }
                    />
                  </Col>
                </FormGroup>
              </div>
              <div className="position-relative">
                <h5 className="card-title ml-3 pt-3">Contact Information</h5>
                <FormGroup row>
                  <Col md="3" sm="3" xs="3">
                    <Label>Mobile 1:</Label>
                    <Input
                      type="text"
                      name="mobile1"
                      placeholder="Mobile Number"
                      defaultValue={
                        employee.mobile1 !== undefined ? employee.mobile1 : null
                      }
                    />
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>Mobile 2:</Label>
                    <Input
                      type="text"
                      name="mobile2"
                      placeholder="Mobile Number"
                      defaultValue={
                        employee.mobile2 !== undefined ? employee.mobile2 : null
                      }
                    />
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>
                      Email<code>*</code>:
                    </Label>
                    <Input
                      type="email"
                      name="email"
                      className="required_field"
                      placeholder="Email Address"
                      defaultValue={
                        employee.email !== undefined ? employee.email : null
                      }
                    />
                  </Col>
                </FormGroup>
              </div>
              <div className="position-relative">
                <h5 className="card-title ml-3 pt-3">Emergency Contact</h5>
                <FormGroup row>
                  <Col md="3" sm="3" xs="3">
                    <Label>Contact Person:</Label>
                    <Input
                      type="text"
                      name="emerg_contact_name"
                      placeholder="Contact Person Name"
                      defaultValue={
                        employee.emerg_contact_name !== undefined
                          ? employee.emerg_contact_name
                          : null
                      }
                    />
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>Mobile 1:</Label>
                    <Input
                      type="text"
                      name="emerg_mobile1"
                      placeholder="Mobile Number"
                      defaultValue={
                        employee.emerg_mobile1 !== undefined
                          ? employee.emerg_mobile1
                          : null
                      }
                    />
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>Mobile 2:</Label>
                    <Input
                      type="text"
                      name="emerg_mobile2"
                      placeholder="Mobile Number"
                      defaultValue={
                        employee.emerg_mobile2 !== undefined
                          ? employee.emerg_mobile2
                          : null
                      }
                    />
                  </Col>
                  <Col md="3" sm="3" xs="3">
                    <Label>Email:</Label>
                    <Input
                      type="email"
                      name="emerg_email"
                      placeholder="Email Address"
                      defaultValue={
                        employee.emerg_email !== undefined
                          ? employee.emerg_email
                          : null
                      }
                    />
                  </Col>
                </FormGroup>
              </div>
              <CardFooter>
                <div className="clearfix">
                  <div className="float-right">
                    <Button
                      type="submit"
                      size="md"
                      color="primary"
                      className="save"
                    >
                      <i className="fa fa-dot-circle-o" />{" "}
                      {employee.id !== undefined ? "Update" : "Save"}
                    </Button>{" "}
                    &nbsp;&nbsp;&nbsp;
                    <Button
                      type="button"
                      size="md"
                      color="danger"
                      className="btnreset"
                    >
                      <i className="fa fa-ban" /> Reset
                    </Button>
                  </div>
                </div>

                <div className="alert-success success" />
                <div className="alert-danger error" />
              </CardFooter>
            </Form>
          </CardBody>
        </Card>
      </div>
    );
  }
}

export default MainForm;
