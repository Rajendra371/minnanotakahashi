import React, { Component } from "react";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      location_data: [],
      dep_data: [],
      checked: "Y",
    };
  }

  checkChange = (e) => {
    if (e.target.checked) {
      this.setState({ checked: "Y" });
    } else {
      this.setState({ checked: "N" });
    }
  };

  componentDidMount() {
    axios.get(constvar.api_url + "department/get_form_data").then((response) => {
      if (response.data.status == "success") {
        console.log(response.data.data);
        console.log('test');
        if (response.data.status == "success") {
          this.setState({ dep_data: response.data.data.department });
          this.setState({location_data: response.data.data.location});
        } else {
          this.setState({ dep_data: "" });
          this.setState({ location_data: "" });
        }
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
                <CardTitle>
                  Department Management
                </CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="department_setupForm"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "department/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Parent Department :
                      </Label>
                      <Input
                        type="select"
                        name="parentdepid"
                        defaultValue=""
                        id="select"
                      >
                        <option value="0">--Select--</option>
                        {this.state.dep_data.length > 0
                          ? this.state.dep_data.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.depname}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Department Name:<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="depname"
                        placeholder="Department Name"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Department Code:<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="depcode"
                        placeholder="Department Code"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>
                    <Col md="6" sm="6" xs="6">
                      <Label>
                        Location :
                      </Label>
                      <Input
                        type="select"
                        name="locationid"
                        defaultValue=""
                        id="select"
                      >
                        <option value="0">--Select--</option>
                        {this.state.location_data.length > 0
                          ? this.state.location_data.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.locname}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                  </FormGroup>
                  <FormGroup check inline>
                    <Input
                      className="form-check-input"
                      type="checkbox"
                      name="isactive"
                      value="Y"
                    />
                    <Label>
                      Is Active
                    </Label>
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
                          <i className="fa fa-dot-circle-o" />
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
