import React, { Component } from "react";
import { Tab, TabPanel, Tabs, TabList } from "react-web-tabs";
import { Link, NavLink } from "react-router-dom";
import { getToken, requests } from "../defaultsetting/utils/requests";

class DynamicTab extends Component {
  constructor(props) {
    super(props);
    this.state = {
      tabData: [],
    };
    this.LoadTab = this.LoadTab.bind(this);
  }
  componentDidMount() {
    axios.defaults.headers.common["Authorization"] = `Bearer ${getToken()}`;
    this.LoadTab(this.props.data);
  }

  componentDidUpdate(prevProps) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${getToken()}`;
    if (prevProps.data !== this.props.data) {
      this.LoadTab(this.props.data);
    }
  }

  LoadTab(prop_url) {
    // console.log(url);
    axios
      .get("api/tab_menu", {
        params: {
          url: prop_url,
        },
      })
      .then((response) => {
        // checktoken(response);
        if (response.data.status == "success") {
          this.setState({ tabData: response.data.data });
        } else {
          this.setState({ tabData: "" });
        }
      });
  }
  render() {
    var langsel = window.localStorage.getItem("selectedLang");
    var selectclass = "link";
    return (
      <div className="horizontal-page">
        <Tabs>
          <TabList>
            {this.state.tabData.map((link, idx) => {
              var urlstatus = link.urlstatus;
              if (urlstatus == "cur") {
                selectclass = "link selected";
              } else {
                selectclass = "link";
              }
              return (
                <Link
                  key={idx}
                  to={constvar.administrator + link.modulelink}
                  className={selectclass}
                >
                  {langsel == "en" ? (
                    <Tab tabFor={constvar.administrator + link.modulelink}>
                      {link.displaytext}
                    </Tab>
                  ) : (
                    <Tab tabFor={constvar.administrator + link.modulelink}>
                      {link.displaytextnp}
                    </Tab>
                  )}
                </Link>
              );
            })}
          </TabList>
        </Tabs>
        {/* <p>{this.props.data}</p> */}
      </div>
    );
  }
}
export default DynamicTab;
