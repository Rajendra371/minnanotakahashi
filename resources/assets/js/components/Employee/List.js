import React, { Component } from "react";
import "react-table/react-table.css";

export default class List extends Component {
  constructor() {
    super();
    this.state = {
      department: [],
      designation: [],
      employee_type: [],
      gender: [],
      employee_list: [],
    };
    load_datepicker();
    load_select2();
    setTimeout(function() {
      load_table_data();
    }, 1000);
  }

  componentDidMount() {
    axios.get(constvar.api_url + "employee/get_form_data").then((response) => {
      if (response.data.status == "success") {
        this.setState({ department: response.data.data["department"] });
        this.setState({ designation: response.data.data["designation"] });
        this.setState({ gender: response.data.data["gender"] });
        this.setState({ employee_type: response.data.data["employee_type"] });
        this.setState({ employee_list: response.data.data["employee_list"] });
      }
    });
    axios.get(constvar.api_url + "common_form_data").then((response) => {
      if (response.data.status == "success") {
        $("#location_div").html(response.data.data["location_option"]);
      }
    });
  }

  // onChange = (e) => {
  //   var department_id = e.target.value;
  //   axios
  //     .post(constvar.api_url + "get_employee/list", {
  //       department_id: department_id,
  //     })
  //     .then((response) => {
  //       if (response.data.status == "success") {
  //         this.setState({ employee_list: response.data.employee_list });
  //       }
  //     });
  // };

  render() {
    return (
      <div>
        <div className="animated fadeIn">
          <div className="search_box">
            <Form className="form">
              <div className="row">
                <div className="col-md-2" id="location_div" />
                <div className="col-md-2">
                  <Label>Department:</Label>
                  <Input
                    type="select"
                    name="department_id"
                    id="department_id"
                    className="select2"
                  >
                    <option value="">-- All --</option>
                    {this.state.department.length > 0
                      ? this.state.department.map((dep) => {
                          return (
                            <option key={dep.id} value={dep.id}>
                              {dep.depname}
                            </option>
                          );
                        })
                      : ""}
                  </Input>
                </div>
                <div className="col-md-2">
                  <Label>Designation :</Label>
                  <Input
                    type="select"
                    name="designation_id"
                    id="designation_id"
                    className="select2"
                  >
                    <option value="">-- All --</option>
                    {this.state.designation.length > 0
                      ? this.state.designation.map((des) => {
                          return (
                            <option key={des.id} value={des.id}>
                              {des.designation_name}
                            </option>
                          );
                        })
                      : ""}
                  </Input>
                </div>
                <div className="col-md-2">
                  <Label>Status :</Label>
                  <Input
                    type="select"
                    name="emp_status"
                    id="emp_status"
                    defaultValue="Y"
                    className="mb-2"
                  >
                    <option value="">-- All --</option>
                    <option value="Y">Current</option>
                    <option value="N">Resigned</option>
                  </Input>
                </div>

                <div className="col-md-2">
                  <Label>Gender:</Label>
                  <Input
                    type="select"
                    name="gender_id"
                    id="gender_id"
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

                {/* <div className="col-md-2">
                  <Label>Emp. Type:</Label>
                  <Input
                    type="select"
                    name="employee_type_id"
                    id="employee_type_id"
                    className=""
                  >
                    <option value="">-- Select --</option>
                    {this.state.employee_type.length > 0
                      ? this.state.employee_type.map((datas) => {
                          return (
                            <option key={datas.id} value={datas.id}>
                              {datas.employee_type}
                            </option>
                          );
                        })
                      : ""}
                  </Input>
                </div> */}
                <div className="col-md-2">
                  <Label>Employee:</Label>
                  <Input
                    type="select"
                    name="employee_id"
                    id="employee_id"
                    className="select2"
                  >
                    <option value="">-- All --</option>
                    {this.state.employee_list.length > 0
                      ? this.state.employee_list.map((employee_list) => {
                          return (
                            <option
                              key={employee_list.id}
                              value={employee_list.id}
                            >
                              {employee_list.full_name}
                            </option>
                          );
                        })
                      : ""}
                  </Input>
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
                <div className="col-md-2">
                  <label>Print Orientation</label>
                  <select
                    name="page_orientation"
                    id="page_orientation"
                    className="form-control"
                  >
                    <option value="P">Portrait </option>
                    <option value="L">Landscape</option>
                  </select>
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
                <CardHeader>
                  <div className="d-flex justify-content-between">
                    <CardTitle>Employee List</CardTitle>
                    <div>
                      <a
                        className="btn btn-info btn_excel generate_export_file"
                        id="excel"
                        data-type="excel"
                        data-location={
                          constvar.api_url + "employee/generate_excel"
                        }
                        data-tableid="#employeeTable"
                      >
                        <i className="fa fa-file-excel-o" />
                      </a>

                      <a
                        className="btn  btn-success btn_pdf generate_export_file"
                        id="print"
                        data-type="pdf"
                        target="_blank"
                        data-location={
                          constvar.api_url + "employee/generate_pdf"
                        }
                        data-tableid="#employeeTable"
                      >
                        <i className="fa fa-print" />
                      </a>
                      <a
                        className="btn btn-success btn_excel generate_export_file"
                        data-type="word"
                        data-location={
                          constvar.api_url + "employee/generate_word"
                        }
                        data-tableid="#employeeTable"
                      >
                        <i className="fa fa-file-word-o" />
                      </a>
                    </div>
                  </div>
                </CardHeader>
                <table id="employeeTable" className="table table-striped">
                  <thead>
                    <tr>
                      <th width="5%">S.N </th>
                      <th width="5%">Emp. Code </th>
                      <th width="10%">Emp. Name </th>
                      <th width="5%">Gender </th>
                      <th width="5%">Department </th>
                      <th width="5%">Designation </th>
                      <th width="10%">Mobile </th>
                      <th width="10%">Email </th>
                      <th width="5%">Status </th>
                      <th width="5%">Action </th>
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
  var location_id = $("#location_id").val();
  var department_id = $("#department_id").val();
  var designation_id = $("#designation_id").val();
  var employee_id = $("#employee_id").val();
  var gender_id = $("#gender_id").val();
  var employee_type_id = $("#employee_type_id").val();
  var search_text = $("#search_text").val();
  var page_orientation = $("#page_orientation").val();
  var emp_status = $("#emp_status").val();

  var dataurl = constvar.api_url + "employee/datatable_list";
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";

  var dtablelist = $("#employeeTable")
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
          aTargets: [0, 9],
        },
      ],

