import React from "react";
import { Link } from "react-router-dom";
import Breadcrumb from './Breadcrumb'

export default function SubHeader(props) {
  return (
    <React.Fragment>
    <div className="sub-header-page pb-52 pt-32  md:py-40 lg:py-48 relative">
    {/* <img className="absolute opacity-50 inset-0 bg-cover" src="https://www.nationalgeographic.com/content/dam/travel/Guide-Pages/north-america/toronto-travel.adapt.1900.1.jpg"/> */}
        <h2 className="m-0 text-right text-4xl md:text-5xl absolute font-sans bottom-1/2 left-5 md:left-20 rotate-180 text-primary font-bold">{props.title}</h2>
    </div>
            {/* <Breadcrumb/> */}
    </React.Fragment>

  );
}