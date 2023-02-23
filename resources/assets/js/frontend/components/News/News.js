import React, { useEffect, useState } from "react";
import SingleNews from "./SingleNews";
import Sidebar from "../../component/Sidebar";
import LoaderSpinner from "../../component/LoaderSpinner";
import HelmetMetaData from "../HelmetMetaData/HelmetMetaData";

export default function News() {
  const [news, setNews] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    window.scrollTo(0, 0);
    axios.get("api/get_news_list").then((res) => {
      if (res.data.status == "success") {
        setNews(res.data.data);
      } else {
        setNews([]);
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
          <HelmetMetaData />
          <div className="px-3 sm:px-6 lg:px-8 ">
            <div className="grid md:grid-cols-12 gap-5">
              <div className="col-span-12 md:col-span-8 xl:col-span-9">
                <div className="grid sm:grid-cols-2 md:grid-cols-3 gap-3">
                  {news.length > 0
                    ? news.map((news) => (
                        <SingleNews news={news} key={news.id} />
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
