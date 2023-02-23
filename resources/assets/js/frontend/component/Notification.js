import React, { useContext } from "react";
import Snackbar from "@material-ui/core/Snackbar";
import Alert from "@material-ui/lab/Alert";
import { makeStyles } from "@material-ui/core/styles";
import Collapse from '@material-ui/core/Collapse';
import { GlobalContext } from "../context/GlobalContext";

const useStyles = makeStyles(theme => ({
  root: {
    width: "100%",
    "& > * + *": {
      marginTop: theme.spacing(2)
    }
  }
}));

const CustomizedSnackbars = () => {
  const classes = useStyles();
  const {snackbarMessage, snackbarOpen, snackbarType ,snackbarId, showNotification} = useContext(GlobalContext)
  
  const handleClose = (event, reason) => {
    if (reason === "clickaway") {
      return;
    }
    showNotification(false, snackbarType, snackbarMessage,snackbarId);
  };

  return (
    <div className={classes.root} key={snackbarId}>
      <Snackbar     
        anchorOrigin={{ vertical : 'top', horizontal: 'right' }}
        open={snackbarOpen}
        autoHideDuration={3000}
        TransitionComponent={(props)=><Collapse {...props}/>}
        onClose={handleClose}
        
      >
        <Alert
          elevation={6}
          variant="filled"
          onClose={handleClose}
          severity={snackbarType}
        >
          {snackbarMessage}
        </Alert>
      </Snackbar>
    </div>
  );
};

export default CustomizedSnackbars;
