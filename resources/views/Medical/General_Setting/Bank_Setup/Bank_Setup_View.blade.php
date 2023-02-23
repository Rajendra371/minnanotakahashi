<div class="payment_wrapper">
    @if(!empty($data))
        <h5 class="navtab_header">Account Head Details</h5>
        <div class="box-detail">
            <div class="row">
                    <div class="col-md-4 col-sm-4">
                    <label>Name :</label>
                    <span>{{!empty($data->bank_name)?$data->bank_name:''}}</span>
                </div>
                
                <div class="col-md-4 col-sm-4">
                    <label>Account Name. :</label>
                    <span>{{!empty($data->bank_account_name)?$data->bank_account_name:''}}</span>
                </div>
                 <div class="col-md-4 col-sm-4">
                    <label>Number :</label>
                    <span>{{!empty($data->bank_account_no)?$data->bank_account_no:''}}</span>
                </div>
                 <div class="col-md-4 col-sm-4">
                    <label>Authorized Person :</label>
                    <span>{{!empty($data->authorized_person)?$data->authorized_person:''}}</span>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label>Address :</label>
                    <span>{{!empty($data->address)?$data->address:''}}</span>
                </div>
                 <div class="col-md-4 col-sm-4">
                    <label>Contact Number :</label>
                    <span>{{!empty($data->contact_no)?$data->contact_no:''}}</span>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label>Status :</label>
                    <span>{{!empty($data->isactive)?$data->isactive:''}}</span>
                </div>
        </div>        
    @endif
</div>
