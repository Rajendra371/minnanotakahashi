import React, { useContext } from "react";
import { Link } from "react-router-dom";
import { GlobalContext } from "../../context/GlobalContext";
import { AuthContext } from "../../context/AuthContext";
import SectionTitle from "../../component/SectionTitle";

export default function Summary() {
  const { cartList, wishList } = useContext(GlobalContext);
  const { userDetails, user_order_list } = useContext(AuthContext);
  // const cartitem = cartList.map((item) => item.img);
  const hour = new Date().getHours();
  return (
    <React.Fragment>
      <div className="col-12 mb-4">
        <div
          className="section-title-one"
          data-title={`GOOD ${
            hour < 12
              ? "MORNING"
              : hour >= 12 && hour < 18
              ? "AFTERNOON"
              : "EVENING"
          }`}
        >
        
          <SectionTitle lower={`Welcome, ${userDetails.username}`} align="left"/>
        </div>
      </div>
      {/* <div className="user_summary mt-4">
        <div className="row  ">
          <div className="col-md-4">
            <div className="card ">
              <Link to="/profile/orders">
                <span className="icon" style={{ backgroundColor: "#f0cfd196" }}>
                  <i style={{ color: "#ff0000" }} className="ti-dropbox" />
                </span>
                <h1>{user_order_list.length}</h1>
                <p className="title">Total Orders</p>
                <hr />
                <div className="d-flex align-items-center justify-content-center flex-wrap">
                  <img
                    src={`../../../../../public/images/frontend/product/product-4.jpg`}
                    width="30"
                    height="30"
                  />
                  <img
                    src={`../../../../../public/images/frontend/product/product-3.jpg`}
                    width="30"
                    height="30"
                  />
                  <img
                    src={`../../../../../public/images/frontend/product/product-5.jpg`}
                    width="30"
                    height="30"
                  />
                  <img
                    src={`../../../../../public/images/frontend/product/product-7.jpg`}
                    width="30"
                    height="30"
                  />
                  <img
                    src={`../../../../../public/images/frontend/product/product-8.jpg`}
                    width="30"
                    height="30"
                  />
                </div>
              </Link>
            </div>
          </div>
          <div className="col-md-4">
            <div className="card ">
              <Link to="/profile/wishlist">
                <span
                  className="icon"
                  style={{ backgroundColor: "rgb(252 242 188/ 75%)" }}
                >
                  <i
                    style={{ color: "rgb(245 215 48)" }}
                    className="ti-heart"
                  />
                </span>
                <h1>{wishList.length}</h1>
                <p className="title">Total in Wishlist</p>
                <hr />
                <div className="d-flex align-items-center justify-content-center flex-wrap">
                  {wishList.length > 0
                    ? wishList.map((item, idx) => (
                        <img
                          key={idx}
                          src={item.image}
                          width="30"
                          height="30"
                        />
                      ))
                    : ""}
                </div>
              </Link>
            </div>
          </div>
          <div className="col-md-4">
            <div className="card ">
              <Link to="/view_cart">
                <span
                  className="icon"
                  style={{ backgroundColor: "rgb(243 186 188 / 50%)" }}
                >
                  <i
                    style={{ color: "rgb(219 39 48)" }}
                    className="ti-shopping-cart"
                  />
                </span>
                <h1>{cartList.length}</h1>
                <p className="title">Total in Cart</p>
                <hr />
                <div className="d-flex align-items-center justify-content-center flex-wrap">
                  {cartitem.map((item, idx) => (
                    <img
                      key={idx}
                      src={`/public/uploads/product_image/thumbnail/${item}`}
                      width="30"
                      height="30"
                    />
                  ))}
                </div>
              </Link>
            </div>
          </div>
        </div>
      </div> */}
    </React.Fragment>
  );
}
