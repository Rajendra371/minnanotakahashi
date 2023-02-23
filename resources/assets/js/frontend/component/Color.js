import React, { useState } from "react";

export default function Color({ color, setColor }) {
  return (
    <div>
      <input
        onChange={(e) => setColor(e.target.value)}
        className="hiddenradio"
        type="radio"
        id={color}
        name="selectColor"
        value={color}
      />

      <a style={{ backgroundColor: color }} />
    </div>
  );
}
