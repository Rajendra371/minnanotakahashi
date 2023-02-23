import React, {
  useState,
  useContext,
  useRef,
  useEffect,
  Component,
} from "react";
import { Link, Redirect } from "react-router-dom";
import Navbar from "../components/Navbar";
import Breadcrumb from "../component/Breadcrumb";
import Headroom from "react-headroom";
import { AuthContext } from "../context/AuthContext";

export default function Header(props) {
  const [mobileMenu, setMobileMenu] = useState(false);
  const [cart, setCart] = useState(false);
  const { userLogout, userDetails, isAuthenticated } = useContext(AuthContext);
  const [userMenu, setUserMenu] = useState(false);
  // const [companyInfo, setCompanyInfo] = useState(props.companyInfo[0]);
  const { companyInfo } = props;
  // const [categories, setCategories] = useState([]);

  useEffect(() => {
    window.addEventListener("scroll", handleScroll, true);
    getNavCategory();
    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);
  const handleScroll = () => {
    setMobileMenu(false);
  };
  const handleUserMenu = () => {
    setUserMenu(!userMenu);
  };
  const logout = async () => {
    await userLogout();
  };
  async function getNavCategory() {
    axios.get("api/home/get_nav_category").then((response) => {
      if (response.data.status == "success") {
        var load_nav_categories = response.data.view_data["nav_data"];
        setCategoryList(load_nav_categories);
      } else {
        console.log("error");
      }
    });
  }

  return (
    <React.Fragment>
      <Headroom>
        <div className="bg-secondary top-header py-1">
          <div className="container mx-auto">
            <div className=" px-2 sm:px-6 lg:px-8">
              <div className="flex flex-col sm:flex-row flex-wrap items-center justify-between">
                <div className="flex flex-wrap items-center  ">
                  <a
                    className="mr-3 rounded-full h-6 w-6 flex items-center justify-center bg-primary hover:bg-opacity-80"
                    href="https://www.facebook.com/TheDialEdu/"
                    target="_blank"
                  >
                    <i className="fa fa-facebook text-sm transition-all duration-500 text-white " />
                  </a>
                  <a
                    className="mr-3 rounded-full h-6 w-6 flex items-center justify-center bg-primary hover:bg-opacity-80"
                    href="https://www.twitter.com/thedialint1"
                    target="_blank"
                  >
                    <i className="fa fa-twitter text-sm transition-all duration-500 text-white " />
                  </a>
                  <a
                    className="mr-3 rounded-full h-6 w-6 flex items-center justify-center bg-primary hover:bg-opacity-80"
                    href="https://www.youtube.com/channel/UC_YGHlYZq9iIvOrPqtyzkXg"
                    target="_blank"
                  >
                    <i className="fa fa-youtube text-sm transition-all duration-500 text-white " />
                  </a>
                  <a
                    className=" rounded-full h-6 w-6 flex items-center justify-center bg-primary hover:bg-opacity-80"
                    href="https://www.instagram.com/thedial_020/"
                    target="_blank"
                  >
                    <i className="fa fa-instagram text-sm transition-all duration-500 text-white " />
                  </a>
                </div>
                <li className="list-none text-white">
                  <i className="material-icons text-base mr-2 align-middle">
                    home
                  </i>

                  <span className="text-xs text-white ">
                    {companyInfo && companyInfo.address}
                  </span>
                </li>
                <div className="flex items-center justify-between">
                  <li className="list-none text-white">
                    <i className="material-icons text-base mr-2 align-middle">
                      phone
                    </i>
                    <a
                      className="text-xs text-white transition-colors duration-500 hover:text-primary"
                      href={`tel:${companyInfo && companyInfo.contact_number}`}
                    >
                      {companyInfo && companyInfo.contact_number}
                    </a>
                    &nbsp;&nbsp;
                  </li>
                  <li className="list-none text-white">
                    <i className="material-icons text-base mr-2 align-middle">
                      schedule
                    </i>

                    <span className="text-xs text-white ">
                      Sun-Fri 9:00-17:00
                    </span>
                  </li>
                </div>
              </div>
            </div>
          </div>
        </div>
        <nav className="bg-white relative top-0 right-0 left-0 border-b-2 border-primary">
          <div className="container mx-auto">
            <div className=" px-2 sm:px-6 lg:px-8">
              <div className="relative flex items-center justify-between h-20 md:h-28">
                <div className="absolute inset-y-0 left-0 flex items-center lg:hidden">
                  <button
                    onClick={() => setMobileMenu(!mobileMenu)}
                    className="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-expanded="false"
                  >
                    <span className="sr-only">Open main menu</span>

                    <svg
                      className="block h-6 w-6"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      aria-hidden="true"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                      />
                    </svg>
                    <svg
                      className="hidden h-6 w-6"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      aria-hidden="true"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                      />
                    </svg>
                  </button>
                </div>
                <div className="flex-1 flex items-center justify-center lg:items-center lg:justify-between">
                  <div className="flex-shrink-0 flex items-center">
                    <Link to="/">
                      <img
                        className="block lg:hidden h-20 md:h-28 w-auto"
                        src="../../../public/uploads/thedial.png"
                        alt="The Dial"
                      />
                      <img
                        className="hidden lg:block h-20 md:h-28 w-auto"
                        src="../../../public/uploads/thedial.png"
                        alt="The Dial"
                      />
                    </Link>
                  </div>
                  <div className="">
                    <div className="hidden lg:block pt-1 mb-1 md:ml-2 md:border-b md:border-dark-secondary">
                      <div className="flex ">
                        <label className="text-dark-secondary text-md xl:text-lg font-bold uppercase italic leading-none mb-2 pr-3 border-r border-dark-secondary">
                          career <br />
                          <span className="font-light text-md">
                            enhancement
                          </span>{" "}
                          <span className="font-bold">center</span>
                        </label>
                        <div className="flex items-center px-3 mb-2 border-r border-dark-secondary">
                          <label className="text-dark-secondary text-md xl:text-lg font-light uppercase italic leading-none ">
                            study in <br />{" "}
                            <span className="font-bold text-md xl:text-lg text-red">
                              {" "}
                              japan
                            </span>
                          </label>
                          <label className="text-dark-secondary text-xs ml-2">
                            Intakes :<br />
                            Jan/Apr/Jul/Oct
                          </label>
                        </div>
                        <label className="text-dark-secondary text-md xl:text-lg font-bold uppercase italic leading-none mb-2 pl-3">
                          quest <br />
                          <span className="font-light text-md">for</span>{" "}
                          <span className="font-bold"> excellence</span>
                        </label>
                      </div>
                    </div>
                    <Navbar />
                  </div>
                  {/* <div className="absolute inset-y-0 right-0 flex items-center">  */}
                </div>
                <div className="flex flex-col justify-around h-full">
                  <div className="relative ml-5 mt-2">
                    <input
                      type="text"
                      name="search"
                      placeholder="Search"
                      className="py-2 pl-3 pr-4 w-full  focus:outline-none focus:ring-primary focus:border-primary float-right bg-gray text-xs  border border-gray rounded-2xl text-dark-secondary"
                      style={{ background: "#dbdbdb" }}
                    />
                    <i className="material-icons absolute right-0 top-0 cursor-pointer bg-secondary text-white text-base rounded-full w-8 h-8 flex items-center justify-center">
                      search
                    </i>
                  </div>
                  {isAuthenticated ? (
                    <li
                      className=" right-0 relative ml-auto cursor-pointer list-none rounded-full h-9 w-9 bg-white grid grid-cols-2 items-center gap-x-1 "
                      onFocus={() => setUserMenu(true)}
                      onClick={handleUserMenu}
                      onBlur={() => setUserMenu(false)}
                    >
                      <i className="text-dark-secondary material-icons align-middle text-md">
                        person
                      </i>
                      <i className="material-icons text-sm align-middle">
                        expand_more
                      </i>
                      <ul
                        style={{ left: "-575%" }}
                        className={`absolute top-10   border-t-4 border-primary  shadow-xl rounded-sm transition-all duration-none ${
                          userMenu
                            ? "opacity-1 visible "
                            : "opacity-0 invisible"
                        } bg-white inset-x-0 px-4 py-2 w-64 m-0`}
                      >
                        <li
                          className={`group relative  py-1 border-b border-gray`}
                        >
                          <Link
                            to="/profile"
                            className="text-sm text-black transition-transform duration-500 inline-block "
                          >
                            Welcome! , <strong>{userDetails.username}</strong>
                          </Link>
                        </li>
                        <li className={` relative  py-1`}>
                          <Link
                            to="/"
                            onClick={logout}
                            className=" text-sm text-black transition-transform duration-500 inline-block hover:bg-white hover:text-primary"
                          >
                            Logout
                          </Link>
                        </li>
                      </ul>
                    </li>
                  ) : (
                    <div className="text-right hidden sm:block">
                      <li className="px-3 py-1 inline-flex  relative lg:ml-4 list-none login">
                        <Link
                          to="/login"
                          className="px-4 py-1 text-sm rounded-2xl text-secondary rounded-md font-medium  transition-bg duration-500 border bg-transparent border-secondary hover:text-white hover:border-primary hover:bg-primary"
                        >
                          Login
                        </Link>
                      </li>
                      <li className="px-3 py-1 inline-flex  relative lg:ml-1 list-none login">
                        <Link
                          to="/register"
                          className="px-4 py-1 text-sm rounded-2xl bg-secondary text-white rounded-md font-medium  transition-bg duration-500 border bg-transparent border-secondary hover:text-white hover:bg-primary hover:border-primary "
                        >
                          Register
                        </Link>
                      </li>
                    </div>
                  )}
                </div>
              </div>
            </div>
            {/* <div className="hidden sm:hidden">
          <div className="px-2 pt-2 pb-3 space-y-1">
            <a href="#" className="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900">Dashboard</a>
            <a href="#" className="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Team</a>
            <a href="#" className="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Projects</a>
            <a href="#" className="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Calendar</a>
          </div>
        </div> */}
            <Navbar
              mobile={true}
              menuShow={mobileMenu}
              closeMenu={setMobileMenu}
            />
          </div>
        </nav>
      </Headroom>
    </React.Fragment>
  );
}
