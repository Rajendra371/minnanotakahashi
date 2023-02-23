import React, { Component } from "react";

export default function Banner(props) {
  const { discount, title, imgUrl, content } = props.banner;
  return (
    <div className="hero-item">
      <div className=" align-items-center justify-content-between">
        <div className="hero-image col px-0">
          <img src={imgUrl} alt="Carpet Image" />
        </div>
        <div className="content col">
          {/* <h2>{title}</h2> */}
          {/* <h1><small>HURRY UP!</small> <span className="big">{discount}%</span> OFF</h1> */}
          <p dangerouslySetInnerHTML={{ __html: content }} />
          {/* <a href="#">get it now</a> */}
        </div>
      </div>
    </div>
  );
}
