import React, { Component } from "react";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      menudatas: "",
    };
    load_ckeditor();
  }
  componentDidMount() {
    axios.get(constvar.api_url + "menu/getmenu").then((response) => {
      if (response.data.status == "success") {
        this.setState({ menudatas: response.data.data });
      } else {
        this.setState({ menudatas: "" });
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
                <CardTitle>Menu</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="menuForm"
                  encType="multipart/form-data"
                  action={constvar.api_url + "menu/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Menu Title
                        <code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="menu_name"
                        id="menu_name"
                        placeholder="Enter Menu Name"
                        className="required_field"
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Alias</Label>
                      <Input
                        type="text"
                        name="menu_slug"
                        id="menu_slug"
                        placeholder="Auto generate from title"
                      />
                    </Col>

                    {/* <Col md="6" sm="6" xs="6">
                      <Label>
                        Parent Item
                        <code>*</code>:
                      </Label>
                      <Input type="select" name="seo_pageid" id="seo_pageid">
                        <option>-- Select Page --</option>
                        {this.state.seo_page.length > 0
                          ? this.state.seo_page.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.page_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col> */}

                    {/* <Col md="6" sm="6" xs="6">
                      <Label>
                        Parent Item
                        <code>*</code>:
                      </Label>
                      <Input type="select" name="menu_parent" id="menu_parent">
                        <option>-- Select Page --</option>
                        <option value="1">Custom</option>
                        <option value="2">Post</option>
                        <option value="3">Page</option>
                        <option value="4">Gallery</option>
                        <option value="5">News</option>
                      </Input>
                    </Col> */}

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        {" "}
                        <FormattedMessage id="Parent Menu" />:{" "}
                      </Label>
                      <div
                        dangerouslySetInnerHTML={{
                          __html: this.state.menudatas,
                        }}
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Menu Item Type
                        <code>*</code>:
                      </Label>
                      <Input type="select" name="menu_typeid" id="menu_typeid">
                        <option>-- Select Page --</option>
                        <option value="custom">Custom</option>
                        <option value="post">Post</option>
                        <option value="page">Page</option>
                        <option value="gallery">Gallery</option>
                        <option value="news">News</option>
                      </Input>
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>URL</Label>
                      <Input
                        type="text"
                        name="menu_url"
                        id="menu_url"
                        placeholder="Enter Menu Url"
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Display Order
                        <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="menu_order"
                        id="menu_order"
                        placeholder="Enter Display Order"
                        className="required_field"
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="publish"
                          name="menu_isactive"
                          value="Y"
                        />
                        <Label for="publish" />
                        <FormattedMessage id="Is Publish" />
                      </div>
                    </Col>

                    <Col md="12" sm="12" xs="12">
                      <Label>
                        Menu Location
                        <code>*</code>:
                      </Label>
                      <FormGroup check inline>
                        <Input
                          className="form-check-input"
                          type="checkbox"
                          id="inline-checkbox1"
                          name="menu_istop"
                          value="Y"
                        />
                        <Label
                          className="form-check-label"
                          check
                          htmlFor="inline-checkbox1"
                        >
                          <FormattedMessage id="Top" />
                        </Label>
                      </FormGroup>
                      <FormGroup check inline>
                        <Input
                          className="form-check-input"
                          type="checkbox"
                          id="inline-checkbox2"
                          name="menu_ismain"
                          value="Y"
                        />
                        <Label
                          className="form-check-label"
                          check
                          htmlFor="inline-checkbox2"
                        >
                          <FormattedMessage id="Main" />
                        </Label>
                      </FormGroup>
                      <FormGroup check inline>
                        <Input
                          className="form-check-input"
                          type="checkbox"
                          id="inline-checkbox3"
                          name="menu_isfooter"
                          value="Y"
                        />
                        <Label
                          className="form-check-label"
                          check
                          htmlFor="inline-checkbox3"
                        >
                          <FormattedMessage id="Footer" />
                        </Label>
                      </FormGroup>
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
