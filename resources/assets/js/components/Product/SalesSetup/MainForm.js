import React, { Component } from "react";
import axios from "axios";

export default class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      form_template: "",
    };
  }
  componentDidMount() {
    axios
      .get(constvar.api_url + "sales_setup/get_form_template")
      .then((response) => {
        if (response.data.status == "success") {
          $("#site_setup_form_div").html(response.data.data);
          this.setState({ form_template: response.data.data });
        } else {
          this.setState({ form_template: "" });
        }
      });
  }

  render() {
    return <div id="site_setup_form_div" />;
  }
}
