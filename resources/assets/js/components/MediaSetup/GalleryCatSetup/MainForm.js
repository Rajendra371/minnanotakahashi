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
                                <CardTitle>Add Gallery Category</CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                     id="gallerycatForm"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "gallery_cat_setup/store"}
                                >
                                    <FormGroup row>
                                        <Input
                                            type="hidden"
                                            name="id"
                                            defaultValue=""
                                        />
                                        <Col md="6" sm="6" xs="12">
                                            <Label>
                                                Category Name:<code>*</code>
                                            </Label>
                                            <Input
                                                type="text"
                                                name="title"
                                                placeholder="Enter Category Name"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                       
                                       
                                        <Col md="6" sm="6" xs="12">
                                            <Label>
                                                Content<code>*</code>:
                                            </Label>
                                            <Input
                                                type="textarea"
                                                name="content"
                                                placeholder="Enter Content"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                       
                                       
                                        <Col md="6" sm="6" xs="12">
                                            <Label>
                                                Meta Title:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="seo_title"
                                                placeholder="Enter Meta Title"
                                                className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="12">
                                            <Label>
                                                Meta Keyword:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="seo_keyword"
                                                placeholder="Enter Meta Keyword"
                                                className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="12">
                                            <Label>
                                                Meta Description:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="seo_description"
                                                placeholder="Enter Meta Description"
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
                        <Input type="checkbox" id="gallery@check" name="is_active" value="Y" />
                        <Label for="gallery@check"></Label>
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
