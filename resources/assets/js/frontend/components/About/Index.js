import React, { useState, useEffect } from "react";
import LoaderSpinner from "../../component/LoaderSpinner";
import HelmetMetaData from "../HelmetMetaData/HelmetMetaData";
import ReactHtmlParser from "react-html-parser";
import SectionTitle from "../../component/SectionTitle";

export default function Index() {
  const [aboutUs, setAboutUs] = useState([]);
  const [loader, setLoader] = useState(true);

  useEffect(() => {
    window.scrollTo(0, 0);
    axios.get("api/home/about_us").then((res) => {
      if (res.data.status == "success") {
        setLoader(false);
        setAboutUs(res.data.data);
      } else {
        setAboutUs([]);
      }
    });
  }, []);
  return (
    <React.Fragment>
      <HelmetMetaData />
      <div className="relative py-8 md:py-14">
        <div className="container mx-auto">
          <div className="px-3 sm:px-6 lg:px-8 ">
            <div className="grid md:grid-cols-12 gap-5">
              <div className="col-span-12">
                {loader ? (
                  <LoaderSpinner />
                ) : (
                  <React.Fragment>
                    <SectionTitle
                      upper="About us"
                      lower={aboutUs.short_content}
                      align="left"
                    />
                    {aboutUs.imgUrl !== "" ? (
                      <img
                        width="600"
                        height="200"
                        className="float-right py-2 md:px-3 md:-mt-40"
                        src={aboutUs.imgUrl}
                      />
                    ) : (
                      ""
                    )}
                    <div className="rounded-xl shadow-md p-5 bg-white text-write text-sm text-justify">
                      {ReactHtmlParser(aboutUs.description)}
                    </div>
                  </React.Fragment>
                )}
              </div>
            </div>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
}
