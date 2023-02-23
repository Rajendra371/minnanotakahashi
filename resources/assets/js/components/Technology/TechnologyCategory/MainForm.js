import React, { Component } from "react";
import axios from "axios";

export default class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {};

    load_datepicker();
    // load_ckeditor();
  }

  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>Technology Category Form</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="technologycatForm"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "technology_category/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Category Name:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="cat_name"
                        placeholder="Enter Category Name"
                        className="required_field"
                        defaultValue=""
                      />
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

                    <Col md="12" sm="6" xs="6">
                      <Label>
                        Description<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="description"
                        placeholder="Enter Description"
                        className=""
                        id="content"
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
                        type="text"
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
                          id="technology@check"
                          name="is_active"
                          value="Y"
                        />
                        <Label for="technology@check" />
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
