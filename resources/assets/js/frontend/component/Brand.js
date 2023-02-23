import React from "react";

export default function Brand(props) {
  return (
    <div className="brand-item col">
      <img
        src={props.imgUrl}
        alt={props.title}
        className="w-full object-contain h-28"
      />
    </div>
  );
}
