import React from "react";
import Loadable from "react-loadable";

function Loading() {
  return <div>Loading...</div>;
}
/**<------------------------------------Common Routes Start--------------------------------->**/
/** Dashboard */
import Dashboard from "../components/Dashboard/Index";
/** Settings */
import Module from "../components/Settings/Module/Index";
import Permission from "../components/Settings/Permission/Index";
import UserGroup from "../components/Settings/UserGroup/Index";
import Moduleorder from "../components/Settings/Module/Moduleorder";
import Users from "../components/Settings/Users/Index";
import Template from "../components/Settings/Template/Index";
import Change_Password from "../components/Login/Change_Password";
import Profile from "../components/Login/Profile";
/** Common Settings **/
import Location from "../components/GeneralSetting/Location/Index";
import Organization from "../components/GeneralSetting/Organization/Index";
import Software from "../components/GeneralSetting/Software/Index";
/** General Setting --> Site Setting */
import SiteSetting from "../components/GeneralSetting/SiteSetting/Index";
/** General Setting --> Useful link */
import UsefulLink from "../components/GeneralSetting/UsefulLink/Index";
/** General Setting --> Email Integration */
import EmailIntegration from "../components/GeneralSetting/EmailIntegration/Index";
/** General Setting --> Social Media Integration */
import SocialmediaIntegration from "../components/GeneralSetting/SocialmediaIntegration/Index";
/** General Setting --> Branch Setup*/
import BranchSetup from "../components/GeneralSetting/BranchSetup/Index";
/** Cron Management */
import Cron from "../components/GeneralSetting/Cron/Index";
/** Testimonial */
import TeamTestimonial from "../components/TeamTestimonial/Index";
/** Banner Management */
import Banner from "../components/Banner/Index";
/** Banner Management */
// import Vacancy from "../components/Vacancy/Index";
/** SEO Management */
import Seo from "../components/Seo/Index";

/** Blog Management */
import BlogCategory from "../components/Blog/BlogCategory/Index";
import BlogSetup from "../components/Blog/BlogSetup/Index";

/** News Notice Events Management */
import NneSetup from "../components/NNE/NneSetup/Index";
import NneCategory from "../components/NNE/NneCategory/Index";

/** FAQ Management */
import FaqCategory from "../components/Faq/FaqCategory/Index";
import FaqSetup from "../components/Faq/FaqSetup/Index";

/** Advertisement Management */
import Advertisement from "../components/Advertisement/Index";

import AuditTrails from "../components/Audit/AuditTrails/Index";
import AccessLog from "../components/Audit/AccessLog/Index";

/** Service Management */
import Service from "../components/Service/Index";

/** Career Management */
import CareerSetup from "../components/Career/CareerSetup/Index";
import CareerList from "../components/Career/List";
import JobApplicantList from "../components/Career/JobApplicant/List";

/** Our Product Management */
import OurproductCategory from "../components/Ourproduct/OurproductCategory/Index";
import Ourproduct from "../components/Ourproduct/Index";
import Menus from "../components/Menu/Index";

/** Technology Management */
import TechnologyCategory from "../components/Technology/TechnologyCategory/Index";
import TechnologyDescription from "../components/Technology/TechnologyDescription/Index";

/** Client Management */
import Client from "../components/Client/ClientSetup/Index";
import ClientCategory from "../components/Client/ClientCategory/Index";

/** Product Management */
import ProductSetup from "../components/Product/ProductSetup/Index";
import ProductCategory from "../components/Product/ProductCategory/Index";
import OrderManagement from "../components/Product/OrderManagement/Index";
import DeliveryManagement from "../components/Product/DeliveryManagement/Index";
import SalesSetup from "../components/Product/SalesSetup/Index";

/** Portofolio Management */
import PortfolioCategory from "../components/Portfolio/PortfolioCategory/Index";
import PortfolioSetup from "../components/Portfolio/PortfolioSetup/Index";
/** Page */
import Page from "../components/Page/Index";
/** Email Template */

