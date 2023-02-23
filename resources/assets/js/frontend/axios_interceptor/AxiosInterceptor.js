export function axios_interceptor() {
  axios.interceptors.request.use(
    function(config) {
      return config;
    },
    function(error) {
      return Promise.reject(error);
    }
  );

  axios.interceptors.response.use(
    function(response) {
      return response;
    },
    function(error) {
      // console.log(error.response);
      if (error.response.status === 401) {
        localStorage.removeItem("frontend-jwt-token");
      }
      // return Promise.reject(error);
      return error.response;
    }
  );
}
