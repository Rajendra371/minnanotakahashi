import React from "react";
import { Link } from "react-router-dom";

export default function FooterNav(props) {
  const { footerTitle, navItem } = props.nav;
  return (
    <div className="">
      <div className="footer-widget">
        <h4 className="text-2xl  text-white uppercase font-sans mb-8 font-bold">{footerTitle}</h4>
        <ul className="list-none mb-0">
          {navItem.map((item, idx) => (
            <li className="pb-2" key={idx}>
              <Link className="text-sm text-white transition-all duration-500 block hover:opacity-70 transform hover:translate-x-2" to={`/${item.link}`}>{item.navLink}</Link>
            </li>
          ))}
        </ul>
      </div>
    </div>
  );
}
