import React, { Component } from "react";
class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      moduledatas: "",
    };
  }
  componentDidMount() {
    axios.get(constvar.api_url + "module/getmenu").then((response) => {
      if (response.data.status == "success") {
        this.setState({ moduledatas: response.data.data });
      } else {
        this.setState({ moduledatas: "" });
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
                <CardTitle>
                  <FormattedMessage id="module.management" />
                </CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="moduleForm" // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "module/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        {" "}
                        <FormattedMessage id="module.parentmenu" />:{" "}
                      </Label>
                      <div
                        dangerouslySetInnerHTML={{
                          __html: this.state.moduledatas,
                        }}
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="module.menuname" />
                        (Unique) <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="modulekey"
                        placeholder="Menu Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="module.displays" /> <code>*</code>
                        :
                      </Label>
                      <Input
                        type="text"
                        name="displaytext"
                        placeholder="Display Text"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="module.display" />:
                      </Label>
                      <Input
                        type="text"
                        name="displaytextnp"
                        placeholder="Display Text"
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="module.menulink" />
                        <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="modulelink"
                        placeholder=" Menu Link"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="module.menuiconclass" /> :
                      </Label>
                      <Input
                        type="text"
                        name="icon"
                        placeholder="Menu Icon Class"
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="module.menuorder" /> :
                      </Label>
                      <Input
                        type="number"
                        name="order"
                        placeholder="Menu Order"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="common.remarks" />:
                      </Label>
                      <Input
                        type="text"
                        name="remarks"
                        placeholder="Remarks"
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col>
                      <Label>
                        <FormattedMessage id="common.operation" />: &nbsp;
                      </Label>
                      <FormGroup check inline>
                        <Input
                          className="form-check-input"
                          type="checkbox"
                          id="inline-checkbox1"
                          name="isinsert"
                          value="Y"
                        />
                        <Label
                          className="form-check-label"
                          check
                          htmlFor="inline-checkbox1"
                        >
                          <FormattedMessage id="common.insert" />
                        </Label>
                      </FormGroup>
                      <FormGroup check inline>
                        <Input
                          className="form-check-input"
                          type="checkbox"
                          id="inline-checkbox2"
                          name="isview"
                          value="Y"
                        />
                        <Label
                          className="form-check-label"
                          check
                          htmlFor="inline-checkbox2"
                        >
                          <FormattedMessage id="common.view" />
                        </Label>
                      </FormGroup>
                      <FormGroup check inline>
                        <Input
                          className="form-check-input"
                          type="checkbox"
                          id="inline-checkbox3"
                          name="isupdate"
                          value="Y"
                        />
                        <Label
                          className="form-check-label"
                          check
                          htmlFor="inline-checkbox3"
                        >
                          <FormattedMessage id="common.update" />
                        </Label>
                      </FormGroup>
                      <FormGroup check inline>
                        <Input
                          className="form-check-input"
                          type="checkbox"
                          id="inline-checkbox4"
                          name="isdelete"
                          value="Y"
                        />
                        <Label
                          className="form-check-label"
                          check
                          htmlFor="inline-checkbox4"
                        >
                          <FormattedMessage id="common.delete" />
                        </Label>
                      </FormGroup>
                      <FormGroup check inline>
                        <Input
                          className="form-check-input"
                          type="checkbox"
                          id="inline-checkbox5"
                          name="isapproved"
                          value="Y"
                        />
                        <Label
                          className="form-check-label"
                          check
                          htmlFor="inline-checkbox5"
                        >
                          <FormattedMessage id="common.approved" />
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
