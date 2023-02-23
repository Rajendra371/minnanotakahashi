import React, {useEffect} from "react";
import { useHistory, useLocation } from "react-router-dom";
import { emphasize, withStyles } from "@material-ui/core/styles";
import Breadcrumbs from "@material-ui/core/Breadcrumbs";
import Chip from "@material-ui/core/Chip";
import HomeIcon from "@material-ui/icons/Home";
import Typography from "@material-ui/core/Typography";

const StyledBreadcrumb = withStyles((theme) => ({
  root: {
    backgroundColor: theme.palette.grey[200],
    height: theme.spacing(3),
    color: theme.palette.grey[800],
    fontWeight: theme.typography.fontWeightRegular,
    "&:hover, &:focus": {
      backgroundColor: theme.palette.grey[300],
    },
    "&:active": {
      boxShadow: theme.shadows[1],
      backgroundColor: emphasize(theme.palette.grey[300], 0.2),
    },
  },
}))(Chip);

export default function Breadcrumb() {
  const history = useHistory();
  const location = useLocation();
  const pathnames = location.pathname.split("/").filter((x) => x);

  return pathnames.length ? (
    <div className="breadcumb-section ">
      <div className="container">
        <Breadcrumbs aria-label="breadcrumb">
          <HomeIcon fontSize="small" onClick={() => history.push("/")} />
          {pathnames.map((name, index) => {
            const last = index === pathnames.length - 1;
            const to = `/${pathnames.slice(0, index + 1).join("/")}`;
            const linkName = name.split("_" ).join(" ");
            return last ? (
              <Typography color="textPrimary" key={index}>
                {linkName}
              </Typography>
            ) : (
              <StyledBreadcrumb
                key={index}
                onClick={() => history.push(to)}
                label={name}
              />
            );
          })}
        </Breadcrumbs>
      </div>
    </div>
  ) : null;
}
