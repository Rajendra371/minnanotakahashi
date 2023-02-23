import React, { Component } from "react";
import { Tab, TabPanel, Tabs, TabList } from "react-web-tabs";
import EmailBody from "./EmailBody";
class MainForm extends Component {
  constructor(props) {
    super(props);

    this.state = {
      templates: [],
    };
  }
  componentDidMount() {
    axios.get(constvar.api_url + "email_template/data").then((resp) => {
      if (resp.data.status == "success") {
        this.setState({ templates: resp.data.data });
      } else {
        this.setState({ templates: [] });
      }
    });
  }
  render() {
    var selectclass = "link";
    return (
      <div>
        <Row>
          <Col>
            <Card>
              <CardHeader>
                <CardTitle>
                  <FormattedMessage id="emailtemplate.management" />
                </CardTitle>
              </CardHeader>
              <CardBody>
                <div
                  className="horizontal-page"
                  style={{
                    margin: "0px -15px 15px",
                    padding: "10px 0 0",
                    backgroundColor: "#e4e5e6",
                  }}
                >
                  <Tabs
                    defaultTab={
                      this.state.templates.length > 0
                        ? this.state.templates[0].template_code
                        : ""
                    }
                  >
                    <TabList>
                      {this.state.templates.length > 0
                        ? this.state.templates.map((tab) => {
                            var urlstatus = tab.template_code;
                            if (urlstatus == true) {
                              selectclass = "link selected";
                            } else {
                              selectclass = "link";
                            }
                            return (
                              <Tab key={tab.id} tabFor={tab.template_code}>
                                {tab.subject}
                              </Tab>
                            );
                          })
                        : null}
                    </TabList>
                    {this.state.templates.length > 0
                      ? this.state.templates.map((tab) => {
                          return (
                            <TabPanel tabId={tab.template_code} key={tab.id}>
                              <EmailBody tab={tab} {...this.props} />
                            </TabPanel>
                          );
                        })
                      : null}
                  </Tabs>
                </div>
              </CardBody>
            </Card>
          </Col>
        </Row>
      </div>
    );
  }
}
export default MainForm;
