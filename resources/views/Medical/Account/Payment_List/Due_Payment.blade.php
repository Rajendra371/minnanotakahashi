<style>
        .cash , .credit{
        display:none;
        }
     </style>
     <form method="post" class="form-horizontal" id="due_paymentForm" action="api/payment_list/store">
        @if(!empty($data))
        <input
           type="hidden"
           name="id"
           id="id"
           value="{{$data[0]->id}}"
           />
        @endif
        <div class="payment_wrapper">
           <h5 class="navtab_header">Due Amount Detail</h5>
           <div class="mobile_table">
              <table id="account_table" class="pop-distribution reportTable">
                 <thead>
                    <tr>
                       <th width="5%">S.N</th>
                       <th width="15%">Amount</th>
                       <th width="15%">Paid</th>
                       <th width="10%">Due Balance</th>
                       <th width="15%">Date</th>
                    </tr>
                 </thead>
                 @if(!empty($data))
                 <tbody>
                    @php($i=1)
                    @foreach($data as $key=>$row)
                    <tr>
                       <td>{{$i}}</td>
                       <td>{{!empty($row->person_due_amount)?$row->person_due_amount:''}}</td>
                       <td>{{!empty($row->person_paid_amount)?$row->person_paid_amount:''}}
                          </td>
                       <td><input
                          type="text"
                          name='balance'
                          id="balance"
                          value="{{!empty($row->balance)?$row->balance:''}}"
                          readonly/></td>
                       <td>
                          {{!empty($row->postdatead)?$row->postdatead:''}}
                       </td>
                       @php($i++)
                    </tr>
                    @endforeach
                 </tbody>
                 @endif
              </table>
           </div>
           <br>
           <h5>Payment Mode</h5>
           <div class="row input-custom">
              <div class="col-md-12 col-sm-12" style="margin-bottom:10px;">
                 <span style="font-size: 13px;font-weight: 600;">Cash :<span>
                 <input
                    type="radio"
                    name="payment_mode"
                    id="payment_mode"
                    value="1"
                    />
                 &nbsp;&nbsp;&nbsp;&nbsp; 
                 <span style="font-size: 13px;font-weight: 600;">Credit :</span>
                 <input
                    type="radio"
                    name="payment_mode"
                    id="payment_mode"
                    value="2"
                    />
              </div>
           </div>
           <div class="cash">
              <div class="row">
                 <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                       <span style="font-size: 13px;font-weight: 600;margin-bottom:10px;display:block;">Full Paid Amount:</span>
                       <input
                          type="text"
                          name="person_full_paid_amount"
                          id="person_full_paid_amount"
                          placeholder="Amount Paid By Person........."
                          defaultValue=""
                          class="form-control"
                          readonly
                          />
                    </div>
                 </div>
              </div>
           </div>
           <div class="credit">
              <div class="row">
                 <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                       <span style="font-size: 13px;font-weight: 600;margin-bottom:10px;display:block;">Paid Amount:</span>
                       <input
                          type="text"
                          name="person_paid_amount"
                          id="person_paid_amount"
                          placeholder="Amount Paid By Person........."
                          defaultValue=""
                          class="form-control"
                          />
                    </div>
                 </div>
                 <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                       <span style="font-size: 13px;font-weight: 600;margin-bottom:10px;display:block;">Due Amount:</span>
                       <input
                          type="text"
                          name="person_due_amount"
                          id="person_due_amount"
                          defaultValue=""
                          class="form-control"
                          readonly
                          />
                    </div>
                 </div>
              </div>
           </div>
           <div class="clearfix">
              <div class="float-left">
                 <button
                    type="submit"
                    size="md"
                    color="primary"
                    class="save btn btn-primary btn-md"
                    >
                 <i class="fa fa-dot-circle-o"></i> Save
                 </button>
              </div>
           </div>
        </div>
        <div class="alert-success success"></div>
        <div class="alert-danger error" ></div>
     </form>
     <script>
         $(document).off("keyup", "#person_paid_amount");
      $(document).on("keyup", "#person_paid_amount", function() {
            $('.person_due_amount').css('display','block');
            var balance =$('table#account_table tr:last input[name=balance]').val();
            var partial =$('#person_paid_amount').val();
            var amount = checkValidValue(balance, 'balance');
            var discount = checkValidValue(partial, 'person_paid_amount');
            var data = parseFloat(amount) - parseFloat(discount);
            var person_due_amount = parseFloat(data).toFixed(2);
            $("#person_due_amount").val(person_due_amount);
      });
        $(document).ready(function() {
            $('input:radio[name=payment_mode]').change(function() {
                  if (this.value == '1') {
                      var balance =$('table#account_table tr:last input[name=balance]').val();
                        var total = checkValidValue(balance, 'balance');
                        $("#person_full_paid_amount").val(total);
                        $('.credit').css('display','none');
                        $('.cash').css('display','block');
                  }
                  else if (this.value == '2') {
                    var balance =$('table#account_table tr:last input[name=balance]').val();
                        var total = checkValidValue(balance, 'balance');
                        $("#person_due_amount").val(total);
                        $('.credit').css('display','block');
                        $('.cash').css('display','none');
                  
                  }
            });
            });
     </script>