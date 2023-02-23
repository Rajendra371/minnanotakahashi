import React, { Component } from "react";

class AdminFooter extends Component {
  render() {
    const { children, ...attributes } = this.props;

    return (
      <React.Fragment>
        <div className="container-fluid">
            <span>
              {new Date().getFullYear()}
              &nbsp; info@xelwel.com.np{" "}
            </span>
            <span className="ml-auto">
              <span className="powered_right pull-right text-right">
                {" "}
                Powered by: <a href="https://xelwel.com.np">Xelwel Innovation Pvt. Ltd.</a>
              </span>
            </span>
          </div>
      </React.Fragment>
    );
  }
}

export default AdminFooter;
