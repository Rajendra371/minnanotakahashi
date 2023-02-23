import React, { useEffect, useState, useContext } from "react";
import SectionTitle from "../../component/SectionTitle";
import LoaderSpinner from "../../component/LoaderSpinner";
import { AuthContext } from "../../context/AuthContext";
import { useForm } from "react-hook-form";

export default function ProfileInfo() {
  const { userDetails, save_user_profile } = useContext(AuthContext);
  const [isloading, setLoading] = useState(true);
  const [month, setMonth] = useState([]);
  const { register, handleSubmit, errors, setValue } = useForm();

  const makeYear = () => {
    let max = new Date().getFullYear();
    let min = max - 80;
    var years = [];
    for (var i = max; i >= min; i--) {
      years.push(i);
    }
    return years;
  };
  const makeDays = () => {
    var days = [];
    for (var i = 1; i <= 32; i++) {
      days.push(i);
    }
    return days;
  };
  const [year, setYear] = useState(makeYear());
  const [days, setDays] = useState(makeDays());

  useEffect(() => {
    const get_month = async () => {
      const res = await axios.get("api/get_month");
      if (res.data.status == "success") {
        setMonth(res.data.data);
        setLoading(false);
      } else {
        setMonth([]);
        setLoading(false);
      }
    };
    get_month();
    return () => {
      setMonth([]);
    };
  }, [userDetails]);

  useEffect(() => {
    if (userDetails.dob) {
      // console.log("reached Here");
      const dob = userDetails.dob.split("/");
      // console.log(dob);
      setValue("yearid", dob[0]);
      setValue("monthid", dob[1]);
      setValue("dayid", dob[2]);
    }
  }, [month]);

  const onSubmit = (data) => {
    save_user_profile(data);
  };

  return (
    <React.Fragment>
      {isloading ? (
        <LoaderSpinner />
      ) : (
        <React.Fragment>
          <SectionTitle lower="Personal Info" align="left" />

          <div className="p-5 rounded-lg shadow-lg bg-white">
            <form onSubmit={handleSubmit(onSubmit)}>
              <div className="grid grid-cols-12  gap-x-5 items-center">
                <label className="required block text-sm font-medium text-gray-700 col-span-12 md:col-span-3">
                  Full Name
                </label>
                <div className="col-span-12 md:col-span-9">
                  <input
                    className={`mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md`}
                    type="text"
                    placeholder="Enter your Full name"
                    name="fullname"
                    ref={register({
                      required: "Required",
                    })}
                    defaultValue={userDetails.fullname}
                    style={{
                      border: errors.fullname && "1px solid #ff0000",
                    }}
                  />
                </div>
              </div>
              <div className="grid grid-cols-12  gap-x-5 items-center my-4">
                <label className="required block text-sm font-medium text-gray-700 col-span-12 md:col-span-3">
                  Email
                </label>
                <div className="col-span-12 md:col-span-9">
                  <input
                    className={`mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md`}
                    type="email"
                    placeholder="Enter your email"
                    disabled
                    defaultValue={userDetails.email}
                  />
                </div>
              </div>
              <div className="grid grid-cols-12  gap-x-5 items-center">
                <label className="required block text-sm font-medium text-gray-700 col-span-12 md:col-span-3">
                  Mobile
                </label>
                <div className="col-span-12 md:col-span-9">
                  <input
                    className={`mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md`}
                    type="text"
                    placeholder="Mobile Number"
                    defaultValue={userDetails.contact}
                    disabled
                  />
                </div>
              </div>
              <div className="grid grid-cols-12  gap-x-5 items-center my-4">
                <label className="required block text-sm font-medium text-gray-700 col-span-12 md:col-span-3">
                  DOB
                </label>
                <div className="col-span-12 md:col-span-9 ">
                  <div className="grid grid-cols-3 gap-4">
                    <div className="">
                      <select
                        className={` p-2 mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md`}
                        name="monthid"
                        ref={register({
                          required: "Required",
                        })}
                        id="monthid"
                        style={{
                          border: errors.monthid && "1px solid #ff0000",
                        }}
                      >
                        <option value="">Month</option>
                        {month.length > 0
                          ? month.map((mon) => (
                              <option key={mon.monthid} value={mon.monthid}>
                                {mon.nameen}
                              </option>
                            ))
                          : ""}
                      </select>
                    </div>
                    <div className="">
                      <select
                        name="dayid"
                        ref={register({
                          required: "Required",
                        })}
                        className={`p-2 mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md`}
                        id="dayid"
                        style={{
                          border: errors.dayid && "1px solid #ff0000",
                        }}
                      >
                        <option value="">Day</option>
                        {days.length > 0
                          ? days.map((day, idx) => (
                              <option key={idx} value={day}>
                                {day}
                              </option>
                            ))
                          : ""}
                      </select>
                    </div>
                    <div className="">
                      <select
                        name="yearid"
                        ref={register({
                          required: "Required",
                        })}
                        className={`p-2 mt-1 focus:outline-none focus:ring-primary focus:border-primary block w-full shadow-sm text-xs sm:text-sm border border-gray rounded-md`}
                        id="yearid"
                        style={{
                          border: errors.yearid && "1px solid #ff0000",
                        }}
                      >
                        <option value="">Year</option>
                        {year.length > 0
                          ? year.map((yrs, idx) => (
                              <option key={idx} value={yrs}>
                                {yrs}
                              </option>
                            ))
                          : ""}
                      </select>
                    </div>
                  </div>
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
      )}
    </React.Fragment>
  );
}
