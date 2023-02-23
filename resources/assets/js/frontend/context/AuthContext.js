import React, {
  createContext,
  useReducer,
  useEffect,
  useContext,
  useState,
} from "react";
import AuthReducer from "./AuthReducer";
import * as authActions from "./AuthActionType";
import jwt_decode from "jwt-decode";
import { Redirect, withRouter } from "react-router-dom";
import axios from "axios";
import { useSnackbar } from "notistack";

const initialState = {
  isAuthenticated: false,
  isLoading: false,
  userId: "",
  errorMessages: [],
  registerSuccess: [],
  userDetails: {},
  checkoutAsGuest: {},
  user_order_list: [],
};

export const AuthContext = createContext(initialState);

export const AuthContextProvider = (props) => {
  const [state, dispatch] = useReducer(AuthReducer, initialState);
  const [loader, setLoader] = useState(false);
  const { enqueueSnackbar } = useSnackbar();

  // User Login
  function userLogin(data) {
    try {
      dispatch({
        type: authActions.LOGIN_ATTEMPT,
        payload: "",
      });
      axios.post("api/login", data).then((response) => {
        // console.log("login_response", response);
        if (response.data.status == "success") {
          dispatch({
            type: authActions.FRONTEND_LOGIN,
            payload: response.data.token,
          });
          dispatch({
            type: authActions.SET_USER_DETAILS,
            payload: response.data.data,
          });
          axios.defaults.headers.common["Authorization"] = `Bearer ${
            response.data.token
          }`;
          // get_user_order_list();
          // getFavList();
          enqueueSnackbar("Logged in Succesfully", { variant: "success" });
          return true;
        } else {
          // console.log(response.data);
          dispatch({
            type: authActions.LOGIN_ERROR,
            payload: "",
          });
          enqueueSnackbar("Invalid Username or Password", { variant: "error" });
          return false;
        }
      });
    } catch (error) {
      console.log("error");
      enqueueSnackbar("Invalid Username or Password", { variant: "error" });
    }
  }

  function googleLogin(response) {
    axios.post("api/google_login", { response: response }).then((res) => {
      if (res.data.status == "success") {
        dispatch({
          type: authActions.FRONTEND_LOGIN,
          payload: res.data.token,
        });
        dispatch({
          type: authActions.SET_USER_DETAILS,
          payload: res.data.data,
        });
        axios.defaults.headers.common["Authorization"] = `Bearer ${
          res.data.token
        }`;
        // get_user_order_list();
        // getFavList();
        enqueueSnackbar("Logged in Succesfully", { variant: "success" });
        // props.history.push('/profile');
      } else {
        // dispatch({
        //   type: authActions.LOGIN_ERROR,
        //   payload: res.data.message,
        // });
        enqueueSnackbar(res.data.message, { variant: "error" });
        return false;
      }
    });
  }
  function facebookLogin(response) {
    axios.post("api/facebook_login", { response: response }).then((res) => {
      if (res.data.status == "success") {
        dispatch({
          type: authActions.FRONTEND_LOGIN,
          payload: res.data.token,
        });
        dispatch({
          type: authActions.SET_USER_DETAILS,
          payload: res.data.data,
        });
        axios.defaults.headers.common["Authorization"] = `Bearer ${
          res.data.token
        }`;
        // get_user_order_list();
        // getFavList();
        window.localStorage.removeItem("checkout-guest");
        enqueueSnackbar("Logged in Succesfully", { variant: "success" });
      } else {
        enqueueSnackbar(res.data.message, { variant: "success" });
        return false;
      }
    });
  }

  async function userRegister(data) {
    try {
      dispatch({
        type: authActions.LOGIN_ATTEMPT,
        payload: "",
      });
      const response = await axios.post("api/register", data);
      if (response.data.status == "success") {
        dispatch({
          type: authActions.FRONTEND_REGISTER,
          payload: response.data.message,
        });
        enqueueSnackbar(response.data.message, { variant: "success" });
        // props.history.push("/login");
        return true;
      } else if (response.data.status == "error") {
        // dispatch({
        //   type: authActions.LOGIN_ERROR,
        //   payload: response.data.message,
        // });
        enqueueSnackbar(response.data.message, { variant: "error" });
      }
    } catch (error) {
      // dispatch({
      //   type: authActions.LOGIN_ERROR,
      //   payload: error.message,
      // });
      enqueueSnackbar(error.message, { variant: "error" });
    }
  }

  async function userLogout() {
    try {
      const response = await axios.post("api/logout");
      if (response.data.status == "success") {
        delete axios.defaults.headers.common["Authorization"];
        dispatch({
          type: authActions.FRONTEND_LOGOUT,
          payload: "",
        });
        // clear_fav_list();
        enqueueSnackbar("Logged Out", { variant: "success" });
        return true;
      }
    } catch (error) {
      console.log(error);
    }
  }

  async function verifyEmailContext(data) {
    const res = await axios.post("api/verify_email", data);
    if (res.data.status == "success") {
      dispatch({
        type: authActions.SET_USER_DETAILS,
        payload: res.data.data,
      });
      enqueueSnackbar(res.data.message, { variant: "success" });
      props.history.push("/profile");
    } else {
      enqueueSnackbar(res.data.message, { variant: "error" });
      return false;
    }
  }

  async function userResendVerifyCode(email) {
    const res = await axios.post("api/resend_verification_code", {
      email: email,
    });
    if (res.data.status == "success") {
      // enqueueSnackbar( res.data.message, {variant:'success'});
    } else {
      // enqueueSnackbar( res.data.message, {variant:'error'});
    }
  }

  async function save_user_profile(data) {
    const res = await axios.post("/api/customer/save_customer_profile", data);
    if (res.data.status == "success") {
      dispatch({
        type: authActions.SET_USER_DETAILS,
        payload: res.data.data,
      });
      enqueueSnackbar("Profile Updated Succesfully", { variant: "success" });
    } else {
      // dispatch({
      //   type: authActions.LOGIN_ERROR,
      //   payload: res.data.message,
      // });
      enqueueSnackbar(res.data.message, { variant: "error" });
    }
  }
  async function save_user_address(data) {
    const res = await axios.post("/api/customer/save_customer_address", data);
    if (res.data.status == "success") {
      dispatch({
        type: authActions.SET_USER_DETAILS,
        payload: res.data.data,
      });
      // enqueueSnackbar("Address Updated Succesfully", {variant:'success'});
    } else {
      // dispatch({
      //   type: authActions.LOGIN_ERROR,
      //   payload: res.data.message,
      // });
      // enqueueSnackbar( res.data.message, {variant:'error'});
    }
  }

  async function userChangePassword(data) {
    try {
      const response = await axios.post("api/customer_change_password", data);
      // console.log(response.data);
      if (response.data.status == "success") {
        // enqueueSnackbar(response.data.message, {variant:'success'});
        return ["success", response.data.message];
      } else {
        // enqueueSnackbar(response.data.message, {variant:'error'});
        return ["error", response.data.message];
      }
    } catch (error) {
      // enqueueSnackbar(error.message, {variant:'success'});
      return ["error", error.message];
    }
  }

  function checkAuthentication() {
    const token = window.localStorage.getItem("frontend-jwt-token");
    console.log("token", token);
    if (token) {
      const tokenData = jwt_decode(token);
      if (tokenData.exp < new Date().getSeconds()) {
        userLogout();
      } else {
        dispatch({
          type: authActions.SET_AUTH_USER,
          payload: {
            userId: tokenData.sub,
          },
        });
        setLoader(true);
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        axios.get("api/user_detail").then((response) => {
          if (response.data.status == "success") {
            dispatch({
              type: authActions.SET_USER_DETAILS,
              payload: response.data.data,
            });
            setLoader(false);
          }
        });
        // get_user_order_list();
        // getFavList();
      }
    }
  }

  function check_for_guest_checkout() {
    const data = window.localStorage.getItem("checkout-guest");
    if (data) {
      dispatch({
        type: authActions.SET_CHECKOUT_DETAILS,
        payload: JSON.parse(data),
      });
    }
  }

  async function guestCheckOut(data) {
    // console.log(data);
    const res = await axios.post("api/guest_checkout", data);
    if (res.data.status == "success") {
      dispatch({
        type: authActions.SET_CHECKOUT_DETAILS,
        payload: res.data.data,
      });
      window.localStorage.setItem(
        "checkout-guest",
        JSON.stringify(res.data.data)
      );
      // enqueueSnackbar("Logged In As Guest", {variant:'success'});
      return true;
    } else if (res.data.status == "error") {
      // enqueueSnackbar(res.data.message, {variant:'error'});
      return false;
    }
  }

  const get_user_order_list = async () => {
    const res = await axios
      .get("api/customer/order_list")
      .then((response) => {
        return response;
      })
      .catch((error) => {
        console.log(error);
      });
    if (res.data.status == "success") {
      dispatch({
        type: authActions.USER_ORDER_LIST,
        payload: res.data.data,
      });
    }
  };

  useEffect(() => {
    checkAuthentication();
    check_for_guest_checkout();
  }, []);

  // useEffect(() => {
  //   setTimeout(() => {
  //     dispatch({
  //       type: authActions.CLEAR_ERRORS,
  //       payload: null,
  //     });
  //   }, 5000);
  // }, [state.errorMessages, state.registerSuccess]);

  return (
    <AuthContext.Provider
      value={{
        isAuthenticated: state.isAuthenticated,
        isLoading: state.isLoading,
        userId: state.userId,
        errorMessages: state.errorMessages,
        registerSuccess: state.registerSuccess,
        userDetails: state.userDetails,
        checkoutAsGuest: state.checkoutAsGuest,
        user_order_list: state.user_order_list,
        dispatch,
        userLogin,
        loader,
        userLogout,
        userRegister,
        userChangePassword,
        save_user_profile,
        save_user_address,
        guestCheckOut,
        get_user_order_list,
        verifyEmailContext,
        userResendVerifyCode,
        googleLogin,
        facebookLogin,
      }}
    >
      {props.children}
    </AuthContext.Provider>
  );
};

export default withRouter(AuthContextProvider);
