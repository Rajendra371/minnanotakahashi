<div class="white-box pad-5 form_search">
    <form action="/api/examination/save_result" id="deliveryForm" method="post">
    <input type="hidden" name="id" value="{{ $data['examination_master_id']}}">
            <div class="row">
            <div class="col-md-3 col-sm-3">
            <label><b>Status</b></label>
            <input type="radio" name="result" value="F">Is Fit<br>
           </div>
           <div class="col-md-3 col-sm-3">
           <input type="radio" name="result" value="U">Un-Fit<br>
           </div>
           
           </div>
           <div class="col-md-3 col-sm-3">
            <button type="submit" class="btn btn-md btn-success save" data-isdismiss='Y' data-btnrefresh='Y' style="margin-top: 29px;  ">Save</button>
            </div>

</form>
</div>
<script>
load_datepicker();
</script>