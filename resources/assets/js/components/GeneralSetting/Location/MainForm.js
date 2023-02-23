import React, { Component } from "react";

class MainForm extends Component {
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
                <CardTitle>Location Form</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="locationForm"
                  action={constvar.api_url + "location/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Location Code
                        <code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="loccode"
                        id="location_code"
                        className="required_field"
                        placeholder="Enter Unique Location Code"
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Location<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="locname"
                        placeholder="Enter Location Name"
                        className="required_field"
                      />
                    </Col>
                  </FormGroup>

                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="location_ismain"
                          name="ismain"
                          value="Y"
                        />
                        <Label for="location_ismain" />
                        <FormattedMessage id="Main" />
                      </div>
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="location_active"
                          name="isactive"
                          value="Y"
                        />
                        <Label for="location_active" />
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
export default MainForm;
