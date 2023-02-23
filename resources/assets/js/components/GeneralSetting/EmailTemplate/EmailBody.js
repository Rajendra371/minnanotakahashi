import React, { Component } from "react";

class EmailBody extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    load_ckeditor();
    const { template_code, subject, body, constant, id } = this.props.tab;
    return (
      <div>
        <Form
          className="form-horizontal"
          id={`form_${template_code}`}
          action={constvar.api_url + "email_template/store"}
        >
          <FormGroup row>
            <Col md="6" xs="6">
              <Label>
                <FormattedMessage id="email_template.subject" />
                <code>*</code>:
              </Label>

              <Input type="hidden" name="id" defaultValue={id} />
              <Input
                type="hidden"
                name="template_code"
                defaultValue={template_code}
              />
              <Input
                type="text"
                name="subject"
                placeholder={subject}
                className="required_field"
                defaultValue={subject}
              />
            </Col>

            <Col md="6" xs="6">
              <Label>Constants:</Label>

              <Input
                type="text"
                name="constant"
                className=""
                defaultValue={constant}
              />
            </Col>
          </FormGroup>
          <FormGroup row style={{ marginTop: "2rem" }}>
            <Col md="12" xs="12">
              <Label>
                <FormattedMessage id="email_template.body" />
                <code>*</code>:
              </Label>
              <Input
                type="textarea"
                name="body"
                id={`text_${template_code}`}
                defaultValue={body}
                className="ckeditor"
                rows="15"
              />
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
                {/* <Button
                  type="button"
                  size="md"
                  color="danger"
                  className="btnreset"
                >
                  <i className="fa fa-ban" />{" "}
                  <FormattedMessage id="button.reset" />
                </Button> */}
              </div>
            </div>
            <div className="alert-success success" />
            <div className="alert-danger error" />
          </CardFooter>
        </Form>
      </div>
    );
  }
}

export default EmailBody;
