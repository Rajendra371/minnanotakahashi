import React, { Component } from "react";
import axios from "axios";
import plugin from "./plugins";
import {
  BrowserRouter as Router,
  Route,
  Redirect,
  Link
} from "react-router-dom";

const componentsMap = {
  // replace <img> tags by custom react component
  img: props => <Image {...props} />,
  // replace <a> tags by React Router Link component
  a: props => <Link {...props} to={props.href} />,
  // add lazy load to all iframes
  iframe: props => (
    <LazyLoad>
      <iframe {...props} />
    </LazyLoad>
  )
};

class Common extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    return <div />;
  }
}
export default Common;

class Popup extends React.Component {
  render() {
    return (
      <div className="popup">
        <div className="popup_inner">
          <h1>{this.props.text}</h1>
          <button onClick={this.props.closePopup}>close me</button>
        </div>
      </div>
    );
  }
}
var windows = $(window);
var screenSize = windows.width();
var sticky = $('.header-sticky');

windows.on('scroll', function() {
    var scroll = windows.scrollTop();
    if (scroll < 300) {
        sticky.removeClass('is-sticky');
    }else{
        sticky.addClass('is-sticky');
    }
});

