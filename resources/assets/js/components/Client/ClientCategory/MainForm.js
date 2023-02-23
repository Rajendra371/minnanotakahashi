import React, { Component } from "react";
import axios from "axios";

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
                <CardTitle>Client Category Form</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="clientcatForm"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "clientcategory/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Category Name:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="category_name"
                        placeholder="Enter Category Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Icon Name:</Label>
                      <Input
                        type="text"
                        name="icon"
                        placeholder="Enter Icon Here"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Order:</Label>
                      <Input
                        type="number"
                        name="order"
                        placeholder="Enter Order"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>

                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="client@check"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="client@check" />
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
