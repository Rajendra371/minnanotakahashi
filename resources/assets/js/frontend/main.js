import React from "react";
import { render } from "react-dom";
import { BrowserRouter} from "react-router-dom";
import App from "./layouts/Index";

require("dotenv").config();

render(
  <BrowserRouter>
    <App />
  </BrowserRouter>,
  document.getElementById("app_frontend")
);
