import React, { Component } from "react";
import { Link, Route } from "react-router-dom";
import "react-sortable-tree/style.css";
import SortableTree from "react-sortable-tree";
export default class Moduleorder extends Component {
  constructor(props) {
    super(props);
    this.state = {
      mdata: "",
      treeData: []
    };
    this.updateTreeData = this.updateTreeData.bind(this);
  }
  componentDidMount() {
    axios.get(constvar.api_url + "module/showmenuorder").then(response => {
      console.log(response.data);
      this.setState({
        treeData: response.data
      });
    });
  }

  updateTreeData(treeData) {
    this.setState({ treeData });
    axios
      .post(constvar.api_url + "module/updateallmoduleorder", {
        treeData: treeData
      })
      .then(response => {});
  }
  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <div className="row">
            <div className="col-md-12" />
            <div
              className="well"
              dangerouslySetInnerHTML={{
                __html: this.state.mdata
              }}
            />
          </div>
          <div className="moduleorder">
            <SortableTree
              treeData={this.state.treeData}
              onChange={this.updateTreeData}
            />
          </div>
        </div>
      </div>
    );
  }
}
