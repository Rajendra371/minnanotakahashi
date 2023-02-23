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
    axios.get(constvar.api_url + "technology_description").then((response) => {
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
                <CardTitle>Technology Description</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="technologyForm"
                  encType="multipart/form-data"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "technology_description/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Technology Category:
                        <code>*</code>
                      </Label>
                      <Input
                        type="select"
                        name="technology_catid"
                        id="technology_catid"
                      >
                        <option>-- Select Category --</option>
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
                        Code:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="code"
                        placeholder="Enter Code"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Technology Title:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="title"
                        placeholder="Enter Technology Title Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Slug:</Label>
                      <Input type="text" name="slug" defaultValue="" />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Icon Name:</Label>
                      <Input
                        type="text"
                        name="icon"
                        placeholder="Enter Icon Name"
                        className=""
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Icon Type:</Label>
                      <Input type="select" name="icon_type" id="icon_type">
                        <option value="icon">Icon</option>
                        <option value="image">Image</option>
                      </Input>
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

                    <Col xs="12">
                      <Label>
                        Short Description<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="short_description"
                        placeholder="Enter Short Description"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="12" sm="6" xs="6">
                      <Label>
                        Description<code>*</code>:
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
                          id="tech@check"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="tech@check" />
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
