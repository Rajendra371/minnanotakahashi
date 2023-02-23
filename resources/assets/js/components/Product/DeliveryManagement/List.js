import React, { Component } from "react";

export default class List extends Component {
  constructor() {
    load_datepicker();
    setTimeout(function() {
      load_table_data();
    }, 1000);
    super();
    this.state = {
      payment_method: [],
      delivery_person: [],
      data: [],
      loading: false,
      pages: 0,
      date_range: "daily",
    };
  }
  componentDidMount() {
    axios.get(constvar.api_url + "product_order_data").then((response) => {
      if (response.data.status == "success") {
        this.setState({ payment_method: response.data.data["payment_method"] });
        this.setState({
          delivery_person: response.data.data["delivery_person"],
        });
      } else {
        this.setState({ payment_method: [] });
        this.setState({ delivery_person: [] });
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
                  <CardTitle>Order Delivery List</CardTitle>
                  <button className="btnRefresh" id="btnRefresh">
                    <i className="fa fa-refresh" aria-hidden="true" />
                  </button>
                </CardHeader>
                <div className="search_box">
                  <Form className="form">
                    <div className="row">
                      <Col md="2" sm="6" xs="12">
                        <div className="">
                          <label>Date Range</label>
                          <Input
                            type="select"
                            name="date_range"
                            id="date_range"
                            value={this.state.date_range}
                            onChange={(e) => {
                              this.setState({ date_range: e.target.value });
                              if (e.target.value == "range") {
                                load_datepicker();
                              }
                            }}
                          >
                            <option value="daily">Daily</option>
                            <option value="range">Range</option>
                          </Input>
                        </div>
                      </Col>
                      <Col md="2" sm="6" xs="12">
                        <label>
                          {this.state.date_range == "daily"
                            ? "Date"
                            : "From Date"}
                        </label>
                        <input
                          type="text"
                          id="from_date"
                          className="datepicker"
                          placeholder="YYYY-MM-DD"
                          name="from_date"
                        />
                      </Col>
                      {this.state.date_range == "range" ? (
                        <Col md="2" sm="6" xs="12">
                          <label>To Date</label>
                          <input
                            type="text"
                            id="to_date"
                            className="datepicker"
                            placeholder="YYYY-MM-DD"
                            name="to_date"
                          />
                        </Col>
                      ) : null}

                      <Col md="2" sm="6" xs="12">
                        <div className="">
                          <label>Payment Method</label>
                          <Input
                            type="select"
                            name="payment_method"
                            id="payment_method"
                            className=""
                          >
                            <option value="">-- All --</option>
                            {this.state.payment_method.length > 0
                              ? this.state.payment_method.map((pay) => {
                                  return (
                                    <option key={pay.id} value={pay.id}>
                                      {pay.payment_name}
                                    </option>
                                  );
                                })
                              : ""}
                          </Input>
                        </div>
                      </Col>
                      <Col md="2" sm="6" xs="12">
                        <div className="">
                          <label>Delivery Status</label>
                          <Input
                            type="select"
                            name="delivery_status"
                            id="delivery_status"
                            className=""
                          >
                            <option value="">-- All --</option>
                            <option value="N">Pending</option>
                            <option value="Y">Delivered</option>
                          </Input>
                        </div>
                      </Col>

                      <div className="col-md-2 col-sm-6 align-self-end mt-4">
                        <a
                          href="javascript:void(0)"
                          className="btn btn-info main-btn"
                          id="searchDeliveryList"
                        >
                          <i className="fa fa-search" aria-hidden="true" />
                          &nbsp;&nbsp; Search
                        </a>
                      </div>
                    </div>
                  </Form>
                </div>
                <div className="row">
                  <div className="col-md-12 mt-2">
                    <div className="white-box pad-5 noborder d-flex justify-content-around">
                      <a
                        href="javascript:void(0)"
                        className="btn btn-md btn-warning"
                        style={{ color: "#fff" }}
                      >
                        Pending <span id="pending" style={{ color: "#fff" }} />
                      </a>

                      <a
                        href="javascript:void(0)"
                        className="btn btn-md btn-success"
                      >
                        Delivered{" "}
                        <span id="delivered" style={{ color: "#fff" }} />
                      </a>
                    </div>
                  </div>
                </div>

                <table id="myTable" className="table table-striped">
                  <thead>
                    <tr>
                      <th width="5%">
                        <Input
                          type="checkbox"
                          className="delivery_list"
                          defaultValue="A"
                        >
                          All
                        </Input>
                      </th>
                      <th width="10%">Date</th>
                      <th width="10%">Customer Name</th>
                      <th width="10%">Mobile No</th>
                      <th width="10%">Order Id</th>
                      <th width="5%">Total Items</th>
                      <th width="10%">Payment Method</th>
                      <th width="5%">Currency</th>
                      <th width="10%">Grand Total</th>
                      <th width="10%">Shipping Address</th>
                      <th width="10%">Delivery Status</th>
                      <th width="10%">Delivery Assigned ?</th>
                      <th width="10%">Assigned User</th>
                      <th width="10%">Action</th>
                    </tr>
                  </thead>
                  <tbody />
                </table>
                <div className="d-flex justify-content-center mb-4">
                  <div id="assign_form" style={{ display: "none" }}>
                    <Input
                      type="select"
                      name="assign_userid"
                      id="assign_userid"
                      className=""
                    >
                      <option value="">-- select delivery person --</option>
                      {this.state.delivery_person.length > 0
                        ? this.state.delivery_person.map((dp) => (
                            <option value={dp.id} key={dp.id}>{`${
                              dp.first_name
                            } ${dp.last_name}`}</option>
                          ))
                        : ""}
                    </Input>
                  </div>
                  <a
                    href="javascript:void(0)"
                    className="btn btn-sm btn-primary"
                    id="assign_deliver"
                    style={{ display: "none" }}
                  >
                    Assign Person For Deliver
                  </a>
                  <a
                    href="javascript:void(0)"
                    className="btn btn-sm btn-success"
                    id="delivery_completed"
                    style={{ display: "none" }}
                  >
                    Delivery Completed
                  </a>
                </div>
              </Card>
            </Col>
          </Row>
        </div>
      </div>
    );
  }
}

function search_delivery_status(
  date_range,
  from_date,
  to_date,
  payment_method,
  delivery_status
) {
  var url = constvar.api_url + "deliver_order/get_delivery_status";
  axios
    .post(url, {
      frmDate: from_date,
      toDate: to_date,
      date_range: date_range,
      payment_method: payment_method,
      delivery_status: delivery_status,
    })
    .then((response) => {
      if (response.data.status == "success") {
        $("#pending").html(response.data.pendingcnt);
        $("#delivered").html(response.data.deliveredcnt);
      } else {
        $("#pending").html("0");
        $("#delivered").html("0");
      }
    });
}

function load_table_data() {
  $(".delivery_list").removeClass("form-check-input");
  var date_range = $("#date_range").val();
  var payment_method = $("#payment_method").val();
  var from_date = $("#from_date").val();
  var to_date = $("#to_date").val();
  var delivery_status = $("#delivery_status").val();

  var dataurl = constvar.api_url + "deliver_order/delivery_list";
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";
  search_delivery_status(
    date_range,
    from_date,
    to_date,
    payment_method,
    delivery_status
  );
  var dtablelist = $("#myTable")
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
        });
      },
      oLanguage: {
        sEmptyTable: message,
      },
      aoColumnDefs: [
        {
          bSortable: false,
          aTargets: [0],
        },
      ],

      aoColumns: [
        { data: null },
        { data: "date" },
        { data: "customer_name" },
        { data: "mobile_no" },
        { data: "orderno" },
        { data: "total_items" },
        { data: "payment_method" },
        { data: "currency" },
        { data: "grand_total" },
        { data: "shipping_address" },
        { data: "status" },
        { data: "delivery_assign" },
        { data: "assign_user" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        aoData.push({ name: "date_range", value: date_range });
        aoData.push({ name: "frmDate", value: from_date });
        aoData.push({ name: "toDate", value: to_date });
        aoData.push({ name: "payment_method", value: payment_method });
        aoData.push({ name: "delivery_status", value: delivery_status });
      },

      fnRowCallback: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        var id = aData.id;
        var status = aData.delivery_assign;
        if (status == "No") {
          $("td:first", nRow).html(
            '<input type="checkbox" class="delivery_item" name="checkout_id[]" value=' +
              id +
              ">"
          );
        } else {
          $("td:first", nRow).html("");
        }
        // $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
        return nRow;
      },

      fnCreatedRow: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        var tblid = oSettings._iDisplayStart + iDisplayIndex + 1;
        var st_style = aData.st_style;
        $(nRow).attr("id", "listid_" + tblid);
        $(nRow).attr("style", st_style);
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
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
      ],
    });
  $(document).off("click", "#searchDeliveryList");
  $(document).on("click", "#searchDeliveryList", function() {
    date_range = $("#date_range").val();
    payment_method = $("#payment_method").val();
    delivery_status = $("#delivery_status").val();
    from_date = $("#from_date").val();
    to_date = $("#to_date").val();
    dtablelist.fnDraw();
    search_delivery_status(
      date_range,
      from_date,
      to_date,
      payment_method,
      delivery_status
    );
  });
}

