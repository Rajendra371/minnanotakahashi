import { requests, getToken } from "../../defaultsetting/utils/requests";
import { parseJwt } from "../../defaultsetting/utils";

const Auth = {
  login: (values) => requests.post(constvar.api_url + "login", values),
  register: (values) => requests.post(constvar.api_url + "register", values),
  current: () => parseJwt(getToken()),
};

export default Auth;
