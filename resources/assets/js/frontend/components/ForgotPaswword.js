import React, { useState, useContext } from "react";
import SectionTitle from "../component/SectionTitle";
import { useForm } from "react-hook-form";
import { GlobalContext } from "../context/GlobalContext";
import { Redirect } from "react-router-dom";
import HelmetMetaData from "./HelmetMetaData/HelmetMetaData";

export function ForgotPaswword() {
  const { register, handleSubmit, errors } = useForm();
  const { showNotification } = useContext(GlobalContext);
  const [redirect, setRedirect] = useState(false);
  const onSubmit = async (value) => {
    const res = await axios.post("api/reset_user_password", value);
    if (res.data.status == "success") {
      showNotification(true, "success", res.data.message);
      window.localStorage.setItem("rp_email", value.email);
      setRedirect(true);
    } else {
      showNotification(true, "error", res.data.message);
    }
  };

  return (
    <div className="relative py-8 md:py-14">
      {redirect ? (
        <Redirect to="/reset_password" />
      ) : (
        <div className="container mx-auto">
          <HelmetMetaData />
          <div className="px-3 sm:px-6 lg:px-8 ">
            <div className="flex flex-col justify-center">
              <SectionTitle lower="Forgot Password" align="center"/>
              <div className="lrounded-lg shadow-lg p-5 bg-white mx-auto w-full md:w-3/4">
                <form
                  onSubmit={handleSubmit(onSubmit)}
                  className="row align-items-center justify-content-center"
                >
                  <div className="text-md text-black text-center">
                    Please enter your email address. You will receive a link to
                    create a new password via email.
                    <div className="form-group my-5 flex items-center">
                      <label className="mr-3 mb-0 w-1/4 text-sm font-medium text-gray-700">Email</label>
                      <input
                        type="email"
                       className="mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md"

                        placeholder="Enter your email"
                        name="email"
                        style={{
                          border: errors.email && "1px solid #ff0000",
                        }}
                        ref={register({
                          required: "Required",
                          pattern: {
                            value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
                            message: "Invalid Email Address",
                          },
                        })}
                      />
                    </div>
                    <div>
                      {errors.email && (
                        <span className="text-danger">
                          {errors.email.message}
                        </span>
                      )}
                    </div>
                    <div className="text-center">
                      <button className="btn ">Reset Password</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
export default ForgotPaswword;
