import React, { Component } from "react";
import {
  DropdownItem,
  DropdownMenu,
  DropdownToggle,
  Nav,
  NavItem,
  NavLink,
  Container,
  Row,
  Col,
} from "reactstrap";
import PropTypes from "prop-types";
import { Link } from "react-router-dom";

import {
  AppHeaderDropdown,
  AppNavbarBrand,
  AppSidebarToggler,
} from "@coreui/react";

import { connect } from "react-redux";

import logo from "../defaultsetting/img/brand/logo.png";

import { BACKEND_LOGOUT } from "../components/Login/constants";

const propTypes = {
  children: PropTypes.node,
};

const defaultProps = {};

class AdminHeader extends Component {
  constructor() {
    super();
    this.state = {
      selectedLang: "en",
    };
    this.changeLang = this.changeLang.bind(this);
    this.clearLocalStorage = this.clearLocalStorage.bind(this);
  }
  changeLang(event, parameter) {
    // console.log(parameter);
    this.setState({
      selectedLang: parameter,
    });
    window.localStorage.setItem("selectedLang", parameter);
    // console.log(window.localStorage.getItem("selectedLang"));
    window.location.reload();
  }
  clearLocalStorage() {
    localStorage.removeItem("previous_url");
    localStorage.removeItem("backend-jwt-token");
    // localStorage.clear();
  }
  render() {
    // eslint-disable-next-line
    const { appName, ...attributes } = this.props;

    return (
      <React.Fragment>
        <AppSidebarToggler className="d-lg-none" display="md" mobile />
        <a href="javascript:void(0);" className="toggle_header d-lg-none">
          <i className="fa fa-chevron-down" />
        </a>
        <AppNavbarBrand
          full={{
            src: logo,
            width: 60,
            height: 40,
            alt: attributes.appName,
          }}
          minimized={{
            src: logo,
            width: 20,
            height: 20,
            alt: attributes.appName,
          }}
        />
        <AppSidebarToggler className="d-md-down-none" display="lg" />

        <div className="companyinfo first">
          {/* <div clasName="main-info"> */}
          <div className="title">{this.props.header_data.orgname}</div>
          <div className="address">
            {this.props.header_data.orgaddress1}
            {this.props.header_data.orgaddress2}
          </div>
        </div>
        <div className="companyinfo second">
          <div className="phone mr-2">{this.props.header_data.contact}</div>
          <div className="software">{this.props.header_data.softwarename}</div>
        </div>

        <Nav className="user_meta" navbar>
          <NavItem className="d-md-down-none">
            <NavLink href="#">
              <i className="icon-bell" />
              <Badge pill color="danger">
                5
              </Badge>
            </NavLink>
          </NavItem>
          <NavItem className="d-md-down-none">
            <NavLink href="#">
              <i className="icon-location-pin" />
            </NavLink>
          </NavItem>
          <NavItem className="d-md-down-none">
            <a
              role="button"
              onClick={(e) => {
                this.changeLang(e, "en");
              }}
              value={"en"}
              style={{
                color: "white",
                cursor: "pointer",
                borderRight: "1px solid #fff",
                paddingRight: "5px",
              }}
            >
              EN
            </a>

            <a
              role="button"
              onClick={(e) => {
                this.changeLang(e, "ne");
              }}
              value={"ne"}
              style={{ color: "white", cursor: "pointer", paddingLeft: "5px" }}
            >
              🇳🇵
            </a>
          </NavItem>
          <AppHeaderDropdown direction="down">
            <DropdownToggle nav>
              <img
                src={"../images/profile.png"}
                className="img-avatar"
                alt=""
              />
            </DropdownToggle>
            <DropdownMenu right style={{ right: "auto" }}>
              <DropdownItem header tag="div" className="text-center">
                <strong> {/* {attributes.currentUser.fullname}{' '} */}</strong>
              </DropdownItem>
              <DropdownItem>
                <Link to="/badministrator/profile" className="nav-link">
                  <i className="fa fa-user" /> Profile
                </Link>
              </DropdownItem>
              <DropdownItem>
                <Link to="/badministrator/change_password" className="nav-link">
                  {" "}
                  <i className="fa fa-wrench" />
                  Change Password
                </Link>
              </DropdownItem>
              <DropdownItem
                onClick={(event) => {
                  {
                    attributes.onClickLogout(event);
                  }
                  this.clearLocalStorage();
                }}
              >
                {/* <DropdownItem onClick={attributes.onClickLogout}> */}
                <i className="fa fa-lock" />
                Logout
              </DropdownItem>
            </DropdownMenu>
          </AppHeaderDropdown>
        </Nav>
      </React.Fragment>
    );
  }
}

AdminHeader.propTypes = propTypes;
AdminHeader.defaultProps = defaultProps;

const mapStateToProps = (state) => ({
  currentUser: state.common.currentUser,
  appName: state.common.appName,
});

const mapDispatchToProps = (dispatch) => ({
  onClickLogout: () => dispatch({ type: BACKEND_LOGOUT }),
});

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(AdminHeader);
