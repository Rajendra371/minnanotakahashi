import React, { Component, useContext, useState } from "react";
import { Link, Redirect } from "react-router-dom";
import SectionTitle from "../component/SectionTitle";
import { AuthContext } from "../context/AuthContext";
import { useForm } from "react-hook-form";
import FacebookUserLogin from "./FacebookUserLogin";
import GoogleUserLogin from "./GoogleUserLogin";
import HelmetMetaData from "./HelmetMetaData/HelmetMetaData";

export default function Register(props) {
  const {
    userRegister,
    isLoading,
    registerSuccess,
    errorMessages,
  } = useContext(AuthContext);

  const [redirect, setRedirect] = useState(false);

  const { register, handleSubmit, errors, getValues } = useForm();

  const onSubmit = async (value) => {
    if (await userRegister(value)) {
      setRedirect(true);
    }
  };

  return (
    <div className="relative py-8 md:py-14">
      {redirect ? (
        <Redirect to="/login" />
      ) : (
        <div className="container mx-auto">
          <HelmetMetaData />
          <div className="px-3 sm:px-6 lg:px-8 ">
            <div className="flex flex-col justify-center"> 
              <SectionTitle lower="Register Form" align="center"/>
              <div className="rounded-lg shadow-lg p-5 bg-white mx-auto w-full md:w-3/4">
                <div className="grid grid-cols-3 lg:grid-cols-6 gap-6 items-center">
                <form
                  onSubmit={handleSubmit(onSubmit)}
                  className="col-span-3 lg:border-r-2 lg:-mr-8 lg:pr-8 border-primary "
                >
                  <div className="">
                    <div className="form-group mb-5">
                      <label className="required block text-sm font-medium text-gray-700">Full Name</label>
                      <input
                        style={{
                          border: errors.username && "1px solid #ff0000",
                        }}
                        type="text"
                       className="mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md"

                        placeholder="Enter your Full Name"
                        name="username"
                        ref={register({
                          required: "Required",
                        })}
                      />
                    </div>
                    <div className="form-group mb-5">
                      <label  className="required  block text-sm font-medium text-gray-700">Email</label>
                      <input
                        style={{
                          border: errors.email && "1px solid #ff0000",
                        }}
                         className="mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md"

                        type="email"
                        placeholder="Enter your email"
                        name="email"
                        ref={register({
                          required: "Required",
                          pattern: {
                            value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
                            message: "Invalid Email Format",
                          },
                        })}
                      />
                      {errors.email && (
                        <span className="text-danger text-sm text-red">
                          {errors.email.message}
                        </span>
                      )}
                    </div>
                    <div className="form-group mb-5">
                      <label  className="required  block text-sm font-medium text-gray-700">Mobile</label>
                      <input
                        style={{
                          border: errors.contact && "1px solid #ff0000",
                        }}
                        type="text"
                        className="mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md"
                        placeholder="Enter your mobile number"
                        name="contact"
                        ref={register({
                          required: "Required",
                          pattern: {
                            value: /^([9]{1})([8]{1})([0-9]{8})$/i,
                            message: "Invalid Mobile Number",
                          },
                        })}
                      />
                      {errors.contact && (
                        <span className="text-danger  text-sm text-red">
                          {errors.contact.message}
                        </span>
                      )}
                    </div>
                    <div className="form-group mb-5">
                      <label  className="required  block text-sm font-medium text-gray-700">Password</label>
                      <input
                        style={{
                          border: errors.password && "1px solid #ff0000",
                        }}
                        className="mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md"

                        type="password"
                        placeholder="Enter your password"
                        name="password"
                        ref={register({
                          required: "Required",
                          minLength: {
                            value: 8,
                            message: "Password Must Be Minimun of 8 Characters",
                          },
                        })}
                      />
                      {errors.password && (
                        <span className="text-danger  text-sm text-red">
                          {errors.password.message}
                        </span>
                      )}
                    </div>
                    <div className="form-group">
                      <label  className="required  block text-sm font-medium text-gray-700">Confirm Password</label>
                      <input
                        style={{
                          border:
                            errors.password_confirmation && "1px solid #ff0000",
                        }}
                        className="mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md"
                        type="password"
                        placeholder="Confirm your password"
                        name="password_confirmation"
                        ref={register({
                          required: "Required",
                          validate: (value) =>
                            value === getValues("password") ||
                            "Password Must Match",
                        })}
                      />
                      {errors.password_confirmation && (
                        <span className="text-danger">
                          {errors.password_confirmation.message}
                        </span>
                      )}
                    </div>

                    <div className="text-center mt-4">
                      <div />
                      <div>
                        {registerSuccess.length > 0
                          ? registerSuccess.map((succ, ind) => (
                              <li className="text-success" key={ind}>
                                {succ}
                              </li>
                            ))
                          : ""}
                      </div>
                      <button className="btn ">
                        {" "}
                        {isLoading ? "Registering ....." : "signup"}
                      </button>
                    </div>
                      <div className="text-right mt-3 pt-3 border-t border-gray text-black text-sm">
                      Already have an account?{" "}
                      <Link to="/login" className="text-dark-secondary underline text-sm hover:opacity-80">
                        Login
                      </Link>
                    </div>
                  </div>
                </form>
                <div className="col-span-3">
                  <div className="flex flex-col justify-center items-center">
                    <img
                      src="../../../public/images/frontend/register.png"
                      width="auto"
                      height="350"
                      alt="register"
                    />
                    {/* <button className="fb  mb-4 ">
                      {" "}
                      <i className="fa fa-facebook mr-2" />
                      Signup With Facebook
                    </button>
                    <button className="google">
                      <i className="fa fa-google mr-2" />
                      Signup with Gmail
                    </button> */}
                    <FacebookUserLogin />
                    <GoogleUserLogin />
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
