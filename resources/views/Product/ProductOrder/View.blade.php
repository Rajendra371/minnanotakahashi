<div class="form-group general_info white-box pad-5">
    @if(!empty($data['master']))
    @php
        $master = $data['master'];
        $style = '';
        $status = $master->status;
        if($status=='O'){
            $style='color:#ff9600';
        } 
        else if($status=='CO'){
            $style='color:#0b920b';
        }
        else if($status=='C'){
            $style='color:#ff0800';
        }
    @endphp
    <div>
       <h5 class="form_title">Product Order Detail</h5>
    </div>
    <div class="row" style="{{$style}}">
       <div class="col-md-3 col-sm-3">
          <label>Order ID :</label>
          <span>{{$master->orderno}}</span>
       </div>
       <div class="col-md-3 col-sm-3">
         <label>Order Date:</label>
         <span>{{$master->checkout_datead}}</span>
      </div>
      <div class="col-md-3 col-sm-3">
         <label>Order Time :</label>
         <span>{{$master->checkout_time}}</span>
      </div>
      <div class="col-md-3 col-sm-3">
        <label>Customer Name:</label>
      <span>{{!empty($master->user_name) ? $master->user_name : $master->guest_name }}</span>
     </div>
      <div class="col-md-3 col-sm-3">
         <label>Address:</label>
         <span>{{$master->ship_str_address}}</span>
      </div>
      <div class="col-md-3 col-sm-3">
         <label>Mobile No :</label>
         <span>{{!empty($master->usr_mobile) ? $master->usr_mobile : $master->guest_mobile}}</span>
      </div>
      <div class="col-md-3 col-sm-3">
         <label>Total Items :</label>
         <span>{{$master->total_product}}</span>
      </div>
      <div class="col-md-3 col-sm-3">
         <label>Grand Total:</label>
         <span>{{$master->grand_totalamt}}</span>
      </div>
  
      <div class="col-md-3 col-sm-3">
         <label>Payment Method:</label>
         <span>{{$master->payment_name}}</span>
      </div>
      <div class="col-md-3 col-sm-3">
         <label>Status:</label>
         <span>{{$master->order_status}}</span>
      </div>
      <div class="col-md-3 col-sm-3">
         @if ($status == 'O')
             <a href="javascript:void(0)" id="ord_app" data-id={{$master->id}} class="btn btn-sm btn-primary">Approve</a>
             &nbsp;&nbsp;
             <a href="javascript:void(0)" id="ord_can" data-id={{$master->id}} class="btn btn-sm btn-danger">Cancel</a>
         @endif
      </div>
      <div class="col-md-3 col-sm-3">
            <a href="javascript:void(0)" id="print_order" data-id={{$master->id}} class="btn btn-sm btn-primary">Print Order</a>
     </div> 
       @endif

       @if(!empty($data['details']))
       <table class="table">
        <thead>
            <tr>
                <th><input type="checkbox" class="detail_list" value="A"></th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['details'] as $ind=>$det)
           @php
                $style="";
               if($det->status == "C"){
                $style = "background:#ec7272";
               }
           @endphp
            <tr style={{$style}}>
                    <td>
                        @if ( $det->status == "CO")
                            <input type="checkbox" name="det_id[]" class="det_item" value="{{$det->id}}">
                        @endif
                    </td>
                    <td>{{$det->product_code}}</td>
                    <td>{{$det->product_title}}</td>
                    <td> 
                        <ul>
                            <li>
                                Color: {{$det->color_name}}
                            </li>
                            <li>
                                Material : {{$det->material_name}}
                            </li>
                            <li>
                                Shape : {{$det->shape_name}}
                            </li>
                        </ul> 
                    </td>
                    <td><img src='{{asset("uploads/product_image/$det->image")}}' alt="MeroRug Carpet" height="50px" width="100px"></td>
                    <td>{{$det->qty}}</td>
                    <td>{{$det->rate}}</td>
                    <td>{{$det->total_amt}}</td>
                </tr>
            @endforeach
            <tfoot>
                <tr>
                    <th colspan="7">Grand Total</th>
                <th >{{ number_format($master->grand_totalamt,2)}}</th>
                </tr>
                <tr>
                    <th colspan="8">
                        <a
                        href="javascript:void(0)"
                        class="btn btn-sm btn-danger"
                        id="cancel_item"
                        style="display:none" 
                      >
                        Cancel Item
                      </a>
                    </th>
                </tr>
            </tfoot>
        </tbody>
       </table>
       @endif
    </div>
    <div class="printTable" style="display: none">
      <div class="print_report_section"></div>
    </div>
<script>
$(document).off("click", "#ord_app,#ord_can");
$(document).on("click", "#ord_app,#ord_can", function(e) {
  let action = e.target.id;
  let message = "";
  let status = "";
  if (action == "ord_app") {
    message = "Confirm Order ?";
    status = "CO";
  } else if (action == "ord_can") {
    message = "Cancel Order ?";
    status = "C";
  }

  let conf = confirm(message);
  if (conf) {
    let ch_id = [$(this).data('id')];
    // console.log("id",ch_id);
    // return false;
    let url = constvar.api_url + "product_order/change_order_status";
    axios.post(url, { ch_id: ch_id, status: status }).then((response) => {
      if (response.data.status == "success") {
        $("#searchByDate").click();
        $("#myView").css("display", "none");
    } else {
        $("#searchByDate").click();
        $("#myView").css("display", "none");
      }
    });
  }
});

$(document).off("click", ".detail_list");
$(document).on("click", ".detail_list", function(e) {
  if (this.checked) {
    $(".det_item").each(function() {
      this.checked = true;
      $("#cancel_item").show();
    });
  } else {
    $(".det_item").each(function() {
      this.checked = false;
      $("#cancel_item").hide();
    });
  }
});

$(document).off("click", "#cancel_item");
$(document).on("click", "#cancel_item", function(e) {
  let action = e.target.id;
  let message = "";
  let status = "";
  if (action == "item_approve") {
    message = "Confirm These Order ?";
    status = "CO";
  } else if (action == "cancel_item") {
    message = "Cancel These Item ?";
    status = "C";
  }

  let conf = confirm(message);
  if (conf) {
    let ch_id = [];
    $.each($("input[name='det_id[]']:checked"), function() {
      ch_id.push($(this).val());
    });
    let url = constvar.api_url + "product_order/change_item_status";
    axios.post(url, { ch_id: ch_id, status: status }).then((response) => {
      if (response.data.status == "success") {
        $("#searchByDate").click();
      } else {
        $("#searchByDate").click();
      }
    });
  }
});

$(document).off("click", ".det_item");
$(document).on("click", ".det_item", function(e) {
  if (this.checked) {
    this.checked = true;
    $("#cancel_item").show();
  } else {
    var check = $(".det_item:checkbox").filter(":checked");
    this.checked = false;
    if (check.length >= 1) {
      $("#cancel_item").show();
    } else {
      $("#cancel_item").hide();
    }
  }
});

$(document).off("click", "#print_order");
$(document).on("click", "#print_order", function(e) {
 let orderId = $('#print_order').data('id');
 console.log('order_ID:',orderId);
 axios.get(`api/product_order_print/${orderId}/Y`).then(res => {
   if(res.data.status == 'success'){
    $(".printTable").show();
    var printrpt = res.data.template;
    $(".print_report_section").html(printrpt);
    setTimeout(function() {
      $(".printTable").printThis();
    }, 500);
    setTimeout(function() {
      $(".printTable").hide();
      $(".print_report_section").html("");
    }, 2000);
   }else{
     console.log('Error');
   }
 })
});
</script>

   
      