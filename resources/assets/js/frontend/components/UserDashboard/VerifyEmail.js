import React, { useState, useContext, useEffect } from "react";
import { AuthContext } from "../../context/AuthContext";
import { useForm } from "react-hook-form";
import SectionTitle from "../../component/SectionTitle";
import { Redirect } from "react-router-dom";
import LoaderSpinner from "../../component/LoaderSpinner";

const VerifyEmail = (props) => {
  const [redirect, setRedirect] = useState(false);
  const {
    userDetails,
    verifyEmailContext,
    userResendVerifyCode,
    isAuthenticated,
    loader,
  } = useContext(AuthContext);
  const [userEmail, setUserEmail] = useState(userDetails.email);
  const [verified, setVerified] = useState(userDetails.email_verified_at);
  const { register, handleSubmit, errors } = useForm();

  const verifyUserEmail = (values) => {
    console.log(values);
    verifyEmailContext(values);
  };

  const resendOtpCode = (e) => {
    e.preventDefault();
    userResendVerifyCode(userEmail);
  };

  useEffect(() => {
    setUserEmail(userDetails.email);
    console.log("verified", useDetails.email_verified_at)
    setVerified(userDetails.email_verified_at);
  }, [userDetails]);

  return (
    <React.Fragment>
      {loader ? (
        <div className="relative py-8 md:py-14">
        <div className="container mx-auto">
          <LoaderSpinner />
        </div>
        </div>
      ) : (
        <div className="relative py-8 md:py-14">
          {verified ? (
            <Redirect to="/profile" />
          ) : (
            <div>
              {isAuthenticated ? (
                <div className="container mx-auto">
                  <div className=" px-3 sm:px-6 lg:px-8 ">
                    <div className="flex flex-col justify-center">>
                      <SectionTitle lower="Verify Email" align="center" />
                      <div className="rounded-lg shadow-lg p-5 bg-white mx-auto w-3/4">
                        <form onSubmit={handleSubmit(verifyUserEmail)}>
                          <input
                            type="hidden"
                            name="email"
                            defaultValue={userEmail}
                            ref={register}
                          />
                          <p htmlFor="otp_code" className="text-write text-base">
                                An email has been sent to <b>{userEmail}</b>, use the code
                            provided in the email to verify your account
                          </p>
                          <div className="text-center">
                            <input
                              style={{
                                border: errors.otp_code && "1px solid #ff0000",
                                width: "50%",
                                margin: ".75rem auto",
                              }}
                              type="text"
                              name="otp_code"
                              className="`mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border border-gray rounded-md"
                              id="otp_code"
                              placeholder="Enter the code here"
                              ref={register({
                                required: "Required",
                              })}
                            />
                            <button
                              className="btn d-block mx-auto"
                              type="submit"
                            >
                              Verify
                            </button>
                          </div>
                        </form>

                        <div className="mt-4 text-center text-write text-base">
                          If you did not receive the email click on the resend
                          button
                          <button
                            className="btn d-block mx-auto"
                            onClick={resendOtpCode}
                          >
                            Resend Email
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              ) : (
                <Redirect to="/" />
              )}
            </div>
          )}
        </div>
      )}
    </React.Fragment>
  );
};

export default VerifyEmail;
