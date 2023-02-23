import React, { useState, useEffect, useContext } from "react";
import { Link } from "react-router-dom";
import { AuthContext } from "../context/AuthContext";
import NavItem from "../component/NavItem";

export default function Navbar(props) {
  const [navMenu, setNavmenu] = useState([]);
  const [mobilemenu, setMobilemenu] = useState(false);
  const [categories, setCategories] = useState([]);
    const { isAuthenticated} = useContext(AuthContext);

  useEffect(() => {
    // getNavCategory();
    getNavMenu();
  }, []);

  async function getNavMenu() {
    const response = await axios.get("api/home/get_nav_menu");
    if (response.data.status == "success") {
      var load_navbar = response.data.view_data;
      console.log(load_navbar);
      setNavmenu(load_navbar);
    } else {
      setNavmenu([]);
    }
  }

  async function getNavCategory() {
    await axios.get("api/home/get_nav_category").then((response) => {
      if (response.data.status == "success") {
        var load_nav_categories = response.data.view_data["nav_data"];
        console.log("cats is", load_nav_categories);
        setCategories(load_nav_categories);
      } else {
        // setCategories([]);
      }
    });
  }

  return props.mobile ? (
      <div className={`mobilemenu fixed w-250 inset-y-0 z-24 right-0 bg-light-gray transition-transform transition-shadow duration-500 h-screen ${props.menuShow ? 'showMenu shadow-xl': ' shadow-none'}  `}>
        <div className="relative">
          <button onClick={()=>props.closeMenu(false)} className="absolute right-1 top-1"><i className="material-icons text-2xl text-black hover:opacity-80">close</i></button>
        <a className="block text-center p-5 cursor-pointer" href="">
          <img className="block h-24 w-auto mx-auto" src="../../../public/uploads/thedial.jpg" alt="The Dial"/>
          </a>
        <ul className="text-left flex flex-col list-none p-0 m-0">
            {navMenu.map((nav) => (
                    <NavItem key={nav.id} nav={nav} mobile={true} close={props.closeMenu}/>
                  ))}
            </ul>
          {!isAuthenticated ? 
            <li className="py-2 px-5 visible list-none login pt-5 border-t border-gray mt-2">
          <Link onClick={()=>props.closeMenu(false)} to="/login" style={{padding:".5rem 1rem",display:"block",textAlign:"center"}} className="btn">Login / Register</Link>
        </li> : null}
            </div>
  </div>
  ) : (
    <React.Fragment>
        <div className="hidden lg:block lg:ml-auto mt-2">
          <div className="flex space-x-1 lg:space-x-3 ">
             {navMenu.map((nav) => (
              <NavItem key={nav.id} nav={nav} />
            ))}
             
          </div>
            
        </div>

         {/* </div> */}
    </React.Fragment>
  );
}
