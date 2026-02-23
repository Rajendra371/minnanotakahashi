import React, { Component } from "react";

export default class List extends Component {
  constructor() {
    super();
    this.state = {
      seo: [],
      data: [],
      loading: false,
      pages: 0,
    };
  }

  componentDidMount() {
    load_datepicker();
    setTimeout(function() {
      load_table_data();
    }, 1000);
  }

  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <Row>
            <Col>
              <Card>
                <CardHeader>
                  <CardTitle>Gallery List</CardTitle>
                  <button
                    className="btnRefresh"
                    id="btnRefresh"
                    data-table="galleryTable"
                  >
                    <i className="fa fa-refresh" aria-hidden="true" />
                  </button>
                </CardHeader>
                <table
                  id="galleryTable"
                  className="table table-striped table-responsive"
                >
                  <thead>
                    <tr>
                      <th width="5%">S.No.</th>
                      <th width="15%">Category Name</th>
                      <th width="10%">Title</th>
                      <th width="15%">Content</th>
                      <th width="20%">Image Count</th>
                      <th width="10%">Display ?</th>
                      <th width="10%">Posted Date</th>
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
  var dataurl = constvar.api_url + "gallery_setup/gallery_list";
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";
  var dtablelist = $("#galleryTable")
    .dataTable({
      sPaginationType: "full_numbers",
      bSearchable: false,
      lengthMenu: [
        [15, 30, 45, 60, 100, 200, 500, -1],
        [15, 30, 45, 60, 100, 200, 500, "All"],
      ],

      iDisplayLength: 15,
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
          aTargets: [0, 4, 5, 6, 7],
        },
      ],

      aoColumns: [
        { data: null },
        { data: "category" },
        { data: "title" },
        { data: "content" },
        { data: "image_count" },
        { data: "is_display" },
        { data: "posted_date" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        // aoData.push({ name: "frmDate", value: frmDate });
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
        { type: null },
        { type: null },
        { type: "text" },
        { type: null },
      ],
    });
}
