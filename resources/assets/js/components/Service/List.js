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
                              <CardTitle>Service List</CardTitle>
                              <button className="btnRefresh" id="btnRefresh"><i className="fa fa-refresh" aria-hidden="true"></i></button>

                              {/* <Button color="danger" onClick={this.toggle}>Model</Button> */}

                          </CardHeader>
                          <div className="search_box" style={{border:"none"}}>
                            <Form className="form">
                                <div className="row">
                            
                            
                                
                                <Col md="4" sm="6" xs="6">
                                <div>
                                <Label>Date:</Label>
                                    <Input
                                        type="select"
                                        name="filter_date"
                                        id="filter_date"
                                        >
                                        <option value="">-- All --</option>
                                        <option value="range">Range</option>
                                        
                                        </Input>
                                </div>
                                </Col>
                                <Col md="4" sm="6" xs="6" className="customopt" style={{display:"none"}}>
                                <div>
                                    <label>From Date</label>
                                    <input
                                    type="text"
                                    id="frmDate"
                                    className="datepicker"
                                    name="startdate"
                                    />
                                </div>
                                </Col>
                                <Col md="4" sm="6" xs="6" className="customopt" style={{display:"none"}}>
                                <div>
                                    <label>To Date</label>
                                    <input
                                    type="text"
                                    id="toDate"
                                    className="datepicker"
                                    name="enddate"
                                    />
                                </div>
                                </Col>
                               
                                <div className="col-md-3 align-self-end">
                                    <a
                                    href="javascript:void(0)"
                                    className="btn btn-info main-btn"
                                    id="searchByDate"
                                    ><i className="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;
                                    Search
                                    </a>
                                </div>
                                
                                </div>
                                </Form>
                                </div>

                          <table id="myTable" className="table table-striped">
                              <thead>
                                  <tr>
                                      <th width="5%">S.No.</th>
                                      <th width="10%">Name</th>
                                      <th width="10%">Image</th>
                                      <th width="10%">Start Date</th>
                                      <th width="10%">End Date</th>
                                      <th width="10%">Order</th>
                                      <th width="10%">Is Publish?</th>
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
    var filter_date=$('#filter_date').val();
    var frmDate=$('#frmDate').val();
    var toDate=$('#toDate').val();

    var dataurl = constvar.api_url + "service/service_list";
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
                { data: "service_name" },
                { data: "image" },
                { data: "startdate" },
                { data: "enddate" },
                { data: "order" },
                { data: "is_publish" },
                { data: "action" }
            ],

           

           

            fnServerParams: function (aoData) {

                aoData.push({ name: "filter_date", value: filter_date });
                aoData.push({ name: "frmDate", value: frmDate });
                aoData.push({ name: "toDate", value: toDate });
                

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
                { type: null },
                { type: "text" },
                { type: "text" },
                { type: null },
                { type: null },
                { type: null }
            ]

           
        });
        $(document).off("click", "#searchByDate");
        $(document).on("click", "#searchByDate", function () {
  
       filter_date=$('#filter_date').val();
       frmDate=$('#frmDate').val();
       toDate=$('#toDate').val();
     
       dtablelist.fnDraw();
  });
}