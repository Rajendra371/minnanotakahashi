import React from "react";
import { Redirect, Route } from "react-router-dom";

import { getToken } from "../defaultsetting/utils/requests";

export const PublicRoute = ({ component: Component, ...rest }) => (
  <Route
    {...rest}
    render={(props) => {
      let prev_url = window.localStorage.getItem("previous_url");
      console.log(prev_url);
      return getToken() ? (
        <div>
          {prev_url !== null ? (
            <Redirect from="/badministrator" to={prev_url} />
          ) : (
            <Redirect from="/badministrator" to="/badministrator/dashboard" />
          )}
        </div>
      ) : (
        <Component {...props} />
      );
    }}
  />
);
