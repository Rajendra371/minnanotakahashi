<div class="row">
    <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
    
    <div class="col-md-6 mb-2 form-group">
        <label>Name<code>*</code>: </label>
        <input name="service_name" id="service_name" placeholder="Enter Name" class="form-control" value="{{!empty($data->service_name)?$data->service_name:''}}"></input>
    </div>

    <div class="col-md-6 mb-2 form-group">
        <label>Icon<code>*</code>: </label>
        <input name="icon" id="icon" placeholder="Enter Icon" class="form-control" value="{{!empty($data->icon)?$data->icon:''}}"></input>
    </div> 

    <div class="col-md-6 mb-2 form-group">
        <label>Slug: </label>
        <input name="slug" id="slug" class="form-control" value="{{!empty($data->slug)?$data->slug:''}}"></input>
    </div> 

    <div class="col-md-6 mb-2 form-group">
        <label>Short Content<code>*</code>: </label>
        <textarea  name="short_content" id="short_content" placeholder="Short Content" class="form-control">{{!empty($data->short_content)?$data->short_content:''}}</textarea>
    </div>
    
    <div class="col-12 form-group">
        <label class="">Image<code>*</code>:</label>
            <div class="file-upload-wrapper" data-text="Select your image!">
            <input name="file" type="file" class="file-upload-field form-control-file"></div>
            @if(!empty($data->image))
            <input type="hidden" name="old_img_file" value="{{$data->image}}" >
            <img src="{{asset('uploads/service_image/'.$data->image)}}" style="height:150px; width:150px">
            @endif
        </div>

    <div class="col-md-12 mb-2">
        <label>Content<code>*</code>: </label>
        <textarea name="content" id="content" class="form-control ckeditor ">{{!empty($data->content)?$data->content:''}}</textarea>
    </div>
    <div class="col-md-6 mb-2 form-group">
        <label>Start Date: </label>
        <input name="startdate" id="startdate" placeholder="YYYY-MM-DD" class="form-control datepicker" value="{{!empty($data->startdate)?$data->startdate:''}}"></input>
    </div>
    <div class="col-md-6 mb-2 form-group">
        <label>End Date: </label>
        <input name="enddate" id="enddate" placeholder="YYYY-MM-DD" class="form-control datepicker" value="{{!empty($data->enddate)?$data->enddate:''}}"></input>
    </div>
    
    
    <div class="col-md-6 mb-2 form-group">
        <label>Meta Title: </label>
        <input name="meta_title" id="meta_title" placeholder="Meta Title" class="form-control " value="{{!empty($data->meta_title)?$data->meta_title:''}}"></input>
    </div>
    <div class="col-md-6 mb-2 form-group">
        <label>Meta Keyword: </label>
        <input name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword" class="form-control " value="{{!empty($data->meta_keyword)?$data->meta_keyword:''}}"></input>
    </div>
    <div class="col-md-6 mb-2 form-group">
        <label>Meta Description: </label>
        <input name="meta_description" id="meta_description" placeholder="Meta Description" class="form-control " value="{{!empty($data->meta_description)?$data->meta_description:''}}"></input>
    </div>
    <div class="col-md-6 mb-2 form-group">
        <label>Order: </label>
        <input type="number" name="order" id="order" placeholder="Order" class="form-control " value="{{!empty($data->order)?$data->order:''}}"></input>
    </div>             
    <div class="col-md-6">
        <div class="form-group">            
            <div class="checkbox">
            <input type="checkbox" id="is_publish" name="is_publish" value="Y" {{$data->is_publish == 'Y' ? 'checked':''}} />
            <label></label>
            <span>Is Publish</span>
            </div>
        </div>  
    </div>
    <div class="col-md-6">
        <div class="form-group">            
            <div class="checkbox">
            <input type="checkbox" id="for_form" name="for_form" value="Y" {{$data->for_form == 'Y' ? 'checked':''}} />
            <label></label>
            <span>For Form</span>
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