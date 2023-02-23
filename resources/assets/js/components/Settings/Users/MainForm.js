import React, { Component } from "react";
class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      password_check: "",
      password: "",
      confirm_password: "",
      location_data: [],
      usergroup_data: [],
    };
    this.handleChanges = this.handleChanges.bind(this);
    this.handleChangePasswords = this.handleChangePasswords.bind(this);
  }

  handleChanges(e) {
    console.log(e.target.name);
    console.log(e.target.value);
    this.setState({
      [e.target.name]: e.target.value,
    });
  }

  handleChangePasswords(e) {
    if (this.state.password !== e.target.value) {
      this.setState({
        password_check: "fa fa-exclamation-triangle",
        [e.target.name]: e.target.value,
      });
    } else {
      this.setState({
        password_check: "fa fa-check",
        [e.target.name]: e.target.value,
      });
      return true;
    }
  }

  componentDidMount() {
    axios.get(constvar.api_url + "location").then((response) => {
      if (response.data.status == "success") {
        this.setState({ location_data: response.data.data });
      } else {
        this.setState({ location_data: "" });
      }
    });
    axios.get(constvar.api_url + "usergroup").then((response) => {
      if (response.data.status == "success") {
        this.setState({ usergroup_data: response.data.data });
      } else {
        this.setState({ usergroup_data: "" });
      }
    });

    load_select2();
  }
  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>
                  {" "}
                  <FormattedMessage id="user.management" />
                </CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal "
                  id="usersForm" // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "users/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="user.name" /> <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="username"
                        placeholder="User Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="user.email" /> <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="email"
                        placeholder="john@example.com"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="user.password" /> :
                      </Label>
                      <Input
                        type="password"
                        name="password"
                        placeholder="Password"
                        onChange={this.handleChanges}
                        value={this.state.password}
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="user.confpassword" />
                        <code>*</code>:
                      </Label>
                      <Input
                        type="password"
                        name="confirm_password"
                        placeholder=" Retype Password"
                        className="required_field"
                        onChange={this.handleChangePasswords}
                        value={this.state.confirm_password}
                      />
                      <i
                        className={this.state.password_check}
                        style={{ fontSize: 18 + "px", color: "teal" }}
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="user.fullname" />
                        <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="fullname"
                        placeholder="Full Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        {" "}
                        <FormattedMessage id="user.contact" />:
                      </Label>
                      <Input
                        type="number"
                        name="contact"
                        placeholder="Contact Number"
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="user.location" />: <code>*</code>:
                      </Label>
                      <Input
                        type="select"
                        name="user_locationid"
                        defaultValue=""
                        className=""
                      >
                        <option>--Select Location--</option>
                        {this.state.location_data.length > 0
                          ? this.state.location_data.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.locname}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="user.group" />: <code>*</code>:
                      </Label>
                      <Input
                        type="select"
                        name="group_id"
                        defaultValue=""
                        id="select1"
                      >
                        <option>--Select Usergroup--</option>
                        {this.state.usergroup_data.length > 0
                          ? this.state.usergroup_data.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.groupname}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                  </FormGroup>

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
                          <FormattedMessage id="button.save" />
                        </Button>{" "}
                        &nbsp;&nbsp;&nbsp;
                        <Button
                          type="button"
                          size="md"
                          color="danger"
                          className="btnreset"
                        >
                          <i className="fa fa-ban" />{" "}
                          <FormattedMessage id="button.reset" />
                        </Button>
                      </div>
                    </div>

                    <div className="alert-success success" />
                    <div className="alert-danger error" />
                  </CardFooter>
                </Form>
              </CardBody>
            </Card>
          </Col>
        </Row>
      </div>
    );
  }
}
export default MainForm;
