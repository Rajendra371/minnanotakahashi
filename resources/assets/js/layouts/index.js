import React, { Component } from "react";
import { compose } from "redux";
import { Redirect, Route, Switch } from "react-router-dom";
import { Container } from "reactstrap";
import { connect } from "react-redux";
import {
  AppAside,
  AppBreadcrumb,
  AppFooter,
  AppHeader,
  AppSidebar,
  AppSidebarFooter,
  AppSidebarForm,
  AppSidebarHeader,
  AppSidebarMinimizer,
  AppSidebarNav,
} from "@coreui/react";

import injectReducer from "../defaultsetting/utils/injectReducer";
import { getToken, requests } from "../defaultsetting/utils/requests";
import reducer from "../routes/backendCommonReducer";
import authAgent from "../components/Login/agent";
import { APP_LOAD } from "../defaultsetting/constants/actionTypes";
import { axios_interceptor } from "../defaultsetting/interceptor";

// sidebar nav config
import { navigation } from "../routes";

// routes config
import { adminRoutes } from "../routes";

// Side Bar
import AdmintAside from "./Aside";

// Footer
import AdminFooter from "./Footer";

// Header
import AdminHeader from "./Header";
import DynamicTab from "./DynamicTab";

import { BACKEND_REDIRECT } from "../components/Common/Constant";
import axios from "axios";

class AdminLayout extends Component {
  constructor(props) {
    super(props);
    this.state = {
      navData: navigation,
      other_menu: [],
    };
  }

  componentDidMount() {
    var langsel = window.localStorage.getItem("selectedLang");
    this.props.onLoad(getToken() ? authAgent.current() : null, getToken());
    axios.defaults.headers.common["Authorization"] = `Bearer ${getToken()}`;
    axios.defaults.headers.common["language"] = langsel;
    this.loadSidebar(constvar.api_url + "module/showmenu");
    axios.get(constvar.api_url + "common/load_system_info").then((response) => {
      if (response.data.status == "success") {
        this.setState({ other_menu: response.data.data });
      } else {
        this.setState({ other_menu: "" });
      }
    });
  }

  componentWillReceiveProps(nextProps) {
    if (nextProps.redirectTo) {
      this.props.history.push(nextProps.redirectTo);
      this.props.onRedirect();
    }
  }

  componentWillMount() {
    axios_interceptor();
  }

  loadSidebar(navUrl) {
    const request = async () => {
      const response = await axios.get(navUrl);
      this.setState({ navData: response.data });
    };
    request();
  }

  render() {
    return (
      <div className="app nagarpalika_dashboard">
        <AppHeader fixed>
          <AdminHeader
            appName={this.props.appName}
            currentUser={this.props.currentUser}
            header_data={this.state.other_menu}
          />
        </AppHeader>
        <div className="app-body">
          <AppSidebar fixed display="lg">
            <AppSidebarHeader />
            <AppSidebarForm />
            <AppSidebarNav navConfig={this.state.navData} {...this.props} />
            {/* <AppSidebarNav navConfig={navigation} {...this.props} /> */}
            <AppSidebarFooter />
            <AppSidebarMinimizer />
          </AppSidebar>
          <main className="main">
            <AppBreadcrumb appRoutes={adminRoutes} />
            <Route
              path="*"
              render={(props) => {
                let parts = props.location.pathname;
                localStorage.setItem("previous_url", parts);
                return (
                  <div>
                    <DynamicTab data={parts} {...this.props} />
                  </div>
                );
              }}
            />
            <Container fluid>
              <div className="px-2 py-1 bg-white">
                <Switch>
                  {adminRoutes.map((route, idx) => {
                    return route.component ? (
                      <Route
                        key={idx}
                        path={constvar.administrator + route.path}
                        exact={route.exact}
                        name={route.name}
                        render={(props) => <route.component {...props} />}
                      />
                    ) : null;
                  })}
                  {/* <Redirect from="/" to="/admin/dashboard" /> */}
                </Switch>
              </div>
            </Container>
          </main>
          <AppAside fixed>
            <AdmintAside />
          </AppAside>
        </div>
        <AppFooter>
          <AdminFooter />
        </AppFooter>
      </div>
    );
  }
}

const mapStateToProps = (state) => {
  return {
    ...state.backendCommon,
    currentUser: state.common.currentUser,
    loader: state.loader,
  };
};

const mapDispatchToProps = (dispatch) => ({
  onRedirect: () => dispatch({ type: BACKEND_REDIRECT }),
  onLoad: (payload, token) =>
    dispatch({ type: APP_LOAD, payload, token, skipTracking: true }),
});

const withConnect = connect(
  mapStateToProps,
  mapDispatchToProps
);

const withReducer = injectReducer({ key: "backendCommon", reducer });

export default compose(
  // withRouter,
  withReducer,
  withConnect
)(AdminLayout);
