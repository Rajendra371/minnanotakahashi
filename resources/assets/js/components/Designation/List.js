import React, { Component } from "react";

// Import React Table
import ReactTable from "react-table";
import "react-table/react-table.css";

export default class List extends Component {
  constructor() {
    super();
    this.state = {
      //    data: this.props.data,
      data: [],

      loading: false,
      pages: 0,
    };
    this.refreshTable = this.refreshTable.bind(this);
  }
  refreshTable(e) {
    let url = constvar.api_url + "designation/get_table_data";
    let postObject = {
      page: 0,
      pageSize: 10,
      sorted: [],
      filtered: [],
    };

    var refreshData = this.post(url, postObject).then((result) =>
      this.setState({
        data: result.data.rows,
      })
    );
  }

  getListData(page, pageSize, sorted, filtered, handleRetrievedData) {
    let url = constvar.api_url + "designation/get_table_data";
    let postObject = {
      page: page,
      pageSize: pageSize,
      sorted: sorted,
      filtered: filtered,
    };

    return this.post(url, postObject)
      .then((response) => handleRetrievedData(response))
      .catch((response) => console.log(response));
  }

  post(url, params = {}) {
    return axios.post(url, params);
  }

  render() {
    const { data } = this.state;
    return (
      <div>
        <div className="animated fadeIn">
          <Row>
            <Col>
              <Card>
                <CardHeader>
                  <CardTitle>
                    Designation List
                    <button
                      className="btnRefresh"
                      id="btnRefresh"
                      onClick={this.refreshTable}
                    >
                      <i className="fa fa-refresh" aria-hidden="true" />
                    </button>
                  </CardTitle>
                </CardHeader>
                <CardBody>
                  <ReactTable
                    data={data}
                    pages={this.state.pages}
                    columns={[
                      {
                        Header: "Designation Code",
                        accessor: "designation_code",
                      },
                      {
                        Header: "Designation Name",
                        accessor: "designation_name",
                      },
                      // {
                      //   Header: "Basic Salary",
                      //   accessor: "basic_salary",
                      // },
                      {
                        Header: "Grade Rate",
                        accessor: "grade_rate",
                      },
                      {
                        Header: "Hourly Rate",
                        accessor: "hourly_rate",
                      },
                      {
                        Header: "Is active",
                        accessor: "isactive",
                      },

                      {
                        Header: "Action",
                        filterable: false,
                        sortable: false,
                        accessor: "id",
                        Cell: (row) => (
                          <div>
                            <a
                              href="javascript:void(0)"
                              className="btnEdit"
                              data-url={constvar.api_url + "designation/edit"}
                              data-id={row.value}
                              data-targetform="designationForm"
                            >
                              <i className="fa fa-edit" />
                            </a>{" "}
                            &nbsp;
                            <a
                              href="javascript:void(0)"
                              className="btnDelete"
                              data-url={constvar.api_url + "designation/delete"}
                              data-id={row.value}
                            >
                              <i className="fa fa-trash" />
                            </a>
                            &nbsp;
                          </div>
                        ),
                      },
                    ]}
                    defaultPageSize={10}
                    className="-striped -highlight"
                    loading={this.state.loading}
                    showPagination={true}
                    showPaginationTop={false}
                    showPaginationBottom={true}
                    pageSizeOptions={[5, 10, 20, 25, 50, 100]}
                    minRows="undefined"
                    filterable
                    manual // this would indicate that server side pagination has been enabled
                    onFetchData={(state, instance) => {
                      this.setState({ loading: true });
                      this.getListData(
                        state.page,
                        state.pageSize,
                        state.sorted,
                        state.filtered,
                        (res) => {
                          console.log("r" + res.data.rows.displaytext);

                          this.setState({
                            data: res.data.rows,
                            pages: res.data.pages,
                            loading: false,
                          });
                        }
                      );
                    }}
                  />
                </CardBody>
              </Card>
            </Col>
          </Row>
        </div>
      </div>
    );
  }
}
