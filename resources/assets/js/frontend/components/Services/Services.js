import React, { useState, useEffect } from "react";
import SectionTitle from "../../component/SectionTitle";
import LoaderSpinner from "../../component/LoaderSpinner";
import ReactHtmlParser from "react-html-parser";

// const service = [
//   { icon: "public", title: "Country Information" },
//   { icon: "live_help", title: "Education Counselling" },
//   { icon: "subject", title: "Selection of Course" },
//   { icon: "school", title: "Admission Guidance" },
//   { icon: "explore", title: "Career Abroad" },
//   { icon: "flight_takeoff", title: "Travel Guidance" },
//   { icon: "school", title: "Visa Assistance" },
//   { icon: "credit_card", title: "Financial Estimation" },
// ];
export default function Services(props) {
  const [services, setServices] = useState([]);
  const [docId, setDocId] = useState(null);
  const [loading, setLoading] = useState(true);
  useEffect(() => {
    setDocId(window.location.hash.slice(1));
    const elem = document.getElementById(docId);
    if (elem) {
      elem.scrollIntoView(true);
      window.scrollBy(0, -90);
    }
    window.scrollTo(0, 0);
  }, [docId]);
  useEffect(() => {
    axios.get("api/home/get_services").then((response) => {
      if (response.data.status == "success") {
        setServices(response.data.data);
        setLoading(false);
      } else {
        setServices([]);
      }
    });
  }, []);
  return (
    <div className="relative py-8 md:py-14">
      {loading ? (
        <LoaderSpinner />
      ) : (
        <div className="container mx-auto">
          <div className="px-3 sm:px-6 lg:px-8 ">
            <div className="services">
              {services.length > 0
                ? services.map((item, idx) => (
                    <div
                      id={item.title
                        .toLowerCase()
                        .split(" ")
                        .join("_")}
                      key={idx}
                      className="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8 sm:mb-20 items-start"
                    >
                      {item.imgUrl ? (
                        <img
                          className="object-cover h-100 lg:order-2 rounded-lg  lg:col-span-2 z-1"
                          src={item.imgUrl}
                          width="100%"
                        />
                      ) : (
                        ""
                      )}
                      <div className="lg:order-1  lg:col-span-1  lg:-mr-20 z-2 relative mx-3 sm:mx-5 lg:mr-0 -mt-24 sm:-mt-32 lg:mt-0">
                        <SectionTitle lower={item.title} align="center" />
                        <div className="p-3 sm:p-5 rounded-lg shadow-lg bg-secondary ">
                          <p className="text-xs sm:text-sm font-light text-white  m-0 text-justify sm:leading-normal">
                            {ReactHtmlParser(item.content)}
                          </p>
                        </div>
                      </div>
                    </div>
                  ))
                : ""}
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
