import React, { Component } from "react";
import axios from "axios";
import {
  BrowserRouter as Router,
  Route,
  Redirect,
  Link,
} from "react-router-dom";

const componentsMap = {
  // replace <img> tags by custom react component
  img: (props) => <Image {...props} />,
  // replace <a> tags by React Router Link component
  a: (props) => <Link {...props} to={props.href} />,
  // add lazy load to all iframes
  iframe: (props) => (
    <LazyLoad>
      <iframe {...props} />
    </LazyLoad>
  ),
};

class Common extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    return <div />;
  }
}
export default Common;

class Popup extends React.Component {
  render() {
    return (
      <div className="popup">
        <div className="popup_inner">
          <h1>{this.props.text}</h1>
          <button onClick={this.props.closePopup}>close me</button>
        </div>
      </div>
    );
  }
}

//For Form Validation Display Red Border Color
function check_form_validation(formid) {
  var reqlength = $(`#${formid} .required_field`).length;
  // alert(reqlength);
  // return false;

  var value = $(`#${formid} .required_field`).filter(function() {
    $(this).off("change keyup");
    $(this).on("change keyup", function() {
      if ($(this).val().length === 0) {
        $(this).addClass("form_error");
        $(this)
          .find("div.select2")
          .addClass("form_error");
      } else {
        $(this).removeClass("form_error");
        $(this)
          .find("div.select2")
          .removeClass("form_error");
      }
    });

    if ($(this).val().length === 0) {
      $(this).addClass("form_error");
      $(this)
        .find("div.select2")
        .addClass("form_error");
    } else {
      $(this).removeClass("form_error");
      $(this)
        .find("div.select2")
        .removeClass("form_error");
    }

    return this.value != "";
  });

  if (value.length >= 0 && value.length !== reqlength) {
    // handleMessage('error','Please fill out all required fields.');
    return "fail";
  } else {
    // console.log('All required fields are filled up.');
    return "success";
  }
}

$(document).ready(function() {
  $(".btnRefresh").each(function() {
    $(this).addClass("btn-primary");
    $(this).css({ top: "12px", right: "10px" });
  });
});

$(document).on("change", "input[type=file]", function(e) {
  var fileName = e.target.files[0].name;
  // console.log(fileName);
  $(this)
    .parent()
    .attr("data-text", fileName);
  $(this)
    .parent()
    .addClass("uploaded");
});

// $(document).off("click", ".save");
// $(document).on("click", ".save", function(e) {
//   e.preventDefault();
//   var formid = $(this)
//     .closest("form")
//     .attr("id");
//   var action = $("#" + formid).attr("action");
//   var data = new FormData($("form#" + formid)[0]);
//   var datatargetdiv = $(this).data("targetdiv");
//   var redirect_type = $(this).data("redirect_type");
//   var print = $(this).data("print");
//   var is_table_refresh = $(this).data("is_table_refresh");
//   var target_btn = $(this).data("target_btn");
//   var isdismiss = $(this).data("isdismiss");
//   var reloadurl = $("#" + formid).data("reloadurl");
//   var operation = $(this).data("operation");

//   $("textarea").each(function() {
//     var $this = $(this);
//     var cls = this.className;
//     var id = this.id;
//     var name = this.name;
//     var ckd_string = "ckeditor";
//     if (cls.indexOf(ckd_string) != -1) {
//       var content = CKEDITOR.instances[id].getData();
//       data.append(name, content);
//     }
//   });
//   var isvalid = check_form_validation(formid);

//   if (isvalid == "fail") {
//     return false;
//   }
//   let uri = action;
//   if (print) {
//     var arrayprint = print.split(",");
//     print = arrayprint[0];
//     var reloadid = arrayprint[1];
//     if (reloadid == "reloadid" || print == "reloadid") {
//       reloadid = "reloadid";
//     }
//   } else {
//     reloadid = "";
//   }

//   if (print == "print") {
//     data.append("print", print);
//   }

