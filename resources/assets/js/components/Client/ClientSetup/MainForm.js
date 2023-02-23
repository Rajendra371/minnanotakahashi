import React, { Component } from "react";
import axios from "axios";


class MainForm extends Component {
    constructor(props) {
        super(props);
        this.state = {
         category:[],
        }
        load_ckeditor();
      }
      componentDidMount() {
        axios.get(constvar.api_url + "client").then(response => {
          if (response.data.status == "success") {
            // this.setState({ email_configuration: response.data.data['email_protocol'] });
            this.setState({ category: response.data.data['category'] });
          } else {
            this.setState({ category: "" });
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
                                <CardTitle>Client Form</CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                     id="clientForm"
                                     encType="multipart/form-data"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "client/store"}
                                >
                                    <FormGroup row>
                                        <Input
                                            type="hidden"
                                            name="id"
                                            defaultValue=""
                                        />
                                        <Col md="6" sm="6" xs="6">
                      <Label>
                        Client category
                        <code>*</code>
                      </Label>
                      <Input
                        type="select" 
                        name="client_catid"
                        id="client_catid"
                      >
                        <option>-- Select Category --</option>
                        { this.state.category.length >0 ? (
                        this.state.category.map(datas => {
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
                                                client Name:<code>*</code>
                                            </Label>
                                            <Input
                                                type="text"
                                                name="client_name"
                                                placeholder="Enter Name"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>

                                     
                      
                                       
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                URL:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="url"
                                                placeholder="Enter URL"
                                                className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                      <Label>
                       Icon
                        :
                      </Label>
                      <Input
                        type="text"
                        name="icon"
                        placeholder="Enter Icon"
                        
                      />
                    </Col>
                                        <Col xs="12">
                      <Label>
                        Logo
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
                                                Content<code>*</code>:
                                            </Label>
                                            <Input
                                                type="textarea"
                                                name="content"
                                                placeholder="Content"
                                                  className="ckeditor"
                                                  id="content"
                                            />
                                        </Col>
                                     
                   
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                               Meta Title:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="meta_title"
                                                placeholder="Enter Meta Title"
                                                  className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                               Meta Keyword:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="meta_keyword"
                                                placeholder="Enter Meta Keyword"
                                                  className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                               Meta Description:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="meta_description"
                                                placeholder="Enter Meta Description"
                                                  className=""
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
                                                placeholder="Enter Order"
                                                  className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                       
                                       
                                       
                                    </FormGroup>
                                    


                           <FormGroup row>            
                        <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input type="checkbox" id="client@check" name="is_publish" value="Y" />
                        <Label for="client@check"></Label>
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
