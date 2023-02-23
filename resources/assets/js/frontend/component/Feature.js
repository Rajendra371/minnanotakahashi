import React from 'react'

export default function Feature(props) {
    const { subtitle, title, imgUrl } = props.feature;
    return (
        <div className="col-lg-3 col-md-6 col-12 mb-30">
            <div className="feature feature-shipping">
                <div className="feature-wrap">
                    <div className="icon"><img src={`../../../../../public/images/frontend/icons/${imgUrl}.png`} alt="Feature"/></div>
                    <div className="feature-text">
                         <h4>{title}</h4>
                        <p>{subtitle}</p>
                     </div>
                </div>
            </div>
        </div>
    )
}
