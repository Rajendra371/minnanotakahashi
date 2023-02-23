import React, { Component } from "react";
import MainForm from "./MainForm";
import List from "./List";
export default class Index extends Component {
  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <div className="row">
            <div className="col-md-6">
              <MainForm />
            </div>
            <div className="col-md-6">
              <List />
            </div>
          </div>
        </div>
      </div>
    );
  }
}
