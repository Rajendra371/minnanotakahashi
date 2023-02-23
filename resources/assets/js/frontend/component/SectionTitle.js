import React from "react";

export default function SectionTitle(props) {
  return (
    <div className={`col-12 px-0 mb-5 sm:mb-10 sectiontitle text-${props.align}`}>
      <p className=" text-lg text-primary upper-title mb-2 font-bold">
        {props.upper}
      </p>
      <h2 className="text-2xl sm:text-3xl text-secondary font-sans font-black ">
        {props.lower}
      </h2>
      <hr className={`my-2 w-48 bg-write ${props.align =='center' ? 'mx-auto' : ''}`} style={{height:"2px"}}/>
    </div>
  );
}
