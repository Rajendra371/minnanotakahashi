import React, { Component } from "react";
import { Route, Switch, Redirect, withRouter } from "react-router-dom";
import { connect } from "react-redux";
import PropTypes from "prop-types";

import { AdminPrivateRoute } from "../routes/adminPrivateRoute";
import { PublicRoute } from "../routes/publicRoute";
// import { requests } from "../defaultsetting/utils/requests";
// import Register from './Login/Register';
import Login from "./Login/Login";
import AdminLayout from "../layouts";
import Common from "./Common/Common";
import constvar from "./Common/Constant";
import axios from "axios";
import { Link } from "react-router-dom";
import TimePicker from "rc-time-picker";
import DatePicker from "react-datepicker-nepali";
import Select from "react-select";
import {
  Badge,
  Button,
  Card,
  CardBody,
  CardFooter,
  CardHeader,
  CardTitle,
  Col,
  Fade,
  Form,
  FormGroup,
  FormText,
  Input,
  Label,
  Table,
  Row,
} from "reactstrap";

/**Globally Define */
global.React = React;
global.axios = axios;
global.Link = Link;
global.constvar = constvar;
global.Badge = Badge;
global.Button = Button;
global.Card = Card;
global.CardBody = CardBody;
global.CardFooter = CardFooter;
global.CardHeader = CardHeader;
global.CardTitle = CardTitle;
global.Col = Col;
global.Fade = Fade;
global.Form = Form;
global.FormGroup = FormGroup;
global.FormText = FormText;
global.Input = Input;
global.Table = Table;
global.Label = Label;
global.Row = Row;
global.TimePicker = TimePicker;
global.DatePicker = DatePicker;
global.Select = Select;

// import ClientLayout from './Frontend';

import { APP_LOAD, REDIRECT } from "../defaultsetting/constants/actionTypes";
// Styles
import "../index.css";
// CoreUI Icons Set
import "@coreui/icons/css/coreui-icons.min.css";
// Import Flag Icons Set
import "flag-icon-css/css/flag-icon.min.css";
// Import Font Awesome Icons Set
import "font-awesome/css/font-awesome.min.css";
// Import Simple Line Icons Set
import "simple-line-icons/css/simple-line-icons.css";
// Import Main styles for this application
import "../../scss/style.css";
import "react-table/react-table.css";
import { setToken } from "../defaultsetting/utils/requests";
import authAgent from "./Login/agent";

class App extends React.Component {
  constructor(props) {
    super(props);

    const token = window.localStorage.getItem("backend-jwt-token");
    if (token) {
      setToken(token);
    }
    this.props.onLoad(token ? authAgent.current() : null, token);
  }

  componentWillReceiveProps(nextProps) {
    if (nextProps.redirectTo) {
      // this.context.router.history.push(nextProps.redirectTo);
      this.props.history.push(nextProps.redirectTo);
      this.props.onRedirect();
    }
  }

  render() {
    return (
      <Switch>
        {/* <Route path="/register" component={Register} /> */}

        <PublicRoute path="/admin" component={Login} />
        <AdminPrivateRoute path="/" name="Home" component={AdminLayout} />
        <Redirect from="/" to="/admin" />
      </Switch>
    );
  }
}

const mapStateToProps = (state) => {
  return {
    appLoaded: state.common.appLoaded,
    appName: state.common.appName,
    currentUser: state.common.currentUser,
    redirectTo: state.common.redirectTo,
  };
};

const mapDispatchToProps = (dispatch) => ({
  onLoad: (payload, token) =>
    dispatch({ type: APP_LOAD, payload, token, skipTracking: true }),
  onRedirect: () => dispatch({ type: REDIRECT }),
});

App.contextTypes = {
  // router: PropTypes.object.isRequired,
};

export default withRouter(
  connect(
    mapStateToProps,
    mapDispatchToProps
  )(App)
);
