import React, { Component } from "react";
import Info from "./Info";

export default class Home extends Component {
  state = {
    dashboardInfo: [
      // {
      //   id: 1,
      //   totalcount: 5412,
      //   totalper: 70,
      //   icon: "people",
      //   color: "blue",
      //   name: "Total Visitors",
      // },
      // {
      //   id: 2,
      //   totalcount: 3455,
      //   totalper: 50,
      //   icon: "login",
      //   color: "purple",
      //   name: "New Signups",
      // },
      // {
      //   id: 3,
      //   totalcount: 3435,
      //   totalper: 40,
      //   icon: "like",
      //   color: "cyan",
      //   name: "Email Enquiries",
      // },
      // {
      //   id: 4,
      //   totalcount: 2345,
      //   totalper: 72,
      //   icon: "people",
      //   color: "green",
      //   name: "Total Visits",
      // },
    ],
  };

  componentDidMount() {
    setTimeout(() => {
      axios.get(constvar.api_url + "dashboard").then((res) => {
        if (res.data.status == "success") {
          this.setState({ dashboardInfo: res.data.data[0] });
        } else {
          this.setState({ dashboardInfo: [] });
        }
      });
    }, 1000);
  }

  render() {
    // console.log("dashboard:", this.state.dashboardInfo);
    return (
      <div className="white-box">
        <div className="content-area">
          <div className="row">
            {this.state.dashboardInfo.length > 0
              ? this.state.dashboardInfo.map((info) => (
                  <Info key={info.id} info={info} />
                ))
              : ""}
          </div>
        </div>
      </div>
    );
  }
}