$(document).off("click", ".delivery_list");
$(document).on("click", ".delivery_list", function(e) {
  if (this.checked) {
    $(".delivery_item").each(function() {
      this.checked = true;
      $("#assign_deliver").show();
      $("#assign_form").show();
    });
  } else {
    $(".delivery_item").each(function() {
      this.checked = false;
      $("#assign_deliver").hide();
      $("#assign_form").hide();
    });
  }
});

$(document).off("click", "#assign_deliver");
$(document).on("click", "#assign_deliver", function(e) {
  let assign_userid = $("#assign_userid").val();
  if (
    assign_userid == null ||
    assign_userid == undefined ||
    assign_userid == ""
  ) {
    $("#assign_userid").focus();
    return false;
  }
  let conf = confirm("Assign Delivery ?");
  if (conf) {
    let ch_id = [];
    $.each($("input[name='checkout_id[]']:checked"), function() {
      ch_id.push($(this).val());
    });

    let url = constvar.api_url + "deliver_order/assign_user_to_deliver_order";
    axios
      .post(url, { ch_id: ch_id, assign_userid: assign_userid })
      .then((response) => {
        if (response.data.status == "success") {
          $("#searchDeliveryList").click();
        } else {
          $("#searchDeliveryList").click();
        }
      });
  }
});

