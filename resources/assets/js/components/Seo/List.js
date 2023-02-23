import React, { Component } from "react";
import { Link, Route } from "react-router-dom";

export default class List extends Component {
  constructor() {
    load_datepicker();
    setTimeout(function() {
      load_table_data();
    }, 1000);
    super();
    this.state = {
      seo: [],
      seo_page: [],
      data: [],
      loading: false,
      pages: 0,
    };
  }
  componentDidMount() {
    axios.get(constvar.api_url + "seo").then((response) => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({ seo_page: response.data.data["seo_page"] });
      } else {
        this.setState({ seo_page: "" });
      }
    });
  }

  post(url, params = {}) {
    return axios.post(url, params);
  }

  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <Row>
            <Col>
              <Card>
                <CardHeader>
                  <CardTitle>SEO List</CardTitle>
                  <button className="btnRefresh" id="btnRefresh">
                    <i className="fa fa-refresh" aria-hidden="true" />
                  </button>

                  {/* <Button color="danger" onClick={this.toggle}>Model</Button> */}
                </CardHeader>
                <div className="search_box" style={{ border: "none" }}>
                  <Form className="form">
                    <div className="row">
                      <Col md="4" sm="6" xs="6">
                        <Label>Search</Label>
                        <div id="searchBypage">
                          <Label>SEO Page:</Label>
                          <Input
                            type="select"
                            name="seo_page"
                            id="seo_page"
                            className="mb-2"
                          >
                            <option value="">-- All --</option>
                            {this.state.seo_page.length > 0
                              ? this.state.seo_page.map((datas) => {
                                  return (
                                    <option key={datas.id} value={datas.id}>
                                      {datas.page_name}
                                    </option>
                                  );
                                })
                              : ""}
                          </Input>
                        </div>
                      </Col>
                      {/* <div className="col-md-2">
                                    <a
                                    href="javascript:void(0)"
                                    className="btn btn-info main-btn mt-24"
                                    id="searchByDate"
                                    ><i className="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;
                                    Search
                                    </a>
                                </div> */}
                    </div>
                  </Form>
                </div>
                <table
                  id="myTable"
                  className="table table-striped table-responsive"
                >
                  <thead>
                    <tr>
                      <th width="5%">S.No.</th>
                      <th width="10%">Seo Page</th>
                      <th width="10%">SEO Title</th>
                      <th width="10%">SEO Meta Keyword</th>
                      <th width="20%">SEO Meta Description</th>
                      <th width="10%">Schema1</th>
                      <th width="5%">Schema2</th>
                      <th width="5%">Action</th>
                    </tr>
                  </thead>
                  <tbody />
                </table>
              </Card>
            </Col>
          </Row>
        </div>
      </div>
    );
  }
}

function load_table_data() {
  var seo_page = $("#seo_page").val();

  var dataurl = constvar.api_url + "seo/seo_list";
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";
  var dtablelist = $("#myTable")
    .dataTable({
      sPaginationType: "full_numbers",
      bSearchable: false,
      lengthMenu: [
        [15, 30, 45, 60, 100, 200, 500, -1],
        [15, 30, 45, 60, 100, 200, 500, "All"],
      ],

      iDisplayLength: 10,
      sDom: "ltipr",
      bAutoWidth: false,
      autoWidth: true,
      aaSorting: [[0, "desc"]],
      bProcessing: true,
      bServerSide: true,
      sAjaxSource: dataurl,

      fnServerData: function(sSource, aoData, fnCallback) {
        $.ajax({
          dataType: "json",
          type: "GET",
          headers: {
            Authorization: "Bearer" + localStorage.getItem("backend-jwt-token"),
          },
          url: sSource,
          data: aoData,
          success: fnCallback,
        });
      },
      oLanguage: {
        sEmptyTable: message,
      },
      aoColumnDefs: [
        {
          bSortable: false,
          aTargets: [0],
        },
      ],

      aoColumns: [
        { data: null },
        { data: "seo_pageid" },
        { data: "seo_title" },
        { data: "seo_metakeyword" },
        { data: "seo_metadescription" },
        { data: "schema1" },
        { data: "schema2" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        aoData.push({ name: "seo_page", value: seo_page });

        // aoData.push({ name: "toDate", value: toDate });
      },

      fnRowCallback: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
        return nRow;
      },

      fnCreatedRow: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        var tblid = oSettings._iDisplayStart + iDisplayIndex + 1;
        $(nRow).attr("id", "listid_" + tblid);
      },
    })

    .columnFilter({
      sPlaceHolder: "head:after",
      aoColumns: [
        { type: null },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: null },
      ],
    });

  $(document).off("change", "#searchBypage");
  $(document).on("change", "#searchBypage", function() {
    seo_page = $("#seo_page").val();

    dtablelist.fnDraw();
  });
}
