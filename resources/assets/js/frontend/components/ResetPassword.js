import React, { useContext, useState, useEffect } from "react";
import { useForm } from "react-hook-form";
import { GlobalContext } from "../context/GlobalContext";
import SectionTitle from "../component/SectionTitle";
export default function ResetPassword(props) {
  const { register, handleSubmit, errors, getValues } = useForm();
  const [showResetDiv, setShowResetDiv] = useState(false);
  const [email, setEmail] = useState("");
  const { showNotification } = useContext(GlobalContext);
  const {
    register: register1,
    handleSubmit: handleSubmit1,
    errors: errors1,
  } = useForm();

  const submitCode = async (value) => {
    const res = await axios.post("api/submit_reset_code", value);
    if (res.data.status == "success") {
      showNotification(true, "success", res.data.message);
      setShowResetDiv(true);
    } else {
      showNotification(true, "error", res.data.message);
    }
  };
  const onSubmit = async (value) => {
    const res = await axios.post("api/user_change_password", value);
    if (res.data.status == "success") {
      showNotification(true, "success", res.data.message);
      window.localStorage.removeItem("rp_email");
      props.history.push("/login");
    } else {
      showNotification(true, "error", res.data.message);
    }
  };

  useEffect(() => {
    const rp_email = window.localStorage.getItem("rp_email");
    if (rp_email) {
      setEmail(rp_email);
    } else {
      setEmail("");
    }
  }, []);

  return (
      <div className="section py-5">
      <div className="container form_verify">
      <SectionTitle title="Reset Password" />
      <div
        className="sidenav_main_content customize_form"
        style={{ display: showResetDiv ? "none" : "block" }}
        >
        <form onSubmit={handleSubmit1(submitCode)}>
          <div className="form-group text-center">
            <label className="col-md-12 mb-3">Enter the Code Send Via Email</label>
            <div className="col-md-12">
              <input
                type="hidden"
                name="email"
                defaultValue={email}
                ref={register1}
              />
              <input
                className="col-md-6"
                type="text"
                placeholder="Enter the reset code"
                name="reset_code"
                ref={register1({
                  required: "Required",
                })}
                style={{
                  border: errors1.reset_code && "1px solid #ff0000",
                }}
              />
            </div>
          </div>
          <div className="text-center">
            <button className="btn" type="submit">
              Submit
            </button>
          </div>
        </form>
      </div>

      <div
        id="change_password"
        style={{ display: showResetDiv ? "block" : "none" }}
      >
        <div className="sidenav_main_content customize_form">
          <form onSubmit={handleSubmit(onSubmit)}>
            <div className="form-group row">
              <label className="col-md-4">New Password</label>
              <div className="col-md-8">
                <input
                  type="hidden"
                  name="email"
                  defaultValue={email}
                  ref={register}
                />
                <input
                  className="col-md-10"
                  type="password"
                  placeholder="Enter new password"
                  name="password"
                  ref={register({
                    required: "Required",
                    minLength: {
                      value: 8,
                      message: "Password Must Be Minimun of 8 Characters",
                    },
                  })}
                  style={{
                    border: errors.password && "1px solid #ff0000",
                  }}
                />
                {errors.password && (
                  <div>
                    <span className="text-danger">
                      {errors.password.message}
                    </span>
                  </div>
                )}
              </div>
            </div>
            <div className="form-group row">
              <label className="col-md-4">Confirm New Password</label>
              <div className="col-md-8">
                <input
                  className="col-md-10"
                  type="password"
                  placeholder="Confirm new password"
                  name="password_confirmation"
                  ref={register({
                    required: "Required",
                    validate: (value) =>
                      value === getValues("password") || "Password Must Match",
                  })}
                  style={{
                    border: errors.password_confirmation && "1px solid #ff0000",
                  }}
                />
                {errors.password_confirmation && (
                  <div>
                    <span className="text-danger">
                      {errors.password_confirmation.message}
                    </span>
                  </div>
                )}
              </div>
            </div>
            <div className="text-center">
              <button className="btn" type="submit">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
  );
}
