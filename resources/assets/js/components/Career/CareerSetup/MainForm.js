import React, { Component } from "react";

export default class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  componentDidMount() {
    var qrystring = window.location.search;
    var res = qrystring.split("=");
    var id = res[1];

    var postdata = { id: id };
    axios
      .post(constvar.api_url + "career_setup/get_form", postdata)
      .then((response) => {
        if (response.data.status == "success") {
          $("#templatediv").html(response.data.template);
        }
      });
  }
  render() {
    return (
      <div>
        {" "}
        <div id="templatediv" />
      </div>
    );
  }
}
