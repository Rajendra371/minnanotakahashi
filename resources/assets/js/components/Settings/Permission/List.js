import React, { Component } from "react";
class List extends Component {
  constructor(props) {
    super(props);
    this.state = {
      navData: [],
      groupdatas: [],
      moduledatas: null,
      usergroup: "0"
    };

    this.handleSubmit = this.handleSubmit.bind(this);
  }

  componentDidMount() {
    axios.get(constvar.api_url + "usergroup").then(response => {
      this.setState({
        groupdatas: response.data.data
      });
    });

    axios.get(constvar.api_url + "permission/get_module").then(response => {
      this.setState({
        moduledatas: response.data
      });
    });
  }

  render() {
    if (!this.state.moduledatas) {
      return (
        <div className="Loader">
          <Loader type="Plane" color="#00BFFF" height="100" width="100" />
        </div>
      );
    }
    return (
      <div className="animated fadeIn row">
        <div className="col-md-12">
          <Row>
            <Col>
              <Card>
                <CardHeader>
                  <CardTitle>Permission Management </CardTitle>
                </CardHeader>
                <CardBody>
                  <Form
                    id="ModulePermission"
                    action="api/permission/store"
                    className="form-horizontal"
                  >
                    <FormGroup row>
                      <Col md="3" />
                      <Col md="6" sm="6" xs="6">
                        <div className="row">
                          <Col md="2">
                            {" "}
                            <Label>
                              Group : <code> * </code>
                            </Label>
                          </Col>
                          <Col md="10">
                            <Input type="select" name="usergroupid">
                              <option>--Select Group --</option>
                              {this.state.groupdatas.length >0 ?(
                               this.state.groupdatas.map(datas => {
                                return (
                                  <option
                                    key={datas.usergroupid}
                                    value={datas.usergroupid}
                                  >
                                    {datas.groupname}
                                  </option>
                                );
                              })):''}
                            </Input>
                          </Col>
                        </div>
                      </Col>
                    </FormGroup>
                    <FormGroup row>
                      <Col>
                        <div
                          dangerouslySetInnerHTML={{
                            __html: this.state.moduledatas
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
                  </Form>
                </CardBody>
              </Card>
            </Col>
          </Row>
        </div>
      </div>
    );
  }
}
export default List;

$(document).off("change", ".perm-check");
$(document).on("change", ".perm-check", function(e) {
  var modid = $(this).data("module_id");

  var status = $(this).is(":checked") ? true : false;
  $(".chkbox_" + modid).prop("checked", status);
  $(".chkmaster_" + modid).prop("checked", status);
  var grpid = $("#grp_id").val();
  var user_group = $("#grp_id option:selected").html();
  // alert(user_group);
  if (grpid == "") {
    alert("You nee to select group!!");
    return false;
  }
});
