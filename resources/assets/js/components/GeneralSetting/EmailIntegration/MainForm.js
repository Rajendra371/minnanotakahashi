import React, { Component } from "react";
import axios from "axios";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      protocol: [],
      encryption: [],
    };

    load_datepicker();
  }
  componentDidMount() {
    axios.get(constvar.api_url + "emailintegration").then((response) => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({ protocol: response.data.data["protocol"] });
        this.setState({ encryption: response.data.data["encryption"] });
      } else {
        this.setState({ protocol: "" });
      }
    });
  }

  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>Email Integration Management</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="emailForm"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "emailintegration/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Mail From Name<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="mail_from_name"
                        placeholder="Enter Mail Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Email<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="mail_from_address"
                        placeholder="Enter Email"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Email Protocol
                        <code>*</code>
                      </Label>
                      <Input
                        type="select"
                        name="email_protocol_typeid"
                        id="email_protocol_typeid"
                      >
                        <option>-- Select Protocol --</option>
                        {this.state.protocol.length > 0
                          ? this.state.protocol.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.protocal_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Host Name<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="smtp_host"
                        placeholder="Host Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        SMTP User<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="smtp_user"
                        placeholder="SMTP User"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Password<code>*</code>:
                      </Label>
                      <Input
                        type="password"
                        name="smtp_password"
                        placeholder="SMTP Password"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        SMTP Port<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="smtp_port"
                        placeholder="SMTP Port"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Email Encryption
                        <code>*</code>
                      </Label>
                      <Input
                        type="select"
                        name="email_encryption_typeid"
                        id="email_encryption_typeid"
                      >
                        <option>-- Select Encryption --</option>
                        {this.state.encryption.length > 0
                          ? this.state.encryption.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.encryption_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                  </FormGroup>
                  <FormGroup check inline>
                    <Input
                      className="form-check-input"
                      type="checkbox"
                      name="is_active"
                      value="Y"
                      id="is_active"
                    />
                    <Label for="is_active">Is Active</Label>
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
                          <i className="fa fa-dot-circle-o" /> Save
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
          </Col>
        </Row>
      </div>
    );
  }
}
export default MainForm;
