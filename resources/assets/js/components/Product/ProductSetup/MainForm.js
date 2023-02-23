import React, { Component } from "react";
import axios from "axios";
import Select from "react-select";
import Dropzone from "react-dropzone";
// import Input from "react-select/src/components/input";

class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      parent_id: [],
      parentcat: [],
      color: [],
      style: [],
      quality: [],
      material: [],
      collection: [],
      brand: [],
      shape: [],
      waves: [],
      pattern: [],
      unit: [],
      files: [],
      imgSrc: [],
      branch: [],
      product_id: "",
      rowList: [
        {
          length: "",
          breadth: "",
          unit: "",
        },
      ],
      showing: false,
    };
    load_ckeditor();
    load_datepicker();
    load_select2();
  }
  addNewTableRow = () => {
    let list = [...this.state.rowList, { length: "", breadth: "", unit: "" }];
    this.setState({ rowList: list });
  };
  handleRemoveClick = (index) => {
    const list = [...this.state.rowList];
    list.splice(index, 1);
    this.setState({ rowList: list });
  };
  handleInputChange = (e, i) => {
    let { name, value } = e.target;
    name = name.replace("[]", "");
    const list = [...this.state.rowList];
    list[i][name] = value;
    this.setState({ rowList: list });
  };

  componentDidMount() {
    axios
      .get(constvar.api_url + "product_setup/get_parentcat")
      .then((response) => {
        if (response.data.status == "success") {
          this.setState({ parentcat: response.data.data });
        } else {
          this.setState({ parentcat: "" });
        }
      });
    axios.get(constvar.api_url + "product_setup").then((response) => {
      if (response.data.status == "success") {
        this.setState({ style: response.data.data["style"] });
        this.setState({ quality: response.data.data["quality"] });
        this.setState({ color: response.data.data["color"] });
        this.setState({ material: response.data.data["material"] });
        this.setState({ collection: response.data.data["collection"] });
        this.setState({ brand: response.data.data["brand"] });
        this.setState({ shape: response.data.data["shape"] });
        this.setState({ waves: response.data.data["waves"] });
        this.setState({ pattern: response.data.data["pattern"] });
        this.setState({ unit: response.data.data["unit"] });
        this.setState({ branch: response.data.data["branch"] });
        this.setState({ product_id: response.data.data["product_id"] });
      }
    });
  }

  onDrop = (acceptedFiles) => {
    acceptedFiles.map((file) => {
      this.setState({ files: [...this.state.files, file] });
      /* Using objectURL method: takes an object (like file below)
      and creates a temporary local URL that is tied to the document in which it is created */
      this.setState({
        imgSrc: [...this.state.imgSrc, URL.createObjectURL(file)],
      });
    });
    console.log(this.state.files);
  };

  handleSubmit = (e) => {
    e.preventDefault();
    var formid = "productsetForm";
    var data = new FormData($("form#productsetForm")[0]);
    this.state.files.map((file) => {
      data.append("attachment[]", file);
    });
    $("textarea").each(function() {
      var $this = $(this);
      var cls = this.className;
      var id = this.id;
      var name = this.name;
      var ckd_string = "ckeditor";
      if (cls.indexOf(ckd_string) != -1) {
        var content = CKEDITOR.instances[id].getData();
        data.append(name, content);
      }
    });
    axios
      .post(constvar.api_url + "product_setup/store", data)
      .then((response) => {
        if (response.data.status == "success") {
          $("#" + formid)
            .find(".success")
            .html(response.data.message);
          $("#" + formid)
            .find(".success")
            .addClass("alert");
          $("#" + formid + " .btnreset").click();
          $("textarea").each(function() {
            var $this = $(this);
            var cls = this.className;
            var id = this.id;
            var name = this.name;
            var ckd_string = "ckeditor";
            if (cls.indexOf(ckd_string) != -1) {
              var content = CKEDITOR.instances[id].setData("");
              data.append(name, content);
            }
          });
          this.setState({ files: [] });
          this.setState({ imgSrc: [] });
          $("#btnRefresh").click();
        } else if (
          response.data.status == "error" &&
          response.data.permission == "no"
        ) {
          $("#" + formid)
            .find(".error")
            .html(response.data.message);
          $("#" + formid)
            .find(".error")
            .addClass("alert");
        } else {
          var msg = response.data.message;
          var errmsg = "<ul style='list-style:none'>";
          $.each(msg, function(key, value) {
            errmsg += "<li>" + value + "</li>";
          });
          errmsg += "</ul>";
          $("#" + formid)
            .find(".error")
            .html(errmsg);
          $("#" + formid)
            .find(".error")
            .addClass("alert");
        }
        setTimeout(function() {
          $("#" + formid)
            .find(".success")
            .html("");
          $("#" + formid)
            .find(".success")
            .removeClass("alert");
          $("#" + formid)
            .find(".error")
            .html("");
          $("#" + formid)
            .find(".error")
            .removeClass("alert");
        }, 3000);
      })
      .catch((error) => {
        console.log(error);
      });
  };

  render() {
    const maxSize = 5242880;
    const { letterSelectedOption } = this.state;
    const { sectionSelectedOption } = this.state;
    const { fiscalSelectedOption } = this.state;

    const images = this.state.imgSrc.map((img, index) => (
      <li key={index}>
        <img src={img} height="150px" width="150px" />
      </li>
    ));
    const files = this.state.files.map((file, index) => (
      <li key={index} id={"att" + index}>
        {file.name} - {file.size} bytes
      </li>
    ));

    const dropzone_style = {
      height: "70px",
      width: "100%",
      border: "4px dashed rgb(28 215 199)",
      padding: "1rem",
      textAlign: "center",
    };
    const { showing } = this.state;
    const addStyle = {
      position: "absolute",
      zIndex: "9",
      top: "15px",
      right: "15px",
    };
    return (
      <div>
        <Row>
          <Col>
            <div className="clearfix product_add col-12">
              <div className="float-right">
                <Button
                  style={showing ? addStyle : {}}
                  size="md"
                  color={showing ? "danger" : "primary"}
                  onClick={() => this.setState({ showing: !showing })}
                  id={`btn-prod-${showing ? "remove" : "add"}`}
                >
                  <i className={`fa fa-${showing ? "trash" : "plus"}`} />{" "}
                  {showing ? "Remove" : "Add Product"}
                </Button>
              </div>
            </div>
            <Card style={{ display: showing ? "block" : "none" }}>
              <CardHeader>
                <CardTitle className="">Product Setup Form</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="productsetForm"
                  encType="multipart/form-data"
                  action={constvar.api_url + "product_setup/store"}
                  onSubmit={this.handleSubmit}
                >
                  <FormGroup row>
                    <Input type="hidden" name="id" defaultValue="" />
                    <Col md="3" sm="6" xs="6">
                      <Label>
                        {" "}
                        Category<code>*</code>:{" "}
                      </Label>
                      <div
                        dangerouslySetInnerHTML={{
                          __html: this.state.parentcat,
                        }}
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>
                        Product ID<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="product_id"
                        placeholder="Product ID"
                        className="required_field"
                        defaultValue={this.state.product_id}
                        readOnly
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>
                        Product Title<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="product_title"
                        placeholder="Product Title"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>
                        Product Code<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="product_code"
                        placeholder="Product Code"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Branch</Label>
                      <Input type="select" name="branch_id" id="branch_id">
                        {this.state.branch.length > 0
                          ? this.state.branch.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.branch_name}{" "}
                                  {datas.is_main == "Y" ? "(Main Branch)" : ""}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Color</Label>
                      <Input
                        type="select"
                        name="color_id[]"
                        className="select2"
                        id="color_id"
                        multiple
                      >
                        {this.state.color.length > 0
                          ? this.state.color.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.color_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Material</Label>
                      <Input
                        type="select"
                        name="material_id[]"
                        className="select2"
                        id="material_id"
                        multiple
                      >
                        {this.state.material.length > 0
                          ? this.state.material.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.material_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Quality</Label>
                      <Input
                        type="select"
                        name="quality_id[]"
                        className="select2"
                        id="quality_id"
                        multiple
                      >
                        {this.state.quality.length > 0
                          ? this.state.quality.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.quality_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Style</Label>
                      <Input
                        type="select"
                        name="style_id[]"
                        className="select2"
                        id="style_id"
                        multiple
                      >
                        {this.state.style.length > 0
                          ? this.state.style.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.style_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Collection</Label>
                      <Input
                        type="select"
                        name="collection_id[]"
                        className="select2"
                        id="collection_id"
                        multiple
                      >
                        {this.state.collection.length > 0
                          ? this.state.collection.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.collection_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Brand</Label>
                      <Input
                        type="select"
                        name="brand_id[]"
                        className="select2"
                        id="brand_id"
                        multiple
                      >
                        {this.state.brand.length > 0
                          ? this.state.brand.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.brand_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Shape</Label>
                      <Input
                        type="select"
                        name="shape_id[]"
                        className="select2"
                        id="shape_id"
                        multiple
                      >
                        {this.state.shape.length > 0
                          ? this.state.shape.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.shape_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Waves</Label>
                      <Input
                        type="select"
                        name="waves_id[]"
                        id="waves_id"
                        className="select2"
                        multiple
                      >
                        {this.state.waves.length > 0
                          ? this.state.waves.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.waves_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Pattern</Label>
                      <Input
                        type="select"
                        name="pattern_id[]"
                        id="pattern_id"
                        className="select2"
                        multiple
                      >
                        {this.state.pattern.length > 0
                          ? this.state.pattern.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.pattern_name}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                    <Col md="3" sm="6" xs="6">
                      <div>
                        <Label>Is Warrenty?:</Label>
                        <Input
                          type="select"
                          name="is_warrenty"
                          id="is_warrenty"
                        >
                          <option value="N">No</option>
                          <option value="Y">Yes</option>
                        </Input>
                      </div>
                    </Col>

                    <Col
                      md="3"
                      sm="6"
                      xs="6"
                      className="warrenty"
                      style={{ display: "none" }}
                    >
                      <Label>Warrenty Upto:</Label>
                      <Input
                        type="text"
                        name="warrenty_upto"
                        id="warrenty_upto"
                        placeholder=""
                        className="required_field datepicker"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="6" sm="12" xs="12">
                      <Label>Dimensions:</Label>

                      <FormGroup className="input-custom">
                        <div className=" dimensions-table">
                          <Table className="table-borderless table-striped w-100 mb-0">
                            <thead>
                              <tr>
                                <th width="5%">S.N.</th>
                                <th width="25%">Length</th>
                                <th width="25%">Breadth</th>
                                <th width="20%">Unit</th>
                                <th width="5%">Action</th>
                                <th style={{ borderColor: "#fff" }}>
                                  <button
                                    type="button"
                                    onClick={this.addNewTableRow}
                                    className="small btn btn-primary"
                                  >
                                    +
                                  </button>
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              {this.state.rowList.map((f, i) => (
                                <tr key={i}>
                                  <th scope="row">{i + 1}</th>

                                  <td>
                                    <Input
                                      type="number"
                                      name="length[]"
                                      value={f.length}
                                      id=""
                                      className="length"
                                      placeholder="Length"
                                      onChange={(e) =>
                                        this.handleInputChange(e, i)
                                      }
                                    />
                                  </td>
                                  <td>
                                    <Input
                                      type="number"
                                      name="breadth[]"
                                      id=""
                                      value={f.breadth}
                                      className="breadth"
                                      placeholder="Breadth"
                                      onChange={(e) =>
                                        this.handleInputChange(e, i)
                                      }
                                    />
                                  </td>
                                  <td>
                                    <Input
                                      type="select"
                                      name="unit[]"
                                      value={f.unit}
                                      className=""
                                      onChange={(e) =>
                                        this.handleInputChange(e, i)
                                      }
                                    >
                                      {this.state.unit.length > 0
                                        ? this.state.unit.map((cl) => (
                                            <option
                                              value={cl.unit_slug}
                                              key={cl.id}
                                            >
                                              {cl.unit_name}
                                            </option>
                                          ))
                                        : ""}
                                    </Input>
                                  </td>

                                  <td>
                                    {this.state.rowList.length !== 1 && (
                                      <button
                                        type="button"
                                        className="btn btn-danger small"
                                        onClick={() =>
                                          this.handleRemoveClick(i)
                                        }
                                      >
                                        <i className="fa fa-trash" />
                                      </button>
                                    )}
                                  </td>
                                </tr>
                              ))}
                            </tbody>
                          </Table>
                        </div>
                      </FormGroup>
                    </Col>

                    <Col md="12" sm="12" xs="12">
                      <Dropzone
                        onDrop={this.onDrop}
                        multiple
                        accept="image/png, image/gif, image/jpeg, image/jpg"
                        minSize={0}
                        maxSize={maxSize}
                      >
                        {({
                          getRootProps,
                          getInputProps,
                          isDragActive,
                          isDragReject,
                          rejectedFiles,
                        }) => {
                          // const isFileTooLarge = rejectedFiles.length > 0 &&
                          // rejectedFiles[0].size > maxSize;
                          return (
                            <section>
                              <div className="row ">
                                <div
                                  {...getRootProps({
                                    className: "dropzone col-md-6",
                                  })}
                                >
                                  <input {...getInputProps()} />
                                  <p className="mb-0" style={dropzone_style}>
                                    {!isDragActive &&
                                      "Click here or drop a file to upload! "}
                                    {isDragActive &&
                                      !isDragReject &&
                                      "Drop the file to upload!"}
                                    {isDragReject &&
                                      "File type not accepted, sorry!"}
                                    {/* {isFileTooLarge && (
    <span className="text-danger pl-1">
    File is too large.
    </span>
    )} */}
                                  </p>
                                </div>
                                <aside className="col-md-6">
                                  <div className="row">
                                    <div className="col-sm-4">
                                      <label>
                                        <strong>Files</strong>
                                      </label>
                                      <ul
                                        style={{
                                          listStyleType: "none",
                                          paddingLeft: "5px",
                                        }}
                                      >
                                        {files}
                                      </ul>
                                    </div>
                                    <div className="col-sm-8 d-flex">
                                      <label>
                                        <strong>Preview</strong>
                                      </label>
                                      <ul
                                        style={{
                                          listStyleType: "none",
                                          paddingLeft: "5px",
                                          float: "right",
                                          marginLeft: "marginLeft.5rem",
                                        }}
                                      >
                                        {images}
                                      </ul>
                                    </div>
                                  </div>
                                </aside>
                              </div>
                            </section>
                          );
                        }}
                      </Dropzone>
                    </Col>

                    <Col md="12">
                      <Label>
                        Product Description<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="product_description"
                        placeholder="Product Description"
                        className="ckeditor"
                        id="product_description"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>
                        Expire Date<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="expdatead"
                        placeholder="YYYY-MM-DD"
                        className="required_field datepicker"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>
                        Price<code>*</code>:
                      </Label>
                      <Input
                        type="text"
                        name="price"
                        id="price"
                        placeholder="Enter Price Here"
                        className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Discount:</Label>
                      <Input
                        type="number"
                        name="discount_pc"
                        id="dis_percent"
                        // placeholder="Enter Price Here"
                        className="calamt"
                        defaultValue="0"
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Discounted Price:</Label>
                      <Input
                        type="number"
                        name="discount_amount"
                        id="dis_amt"
                        // placeholder="Enter Price Here"
                        // className=""
                        defaultValue="0"
                      />
                    </Col>

                    <Col md="12">
                      <Label>
                        FAQ Description<code>*</code>:
                      </Label>
                      <Input
                        type="textarea"
                        name="faq_description"
                        placeholder="Enter FAQ Description"
                        className="ckeditor"
                        id="faq_description"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Meta Title:</Label>
                      <Input
                        type="text"
                        name="meta_title"
                        placeholder="Enter Meta Title"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Meta Keyword:</Label>
                      <Input
                        type="text"
                        name="meta_keyword"
                        placeholder="Enter Meta Keyword Here"
                        //   className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Meta Description:</Label>
                      <Input
                        type="text"
                        name="meta_description"
                        placeholder="Enter Meta description Here"
                        //   className="required_field"
                        defaultValue=""
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <Label>Order:</Label>
                      <Input
                        type="number"
                        name="order"
                        placeholder="Order"
                        className=""
                        defaultValue=""
                      />
                    </Col>

                    <Col md="3" sm="6" xs="6">
                      <div className="checkbox align-self-end">
                        <Input
                          type="checkbox"
                          id="is_publish"
                          name="is_publish"
                          value="Y"
                        />
                        <Label for="is_publish" />
                        <FormattedMessage id="Is Publish" />
                      </div>
                    </Col>
                  </FormGroup>

                  <CardFooter>
                    <div className="clearfix">
                      <div className="float-right">
                        <Button
                          type="submit"
                          size="md"
                          color="primary"
                          className=""
                        >
                          <i className="fa fa-dot-circle-o" /> Save
                        </Button>{" "}
                        &nbsp;&nbsp;&nbsp;
                        <Button
                          type="button"
                          size="md"
                          color="danger"
                          className="btnreset"
                        >
                          <i className="fa fa-ban" /> Reset
                        </Button>
                      </div>
                    </div>

                    <div className="alert-success success" />
                    <div className="alert-danger error" />
                  </CardFooter>
                </Form>
              </CardBody>
            </Card>
          </Col>
        </Row>
      </div>
    );
  }
}
export default MainForm;
<script src="./path/to/dropzone.js" />;

$(document).off("keyup change", ".calamt");
$(document).on("keyup change", ".calamt", function() {
  var rate = $("#price").val();
  var discount = $("#dis_percent").val();

  var disamt = 0;
  var amt = 0;

  if (discount == "" || discount == "NaN") {
    amt = 0;
  } else {
    disamt = rate * (discount / 100);
    amt = rate - disamt;
  }

  $("#dis_amt").val(amt.toFixed(2));
});

$(document).off("change", "#is_warrenty");
$(document).on("change", "#is_warrenty", function(e) {
  var ftype = $(this).val();
  // alert(ftype);
  if (ftype == "Y") {
    // alert("test");
    $(".warrenty").show();
  } else {
    $(".warrenty").hide();
  }
});
$(document).off("click", "#open_product_div");
$(document).on("click", "#open_product_div", function(e) {
  $("#btn-prod-add").click();
  window.scrollTo(0, 0);
});
