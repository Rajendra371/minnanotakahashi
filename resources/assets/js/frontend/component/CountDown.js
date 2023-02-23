import React, { useEffect, useState } from "react";

function CountDown(props) {
  const calculateTimeLeft = () => {
    let year = new Date().getFullYear();
    const difference = +new Date(props.date) - +new Date();
    let timeLeft = {};

    if (difference > 0) {
      timeLeft = {
        days: Math.floor(difference / (1000 * 60 * 60 * 24)),
        hours: Math.floor((difference / (1000 * 60 * 60)) % 24),
        minutes: Math.floor((difference / 1000 / 60) % 60),
        seconds: Math.floor((difference / 1000) % 60),
      };
    }

    return timeLeft;
  };

  const [timeLeft, setTimeLeft] = useState(calculateTimeLeft());
  const [year] = useState(new Date().getFullYear());

  useEffect(() => {
    setTimeout(() => {
      setTimeLeft(calculateTimeLeft());
    }, 1000);
  },[]);

  const timerComponents = [];

  Object.keys(timeLeft).forEach((interval) => {
    if (!timeLeft[interval]) {
      return;
    }
        {timerComponents.push(
        <span key={interval} className="cdown day">
            <span className="time-count">{timeLeft[interval]} </span> 
            <p>{interval}</p>
        </span>
        )}
  });
  return (
      <div className="countdown">
        {timerComponents.length ? timerComponents : <span>Offer's up!</span> }
      </div>
  );
}

export default CountDown;