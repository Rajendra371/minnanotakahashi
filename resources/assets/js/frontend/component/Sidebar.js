import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import SideNavTitle from "./SideNavTitle";

export default function Sidebar() {
  const [blogs, setBlogs] = useState([]);
  useEffect(() => {
    axios.get("api/get_blog_list/4").then((res) => {
      if (res.data.status == "success") {
        setBlogs(res.data.data);
      } else {
        setBlogs([]);
      }
    });
    return () => {
      setBlogs([]);
    };
  }, []);

  return (
    <div className="col-span-12 md:col-span-4 xl:col-span-3">
      <div className="bg-primary p-5 shadow-lg rounded-lg">
        <div className="">
          <SideNavTitle title="Related Links" />
          <ul className="mb-3 border-light-gray">
            {/* <li className="px-2"> <a href="#">Category 1<span className="number">3</span></a></li> */}
            <li className="px-2">
              <Link
                className="py-2 font-medium text-sm text-black transition-transform duration-500 inline-block hover:opacity-70 transform hover:translate-x-2"
                to="/about"
              >
                About
              </Link>
            </li>
            <li className="px-2">
              <Link
                className="py-2 font-medium text-sm text-black transition-transform duration-500 inline-block hover:opacity-70 transform hover:translate-x-2"
                to="/faq"
              >
                FAQ
              </Link>
            </li>
            <li className="px-2">
              <Link
                className="py-2 font-medium text-sm text-black transition-transform duration-500 inline-block hover:opacity-70 transform hover:translate-x-2"
                to="/pages/terms-and-condition"
              >
                Terms & Conditions
              </Link>
            </li>
            <li className="px-2">
              <Link
                className="py-2 font-medium text-sm text-black transition-transform duration-500 inline-block hover:opacity-70 transform hover:translate-x-2"
                to="/pages/privacy-policy"
              >
                Privacy Policy
              </Link>
            </li>
          </ul>
          <SideNavTitle title="Popular Posts" />
          <ul className="">
            {blogs.length > 0
              ? blogs.map((blog) => (
                  <li key={blog.id} className=" grid grid-cols-7 gap-2 py-2">
                    <div className="col-span-2">
                      <span className="p-1 bg-light-gray text-black text-center rounded-sm block text-sm">
                        {blog.created_at}
                      </span>
                    </div>
                    {/* <Link className="py-2 font-medium text-sm text-black transition-transform duration-500 inline-block hover:opacity-70 " to={`/blog/${blog.id}`}>
                      <img src={blog.image} height="80" width="100%" />
                    </Link> */}
                    <div className="col-span-5">
                      <Link
                        className=" font-medium text-sm text-black transition-transform duration-500 inline-block hover:opacity-70 "
                        to={`/blog/${blog.id}`}
                      >
                        {blog.title}
                      </Link>
                    </div>
                  </li>
                ))
              : ""}
          </ul>
        </div>
      </div>
      <div className="banner-sidebar mt-5">
        {/* <a href="">
          <img
            src={`../../../../../public/images/frontend/banner/banner-5.jpg`}
            height="200"
            width="100%"
          />
        </a> */}
      </div>
    </div>
  );
}
