import React, { useContext, useState, useEffect } from "react";
import SideNavTitle from "../../component/SideNavTitle";
import { AuthContext } from "../../context/AuthContext";
import { Radio, RadioGroup } from "rsuite";

export default function AddressIndividual({
  number,
  bill_province,
  bill_district,
  bill_region,
  ship_province,
  ship_district,
  ship_region,
  getDistrict,
  getRegion,
  register,
  errors,
  setValue,
}) {
  const [billadd, setBilladd] = useState("S");
  const { userDetails } = useContext(AuthContext);

  useEffect(() => {
    if (userDetails.shipping_address) {
      setBilladd(userDetails.shipping_address);
    }
    setTimeout(() => {
      setValue("bill_province_id", userDetails.bill_province_id);
      setValue("bill_district_id", userDetails.bill_district_id);
      setValue("bill_mun_vdc_id", userDetails.bill_mun_vdc_id);
      setTimeout(() => {
        setValue("ship_province_id", userDetails.ship_province_id);
        setValue("ship_district_id", userDetails.ship_district_id);
        setValue("ship_mun_vdc_id", userDetails.ship_mun_vdc_id);
      }, 500);
    }, 2000);
  }, [userDetails, bill_district, bill_region, ship_district, ship_region]);

  return (
    <div>
      <div className="position-relative mb-2">
        <SideNavTitle title={`Billing Address Detail`} />
        <a className="float-right">
          <i
            className={`ti-trash ${number > 1 ? "d-block" : "d-none"}`}
            style={{
              position: "absolute",
              right: "5%",
              top: "7%",
              fontSize: "1.4rem",
              color: "red",
              cursor: "pointer",
            }}
          />
        </a>

        <div className="form-group">
          <label className="col-md-2">Street Address</label>
          <div className="col-md-5">
            <input
              type="text"
              placeholder="Address"
              name="bill_str_address"
              ref={register({
                required: "Required",
              })}
              defaultValue={userDetails.bill_str_address}
              style={{
                border: errors.bill_str_address && "1px solid #ff0000",
              }}
            />
          </div>
        </div>

        <div className="form-group">
          <label className="col-md-2">Province</label>
          <div className="col-md-4">
            <select
              className="nice-select"
              name="bill_province_id"
              onChange={getDistrict("B")}
              ref={register({
                required: "Required",
              })}
              style={{
                border: errors.bill_province_id && "1px solid #ff0000",
              }}
              id="bill_province_id"
            >
              <option value="">--Select Province--</option>
              {bill_province.length > 0
                ? bill_province.map((pro) => (
                    <option key={pro.id} value={pro.id}>
                      {pro.stat_name}
                    </option>
                  ))
                : ""}
            </select>
          </div>

          <label className="col-md-2">District</label>
          <div className="col-md-4">
            <select
              className="nice-select"
              name="bill_district_id"
              onChange={getRegion("B")}
              ref={register({
                required: "Required",
              })}
              style={{
                border: errors.bill_district_id && "1px solid #ff0000",
              }}
              id="bill_district_id"
            >
              <option value="">--Select District--</option>
              {bill_district.length > 0
                ? bill_district.map((dis) => (
                    <option key={dis.districtid} value={dis.districtid}>
                      {dis.districtnamenp}
                    </option>
                  ))
                : ""}
            </select>
          </div>
        </div>
        <div className="form-group">
          <label className="col-md-2">Region</label>
          <div className="col-md-4">
            <select
              className="nice-select"
              name="bill_mun_vdc_id"
              ref={register({
                required: "Required",
              })}
              style={{
                border: errors.bill_mun_vdc_id && "1px solid #ff0000",
              }}
              id="bill_mun_vdc_id"
            >
              <option value="">--Select Region--</option>
              {bill_region.length > 0
                ? bill_region.map((reg) => (
                    <option key={reg.id} value={reg.id}>
                      {reg.vdc_namenp}
                    </option>
                  ))
                : ""}
            </select>
          </div>
          <label className="col-md-2">Postal Code</label>
          <div className="col-md-4">
            <input
              type="text"
              placeholder="Enter Postal/Zip Code"
              name="bill_postal_zip_code"
              ref={register}
              defaultValue={userDetails.bill_postal_zip_code}
            />
          </div>
        </div>
      </div>

      <input
        type="hidden"
        name="shipping_address"
        value={billadd}
        ref={register}
      />
      <SideNavTitle title={`Shipping Address`} />
      <RadioGroup
        inline
        name="billing_address"
        value={billadd}
        onChange={(value) => {
          setBilladd(value);
        }}
      >
        <Radio value="S" name="billing_address">
          Same as Billing Address
        </Radio>
        <Radio value="D" name="billing_address">
          Use Different Address
        </Radio>
      </RadioGroup>

      <div>
        {billadd == "D" ? (
          <div className="position-relative mb-2">
            <SideNavTitle title={`Shipping Address Detail`} />

            <div className="form-group">
              <label className="col-md-2">Street Address</label>
              <div className="col-md-5">
                <input
                  type="text"
                  placeholder="Address"
                  name="ship_str_address"
                  ref={register({
                    required: "Required",
                  })}
                  style={{
                    border: errors.ship_str_address && "1px solid #ff0000",
                  }}
                  defaultValue={userDetails.ship_str_address}
                />
              </div>
            </div>

            <div className="form-group">
              <label className="col-md-2">Province</label>
              <div className="col-md-4">
                <select
                  className="nice-select"
                  name="ship_province_id"
                  onChange={getDistrict("S")}
                  ref={register({
                    required: "Required",
                  })}
                  style={{
                    border: errors.ship_province_id && "1px solid #ff0000",
                  }}
                  id="ship_province_id"
                >
                  <option value="">--Select Province--</option>
                  {ship_province.length > 0
                    ? ship_province.map((pro) => (
                        <option key={pro.id} value={pro.id}>
                          {pro.stat_name}
                        </option>
                      ))
                    : ""}
                </select>
              </div>

              <label className="col-md-2">District</label>
              <div className="col-md-4">
                <select
                  className="nice-select"
                  name="ship_district_id"
                  onChange={getRegion("S")}
                  ref={register({
                    required: "Required",
                  })}
                  style={{
                    border: errors.ship_district_id && "1px solid #ff0000",
                  }}
                  id="ship_district_id"
                >
                  <option value="">--Select District--</option>
                  {ship_district.length > 0
                    ? ship_district.map((dis) => (
                        <option key={dis.districtid} value={dis.districtid}>
                          {dis.districtnamenp}
                        </option>
                      ))
                    : ""}
                </select>
              </div>
            </div>
            <div className="form-group">
              <label className="col-md-2">Region</label>
              <div className="col-md-4">
                <select
                  className="nice-select"
                  name="ship_mun_vdc_id"
                  ref={register({
                    required: "Required",
                  })}
                  style={{
                    border: errors.ship_mun_vdc_id && "1px solid #ff0000",
                  }}
                  id="ship_mun_vdc_id"
                >
                  <option value="">--Select Region--</option>
                  {ship_region.length > 0
                    ? ship_region.map((reg) => (
                        <option key={reg.id} value={reg.id}>
                          {reg.vdc_namenp}
                        </option>
                      ))
                    : ""}
                </select>
              </div>
              <label className="col-md-2">Postal Code</label>
              <div className="col-md-4">
                <input
                  type="text"
                  placeholder="Enter Postal/Zip Code"
                  name="ship_postal_zip_code"
                  ref={register}
                  defaultValue={userDetails.ship_postal_zip_code}
                />
              </div>
            </div>
          </div>
        ) : null}
      </div>
    </div>
  );
}
