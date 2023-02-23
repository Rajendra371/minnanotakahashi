import React, { useState, useEffect, useContext } from "react";
import { Link, useLocation } from "react-router-dom";
import { GlobalContext } from "../context/GlobalContext";

export default function NavItem(props) {
  const location = useLocation();
  const pathnames = location.pathname.split("/").filter((x) => x);
  const pathUrl = pathnames[pathnames.length - 1];
  const pathCategory = pathnames[pathnames.length - 2];
  const { id, layout, navItem, childrenMenu, link } = props.nav;
  if (layout == "sub-menu") {
    var childNav = "menu-item-has-children";
    var childLayout = "sub-menu";
  }
  const [expandMenu, setExpandMenu] = useState(false);
  const [expandSubMenu, setExpandSubMenu] = useState(false);
  const handleClick = () => {
    setExpandMenu(!expandMenu);
  };
  const handleSubClick = () => {
    setExpandSubMenu(!expandSubMenu);
    if (!childrenMenu.length) {
      props.close(false);
    }
  };

  return props.mobile ? (
    <li
      className={` px-5 py-2  ${
        childrenMenu.length ? "menu-item-has-children cursor-pointer" : ""
      }  ${pathUrl == link ? "active" : ""}`}
      onClick={() => {
        if (!childrenMenu.length) {
          props.close(false);
        }
      }}
    >
      <Link
        to={childrenMenu.length ? null : `/${link}`}
        className={`px-3 text-base font-medium uppercase ${
          expandMenu ? "text-primary" : "text-black"
        } transition-color duration-500 hover:text-primary`}
      >
        {navItem}
      </Link>
      {childrenMenu.length ? (
        <i
          className="float-right  material-icons transition-all duration-300 text-base text-black"
          onClick={handleClick}
        >
          {!expandMenu ? "expand_more" : "expand_less"}
        </i>
      ) : null}
      <ul className={`ml-3 mt-2  ${expandMenu ? "block " : "hidden "}`}>
        {childrenMenu.map((item, idx) => (
          <li
            key={idx}
            className={`group relative border-l-2 border-primary ${
              expandSubMenu ? "my-2" : ""
            }  transition-shadow duration-500 bg-white shadow-lg`}
          >
            <Link
              to=""
              className={` px-3 py-2 font-medium text-sm inline-block ${
                expandSubMenu ? "text-primary " : "text-black"
              } transition-color duration-500 block group-hover:text-primary `}
            >
              {item.childNav}
            </Link>
            {item.subChildMenu && (
              <span
                onClick={handleSubClick}
                className={`text-xl pr-2 transition-all duration-500 align-middle 
         ${
           expandSubMenu ? "text-primary" : "text-black"
         } float-right align-middle group-hover:text-primary`}
              >
                {!expandSubMenu ? "+" : "-"}
              </span>
            )}
            {item.subChildMenu && (
              <ul
                className={` transition-shadow duration-500 bg-light-gray border-t-2 border-gray  ${
                  expandSubMenu ? "block shadow-lg" : "hidden shadow-none"
                }`}
              >
                {item.subChildMenu.map((item2, idx) => (
                  <li className="py-2 pl-4 pr-2" key={idx}>
                    <Link
                      className="text-sm text-black transition-transform duration-500 block hover:opacity-70 transform hover:translate-x-2"
                      to={`/${item2.link}`}
                    >
                      {item2.subChildNav}
                    </Link>
                  </li>
                ))}
              </ul>
            )}
          </li>
        ))}
      </ul>
    </li>
  ) : (
    <li
      v-for="item in items"
      style={{ listStyleType: "none" }}
      className={` border-r border-primary last:border-r-0 relative lg:px-2 xl:x-3 ${
        childrenMenu.length ? "menu-item-has-children " : ""
      }  ${pathUrl == link ? "active" : ""}`}
    >
      <Link
        to={childrenMenu.length ? null : `/${link}`}
        className=" p-1 text-md text-dark-secondary font-medium uppercase transition-border duration-500 border-b-2 border-transparent hover:border-dark-secondary"
      >
        {navItem}
      </Link>
      {childrenMenu.length ? (
        <i className="material-icons  text-base text-white align-middle">
          expand_more
        </i>
      ) : null}
      {/* <i className="material-icons text-base text-white">expand_more</i> */}
      {childrenMenu.length ? (
        <ul
          className={`absolute top-8 -left-6  border-t-4 border-primary  shadow-xl rounded-sm transition-all duration-500 opacity-0 invisible bg-white inset-x-0 px-4 py-2 w-48 m-0`}
        >
          {childrenMenu.map((item, idx) => (
            <li key={idx} className={`group relative  py-2`}>
              <Link
                to={`/${item.link}`}
                className="font-medium text-sm text-black transition-transform duration-500 inline-block group-hover:opacity-70 transform group-hover:translate-x-2"
              >
                {item.childNav}
              </Link>
              {/* {item.subChildMenu && 
              <i className="material-icons pl-1 text-xl transition-transform text-black float-right align-middle transform group-hover:translate-x-3 ">
                arrow_right_alt
              </i> */}
              {/* } */}
              {/* { item.subChildMenu &&  */}
              {/* <ul className="absolute top-0 left-44 -right-10 border-l-4 border-primary bg-white shadow-xl rounded-sm  opacity-0 invisible transition-all duration-500 px-4 py-2 w-48 m-0"> */}
              {/* {item.subChildMenu.map((item2, idx) => ( */}
              {/* <li className="py-2">
                  <Link className="font-medium text-sm text-black transition-transform duration-500 block hover:opacity-70 transform hover:translate-x-2">
                    Abroad Study
                  </Link>
                </li> */}
              {/* ))} */}
              {/* </ul> */}
              {/* } */}
            </li>
          ))}
        </ul>
      ) : null}
    </li>
  );
}
