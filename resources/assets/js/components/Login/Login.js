import { compose } from "redux";
import ListErrors from "../../defaultsetting/error/ListErrors";
import React from "react";
import { connect } from "react-redux";
import {
  Button,
  Card,
  CardBody,
  Media,
  CardGroup,
  Col,
  Container,
  InputGroup,
  InputGroupAddon,
  InputGroupText,
  Row,
} from "reactstrap";
import { Field, reduxForm } from "redux-form";
import { onLoginSubmit, onLoginUnload } from "./actions";

import injectReducer from "../../defaultsetting/utils/injectReducer";
import reducer from "./reducer";

const mapStateToProps = (state) => ({ ...state.auth });

class Login extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      orgname: "",
      orgaddress1: "",
      orgaddress2: "",
      contact: "",
      email: "",
      website: "",
      logo: "logo.png",
      softwarename: "",
    };
  }

  componentDidMount() {
    $("#email")
      .focus()
      .select();
    axios.get(constvar.api_url + "load_system_info").then((response) => {
      // console.log(response.data);
      if (response.data.status == "success") {
        var data = response.data.data;
        this.setState({ orgname: data.orgname });
        this.setState({ orgaddress1: data.orgaddress1 });
        this.setState({ orgaddress2: data.orgaddress2 });
        this.setState({ contact: data.contact });
        this.setState({ email: data.email });
        this.setState({ website: data.website });
        this.setState({ logo: data.logo });
        this.setState({ softwarename: data.softwarename });
      } else {
        this.setState({ orgname: "" });
        this.setState({ orgaddress1: "" });
        this.setState({ orgaddress2: "" });
        this.setState({ contact: "" });
        this.setState({ email: "" });
        this.setState({ website: "" });
        this.setState({ logo: "" });
        this.setState({ softwarename: "" });
      }
    });
  }

  componentWillUnmount() {
    this.props.onLoginUnload();
  }

  showloading(e) {
    document.body.classList.add("loading-indicator");
  }

  hideloading() {
    setTimeout(function() {
      document.body.classList.remove("loading-indicator");
    }, 3000);
  }

  render() {
    const { handleSubmit } = this.props;
    return (
      <div className="login">
        <div className="app flex-row align-items-center">
          <Container>
            <div className="login_wrapper">
              <h1>{this.state.softwarename}</h1>
              <Row className="justify-content-center v-border">
                <Col md="6">
                  <CardGroup>
                    <Card className="p-4 bg-transparent">
                      <CardBody className="user_login">
                        <form
                          onSubmit={handleSubmit(
                            this.props.onLoginSubmit.bind(this)
                          )}
                        >
                          <p className="welcome_user">
                            Welcome Please<a href="#">Login</a>
                          </p>
                          <InputGroup className="mb-3">
                            <InputGroupAddon addonType="prepend">
                              {/* <InputGroupText>
                              <i className="icon-user" />
                            </InputGroupText> */}
                            </InputGroupAddon>
                            <Field
                              name="title"
                              className="form-control"
                              id="email"
                              type="text"
                              name="email"
                              placeholder="Email"
                              component="input"
                              required
                            />
                          </InputGroup>
                          <InputGroup className="mb-4">
                            <InputGroupAddon addonType="prepend">
                              {/* <InputGroupText>
                              <i className="icon-lock" />
                            </InputGroupText> */}
                            </InputGroupAddon>
                            <Field
                              name="password"
                              className="form-control"
                              type="password"
                              name="password"
                              placeholder="Password"
                              component="input"
                              required
                            />
                          </InputGroup>
                          <Button
                            type="submit"
                            color="primary"
                            className="px-4"
                            style={{
                              width: "100%",
                            }}
                            //  onClick={this.showloading}
                            onClick={(e) => {
                              {
                                this.showloading(e);
                              }
                              this.hideloading();
                            }}
                          >
                            Login
                          </Button>
                        </form>
                      </CardBody>
                      <div id="error">
                        <ListErrors errors={this.props.errors} />
                      </div>
                    </Card>
                  </CardGroup>
                </Col>
                <Col md="6">
                  <CardGroup>
                    <Card className="p-4 bg-transparent">
                      <CardBody
                        style={{
                          textAlign: "center",
                        }}
                      >
                        {/* <Media> */}
                        <img
                          src={"images/" + this.state.logo}
                          style={{
                            width: "100px",
                            margin: "0 auto 20px",
                          }}
                        />
                        {/* </Media> */}
                        <p>{this.state.orgname}</p>
                        <p>
                          {this.state.orgaddress1}, {this.state.orgaddress2}
                        </p>
                        <p>Phone: {this.state.contact}</p>
                        <p>
                          Website:{" "}
                          <a href={this.state.website} target="_blank">
                            {this.state.website}
                          </a>
                        </p>
                      </CardBody>
                    </Card>
                  </CardGroup>
                </Col>
              </Row>
            </div>
          </Container>
        </div>
      </div>
    );
  }
}

const withConnect = connect(
  mapStateToProps,
  { onLoginSubmit, onLoginUnload }
);

const withReducer = injectReducer({ key: "auth", reducer });

const withreduxForm = reduxForm({
  form: "LoginForm",
});

export default compose(
  withReducer,
  withreduxForm,
  withConnect
)(Login);
