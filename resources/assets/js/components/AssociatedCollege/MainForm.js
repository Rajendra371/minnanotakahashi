import React, { Component } from "react";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {};
    load_ckeditor();
  }

  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>Associated College</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="associatedCollegeForm"
                  encType="multipart/form-data"
                  action={constvar.api_url + "associated_college/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Name
                        <code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="college_name"
                        id="college_name"
                        placeholder="Enter College Name"
                        className="required_field"
                      />
                    </Col>

                    <Col xs="12">
                      <Label>
                        Logo
                        <code>*</code>:
                      </Label>
                      <div
                        className="file-upload-wrapper"
                        data-text="Select your image!"
                      >
                        <Input
                          name="file"
                          type="file"
                          className="file-upload-field"
                        />
                      </div>
                    </Col>
                    <Col md="12" sm="12" xs="12">
                      <Label>
                        URL<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="college_url"
                        placeholder="Enter College URL"
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
                  </FormGroup>

                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="publish"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="publish" />
                        <FormattedMessage id="Is Publish" />
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
