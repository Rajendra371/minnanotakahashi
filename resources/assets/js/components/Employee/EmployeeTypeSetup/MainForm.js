import React, { Component } from "react";

export default class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }
  componentDidMount() {}

  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>
                  Employee Type Setup
                </CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="employeeTypeForm"
                  action={constvar.api_url + "employee_type_setup/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Employee Type<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="employee_type"
                        placeholder="Employee Type"
                        className="required_field"
                        id="employee_type"
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup check inline>
                    <Input
                      className="form-check-input"
                      type="checkbox"
                      id="isactive_chk"
                      name="isactive"
                      value="Y"
                    />
                    <Label
                      className="form-check-label"
                      check
                      htmlFor="isactive_chk"
                    >
                      Is Active
                    </Label>
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
                          Save
                        </Button>{" "}
                        &nbsp;&nbsp;&nbsp;
                        <Button
                          type="button"
                          size="md"
                          color="danger"
                          className="btnreset"
                        >
                          <i className="fa fa-ban" />{" "}
                          Reset
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
