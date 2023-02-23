import React, { useState, useEffect, useContext } from "react";
import { Link } from "react-router-dom";
import Banner from "../../component/Banner";
import Feature from "../../component/Feature";
import SectionTitle from "../../component/SectionTitle";
import Brand from "../../component/Brand";
import Slider from "react-slick";
import NavigateBeforeIcon from "@material-ui/icons/NavigateBefore";
import NavigateNextIcon from "@material-ui/icons/NavigateNext";
import "slick-carousel/slick/slick.css";
import HelmetMetaData from "../HelmetMetaData/HelmetMetaData";
import ReactHtmlParser from "react-html-parser";

// const countries = [
//   {
//     country: "Australia",
//     imgSrc:
//       "https://www.nationalgeographic.com/content/dam/travel/Guide-Pages/australia-oceania/sydney-travel.adapt.1900.1.jpg",
//   },
//   {
//     country: "USA",
//     imgSrc:
//       "https://www.planetware.com/photos-large/USNY/new-york-city-statue-of-liberty.jpg",
//   },
//   {
//     country: "Canada",
//     imgSrc:
//       "https://www.nationalgeographic.com/content/dam/travel/Guide-Pages/north-america/toronto-travel.adapt.1900.1.jpg",
//   },
//   {
//     country: "UK",
//     imgSrc:
//       "https://www.cityam.com/wp-content/uploads/2020/02/London_Tower_Bridge_City.jpg",
//   },
//   {
//     country: "Japan",
//     imgSrc:
//       "https://cdn-image.departures.com/sites/default/files/1576002985/header-tokyo-japan-LUXETOKYO1219.jpg",
//   },
//   {
//     country: "South Korea",
//     imgSrc:
//       "https://www.ledgerinsights.com/wp-content/uploads/2019/09/south-korea-real-estate-810x476.jpg",
//   },
//   {
//     country: "Germany",
//     imgSrc:
//       "https://assets.kpmg/content/dam/kpmg/xx/images/2019/04/berlin-skyline-with-spree-river-at-sunset-germany.jpg/jcr:content/renditions/original",
//   },
//   {
//     country: "New Zealand",
//     imgSrc:
//       "https://images.newscientist.com/wp-content/uploads/2019/05/31115907/rexfeatures_10171955a.jpg",
//   },
// ];

// const colleges = [
//   { title: "", imgSrc: "hPY8YdFnsI0" },
//   { title: "", imgSrc: "JqP6tWqBq3Q" },
//   { title: "", imgSrc: "tY4N7EhxOP4" },
//   { title: "", imgSrc: "o_gvQcU7IaE" },
//   { title: "", imgSrc: "envcmnpCZIk" },
//   { title: "", imgSrc: "n6Ggq-f9eNA" },
//   { title: "", imgSrc: "K_KRBl06QkU" },
// ];

