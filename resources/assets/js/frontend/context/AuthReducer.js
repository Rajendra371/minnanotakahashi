// import { setToken } from "../../defaultsetting/utils/requests";
import * as authActions from "./AuthActionType";
import jwt_decode from "jwt-decode";

export default (state, action) => {
  switch (action.type) {
    case authActions.LOGIN_ATTEMPT:
      return {
        ...state,
        isLoading: true,
      };
    case authActions.FRONTEND_LOGIN:
      window.localStorage.setItem("frontend-jwt-token", action.payload);
      // setToken(action.payload);
      const tokenData = jwt_decode(action.payload);
      return {
        ...state,
        isAuthenticated: true,
        isLoading: false,
        userId: tokenData.sub,
      };
    case authActions.FRONTEND_REGISTER:
      return {
        ...state,
        isLoading: false,
        registerSuccess: [...action.payload],
      };
    case authActions.LOGIN_ERROR:
      return {
        ...state,
        // errorMessages: [...action.payload],
        isAuthenticated: false,
        isLoading: false,
      };
    case authActions.FRONTEND_LOGOUT:
      window.localStorage.removeItem("frontend-jwt-token");
      window.localStorage.removeItem("checkoutAddress");
      window.localStorage.removeItem("checkoutCompleted");
      // setToken(null);
      return {
        ...state,
        isAuthenticated: false,
        userId: "",
        userDetails: {},
      };
    case authActions.SET_AUTH_USER:
      return {
        ...state,
        isAuthenticated: true,
        userId: action.payload.userId,
      };
    case authActions.SET_USER_DETAILS:
      return {
        ...state,
        userDetails: { ...action.payload },
      };
    case authActions.CLEAR_ERRORS:
      return {
        ...state,
        errorMessages: [],
        registerSuccess: [],
      };
    case authActions.SET_CHECKOUT_DETAILS:
      return {
        ...state,
        checkoutAsGuest: { ...action.payload },
      };
    case authActions.USER_ORDER_LIST:
      return {
        ...state,
        user_order_list: [...action.payload],
      };
    default:
      return state;
  }
};
