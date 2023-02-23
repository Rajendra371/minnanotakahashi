import React, { useContext } from "react";
import { Link, useLocation } from "react-router-dom";
import SideNavTitle from "../../component/SideNavTitle";
import { GlobalContext } from "../../context/GlobalContext";
import { AuthContext } from "../../context/AuthContext";

export default function UserSideNav() {
  const { wishList } = useContext(GlobalContext);
  const { userLogout, user_order_list } = useContext(AuthContext);
  const location = useLocation();
  const pathnames = location.pathname.split("/").filter((x) => x);
  const pathUrl = pathnames[pathnames.length - 1];
  const logout = async () => {
    await userLogout();
  };
  return (
    <div className="sidebar rounded-lg shadow-lg bg-primary p-5">
      <div className="text-center user_profile">
        <img
          src={`../../../../../public/images/frontend/user-profile.png`}
          className="h-20 w-20 mx-auto mb-4"
        />
      </div>
      <div className="sidebar_menu">
        <SideNavTitle title="Profile" />
        <ul className="sidenav_list mb-4">
          <li className={` ${pathUrl == "userinfo" ? "border-l-4 border-dark-secondary pl-5 -ml-5 active" : ""}`}>
            <Link to="/profile/userinfo" className="font-medium text-sm text-black transition-transform duration-500 inline-block hover:text-white transform hover:translate-x-2">
              <i className="material-icons text-base align-middle mr-2" >how_to_reg</i> Personal Info
            </Link>
          </li>
          {/* <li className={pathUrl == "addressinfo" ? "active" : ""}>
            <Link to="/profile/addressinfo" className="font-medium text-sm text-black transition-transform duration-500 inline-block hover:text-white transform hover:translate-x-2">
              <i className="ti-location-arrow" />
              Address
            </Link>
          </li> */}
          <li className={` ${pathUrl == "attachments" ? "border-l-4 border-dark-secondary pl-5 -ml-5 active" : ""}`}>
            <Link to="/profile/attachments" className="font-medium text-sm text-black transition-transform duration-500 inline-block hover:text-white transform hover:translate-x-2">
              <i className="material-icons text-base align-middle mr-2" >attachment</i> Attachments
            </Link>
          </li>
        </ul>
        {/* <SideNavTitle title="Orders" />
        <ul className="sidenav_list">
          <li className={pathUrl == "orders" ? "active" : ""}>
            <Link to="/profile/orders">
              <i className="ti-shopping-cart" /> My Orders (
              {user_order_list.length})
            </Link>
          </li>
          <li className={pathUrl == "wishlist" ? "active" : ""}>
            <Link to="/profile/wishlist">
              <i className="ti-heart" />
              My WishList ({wishList.length})
            </Link>
          </li>
        </ul> */}
        <SideNavTitle title="Settings" />
        <ul className="sidenav_list">
          <li className={` ${pathUrl == "change_password" ? "border-l-4 border-dark-secondary pl-5 -ml-5 active" : ""}`}>
            <Link to="/profile/change_password" className="font-medium text-sm text-black transition-transform duration-500 inline-block hover:text-white transform hover:translate-x-2">
              <i className="material-icons text-base align-middle mr-2" >vpn_key</i>Change Password
            </Link>
          </li>
          {/* <li><Link to="/profile/addressinfo"><i className="fa fa-sign-out"></i>Logout</Link></li> */}
          <li className="">
            <Link to="/" onClick={logout} className="font-medium text-sm text-black transition-transform duration-500 inline-block hover:text-white transform hover:translate-x-2">
              <i className="fa fa-sign-out text-base align-middle mr-2" ></i>
              Logout
            </Link>
          </li>
        </ul>
      </div>
    </div>
  );
}
