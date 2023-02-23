<div class="payment_wrapper">
    @if(!empty($data))
        <h5 class="navtab_header">Account Head Details</h5>
        <div class="box-detail">
            <div class="row">
                    <div class="col-md-4 col-sm-4">
                    <label>Name :</label>
                    <span>{{!empty($data->achs_name)?$data->achs_name:''}}</span>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label>Name NP. :</label>
                    <span>{{!empty($data->achs_namenp)?$data->achs_namenp:''}}</span>
                </div>
                 <div class="col-md-4 col-sm-4">
                    <label>Status :</label>
                    <span>{{!empty($data->isactive)?$data->isactive:''}}</span>
                </div>

                

        </div>        
    @endif
</div>