export default function Index() {
  const [headerTiles, setHeaderTiles] = useState([]);
  const [bodyTiles, setbodyTiles] = useState([]);
  const [abroadStudies, setAbroadStudies] = useState([]);
  const [testimonials, setTestimonials] = useState([]);
  // const [services, setServices] = useState(service);
  const [latestNews, setLatestNews] = useState([]);
  const [educationVideo, setEducationVideo] = useState([]);
  const [associatedColleges, setAssociatedColleges] = useState([]);
  const [bannerData, setBannerData] = useState([]);
  const [shortDescription, setshortDescription] = useState([]);
  useEffect(() => {
    axios.get("api/home/get_frontend_data").then((response) => {
      if (response.data.status == "success") {
        setBannerData(response.data.data.banner_data);
        setLatestNews(response.data.data.news_data);
        setTestimonials(response.data.data.testimonial_data);
        setshortDescription(response.data.data.short_description);
        setEducationVideo(response.data.data.video_gallery);
        setAbroadStudies(response.data.data.study_destinations);
        setHeaderTiles(response.data.data.header_tiles);
        setbodyTiles(response.data.data.body_tiles);
        setAssociatedColleges(response.data.data.associated_college);
      } else {
        setBannerData([]);
        setLatestNews([]);
        setTestimonials([]);
        setshortDescription([]);
        setEducationVideo([]);
        setAbroadStudies([]);
        setHeaderTiles([]);
        setbodyTiles([]);
        setAssociatedColleges([]);
      }
    });
    return () => {
      setBannerData([]);
      setLatestNews([]);
      setTestimonials([]);
      setshortDescription([]);
      setEducationVideo([]);
      setAbroadStudies([]);
      setHeaderTiles([]);
      setbodyTiles([]);
      setAssociatedColleges([]);
    };
  }, []);

  function SamplePrevArrow(props) {
    const { className, style, onClick } = props;
    return (
      <button
        className="slick-arrow inset-x-1/2 absolute -bottom-5 md:-bottom-8 -ml-12  slick-prev h-10 w-10 focus:outline-none focus:bg-primary focus:text-white border border-primary bg-transparent transition-bg duration-500  hover:bg-primary"
        onClick={onClick}
        role="button"
        data-slide="prev"
      >
        <NavigateBeforeIcon style={{ color: "#76bb47" }} />
      </button>
    );
  }

  function SampleNextArrow(props) {
    const { className, style, onClick } = props;
    return (
      <button
        className="slick-arrow inset-x-1/2 absolute -bottom-5 md:-bottom-8 ml-0 slick-next  h-10 w-10 focus:outline-none focus:bg-primary focus:text-white border border-primary bg-transparent transition-bg duration-500  hover:bg-primary"
        onClick={onClick}
        role="button"
        data-slide="next"
      >
        <NavigateNextIcon style={{ color: "#76bb47" }} />
      </button>
    );
  }

  const settings = {
    className: "center",
    centerMode: true,
    infinite: false,
    centerPadding: "60px",
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    speed: 500,
    autoplaySpeed: 5000,
    loop: true,
    prevArrow: <SamplePrevArrow />,
    nextArrow: <SampleNextArrow />,
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
        },
      },
      {
        breakpoint: 670,
        settings: {
          slidesToShow: 1,
          centerMode: false,
          centerPadding: "0px",
        },
      },
    ],
  };
  const abroadSettings = {
    infinite: true,
    slidesToShow: abroadStudies.length,
    slidesToScroll: 1,
    autoplay: false,
    speed: 500,
    autoplaySpeed: 5000,
    prevArrow: <SamplePrevArrow />,
    nextArrow: <SampleNextArrow />,
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 670,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  };
  const vidSettings = {
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: false,
    speed: 500,
    autoplaySpeed: 5000,
    prevArrow: <SamplePrevArrow />,
    nextArrow: <SampleNextArrow />,
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 670,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  };
  const brandSettings = {
    arrows: false,
    dots: false,
    autoplay: false,
    infinite: false,
    slidesToShow: 5,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 5,
        },
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 4,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 479,
        settings: {
          slidesToShow: 2,
        },
      },
    ],
  };

  return (
    <React.Fragment>
      <HelmetMetaData />
      <div className="landing-page relative bg-cover bg-no-repeat py-0 mb-0">
        <div className="container mx-auto">
          <div className=" flex flex-col sm:flex-row pt-24 md:pt-20 mb-20 px-3 sm:px-6 lg:px-8 items-center">
            <div className="w-full order-2 sm:order-1 md:w-1/2 lg:w-5/12 xl:w-1/3">
              <div className="mt-24 md:mt-32 xl:mt-40">
                {bannerData.length > 0 ? (
                  <React.Fragment>
                    {ReactHtmlParser(bannerData[0].content)}{" "}
                    <Link className="btn" to={bannerData[0].button_url}>
                      {bannerData[0].button_text}
                    </Link>
                  </React.Fragment>
                ) : (
                  ""
                )}
              </div>
            </div>
            <div className="w-full order-1 sm:order-2 md:w-1/2 lg:w-7/12 xl:w-2/3  ">
              <div className="md:ml-20 hidden">
                <img
                  className="banner"
                  src="../../../../public/images/frontend/banner/study-abroad.png"
                />
              </div>
            </div>
          </div>

          <div className="sm:flex px-2  flex-wrap sm:px-6 lg:px-8">
            {headerTiles.length > 0
              ? headerTiles.map((item, idx) => (
                  <div key={idx} className="sm:w-1/2 lg:w-1/4">
                    <div className="sm:mx-2 lg:mx-3 mb-5 mb-lg-0">
                      <div className="bg-white shadow-lg py-2 sm:py-3 px-3 lg:py-5 lg:px-4 rounded-xl text-center">
                        <div>
                          {item.imgUrl ? (
                            <img
                              className="w-full object-contain h-20 mb-2"
                              src={item.imgUrl}
                            />
                          ) : (
                            <i className="material-icons text-primary text-4xl lg:text-7xl leading-snug">
                              {item.icon}
                            </i>
                          )}
                          <h5 className=" mb-3 lg:mb-6 font-semibold  text-lg sm:text-xl">
                            {item.title}
                          </h5>
                        </div>
                        <div>
                          <p className="text-xs sm:text-sm mb-4 lg:mb-6 text-write">
                            {item.content}
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                ))
              : ""}
          </div>
        </div>
      </div>

      
      <div className="relative  py-8 md:py-14   about-dial">
        <div className="container mx-auto">
          <div className=" px-3 sm:px-6 lg:px-8">
            <div className="grid   gap-3 lg:gap-5 grid-cols-1 sm:grid-cols-2 ">
              {shortDescription.length > 0
                ? shortDescription.map((item, key) => (
                    <div
                      className="py-8 px-5 bg-secondary rounded-xl text-white"
                      key={key}
                    >
                      <SectionTitle
                        lower={item.short_content}
                        upper={item.page_title}
                        align="center"
                      />
                      <p className="text-sm text-white text-justify">
                        {ReactHtmlParser(item.description)}
                      </p>
                    </div>
                  ))
                : ""}
            </div>
          </div>
        </div>
      </div>

      <div className="relative  py-8 md:py-14  bg-primary latest-news mt-10">
        <div className="container mx-auto">
          <div className=" px-3 sm:px-6 lg:px-8">
            <SectionTitle lower="Latest News & Events" upper="" align="left" />
            <div className="grid   gap-3 lg:gap-5 grid-cols-1 md:grid-cols-3">
              {latestNews.length > 0
                ? latestNews.map((item, idx) => (
                    <div
                      key={idx}
                      className={`relative border border-secondary mb-5`}
                    >
                      <img
                        className="w-full object-contain "
                        src={item.imgUrl}
                      />
                      <div className=" p-3 text-white">
                        {ReactHtmlParser(item.content)}
                        <Link
                          to={`news/${item.id}`}
                          className="text-white text-right block text-sm hover:text-secondary"
                        >{`More >>`}</Link>
                      </div>
                    </div>
                  ))
                : ""}
            </div>
            <div className=" text-right mt-10">
              <Link
                to="news"
                className="px-8 rounded-3xl py-2 inline-block transition-all duration-500 uppercase text-sm sm:text-base font-bold focus:outline-none focus:bg-opacity-80 bg-secondary text-white hover:bg-opacity-80"
              >
                VIEW ALL <i class="material-icons" />
              </Link>
            </div>
          </div>
        </div>
      </div>
      
      <div className="relative  pt-5 pb-8 md:pb-14  about-dial">
        <div className="grid   gap-2 lg:gap-3 grid-cols-1 sm:grid-cols-3">
          {bodyTiles.length > 0
            ? bodyTiles.map((item, idx) => (
                <div
                  className={`bg-primary b-6 py-10 px-4 flex sm:flex-col sm:items-center sm:justify-center items-start xl:items-start xl:flex-row`}
                >
                  {item.imgUrl ? (
                    <img
                      className="w-auto object-contain h-28"
                      src={item.imgUrl}
                    />
                  ) : (
                    <i className="text-4xl sm:text-6xl lg:text-8xl text-white material-icons">
                      {item.icon}
                    </i>
                  )}
                  <div className="ml-3 sm:ml-0 lg:ml-4">
                    <h4 className="uppercase mb-4 font-bold text-white text-2xl">
                      {item.title}
                    </h4>
                    <p className="text-white text-sm text-justify">
                      {item.content}
                    </p>
                  </div>
                </div>
              ))
            : ""}
        </div>
      </div>
      <div className="relative py-8 md:py-14 bg-secondary study_destinations">
        <div className="container mx-auto">
          <div className="px-3 sm:px-6 lg:px-8">
            <SectionTitle upper="" lower="Study Destinations" align="left" />
            <Slider {...abroadSettings}>
              {abroadStudies.length > 0
                ? abroadStudies.map((item, idx) => (
                    <div key={idx}>
                      <div className=" relative  px-4 py-3 border border-white text-center mb-10 mx-4">
                        {item.imgUrl ? (
                          <img
                            className="w-full object-contain h-28"
                            src={item.imgUrl}
                          />
                        ) : (
                          <i className="material-icons text-7xl text-primary block mb-4">
                            school
                          </i>
                        )}

                        <p className="text-xl  font-bold text-white mb-2">
                          {item.title}
                        </p>
                        <p className="text-md text-white">
                          {item.short_content}
                        </p>
                        <Link
                          to={`/study_destination/${item.id}`}
                          className="text-white text-sm block text-right hover:opacity-80"
                        >
                          More &gt;&gt;
                        </Link>
                      </div>
                      {/* <div className=" relative  px-4 py-3 border border-white text-center mb-10 mx-4">
                    <i className="material-icons text-7xl text-primary block mb-4">
                      school
                    </i>
                    <p className="text-xl  font-bold text-white mb-2">{`Study in ${
                      item.country
                    }`}</p>
                    <Link
                      to={`/${item.country
                        .toLowerCase()
                        .split(" ")
                        .join("_")}`}
                      className="text-white text-sm block text-right hover:opacity-80"
                    >
                      More &gt;&gt;
                    </Link>
                  </div> */}
                    </div>
                  ))
                : ""}
            </Slider>
          </div>
        </div>
      </div>
      <div className="relative py-8 md:py-14 bg-white">
        <div className="container mx-auto">
          <div className="px-3 sm:px-6 lg:px-8">
            <SectionTitle upper="" lower="Educational Video" align="left" />

            <Slider {...vidSettings}>
              {educationVideo.length > 0
                ? educationVideo.map((item, idx) => (
                    <div key={idx}>
                      <div className="  mb-10 mx-5">
                        <iframe
                          width="100%"
                          height="315"
                          src={item.link}
                          frameBorder="0"
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                          allowfullscreen
                        />
                      </div>
                    </div>
                  ))
                : ""}
            </Slider>
          </div>
        </div>
      </div>

      <div className="relative py-8 md:py-14">
        <div className="container mx-auto">
          <div className="px-3 sm:px-6 lg:px-8">
            <SectionTitle upper="" lower="Testimonials" align="left" />
            <Slider {...settings} className="testimonial">
              {testimonials.length > 0
                ? testimonials.map((item, idx) => (
                    <div key={idx}>
                      <div className="rounded-md shadow-xl relative bg-white mx-1 mt-6 px-8 pt-4 pb-14 text-center mb-20">
                        <i className="material-icons text-5xl text-write block mb-2">
                          format_quote
                        </i>
                        <p className="text-sm text-write">
                          {ReactHtmlParser(item.content)}
                        </p>
                        <div className="absolute inset-x-0 -bottom-14">
                          <div className="text-center">
                            <img
                              className="rounded-full h-14 w-14 mb-1 mx-auto"
                              src={item.imgUrl}
                            />
                            <span className="text-sm text-write font-medium block">
                              {item.name}
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  ))
                : ""}
            </Slider>
          </div>
        </div>
      </div>
      <div className="relative py-8 md:py-10">
        <div className="container mx-auto">
          <div className="px-3 sm:px-6 lg:px-8">
            <div className="rounded-xl shadow-lg bg-secondary py-8 px-5 md:py-14 md:px-10 flex flex-wrap items-center justify-between">
              <h4 className="text-2xl font-sans font-bold text-white mb-5">
                Are you planning for a better future abroad?{" "}
              </h4>
              <Link to="/contact" className="btn">
                CONTACT US <i class="material-icons" />
              </Link>
            </div>
          </div>
        </div>
      </div>
      {/* <div className="hero-section section-slider section mb-30">
        <div className="container-fluid">
          <div className="row">
            <div className="col px-0">
              <Slider className="hero-slider hero-slider-one" {...settings}>
                {this.state.bannerSection.map((banner) => (
                  <Banner key={banner.id} banner={banner} />
                ))}
              </Slider>
            </div>
          </div>
        </div>
      </div> */}
      <div className="relative py-8 md:py-10">
        <div className="container mx-auto">
          <div className="px-3 sm:px-6 lg:px-8">
            <SectionTitle upper="" lower="Associated Colleges" align="left" />
            <div className="brand-slider col">
              <Slider className="brand-slider col" {...brandSettings}>
                {associatedColleges.length > 0
                  ? associatedColleges.map((brand) => (
                      <Brand
                        key={brand.id}
                        imgUrl={brand.imgUrl}
                        title={brand.title}
                      />
                    ))
                  : ""}
              </Slider>
            </div>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
}
