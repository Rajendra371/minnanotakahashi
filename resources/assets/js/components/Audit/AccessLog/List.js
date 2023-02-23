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
      user:[],
        data: [],
        loading: false,
        pages: 0
    };
}  
componentDidMount() {
    axios.get(constvar.api_url + "access_log").then(response => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({ user: response.data.data['user'] });
       
      } else {
        this.setState({ user:'' });
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
                              <CardTitle>Access Log List</CardTitle>
                              <button className="btnRefresh" id="btnRefresh"><i className="fa fa-refresh" aria-hidden="true"></i></button>

                              {/* <Button color="danger" onClick={this.toggle}>Model</Button> */}

                          </CardHeader>
                          <div className="search_box">
          <Form className="form">
            <div className="row">
            <Col md="3" sm="6" xs="12">
            <div className="">
                <label>User</label>
                <Input
                    type="select"
                    name="loginusername"
                    id="Users"
                    className=""
                    >
                      <option value="">-- All --</option>
                      { this.state.user.length >0 ? (
                      this.state.user.map(datas => {
                      return (
                        <option key={datas.id} value={datas.id}>
                          {datas.loginusername}
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
              <div className="col-md-2 align-self-end">
                <a
                  href="javascript:void(0)"
                  className="btn btn-info main-btn "
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
                                      <th width="10%">Login Date</th>
                                      <th width="10%">Time</th>
                                      <th width="20%">Login User</th>
                                      <th width="20%">Login IP</th>
                                      <th width="20%">User Agent</th>
                                      
                                     
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
    var Users=$('#Users').val();
    var filter_date=$('#filter_date').val();
    var frmDate=$('#frmDate').val();
    var toDate=$('#toDate').val();

    var dataurl = constvar.api_url + "access_log/accesslog_list";
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
                { data: "logindatead" },
                { data: "logintime" },
                { data: "loginusername" },
                { data: "loginip" },
                { data: "user_agent" },
                
               
            ],
           

           

            fnServerParams: function (aoData) {

                aoData.push({ name: "filter_date", value: filter_date });
                aoData.push({ name: "frmDate", value: frmDate });
                aoData.push({ name: "toDate", value: toDate });
                aoData.push({ name: "Users", value: Users });
                

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
                { type: null }
               
               
            ]
           
            
           
        });
        $(document).off("click", "#searchByDate");
        $(document).on("click", "#searchByDate", function () {
        Users=$('#Users').val();
        filter_date=$('#filter_date').val();
        frmDate=$('#frmDate').val();
        toDate=$('#toDate').val();
        dtablelist.fnDraw();
  });
}