import React, { Component } from "react";
import "react-table/react-table.css";

export default class List extends Component {
  constructor() {
    super();
    this.state = {
      data:[], 
      gender:[]
    };
    load_datepicker();
    load_select2();
    setTimeout(function() {
      load_table_data();
    }, 1000);
  }

  componentDidMount(){
    axios.get(constvar.api_url + "employee/get_form_data").then((response) => {
        if (response.data.status == "success") {
         
          this.setState({ gender: response.data.data["gender"] });
          
        }
      });
  }

  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <div className="search_box">
            <Form className="form">
              <div className="row">
                <div className="col-md-2">
                  <Label>Gender:</Label>
                  <Input
                    type="select"
                    name="job_gender"
                    id="job_gender"
                    className="mb-2"
                  >
                    <option value="">-- All --</option>
                    {this.state.gender.length > 0
                      ? this.state.gender.map((gend) => {
                          return (
                            <option key={gend.id} value={gend.id}>
                              {gend.gend_name}
                            </option>
                          );
                        })
                      : ""}
                  </Input>
                </div>
                <div className = "col-md-2">
                  <Label>Date</Label>
                  <Input type = "select" name = "date_range" className = "form-control" id = "career_date">
                    <option value = "">-- All --</option>
                    <option value = "R">Range</option>
                  </Input>
                </div>
                <div className = "col-md-2 range_div" style = {{display: "none"}}>
                    <Label>Start Date</Label>
                    <Input type = "text" name = "start_date" id = "job_startdate" autocomplete = "off" className = "datepicker"/>
                </div>
                <div className = "col-md-2 range_div" style = {{display: "none"}}>
                    <Label>End Date</Label>
                    <Input type = "text" name = "end_date" id = "job_enddate" autocomplete = "off"  className = "datepicker"/>
                </div>
                <div className="col-md-2">
                  <Label>Search Text</Label>
                  <Input
                    type="text"
                    name="search_text"
                    id="search_text"
                    placeholder="Search"
                  />
                </div>
                <div className="col-md-1">
                  <a
                    href="javascript:void(0)"
                    className="btn btn-info main-btn mt-4"
                    id="searchEmployeeList"
                  >
                    <i className="fa fa-search" aria-hidden="true" />
                  </a>
                </div>
              </div>
            </Form>
          </div>

          <Row>
            <Col>
              <Card>
                <table id="careerListTable" className="table table-striped">
                  <thead>
                    <tr>
                      <th width="2%">S.N </th>
                      <th width="7%">Code </th>
                      <th width="13%">Job Title </th>
                      <th width="15%">Apply Before </th>
                      <th width="5%">No. of Vacancy</th>
                      <th width="12%">Experience Type </th>
                      <th width="15%">Start Date </th>
                      {/* <th width="11">End Date </th> */}
                      <th width="5%">Driving License </th>
                      <th width="4%">Salary Type </th>
                      <th width="4%">Gender </th>
                      <th width="2%">Apply Online </th>
                      <th width="2%">Apply Direct </th>
                      <th width="13%">Action </th>
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
  var date_type = $('#career_date').val();
  var gender_id = $("#job_gender").val();
  var start_date = $('#job_startdate').val();
  var end_date = $('#job_enddate').val();
  var search_text = $("#search_text").val();

  var dataurl = constvar.api_url + "career_list/list";
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";

  var dtablelist = $("#careerListTable")
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
            Authorization:
              "Bearer " + localStorage.getItem("backend-jwt-token"),
          },
          url: sSource,
          data: aoData,
          success: fnCallback,
          error: function(xhr, error, code) {
            if (xhr.status == 401) {
              message = "Please reload the page";
            }
            console.log(error, code);
          },
        });
      },
      oLanguage: {
        sEmptyTable: message,
      },

      aoColumnDefs: [
        {
          bSortable: false,
          aTargets: [0, 4, 5, 7, 8 , 9, 10, 11, 12],
        },
      ],

      aoColumns: [
        { data: null },
        { data: "jobcode" },
        { data: "job_title" },
        { data: "apply_before" },
        { data: "no_of_vacancy" },
        { data: "experience_type" },
        { data: "start_date" },
        // { data: "end_date" },
        { data: "driving_license" },
        { data: "salary_type" },
        { data: "gender" },
        { data: "apply_online" },
        { data: "apply_direct" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        aoData.push({ name: "date_type", value: date_type });
        aoData.push({ name: "start_date", value: start_date });
        aoData.push({ name: "end_date", value: end_date });
        aoData.push({ name: "gender_id", value: gender_id });
        aoData.push({ name: "search_text", value: search_text });
      },

      fnRowCallback: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
        return nRow;
      },

      fnCreatedRow: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        var cur_status = aData.curstatus;
        // console.log('T'+cur_status);
        var tblid = oSettings._iDisplayStart + iDisplayIndex + 1;
        $(nRow).attr("id", "listid_" + tblid);
        if(cur_status == "N"){
          $(nRow).attr("style", "background:#f98280  !important");
        } else {
          $(nRow).attr("style", "background:#b7e8b9 !important");
        }
        
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
        // { type: "text" },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
      ],
    });

  $(document).off("keyup", "#search_text");
  $(document).on("keyup", "#search_text", function() {
    date_type = $('#career_date').val();
    gender_id = $('#job_gender').val();
    start_date = $('#job_startdate').val();
    end_date = $('#job_enddate').val();
    search_text = $("#search_text").val();
    dtablelist.fnDraw();
  });

  $(document).off("click", "#searchEmployeeList");
  $(document).on("click", "#searchEmployeeList", function() {
    date_type = $('#career_date').val();
    gender_id = $('#job_gender').val();
    start_date = $('#job_startdate').val();
    end_date = $('#job_enddate').val();
    search_text = $("#search_text").val();
    dtablelist.fnDraw();
  });

  $(document).off("click", "#publish_job");
  $(document).on("click", "#publish_job", function(e){
    let id = $(this).data('id');
    let answer = window.confirm('Are you sure?');
    if(answer){
      let url = constvar.api_url + "career_list/publish_job";
      axios
        .post(url, {id:id})
        .then((response) =>{
          if(response.data.status == "success"){
            alert('Operation Successful');
            dtablelist.fnDraw();
          }
          else{
            alert('Error! Operation unsucessful');
          }
        })
    }
    console.log(id);
    // console.log('test');
  });

  // $(document).off("click", "#edit_job");
  // $(document).on("click", "#edit_job", function(e){
  //   let id = $(this).data('id');
  //   let url =  "badministrator/career_setup?id=" + id;
  //   // console.log(id);
  //   axios
  //     .get(url, {id:id})
  //     .then((response) => {
  //       // if
  //     });

  // });

}

$(document).off('change','#career_date');
$(document).on('change','#career_date', function(e){
  let value = $(this).val();
  if(value == "R"){
    $('.range_div').show(500);
  }
  else{
    $('.range_div').hide(500);
  }
});
