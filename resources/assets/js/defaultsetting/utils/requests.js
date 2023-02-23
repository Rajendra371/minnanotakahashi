import superagentPromise from "superagent-promise";
import _superagent from "superagent";

const superagent = superagentPromise(_superagent, global.Promise);

// let API_ROOT = process.env.REACT_APP_DEV_API_URL;
let API_ROOT = `${location.protocol}//${location.host}`; // 'http://127.0.0.1:8000';
const responseBody = (res) => res.body;

let token = null;

const tokenPlugin = (req) => {
  if (token) {
    req.set("Authorization", `Bearer ${token}`);
  }
};

const jsonPlugin = (req) => {
  req.set("Content-Type", "application/json");
};

export const requests = {
  del: (url) =>
    superagent
      .del(`${API_ROOT}${url}`)
      .use(tokenPlugin)
      .use(jsonPlugin)
      .then(responseBody),
  get: (url) =>
    superagent
      .get(`${API_ROOT}${url}`)
      .use(tokenPlugin)
      .use(jsonPlugin)
      .then(responseBody),
  put: (url, body) =>
    superagent
      .put(`${API_ROOT}${url}`, body)
      .use(tokenPlugin)
      .use(jsonPlugin)
      .then(responseBody),
  post: (url, body) =>
    superagent
      .post(`${API_ROOT}${url}`, body)
      .use(tokenPlugin)
      .use(jsonPlugin)
      .then(responseBody),
};

export const setToken = (_token) => (token = _token);

export const getToken = () => token;
