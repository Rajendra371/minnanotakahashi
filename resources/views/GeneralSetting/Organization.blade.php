
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       

         <div class="col-md-6 mb-2">
            <label>Organization Name<code>*</code>: </label>
            <input name="orgname" id="orgname" class="form-control" value={{!empty($data->orgname)?$data->orgname:''}}></input>
        </div>

         <div class="col-md-6 mb-2">
            <label>Contact<code>*</code>: </label>
            <input  name="contact" id="contact" class="form-control" value={{!empty($data->contact)?$data->contact:''}}></input>
        </div>

        <div class="col-md-6 mb-2">
            <label>Addrerss 1<code>*</code>: </label>
            <input name="orgaddress1" id="orgaddress1" class="form-control " value={{!empty($data->orgaddress1)?$data->orgaddress1:''}}></input>
        </div>
        <div class="col-md-6 mb-2">
            <label>Address 2<code>*</code>: </label>
            <input name="orgaddress2" id="orgaddress2" class="form-control " value={{!empty($data->orgaddress2)?$data->orgaddress2:''}}></input>
        </div>
        <div class="col-md-6 mb-2">
            <label>Email<code>*</code>: </label>
            <input name="email" id="email" class="form-control " value={{!empty($data->email)?$data->email:''}}></input>
        </div>
        <div class="col-md-6 mb-2">
            <label>Website<code>*</code>: </label>
            <input name="website" id="website" class="form-control " value={{!empty($data->website)?$data->website:''}}></input>
        </div>
        
   
        <div class="col-md-6">
            <div class="form-group">            
                
              <div class="checkbox">
                <input type="checkbox" id="isactive" name="isactive" value="Y" {{$data->isactive == 'Y' ? 'checked':''}} />
                <label></label>
                <span>Status</span>
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
    load_datepicker("N");
</script>