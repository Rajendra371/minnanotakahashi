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
        category:[],
        // deplist:[],
        data: [],
        loading: false,
        pages: 0
    };
}   
componentDidMount() {
    axios.get(constvar.api_url + "client").then(response => {
      if (response.data.status == "success") {
        // this.setState({ email_configuration: response.data.data['email_protocol'] });
        this.setState({ category: response.data.data['category'] });
      } else {
        this.setState({ category: "" });
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
                              <CardTitle>Client List</CardTitle>
                              <button className="btnRefresh" id="btnRefresh"><i className="fa fa-refresh" aria-hidden="true"></i></button>

                              {/* <Button color="danger" onClick={this.toggle}>Model</Button> */}

                          </CardHeader>
                          <div className="search_box" style={{border:"none"}}>
          <Form className="form">
            <div className="row">
            <Col md="4" sm="6" xs="6">
          <div>
              <Label>Client Category:</Label>
                  <Input
                    type="select"
                    name="client_category"
                    id="Client_Category"
                    className="mb-2"
                    >
                      <option value="">-- All --</option>
                      { this.state.category.length >0 ? (
                      this.state.category.map(datas => {
                      return (
                        <option key={datas.id} value={datas.id}>
                          {datas.category_name}
                        </option>
                       ); 
                     }) ): ''}
                    </Input>
            </div>
            </Col>
            <Col md="4" sm="6" xs="6">
          <div>
              <Label>Client Name:</Label>
                  <Input
                    type="text"
                    name="client_name"
                    id="ClientName"
                    className="mb-2"
                    >
                    </Input>
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
                                      <th width="10%">Category</th>
                                      <th width="20%">Client Name</th>
                                      <th width="10%">URL</th>
                                      <th width="20%">Logo</th>
                                      <th width="10%">Order</th>
                                      <th width="10%">Is Publish</th>
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
    var Client_Name =$('#Client_Name');
    var Client_Category =$('#Client_Category');

    var dataurl = constvar.api_url + "client/client_list";
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
                { data: "client_catid" },
                { data: "client_name" },
                { data: "url" },
                { data: "logo" },
                { data: "order" },
                { data: "is_publish" },
                { data: "action" }
            ],

           

            fnServerParams: function (aoData) {

                 aoData.push({ name: "Client_Name", value: Client_Name });

                 aoData.push({ name: "Client_Category", value: Client_Category });

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
                { type: null },
                { type: null },
                { type: null },
                { type: null }
            ]
        });
        $(document).off("click", "#searchByDate");
        $(document).on("click", "#searchByDate", function () {
           
    Client_Name=$('#Client_Name').val();
       Client_Category=$('#Client_Category').val();
       dtablelist.fnDraw();
  });
}