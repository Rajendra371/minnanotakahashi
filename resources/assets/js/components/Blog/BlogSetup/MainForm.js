import React, { Component } from "react";
import axios from "axios";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      category: [],
    };
    load_ckeditor();
  }
  componentDidMount() {
    axios.get(constvar.api_url + "blog_setup").then((response) => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({ category: response.data.data["category"] });
      } else {
        this.setState({ category: "" });
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
                <CardTitle>Blog SETUP</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="blogForm"
                  encType="multipart/form-data"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "blog_setup/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Blog Category:
                        <code>*</code>
                      </Label>
                      <Input
                        type="select"
                        name="blog_categoryid"
                        id="blog_categoryid"
                      >
                        <option>-- Select Blog Category --</option>
                        {this.state.category.length > 0
                          ? this.state.category.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.cat_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Blog Title:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="blog_title"
                        placeholder="Enter Blog Title Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="12" sm="6" xs="6">
                      <Label>
                        Content<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="content"
                        placeholder="Enter Description"
                        className="ckeditor"
                        id="content"
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
                      <Label>Icon Name:</Label>
                      <Input
                        type="text"
                        name="icon"
                        placeholder="Enter Icon Class Name"
                        className=""
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Author:</Label>
                      <Input
                        type="text"
                        name="author"
                        placeholder="Enter Author Name"
                        className=""
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>SEO Title:</Label>
                      <Input
                        type="text"
                        name="seo_title"
                        placeholder="Enter SEO Title"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>SEO Keyword:</Label>
                      <Input
                        type="text"
                        name="seo_keyword"
                        placeholder="Enter SEO Keyword"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>SEO Description:</Label>
                      <Input
                        type="text"
                        name="seo_description"
                        placeholder="Enter SEO Description"
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
                          id="blog@check"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="blog@check" />
                        <FormattedMessage id="Is Publish" />
                      </div>
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="popular@check"
                          name="is_popular"
                          value="Y"
                        />
                        <Label for="popular@check" />
                        <FormattedMessage id="Is Popular" />
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
