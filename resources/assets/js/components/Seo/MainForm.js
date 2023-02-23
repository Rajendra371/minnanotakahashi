import React, { Component } from "react";
import axios from "axios";


class MainForm extends Component {
    constructor(props) {
    super(props);
    this.state = {
     
    seo_page:[],
    };
    // this.handleOther = this.handleOther.bind(this);
    // this.onFileUpload = this.onFileUpload.bind(this)

 load_datepicker();
  }
  onChange = (e) => {
    this.setState( {[e.target.name] : e.target.value });
    console.log(e.target.value);
}

componentDidMount() {
    axios.get(constvar.api_url + "seo").then(response => {
      if (response.data.status == "success") {
        this.setState({ seo_page: response.data.data['seo_page'] });
      } else {
        this.setState({ seo_page: "" });
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
                                <CardTitle>Seo Form</CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                     id="seoForm"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "seo/store"}
                                >
                                    <FormGroup row>
                                        <Input
                                            type="hidden"
                                            name="id"
                                            defaultValue=""
                                        />

<Col md="6" sm="6" xs="6">
                      <Label>
                        SEO Page
                        <code>*</code>:
                      </Label>
                      <Input
                        type="select"
                        name="seo_pageid"
                        id="seo_pageid"
                      >
                        <option>-- Select Page --</option>
                        { this.state.seo_page.length >0 ? (
                        this.state.seo_page.map(datas => {
                          return (
                            <option key={datas.id} value={datas.id}>
                              {datas.page_name}
                            </option>
                          );
                        }) ): ''}
                      </Input>
                    </Col>

                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                Title:<code>*</code>
                                            </Label>
                                            <Input
                                                type="text"
                                                name="seo_title"
                                                placeholder="Enter Title"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                      
                                       
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                SEO Meta Keyword:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="seo_metakeyword"
                                                placeholder="Enter SEO Meta Keyword"
                                                className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                SEO Meta Description:
                                            </Label>
                                            <Input
                                                type="textarea"
                                                name="seo_metadescription"
                                                placeholder="Enter SEO Meta Description"
                                                 className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                Schema 1:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="schema1"
                                                placeholder="Enter Schema1"
                                                  className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                Schema 2:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="schema2"
                                                placeholder="Enter Schema2"
                                                  className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                       
                                    </FormGroup>
                                    


                           <FormGroup row>            
                        <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input type="checkbox" id="seo@check" name="isactive" value="Y" />
                        <Label for="seo@check"></Label>
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
export default MainForm;
