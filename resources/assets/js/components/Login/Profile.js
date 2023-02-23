import React, { Component } from "react";
class Profile extends Component {
  constructor(props) {
    super(props);
    this.state = {
      user_data: [],
    };
  }

  componentDidMount() {
    axios.get(constvar.api_url + "user_detail").then((response) => {
      if (response.data.status == "success") {
        this.setState({ user_data: response.data.data });
      } else {
        this.setState({ user_data: "" });
      }
    });
  }

  render() {
    return (
      <div>
        <Row className="reset-password-bg profile">
          <Col>
            <Card className="change-password">
              <CardHeader>
                <CardTitle>Profile</CardTitle>
              </CardHeader>
              <CardBody>
                <img src={"../images/user.png"} className="img-user" alt="" />
                <p className="user-profile">USER PROFILE</p>
                <div className="profile-detail">
                  <p>
                    Username:<span>{this.state.user_data.username}</span>{" "}
                  </p>
                  <p>
                    Email:<span>{this.state.user_data.email}</span>
                  </p>
                  <p>
                    Full Name:<span>{this.state.user_data.fullname}</span>
                  </p>
                  <p>
                    Contact:<span>{this.state.user_data.contact}</span>
                  </p>
                  <p>
                    Loaction:
                    <span>
                      {this.state.user_data.locname},
                      {this.state.user_data.locaddress}
                    </span>
                  </p>
                  <p>
                    Usergroup:<span>{this.state.user_data.groupname}</span>
                  </p>
                </div>
              </CardBody>
            </Card>
          </Col>
        </Row>
      </div>
    );
  }
}
export default Profile;
