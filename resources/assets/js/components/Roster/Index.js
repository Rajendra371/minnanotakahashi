import React, { Component } from "react";
import Employee from "../common/EmployeeFields";
export default class Index extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  componentDidMount() {
    $("#employee").addClass("required_field");
    load_select2();
  }

  render() {
    return (
      <div>
        <div className="search_box">
          <Form className="form" id="roasterForm">
            <div className="row">
              <div className="col-md-2 roster_gendiv">
                <Label>Generate Type</Label>
                <Input
                  type="select"
                  className="roster_gentype"
                  id="roster_gentype"
                  name="gen_type"
                >
                  <option value="S">Single</option>
                  <option value="B">Bulk</option>
                  <option value="E">Employeeless</option>
                </Input>
              </div>

              <Employee cols={2} status={"Y"} />

              <div className="col-md-2">
                <Label>Operation</Label>
                <Input type="select" name="operation" id="roster_gen_opern">
                  <option value="insert">Insert</option>
                  <option value="view">View</option>
                  <option value="update">Update</option>
                </Input>
              </div>
              <div
                className="col-md-2 roster_refnodiv"
                style={{ display: "none" }}
              >
                <Label>Refno.</Label>
                <Input type="text" name="refno" id="refno" />
              </div>
              <div className="col-md-1">
                <a
                  href="javascript:void(0)"
                  className="btn btn-info main-btn mt-24 searchReport"
                  data-url={constvar.api_url + "roster/entry_record"}
                  data-displayid="entry_form_roaster"
                  id="btnSearchRoasterForm"
                >
                  <i className="fa fa-search" aria-hidden="true" /> Filter
                </a>
              </div>
            </div>
          </Form>
        </div>
        <div id="entry_form_roaster" />
      </div>
    );
  }
}
load_datepicker();

$(document).off("change", ".roster_gentype");
$(document).on("change", ".roster_gentype", function(e) {
  let value = $(this).val();
  if (value == "S") {
    $(".designationdiv").show(500);
    $(".departmentdiv").show(500);
    $(".employeediv").show(500);
    $("#employee").addClass("required_field");
    // $('#employee').removeClass('form_error');
    $("#designation").removeClass("required_field");
    $("#designation").removeClass("form_error");
    $("#refno").removeClass("required_field");
    $("#refno").removeClass("form_error");
    $(".roster_refnodiv").hide(500);
  } else if (value == "B") {
    // $('.designationdiv').hide(500);
    // $('.departmentdiv').hide(500);
    // $('.employeediv').hide(500);
    // $('#employee').removeClass('required_field');
    // $('#designation').removeClass('required_field');
    // $('#designation').removeClass('form_error');
    $(".roster_gendiv").show(500);
    $(".designationdiv").show(500);
    $(".departmentdiv").show(500);
    $(".employeediv").hide(500);
    $("#employee").removeClass("required_field");
    $("#employee").removeClass("form_error");
    $("#designation").removeClass("required_field");
    $("#designation").removeClass("form_error");
    $("#refno").removeClass("required_field");
    $("#refno").removeClass("form_error");
    $(".roster_refnodiv").hide(500);
  } else {
    $(".employeediv").hide(500);
    $(".designationdiv").show(500);
    $("#designation").addClass("required_field");
    $(".departmentdiv").hide(500);
    $("#employee").removeClass("required_field");
    $("#employee").removeClass("form_error");
    $("#refno").removeClass("required_field");
    $("#refno").removeClass("form_error");
    $(".roster_refnodiv").hide(500);
  }
});

$(document).off("change", "#roster_gen_opern");
$(document).on("change", "#roster_gen_opern", function(e) {
  let value = $(this).val();
  console.log(value);
  if (value == "insert") {
    let gentype = $("#roster_gentype").val();
    if (gentype == "S") {
      $(".roster_gendiv").show(500);
      $(".designationdiv").show(500);
      $(".departmentdiv").show(500);
      $(".employeediv").show(500);
      $("#employee").addClass("required_field");
      // $('#employee').removeClass('form_error');
      $("#designation").removeClass("required_field");
      $(".roster_refnodiv").hide(500);
      $("#refno").removeClass("required_field");
      $("#refno").removeClass("form_error");
      $("#designation").removeClass("form_error");
    } else if (gentype == "B") {
      $(".roster_gendiv").show(500);
      $(".designationdiv").show(500);
      $(".departmentdiv").show(500);
      $(".employeediv").hide(500);
      $("#employee").removeClass("required_field");
      $("#employee").removeClass("form_error");
      $("#designation").removeClass("required_field");
      $("#designation").removeClass("form_error");
      $("#refno").removeClass("required_field");
      $("#refno").removeClass("form_error");
      $(".roster_refnodiv").hide(500);
    } else {
      $(".roster_gendiv").show(500);
      $(".employeediv").hide(500);
      $(".designationdiv").show(500);
      $("#designation").addClass("required_field");
      $(".departmentdiv").hide(500);
      $("#employee").removeClass("required_field");
      $(".roster_refnodiv").hide(500);
      $("#refno").removeClass("required_field");
      $("#refno").removeClass("form_error");
      $("#employee").removeClass("form_error");
    }
  } else {
    $(".roster_gendiv").hide(500);
    $(".employeediv").hide(500);
    $(".departmentdiv").hide(500);
    $(".designationdiv").hide(500);
    $(".roster_refnodiv").show(500);
    $("#refno").addClass("required_field");
    $("#employee").removeClass("required_field");
    $("#employee").removeClass("form_error");
    $("#designation").removeClass("required_field");
    $("#designation").removeClass("form_error");
  }
});
$(document).off("change", "#roster_type");
$(document).on("change", "#roster_type", function() {
  let value = $(this).val();
  if (value == "weekly") {
    $(".dateopt").show();
    $(".monthopt").hide();
    $("#to_date").prop("readOnly", true);

    get_date();
  } else if (value == "monthly") {
    $(".dateopt").hide();
    $(".monthopt").show();
  } else {
    $(".dateopt").show();
    $(".monthopt").hide();
    $("#to_date").removeAttr("readOnly");
    setTimeout(function() {
      get_date();
    }, 1600);
  }
});

$(document).off("click", "#from_date");
$(document).on("click", "#from_date", function() {
  setTimeout(function() {
    get_date();
  }, 1600);
});

function get_date() {
  var from_date = $("#from_date").val();
  var url = "roaster/get_week";
  var postdata = { from_date: from_date };
  axios
    .post(constvar.api_url + url, postdata, { hide_loader: "Y" })
    .then((response) => {
      if (response.data.status == "success") {
        $("#to_date").val(response.data.nextdate);
        console.log(response.data.nextdate);
      }
    });
}

$(document).off("change", "#roster_optn");
$(document).on("change", "#roster_optn", function(e) {
  var roster_optn = $(this).val();
  var roster_type = $("#roster_type").val();
  if (roster_optn == "view" || roster_optn == "update") {
    $("#rpt_typediv").hide(500);
    $("#yeardiv").hide(500);
    $("#monthdiv").hide(500);
    $(".designationdiv").hide(500);
    $(".departmentdiv").hide(500);
    $(".employeediv").hide(500);
    $("#refnoid").focus();
    $(".dateopt").hide(500);
  } else {
    $("#rpt_typediv").show(500);
    $(".designationdiv").show(500);
    $(".departmentdiv").show(500);
    $(".employeediv").show(500);
    if (roster_type != "monthly") {
      $(".dateopt").show(500);
    } else {
      $("#yeardiv").show(500);
      $("#monthdiv").show(500);
    }
  }
});
