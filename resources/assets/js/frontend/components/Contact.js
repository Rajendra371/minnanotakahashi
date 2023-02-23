import React, { useEffect } from "react";
import SectionTitle from "../component/SectionTitle";
import { useForm } from "react-hook-form";

export default function Contact() {
  const { register, handleSubmit, errors } = useForm();
  const [tab, setTab] = React.useState("add1");

  useEffect(() => {
    window.scrollTo(0, 0);
  }, []);

  const submitContactForm = (value) => {
    console.log(value);
  };

  return (
    <React.Fragment>
      <div className="relative py-8 md:py-14">
        <div className="container mx-auto">
          <div className="px-3 sm:px-6 lg:px-8 ">
            <div className="grid md:grid-cols-6 gap-5">
              <div className="col-span-3" >
                <SectionTitle upper="Connect" lower="Send us a message" align="left"/>
                <form className="p-5 bg-white rounded-xl shadow-xl" onSubmit={handleSubmit(submitContactForm)}>
                  <div className="grid grid-cols-6 gap-6">
                    <div className="col-span-6">
                      <label className="block text-sm font-medium text-gray-700">Full Name *</label>
                      <input
                        type="text"
                        placeholder="Enter your full name"
                        name="fullname"
                        className="mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md"
                        ref={register({
                          required: "Required",
                        })}
                        style={{
                          border: errors.fullname && "1px solid #ff0000",
                        }}
                      />
                    </div>
                    <div className="col-span-6 sm:col-span-3">
                      <label className="block text-sm font-medium text-gray-700">Email Address *</label>
                      <input
                        type="email"
                        placeholder="Enter your email"
                        name="email"
                        className="mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md"

                        ref={register({
                          required: "Required",
                          pattern: {
                            value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
                            message: "Invalid Email Address",
                          },
                        })}
                        style={{
                          border: errors.email && "1px solid #ff0000",
                        }}
                      />
                      {errors.email && (
                        <span className="text-danger">
                          {errors.email.message}
                        </span>
                      )}
                    </div>
                    <div className="col-span-6 sm:col-span-3">
                      <label className="block text-sm font-medium text-gray-700">Mobile *</label>
                      <input
                        type="number"
                        placeholder="Enter your Contact no"
                        name="mobile"
                        className="mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md"
                        ref={register({
                          required: "Required",
                        })}
                        style={{
                          border: errors.number && "1px solid #ff0000",
                        }}
                      />
                      {errors.number && (
                        <span className="text-danger">
                          {errors.number.message}
                        </span>
                      )}
                    </div>
                    <div className="col-span-6">
                      {/* <label className="block text-sm font-medium text-gray-700">Your message</label> */}
                      <textarea
                        rows="5"
                        placeholder="Tell us a a bit about your goals, so we can get you started"
                        name="message"
                        className="mt-1 shadow-sm focus:outline-none focus:ring-primary focus:border-primary mt-1 block w-full sm:text-sm border border-gray rounded-md"
                        ref={register({
                          required: "Required",
                        })}
                        style={{
                          border: errors.message && "1px solid #ff0000",
                        }}
                      />
                    </div>
                    <div className="col-span-6 text-center">
                      <button className="btn" type="submit">
                        Send
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <div className="col-span-3">
                <img className="-mt-14" src="../../../../../public/images/frontend/contact.png"/>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="md:pt-8" >
        <div>
          <SectionTitle upper="More Queries ?" lower="Visit us at" align="center"/>
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14141.624591207146!2d84.5708754!3d27.6119352!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc5923d966a6d62a9!2sThe%20Dial%20Int%E2%80%99l%20Education!5e0!3m2!1sne!2snp!4v1607844623488!5m2!1sne!2snp"
            width="100%"
            height="450"
            frameBorder="0"
            style={{ border: "0" }}
            allowFullScreen=""
            aria-hidden="false"
            tabIndex="0"
          />
        </div>
      </div>
    </React.Fragment>
  );
}
