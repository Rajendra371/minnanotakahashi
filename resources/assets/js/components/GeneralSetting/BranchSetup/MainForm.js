import React, { Component } from "react";

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
                <CardTitle>Branch Setup Form</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="branchSetupForm"
                  action={constvar.api_url + "branch_setup/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" />
                    <Col md="6" sm="6" xs="12">
                      <Label>
                        Branch Type:<code>*</code>
                      </Label>
                      <Input type="select" name="branch_type" id="branch_type">
                        <option value="0">-- Select Branch Type --</option>

                        <option value="1">National</option>
                        <option value="2">International</option>
                      </Input>
                    </Col>
                    <Col md="6" sm="6" xs="12">
                      <Label>
                        Branch Name:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="branch_name"
                        placeholder="Branch Name"
                        className="required_field"
                      />
                    </Col>
                    <Col md="6" sm="6" xs="12">
                      <Label>
                        Branch Location:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="branch_location"
                        placeholder="Branch Location"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="12">
                      <Label>
                        Branch Address<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="branch_address"
                        placeholder="Branch Address"
                        className="required_field"
                      />
                    </Col>
                    <Col md="6" sm="6" xs="12">
                      <Label>Contact Number:</Label>
                      <Input
                        type="text"
                        name="contact_number"
                        placeholder="Contact Number"
                        className=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="12">
                      <Label>Email:</Label>
                      <Input
                        type="text"
                        name="email"
                        placeholder="Email"
                        className=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="12">
                      <Label>Contact Person:</Label>
                      <Input
                        type="text"
                        name="contact_person"
                        placeholder="Contact Person"
                      />
                    </Col>
                    <Col md="6" sm="6" xs="12">
                      <Label>Display Order:</Label>
                      <Input
                        type="text"
                        name="order"
                        placeholder="Display Order"
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="12">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="branch_main@check"
                          name="is_main"
                          value="Y"
                        />
                        <Label for="branch_main@check" />
                        <FormattedMessage id="Is Main" />
                      </div>
                    </Col>
                    <Col md="6" sm="6" xs="12">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="branch@check"
                          name="is_active"
                          value="Y"
                        />
                        <Label for="branch@check" />
                        <FormattedMessage id="Is Active" />
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
