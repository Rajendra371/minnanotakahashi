import React from "react";
const AddImage = props => {
  console.log(props.number)
  return (
    
      <FormGroup row>
        
        <Col md="6" sm="6" xs="6">
          <Label>
            Image Title {props.number}
            <code>*</code>:
          </Label>
          <Input
            type="text"
            name="gly_title[]"
            placeholder="Enter Image Title"
            className=""
            defaultValue=""
          />
        </Col>
        <Col sm="6">
          <Label>
          Image Content
            <code>*</code>:
          </Label>
          <Input
            type="text"
            name="gly_content[]"
            placeholder="Enter Image Content "
          />
        </Col>

        <Col sm="12" xs="12">
          <Label>
           Image
            <code>*</code>:
          </Label>

        <div className="file-upload-wrapper mb-2" data-text="Select Image">
            <Input
              name="image_file[]"
              type="file"
              className="file-upload-field required_field "
              />
          </div>
          
        </Col>
      </FormGroup>
  
  );
};

export default AddImage;
