export const parseJwt = (token) => {
  if (token > 0) {
    let base64Url = token.split(".")[1];
    let base64 = base64Url.replace("-", "+").replace("", "");
    return JSON.parse(window.atob(base64));
  }
  return;
};
