
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       

         <div class="col-md-6 mb-2 form-group">
            <label>Cron Name<code>*</code>: </label>
            <input name="cron_name" id="cron_name" placeholder="Cron Name" class="form-control" value={{!empty($data->cron_name)?$data->cron_name:''}}></input>
        </div>

          

         <div class="col-md-6 mb-2 form-group">
            <label>Cron Code<code>*</code>: </label>
            <input  name="cron_code" id="cron_code" placeholder="Cron Code" class="form-control" value={{!empty($data->cron_code)?$data->cron_code:''}}></input>
        </div>
        <div class="col-md-12 mb-2 form-group">
            <label>Cron Description<code>*</code>: </label>
            <textarea name="cron_description" id="cron_description" placeholder="Cron Description" class="form-control ">{{!empty($data->cron_description)?$data->cron_description:''}}</textarea>
        </div>

        <div class="col-md-6 mb-2 form-group">
            <label>Cron URL: </label>
            <input name="cron_url" id="cron_url" placeholder="Cron Url" class="form-control " value={{!empty($data->cron_url)?$data->cron_url:''}}></input>
        </div>
       
        <div class="col-md-6 mb-2 form-group">
            <label>Order: </label>
            <input type="number" name="order" id="order" class="form-control " value={{!empty($data->order)?$data->order:''}}></input>
        </div>
        


                 
        <div class="col-md-6">
            <div class="form-group">            
                
              <div class="checkbox">
                <input type="checkbox" id="is_active" name="is_active" value="Y" {{$data->is_active == 'Y' ? 'checked':''}} />
                <label></label>
                <span>Is Active</span>
              </div>
            </div>
              
        </div>
                      
                     

        <div class="col-md-12">
            <div class="float-right">
                <button type="submit" class="save btn btn-primary btn-md" data-targetdiv='education_info_employeediv' data-redirect_type='form' data-is_table_refresh="Y" data-target_btn="btnrefresh_edu" > <i class="fa fa-dot-circle-o mr-1"></i>Update</button>

                <button type="button" class="btnreset btn btn-danger btn-md"><i class="fa fa-ban mr-1"></i>Reset</button>  
            </div>
        </div>
        <div class="alert-success success"></div>
        <div class="alert-danger error"></div>

    </div>
{{-- </form> --}}
<script>
    load_datepicker('N');
</script>