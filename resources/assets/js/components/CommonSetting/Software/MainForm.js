import React, { Component } from "react";

class MainForm extends Component {
    render() {
        return (
            <div>
                <Row>
                    <Col>
                        <Card>
                            <CardHeader>
                                <CardTitle><FormattedMessage id="software.management" /></CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                    id="softwareForm"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "cstore"}
                                >
                                    <FormGroup row>
                                        {/* <Input
                                            type="hidden"
                                            name="software@id"
                                            defaultValue=""
                                        /> */}
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                <FormattedMessage id="software.name" /><code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="software@softwarename"
                                                placeholder="Software Name"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                        {/* <Col md="6" sm="6" xs="6">
                                            <Label>
                                               <FormattedMessage id="software.type" />:<code>*</code>:
                                            </Label>
                                            <Input
                                                type="select"
                                                name="software@softwaretype"
                                                defaultValue=""
                                                id="select"
                                            >
                                                <option value="0">--Select--</option>
                                            </Input>
                                        </Col> */}
                                    </FormGroup>
                                    <FormGroup row>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                <FormattedMessage id="software.version" /><code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="software@softwareversion"
                                                placeholder="Software Version"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                        {/* <Col md="6" sm="6" xs="6">
                      <Label>
                        <FormattedMessage id="software.logo" />
                        <code>*</code>:
                      </Label>
                      <div
                        className="file-upload-wrapper"
                        data-text="Select Software Logo"
                      >
                        <Input
                          name="software@logo"
                          type="file"
                          className="file-upload-field required_field"
                          value=""
                        />
                      </div>
                    </Col> */}
                    </FormGroup>
                    <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input type="checkbox" id="software@check" name="software@is_active" value="Y" />
                        <Label for="software@check"></Label>
                        <FormattedMessage id="Active" />
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
                                                    <i className="fa fa-dot-circle-o" />{" "}
                                                     <FormattedMessage id="button.save"/>
                                                </Button>{" "}
                                                &nbsp;&nbsp;&nbsp;
                                                <Button
                                                    type="button"
                                                    size="md"
                                                    color="danger"
                                                    className="btnreset"
                                                >
                                                    <i className="fa fa-ban" />{" "}
                                                     <FormattedMessage id="button.reset"/>
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
