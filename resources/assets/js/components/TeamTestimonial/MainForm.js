import React, { Component } from "react";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {};
    load_ckeditor();
    load_datepicker();
  }
  onChange = (e) => {
    this.setState({ [e.target.name]: e.target.value });
    console.log(e.target.value);
  };

  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>Team/Testimonial Form</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="teamForm"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "teamtestimonial/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Name:<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="name"
                        placeholder="Enter Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Designation<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="designation"
                        placeholder="Enter Designation"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Type:</Label>
                      <Input type="select" name="type" id="type">
                        <option value="1">Team</option>
                        <option value="2">Testinomials</option>
                        <option value="3">Message</option>
                      </Input>
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Address:</Label>
                      <Input
                        type="text"
                        name="address"
                        placeholder="Enter Address"
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
                    <Col xs="12">
                      <Label>
                        Testimonial / About Me
                        <code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="description"
                        placeholder="Enter Testemonial Here"
                        className="ckeditor"
                        id="description"
                        defaultValue=""
                      />
                    </Col>
                    <Col xs="12">
                      <Label>Skills</Label>
                      <Input
                        type="textarea"
                        name="skills"
                        placeholder="Enter Skills Here"
                        className="ckeditor"
                        id="skills"
                        defaultValue=""
                      />
                    </Col>
                    <Col xs="12">
                      <Label>What I do ?</Label>
                      <Input
                        type="textarea"
                        name="experience"
                        placeholder="Enter experience Here"
                        className="ckeditor"
                        id="experience"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Contact<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="contactno"
                        placeholder="Enter Phone No"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Email<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="email"
                        placeholder="Enter Email"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Facebook Link:</Label>
                      <Input
                        type="text"
                        name="facebook_link"
                        placeholder="Enter Facebook Link"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Twitter Link:</Label>
                      <Input
                        type="text"
                        name="twitter_link"
                        placeholder="Enter Twitter Link"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Linkedin Link:</Label>
                      <Input
                        type="text"
                        name="linkedin_link"
                        placeholder="Enter Linkedin Link"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Youtube Link:</Label>
                      <Input
                        type="text"
                        name="youtube_link"
                        placeholder="Enter Youtube Link"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>Instagram Link:</Label>
                      <Input
                        type="text"
                        name="instagram_link"
                        placeholder="Enter Instagram Link"
                        className=""
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>Order:</Label>
                      <Input
                        type="number"
                        name="order"
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
                          id="out_team@check"
                          name="isactive"
                          value="Y"
                        />
                        <Label for="out_team@check" />
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
