import React, { Component } from "react";

class MainForm extends Component {
  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>
                  Social Media Integration
                </CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal socialmedia"
                  id="socialmediaintegrationForm"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "socialmediaintegration/store"}
                >
                  <FormGroup row>
                    <Col md="12" sm="12" xs="12">
                     <div className="checkbox">
                      <Input type="checkbox" id="social_media_integration@check" name="isfb_login" value="Y" />
                      <Label for="social_media_integration@check"></Label>
                      </div>
                      <Label>
                        Facebook App Login:
                        
                      </Label>{" "}
                        <Input
                        type="name"
                        name="fb_appid"
                        placeholder="Enter Facebook APP ID"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="12" sm="12" xs="12">
                    <div className="checkbox">
                        <Input type="checkbox" id="social_media_integration@check1" name="isgoogle_login" value="Y" />
                        <Label for="social_media_integration@check1"></Label>
                      </div>
                        <Label>
                       Google App Login
                        :
                      </Label>{" "}
                      
                      <Input
                        type="name"
                        name="google_appid"
                        placeholder="Enter Google APP ID"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="12" sm="12" xs="12">
                    <div className="checkbox">
                        <Input type="checkbox" id="social_media_integration@check2" name="isgoogle_analytical" value="Y" />
                        <Label for="social_media_integration@check2"></Label>
                      </div>
                      <Label>
                      Google Analytics
                        :
                      </Label>
                      <Input
                        type="name"
                        name="google_analytics"
                        placeholder="Enter Google Analytics ID "
                        className=""
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="12" sm="12" xs="12">
                    <div className="checkbox">
                        <Input type="checkbox" id="social_media_integration@check3" name="islinkedin_login" value="Y" />
                        <Label for="social_media_integration@check3"></Label>
                      </div>
                      <Label>
                      LinkedIn App Login
                        :
                      </Label>
                      <Input
                        type="name"
                        name="linkedin_appid"
                        placeholder="Enter LinkedIn ID
                                               "
                        className=""
                        defaultValue=""
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
                          <i className="fa fa-dot-circle-o" />{" "}
                          <FormattedMessage id="button.save" />
                        </Button>{" "}
                        &nbsp;&nbsp;&nbsp;
                        <Button
                          type="button"
                          size="md"
                          color="danger"
                          className="btnreset"
                        >
                          <i className="fa fa-ban" />{" "}
                          <FormattedMessage id="button.reset" />
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
