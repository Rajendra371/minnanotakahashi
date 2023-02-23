import React, { Component } from "react";

class MainForm extends Component {
    constructor(props) {
        super(props);
        this.state = {
            location_data: [],
        };
    }
    componentDidMount() {
        axios.get(constvar.api_url + "location").then(response => {
            if (response.data.status == 'success') {
                this.setState({ location_data: response.data.data });
            }
            else {
                this.setState({ location_data: '' });
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
                                <CardTitle> <FormattedMessage id="location.form" /></CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                    id="locationForm"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "cstore"}
                                >
                                    <FormGroup row>
                                        {/* <Input
                                            type="hidden"
                                            name="id"
                                            defaultValue=""
                                        /> */}
                                        <Col md="6" sm="6" xs="6">
                                            <Label> <FormattedMessage id="location.parent" />:</Label>
                                            <Input
                                                type="select"
                                                name="location@parentloc_id"
                                                defaultValue=""
                                                id="select"
                                            >
                                                <option value='0'>
                                                    --Select--
                                                    </option>
                                                {this.state.location_data.map(
                                                    datas => {
                                                        return (
                                                            <option
                                                                key={
                                                                    datas.id
                                                                }
                                                                value={
                                                                    datas.id
                                                                }
                                                            >
                                                                {datas.locname}
                                                            </option>
                                                        );
                                                    }
                                                )}
                                            </Input>
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                 <FormattedMessage id="location.name" />:<code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="location@locname"
                                                placeholder="Location Name"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                    </FormGroup>
                                    <FormGroup row>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                 <FormattedMessage id="location.address" />:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="location@locaddress"
                                                placeholder="Location Address"
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
