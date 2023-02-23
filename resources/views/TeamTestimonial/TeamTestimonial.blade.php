<div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
         <div class="col-md-6 mb-2 form-group">
            <label>Name <code>*</code>: </label>
            <input name="name" id="name" placeholder="Name" class="required_field form-control" value="{{!empty($data->name)?$data->name:''}}"></input>
        </div>

         <div class="col-md-6 mb-2 form-group">
            <label>Designation <code>*</code>: </label>
            <input name="designation" id="designation" placeholder="Designation" class="required_field form-control" value="{{!empty($data->designation)?$data->designation:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Type<code>*</code>: </label>
            <select name="type" id="type" class="form-control required_field">
                <option value="1" @if($data->type=='1') {{"selected=selected"}} @endif >Team</option>
                <option value="2" @if($data->type=='2') {{"selected=selected"}} @endif >Testinomials</option>
                <option value="3" @if($data->type=='3') {{"selected=selected"}} @endif >Message</option>
            </select>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Address : </label>
            <input name="address" id="address" placeholder="Address" class="form-control" value="{{!empty($data->address)?$data->address:''}}"></input>
        </div>

        <div class="col-12 form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class="">Image:</label>
                    <div class="file-upload-wrapper" data-text="Select your image!">
                        <input name="file" type="file" class="file-upload-field form-control-file "></div>
                </div>
                <div class="col-md-4">
                    @if(!empty($data->image) && file_exists(public_path('uploads/testimonial_image/'.$data->image))) 
                    <img src="{{asset('uploads/testimonial_image/'.$data->image)}}" style="height:150px; width:150px">
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-2">
            <label>Testimonial / About Me: <code>*</code></label>
            <textarea name="description" id="description" class="form-control ckeditor required_field">{{!empty($data->description)?$data->description:''}}</textarea>
        </div>
        <div class="col-md-12 mb-2">
            <label>Skills: </label>
            <textarea name="skills" id="skills" class="form-control ckeditor">{{!empty($data->skills)?$data->skills:''}}</textarea>
        </div>
        <div class="col-md-12 mb-2">
            <label>What I do?</label>
            <textarea name="experience" id="experience" class="form-control ckeditor">{{!empty($data->experience)?$data->experience:''}}</textarea>
        </div>
       
        <div class="col-md-6 mb-2 form-group">
            <label>Contact<code>*</code>: </label>
            <input name="contactno" id="contactno" placeholder="Contact" class="form-control required_field" value="{{!empty($data->contactno)?$data->contactno:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Email <code>*</code>: </label>
            <input name="email" id="email" class="form-control required_field" placeholder="Email" value="{{!empty($data->email)?$data->email:''}}"></input>
        </div>

         <div class="col-md-6 mb-2 form-group">
            <label>Facebook Link: </label>
            <input name="facebook_link" id="facebook_link" placeholder="Facebook Link" class="form-control" value="{{!empty($data->facebook_link)?$data->facebook_link:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Twitter Link: </label>
            <input name="twitter_link" id="twitter_link" placeholder="Twitter Link" class="form-control" value="{{!empty($data->twitter_link)?$data->twitter_link:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Linkedin Link: </label>
            <input name="linkedin_link" id="linkedin_link" placeholder="Linkedin Link" class="form-control" value="{{!empty($data->linkedin_link)?$data->linkedin_link:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Youtube Link: </label>
            <input name="youtube_link" id="youtube_link" placeholder="Youtube Link" class="form-control" value="{{!empty($data->youtube_link)?$data->youtube_link:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Instagram Link: </label>
            <input name="instagram_link" id="instagram_link" placeholder="Instagram Link" class="form-control" value="{{!empty($data->instagram_link)?$data->instagram_link:''}}"></input>
        </div>
       
        <div class="col-md-6 mb-2 form-group">
            <label>Order: </label>
            <input type="number" name="order" placeholder="Order" id="order" class="form-control" value="{{!empty($data->order)?$data->order:''}}"></input>
        </div>
      
        <div class="col-md-6">
            <div class="form-group">            
              <div class="checkbox">
                <input type="checkbox" id="isactive" name="isactive" value="Y" {{$data->isactive == 'Y' ? 'checked':''}} />
                <label></label>
                <span>Is Publish</span>
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

<script>
    load_datepicker('N');
    load_ckeditor();
</script>