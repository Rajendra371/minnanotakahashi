import React, { Component } from "react";
class MainForm extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>
                  {" "}
                  <FormattedMessage id="group.management" />
                </CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="usergroupForm"
                  action={constvar.api_url + "usergroup/store"}
                >
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Input type="hidden" name="id" defaultValue="" />
                      <Label>
                        <FormattedMessage id="group.name" />
                        <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="groupname"
                        placeholder="Group Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Label>
                        {" "}
                        <FormattedMessage id="group.code" />:
                      </Label>
                      <Input
                        type="text"
                        name="groupcode"
                        placeholder="Group Code"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        {" "}
                        <FormattedMessage id="common.remarks" />:
                      </Label>
                      <Input
                        type="textarea"
                        name="remarks"
                        placeholder="Remarks"
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup check inline>
                    <Input
                      className="form-check-input"
                      type="checkbox"
                      id="inline-checkbox"
                      name="isactive"
                      value="Y"
                    />
                    <Label>
                      <span>Is Active</span>
                    </Label>
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
