import React from "react";

import Dashboard from "../components/UserDashboard/Dashboard";
import VerifyEmail from "../components/UserDashboard/VerifyEmail";

const frontendProtectedRoutes = [
  {
    path: "/verify",
    name: "Email Verify",
    exact: true,
    component: VerifyEmail,
  },
  {
    path: "/profile",
    name: "Dashboard",
    exact: true,
    component: Dashboard,
  },
  {
    path: "/profile/userinfo",
    name: "Dashboard",
    exact: true,
    component: Dashboard,
  },
  {
    path: "/profile/addressinfo",
    name: "Dashboard",
    exact: true,
    component: Dashboard,
  },
  {
    path: "/profile/attachments",
    name: "Dashboard",
    exact: true,
    component: Dashboard,
  },
  {
    path: "/profile/orders",
    name: "Dashboard",
    exact: true,
    component: Dashboard,
  },
  {
    path: "/profile/wishlist",
    name: "Dashboard",
    exact: true,
    component: Dashboard,
  },
  {
    path: "/profile/change_password",
    name: "Dashboard",
    exact: true,
    component: Dashboard,
  },
];
export default frontendProtectedRoutes;
