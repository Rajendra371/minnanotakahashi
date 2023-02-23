import React, { useEffect, useState, useContext } from "react";
import SectionTitle from "../../component/SectionTitle";
import { AuthContext } from "../../context/AuthContext";
import { useForm } from "react-hook-form";
import { useHistory } from "react-router-dom";
import LoaderSpinner from "../../component/LoaderSpinner";

export default function ChangePassword() {
  const { userLogout, userChangePassword } = useContext(AuthContext);
  const [isloading, setLoading] = useState(true);
  const { register, handleSubmit, errors, getValues } = useForm();
  const history = useHistory();

  useEffect(() => {
    setTimeout(() => setLoading(false), 300);
  }, [])
  const ChangePassword = async (value) => {
    const result = await userChangePassword(value);
    if (result[0] == "success") {
      setTimeout(() => {
        history.push("/");
        userLogout();
      }, 3000);
    }
  };

  return (
    isloading ? <LoaderSpinner/> :
    <React.Fragment>
      <SectionTitle lower="Change Password" align="left"/>
      <div className="p-5 rounded-lg shadow-lg bg-white">
        <form onSubmit={handleSubmit(ChangePassword)}>
          <div className="grid grid-cols-12  gap-x-5 items-center">
            <label className="required block text-sm font-medium text-gray-700 col-span-12 md:col-span-3">Old Password</label>
            <div className="col-span-12 md:col-span-9">
              <input
                type="password"
                  className={`mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md`}
                placeholder="Enter old password"
                name="old_password"
                ref={register({
                  required: "Required",
                })}
                style={{
                  border: errors.old_password && "1px solid #ff0000",
                }}
              />
            </div>
          </div>
          <div className="grid grid-cols-12  gap-x-5 items-center my-3">
            <label className="required block text-sm font-medium text-gray-700 col-span-12 md:col-span-3">New Password</label>
            <div className="col-span-12 md:col-span-9">
              <input
                type="password"
                placeholder="Enter new password"
                name="password"
                  className={`mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md`}
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
                  <span className="text-danger text-red text-sm">{errors.password.message}</span>
                </div>
              )}
            </div>
          </div>
          <div className="grid grid-cols-12  gap-x-5 items-center mb-3">
            <label className="required block text-sm font-medium text-gray-700 col-span-12 md:col-span-3">Confirm New Password</label>
            <div className="col-span-12 md:col-span-9">
              <input
                type="password"
                placeholder="Confirm new password"
                name="password_confirmation"
                 className={`mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md`}

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
                  <span className="text-danger text-sm text-red">
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
    </React.Fragment>
  );
}
