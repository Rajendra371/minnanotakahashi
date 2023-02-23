import React from "react";
import { TwitterShareButton, TwitterIcon } from "react-share";

const TwitterShare = (props) => {
  let url = props.url !== undefined ? props.url : "http://dial.xelwel.com/";
  let title =
    props.title !== undefined
      ? props.title
      : "The Dial Int'l Education Pvt.Ltd";
  return (
    <TwitterShareButton url={url} title={title}>
      <TwitterIcon size={36} />
    </TwitterShareButton>
  );
};

export default TwitterShare;
