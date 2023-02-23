import {
  BACKEND_LOGIN_PAGE_UNLOADED,
  BACKEND_REGISTER_PAGE_UNLOADED,
} from "../components/Login/constants";

import {
  BACKEND_REDIRECT,
  BACKEND_APP_LOAD,
} from "../components/Common/Constant";

export default (state = {}, action) => {
  switch (action.type) {
    case BACKEND_APP_LOAD:
      return {
        ...state,
      };
    case BACKEND_LOGIN_PAGE_UNLOADED:
    case BACKEND_REGISTER_PAGE_UNLOADED:
      return { ...state, viewChangeCounter: state.viewChangeCounter + 1 };
    case BACKEND_REDIRECT:
      return { ...state, redirectTo: null };
    default:
      return state;
  }
};
