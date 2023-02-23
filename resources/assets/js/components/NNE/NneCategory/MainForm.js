import React, { Component } from "react";
import axios from "axios";


export default class MainForm extends Component {
    constructor(props) {
    super(props);
    this.state = {
        nnetypedata:""
     
    
    };
    // this.handleOther = this.handleOther.bind(this);
    // this.onFileUpload = this.onFileUpload.bind(this)

 load_datepicker();
  }

componentDidMount() {
    axios.get(constvar.api_url + "nne_category/getcategory").then(response => {
      if (response.data.status == "success") 
      {
        this.setState({ nnetypedata: response.data.data });
      } else {
        this.setState({ nnetypedata: "" });
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
                                <CardTitle>NNE Category Form</CardTitle>
                            </CardHeader>
                            <CardBody>
                                <Form
                                    className="form-horizontal"
                                     id="nnecForm"
                                    // {"#demo + {this.state.id}"}
                                    action={constvar.api_url + "nne_category/store"}
                                >
                                    <FormGroup row>
                                        <Input
                                            type="hidden"
                                            name="id"
                                            defaultValue=""
                                        />
                                      

                       
                    <Col md="6" sm="6" xs="6">
              <Label>Type<code>*</code>:</Label>
                  <Input
                    type="select"
                    className="required_field"
                    name="type_id"
                    id="type_id"
                    >
                       <option value="">----Select Type----</option>
                      <option value="1">News</option>
                      <option value="2">Notice</option>
                      <option value="3">Event</option>
                    </Input>
            </Col>
                   
                  
<Col md="6" sm="6" xs="6" >
            <div className=" cat_name" style={{display:"none"}} >
                <Label>Category Name<code>*</code>:</Label>
                <Input
                  type="text"
                  id="category_name"
                  className="required_field"
                  name="category_name"
                />
              </div>
              </Col>
                  
                                        <Col md="6" sm="6" xs="6">
                                            <Label>
                                                Icon Name:
                                            </Label>
                                            <Input
                                                type="text"
                                                name="icon"
                                                placeholder="Enter Icon Class"
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
                                                placeholder="Order"
                                                className=""
                                                defaultValue=""
                                            />
                                        </Col>
                                       
                                    </FormGroup>
                                    


                           <FormGroup row>            
                        <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input type="checkbox" id="advertisement@check" name="is_publish" value="Y" />
                        <Label for="advertisement@check"></Label>
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

