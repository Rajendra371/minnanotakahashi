import React, { useState, useEffect } from "react";
import FooterNav from "../component/FooterNav";

export default function Footer(props) {
  const footNav = [
    {
      footerTitle: "Quick Links",
      navItem: [
        { navLink: "Company Profile", link: "about" },

        { navLink: "FAQ", link: "faq" },
        { navLink: "Privacy Policy", link: "pages/privacy-policy" },
        { navLink: "Terms & Conditions", link: "pages/terms-and-condition" },
        { navLink: "Contact", link: "contact" },
      ],
    },
  ];

  const [footerNav, setFooterNav] = useState(footNav);

  const { companyInfo } = props;

  return (
    <div className="footer bg-secondary">
      <div className=" pt-10  pb-5 md:pb-10">
        <div className="container mx-auto">
          <div className="grid gap-4 sm:grid-cols-2 md:grid-cols-4 px-3 sm:px-6 lg:px-8 ">
            <div className="">
              <img
                className="block h-60 w-auto"
                src="../../../public/uploads/thedial.jpg"
                alt="The Dial"
              />
            </div>
            {footerNav.map((item, idx) => (
              <FooterNav key={idx} nav={item} />
            ))}

            <div className="">
              <div className="footer-widget">
                <h4 className="text-2xl text-white mb-8 font-bold font-sans">
                  CONTACT INFO
                </h4>
                {companyInfo.length > 0
                  ? companyInfo.map((address, idx) => (
                      <ul className="list-none mb-0" key={idx}>
                        <li className="pb-2 flex flex-row">
                          <i className="material-icons text-white text-base mr-2 align-middle">
                            map
                          </i>

                          <span className="text-sm text-white ">
                            {address.address}
                          </span>
                        </li>
                        <li className="pb-2">
                          <i className="material-icons text-white text-base mr-2 align-middle">
                            phone
                          </i>

                          <a
                            className="text-sm text-white transition-colors duration-500 hover:text-primary"
                            href={`tel:${address.contact_number}`}
                          >
                            {address.contact_number}
                          </a>
                        </li>
                        <li className="pb-2">
                          <i className="material-icons text-white text-base mr-2 align-middle">
                            mail
                          </i>

                          <a
                            className="text-sm text-white transition-colors duration-500 hover:text-primary"
                            href={`mailto:${address.email}`}
                          >
                            {address.email}
                          </a>
                        </li>
                      </ul>
                    ))
                  : ""}
              </div>
            </div>
            <div className="">
              <div className="footer-widget">
                <h4 className="text-xl  text-white  font-sans mb-5 font-bold">
                  THE DIAL Facebook
                </h4>
                <iframe
                  src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTheDialEdu%2F&tabs=timeline&width=340&height=250&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=true&appId"
                  width="100%"
                  height="250"
                  style={{ border: "none", overflow: "hidden" }}
                  scrolling="no"
                  frameborder="0"
                  allowfullscreen="true"
                  allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="opacity-80">
        <div className="container mx-auto">
          <div className="grid grid-cols-1 justify-center  px-3 sm:px-6 lg:px-8 ">
            <div className=" text-center sm:text-left border-t-2 border-white">
              <p className="text-sm text-white m-0 pb-1 lg:py-1">
                {" "}
                Designed and Developed by{" "}
                <a href="http://www.xelwel.com.np" target="_blank">
                  Xelwel Innovation Pvt. Ltd.
                </a>
              </p>
            </div>
            <div className=" text-center sm:text-left ">
              <div className="footer-copyright py-1 lg:py-1">
                <p className="text-sm text-white  m-0">
                  &copy; Copyright, 2020{" "}
                  {companyInfo.length > 0 ? companyInfo[0].branch_name : ""} All
                  Rights Reserved
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
