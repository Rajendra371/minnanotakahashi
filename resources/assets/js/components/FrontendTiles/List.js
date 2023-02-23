import React, { Component } from "react";

export default class List extends Component {
  constructor() {
    load_datepicker();
    setTimeout(function() {
      load_table_data();
    }, 1000);
    super();
    this.state = {
      seo: [],
      data: [],
      loading: false,
      pages: 0,
    };
  }

  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <Row>
            <Col>
              <Card>
                <CardHeader>
                  <CardTitle>Frontend Tiles</CardTitle>
                  <button className="btnRefresh" id="btnRefresh">
                    <i className="fa fa-refresh" aria-hidden="true" />
                  </button>
                </CardHeader>

                <table
                  id="frontendTilesTable"
                  className="table table-striped table-responsive"
                >
                  <thead>
                    <tr>
                      <th width="5%">S.No.</th>
                      <th width="20%">Title</th>
                      <th width="10%">Image</th>
                      <th width="10%">Icon</th>
                      <th width="10%">Content</th>
                      <th width="10%">Is Publish?</th>
                      <th width="10%">For Header?</th>
                      <th width="10%">For Body?</th>
                      <th width="10%">For Footer?</th>
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
  var dataurl = constvar.api_url + "frontend_tiles/list";
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";
  var dtablelist = $("#frontendTilesTable")
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
          aTargets: [0, 2, 5, 6, 7, 8, 9],
        },
      ],

      aoColumns: [
        { data: null },
        { data: "title" },
        { data: "image" },
        { data: "icon" },
        { data: "content" },
        { data: "is_publish" },
        { data: "for_header" },
        { data: "for_body" },
        { data: "for_footer" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {},

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
        { type: null },
        { type: "text" },
        { type: "text" },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
      ],
    });
}
