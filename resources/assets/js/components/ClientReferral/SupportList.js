import React, { Component } from "react";

export default class List extends Component {
  constructor() {
    super();
    this.state = {
      data: [],
      loading: false,
      pages: 0,
    };
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
                  <CardTitle>Support Referrals List</CardTitle>
                  <button
                    className="btnRefresh"
                    id="btnRefresh"
                    data-id="supportReferralList"
                  >
                    <i className="fa fa-refresh" aria-hidden="true" />
                  </button>
                </CardHeader>

                <table
                  id="supportReferralList"
                  className="table table-striped table-responsive"
                >
                  <thead>
                    <tr>
                      <th width="5%">S.No.</th>
                      <th width="10%">Full Name</th>
                      <th width="10%">Type</th>
                      <th width="20%">Email</th>
                      <th width="20%">Contact</th>
                      <th width="20%">Subject</th>
                      <th width="10%">Message</th>
                      <th width="10%">Status</th>
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
  var dataurl = constvar.api_url + "support_referral/list";
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";
  var dtablelist = $("#supportReferralList")
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
          aTargets: [0, 9],
        },
      ],

      aoColumns: [
        { data: null },
        { data: "full_name" },
        { data: "type" },
        { data: "email" },
        { data: "contact_number" },
        { data: "subject" },
        { data: "message" },
        { data: "status" },
        { data: "postdatead" },
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
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: null },
        { type: "text" },
        { type: null },
      ],
    });
}
