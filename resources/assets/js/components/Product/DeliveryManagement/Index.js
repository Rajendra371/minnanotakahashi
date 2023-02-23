import React, { Component } from "react";
import List from "./List";

export default class Index extends Component {
  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <div className="row">
            <div className="col-md-12">
              <List />
            </div>
          </div>
        </div>
      </div>
    );
  }
}
