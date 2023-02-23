import React, { useEffect ,useRef} from "react";

import { Route, Switch } from "react-router-dom";
import ProfileInfo from "./ProfileInfo";
import UserSideNav from "./UserSideNav";
import ChangePassword from "./ChangePassword";
import AddressInfo from "./AddressInfo";
// import WishList from "./WishList";
// import Orders from "./Orders";
// import Reviews from "./Reviews";
import Attachments from "./Attachments";
import Summary from "./Summary";
import SubHeader from "../../component/SubHeader";

export default function Dashboard(props) {
  const {dashboard } = useRef()
  useEffect(() => {
     window.scrollTo(dashboard,0);
  }, []);
  return (
  <React.Fragment>
    <SubHeader title="User Profile"/>
    <div className="relative py-8 md:py-14">
      <div className="container mx-auto">
        <div className="grid md:grid-cols-12 gap-5 px-3 sm:px-6 lg:px-8 ">
          <div className="col-span-12 md:col-span-3 md:mt-10">
            <UserSideNav {...props} />
          </div>
          <div className="col-span-12 md:col-span-9 md:-mt-10">
            <div className="sidenav_content dashboard h-100" ref={dashboard} >
              <Switch>
                <Route
                  exact
                  path="/profile"
                  render={(props) => <Summary {...props} />}
                />
                <Route
                  exact
                  path="/profile/userinfo"
                  render={(props) => <ProfileInfo {...props} />}
                />
                <Route
                  exact
                  path="/profile/attachments"
                  render={(props) => <Attachments {...props} />}
                />
                {/* <Route
                  exact
                  path="/profile/addressinfo"
                  render={(props) => <AddressInfo {...props} />}
                />
   
                <Route
                  exact
                  path="/profile/orders"
                  render={(props) => <Orders {...props} />}
                />
                <Route
                  exact
                  path="/profile/wishlist"
                  render={(props) => <WishList {...props} />}
                /> */}
                <Route
                  exact
                  path="/profile/change_password"
                  render={(props) => <ChangePassword {...props} />}
                />

              </Switch>
            </div>
          </div>
        </div>
      </div>
    </div>
    </React.Fragment>
  );
}
