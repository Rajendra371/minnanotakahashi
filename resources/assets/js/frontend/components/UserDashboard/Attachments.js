import React, { useState, useRef, useContext, useEffect } from "react";
import SectionTitle from "../../component/SectionTitle";
import { Uploader } from "rsuite";
import { useSnackbar } from "notistack";
import { AuthContext } from "../../context/AuthContext";
import * as authActions from "../../context/AuthActionType";

export default function Attachments() {
  const [value, setValue] = useState([]);
  const uploader = useRef(null);
  const { enqueueSnackbar } = useSnackbar();
  const { userDetails, dispatch } = useContext(AuthContext);
  const [attachment, setAttachment] = useState("");
  const [fileType, setfileType] = useState("");
  const handleChange = (value) => {
    setValue(value);
  };
  const handleUpload = () => {
    uploader.current.start();
  };
  const handleReupload = (file) => {
    uploader.current.start(file);
  };

  useEffect(() => {
    setAttachment(userDetails.attachment);
  }, [userDetails]);

  useEffect(() => {
    if (attachment) {
      let fileExtension = attachment.split(".")[1].toLowerCase();
      let extensions = ["jpg", "png", "gif", "jpeg"];
      if (extensions.includes(fileExtension)) {
        setfileType("image");
      } else {
        setfileType("download");
      }
    }
  }, [attachment]);

  return (
    <React.Fragment>
      <SectionTitle lower="My Attachments" align="left" />
      <div className="p-5 rounded-lg shadow-lg bg-white">
        <Uploader
          listType="picture-text"
          // defaultFileList={null}
          autoUpload={false}
          // multiple
          headers={{
            Authorization:
              "Bearer " + localStorage.getItem("frontend-jwt-token"),
          }}
          withCredentials={true}
          fileList={value}
          onChange={handleChange}
          onSuccess={(response) => {
            enqueueSnackbar(response.message, { variant: "success" });
            dispatch({
              type: authActions.SET_USER_DETAILS,
              payload: response.data,
            });
            setValue([]);
          }}
          ref={uploader}
          action="api/customer/save_attachments"
        />
        <div className="mt-4">
          {fileType == "image" ? (
            <img src={`/uploads/user_attachment/${attachment}`} alt={attachment} />
          ) : (
            ""
          )}
          {fileType == "download" ? (
            <a
              className="text-sm inline-block text-center w-auto hover:text-primary"
              href={`/uploads/user_attachment/${attachment}`}
              alt=""
              target="_blank"
            >
              <i className="material-icons text-7xl block text-primary">
                file_download
              </i>
              {attachment}
            </a>
          ) : (
            ""
          )}
        </div>
        <div className="border-t border-gray mt-5">
          <button
            className="btn mt-5"
            disabled={!value.length}
            onClick={handleUpload}
          >
            Start Upload
          </button>
        </div>
      </div>
    </React.Fragment>
  );
}