import EmailTemplate from "../components/GeneralSetting/EmailTemplate/Index";

/** Gallery setup */
import GalleryCatSetup from "../components/MediaSetup/GalleryCatSetup/Index";
import GallerySetup from "../components/MediaSetup/GallerySetup/Index";
import VideoSetup from "../components/MediaSetup/VideoGallery/Index";

/** Study Destinations */
import StudyDestination from "../components/StudyDestination/Index";
/** University */
import University from "../components/University/Index";
/** Appointment List */
import Appointment from "../components/Appointment/List";
/** Frontend Tiles */
import FrontendTiles from "../components/FrontendTiles";

/** Associated College */
import AssociatedCollege from "../components/AssociatedCollege";

/** User Detail */
import UserDetails from "../components/UserDetails/List";

/** Employee  */
import Department from "../components/Department";
import Designation from "../components/Designation";
import EmployeeTypeSetup from "../components/Employee/EmployeeTypeSetup";
import Employee from "../components/Employee";
import EmployeeList from "../components/Employee/List";

/** Product Inquiry Detail */
import Inquiry from "../components/Inquiry/List";

/** Quick Evaluation Survey */
import QuickEvaluation from "../components/QuickEvaluation";
import SupportList from "../components/ClientReferral/SupportList";

/** Contact Detail */
import Contact from "../components/Contact/List";

/** Client Referral */
import ClientReferral from "../components/ClientReferral/List";
import StateSetup from "../components/State";

import Roster from "../components/Roster/Index";
import Roster_Report from "../components/Roster/Report";
import ApproveShift from "../components/Roster/List";
import RosterList from "../components/Roster/RosterList";

/** Training Setup */
import Training from "../components/Training/Index";

