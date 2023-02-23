import React from "react";
import { FacebookShareButton, FacebookIcon } from "react-share";

const FacebookShare = (props) => {
  let url = props.url !== undefined ? props.url : "http://dial.xelwel.com/";
  let quote =
    props.quote !== undefined
      ? props.quote
      : "The Dial Int'l Education Pvt.Ltd";
  let hashtag = props.hashtag !== undefined ? props.hashtag : "#thedial";
  return (
    <FacebookShareButton url={url} quote={quote} hashtag={hashtag}>
      <FacebookIcon size={36} />
    </FacebookShareButton>
  );
};

export default FacebookShare;
