
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       

         <div class="col-md-6 mb-2 form-group">
            <label>Title<code>*</code>: </label>
            <input name="title" id="title" class="form-control" placeholder="Enter Title" value={{!empty($data->title)?$data->title:''}}></input>
        </div>

         <div class="col-md-6 mb-2 form-group">
            <label>Designation<code>*</code>: </label>
            <input  name="designation" id="designation" placeholder="Designation" class="form-control" value={{!empty($data->designation)?$data->designation:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Contact:<code>*</code> </label>
            <input name="contact" id="contact" class="form-control" placeholder="Contact No." value={{!empty($data->contact)?$data->contact:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Email<code>*</code>: </label>
            <input name="email" id="email" class="form-control " placeholder="Email" value={{!empty($data->email)?$data->email:''}}></input>
        </div>

        <div class="col-md-6 mb-2 form-group">
            <label>Facebook Link: </label>
            <input name="facebook_link" id="facebook_link" class="form-control" placeholder="Facebook Link" value={{!empty($data->facebook_link)?$data->facebook_link:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Twitter Link: </label>
            <input name="twitter_link" id="twitter_link" class="form-control " placeholder="Twitter Link" value={{!empty($data->twitter_link)?$data->twitter_link:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Linkedin Link: </label>
            <input name="linkedin_link" id="linkedin_link" class="form-control " placeholder="Linkedin Link" value={{!empty($data->linkedin_link)?$data->linkedin_link:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Youtube Link: </label>
            <input name="youtube_link" id="youtube_link" class="form-control " placeholder="Youtube Link" value={{!empty($data->youtube_link)?$data->youtube_link:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Instagram Link: </label>
            <input name="instagram_link" id="instagram_link" class="form-control " placeholder="Instagram Link" value={{!empty($data->instagram_link)?$data->instagram_link:''}}></input>
        </div>
        
        <div class="col-md-6 mb-2 form-group">
            <label>Order: </label>
            <input type="number" name="order" id="order" placeholder="Order" class="form-control " value={{!empty($data->order)?$data->order:''}}></input>
        </div>
        
   
        <div class="col-md-6">
            <div class="form-group">            
                
              <div class="checkbox">
                <input type="checkbox" id="isactive" name="isactive" value="Y" {{$data->isactive == 'Y' ? 'checked':''}} />
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