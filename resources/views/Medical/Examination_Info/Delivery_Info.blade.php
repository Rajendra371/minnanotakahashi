<div class="white-box pad-5 form_search">
    <form action="/api/examination/save_delivery" id="deliveryForm" method="post">
    <input type="hidden" name="id" value="{{ $data['examination_master_id']}}">
            <div class="row">
            <div class="col-md-3 col-sm-3">
            <label>Delivery Date</label>
            <input type="text" name="delivery_date" class="form-control datepicker" value="{{!empty($data['em_data']->delivered_datead)?$data['em_data']->delivered_datead:CURDATE_EN}}" />
           </div>
           <div class="col-md-3 col-sm-3">
            <label>Received By</label>
           <input type="text" name="received_by" class="form-control" value="{{!empty($data['em_data']->received_by)?$data['em_data']->received_by:''}}" />
            </div>
            <div class="col-md-3 col-sm-3">
                    <button type="submit" class="btn btn-md btn-success save" data-isdismiss='Y' data-btnrefresh='Y' style="margin-top: 29px;">Save</button>
            </div>
            </div>

</form>
</div>
<script>
load_datepicker();
</script>