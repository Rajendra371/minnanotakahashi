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
 load_ckeditor();
  }

    render() {
        return (
            <div>
                <Row>
                    <Col>
                        <Card>
                            <CardHeader>
                                <CardTitle>Portfolio Category Form</CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                     id="portForm"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "portfolio_category/store"}
                                >
                                    <FormGroup row>
                                        <Input
                                            type="hidden"
                                            name="id"
                                            defaultValue=""
                                        />
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                Category Name:<code>*</code>
                                            </Label>
                                            <Input
                                                type="text"
                                                name="category_name"
                                                placeholder="Enter Category Name"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                       
                                       
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                URL<code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="url"
                                                placeholder="Enter URL"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="12" sm="12" xs="12">
                                            <Label>
                                                Content<code>*</code>:
                                            </Label>
                                            <Input
                                                type="textarea"
                                                name="content"
                                                placeholder="Enter Content"
                                                className="required_field ckeditor"
                                                id="content"
                                                defaultValue=""
                                            />
                                        </Col>
                                       
                                        <Col md="6" sm="6" xs="6">
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
                                            
                        <Col md="6" sm="6" xs="6" className="align-self-end">
                      <div className="checkbox">
                        <Input type="checkbox" id="portfolio@check" name="is_publish" value="Y" />
                        <Label for="portfolio@check"></Label>
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
