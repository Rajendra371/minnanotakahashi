import React, { Component } from "react";
import { Link, Route } from "react-router-dom";

export default class List extends Component {

constructor() {
    load_datepicker();
    setTimeout(function () {
        load_table_data();
    }, 1000);
    super();
    this.state = {
        seo:[],
        // deplist:[],
        data: [],
        loading: false,
        pages: 0
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
                              <CardTitle>Organization List</CardTitle>
                              <button className="btnRefresh" id="btnRefresh"><i className="fa fa-refresh" aria-hidden="true"></i></button>

                              {/* <Button color="danger" onClick={this.toggle}>Model</Button> */}

                          </CardHeader>

                          <table id="myTable" className="table table-striped">
                              <thead>
                                  <tr>
                                      <th width="5%">S.No.</th>
                                      <th width="10%">Organization Name</th>
                                      <th width="10%">Contact</th>
                                      <th width="10%">Address</th>
                                      <th width="10%">Website</th>
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

    var dataurl = constvar.api_url + "organization/organization_list";
    var message = "";
    message = "<p class='text-danger'>No Record Found!! </p>";
    var dtablelist = $("#myTable")
        .dataTable({
            sPaginationType: "full_numbers",
            bSearchable: false,
            lengthMenu: [
                [15, 30, 45, 60, 100, 200, 500, -1],
                [15, 30, 45, 60, 100, 200, 500, "All"]
            ],

            iDisplayLength: 10,
            sDom: "ltipr",
            bAutoWidth: false,
            autoWidth: true,
            aaSorting: [[0, "desc"]],
            bProcessing: true,
            bServerSide: true,
            sAjaxSource: dataurl,

            fnServerData: function (sSource, aoData, fnCallback) {
                $.ajax({
                    "dataType": 'json',
                    "type": "GET",
                    "headers": { 'Authorization': 'Bearer' + localStorage.getItem('backend-jwt-token') },
                    "url": sSource,
                    "data": aoData,
                    "success": fnCallback
                });
            },
            oLanguage: {
                sEmptyTable: message
            },
            aoColumnDefs: [
                {
                    bSortable: false,
                    aTargets: [0]
                }
            ],

            aoColumns: [
                { data: null },
                { data: "orgname" },
                { data: "contact" },
                { data: "orgaddress1" },
                { data: "website" },
                { data: "action" }
            ],

           

            fnServerParams: function (aoData) {

                // aoData.push({ name: "frmDate", value: frmDate });

                // aoData.push({ name: "toDate", value: toDate });

            },



            fnRowCallback: function (nRow, aData, iDisplayIndex) {
                var oSettings = dtablelist.fnSettings();
                $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
                return nRow;
            },

            fnCreatedRow: function (nRow, aData, iDisplayIndex) {
                var oSettings = dtablelist.fnSettings();
                var tblid = oSettings._iDisplayStart + iDisplayIndex + 1;
                $(nRow).attr("id", "listid_" + tblid);
            }
        })

        .columnFilter({
            sPlaceHolder: "head:after",
            aoColumns: [
                { type: null },
                { type: "text" },
                { type: "text" },
                { type: "text" },
                { type: "text" },
                { type: null }
            ]
        });
}