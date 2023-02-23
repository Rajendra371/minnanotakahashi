import React, { useState, useEffect } from "react";
import LoaderSpinner from "../../component/LoaderSpinner";
import Sidebar from "../../component/Sidebar";
import ReactHtmlParser from "react-html-parser";
import FacebookShare from "../SocialMediaShare/FacebookShare";
import TwitterShare from "../SocialMediaShare/TwitterShare";

export default function Detail(props) {
  const [detail, setDetail] = useState([]);
  const [loading, setLoading] = useState(true);
  const id = props.match.params.id;
  useEffect(() => {
    window.scrollTo(0, 0);
    axios.post("api/get_study_destination_detail", { id: id }).then((res) => {
      if (res.data.status == "success") {
        setDetail(res.data.data[0]);
      } else {
        setDetail([]);
      }
      setLoading(false);
    });
  }, [id]);
  return (
    <div className="relative py-8 md:py-14">
      {loading ? (
        <LoaderSpinner />
      ) : (
        <div className="container mx-auto">
          <div className="px-3 sm:px-6 lg:px-8 ">
            <img src={detail.image} className="h-52 w-full object-contain" />
            <div className="grid md:grid-cols-12 gap-5 mt-8">
              <div className="col-span-12 md:col-span-8 xl:col-span-9">
                <div className="content mb-3">
                  <div className="category-title">
                    <h2 className="font-medium text-secondary text-2xl font-bold mt-5">
                      {detail.title}
                    </h2>
                  </div>
                </div>
                <div className="bg-white p-5 rounded-lg shadow-lg text-justify text-sm text-write">
                  {ReactHtmlParser(detail.content)}
                </div>
                <div className="flex flex-col sm:flex-row sm:items-center justify-between my-5">
                  <div className="social_share">
                    <label className="inline-block mr-3">Share on : </label>
                    <div className="social_icons">
                      <FacebookShare
                        url={detail.share_url}
                        quote={detail.title}
                      />
                      <TwitterShare
                        url={detail.share_url}
                        title={detail.title}
                      />
                    </div>
                  </div>
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
