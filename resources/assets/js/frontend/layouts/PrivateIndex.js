import React, { Component } from "react";
import { Route, Switch } from "react-router-dom";

import { frontendProtectedRoutes } from "../routes/Index";

export function PrivateIndex() {
  return (
    <Switch>
      {frontendProtectedRoutes.map((route, idx) => {
        return route.component ? (
          <Route
            key={idx}
            path={route.path}
            exact={route.exact}
            name={route.name}
            render={(props) => <route.component {...props} />}
          />
        ) : null;
      })}
    </Switch>
  );
}
export default PrivateIndex;