//   axios
//     .post(uri, data)
//     .then((response) => {
//       if (response.data.status == "success") {
//         // for print start
//         if (print == "print") {
//           $(".printTable").show();
//           var printrpt = response.data.print_report;
//           $(".print_report_section").html(printrpt);
//           setTimeout(function() {
//             $(".printTable").printThis();
//           }, 500);
//           setTimeout(function() {
//             $(".printTable").hide();
//             $(".print_report_section").html("");
//           }, 2000);
//         }

//         var employee_id = response.data.employee_id;
//         if (employee_id) {
//           $("#emp_id").val(employee_id);
//         }
//         if (redirect_type == "form") {
//           $("#" + datatargetdiv).html(response.data.template);
//         }
//         if (is_table_refresh == "Y") {
//           $("#" + target_btn).click();
//         }
//         if (operation == "continue") {
//           var param = response.data.param;
//         }

//         setTimeout(function() {
//           $("#emp_id").change();
//         }, 500);

//         $(".notification").html(
//           response.data.message + "&nbsp;<i class='fa fa-times '></i>"
//         );
//         $(".notification").addClass("alert");
//         $("#searchByDate").click();

//         if (operation) {
//           if (operation == "continue" && param) {
//             $(".formdiv").html("");
//             axios.post(reloadurl, { id: param }).then((resp) => {
//               if (resp.data.status == "success") {
//                 $(".formdiv").html(resp.data.template);
//               }
//             });
//           } else {
//             axios.post(reloadurl).then((resp) => {
//               if (resp.data.status == "success") {
//                 setTimeout(function() {
//                   $(".formdiv").html(resp.data.template);
//                 }, 1200);
//               }
//             });
//           }
//         }

//         if (isdismiss == "Y") {
//           $("body").removeClass("modal-open");
//           $("#myView").css("display", "none");
//           if (datatargetdiv) {
//             if (print == "print") {
//               setTimeout(function() {
//                 $("#" + datatargetdiv).html("");
//               }, 1000);
//             } else {
//               $("#" + datatargetdiv).html("");
//             }
//           }
//         }

//         let resetBtn = $("#" + formid + " .btnreset");
//         if (resetBtn.length) {
//           resetBtn.trigger("click");
//           $(`#${formid} textarea`).each(function() {
//             var cls = this.className;
//             var id = this.id;
//             var ckd_string = "ckeditor";
//             if (cls.indexOf(ckd_string) != -1) {
//               CKEDITOR.instances[id].setData("");
//             }
//           });
//         }
//         // else {
//         //   location.reload();
//         // }
//       } else if (
//         response.data.status == "error" &&
//         response.data.permission == "no"
//       ) {
//         $(".notification_error").html(
//           response.data.message + "&nbsp;<i class='fa fa-times '></i>"
//         );
//         $(".notification_error").addClass("alert");
//       } else {
//         var msg = response.data.message;
//         if (!Array.isArray(msg)) {
//           msg = [msg];
//         }
//         // console.log(msg);
//         var errmsg = "<ul style='list-style:none'>";
//         $.each(msg, function(key, value) {
//           errmsg += "<li>" + value + "</li>";
//         });
//         errmsg += "</ul>";
//         $(".notification_error").html(errmsg);
//         $(".notification_error").addClass("alert");
//       }
//       setTimeout(function() {
//         $(".notification ").html("");
//         $(".notification").removeClass("alert");
//         $(".notification_error ").html("");
//         $(".notification_error").removeClass("alert");
//       }, 4000);
//     })
//     .catch((error) => {
//       console.log(error);
//     });
// });

