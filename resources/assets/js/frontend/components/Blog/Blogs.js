import React, { useEffect, useState } from "react";
import SinglePost from "./SinglePost";
import Sidebar from "../../component/Sidebar";
import LoaderSpinner from "../../component/LoaderSpinner";
import HelmetMetaData from "../HelmetMetaData/HelmetMetaData";

export default function Blogs() {
  const [blogs, setBlogs] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    window.scrollTo(0, 0);
    axios.get("api/get_blog_list").then((res) => {
      if (res.data.status == "success") {
        setBlogs(res.data.data);
      } else {
        setBlogs([]);
      }
      setLoading(false);
    });
  }, []);
  return (
    <div className="relative py-8 md:py-14">
      {loading ? (
        <LoaderSpinner />
      ) : (
        <div className="container mx-auto">
          <HelmetMetaData/>
          <div className="px-3 sm:px-6 lg:px-8 ">
            <div className="grid md:grid-cols-12 gap-5">
              <div className="col-span-12 md:col-span-8 xl:col-span-9">
                <div className="grid sm:grid-cols-2 md:grid-cols-3 gap-3">
                   {blogs.length > 0
                  ? blogs.map((blog) => (
                      <SinglePost blog={blog} key={blog.id} />
                    ))
                  : ""}
                  </div>
                </div>
              <Sidebar />
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
