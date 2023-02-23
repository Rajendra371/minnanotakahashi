import React, { useState, useContext, useEffect } from "react";
import SectionTitle from "../../component/SectionTitle";
import AddressIndividual from "./AddressIndividual";
import { useForm } from "react-hook-form";
import { AuthContext } from "../../context/AuthContext";
import LoaderSpinner from "../../component/LoaderSpinner";

export default function AddressInfo() {
  const { save_user_address, userDetails } = useContext(AuthContext);
  const [isloading, setLoading] = useState(true);
  const [address, setAddress] = useState(1);
  const newAddress = () => {
    setAddress(address + 1);
  };

  const [bill_provience, setBill_Provience] = useState([]);
  const [bill_district, setBill_District] = useState([]);
  const [bill_region, setBill_Region] = useState([]);

  const [ship_provience, setShip_Provience] = useState([]);
  const [ship_district, setShip_District] = useState([]);
  const [ship_region, setShip_Region] = useState([]);

  const { register, handleSubmit, errors, setValue } = useForm();

  const getDistrict = (type) => async (e) => {
    const data = {
      state_id: e.target.value,
    };

    const res = await axios.post("/api/get_district", data);
    if (res.data.status == "success") {
      if (type === "B") {
        setBill_District(res.data.data);
      } else if (type == "S") {
        setShip_District(res.data.data);
      }
    } else {
      if (type === "B") {
        setBill_District([]);
      } else if (type == "S") {
        setShip_District([]);
      }
    }
  };

  const getRegion = (type) => async (e) => {
    const data = {
      district_id: e.target.value,
    };
    const res = await axios.post("/api/get_region", data);
    if (res.data.status == "success") {
      if (type === "B") {
        setBill_Region(res.data.data);
      } else if (type === "S") {
        setShip_Region(res.data.data);
      }
    } else {
      if (type === "B") {
        setBill_Region([]);
      } else if (type === "S") {
        setShip_Region([]);
      }
    }
  };

  const onSubmit = (data) => {
    save_user_address(data);
  };
  const getUserDistrict = async (type, id) => {
    const data = {
      state_id: id,
    };

    const res = await axios.post("/api/get_district", data);
    if (res.data.status == "success") {
      if (type === "B") {
        setBill_District(res.data.data);
      } else if (type == "S") {
        setShip_District(res.data.data);
      }
    } else {
      if (type === "B") {
        setBill_District([]);
      } else if (type == "S") {
        setShip_District([]);
      }
    }
  };

  const getUserRegion = async (type, id) => {
    const data = {
      district_id: id,
    };
    const res = await axios.post("/api/get_region", data);
    if (res.data.status == "success") {
      if (type === "B") {
        setBill_Region(res.data.data);
      } else if (type === "S") {
        setShip_Region(res.data.data);
      }
    } else {
      if (type === "B") {
        setBill_Region([]);
      } else if (type === "S") {
        setShip_Region([]);
      }
    }
  };

  useEffect(() => {
    axios.get("/api/get_province").then((res) => {
      if (res.data.status == "success") {
        setBill_Provience(res.data.data);
        setShip_Provience(res.data.data);
        if (userDetails.bill_province_id) {
          getUserDistrict("B", userDetails.bill_province_id);
          getUserRegion("B", userDetails.bill_district_id);
        }
        if (userDetails.ship_province_id) {
          getUserDistrict("S", userDetails.ship_province_id);
          getUserRegion("S", userDetails.ship_district_id);
        }
       setLoading(false)
      } else {
        setBill_Provience([]);
        setShip_Provience([]);
        setLoading(false)
      }
      
    }

    );
  }, [userDetails]);

  return (

    isloading ?
      <LoaderSpinner/>
     :
    <React.Fragment>
      <SectionTitle title="Address Info" />
      <div className="sidenav_main_content">
        <form onSubmit={handleSubmit(onSubmit)}>
          {[...Array(address)].map((k, i) => (
            <AddressIndividual
              key={i}
              number={i + 1}
              bill_province={bill_provience}
              bill_district={bill_district}
              bill_region={bill_region}
              ship_province={ship_provience}
              ship_district={ship_district}
              ship_region={ship_region}
              getDistrict={getDistrict}
              getRegion={getRegion}
              register={register}
              errors={errors}
              setValue={setValue}
            />
          ))}

          <div className="text-center mt-3">
            <button className="btn" type="submit">
              Save
            </button>
          </div>
        </form>
      </div>
    </React.Fragment>
  );
}
