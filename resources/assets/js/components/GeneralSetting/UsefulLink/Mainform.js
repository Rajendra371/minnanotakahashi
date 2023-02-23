import React, { Component } from "react";
import axios from "axios";

export default class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>UsefulLink</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="uesfulForm"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "usefullink/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Title:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="title"
                        placeholder="Enter Title"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Designation<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="designation"
                        placeholder="Enter Designation"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Contact No<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="contact"
                        placeholder="Enter Contact No"
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
                        name="email"
                        placeholder="Enter Email"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Facebook Link:</Label>
                      <Input
                        type="text"
                        name="facebook_link"
                        placeholder="Enter Facebook Link"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Twitter Link:</Label>
                      <Input
                        type="text"
                        name="twitter_link"
                        placeholder="Enter Twitter Link"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Linkedin Link:</Label>
                      <Input
                        type="text"
                        name="linkedin_link"
                        placeholder="Enter Linkedin Link"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Youtube Link:</Label>
                      <Input
                        type="text"
                        name="youtube_link"
                        placeholder="Enter Youtube Link"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Instagram Link:</Label>
                      <Input
                        type="text"
                        name="instagram_link"
                        placeholder="Enter Instagram Link"
                        className=""
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Order:</Label>
                      <Input
                        type="number"
                        name="order"
                        placeholder="Order"
                        className=""
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6" className="align-self-end">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="usefullink@check"
                          name="isactive"
                          value="Y"
                        />
                        <Label for="usefullink@check" />
                        <FormattedMessage id="isactive" />
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
