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
        axios.get(constvar.api_url + "portfolio_setup").then(response => {
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
                                <CardTitle>Portfolio Form</CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                     id="portfolioForm"
                                     encType="multipart/form-data"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "portfolio_setup/store"}
                                >
                                    <FormGroup row>
                                        <Input
                                            type="hidden"
                                            name="id"
                                            defaultValue=""
                                        />
                                      

                                     <Col md="6" sm="6" xs="6">
                      <Label>
                        category Name
                        <code>*</code>
                      </Label>
                      <Input
                        type="select" 
                        name="portfolio_categoryid"
                        id="portfolio_categoryid"
                      >
                        <option>-- Select Category --</option>
                        {this.state.category.length>0 ?(
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
                                                Name:<code>*</code>
                                            </Label>
                                            <Input
                                                type="text"
                                                name="name"
                                                placeholder="Enter Name"
                                                className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                      
                                       
                                        <Col md="12" sm="6" xs="6">
                                            <Label>
                                                Content<code>*</code>:
                                            </Label>
                                            <Input
                                                type="textarea"
                                                name="content"
                                                placeholder="Enter Content"
                                                className="ckeditor"
                                                id="content"
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                Website<code>*</code>:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="website"
                                                placeholder="Enter Website Name"
                                                  className="required_field"
                                                defaultValue=""
                                            />
                                        </Col>
                                        <Col xs="6">
                      <Label>
                        Image
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
                                        
                                        <Col md="6" sm="6" xs="6">
                      <Label>
                       Start Date
                        <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="startdate"
                        placeholder="Start Date"
                        className="required_field datepicker"
                        
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                       End Date
                        <code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="enddate"
                        placeholder="End Date"
                        className="required_field datepicker"
                        
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
export default MainForm;
