import React, { Component } from "react";

export default class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      product_category: [],
    };

    load_datepicker();
    load_ckeditor();
  }

  componentDidMount() {
    axios.get(constvar.api_url + "ourproduct").then((response) => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({
          product_category: response.data.data["product_category"],
        });
      } else {
        this.setState({ product_category: "" });
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
                <CardTitle>Product</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="ourproductForm"
                  encType="multipart/form-data"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "ourproduct/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Product Category:
                        <code>*</code>
                      </Label>
                      <Input
                        type="select"
                        name="product_catid"
                        id="product_catid"
                      >
                        <option>-- Select Category --</option>
                        {this.state.product_category.length > 0
                          ? this.state.product_category.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.ourproduct_cat}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Name:<code>*</code>
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
                      <Input type="text" name="slug" defaultValue="" readonly />
                    </Col>

                    <Col xs="12">
                      <Label>
                        Short Content<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="short_description"
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
                        name="description"
                        placeholder="Enter Content"
                        className="ckeditor"
                        id="description"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="12" sm="6" xs="6">
                      <Label>
                        Features<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="features"
                        placeholder="Enter Features"
                        className="ckeditor"
                        id="features"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Customer:</Label>
                      <Input
                        type="text"
                        name="customer"
                        placeholder="Enter Customer"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Website:</Label>
                      <Input
                        type="text"
                        name="website"
                        placeholder="Enter Website"
                        className=""
                        defaultValue=""
                      />
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
                          id="ourproduct@check"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="ourproduct@check" />
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
