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
                <CardTitle>Training </CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="trainingForm"
                  encType="multipart/form-data"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "training/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Training Title:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="title"
                        placeholder="Enter training Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Icon name:</Label>
                      <Input
                        type="text"
                        name="icon_name"
                        placeholder="Enter Icon"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Slug:</Label>
                      <Input type="text" name="slug" defaultValue="" />
                    </Col>

                    <Col md="12" sm="6" xs="6">
                      <Label>
                        Content<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="description"
                        placeholder="Enter Content"
                        className="ckeditor"
                        id="description"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Short Content<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="short_description"
                        placeholder="Enter Short description"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    {/* <Col xs="12">
                      <Label>
                        Icon Image
                        <code>*</code>:
                      </Label>
                      <div
                        className="file-upload-wrapper"
                        data-text="Select your image!"
                      >
                        <Input
                          name="icon_image"
                          type="file"
                          className="file-upload-field"
                        />
                      </div>
                    </Col> */}

                    <Col xs="12">
                      <Label>
                        Training Image
                        <code>*</code>:
                      </Label>
                      <div
                        className="file-upload-wrapper"
                        data-text="Select your image!"
                      >
                        <Input
                          name="training_image"
                          type="file"
                          className="file-upload-field"
                        />
                      </div>
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Start Date:</Label>
                      <Input
                        type="text"
                        name="start_date"
                        placeholder="YYYY-MM-DD"
                        className="datepicker"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>End Date:</Label>
                      <Input
                        type="text"
                        name="end_date"
                        placeholder="YYYY-MM-DD"
                        className="datepicker"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Class Start:</Label>
                      <Input
                        type="text"
                        name="class_start"
                        placeholder="YYYY-MM-DD"
                        className="datepicker"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Class End:</Label>
                      <Input
                        type="text"
                        name="class_end"
                        placeholder="YYYY-MM-DD"
                        className="datepicker"
                        defaultValue=""
                      />
                    </Col>

                    {/* <Col md="6" sm="6" xs="6">
                      <Label>Trainer name:</Label>
                      <Input
                        type="text"
                        name="trainer_name"
                        placeholder="Enter TrainerName"
                        defaultValue=""
                      />
                    </Col>

                    <Col xs="12">
                      <Label>
                        Trainer Image
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
                    </Col> */}

                    <Col md="6" sm="6" xs="6">
                      <Label>SEO Title:</Label>
                      <Input
                        type="text"
                        name="meta_title"
                        placeholder="Enter Meta Title"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>SEO Keyword:</Label>
                      <Input
                        type="text"
                        name="meta_keyword"
                        placeholder="Enter Meta Keyword"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>SEO Description:</Label>
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
                          id="training@check"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="training@check" />
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
