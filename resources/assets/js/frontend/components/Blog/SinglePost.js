import React from "react";
import { Link } from "react-router-dom";

export default function SinglePost(props) {
  const { blog } = props;

  return (
      <div className="bg-white shadow-lg rounded-lg">
        <div className="image">
          <Link to={`/blog/${blog.id}`} className="img">
            <img
              src={blog.image}
              alt="Blog"
              height="300"
              width="100%"
              style={{ objectFit: "cover" }}
            />
          </Link>
        </div>
        <div className="content">
          <div className="category-title p-3">
            <span className="text-sm text-black bg-primary block w-max p-1 rounded-sm my-2">
              {/* by Author Name | Sept 27 2019 */}
              {blog.author} | {blog.created_at}
            </span>
            <h5 className="font-medium text-dark-secondary text-md font-bold hover:opacity-80">
              <Link to={`/blog/${blog.id}`}>{blog.title}</Link>
            </h5>
          </div>
        </div>
      </div>
    
  );
}
