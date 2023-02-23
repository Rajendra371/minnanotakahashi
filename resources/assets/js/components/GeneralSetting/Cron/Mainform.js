import React, { Component } from "react";
import axios from "axios";


export default class MainForm extends Component {
    constructor(props) {
    super(props);
    this.state = {
     
    
    };
    // this.handleOther = this.handleOther.bind(this);
    // this.onFileUpload = this.onFileUpload.bind(this)

 load_datepicker();
  }

    render() {
        return (
            <div>
                <Row>
                    <Col>
                        <Card>
                            <CardHeader>
                                <CardTitle>Cron Setup Form</CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                     id="cronForm"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "cron/store"}
                                >
                                    <FormGroup row>
                                        <Input
                                            type="hidden"
                                            name="id"
                                            defaultValue=""
                                        />
                                        <Col md="6" sm="6" xs="12">
                                            <Label>
                                                Cron Title:<code>*</code>
                                            </Label>
                                            <Input
                                                type="text"
                                                name="cron_name"
                                                placeholder="Cron Title"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                       
                                       
                                        <Col md="6" sm="6" xs="12">
                                            <Label>
                                                Cron Code:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="cron_code"
                                                placeholder="Cron Code"
                                                className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="12" sm="6" xs="12">
                                            <Label>
                                                Cron Description<code>*</code>:
                                            </Label>
                                            <Input
                                                type="textarea"
                                                name="cron_description"
                                                placeholder="Cron Description"
                                                className="required_field"
                                                id="cron_description"
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="12">
                                            <Label>
                                                Cron URL:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="cron_url"
                                                placeholder="Cron URL"
                                                className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                       
                                       
                                        <Col md="6" sm="6" xs="12">
                                            <Label>
                                                Order:
                                            </Label>
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
                        <Col md="6" sm="6" xs="12">
                      <div className="checkbox">
                        <Input type="checkbox" id="cron@check" name="is_active" value="Y" />
                        <Label for="advertisement@check"></Label>
                        <FormattedMessage id="Is Active" />
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
                                                    Save
                                                </Button>{" "}
                                                &nbsp;&nbsp;&nbsp;
                                                <Button
                                                    type="button"
                                                    size="md"
                                                    color="danger"
                                                    className="btnreset"
                                                >
                                                    <i className="fa fa-ban" />{" "}
                                                    Reset
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
