import React, { useState } from "react";

export default function Modal() {
  const [modal, setModal] = useState(true);

  return (
    <div
      className="popup-subscribe-section section bg-gray pt-55 pb-55"
      data-modal="popup-modal"
      style={{ display: modal ? "" : "none" }}
    >
      <div className="popup-subscribe-wrap">
        <button className="close-popup" onClick={() => setModal(!modal)}>
          X
        </button>
        <div className="popup-subscribe-banner banner">
          <a href="#">
            <img
              src="../../../../../public/images/frontend/banner/banner-7.jpg"
              alt="Banner"
            />
          </a>
        </div>
        <div className="popup-subscribe-form-wrap">
          <h1>
            SUBSCRIBE <br />
            OUR NEWSLETTER
          </h1>
          <h4>Get latest product update...</h4>
          <form
            action="#"
            method="post"
            className="popup-subscribe-form validate"
            target="_blank"
          >
            <div id="mc_embed_signup_scroll">
              <label htmlFor="popup_subscribe" className="d-none">
                Subscribe to our mailing list
              </label>
              <input
                type="email"
                name="EMAIL"
                className="email"
                id="popup_subscribe"
                placeholder="Enter your email here"
                required
              />
              <div
                style={{ position: "absolute", left: "-5000px" }}
                aria-hidden="true"
              >
                <input
                  type="text"
                  name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef"
                  tabIndex="-1"
                  className="hidden"
                />
              </div>
              <button type="submit" name="subscribe" id="" className="button">
                subscribe
              </button>
            </div>
          </form>
          <p>
            Be the first in the by getting special deals and offers send
            directly to your inbox.
          </p>
        </div>
      </div>
    </div>
  );
}
