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
                <CardTitle>Tiles Setup</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="frontendTiles"
                  encType="multipart/form-data"
                  action={constvar.api_url + "frontend_tiles/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Title<code>*</code>:
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
                        Icon<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="icon"
                        placeholder="Enter Icon Name"
                        className=""
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
                        placeholder="Enter Content Here"
                        className="required_field"
                        id="content"
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
                    <Col md="3" sm="3" xs="3">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="banner@check"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="banner@check" />
                        <FormattedMessage id="Is Publish" />
                      </div>
                    </Col>
                    <Col md="3" sm="3" xs="3">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="for_header"
                          name="for_header"
                          value="Y"
                        />
                        <Label for="for_header" />
                        Header
                      </div>
                    </Col>
                    <Col md="3" sm="3" xs="3">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="for_body"
                          name="for_body"
                          value="Y"
                        />
                        <Label for="for_body" />
                        Body
                      </div>
                    </Col>
                    <Col md="3" sm="3" xs="3">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="for_footer"
                          name="for_footer"
                          value="Y"
                        />
                        <Label for="for_footer" />
                        Footer
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
