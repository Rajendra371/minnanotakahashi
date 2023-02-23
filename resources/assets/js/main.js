import React from "react";
import { render } from "react-dom";
import { Provider } from "react-redux";
import { BrowserRouter } from "react-router-dom";

import configureStore from "./defaultsetting/store";
import App from "./components/index";

import { IntlProvider, addLocaleData, FormattedMessage } from "react-intl";
import englishLanguage from "./language/en.json";
import nepaliLanguage from "./language/np.json";

global.FormattedMessage = FormattedMessage;
global.englishLanguage = englishLanguage;
global.nepaliLanguage = nepaliLanguage;

import en from "react-intl/locale-data/en";
import ne from "react-intl/locale-data/ne";

addLocaleData([...en, ...ne]);
const language_msg = {
  ne: nepaliLanguage,
  en: englishLanguage,
};

require("dotenv").config();

const store = configureStore({});

// const MOUNT_NODE = document.getElementById('app');
const selectedLang = window.localStorage.getItem("selectedLang");
const language = selectedLang ? selectedLang : "en";
// console.log(language);

render(
  <IntlProvider locale={language} messages={language_msg[language]}>
    <Provider store={store}>
      <BrowserRouter>
        <App />
      </BrowserRouter>
    </Provider>
  </IntlProvider>,
  document.getElementById("app")
);
