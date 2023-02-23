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
        action:[],
        tablename:[],
        // deplist:[],
        data: [],
        loading: false,
        pages: 0
    };
}  
componentDidMount() {
    axios.get(constvar.api_url + "audit_trail").then(response => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({ action: response.data.data['action'] });
        this.setState({ tablename: response.data.data['tablename'] });
      } else {
        this.setState({ action:'' });
      }
    });
    } 
    
render() {
    return (
      <div>
          <div className="animated fadeIn">
         
              <Row>
                  <Col>
                      <Card>
                          <CardHeader>
                              <CardTitle>Audit Trails List</CardTitle>
                              
                              <button className="btnRefresh" id="btnRefresh"><i className="fa fa-refresh" aria-hidden="true"></i></button>

                              {/* <Button color="danger" onClick={this.toggle}>Model</Button> */}

                          </CardHeader>
                           <div className="search_box">
          <Form className="form">
            <div className="row">
           
          
            <Col md="3" sm="6" xs="12">
            <div className="">
                <label>Action</label>
                <Input
                    type="select"
                    name="action"
                    id="Action"
                    className=""
                    >
                      <option value="">-- All --</option>
                      { this.state.action.length >0 ? (
                      this.state.action.map(datas => {
                      return (
                        <option key={datas.id} value={datas.id}>
                          {datas.action}
                        </option>
                       ); 
                    }) ): ''}
                    </Input>
              </div>
              </Col>
              <Col md="3" sm="6" xs="12">
            <div className="">
                <label>Table Name</label>
                <Input
                    type="select"
                    name="tablename"
                    id="tableName"
                    className=""
                    >
                      <option value="">-- All --</option>
                      { this.state.tablename.length >0 ? (
                      this.state.tablename.map(datas => {
                      return (
                        <option key={datas.id} value={datas.id}>
                          {datas.tablename}
                        </option>
                       ); 
                    }) ): ''}
                    </Input>
              </div>
              </Col>
            <Col md="3" sm="6" xs="12">
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
                      <Col md="3" sm="6" xs="12" className="customopt" style={{ display: "none" }}>
            
                <label>From Date</label>
                <input
                  type="text"
                  id="frmDate"
                  className="datepicker"
                  placeholder="YYYY-MM-DD"
                  name="startdate"
                />
             
              </Col>
                      <Col md="3" sm="6" xs="12" className="customopt" style={{ display: "none" }}>
            
                <label>To Date</label>
                <input
                  type="text"
                  id="toDate"
                  className="datepicker"
                  placeholder="YYYY-MM-DD"
                  name="enddate"
                />
              
              </Col>
              <div className="col-md-3 col-sm-6 align-self-end">
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
                                      <th width="10%">Date</th>
                                      <th width="10%">Time</th>
                                      <th width="20%">Table Name</th>
                                      <th width="20%">Data New</th>
                                      <th width="20%">Data Old</th>
                                      <th width="10%">Post IP</th>
                                      <th width="10%">Post By</th>
                                     
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
    var Action=$('#Action').val();
    var tableName=$('#tableName').val();
    var filter_date=$('#filter_date').val();
    var frmDate=$('#frmDate').val();
    var toDate=$('#toDate').val();

    var dataurl = constvar.api_url + "audit_trail/audittrails_list";
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
                { data: "postdatead" },
                { data: "posttime" },
                { data: "tablename" },
                { data: "datanew" },
                { data: "dataold" },
                { data: "postip" },
                { data: "postby" },
               
            ],

           

            fnServerParams: function (aoData) {

                aoData.push({ name: "filter_date", value: filter_date });
                aoData.push({ name: "frmDate", value: frmDate });
                aoData.push({ name: "toDate", value: toDate });
                aoData.push({ name: "Action", value: Action });
                aoData.push({ name: "tableName", value: tableName });

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
                { type: "text"},
                { type: null },
                { type: "text"},
                { type: null },
                { type: null },
                { type: null },
                { type: null }
               
            ]
            
           
        });
        $(document).off("click", "#searchByDate");
        $(document).on("click", "#searchByDate", function () {
            Action=$('#Action').val();
            tableName=$('#tableName').val();
  
       filter_date=$('#filter_date').val();
       frmDate=$('#frmDate').val();
       toDate=$('#toDate').val();
       dtablelist.fnDraw();
  });
 
}
