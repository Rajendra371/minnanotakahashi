import React, { Component } from "react";
import RadioButton from "./RadioButton";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      information: [],
      webstatus: "OFF",
      site_status: "",
      timezone: "",
      site_url: "",
    };
  }

  componentDidMount() {
    axios.get(constvar.api_url + "sitesetting").then((response) => {
      if (response.data.status == "success") {
        this.setState({ information: response.data.data["detail"][0] });
        this.setState({ site_url: response.data.data["site_url"] });
        $("#default_time_zone").html(response.data.data["timezone"]);
      } else {
        this.setState({ information: [] });
        $("#default_time_zone").html("");
      }
    });

    load_datepicker();
    load_select2();
  }

  radioChangeHandler = (event) => {
    this.setState({
      webstatus: event.target.value,
    });
  };

  render() {
    const settings = this.state.information;
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>
                  <FormattedMessage id="sitesetting" />
                </CardTitle>
              </CardHeader>
              <CardBody>
                {/* <a
                  href="javascript:void(0)"
                  id="autoclick"
                  className="btnEdit"
                  data-url={constvar.api_url + "sitesetting/edit"}
                  data-id="1"
                  data-targetform="sitesettingForm"
                /> */}
                <Form
                  className="form-horizontal"
                  id="sitesettingForm"
                  encType="multipart/form-data"
                  action={constvar.api_url + "sitesetting/store"}
                >
                  <div className="sitesetting-title">General Information</div>
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue={settings.id} />
                    <Col md="4" sm="6" xs="12" lg="3">
                      <Label>
                        Company Name
                        <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="organization_name"
                        placeholder="Company Name"
                        className="required_field"
                        defaultValue={settings.organization_name}
                      />
                    </Col>
                    <Col md="4" sm="6" xs="12" lg="3">
                      <Label>
                        Company Slogan
                        <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="slogan"
                        placeholder="Company Slogan"
                        className=""
                        defaultValue={settings.slogan}
                      />
                    </Col>
                    <Col md="3" sm="6" xs="12" lg="3">
                      <Label>Company Logo:</Label>

                      <div
                        className="file-upload-wrapper"
                        data-text="Select Company Logo"
                      >
                        <Input
                          name="file"
                          type="file"
                          className="file-upload-field"
                        />
                      </div>
                    </Col>

                    <Col md="3" sm="6" xs="12" lg="3">
                      {settings.logo ? (
                        <img
                          src={`${this.state.site_url}/${settings.logo}`}
                          style={aStyle}
                        />
                      ) : (
                        ""
                      )}
                    </Col>

                    <Col md="4" sm="6" xs="12" lg="3">
                      <Label>
                        Address 1<code>*</code>
                      </Label>
                      <Input
                        type="text"
                        name="address1"
                        placeholder="Company Address 1"
                        className="required_field"
                        defaultValue={settings.address1}
                      />
                    </Col>

                    <Col md="4" sm="6" xs="12" lg="3">
                      <Label>Address 2</Label>
                      <Input
                        type="text"
                        name="address2"
                        placeholder="Company Address 2"
                        className=""
                        defaultValue={settings.address2}
                      />
                    </Col>

                    <Col md="4" sm="6" xs="12" lg="3">
                      <Label>Opening Days</Label>
                      <Input
                        type="text"
                        name="opening_days"
                        placeholder="Office Opening Days"
                        className=""
                        defaultValue={settings.opening_days}
                      />
                    </Col>

                    <Col md="4" sm="6" xs="12" lg="3">
                      <Label>Opening Time</Label>
                      <Input
                        type="text"
                        name="opening_time"
                        placeholder="Office Opening Time"
                        className=""
                        defaultValue={settings.opening_time}
                      />
                    </Col>
                    {/* <Col lg="4" md="4" sm="6" xs="12" lg="3">
                      <Label>Website Mode</Label>
                      <div className="radio-group" style={{ display: "flex" }}>
                        <RadioButton
                          onChange={this.radioChangeHandler}
                          id="ON"
                          isSelected={this.state.webstatus === "1"}
                          label="ON"
                          name="site_status"
                          value="1"
                          checked={settings.status == "1" ? "checked" : ""}
                        />

                        <RadioButton
                          onChange={this.radioChangeHandler}
                          id="M"
                          isSelected={this.state.webstatus === "3"}
                          label="M"
                          name="site_status"
                          value="3"
                          checked={settings.status == 3 ? "checked" : ""}
                        />

                        <RadioButton
                          onChange={this.radioChangeHandler}
                          id="OFF"
                          isSelected={this.state.webstatus === "2"}
                          label="OFF"
                          name="site_status"
                          value="2"
                          checked={settings.status == 2 ? "checked" : ""}
                        />
                      </div>
                    </Col>

                    <Col
                      md="4"
                      sm="6"
                      xs="12"
                      lg="3"
                      style={
                        this.state.webstatus === "3"
                          ? { display: "block" }
                          : { display: "none" }
                      }
                    >
                      <Label>Maintenance Key</Label>
                      <Input
                        type="text"
                        name="maintenance_key"
                        placeholder="Enter Maintenance Key"
                        className=""
                        defaultValue={settings.maintenance_key}
                      />
                    </Col> */}
                  </FormGroup>
                  <div className="sitesetting-title">Contact Information</div>
                  <FormGroup row>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>
                        Phone Number
                        <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="phone"
                        placeholder="Phone Number"
                        className=""
                        defaultValue={settings.phone}
                      />
                    </Col>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>
                        Mobile Number
                        <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="mobile"
                        placeholder="Mobile No."
                        className=""
                        defaultValue={settings.mobile}
                      />
                    </Col>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>Phone Number 2:</Label>
                      <Input
                        type="text"
                        name="phone2"
                        placeholder="Phone Number 2"
                        className=""
                        defaultValue={settings.phone2}
                      />
                    </Col>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>Mobile Number 2:</Label>
                      <Input
                        type="text"
                        name="mobile2"
                        placeholder="Mobile No.2"
                        className=""
                        defaultValue={settings.mobile2}
                      />
                    </Col>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>
                        Company Email
                        <code>*</code>:
                      </Label>
                      <Input
                        type="email"
                        name="email"
                        placeholder="john@example.com"
                        className="required_field"
                        defaultValue={settings.email}
                      />
                    </Col>

                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>Contact Person:</Label>
                      <Input
                        type="text"
                        name="contact_person"
                        placeholder="Contact Person Name"
                        className=""
                        defaultValue={settings.contact_person}
                      />
                    </Col>
                  </FormGroup>
                  <div className="sitesetting-title">Social Media Links</div>
                  <FormGroup row>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>Company Facebook :</Label>
                      <Input
                        type="text"
                        name="facebook_link"
                        placeholder="Facebook Link"
                        className=""
                        defaultValue={settings.facebook_link}
                      />
                    </Col>

                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>Company Google :</Label>
                      <Input
                        type="text"
                        name="google_link"
                        placeholder="Google Link"
                        className=""
                        defaultValue={settings.google_link}
                      />
                    </Col>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>Company Link :</Label>
                      <Input
                        type="text"
                        name="linkedin_link"
                        placeholder="Linkedin Link"
                        className=""
                        defaultValue={settings.linkedin_link}
                      />
                    </Col>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>Company Twitter :</Label>
                      <Input
                        type="text"
                        name="twitter_link"
                        placeholder="Twitter Link"
                        className=""
                        defaultValue={settings.twitter_link}
                      />
                    </Col>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>Company Instagram :</Label>
                      <Input
                        type="text"
                        name="instagram_link"
                        placeholder="Instagram Link"
                        className=""
                        defaultValue={settings.instagram_link}
                      />
                    </Col>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>Company Youtube :</Label>
                      <Input
                        type="text"
                        name="youtube_link"
                        placeholder="Youtube Link"
                        className=""
                        defaultValue={settings.youtube_link}
                      />
                    </Col>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>Company Tiktok :</Label>
                      <Input
                        type="text"
                        name="tiktok_link"
                        placeholder="Tiktok Link"
                        className=""
                        defaultValue={settings.tiktok_link}
                      />
                    </Col>
                  </FormGroup>
                  <div className="sitesetting-title">Other Settings</div>
                  <FormGroup row>
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>
                        <FormattedMessage id="company.timezone" />:{" "}
                      </Label>

                      <Input
                        type="select"
                        name="default_time_zone"
                        id="default_time_zone"
                        className="select2"
                      />
                    </Col>
                    {/* <Col md="4" sm="4" xs="12" lg="3">
                      <Label>
                        <FormattedMessage id="company.currency" />:{" "}
                        
                      </Label>
                      <Input
                        type="select"
                        name="site_setting@currency"
                        defaultValue=""
                        id="select2"
                      >
                        <option>--Select Currency--</option>
                      </Input>
                    </Col> */}
                    <Col md="4" sm="4" xs="12" lg="3">
                      <Label>Currency :</Label>
                      <Input
                        type="text"
                        name="default_currency"
                        placeholder="Currency"
                        className=""
                        defaultValue={settings.default_currency}
                      />
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
                          <i className="fa fa-dot-circle-o" /> Update
                        </Button>{" "}
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

const aStyle = {
  width: 100,
  height: 100,
};