      aoColumns: [
        { data: null },
        { data: "empcode" },
        { data: "full_name" },
        { data: "gend_name" },
        { data: "depname" },
        { data: "designation_name" },
        { data: "mobile" },
        { data: "email" },
        { data: "status" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        aoData.push({ name: "location_id", value: location_id });
        aoData.push({ name: "department_id", value: department_id });
        aoData.push({ name: "designation_id", value: designation_id });
        aoData.push({ name: "employee_id", value: employee_id });
        aoData.push({ name: "gender_id", value: gender_id });
        aoData.push({ name: "employee_type_id", value: employee_type_id });
        aoData.push({ name: "search_text", value: search_text });
        aoData.push({ name: "page_orientation", value: page_orientation });
        aoData.push({ name: "emp_status", value: emp_status });
      },

      fnRowCallback: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
        return nRow;
      },

      fnCreatedRow: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        var cur_status = aData.cstatus;
        // console.log('T'+cur_status);
        var tblid = oSettings._iDisplayStart + iDisplayIndex + 1;
        $(nRow).attr("id", "listid_" + tblid);
        if (cur_status == "N") {
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
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: "text" },
        { type: null },
      ],
    });

  $(document).off("keyup", "#search_text");
  $(document).on("keyup", "#search_text", function() {
    location_id = $("#location_id").val();
    department_id = $("#department_id").val();
    designation_id = $("#designation_id").val();
    employee_id = $("#employee_id").val();
    gender_id = $("#gender_id").val();
    employee_type_id = $("#employee_type_id").val();
    emp_status = $("#emp_status").val();
    search_text = $("#search_text").val();
    dtablelist.fnDraw();
  });

  $(document).off("click", "#searchEmployeeList");
  $(document).on("click", "#searchEmployeeList", function() {
    location_id = $("#location_id").val();
    department_id = $("#department_id").val();
    designation_id = $("#designation_id").val();
    employee_id = $("#employee_id").val();
    gender_id = $("#gender_id").val();
    employee_type_id = $("#employee_type_id").val();
    search_text = $("#search_text").val();
    emp_status = $("#emp_status").val();
    dtablelist.fnDraw();
  });

  $(document).off("click", "#emp_resgn_btn");
  $(document).on("click", "#emp_resgn_btn", function(e) {
    let id = $(this).data("id");
    let answer = window.confirm("Resign this employee?");
    if (answer) {
      let url = constvar.api_url + "employee/resign";
      axios.post(url, { id: id }).then((res) => {
        if (res.data.status == "success") {
          alert("Resignation successful for this employee");
          dtablelist.fnDraw();
        } else {
          alert("Error!");
        }
      });
    }
  });
}

$(document).off("change", "#location_id");
$(document).on("change", "#location_id", function() {
  let locationid = $(this).val();
  let option = "<option value=''>--All--</option>";
  axios
    .post(constvar.api_url + "general_data/get_employee", { locationid })
    .then((response) => {
      if (response.data.status == "success") {
        let employee_list = response.data.employee_list;
        $.each(employee_list, function(key, value) {
          option += `<option value="${value.id}">${value.full_name}</option>`;
        });
        $("#employee_id").html(option);
      } else {
        $("#employee_id").html(option);
      }
    });
});