$(document).off("click", ".save");
$(document).on("click", ".save", function(e) {
  e.preventDefault();
  var formid = $(this)
    .closest("form")
    .attr("id");
  var action = $("#" + formid).attr("action");
  var data = new FormData($("form#" + formid)[0]);
  var datatargetdiv = $(this).data("targetdiv");
  var redirect_type = $(this).data("redirect_type");
  var is_table_refresh = $(this).data("is_table_refresh");
  var target_btn = $(this).data("target_btn");

  // $(`#${formid} textarea`).each(function() {
  //   var cls = this.className;
  //   var id = this.id;
  //   var name = this.name;
  //   var ckd_string = "ckeditor";
  //   if (cls.indexOf(ckd_string) != -1) {
  //     var content = CKEDITOR.instances[id].getData();
  //     data.append(name, content);
  //   }
  // });

  var isvalid = check_form_validation(formid);
  console.log(isvalid);
  if (isvalid == "fail") {
    return false;
  }
  let uri = action;

  axios
    .post(uri, data)
    .then((response) => {
      if (response.data.status == "success") {
        if (redirect_type == "form") {
          $("#" + datatargetdiv).html(response.data.template);
        }
        if (is_table_refresh == "Y") {
          $("#" + target_btn).click();
        }
        $("#" + formid)
          .find(".success")
          .html(response.data.message);
        $("#" + formid)
          .find(".success")
          .addClass("alert");
        let resetBtn = $("#" + formid + " .btnreset");
        if (resetBtn.length) {
          resetBtn.trigger("click");
          $(`#${formid} textarea`).each(function() {
            var cls = this.className;
            var id = this.id;
            var ckd_string = "ckeditor";
            if (cls.indexOf(ckd_string) != -1) {
              CKEDITOR.instances[id].setData("");
            }
          });
        }
        $("#btnRefresh").click();
      } else if (
        response.data.status == "error" &&
        response.data.permission == "no"
      ) {
        $("#" + formid)
          .find(".error")
          .html(response.data.message);
        $("#" + formid)
          .find(".error")
          .addClass("alert");
      } else {
        var msg = response.data.message;
        // console.log(msg);
        var errmsg = "<ul style='list-style:none'>";
        $.each(msg, function(key, value) {
          errmsg += "<li>" + value + "</li>";
        });
        errmsg += "</ul>";
        $("#" + formid)
          .find(".error")
          .html(errmsg);
        $("#" + formid)
          .find(".error")
          .addClass("alert");
      }
      setTimeout(function() {
        $("#" + formid)
          .find(".success")
          .html("");
        $("#" + formid)
          .find(".success")
          .removeClass("alert");
        $("#" + formid)
          .find(".error")
          .html("");
        $("#" + formid)
          .find(".error")
          .removeClass("alert");
      }, 3000);
    })
    .catch((error) => {
      console.log(error);
    });
});

$(document).off("click", ".btnRefresh");
$(document).on("click", ".btnRefresh", function() {
  let tableId = $(this).data("id");
  if (tableId) {
    $(`#${tableId}`)
      .DataTable()
      .ajax.reload();
  } else {
    $("#myTable")
      .DataTable()
      .ajax.reload();
  }
});

// For Edit Form
$(document).off("click", ".btnEdit,.btnView");
$(document).on("click", ".btnEdit,.btnView", function(e) {
  e.preventDefault();
  var formid = $(this).data("targetform");
  var editurl = $(this).data("url");
  var id = $(this).data("id");
  var edittype = $(this).data("edittype");
  var inputs = $("#" + formid + " :input").map(function(index, elm) {
    return {
      tag: elm.tagName,
      name: elm.name,
      type: elm.type,
      value: $(elm).val(),
    };
  });
  var postdata = { id: id, edittype: edittype };

  axios
    .post(editurl, postdata)
    .then((response) => {
      // console.log(response.data);
      // console.log("modulekey" + response.data.modulekey);
      var resp = response.data;
      // console.log(resp);
      // return false;
      if (resp.status == "error") {
        alert(resp.message);
        return false;
      }

      // console.log('temp: ' + resp.template);
      if (edittype == "template") {
        $("#" + formid).html(resp.template);
        return false;
      }

      $.each(inputs, function(i, k) {
        var $inval = inputs[i].name;
        var tag_name = inputs[i].tag.toLowerCase();
        var typename = inputs[i].type;
        // console.log(tag_name + "" + $inval);
        var dbname = resp.data[$inval];

        if (tag_name !== "button") {
          if (typename == "checkbox") {
            if (dbname == "Y") {
              // $("input[value='" + val + "']").prop('checked', true);
              $(tag_name + "[name=" + inputs[i].name + "]").prop(
                "checked",
                true
              );
            } else {
              $(tag_name + "[name=" + inputs[i].name + "]").prop(
                "checked",
                false
              );
            }
          } else {
            // if ($('input[name="token"]')
            $(tag_name + "[name=" + inputs[i].name + "]")
              .not($('input[name="token"]'))
              .val(dbname);
          }
        }

        // setTimeout(function(){
        //     for(var i in CKEDITOR.instances){
        //         var ckname = CKEDITOR.instances[i].name;
        //         var ckvalue = CKEDITOR.instances[i].value;

        //         var editor = CKEDITOR.instances[i];

        //         editor.setData('');
        //         setTimeout(function(){
        //             CKEDITOR.instances[ckname].insertHtml(dbname);
        //         },200);
        //     }
        // },150);
      });
      $(".save").html('<i class="fa fa-dot-circle-o"> Update</i>');
    })
    .catch((error) => {
      console.log(error);
    });
});

