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
    let url = constvar.api_url + "department/get_table_data";
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
  refreshTable(e) {
    let url = constvar.api_url + "department/get_table_data";
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
    let url = constvar.api_url + "department/get_table_data";
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
                    Department List 
                  </CardTitle>
                  <button
                    className="btnRefresh"
                    id="btnRefresh"
                    onClick={this.refreshTable}
                  >
                    <i className="fa fa-refresh" aria-hidden="true" />
                  </button>
                  {/* <Button color="danger" onClick={this.toggle}>Model</Button> */}
                </CardHeader>
                <CardBody>
                  <ReactTable
                    data={data}
                    pages={this.state.pages}
                    columns={[
                      {
                        Header: "Parent Department" ,
                        accessor: "parent_depname",
                      },
                      {
                        Header: "Department",
                        accessor: "depname",
                      },
                      {
                        Header: "Department Code",
                        accessor: "depcode",
                      },
                      {
                        Header: "Group Location",
                        accessor: "locname",
                      },
                      {
                        Header: "Is Active",
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
                              data-url={
                                constvar.api_url + "department/edit"
                              }
                              data-id={row.value}
                              data-targetform="department_setupForm"
                            >
                              <i className="fa fa-edit" />
                            </a>{" "}
                            &nbsp;
                            <a
                              href="javascript:void(0)"
                              className="btnDelete"
                              data-url={
                                constvar.api_url + "department/delete"
                              }
                              data-id={row.value}
                            >
                              <i className="fa fa-trash" />
                            </a>
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
