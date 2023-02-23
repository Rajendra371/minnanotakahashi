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
      } else {
        this.setState({ payment_method: [] });
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
                  <CardTitle>Product Order List</CardTitle>
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
                          id="frmDate"
                          className="datepicker"
                          placeholder="YYYY-MM-DD"
                          name="frmDate"
                        />
                      </Col>
                      {this.state.date_range == "range" ? (
                        <Col md="2" sm="6" xs="12">
                          <label>To Date</label>
                          <input
                            type="text"
                            id="toDate"
                            className="datepicker"
                            placeholder="YYYY-MM-DD"
                            name="toDate"
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
                          <label>Order Status</label>
                          <Input
                            type="select"
                            name="order_status"
                            id="order_status"
                            className=""
                          >
                            <option value="">-- All --</option>
                            <option value="O">Ordered</option>
                            <option value="CO">Confirmed</option>
                            <option value="C">Cancelled</option>
                          </Input>
                        </div>
                      </Col>

                      <div className="col-md-2 col-sm-6 align-self-end mt-4">
                        <a
                          href="javascript:void(0)"
                          className="btn btn-info main-btn"
                          id="searchByDate"
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
                        Ordered <span id="ordered" style={{ color: "#fff" }} />
                      </a>

                      <a
                        href="javascript:void(0)"
                        className="btn btn-md btn-success"
                      >
                        Confirmed{" "}
                        <span id="confirmed" style={{ color: "#fff" }} />
                      </a>

                      <a
                        href="javascript:void(0)"
                        className="btn btn-md btn-danger"
                      >
                        Cancelled{" "}
                        <span id="cancelled" style={{ color: "#fff" }} />
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
                          className="order_list"
                          defaultValue="A"
                        >
                          All
                        </Input>
                      </th>
                      <th width="10%">Date</th>
                      <th width="10%">Customer Name</th>
                      <th width="10%">Address</th>
                      <th width="10%">Mobile No</th>
                      <th width="10%">Order Id</th>
                      <th width="5%">Total Items</th>
                      <th width="15%">Payment Method</th>
                      <th width="5%">Currency</th>
                      <th width="15%">Grand Total</th>
                      <th width="10%">Status</th>
                      <th width="10%">Action</th>
                    </tr>
                  </thead>
                  <tbody />
                </table>
                <div className="d-flex justify-content-center">
                  <a
                    href="javascript:void(0)"
                    className="btn btn-sm btn-primary"
                    id="order_approve"
                    style={{ display: "none" }}
                  >
                    Confirm Order
                  </a>
                  <a
                    href="javascript:void(0)"
                    className="btn btn-sm btn-danger"
                    id="order_cancel"
                    style={{ display: "none" }}
                  >
                    Cancel Order
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

function search_order_status(
  date_range,
  frmDate,
  toDate,
  payment_method,
  order_status
) {
  var url = constvar.api_url + "product_order/get_order_status";
  axios
    .post(url, {
      frmDate: frmDate,
      toDate: toDate,
      date_range: date_range,
      payment_method: payment_method,
      order_status: order_status,
    })
    .then((response) => {
      if (response.data.status == "success") {
        $("#ordered").html(response.data.orderedcnt);
        $("#confirmed").html(response.data.confirmedcnt);
        $("#cancelled").html(response.data.cancelledcnt);
      } else {
        $("#ordered").html("0");
        $("#confirmed").html("0");
        $("#cancelled").html("0");
      }
    });
}

function load_table_data() {
  $(".order_list").removeClass("form-check-input");
  var date_range = $("#date_range").val();
  var payment_method = $("#payment_method").val();
  var frmDate = $("#frmDate").val();
  var toDate = $("#toDate").val();
  var order_status = $("#order_status").val();

  var dataurl = constvar.api_url + "product_order/product_order_list";
  var message = "";
  message = "<p class='text-danger'>No Record Found!! </p>";
  search_order_status(date_range, frmDate, toDate, payment_method);
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
        { data: "checkout_datead" },
        { data: "customer_name" },
        { data: "address" },
        { data: "mobile_no" },
        { data: "orderno" },
        { data: "total_items" },
        { data: "payment_method" },
        { data: "currency" },
        { data: "grand_total" },
        { data: "status" },
        { data: "action" },
      ],

      fnServerParams: function(aoData) {
        aoData.push({ name: "date_range", value: date_range });
        aoData.push({ name: "frmDate", value: frmDate });
        aoData.push({ name: "toDate", value: toDate });
        aoData.push({ name: "payment_method", value: payment_method });
        aoData.push({ name: "order_status", value: order_status });
      },

      fnRowCallback: function(nRow, aData, iDisplayIndex) {
        var oSettings = dtablelist.fnSettings();
        var id = aData.id;
        var status = aData.order_status;
        if (status == "O") {
          $("td:first", nRow).html(
            '<input type="checkbox" class="ordered" name="checkout_id[]" value=' +
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
        { type: "text" },
        { type: null },
        { type: "text" },
        { type: null },
        { type: null },
        { type: null },
        { type: null },
      ],
    });
  $(document).off("click", "#searchByDate");
  $(document).on("click", "#searchByDate", function() {
    date_range = $("#date_range").val();
    payment_method = $("#payment_method").val();
    order_status = $("#order_status").val();
    frmDate = $("#frmDate").val();
    toDate = $("#toDate").val();
    dtablelist.fnDraw();
    search_order_status(
      date_range,
      frmDate,
      toDate,
      payment_method,
      order_status
    );
  });
}

$(document).off("click", ".order_list");
$(document).on("click", ".order_list", function(e) {
  if (this.checked) {
    $(".ordered").each(function() {
      this.checked = true;
      $("#order_approve").show();
      $("#order_cancel").show();
    });
  } else {
    $(".ordered").each(function() {
      this.checked = false;
      $("#order_approve").hide();
      $("#order_cancel").hide();
    });
  }
});

$(document).off("click", "#order_approve,#order_cancel");
$(document).on("click", "#order_approve,#order_cancel", function(e) {
  let action = e.target.id;
  let message = "";
  let status = "";
  if (action == "order_approve") {
    message = "Confirm These Order ?";
    status = "CO";
  } else if (action == "order_cancel") {
    message = "Cancel These Order ?";
    status = "C";
  }

  let conf = confirm(message);
  if (conf) {
    let ch_id = [];
    $.each($("input[name='checkout_id[]']:checked"), function() {
      ch_id.push($(this).val());
    });
    let url = constvar.api_url + "product_order/change_order_status";
    axios.post(url, { ch_id: ch_id, status: status }).then((response) => {
      if (response.data.status == "success") {
        $("#searchByDate").click();
      } else {
        $("#searchByDate").click();
      }
    });
  }
});

$(document).off("click", ".ordered");
$(document).on("click", ".ordered", function(e) {
  if (this.checked) {
    this.checked = true;
    $("#order_approve").show();
    $("#order_cancel").show();
  } else {
    var check = $(".ordered:checkbox").filter(":checked");
    this.checked = false;
    if (check.length >= 1) {
      $("#order_approve").show();
      $("#order_cancel").show();
    } else {
      $("#order_approve").hide();
      $("#order_cancel").hide();
    }
  }
});
