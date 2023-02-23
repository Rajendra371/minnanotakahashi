import React, { Component, lazy, Suspense } from "react";
import { getToken } from "../../defaultsetting/utils/requests";
import Info from "./Info";

export default class Home extends Component {
  state = {
    dashboardinfo: [
      { id: 1, totalcount: 22, totalper: 72, name: "Total Visits" },
      { id: 2, totalcount: 22, totalper: 72, name: "Total Visits" },
      { id: 3, totalcount: 22, totalper: 72, name: "Total Visits" },
      { id: 4, totalcount: 22, totalper: 72, name: "Total Visits" }
    ]
  };

  render() {
    return (
      <div>
        <div className="date-section">
          <div className="white-box">
            <div className="row">
              <div className="col-md-4">
                {this.state.dashboardinfo.map(info => (
                  <Info key={info.id} info={info} />
                ))}
              </div>
              {/* <div className="col-md-7">
                <List />
              </div> */}
            </div>
          </div>
        </div>
      </div>
    );
  }
}
