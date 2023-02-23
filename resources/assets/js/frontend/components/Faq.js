import React, { useState, useEffect } from "react";
import SectionTitle from "../component/SectionTitle";
import { makeStyles } from "@material-ui/core/styles";
import Accordion from "@material-ui/core/Accordion";
import AccordionDetails from "@material-ui/core/AccordionDetails";
import AccordionSummary from "@material-ui/core/AccordionSummary";
import Typography from "@material-ui/core/Typography";
import ExpandMoreIcon from "@material-ui/icons/ExpandMore";
import LoaderSpinner from "../component/LoaderSpinner";
import ReactHtmlParser from "react-html-parser";
import HelmetMetaData from "./HelmetMetaData/HelmetMetaData";

const useStyles = makeStyles((theme) => ({
  root: {
    width: "100%",
    '& .MuiPaper-elevation1' : {
      boxShadow : '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)' 
    },
  },
  heading: {
    fontSize: theme.typography.pxToRem(15),
    // flexBasis: '33.33%',
    fontWeight: 600,
    flexShrink: 0,
  },
  secondaryHeading: {
    fontSize: theme.typography.pxToRem(15),
    color: theme.palette.text.secondary,
  },
}));

export default function Faq() {
  const classes = useStyles();
  const [faq, setFaq] = useState([]);
  const [expanded, setExpanded] = useState(false);
  const [loader, setLoader] = useState(true);

  const handleChange = (panel) => (event, isExpanded) => {
    setExpanded(isExpanded ? panel : false);
  };
  useEffect(() => {
    axios.get("api/home/faq").then((res) => {
      if (res.data.status == "success") {
        setFaq(res.data.data);
        setLoader(false);
      } else {
        setFaq(faqData);
        setLoader(false);
      }
    });
  }, []);
  return (
    <div className="relative py-8 md:py-14">
            <div className="container mx-auto">
              <div className="px-3 sm:px-6 lg:px-8 ">

          <HelmetMetaData />
          {loader ?  
                <LoaderSpinner /> :
          <div className="d-flex justify-content-center faq">
            <div className="w-100">
              
              <SectionTitle lower="Frequently asked Questions" align="left"/>

              <div className={classes.root}>
                {faq.map((item, ind) => (
                  <div key={ind}>
                    <h3>{item.name}</h3>
                    {item.category_data &&
                      item.category_data.map((dat) => (
                        <Accordion
                          key={dat.id}
                          expanded={expanded === `panel${dat.id}`}
                          onChange={handleChange(`panel${dat.id}`)}
                        >
                          <AccordionSummary
                            expandIcon={<ExpandMoreIcon />}
                            aria-controls={`panel${dat.id}bh-content`}
                            id={`panel${dat.id}bh-header`}
                          >
                            <Typography className={classes.heading}>
                              {dat.question}
                            </Typography>
                          </AccordionSummary>
                          <AccordionDetails>
                            <Typography>
                              {ReactHtmlParser(dat.answer)}
                            </Typography>
                          </AccordionDetails>
                        </Accordion>
                      ))}
                  </div>
                ))}
              </div>
            </div>
          </div>
        }
        </div>
       </div>
    </div>
  );
}
