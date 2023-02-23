import React, { Component } from "react";
import AddImage from "./AddImage";
class MainForm extends Component {
  constructor(props) {
    super(props);
    this.state = {
      counter: 1,
      gallery_cat_name: [],
      gly_catid: [],
      gly_content: [],
      gly_title: [],
      image_path: [],
      is_display: "",
    };
    this.handleSubmit = this.handleSubmit.bind(this);
    // this.handleBodyChange = this.handleBodyChange.bind(this);
  }
  addImage = () => {
    const { counter } = this.state;
    this.setState({
      counter: counter + 1,
    });
  };

  handleFileChange(e) {
    if (e.target.files) {
      const files = Array.from(e.target.files);
      const promises = files.map((file) => {
        return new Promise((resolve, reject) => {
          const reader = new FileReader();
          reader.addEventListener("load", (ev) => {
            resolve(ev.target.result);
          });
          reader.addEventListener("error", reject);
          reader.readAsDataURL(file);
        });
      });
      Promise.all(promises).then(
        (images) => {
          this.setState({
            imageArray: images,
          });
        },
        (error) => {
          console.error(error);
        }
      );
    }
    if (this.props.onChange !== undefined) {
      this.props.onChange(e);
    }
  }
  handleSubmit(e) {
    e.preventDefault();
    // this.postData();
    const formData = new FormData();
    this.state.imageArray.forEach((image_file) => {
      formData.append("image_file[]", image_file);
    });

    formData.append("gly_content", this.state.gly_content);
    for (let pair of formData.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }

    formData.append("gly_title", this.state.gly_title);
    for (let pair of formData.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
    formData.append("gly_catid", this.state.gly_catid);
    for (let pair of formData.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
    axios.post("/posts", formData).then((response) => {
      this.setState({
        posts: [response.data],
      });
    });
    this.setState({
      body: "",
    });
  }

  componentDidMount() {
    axios.get(constvar.api_url + "gallery_setup").then((response) => {
      if (response.data.status == "success") {
        this.setState({
          gallery_cat_name: response.data.data["gallery_cat_name"],
        });
      } else {
        this.setState({ gallery_cat_name: "" });
      }
    });
  }

  render() {
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>Image Gallery</CardTitle>
              </CardHeader>
              <CardBody>
                <Form
                  className="form-horizontal"
                  id="galleryForm"
                  enctype="multipart/form-data"
                  // {"#demo + {this.state.id}"}
                  action={constvar.api_url + "gallery_setup/store"}
                >
                  <FormGroup row>
                    <Col sm="6" xs="6">
                      <Label>
                        Gallery Category
                        <code>*</code>
                      </Label>
                      <Input
                        type="select"
                        name="gly_catid"
                        defaultValue=""
                        id="gly_catid"
                      >
                        <option>-- Select Category --</option>
                        {this.state.gallery_cat_name.length > 0
                          ? this.state.gallery_cat_name.map((datas) => {
                              return (
                                <option key={datas.id} value={datas.id}>
                                  {datas.title}
                                </option>
                              );
                            })
                          : ""}
                      </Input>
                    </Col>
                    <Col sm="6" xs="6" className="align-self-end">
                      <div className="float-right">
                        <Button
                          onClick={this.addImage}
                          size="md"
                          color="primary"
                          className="add"
                        >
                          <i className="fa fa-plus" />{" "}
                          <FormattedMessage id="Add Image" />
                        </Button>
                      </div>
                    </Col>
                  </FormGroup>

                  {[...Array(this.state.counter)].map((k, i) => (
                    <AddImage key={i} number={this.state.counter} />
                  ))}
                  <FormGroup row>
                    <Col md="6" sm="6" xs="6">
                      <div className="checkbox">
                        <Input
                          type="checkbox"
                          id="is_display"
                          name="is_display"
                          value="Y"
                        />
                        <Label for="gallery@display" />
                        <FormattedMessage id="isdisplay" />
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
                          className="save"
                        >
                          <i className="fa fa-dot-circle-o" />{" "}
                          <FormattedMessage id="button.save" />
                        </Button>{" "}
                        &nbsp;&nbsp;&nbsp;
                        <Button
                          type="button"
                          size="md"
                          color="danger"
                          className="btnreset"
                        >
                          <i className="fa fa-ban" />{" "}
                          <FormattedMessage id="button.reset" />
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
