import React, { Component } from "react";
import axios from "axios";


class MainForm extends Component {
    constructor(props) {
        super(props);
        this.state = {
         menu_id:[],
        }
        load_ckeditor();
        load_datepicker();
      }
      componentDidMount() {
        axios.get(constvar.api_url + "page").then(response => {
          if (response.data.status == "success") {
            // this.setState({ email_configuration: response.data.data['email_protocol'] });
            this.setState({ menu_id: response.data.data['menu'] });
          } else {
            this.setState({ menu_id: "" });
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
                                <CardTitle>Banner Form</CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                     id="bannerForm"
                                     encType="multipart/form-data"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "banner/store"}
                                >
                                    <FormGroup row>
                                        <Input
                                            type="hidden"
                                            name="id"
                                            defaultValue=""
                                        />
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                Banner Heading<code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="heading"
                                                placeholder="Enter Heading"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>

                                    
                      
                                       
                                       
                                        <Col xs="6">
                      <Label>
                        Banner Image
                        <code>*</code>:
                      </Label>
                      <div
                        className="file-upload-wrapper"
                        data-text="Select your image!"
                      >
                        <Input
                          name="file"
                          type="file"
                          className="file-upload-field"
                        />
                      </div>
                    </Col>
                                        <Col md="12" sm="6" xs="6">
                                            <Label>
                                                Banner Content<code>*</code>:
                                            </Label>
                                            <Input
                                                type="textarea"
                                                name="content"
                                                placeholder="Enter Content Here"
                                                  className="ckeditor"
                                                  id="content"
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                      <Label>
                       Button 1 Text
                        :
                      </Label>
                      <Input
                        type="text"
                        name="button_text1"
                        placeholder="Enter Content Here"
                        defaultValue=""
                      />
                    </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                               Button 1 URL:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="button_url1"
                                                placeholder="Enter URL_1 Here"
                                                  className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                               Button 2 Text:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="button_text2"
                                                placeholder="Enter Content Here"
                                                  className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                               Button 2 URL:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="button_url2"
                                                placeholder="Enter Meta Description"
                                                  className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                               Start Date<code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="startdate"
                                                placeholder="YYYY-MM-DD"
                                                className="required_field datepicker"
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                               End Date<code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="enddate"
                                                placeholder="YYYY-MM-DD"
                                                className="required_field datepicker"
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
                                       
                                       
                                       
                                    </FormGroup>
                                    


                           <FormGroup row>            
                        <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input type="checkbox" id="banner@check" name="is_publish" value="Y" />
                        <Label for="banner@check"></Label>
                        <FormattedMessage id="Is Publish" />
                      </div>
                    </Col>

                   
                               
                        <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input type="checkbox" id="banner@unlimited" name="is_unlimited" value="Y" />
                        <Label for="banner@unlimited"></Label>
                        <FormattedMessage id="Is Unlimited" />
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
export default MainForm;
