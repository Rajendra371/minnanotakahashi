jQuery(function($) {
  "use strict";

  // -------------------------------------------------------------
  //  Placeholder
  // -------------------------------------------------------------

  (function() {
    var textAreas = document.getElementsByTagName("textarea");

    Array.prototype.forEach.call(textAreas, function(elem) {
      elem.placeholder = elem.placeholder.replace(/\\n/g, "\n");
    });
  })();

  // -------------------------------------------------------------
  // Accordion
  // -------------------------------------------------------------

  $(document).ready(function() {
    $(".collapse")
      .on("shown.bs.collapse", function() {
        $(this)
          .parent()
          .find(".glyphicon-plus")
          .removeClass("glyphicon-plus")
          .addClass("glyphicon-minus");
      })
      .on("hidden.bs.collapse", function() {
        $(this)
          .parent()
          .find(".glyphicon-minus")
          .removeClass("glyphicon-minus")
          .addClass("glyphicon-plus");
      });
  });

  // -------------------------------------------------------------
  //  Checkbox Icon Change
  // -------------------------------------------------------------

  (function() {
    $('input[type="checkbox"]').change(function() {
      if ($(this).is(":checked")) {
        $(this)
          .parent("label")
          .addClass("checked");
      } else {
        $(this)
          .parent("label")
          .removeClass("checked");
      }
    });
  })();

  // -------------------------------------------------------------
  //  select-category Change
  // -------------------------------------------------------------
  $(".select-category.post-option ul li a").on("click", function() {
    $(".select-category.post-option ul li.link-active").removeClass(
      "link-active"
    );
    $(this)
      .closest("li")
      .addClass("link-active");
  });

  $(".subcategory.post-option ul li a").on("click", function() {
    $(".subcategory.post-option ul li.link-active").removeClass("link-active");
    $(this)
      .closest("li")
      .addClass("link-active");
  });

  // -------------------------------------------------------------
  //  brand image slide
  // -------------------------------------------------------------

  // -------------------------------------------------------------
  //  for language show
  // -------------------------------------------------------------
  $(".log-reg .toggler").on("click", function(event) {
    event.preventDefault();
    $(this)
      .closest(".log-reg")
      .toggleClass("opened");
  });

  // script end
  $(document).off("click", ".save");
  $(document).on("click", ".save", function(e) {
    e.preventDefault();
    const button = $(this);
    this.disabled = true;
    var formid = $(this)
      .closest("form")
      .attr("id");
    var action = $("#" + formid).attr("action");
    var data = new FormData($("form#" + formid)[0]);

    axios
      .post(action, data)
      .then((response) => {
        var msg = response.data.message;
        if (response.data.status == "success") {
          $("#" + formid)
            .find(".form-messages")
            .html(msg);
          $("#" + formid)
            .find(".form-messages")
            .addClass("alert alert-success");
          setTimeout(() => {
            $(`#${formid}`).trigger("reset");
          }, 200);
        } else {
          if (!Array.isArray(msg)) {
            msg = [msg];
          }
          var errmsg = "";
          $.each(msg, function(key, value) {
            errmsg += "<li>" + value + "</li>";
          });
          $("#" + formid)
            .find(".form-messages")
            .html(errmsg);
          $("#" + formid)
            .find(".form-messages")
            .addClass("alert alert-danger");
        }
        setTimeout(function() {
          button.prop("disabled", false);
          $("#" + formid)
            .find(".form-messages")
            .html("");
          $("#" + formid)
            .find(".form-messages")
            .removeClass("alert alert-success alert-danger");
        }, 3000);
        if (response.data.redirect) {
          window.location.href = response.data.redirect;
        }
      })
      .catch((error) => {
        $("#" + formid)
          .find(".error")
          .html("Error: System error please refresh the browser");
        $("#" + formid)
          .find(".error")
          .addClass("alert alert-danger");
        console.log(error);
        this.disabled = false;
      });
  });

  //Open Modal
  $(document).off("click", ".btnModal");
  $(document).on("click", ".btnModal", function() {
    var id = $(this).data("id");
    var url = $(this).data("url");

    $("#commonModal").modal("show");
    $("#commonModal").addClass("show-modal");
    $("body").addClass("modal-open");
    $("#commonModalTitle").html("");
    $("#commonModalBody").html("");
    axios
      .post(url, { id: id })
      .then((response) => {
        if (response.data.status == "success") {
          setTimeout(function() {
            $("#commonModalTitle").html(response.data.title);
            $("#commonModalBody").html(response.data.template);
          }, 100);
        } else {
          setTimeout(function() {
            $("#commonModalTitle").html(response.data.status);
            $("#commonModalBody").html(response.data.message);
          }, 100);
        }
      })
      .catch((error) => {
        $("#commonModalTitle").html("Error");
        $("#commonModalBody").html("An error occured while fetching data");
      });
  });

  $(document).off("click", ".btnRefresh");
  $(document).on("click", ".btnRefresh", function() {
    let divId = $(this).data("id");
    let loadDatatable = $(this).data("load_datatable");
    let tableId = $(this).data("table_id");
    let url = $(this).data("url");
    axios
      .get(url)
      .then((response) => {
        if (response.data.status == "success") {
          setTimeout(function() {
            $(`#${divId}`).html(response.data.template);
          }, 50);
          if (loadDatatable == "Y") {
            setTimeout(() => {
              $(`#${tableId}`).DataTable();
            }, 50);
          }
        } else {
          setTimeout(function() {
            $(`#${divId}`).html(response.data.message);
          }, 50);
        }
      })
      .catch((error) => {
        console.log(error);
      });
  });
});
