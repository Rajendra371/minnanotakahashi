import React, { Component } from "react";
class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  componentDidMount() {
    axios.get(constvar.api_url + "gallery_setup_form").then((response) => {
      if (response.data.status == "success") {
        $("#gallerySetupFormDiv").html(response.data.template);
      } else {
        $("#gallerySetupFormDiv").html(response.data.message);
      }
    });
  }

  render() {
    return <div id="gallerySetupFormDiv" />;
  }
}

export default MainForm;
