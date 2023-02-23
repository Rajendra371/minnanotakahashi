import React, { useEffect, useState } from "react";
import LoaderSpinner from "../../component/LoaderSpinner";
import HelmetMetaData from "../HelmetMetaData/HelmetMetaData";

export default function Videos() {
  const [videos, setVideos] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    window.scrollTo(0, 0);
    axios.get("api/get_video_list").then((res) => {
      if (res.data.status == "success") {
        setVideos(res.data.data);
      } else {
        setVideos([]);
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
          <div className="px-3 sm:px-6 lg:px-8 ">
            <div className="grid md:grid-cols-12 gap-5">
              <div className="col-span-12 md:col-span-12 xl:col-span-12">
                <div className="grid sm:grid-cols-2 md:grid-cols-3 gap-3">
                  {videos.length > 0
                    ? videos.map((video, idx) => (
                        <div className="mb-10 mx-5" key={idx}>
                          <iframe
                            width="100%"
                            height="315"
                            src={video.link}
                            frameBorder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                          />
                        </div>
                      ))
                    : ""}
                </div>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
