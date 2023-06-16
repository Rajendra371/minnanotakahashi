import React, { Component } from "react";
import axios from "axios";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      advertisement_location: [],
      ad_locationid: [],
      ad_page_id: [],

      location_name: "",
      id: "",
    };
    load_ckeditor();

    load_datepicker();
    //load_current_date();
  }
  componentDidMount() {
    axios.get(constvar.api_url + "advertisement").then((response) => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({ ad_locationid: response.data.data["adv_loc"] });
        this.setState({ ad_page_id: response.data.data["menu"] });
      } else {
        this.setState({ ad_locationid: "" });
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
                <CardTitle>Advertisement Form</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="contractForm"
                  encType="multipart/form-data"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "advertisement/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Menu Page
                        <code>*</code>
                      </Label>
                      <Input type="select" name="ad_page_id" id="ad_page_id">
                        <option>-- Select Page --</option>
                        {this.state.ad_page_id.length > 0
                          ? this.state.ad_page_id.map((datas) => {
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
                        Location
                        <code>*</code>
                      </Label>
                      <Input
                        type="select"
                        name="ad_locationid"
                        id="ad_locationid"
                      >
                        <option>-- Select Location --</option>
                        {this.state.ad_locationid.length > 0
                          ? this.state.ad_locationid.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.locname}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Title:</Label>
                      <Input
                        type="text"
                        name="title"
                        placeholder="Title"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col xs="6">
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
                    <Col md="12" sm="6" xs="6">
                      <Label>
                        Content<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="content"
                        placeholder="content"
                        className="ckeditor"
                        id="content"
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Start Date<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="startdate"
                        placeholder="YYYY-MM-DD"
                        className="form-control required_field datepicker"
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
                        placeholder="YYYY-MM-DD"
                        className="form-control required_field datepicker"
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
                          id="advertisement@check"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="advertisement@check" />
                        <FormattedMessage id="Publish" />
                      </div>
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="advertisement@unlimited"
                          name="is_unlimited"
                          value="Y"
                        />
                        <Label for="advertisement@unlimited" />
                        <FormattedMessage id="Unlimited" />
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
