
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       

         <div class="col-md-6 mb-2">
            <label>Software Name<code>*</code>: </label>
            <input name="softwarename" id="softwarename" class="form-control" value={{!empty($data->softwarename)?$data->softwarename:''}}></input>
        </div>

         <div class="col-md-6 mb-2">
            <label>Software Version<code>*</code>: </label>
            <input  name="softwareversion" id="softwareversion" class="form-control" value={{!empty($data->softwareversion)?$data->softwareversion:''}}></input>
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
    load_datepicker('N');
</script>