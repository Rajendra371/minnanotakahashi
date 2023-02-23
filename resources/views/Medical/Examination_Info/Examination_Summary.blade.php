<style>
    .cash , .cheque, .full_payment, .partial_payment,.remaining_amount{
        display:none;
    }
    </style>
    <div class="form-group general_info white-box pad-5">
    <form method="post" class="form-horizontal" id="examination_summaryForm" action="api/examination_summary/is_complete_store">
       @if(!empty($data))
       <input
          type="hidden"
          name="id"
          id="id"
          value="{{$data->id}}"
          />
       @endif
       <h5>Report Completed?</h5>
   <div class="row input-custom">
      <div class="col-md-4 col-sm-4">
         <div class="col-md-12 col-sm-12">
            1) Yes :
            <input
               type="radio"
               name="is_complete"
               id="is_complete"
               value="Y"
               />
            &nbsp;&nbsp; 2) No :
            <input
               type="radio"
               name="is_complete"
               id="is_complete"
               value="N"
               />
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
       <div class="alert-success success"></div>
        <div class="alert-danger error" ></div>
    </form>

    