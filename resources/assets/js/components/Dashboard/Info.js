import React, { Component } from "react";
import styled from "styled-components";

class Info extends Component {
  render() {
    const {
      icon,
      totalcount,
      totalper,
      name,
      color,
      sub_data,
    } = this.props.info;
    // console.log("info:", this.props.info);
    let iconclass = "icon-";
    iconclass += icon;
    // const widthColor = styled.div`
    //   &::before {
    //     content: "";
    //     width: '${totalper}%';
    //   }
    // `;

    let colorclass = "width ";
    colorclass += color;
    return (
      // <div className="col-md-4">
      //   <div className="panel-widget">
      //     <div className="b-meta">
      //       <i className={iconclass} />
      //       <div className="info-meta">
      //         <h4>{totalcount}</h4>
      //         <p>{totalper}%</p>
      //         <span>{name}</span>
      //       </div>
      //       <span className={colorclass} />
      //     </div>
      //   </div>
      // </div>
      <div className="col-md-4">
        <div className="panel-widget">
          <div className="b-meta">
            <i className={iconclass} />
            <div className="info-meta">
              <h4>{name}</h4>
              {sub_data.length > 0
                ? sub_data.map((dat, ind) => (
                    <div
                      key={ind}
                      className="d-flex justify-content-between"
                      style={{ padding: ".25rem", fontSize: "1.1rem" }}
                    >
                      <span>{dat.title}:</span>
                      <span>{dat.count}</span>
                    </div>
                  ))
                : ""}
            </div>
            <span className={colorclass} />
          </div>
        </div>
      </div>
    );
  }
}

export default Info;
