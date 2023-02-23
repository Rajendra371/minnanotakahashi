import React, { useContext, useState, useEffect } from "react";
import { Redirect, Route } from "react-router-dom";
import jwt_decode from "jwt-decode";
import { AuthContext } from "../context/AuthContext";
import LoaderSpinner from "../component/LoaderSpinner";

const checkAuth = () => {
  const token = window.localStorage.getItem("frontend-jwt-token");
  if (!token) {
    return false;
  }
  try {
    const { exp } = jwt_decode(token);
    if (exp < new Date().getSeconds()) {
      return false;
    }
  } catch (error) {
    return false;
  }
  return true;
};

export const UserPrivateRoutes = ({ component: Component, ...rest }) => {
  const { userDetails } = useContext(AuthContext);
  const [emailVerified, setEmailVerified] = useState(
    userDetails.email_verified_at
  );

  const verifyEmail = () => {
    if (emailVerified === null || emailVerified === undefined) {
      return false;
    }
    return true;
  };

  useEffect(() => {
    setEmailVerified(userDetails.email_verified_at);
  }, [userDetails]);

  return (
    <Route
      {...rest}
      render={(props) =>
        checkAuth() ? (
          // verifyEmail() ? (
            <Component {...props} />
          // ) : (
          //   <Redirect
          //     to={{ pathname: "/verify", state: { from: props.location } }}
          //   />
          // )
        ) : (
          <Redirect
            to={{ pathname: "/login", state: { from: props.location } }}
          />
        )
      }
    />
  );
};
export default UserPrivateRoutes;
