import React, { Component } from "react";
import axios from "axios";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      menu_id: [],
    };
    load_ckeditor();
  }
  componentDidMount() {
    axios.get(constvar.api_url + "page").then((response) => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({ menu_id: response.data.data["menu"] });
      } else {
        this.setState({ menu_id: "" });
      }
    });
  }
  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>Page Form</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="pageForm"
                  encType="multipart/form-data"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "page/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Page Menu:
                        <code>*</code>
                      </Label>
                      <Input type="select" name="menuid" id="menuid">
                        <option value="">-- Select Menu --</option>
                        {this.state.menu_id.length > 0
                          ? this.state.menu_id.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.menu_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Title:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="page_title"
                        placeholder="Enter Page Title"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Page Alise:</Label>
                      <Input
                        type="text"
                        name="page_slug"
                        placeholder="Enter Page Slug"
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
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Short Content<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="short_content"
                        placeholder="Short Content"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col xs="12">
                      <Label>
                        Description
                        <code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="description"
                        placeholder="Enter Description"
                        className="ckeditor"
                        id="description"
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
                  </FormGroup>

                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="page@check"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="page@check" />
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
