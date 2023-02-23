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
            pages: 0
        };
    }

    getListData(page, pageSize, sorted, filtered, handleRetrievedData) {
        let url = constvar.api_url + "location/getTableData";
        let postObject = {
            page: page,
            pageSize: pageSize,
            sorted: sorted,
            filtered: filtered
        };

        return this.post(url, postObject)
            .then(response => handleRetrievedData(response))
            .catch(response => console.log(response));
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
                                    <CardTitle> <FormattedMessage id="location.list" /></CardTitle>
                                    {/* <Button color="danger" onClick={this.toggle}>Model</Button> */}
                                </CardHeader>
                                <CardBody>
                                    <ReactTable
                                        data={data}
                                        pages={this.state.pages}
                                        columns={[
                                            {
                                                Header: <FormattedMessage id="location.id" />,
                                                accessor: "id"
                                            },
                                            
                                            {
                                                Header: <FormattedMessage id="location.parent" />,
                                                accessor: "parentloc_id"
                                            },
                                            {
                                                Header:  <FormattedMessage id="location.name" />,
                                                accessor: "locname"
                                            },
                                            {
                                                Header:  <FormattedMessage id="common.action" />,
                                                filterable: false,
                                                sortable: false,
                                                accessor: "id",
                                                Cell: row => (
                                                    <div>
                                                        <a
                                                            href="javascript:void(0)"
                                                            className="btnEdit"
                                                            data-url={
                                                                constvar.api_url +
                                                                "location/edit"
                                                            }
                                                            data-id={row.value}
                                                            data-targetform="locationForm"
                                                        >
                                                            <i className="fa fa-edit" />
                                                        </a>{" "}
                                                        &nbsp;
                                                        <a
                                                            href="javascript:void(0)"
                                                            className="btnDelete"
                                                            data-url={
                                                                constvar.api_url +
                                                                "location/delete"
                                                            }
                                                            data-id={row.value}
                                                        >
                                                            <i className="fa fa-trash" />
                                                        </a>
                                                        &nbsp;
                                                        <a
                                                            href="javascript:void(0)"
                                                            className="view"
                                                            data-url={
                                                                constvar.api_url +
                                                                "location/view"
                                                            }
                                                            data-id={row.value}
                                                        >
                                                            <i className="fa fa-eye" />
                                                        </a>
                                                    </div>
                                                )
                                            }
                                        ]}
                                        defaultPageSize={10}
                                        className="-striped -highlight"
                                        loading={this.state.loading}
                                        showPagination={true}
                                        showPaginationTop={false}
                                        showPaginationBottom={true}
                                        pageSizeOptions={[
                                            5,
                                            10,
                                            20,
                                            25,
                                            50,
                                            100
                                        ]}
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
                                                res => {
                                                    console.log(
                                                        "r" +
                                                        res.data.rows
                                                            .displaytext
                                                    );

                                                    this.setState({
                                                        data: res.data.rows,
                                                        pages: res.data.pages,
                                                        loading: false
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
