import React, { Component } from "react";
import { Route } from "react-router-dom";
import MainForm from "./MainForm";
export default class Index extends Component {
  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <div className="row">
            <div className="col-md-12">
              <MainForm />
            </div>
          </div>
        </div>
      </div>
    );
  }
}
