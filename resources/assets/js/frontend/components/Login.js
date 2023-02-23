import React, { useState, useContext, useEffect } from "react";
import { Link, Redirect } from "react-router-dom";
import SectionTitle from "../component/SectionTitle";
import FacebookUserLogin from "./FacebookUserLogin";
import GoogleUserLogin from "./GoogleUserLogin";
import { AuthContext } from "../context/AuthContext";
import { useForm } from "react-hook-form";
import HelmetMetaData from "./HelmetMetaData/HelmetMetaData";

export default function Login() {
  const { isAuthenticated, userLogin, isLoading, errorMessages } = useContext(
    AuthContext
  );
  const [visibility, setVisibility] = useState(false);
  const [redirect, setRedirect] = useState(false);

  const { register, handleSubmit, errors } = useForm();

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const onSubmit = (value) => {
    // e.preventDefault();
    // const data = {
    //   email: email,
    //   password: password,
    //   user_type: "CUSTOMER",
    // };
    const res = userLogin(value);
    if (res) {
      setRedirect(true);
    }
  };
  const iconStyle = {
    position: "absolute",
    right: "10px",
    top: "50%",
    fontSize: "18px",
    cursor: "pointer",
  };
  const content =
    isAuthenticated || redirect ? (
      <Redirect to="/profile" />
    ) : (
      <div className="relative py-8 md:py-14">
        <HelmetMetaData />
        <div className="container mx-auto">
          <div className=" px-3 sm:px-6 lg:px-8 ">
            <div className="flex flex-col justify-center">
              <SectionTitle lower="Login Form" align="center"/>
              <div className="rounded-lg shadow-lg p-5 bg-white mx-auto w-full md:w-3/4">
                <form
                  onSubmit={handleSubmit(onSubmit)}
                  className="grid grid-cols-3 lg:grid-cols-6 gap-6 items-center"
                >
                  <input
                    type="hidden"
                    name="user_type"
                    defaultValue="CUSTOMER"
                    ref={register}
                  />
                  <div className="col-span-3 lg:border-r-2 lg:-mr-8 lg:pr-8 border-primary ">
                    <div className="form-group mb-5">
                      <label className="required block text-sm font-medium text-gray-700">Email</label>
                      <input
                        style={{
                          border: errors.email && "1px solid #ff0000",
                        }}
                        type="email"
                        placeholder="Enter your email"
                        name="email"
                        className={`mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md`}
                        ref={register({
                          required: "Required",
                          pattern: {
                            value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
                            message: "Invalid Email Address",
                          },
                        })}
                        // value={email}
                        // onChange={(e) => {
                        //   setEmail(e.target.value);
                        // }}
                      />
                      {errors.email && (
                        <span className="text-sm text-red">
                          {errors.email.message}
                        </span>
                      )}
                    </div>
                    <div className="form-group relative">
                      <label className="required  block text-sm font-medium text-gray-700">Password</label>
                      <input
                        style={{
                          border: errors.password && "1px solid #ff0000",
                        }}
                        className="mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md"
                        type={visibility ? "text" : "password"}
                        placeholder="Enter your password"
                        name="password"
                        ref={register({
                          required: "Required",
                        })}

                        // value={password}
                        // onChange={(e) => {
                        //   setPassword(e.target.value);
                        // }}
                      />

                      <i
                        style={iconStyle}
                        className="material-icons text-base"
                        onClick={() => setVisibility(!visibility)}
                      >{
                          visibility
                            ? "visibility"
                            : "visibility_off"
                        }</i>
                    </div>
                    <div className="text-right my-3">
                      <Link to="/forgot_password" className="text-black text-sm hover:opacity-80">
                        Forgot Password?
                      </Link>
                    </div>
                    <div className="text-center mb-4 mb-md-0">
                      {/* {errorMessages ? (
                        <div className="text-danger">{errorMessages}</div>
                      ) : null} */}
                      <button className="btn ">
                        {isLoading ? "Signing In ....." : "Login"}
                      </button>
                    </div>
                    <div className="text-right mt-3 pt-3 border-t border-gray text-sm">
                      Dont have an account yet ? <Link to="/register" className="text-dark-secondary underline text-sm hover:opacity-80">
                        Register
                      </Link>
                    </div>
                  </div>
                  <div className="col-span-3">
                    <div className="flex flex-col justify-center items-center">
                      <FacebookUserLogin />
                      <GoogleUserLogin />
                      {/* <button className="google mt-3">
                        <i className="fa fa-google mr-2" />
                        Login with Gmail
                      </button> */}
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  return content;
}
