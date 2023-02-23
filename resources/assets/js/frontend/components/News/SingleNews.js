import React from "react";
import { Link } from "react-router-dom";

export default function SingleNews(props) {
  const { news } = props;

  return (
    <div className="bg-white shadow-lg rounded-lg">
      <div className="image">
        <Link to={`/news/${news.id}`} className="img">
          <img
            src={news.image}
            alt="news"
            height="300"
            width="100%"
            style={{ objectFit: "cover" }}
          />
        </Link>
      </div>
      <div className="content">
        <div className="category-title p-3">
          <span className="text-sm text-black bg-primary block w-max p-1 rounded-sm my-2">
            {news.author} | {news.created_at}
          </span>
          <h5 className=" text-dark-secondary text-md font-bold hover:opacity-80">
            <Link to={`/news/${news.id}`}>{news.title}</Link>
          </h5>
        </div>
      </div>
    </div>
  );
}
