import React, { Component } from "react";
class Change_Password extends Component {
  constructor(props) {
    super(props);
    this.state = {
      password_check: "",
      password: "",
      confirm_password: "",
      user_data: []
    };
    this.handleChanges = this.handleChanges.bind(this);
    this.handleChangePasswords = this.handleChangePasswords.bind(this);
  }

  handleChanges(e) {
    // console.log(e.target.name);
    // console.log(e.target.value);
    this.setState({
      [e.target.name]: e.target.value
    });
  }

  handleChangePasswords(e) {
    if (this.state.password !== e.target.value) {
      this.setState({
        password_check: "fa fa-exclamation-triangle",
        [e.target.name]: e.target.value
      });
    } else {
      this.setState({
        password_check: "fa fa-check",
        [e.target.name]: e.target.value
      });
      return true;
    }
  }
  render() {
    return (
      <div>
        <Row className="reset-password-bg">
          <Col>
            <Card className="change-password">
              <CardHeader>
                <CardTitle>Change Password</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="usersForm" // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "change_password"}
                >
                  <FormGroup row>
                    <Col md="12" sm="12" xs="12">
                      <Label>
                        Old Password <code>*</code>:
                      </Label>
                      <Input
                        type="password"
                        name="old_password"
                        placeholder="Enter your old password"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="12" sm="12" xs="12">
                      <Label>New Password :</Label>
                      <Input
                        type="password"
                        name="password"
                        placeholder="New Password"
                        onChange={this.handleChanges}
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="12" sm="12" xs="12">
                      <Label>
                        Confirm Password<code>*</code>:
                      </Label>
                      <Input
                        type="password"
                        name="confirm_password"
                        placeholder=" Retype Password"
                        className="required_field"
                        onChange={this.handleChangePasswords}
                        defaultValue=""
                      />
                      <i
                        className={this.state.password_check}
                        style={{ fontSize: 18 + "px", color: "teal" }}
                      />
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
                          <i className="fa fa-dot-circle-o" /> Update
                        </Button>{" "}
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
export default Change_Password;
