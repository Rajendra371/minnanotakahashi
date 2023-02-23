import React, { Component } from "react";

export default class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {};

    load_datepicker();
  }

  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>Organization Management</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="orgForm"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "organization/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Organization Name:<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="orgname"
                        placeholder="Organization Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Contact<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="contact"
                        placeholder="Contact Number"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Address 1<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="orgaddress1"
                        placeholder="Current Address"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Address 2:</Label>
                      <Input
                        type="text"
                        name="orgaddress2"
                        placeholder="Primary Address"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Email<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="email"
                        placeholder="john@example.com"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Website<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="website"
                        placeholder="Website"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    {/* <Col md="6" sm="6" xs="6">
                                            <Label>
                                                Order<code>*</code>:
                                            </Label>
                                            <Input
                                                type="number"
                                                name="order"
                                                placeholder="Order"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col> */}
                  </FormGroup>

                  <FormGroup check inline>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="organization@check"
                          name="isactive"
                          value="Y"
                        />
                        <Label for="organization@check" />
                        <FormattedMessage id="Active" />
                      </div>
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
