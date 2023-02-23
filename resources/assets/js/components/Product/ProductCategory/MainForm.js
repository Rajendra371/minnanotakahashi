import React, { Component } from "react";
import axios from "axios";

export default class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      parentcat: "",
    };

    load_ckeditor();
    load_datepicker();
  }
  componentDidMount() {
    axios
      .get(constvar.api_url + "product_category/get_parentcat")
      .then((response) => {
        if (response.data.status == "success") {
          this.setState({ parentcat: response.data.data });
        } else {
          this.setState({ parentcat: "" });
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
                <CardTitle>Product Category Form</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="productcatForm"
                  action={constvar.api_url + "product_category/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />

                    <Col md="6" sm="6" xs="6">
                      <Label> Parent Category: </Label>

                      <div
                        dangerouslySetInnerHTML={{
                          __html: this.state.parentcat,
                        }}
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Category Name<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="category_name"
                        placeholder="Category Name"
                        className="required_field"
                        id="category_name"
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Category Code:</Label>
                      <Input
                        type="text"
                        name="category_code"
                        placeholder="Category Code"
                        id="category_code"
                        readOnly
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Icon:</Label>
                      <Input
                        type="text"
                        name="icon"
                        placeholder="Enter Icon "
                        className=""
                      />
                    </Col>
                    <Col md="12" sm="12" xs="12">
                      <Label>Description:</Label>
                      <Input
                        type="textarea"
                        name="category_description"
                        placeholder="Description"
                        id="category_description"
                        className="ckeditor"
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Image:</Label>
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

                    {/* <Col md="6" sm="6" xs="6">
                      <Label>Sales Percent:</Label>
                      <Input
                        type="text"
                        name="sales_percent"
                        placeholder="Enter Sales Discount Percent"
                        className=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Sales Start Date:</Label>
                      <Input
                        type="text"
                        name="sales_start_datead"
                        id="sales_start_date"
                        placeholder="YYYY-MM-DD"
                        className="datepicker"
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Sales End Date:</Label>
                      <Input
                        type="text"
                        name="sales_end_datead"
                        id="sales_end_date"
                        placeholder="YYYY-MM-DD"
                        className="datepicker"
                      />
                    </Col> */}
                    <Col md="6" sm="6" xs="6">
                      <Label>Meta Keyword:</Label>
                      <Input
                        type="text"
                        name="meta_keyword"
                        placeholder="Enter Meta Keyword Here "
                        className=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Meta Title:</Label>
                      <Input
                        type="text"
                        name="meta_title"
                        placeholder="Enter Meta Title Here "
                        className=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Meta Description:</Label>
                      <Input
                        type="text"
                        name="meta_description"
                        placeholder="Enter Meta Description "
                        className=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Display Order:</Label>
                      <Input
                        type="number"
                        name="order"
                        placeholder="Order"
                        className=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="product@check"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="product@check" />
                        <FormattedMessage id="Is Publish" />
                      </div>
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="product@is_featured"
                          name="is_featured"
                          value="Y"
                        />
                        <Label for="product@is_featured" />
                        <FormattedMessage id="Is Featured" />
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
$(document).off("keyup", "#category_name");
$(document).on("keyup", "#category_name", function(e) {
  let cat_name = $("#category_name").val();
  if (cat_name !== undefined || cat_name !== "") {
    let cat_code = cat_name.toLowerCase();
    cat_code = cat_code.replace(/\s/g, "");
    $("#category_code").val(cat_code);
  }
});
