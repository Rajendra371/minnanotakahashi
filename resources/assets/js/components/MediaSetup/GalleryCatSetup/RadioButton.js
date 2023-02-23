import React from "react";

const RadioButton = props => {
  return (
    <div>
      <Input
        id={props.id}
        onChange={props.onChange}
        value={props.value}
        type="radio"
        name="media_type"
        checked={props.isSelected}
      />
      <Label for={props.id}>{props.label}</Label>
    </div>
  );
};

export default RadioButton;