// For Delete From List
$(document).off("click", ".btnDelete");
$(document).on("click", ".btnDelete", function() {
  var conf = confirm("Are Your Want to Sure to delete?");
  if (conf) {
    var deleteurl = $(this).data("url");
    var tableid = $(this).data("tableid");
    var id = $(this).data("id");
    if (tableid) {
      id = tableid;
    } else {
      id = id;
    }
    axios
      .post(deleteurl, { id: id })
      .then((response) => {
        var resp = response.data;
        // console.log(resp);
        // return false;
        if (resp.status == "error") {
          alert(resp.message);
          return false;
        }

        if (resp.status == "success") {
          $("#listid_" + id).fadeOut(1000, function() {
            $("#listid_" + id).remove();
          });
        } else {
          alert(response.data.message);
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }
});

//get report
$(document).off("click", ".searchReport");
$(document).on("click", ".searchReport", function() {
  var formid = $(".searchReport")
    .closest("form")
    .attr("id");

  var isvalid = check_form_validation(formid);

  if (isvalid == "fail") {
    return false;
  }
  var displayid = $(this).data("displayid");
  var displaydiv = "";

  if (displayid) {
    displaydiv = displayid;
  } else {
    displaydiv = "displayReportDiv";
  }
  var formurl = $(this).data("url");
  var action = formurl;
  var data = $("#" + formid).serialize();
  axios.post(action, data).then((response) => {
    var resp = response.data;
    if (resp.status == "success") {
      $("#" + displaydiv).html(resp.template);
    } else {
      $("#" + formid);
      $("#" + displaydiv).html(resp.message);
      return false;
    }
  });
  return false;
});

// On Enter Key Go Next Tab
$(document).on("keydown", "input, select, textarea", function(e) {
  var self = $(this),
    form = self.parents("form:eq(0)"),
    focusable,
    next;
  if (e.keyCode == 13) {
    var classname = this.className;
    // alert(classname);
    if (classname.indexOf("jump_to_add") > -1) {
      $(".btnAdd").focus();
      $(".btnAdd").click();
      return false;
    }
    focusable = form.find("input,a,select,button,textarea").filter(":visible");
    next = focusable.eq(focusable.index(this) + 1);
    if (next.length) {
      next.focus();
    } else {
      form.submit();
    }
    return false;
  }
});

//For Shortcut Key
$(document).bind("keydown", function(e) {
  // console.log(e.which);
  if (e.ctrlKey && e.which == 83) {
    // console.log(e.which);
    e.preventDefault();
    $(".save").click();
    return false;
  }
  if (e.which == 113) {
    // console.log(e.which);
    e.preventDefault();
    $(".savePrint").click();
    return false;
  }
  if (e.altKey && e.which == 82) {
    e.preventDefault();
    $(".btnRefresh").click();
    return false;
  }

  if (e.altKey && e.which == 80) {
    //Alt+P For Printing
    e.preventDefault();
    $(".PrintThisNow").click();
    return false;
  }
  if (e.altKey && e.which == 65) {
    //Alt+P For Printing
    e.preventDefault();
    $(".btnAdd").click();
    return false;
  }
});

$(document).off("click", ".btn_print");
$(document).on("click", ".btn_print", function() {
  $("#printrpt").printThis();
  $(".reportGeneration").hide();
  $("#tblwrapper").removeClass("table-wrapper");
  setTimeout(function() {
    $(".reportGeneration").show();
    $("#tblwrapper").addClass("table-wrapper");
  }, 1000);
});

$(document).off("keypress keydown", ".enterinput");
$(document).on("keypress keydown", ".enterinput", function(e) {
  var id = $(this).data("id");
  // console.log(id);
  // return false;
  var targetbtn = $(this).data("targetbtn");
  var keycode = e.keyCode ? e.keyCode : e.which;
  if (id) {
    if (keycode == "13") {
      $("#" + targetbtn + "_" + id).click();
    }
  } else {
    if (keycode == "13") {
      $("#" + targetbtn).click();
    }
  }
});

$(document).on("keyup paste", ".number", function() {
  this.value = this.value.replace(/[^0-9]/g, "");
});

$("body").on(
  "keydown keyup keypress change blur focus paste",
  ".float",
  function() {
    var target = $(this);

    var prev_val = target.val();

    setTimeout(function() {
      var chars = target.val().split("");

      var decimal_exist = false;
      var remove_char = false;

      $.each(chars, function(key, value) {
        switch (value) {
          case "0":
          case "1":
          case "2":
          case "3":
          case "4":
          case "5":
          case "6":
          case "7":
          case "8":
          case "9":
          case ".":
            if (value === ".") {
              if (decimal_exist === false) {
                decimal_exist = true;
              } else {
                remove_char = true;
                chars["" + key + ""] = "";
              }
            }
            break;
          default:
            remove_char = true;
            chars["" + key + ""] = "";
            break;
        }
      });

      if (prev_val != target.val() && remove_char === true) {
        target.val(chars.join(""));
      }
    }, 0);
  }
);

$(document).off("click", ".btnreset");
$(document).on("click", ".btnreset", function() {
  // e.preventDefault();
  var formid = $(".btnreset")
    .closest("form")
    .attr("id");
  $("#" + formid)
    .find(":input")
    .not(":button, :submit, :reset, :checkbox, :radio")
    .val("");
  $("#" + formid)
    .find(":checkbox, :radio")
    .prop("checked", false);
  $("#" + formid)
    .find("img")
    .hide();
  $(".save").html('<i class="fa fa-dot-circle-o"> Save</i>');
});

//modal
$(document).off("click", ".view");
$(document).on("click", ".view", function() {
  var id = $(this).data("id");
  var url = $(this).data("url");

  $("#myView").modal("show");
  $("#myView").addClass("show-modal");
  $("body").addClass("modal-open");

  $("#modal_head").html("");
  $("#modal_body").html("");

  axios
    .post(url, { id: id })
    .then((response) => {
      if (response.data.status == "success") {
        setTimeout(function() {
          $("#modal_head").html(response.data.title);
          $("#modal_body").html(response.data.template);
        }, 200);
      } else {
        setTimeout(function() {
          $("#modal_head").html(response.data.status);
          $("#modal_body").html(response.data.message);
        }, 200);
      }
    })
    .catch((error) => {
      console.log(error);
    });
});
$(document).off("click", ".close-button");
$(document).on("click", ".close-button", function(event) {
  event.preventDefault();
  $("body").removeClass("modal-open");
  // alert('clicked');
  $("#myView").css("display", "none");
});
$(document).off("click", ".modalclose_btn");
$(document).on("click", ".modalclose_btn", function(event) {
  event.preventDefault();
  $("body").removeClass("modal-open");
  // alert('clicked');
  $("#myView").css("display", "none");
});
$(document).off("click", ".nav-link");
$(document).on("click", ".nav-link", function() {
  // alert("test");
  var href = $(this).attr("href");
  $("#menu_tab").html("");
  // return false;
  // load_menu_tab(href);
});

// setTimeout(function() {
//   load_menu_tab();
// }, 2000);

$(document).off("click", "#chang_pass");
$(document).on("click", "#chang_pass", function() {
  $("#password").val("");
  $("#change_password").html(
    '<div class="dis_tab"><input name="password" type="password" autocomplete="false" class="form-control" id="password" size="30" /><span id="ChangeResponse"></span> <div style="margin-bottom: 0px; padding-bottom:0;" class="table-cell"><input class="p_change" type="button" name="Submit" value="Change" id="changed"  /></div></div>'
  );
});

$(document).off("click", ".generate_export_file");
$(document).on("click", ".generate_export_file", function() {
  var dataurlLink = $(this).data("dataurl");
  var moduleLocation = $(this).data("location");
  var tableid = $(this).data("tableid");
  var type = $(this).data("type");
  // alert(base_url);
  // return false;
  if (type == "excel") {
    window.location =
      base_url +
      moduleLocation +
      "/?" +
      $.param(
        $(tableid)
          .DataTable()
          .ajax.params()
      );
  } else if (type == "pdf") {
    window.open(
      base_url +
        moduleLocation +
        "/?" +
        $.param(
          $(tableid)
            .DataTable()
            .ajax.params()
        ),
      "_blank"
    );
  }
});
// $('.mobile_down_arrow').click(function(){
//   alert('clicked');
// });
$(document).off("click", ".toggle_header ");
$(document).on("click", ".toggle_header", function(event) {
  event.preventDefault();
  $(".companyinfo").toggleClass("show_mb_menu", 3000);
  $(".user_meta").toggleClass("show_mb_menu", 3000);
});
$(document).ready(function() {
  if ($(window).width() < 767) {
    $(".navbar-toggler").click(function(event) {
      event.preventDefault();
      $(".sidebar").toggleClass("mbl_menu");
    });
  }
});
$(document).off("click", ".nav-link");
$(document).on("click", ".nav-link", function() {
  // alert('clicked');
  $(".sidebar").removeClass("mbl_menu");
});
$(document).off("click", ".nav-dropdown-toggle");
$(document).on("click", ".nav-dropdown-toggle", function() {
  $(".sidebar").addClass("mbl_menu");
  // alert('clicked');
  $(".mobile_menu").toggleClass("show_mb_menu", 3000);
});

$(document).off("dblclick", ".loading-indicator");
$(document).on("dblclick", ".loading-indicator", function() {
  // alert('ter');
  document.body.classList.remove("loading-indicator");
});

$(document).off("change blur", ".number_to_word");
$(document).on("change blur", ".number_to_word", function(e) {
  // alert('tes');
  // return false;
  var targetdiv = $(this).data("targetdiv");
  var num = $(this).val();
  var posturl = "api/common/num_to_word";
  if (num > 0) {
    axios
      .post(posturl, { num: num })
      .then((response) => {
        var resp = response.data;
        // console.log(resp);
        // return false;
        if (resp.status == "error") {
          alert(resp.message);
          return false;
        }

        if (resp.status == "success") {
          $("." + targetdiv).html(resp.template);
        } else {
          alert(response.data.message);
        }
      })
      .catch((error) => {
        console.log(error);
      });
  } else {
    $("." + targetdiv).html("");
  }
});

$(document).off("change", "#type_id");
$(document).on("change", "#type_id", function(e) {
  // alert("test");
  var type = $(this).val();
  if (type == "1" || type == "2" || type == "3") {
    $(".cat_name").show();
  } else {
    $(".cat_name").hide();
  }
});

$(document).off("change", "#filter_date");
$(document).on("change", "#filter_date", function(e) {
  var ftype = $(this).val();
  // alert(ftype);
  if (ftype == "range") {
    // alert("test");
    $(".customopt").show();
  } else {
    $(".customopt").hide();
  }
});

$(document).off("click", ".btn_generate_pdf");
$(document).on("click", ".btn_generate_pdf", function(e) {
  e.preventDefault();
  var href = $(this).data("href");
  var formid = $(this).data("formid");
  var postdata = null;
  if (formid) {
    postdata = $("form#" + formid).serialize();
  }

  window.open(href + "/?" + postdata, "_blank");
});
