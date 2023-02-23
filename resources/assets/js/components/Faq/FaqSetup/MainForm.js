import React, { Component } from "react";
import axios from "axios";


export default class MainForm extends Component {
    constructor(props) {
    super(props);
    this.state = {
        faq_categoryid:[],
     
    
    };
    // this.handleOther = this.handleOther.bind(this);
    // this.onFileUpload = this.onFileUpload.bind(this)

 load_datepicker();
 load_ckeditor();
  }
  componentDidMount() {
    axios.get(constvar.api_url + "faq_setup").then(response => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({ faq_categoryid: response.data.data['faq_cat'] });
      } else {
        this.setState({ faq_categoryid: "" });
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
                                <CardTitle>FAQ Setup Form</CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                     id="faqsetForm"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "faq_setup/store"}
                                >
                                    <FormGroup row>
                                        <Input
                                            type="hidden"
                                            name="id"
                                            defaultValue=""
                                        />
                                           <Col md="6" sm="6" xs="6">
                      <Label>
                        FAQ Category
                        <code>*</code>
                      </Label>
                      <Input
                        type="select"
                        name="faq_categoryid"
                        id="faq_categoryid"
                      >
                        <option>-- Select Category --</option>
                        { this.state.faq_categoryid.length >0 ? (
                        this.state.faq_categoryid.map(datas => {
                          return (
                            <option key={datas.id} value={datas.id}>
                              {datas.category_name}
                            </option>
                          );
                        }) ): ''}
                      </Input>
                    </Col>
                                       
                                       
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                Title<code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="title"
                                                placeholder="Enter FAQ Title"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="12" sm="6" xs="6">
                                            <Label>
                                                Description<code>*</code>:
                                            </Label>
                                            <Input
                                                type="textarea"
                                                name="description"
                                                placeholder="Enter FAQ Description"
                                                className="ckeditor"
                                                id="description"
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
                        <Input type="checkbox" id="faqsetup@check" name="is_publish" value="Y" />
                        <Label for="faqsetup@check"></Label>
                        <FormattedMessage id="Active" />
                      </div>
                    </Col>
                                       
                                    </FormGroup>
                                    


                           {/* <FormGroup check inline>            
                       
                      
                      </FormGroup> */}
                                    
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
