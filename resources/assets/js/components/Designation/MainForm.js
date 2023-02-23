import React, { Component } from "react";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      checked: "Y",
    };
  }

  checkChange = (e) => {
    if (e.target.checked) {
      this.setState({ checked: "Y" });
    } else {
      this.setState({ checked: "N" });
    }
  };

  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>
                  Designation Form
                </CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="designationForm"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "designation/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Designation Code:<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="designation_code"
                        placeholder="Designation"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Designation:<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="designation_name"
                        placeholder="Designation"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    {/* <Col md="6" sm="6" xs="6">
                      <Label>
                        Basic Salary:<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="basic_salary"
                        placeholder="Basic Salary"
                        className="required_field float"
                        defaultValue=""
                      />
                    </Col> */}
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Grade Rate:
                      </Label>
                      <Input
                        type="text"
                        name="grade_rate"
                        placeholder="Grade Rate"
                        className="required_field float"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Hourly rate:
                      </Label>
                      <Input
                        type="text"
                        name="hourly_rate"
                        placeholder="0"
                        className="required_field float"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        No. of Grade:
                      </Label>
                      <Input
                        type="text"
                        name="no_of_grade"
                        placeholder="0"
                        className="required_field float"
                        defaultValue=""
                      />
                    </Col>
                    {/* <Col md="6" sm="6" xs="6">
                      <Label>
                        Level:
                      </Label>
                      <Input
                        type="number"
                        name="level"
                        placeholder="0"
                        className=""
                        defaultValue=""
                      />
                    </Col> */}
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Display Order:
                      </Label>
                      <Input
                        type="number"
                        name="order"
                        placeholder="0"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row />
                 
                  <FormGroup check inline>
                    <Input
                      className="form-check-input"
                      type="checkbox"
                      name="isactive"
                      value="Y"
                    />
                    <Label className = "ml-2 mt-2">
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
export default MainForm;
