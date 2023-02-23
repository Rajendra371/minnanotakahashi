import React, { useState, useEffect } from "react";
import { Helmet } from "react-helmet";
import { useLocation } from "react-router-dom";

const HelmetMetaData = (props) => {
  const [seo, setSeo] = useState([]);
  const [general, setGeneral] = useState([]);

  useEffect(() => {
    axios.get("api/get_seo_data").then((res) => {
      if (res.data.status == "success") {
        setSeo(res.data.data["seo"]);
        setGeneral(res.data.data["general"]);
      }
    });
    return () => {
      $.each($("meta"), function() {
        $(this).remove();
      });
    };
  }, []);

  useEffect(() => {
    setTimeout(() => {
      $.each($("meta"), function() {
        $(this).removeAttr("data-react-helmet");
      });
    }, 2000);
  }, [seo, general]);

  let db_seo_name = seo.seo_metakeyword !== null ? seo.seo_metakeyword : "";
  let db_seo_description =
    seo.seo_metadescription !== null ? seo.seo_metadescription : "";

  let location = useLocation();
  let currentUrl = general.host_name + location.pathname;
  let quote = props.quote !== undefined ? props.quote : "";
  let seo_title =
    seo.seo_title !== null
      ? seo.seo_title
      : "THE DIAL INT'L EDUCATION - Experience You Can Count On";
  let image = props.image !== undefined ? props.image : general.logo;
  let description =
    props.description !== undefined
      ? props.description
      : "THE DIAL INT'L EDUCATION is a licensed educational consultant who specializes in overseas education and Career enhancement services. We are located in Chitwan, Nepal educational hub of the country.";
  let hashtag = props.hashtag !== undefined ? props.hashtag : "#thedial";

  return (
    <Helmet>
      <title>{seo_title}</title>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="csrf_token" content="" />
      <meta property="type" content="website" />
      <meta property="url" content={currentUrl} />
      <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
      />
      <meta name="msapplication-TileColor" content="#ffffff" />
      <meta name="msapplication-TileImage" content="/ms-icon-144x144.png" />
      <meta name="theme-color" content="#ffffff" />
      <meta name="_token" content="" />
      <meta name="robots" content="noodp" />
      <meta property="title" content={seo_title} />
      <meta property="quote" content={quote} />
      <meta name="description" content={description} />
      <meta name="keywords" content="The Dial Education" />
      <meta property="image" content={image} />
      <meta property="og:locale" content="en_US" />
      <meta property="og:type" content="website" />
      <meta property="og:title" content={seo_title} />
      <meta property="og:quote" content={quote} />
      <meta property="og:hashtag" content={hashtag} />
      <meta property="og:image" content={image} />
      <meta content="image/*" property="og:image:type" />
      <meta property="og:url" content={currentUrl} />
      <meta property="og:site_name" content="The Dial" />
      <meta property="og:description" content={description} />
      <meta property={db_seo_name} content={db_seo_description} />

      <meta itemprop="name" content={seo_title} />
      <meta itemprop="description" content={description} />

      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content={seo_title} />
      <meta name="twitter:description" content={description} />
      <meta name="twitter:image" content={image} />
    </Helmet>
  );
};

export default HelmetMetaData;
