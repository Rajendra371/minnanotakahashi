 <div class="form-group general_info white-box pad-5">
    <form method="post" class="form-horizontal" id="examination_resultForm" action="api/examination_summary/result_store">
       @if(!empty($data))
       <input
          type="hidden"
          name="id"
          id="id"
          value="{{$data->id}}"
          />
          @if(!empty($data->result))
          @if($data->result=='P')
          <h3>Result:Pass</h3>
          @else
          <h3>Result:Fail</h3>
          @endif
          <h4>Do you want to change?</h4>
          @endif
       @endif
       <h5>Result:</h5>
        <div >
            <select id="result" name="result" class="required_field">
                <option value="">Select</option>
                <option value="P" <?php if($data->result=='P'){
                    echo 'selected';
                }?>>Pass</option>
                <option value="F" <?php if($data->result=='F'){
                    echo 'selected';
                }?>>Fail</option>
                </select>
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

    