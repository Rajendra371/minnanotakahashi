import React, { useEffect, useState } from "react";
import { Route, Switch, Redirect, useLocation } from "react-router-dom";
import constvar from "../components/Common/Constant";
import { frontendRoutes } from "../routes/Index";
import Header from "./Header";
import Footer from "./Footer";
import { GlobalProvider } from "../context/GlobalContext";
import UserPrivateRoutes from "../routes/userPrivateRoutes";
import PrivateIndex from "./PrivateIndex";
import { AuthContextProvider, AuthContext } from "../context/AuthContext";
import axios from "axios";
import { axios_interceptor } from "../axios_interceptor/AxiosInterceptor";
import { ConfirmationDialogProvider } from "../context/ConfirmationDialog";
import LoaderSpinner from "../component/LoaderSpinner";
import HelmetMetaData from "../components/HelmetMetaData/HelmetMetaData";
import SubHeader from "../component/SubHeader";
import "../../../../../public/css/frontend/mainstyles.css";
import "../../../../../public/css/frontend/main.css";
import { SnackbarProvider } from "notistack";

global.constvar = constvar;

export function Index() {
  const [isloading, setLoading] = useState(true);
  const location = useLocation();
  const [companyInfo, setCompanyInfo] = useState([]);

  useEffect(() => {
    axios_interceptor();
    const token = window.localStorage.getItem("frontend-jwt-token");
    if (token) {
      axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    }
    axios.get("api/get_footer_address").then((res) => {
      if (res.data.status == "success") {
        setCompanyInfo(res.data.data);
      } else {
        setCompanyInfo([]);
      }
    });
  }, []);
  useEffect(() => {
    window.scrollTo(0, 0);
    setTimeout(() => setLoading(false), 300);
    return () => {
      setLoading(true);
    };
  }, [location.pathname]);
  
  const notistackRef = React.createRef();
  const onClickDismiss = (key) => () => {
    notistackRef.current.closeSnackbar(key);
  };

  return (
    <GlobalProvider>
      <SnackbarProvider
        maxSnack={3}
        hideIconVariant={false}
        anchorOrigin={{ vertical: "top", horizontal: "right" }}
        autoHideDuration={3000}
        ref={notistackRef}
        action={(key) => (
          <a
            className="text-white pr-4 cursor-pointer hover:opacity-80"
            onClick={onClickDismiss(key)}
          >
            X
          </a>
        )}
      >
        <AuthContextProvider>
          {/* <ConfirmationDialogProvider>
          <HelmetMetaData /> */}

          <Header companyInfo={companyInfo[0]} />
          <Switch>
            {frontendRoutes.map((route, idx) => {
              return route.component ? (
                <Route
                  key={idx}
                  path={route.path}
                  exact={route.exact}
                  name={route.name}
                  render={(props) => (
                    <React.Fragment>
                      {route.name != "Home" && <SubHeader title={route.name} />}
                      {/* { isloading && route.name !='Home'  ? <LoaderSpinner/> :  */}
                      <route.component {...props} />
                      {/* } */}
                    </React.Fragment>
                  )}
                />
              ) : null;
            })}
            <UserPrivateRoutes
              path="/profile"
              name="Dashboard"
              component={PrivateIndex}
            />
            <Redirect from="/" to="/error_page" />
          </Switch>
          {/* <ConfirmDeleteModal/> */}
          <Footer companyInfo={companyInfo} />
          {/* </ConfirmationDialogProvider> */}
        </AuthContextProvider>
      </SnackbarProvider>
    </GlobalProvider>
  );
}
export default Index;
