export function axios_interceptor() {
  axios.interceptors.request.use(
    function(config) {
      // spinning start to show
      if (config.hide_loader === undefined) {
        document.body.classList.add("loading-indicator");
      }
      return config;
    },
    function(error) {
      return Promise.reject(error);
    }
  );

  axios.interceptors.response.use(
    function(response) {
      // spinning hide
      document.body.classList.remove("loading-indicator");
      return response;
    },
    function(error) {
      if (error.response.status === 401) {
        localStorage.removeItem("backend-jwt-token");
        window.location = "/admin";
      }
      return Promise.reject(error);
    }
  );
}
