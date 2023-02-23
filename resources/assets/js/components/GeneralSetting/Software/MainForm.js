import React, { Component } from "react";
import axios from "axios";


export default class MainForm extends Component {
    constructor(props) {
    super(props);
    this.state = {
     
    
    };
    

 load_datepicker();
  }

    render() {
        return (
            <div>
                <Row>
                    <Col>
                        <Card>
                            <CardHeader>
                                <CardTitle>Software Management</CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                     id="softwareForm"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "software/store"}
                                >
                                    <FormGroup row>
                                        <Input
                                            type="hidden"
                                            name="id"
                                            defaultValue=""
                                        />
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                Software Name:<code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="softwarename"
                                                placeholder="Software Name"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                       
                                       
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                            Software Version<code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="softwareversion"
                                                placeholder="Software Version"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                        
                                       
                                    </FormGroup>
                                    


                           <FormGroup check inline>            
                        <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input type="checkbox" id="software@check" name="isactive" value="Y" />
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
