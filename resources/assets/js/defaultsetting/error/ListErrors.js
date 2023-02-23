import React from "react";
import { Alert } from "reactstrap";

class ListErrors extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      visible: true,
    };

    this.onDismiss = this.onDismiss.bind(this);
  }

  onDismiss(e) {
    var that = this;
    setTimeout(function() {
      that.setState({ visible: false });
    }, 4000);
  }

  render() {
    const errors = this.props.errors;
    if (errors) {
      return (
        <div>
          {this.state.visible == true ? (
            <div>
              <Alert color="danger">{errors.message}</Alert>
              {this.onDismiss(errors)}
            </div>
          ) : null}
        </div>
      );
    } else {
      return null;
    }
  }
}

export default ListErrors;