/**<-------------------------------------Common Routes End--------------------------------->**/
const adminRoutes = [
  /**<-----------------------------------Common Routes Start--------------------------------->**/
  /**User Details List */
  {
    path: "/user_details",
    name: "User Details",
    exact: true,
    component: UserDetails,
  },

  /**Client Referral List */
  {
    path: "/client_referral",
    name: "Client Referral",
    exact: true,
    component: ClientReferral,
  },
  {
    path: "/state_setup",
    name: "State Setup",
    exact: true,
    component: StateSetup,
  },
  /**Employee */
  {
    path: "/employee/:id",
    name: "Employee Edit",
    exact: true,
    component: Employee,
  },
  {
    path: "/employee",
    name: "Employee",
    exact: true,
    component: Employee,
  },
  {
    path: "/employee_type_setup",
    name: "EmployeeTypeSetup",
    exact: true,
    component: EmployeeTypeSetup,
  },
  {
    path: "/employee_list",
    name: "Employee List",
    exact: true,
    component: EmployeeList,
  },
  {
    path: "/department",
    name: "Department",
    exact: true,
    component: Department,
  },
  {
    path: "/designation",
    name: "Designation",
    exact: true,
    component: Designation,
  },
  /** Associated College Setup */
  {
    path: "/associated_college",
    name: "Associated College",
    exact: true,
    component: AssociatedCollege,
  },
  /** Study Destination Setup */
  {
    path: "/study_destination",
    name: "Study Destination",
    exact: true,
    component: StudyDestination,
  },
  /** University Setup */
  {
    path: "/university",
    name: "University",
    exact: true,
    component: University,
  },
  /** Appointment List */
  {
    path: "/appointment",
    name: "Appointment",
    exact: true,
    component: Appointment,
  },
  /** Frontend Tiles Setup */
  {
    path: "/frontend_tiles",
    name: "Frontend Tiles",
    exact: true,
    component: FrontendTiles,
  },

  /** Gallery category_setup */
  {
    path: "/video_setup",
    name: "Video Setup",
    exact: true,
    component: VideoSetup,
  },
  {
    path: "/gallery_setup",
    name: "GallerySetup",
    exact: true,
    component: GallerySetup,
  },
  {
    path: "/gallery_cat_setup",
    name: "GalleryCatSetup",
    exact: true,
    component: GalleryCatSetup,
  },
  /**useful link */
  {
    path: "/usefullink",
    name: "UsefulLink",
    exact: true,
    component: UsefulLink,
  },
  /** Pages */
  {
    path: "/page",
    name: "Page",
    exact: true,
    component: Page,
  },

  /** Portfolio Management */
  {
    path: "/portfolio_category",
    name: "PortfolioCategory",
    exact: true,
    component: PortfolioCategory,
  },
  {
    path: "/portfolio_setup",
    name: "PortfolioSetup",
    exact: true,
    component: PortfolioSetup,
  },

  /** Client Management */
  {
    path: "/client",
    name: "Client",
    exact: true,
    component: Client,
  },
  {
    path: "/clientcategory",
    name: "ClientCategory",
    exact: true,
    component: ClientCategory,
  },

  /** Product Management */
  {
    path: "/product_category",
    name: "ProductCategory",
    exact: true,
    component: ProductCategory,
  },
  {
    path: "/product_setup",
    name: "ProductSetup",
    exact: true,
    component: ProductSetup,
  },
  {
    path: "/order_management",
    name: "OrderManagement",
    exact: true,
    component: OrderManagement,
  },
  {
    path: "/delivery_management",
    name: "DeliveryManagement",
    exact: true,
    component: DeliveryManagement,
  },
  {
    path: "/sales_setup",
    name: "SalesSetup",
    exact: true,
    component: SalesSetup,
  },

  /** Service Management */
  {
    path: "/service",
    name: "Service",
    exact: true,
    component: Service,
  },

  /** Career */
  {
    path: "/career_setup",
    name: "CareerSetup",
    exact: true,
    component: CareerSetup,
  },

  {
    path: "/career_list",
    name: "CareerList",
    exact: true,
    component: CareerList,
  },

  {
    path: "/job_applicant_list",
    name: "JobApplicantList",
    exact: true,
    component: JobApplicantList,
  },

  /** Our Product*/
  {
    path: "/ourproduct_category",
    name: "OurproductCategory",
    exact: true,
    component: OurproductCategory,
  },
  {
    path: "/ourproduct",
    name: "Ourproduct",
    exact: true,
    component: Ourproduct,
  },
  {
    path: "/menu",
    name: "Menus",
    exact: true,
    component: Menus,
  },

  /** Technology Category*/
  {
    path: "/technology_category",
    name: "TechnologyCategory",
    exact: true,
    component: TechnologyCategory,
  },
  {
    path: "/technology_description",
    name: "TechnologyDescription",
    exact: true,
    component: TechnologyDescription,
  },

  /** Advertisement Management */
  {
    path: "/advertisement",
    name: "Advertisement",
    exact: true,
    component: Advertisement,
  },

  /** Quick Evaluation Survey */
  {
    path: "/quick_evaluation",
    name: "Quick Evaluation",
    exact: true,
    component: QuickEvaluation,
  },
  {
    path: "/support_lists",
    name: "Support Form Lists",
    exact: true,
    component: SupportList,
  },

  /**Contactus Management */
  {
    path: "/contactus_record",
    name: "Contact",
    exact: true,
    component: Contact,
  },

  {
    path: "/audit_trail",
    name: "AuditTrails",
    exact: true,
    component: AuditTrails,
  },

  {
    path: "/access_log",
    name: "AccessLog",
    exact: true,
    component: AccessLog,
  },

  /** FAQ Management */
  {
    path: "/faq_category",
    name: "FaqCategory",
    exact: true,
    component: FaqCategory,
  },
  {
    path: "/faq_setup",
    name: "FaqSetup",
    exact: true,
    component: FaqSetup,
  },
  /** News Notice Events Management */
  {
    path: "/nne_category",
    name: "NneCategory",
    exact: true,
    component: NneCategory,
  },
  {
    path: "/nne_setup",
    name: "NneSetup",
    exact: true,
    component: NneSetup,
  },
  // {
  //   path: "/event_setup",
  //   name: "NneSetup",
  //   exact: true,
  //   component: NneSetup
  // },

  /** Blog Management */
  {
    path: "/blog_setup",
    name: "BlogSetup",
    exact: true,
    component: BlogSetup,
  },

  {
    path: "/blog_category",
    name: "BlogCategory",
    exact: true,
    component: BlogCategory,
  },

  /** SEO Management */
  {
    path: "/seo",
    name: "Seo",
    exact: true,
    component: Seo,
  },

  /** Banner Management */
  {
    path: "/banner",
    name: "Banner",
    exact: true,
    component: Banner,
  },

  //  /** Vacancy Management */
  //  {
  //   path: "/vacancy",
  //   name: "Vacancy",
  //   exact: true,
  //   component: Vacancy
  // },

  /** General Setting --> Social Media Integration */
  {
    path: "/socialmediaintegration",
    name: "SocialmediaIntegration",
    exact: true,
    component: SocialmediaIntegration,
  },
  /** General Setting --> Branch Setup*/
  {
    path: "/branch_setup",
    name: "BranchSetup",
    exact: true,
    component: BranchSetup,
  },

  /** Testimonial */
  {
    path: "/teamtestimonial",
    name: "TeamTestimonial",
    exact: true,
    component: TeamTestimonial,
  },

  /** General Setting/ EmailIntegration */
  {
    path: "/emailintegration",
    name: "EmailIntegration",
    exact: true,
    component: EmailIntegration,
  },

  /** General Setting/ EmailTemplate */
  {
    path: "/email_template",
    name: "EmailTemplate",
    exact: true,
    component: EmailTemplate,
  },

  /** General Setting / Site Setting */
  {
    path: "/sitesetting",
    name: "SiteSetting",
    exact: true,
    component: SiteSetting,
  },

  /** General Setting / Cron Management */
  {
    path: "/cron",
    name: "Cron",
    exact: true,
    component: Cron,
  },
  /** Dashboard */
  {
    path: "/dashboard",
    name: "Dashboard",
    component: Dashboard,
  },
  /** Settings **/
  {
    path: "/module",
    exact: true,
    name: "Module",
    component: Module,
  },
  {
    path: "/permission",
    exact: true,
    name: "Permission",
    component: Permission,
  },
  { path: "/usergroup", exact: true, name: "UserGroup", component: UserGroup },
  { path: "/order", exact: true, name: "Moduleorder", component: Moduleorder },
  { path: "/users", exact: true, name: "Users", component: Users },
  { path: "/template", exact: true, name: "Template", component: Template },
  {
    path: "/change_password",
    exact: true,
    name: "Change Password",
    component: Change_Password,
  },
  { path: "/profile", exact: true, name: "Profile", component: Profile },
  /** Common Settings **/
  { path: "/location", exact: true, name: "Location", component: Location },
  {
    path: "/organization",
    exact: true,
    name: "Organization",
    component: Organization,
  },

  { path: "/software", exact: true, name: "Software", component: Software },
  {
    path: "/roster",
    exact: true,
    name: "Roster",
    component: Roster,
  },

  {
    path: "/roster_report",
    exact: true,
    name: "Roster Report",
    component: Roster_Report,
  },

  {
    path: "/approve_shift",
    exact: true,
    name: "Approve Shift",
    component: ApproveShift,
  },
  {
    path: "/roster_list",
    exact: true,
    name: "Roster List",
    component: RosterList,
  },

  {
    path: "/training",
    exact: true,
    name: "Training",
    component: Training,
  },

  /**<------------------------------------Common Routes End----------------------------------->**/
];

export default adminRoutes;
