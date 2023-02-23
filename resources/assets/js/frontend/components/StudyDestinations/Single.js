import React from "react";
import { Link } from "react-router-dom";

export default function Single(props) {
  const { dest } = props;

  return (
    <div className="bg-white shadow-lg rounded-lg">
      <div className="image">
        <Link to={`/study_destintaion/${dest.id}`} className="img">
          <img
            src={dest.image}
            alt="dest"
            height="300"
            width="100%"
            style={{ objectFit: "cover" }}
          />
        </Link>
      </div>
      <div className="content">
        <div className="category-title p-3">
          <h5 className="font-medium text-dark-secondary text-md font-bold hover:opacity-80">
            <Link to={`/study_destintaion/${dest.id}`}>{dest.title}</Link>
          </h5>
          <span className="text-md">{dest.short_content}</span>
        </div>
      </div>
    </div>
  );
}