$(document).off("click", ".delivery_item");
$(document).on("click", ".delivery_item", function(e) {
  if (this.checked) {
    this.checked = true;
    $("#assign_deliver").show();
    $("#assign_form").show();
  } else {
    var check = $(".delivery_item:checkbox").filter(":checked");
    this.checked = false;
    if (check.length >= 1) {
      $("#assign_deliver").show();
      $("#assign_form").show();
    } else {
      $("#assign_deliver").hide();
      $("#assign_form").hide();
    }
  }
});

$(document).off("click", ".deliver_stat_id");
$(document).on("click", ".deliver_stat_id", function(e) {
  if (this.checked) {
    this.checked = true;
    $("#delivery_completed").show();
  } else {
    var check = $(".deliver_stat_id:checkbox").filter(":checked");
    this.checked = false;
    if (check.length >= 1) {
      $("#delivery_completed").show();
    } else {
      $("#delivery_completed").hide();
    }
  }
});

$(document).off("click", "#delivery_completed");
$(document).on("click", "#delivery_completed", function(e) {
  let conf = confirm("Change Delivery Status ?");
  if (conf) {
    let del_id = [];
    $.each($("input[name='deliver_id[]']:checked"), function() {
      del_id.push($(this).val());
    });

    let url =
      constvar.api_url + "deliver_order/change_delivery_status_completed";
    axios.post(url, { del_id: del_id }).then((response) => {
      if (response.data.status == "success") {
        $("#searchDeliveryList").click();
      } else {
        $("#searchDeliveryList").click();
      }
    });
  }
});
