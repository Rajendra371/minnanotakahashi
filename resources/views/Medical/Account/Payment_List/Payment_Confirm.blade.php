    <div class="form-group general_info white-box pad-5">
    <form method="post" class="form-horizontal" id="report_completeForm" action="api/payment_list/payment_status">
       @if(!empty($data))
       <input
          type="hidden"
          name="id"
          id="id"
          value="{{$data->id}}"
          />
       @endif
     
   <div class="row input-custom">
   @if($data->payment_status=='F')
     <h5>Are you sure to confirm payment ?</h5>
       <div class="col-md-4 col-sm-4">
         <div class="col-md-12 col-sm-12">
            1) Yes :
            <input
               type="radio"
               name="payment_status"
               id="payment_status"
               value="P"
               checked
               />
         </div>
      </div>
   @else
     <div class="col-md-4 col-sm-4">
         <div class="col-md-12 col-sm-12">
            1) Yes :
            <input
               type="radio"
               name="payment_status"
               id="payment_status"
               value="P"
               checked
               />
            &nbsp;&nbsp; 2) No :
            <input
               type="radio"
               name="payment_status"
               id="payment_status"
               value="U"
               />
         </div>
      </div>
   @endif
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
       <div class="alert-success success"></div>
        <div class="alert-danger error" ></div>
    </form>

    