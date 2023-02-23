import React from "react";
import Login from "../components/Login";
import Register from "../components/Register";
import About from "../components/About/Index";
import Home from "../components/Home/Index";
import Contact from "../components/Contact";
import Blogs from "../components/Blog/Blogs";
import News from "../components/News/News";
import Videos from "../components/Videos/Videos";
import StudyDestination from "../components/StudyDestinations";
import StudyDestinationDetails from "../components/StudyDestinations/Detail";
import BlogDetails from "../components/Blog/BlogDetails";
import NewsDetails from "../components/News/NewsDetails";
import ForgotPaswword from "../components/ForgotPaswword";
import ResetPassword from "../components/ResetPassword";
import Error from "../components/Error";
import Faq from "../components/Faq";
import Cms_Page from "../components/Cms_Page";
import Services from "../components/Services/Services";
import Dashboard from "../components/UserDashboard/Dashboard";
import Attachments from "../components/UserDashboard/Attachments";
import Test_Preparations from "../components/TestPreparations/Test_Preparations";

const frontendRoutes = [
  {
    path: "/",
    name: "Home",
    exact: true,
    component: Home,
  },
  {
    path: "/about",
    name: "About",
    exact: true,
    component: About,
  },
  {
    path: "/login",
    name: "Login",
    exact: true,
    component: Login,
  },
  {
    path: "/register",
    name: "Register",
    exact: true,
    component: Register,
  },
  {
    path: "/forgot_password",
    name: "Forgot Password",
    exact: true,
    component: ForgotPaswword,
  },
  {
    path: "/reset_password",
    name: "Reset Password",
    exact: true,
    component: ResetPassword,
  },
  {
    path: "/faq",
    name: "FAQ",
    exact: true,
    component: Faq,
  },
  {
    path: "/contact",
    name: "Contact",
    exact: true,
    component: Contact,
  },

  {
    path: "/blog",
    name: "Blogs",
    exact: true,
    component: Blogs,
  },
  {
    path: "/blog/:id",
    name: "Blog Details",
    exact: true,
    component: BlogDetails,
  },
  {
    path: "/study_destination",
    name: "Study Destination",
    exact: true,
    component: StudyDestination,
  },
  {
    path: "/study_destination/:id",
    name: "Study Destination Details",
    exact: true,
    component: StudyDestinationDetails,
  },
  {
    path: "/videos",
    name: "Videos",
    exact: true,
    component: Videos,
  },
  {
    path: "/news",
    name: "News",
    exact: true,
    component: News,
  },
  {
    path: "/news/:id",
    name: "News Details",
    exact: true,
    component: NewsDetails,
  },
  {
    path: "/contact",
    name: "Contact",
    exact: true,
    component: Contact,
  },
  {
    path: "/error_page",
    name: "Error",
    exact: true,
    component: Error,
  },

  {
    path: "/pages/:slug",
    name: "Pages",
    exact: true,
    component: Cms_Page,
  },
  {
    path: "/services",
    name: "Services",
    exact: true,
    component: Services,
  },
  {
    path: "/test-preparations",
    name: "Test Preparations",
    exact: true,
    component: Test_Preparations,
  },
  //     {
  //   path: "/profile",
  //   name: "Services",
  //   exact: true,
  //   component: Dashboard,
  // },
  //       {
  //   path: "/profile/attachments",
  //   name: "Attachments",
  //   exact: true,
  //   component: Attachments,
  // },
];
export default frontendRoutes;
