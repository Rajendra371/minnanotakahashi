import React, { Component } from "react";

export default class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {};

    load_datepicker();
    load_ckeditor();
  }

  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>Service</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="serviceForm"
                  encType="multipart/form-data"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "service/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Name:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="service_name"
                        placeholder="Enter Service Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Icon:</Label>
                      <Input
                        type="text"
                        name="icon"
                        placeholder="Enter Icon"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Slug:</Label>
                      <Input type="text" name="slug" defaultValue="" />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Short Content<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="short_content"
                        placeholder="Enter Short Content"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col xs="12">
                      <Label>
                        Image
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
                    <Col md="12" sm="6" xs="6">
                      <Label>
                        Content<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="content"
                        placeholder="Enter Content"
                        className="ckeditor"
                        id="content"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Start Date:</Label>
                      <Input
                        type="text"
                        name="startdate"
                        placeholder="YYYY-MM-DD"
                        className="datepicker"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>End Date:</Label>
                      <Input
                        type="text"
                        name="enddate"
                        placeholder="YYYY-MM-DD"
                        className="datepicker"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Meta Title:</Label>
                      <Input
                        type="text"
                        name="meta_title"
                        placeholder="Enter Meta Title"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Meta Keyword:</Label>
                      <Input
                        type="text"
                        name="meta_keyword"
                        placeholder="Enter Meta Keyword"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Meta Description:</Label>
                      <Input
                        type="text"
                        name="meta_description"
                        placeholder="Enter Meta Description"
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
                          id="service@check"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="service@check" />
                        <FormattedMessage id="Is Publish" />
                      </div>
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="for_form"
                          name="for_form"
                          value="Y"
                        />
                        <Label for="for_form" />
                        <span>For Form</span>
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
