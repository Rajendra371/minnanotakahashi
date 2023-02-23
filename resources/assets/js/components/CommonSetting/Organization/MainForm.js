import React, { Component } from "react";

class MainForm extends Component {
    render() {
        return (
            <div>
                <Row>
                    <Col>
                        <Card>
                            <CardHeader>
                                <CardTitle><FormattedMessage id="organization.management" /></CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                    id="organizationForm"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "cstore"}
                                >
                                    <FormGroup row>
                                        {/* <Input
                                            type="hidden"
                                            name="organization@id"
                                            defaultValue=""
                                        /> */}
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                <FormattedMessage id="organization.name" /><code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="organization@orgname"
                                                placeholder="Organization Name"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                <FormattedMessage id="organization.contact" /><code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="organization@contact"
                                                placeholder="Contact Number"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                    </FormGroup>
                                    <FormGroup row>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                <FormattedMessage id="organization.address" />1<code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="organization@orgaddress1"
                                                placeholder="Current Address"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                               <FormattedMessage id="organization.address" />2<code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="organization@orgaddress2"
                                                placeholder="Primary Address"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                    </FormGroup>
                                    <FormGroup row>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                <FormattedMessage id="organization.email" /><code>*</code>:
                                            </Label>
                                            <Input
                                                type="email"
                                                name="organization@email"
                                                placeholder="john@example.com"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                               <FormattedMessage id="organization.website" /><code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="organization@website"
                                                placeholder="Website"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                    </FormGroup>
                                    <FormGroup check inline>
                                        <Input
                                            className="form-check-input"
                                            type="checkbox"
                                            id="inline-checkbox"
                                            name="organization@isactive"
                                            value="Y"
                                        />
                                        <Label
                                            className="form-check-label"
                                            check
                                            htmlFor="inline-checkbox"
                                        >
                                           <FormattedMessage id="organization.status" />
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
                                    
