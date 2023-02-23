import React, { Component } from "react";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      group: [],
      module: []
    };
    this.handleChange = this.handleChange.bind(this);
  }

  handleChange(e) {
    const target = e.target;
    const grid = target.value;
    axios
      .post(constvar.api_url + "permission/get_permodule", {
        groupid: grid
      })
      .then(response => {
        if (response.data.status == "success") {
          this.setState({ module: response.data.data });
        } else {
          this.setState({ module: "" });
        }
      });
  }
  componentDidMount() {
    axios.get(constvar.api_url + "usergroup").then(response => {
      this.setState({ group: response.data.data });
    });
    axios.get(constvar.api_url + "permission/get_module").then(response => {
      if (response.data.status == "success") {
        this.setState({ module: response.data.data });
      } else {
        this.setState({ module: "" });
      }
    });
  }
  render() {
    return (
      <div className="col-md-12">
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>Permission Management </CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="ModulePermission"
                  action={constvar.api_url + "permission/store"}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="3" />
                    <Col md="6" sm="6" xs="6">
                      <div className="row">
                        <Col md="2">
                          <Label>
                            {" "}
                            Group <code>*</code> :
                          </Label>
                        </Col>
                        <Col md="10">
                          <Input
                            type="select"
                            name="usergroupid"
                            defaultValue=""
                            onChange={this.handleChange}
                          >
                            <option value="">--Select Group --</option>
                            { this.state.group.length > 0 ?
                                     this.state.group.map(datas => {
                                    return (
                                      <option key={datas.id} value={datas.id}>
                                      {datas.groupname}
                                    </option>
                                    );
                                }) : " " } 
                          </Input>
                        </Col>
                      </div>
                    </Col>
                  </FormGroup>
                  <FormGroup row>
                    <Col>
                      <div
                        dangerouslySetInnerHTML={{
                          __html: this.state.module
                        }}
                      />
                    </Col>
                  </FormGroup>
                  <CardFooter>
                    <div className="clearfix">
                      <div className="float-left">
                        <Button
                          type="submit"
                          size="md"
                          color="primary"
                          className="save btn btn-primary btn-md"
                        >
                          <i className="fa fa-dot-circle-o" /> Submit
                        </Button>{" "}
                        &nbsp;&nbsp;&nbsp;
                        <Button
                          type="reset"
                          size="md"
                          color="danger"
                          className="btnreset btn btn-danger btn-md"
                        >
                          <i className="fa fa-ban" /> Reset
                        </Button>
                      </div>
                    </div>
                  </CardFooter>
                  <div className="alert-success success" />
                  <div className="alert-danger error" />
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
