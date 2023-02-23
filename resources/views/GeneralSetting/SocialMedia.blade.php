
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">

       
                    <div class="col-12 col-sm-12 col-md-12 form-group">
                     <div class="checkbox">
                      <Input type="checkbox" id="social_media_integration@check" class="form-check-input" name="isfb_login" value="Y"{{$data->isfb_login == 'Y' ? 'checked':''}} />
                      <label for="social_media_integration@check"></label>
                      </div>
                    
                      <label>Facebook App Login:</label>
                        <Input
                        type="text"
                        name="fb_appid"
                        placeholder="Enter Facebook APP ID"
                        class="form-control"
                        value={{!empty($data->fb_appid)?$data->fb_appid:''}}
                      />
                    
                </div>
        
               
            <div class="col-12 col-sm-12 col-md-12 form-group">
                    <div class="checkbox">
                        <Input type="checkbox" id="social_media_integration@check1" name="isgoogle_login" value="Y"{{$data->isgoogle_login == 'Y' ? 'checked':''}} />
                        <label for="social_media_integration@check1"></label>
                      </div>
                       
                      <span> Google App Login
                        :</span>
                      
                      <Input
                        type="name"
                        name="google_appid"
                        placeholder="Enter Google APP ID"
                        class="form-control"
                        value={{!empty($data->google_appid)?$data->google_appid:''}}
                       
                      />
                    </div>
    
       
                 
                    <div class="col-12 col-sm-12 col-md-12 form-group">
                    <div class="checkbox">
                        <Input type="checkbox" id="social_media_integration@check2" name="isgoogle_analytical" value="Y" {{$data->isgoogle_analytical == 'Y' ? 'checked':''}} />
                        <label for="social_media_integration@check2"></label>
                      </div>
                      
                      <span> Google Analytics
                        :</span>
                      <Input
                        type="name"
                        name="google_analytics"
                        placeholder="Enter Google Analytics ID "
                        class="form-control"
                        value={{!empty($data->google_analytics)?$data->google_analytics:''}}
                      />
                    </div>
        
        
                 
                    <div class="col-12 col-sm-12 col-md-12 form-group">
                    <div class="checkbox">
                        <Input type="checkbox" id="social_media_integration@check3" name="islinkedin_login" value="Y" {{$data->islinkedin_login == 'Y' ? 'checked':''}} />
                        <label for="social_media_integration@check3"></label>
                      </div>
                      
                      <span>  LinkedIn App Login
                        :</span>
                      <Input
                        type="name"
                        name="linkedin_appid"
                        placeholder="Enter LinkedIn ID"
                        class="form-control"  
                        value={{!empty($data->linkedin_appid)?$data->linkedin_appid:''}}                  
                       
                      />
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