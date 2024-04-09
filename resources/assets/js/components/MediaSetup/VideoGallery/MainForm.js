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
                <CardTitle>
                  <FormattedMessage id="video.gallery" />
                </CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="videoGalleryForm"
                  action={constvar.api_url + "video_gallery/store"}
                >
                  <Input type="hidden" name="id" />
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="video.title" />
                        <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="title"
                        placeholder="Enter Video Title"
                        className=""
                        defaultValue=""
                      />
                    </Col>

                    <Col sm="6">
                      <Label>
                        <FormattedMessage id="video.link" />
                        <code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="link"
                        placeholder="Enter Video Link "
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="display.order" />:
                      </Label>
                      <Input
                        type="text"
                        name="order"
                        placeholder="Enter Order"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Image</Label>
                      <div
                        className="file-upload-wrapper"
                        data-text="Select your image!"
                      >
                        <Input
                          name="image"
                          type="file"
                          className="file-upload-field"
                        />
                      </div>
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="is_display"
                          name="is_display"
                          value="Y"
                        />
                        <Label for="is_display" />
                        <FormattedMessage id="isdisplay" />
                      </div>
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="is_home_display"
                          name="is_home_display"
                          value="Y"
                        />
                        <Label for="is_home_display" />
                        <FormattedMessage id="Homepage Display" />
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
                          <i className="fa fa-dot-circle-o" />{" "}
                          <FormattedMessage id="button.save" />
                        </Button>{" "}
                        &nbsp;&nbsp;&nbsp;
                        <Button
                          type="button"
                          size="md"
                          color="danger"
                          className="btnreset"
                        >
                          <i className="fa fa-ban" />{" "}
                          <FormattedMessage id="button.reset" />
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
