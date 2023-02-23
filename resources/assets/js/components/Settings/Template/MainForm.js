import React, { Component } from "react";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      location_data: [],
      software_data: []
    };
  }
  componentDidMount() {
    axios.get(constvar.api_url + "location").then(response => {
      if (response.data.status == "success") {
        this.setState({ location_data: response.data.data });
      } else {
        this.setState({ location_data: "" });
      }
    });

    // setTimeout(function(){
    //   var desc1 = CKEDITOR.replace( 'description' );
    //   var desc2 = CKEDITOR.replace( 'descriptionnp' );
    // },300);
   

  }
  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>Template Management </CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="templateForm"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "template/store"}
                >
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Input type="hidden" name="id" defaultValue="" />
                      <Label>
                        Template Name<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="templatename"
                        placeholder="Template Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="6" xs="6">
                      <Input type="hidden" name="id" defaultValue="" />
                      <Label>
                        Template Name (Nepali)<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="templatenamenp"
                        placeholder="Template Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>

                  <FormGroup row>
                  <Col md="6" sm="6" xs="6">
                      <Label>Template Code:</Label>
                      <Input
                        type="text"
                        name="code"
                        placeholder="Template Code"
                        className=""
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Input type="hidden" name="id" defaultValue="" />
                      <Label>
                        Template Segment<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="segment"
                        placeholder="Template Segment"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="12" sm="12" xs="12">
                      <Label>Template Description:</Label>
                      <Input
                        type="textarea"
                        name="description"
                        id="description"
                        placeholder="Template Description"
                        defaultValue=""
                        cols="6"
                        rows="6"
                        // className="ckeditor"
                      />
                    </Col>
                    <Col md="12" sm="12" xs="12">
                      <Label>Template Description (Nepali):</Label>
                      <Input
                        type="textarea"
                        name="descriptionnp"
                        id="descriptionnp"
                        placeholder="Template Description"
                        defaultValue=""
                        cols="6"
                        rows="6"
                        // className="ckeditor"
                      />
                    </Col>

                  </FormGroup>

                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Label>Location :</Label>
                      <Input
                        type="select"
                        name="locationid"
                        defaultValue=""
                        id="select"
                      >
                        <option value="">--Select Location--</option>
                         {this.state.location_data.length >0 ?(
                           this.state.location_data.map(datas => {
                          return (
                            <option key={datas.id} value={datas.id}>
                              {datas.locname}
                            </option>
                          );
                        })):''}
                      </Input>
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
                          <i className="fa fa-dot-circle-o" /> Save
                        </Button>{" "}
                        &nbsp;&nbsp;&nbsp;
                        <Button
                          type="button"
                          size="md"
                          color="danger"
                          className="btnreset"
                        >
                          <i className="fa fa-ban" /> Reset
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
