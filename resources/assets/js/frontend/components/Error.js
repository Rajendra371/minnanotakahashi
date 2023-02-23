import React from "react";
import { Link } from "react-router-dom";

export default function Error() {
  return (
    <div className="py-8 lg:py-14">
      <div className="container mx-auto">
        <div className="d-flex justify-content-center ">
          <div className="sidenav_main_content text-center login_form">
            <h1 className="font-sans font-bold text-3xl text-black">Error 404</h1>
            <h4 className="my-4 text-base text-write">
              We are sorry , the page you've requested is not available
            </h4>
            <Link to="/">
              <button className="btn ">back to homepage</button>
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
}
