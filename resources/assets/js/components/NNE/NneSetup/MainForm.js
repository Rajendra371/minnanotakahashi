import React, { Component } from "react";
import axios from "axios";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      menu_id: [],
      category: [],
    };
    load_ckeditor();
    load_datepicker();
  }
  componentDidMount() {
    axios.get(constvar.api_url + "nne_setup").then((response) => {
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
                <CardTitle>NNE Form</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="nneForm"
                  encType="multipart/form-data"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "nne_setup/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        NNE Category:
                        <code>*</code>
                      </Label>
                      <Input
                        type="select"
                        name="category_typeid"
                        id="category_typeid"
                      >
                        <option>-- Select NNE Category --</option>
                        {this.state.category.length > 0
                          ? this.state.category.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.category_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
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
                    <Col md="12" sm="6" xs="6">
                      <Label>
                        Description<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="description"
                        placeholder="Enter Description Here"
                        className="ckeditor"
                        id="description"
                        defaultValue=""
                      />
                    </Col>

                    <Col xs="6">
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
                      <Label>Icon :</Label>
                      <Input
                        type="text"
                        name="icon"
                        placeholder="Enter Icon Here"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Start Date<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="startdate"
                        placeholder=""
                        className="required_field datepicker"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        End Date<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="enddate"
                        placeholder=""
                        className="required_field datepicker"
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
                          id="banner@check"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="banner@check" />
                        <FormattedMessage id="Is Publish" />
                      </div>
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="banner@unlimited"
                          name="is_unlimited"
                          value="Y"
                        />
                        <Label for="banner@unlimited" />
                        <FormattedMessage id="Is Unlimited" />
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
