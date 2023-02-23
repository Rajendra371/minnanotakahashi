import React, { useState, useEffect } from "react";
import SectionTitle from "../component/SectionTitle";
import Sidebar from "../component/Sidebar";
import LoaderSpinner from "../component/LoaderSpinner";

export default function Cms_Page(props) {
  const [pageDetail, setPageDetail] = useState([]);

  useEffect(() => {
    const slug = props.match.params.slug;
    if (slug) {
      axios.post("api/get_page_details", { slug: slug }).then((res) => {
        if (res.data.status == "success") {
          setPageDetail(res.data.data);
        } else {
          setPageDetail([]);
        }
        // setLoading(false);
      });
    }
    return () => {
      setPageDetail([]);
    };
  }, []);

  return (
    <div className="relative py-8 md:py-14">
      {/* {loading ? (
        <LoaderSpinner />
      ) : ( */}
        <div className="container mx-auto">
          <div className="px-3 sm:px-6 lg:px-8 ">
            <div className="grid md:grid-cols-12 gap-5">
                <div className="col-span-12 md:col-span-8 xl:col-span-9">
                  <SectionTitle lower={pageDetail.page_title} align="left"/>
                  <div
                    className="rounded-lg shadow-md p-5 bg-white text-write text-sm md:text-base text-justify"
                    dangerouslySetInnerHTML={{ __html: pageDetail.description }}
                  />
                  </div>
              <Sidebar />
            </div>
          </div>
        </div>
      {/* )} */}
    </div>
  );
}
