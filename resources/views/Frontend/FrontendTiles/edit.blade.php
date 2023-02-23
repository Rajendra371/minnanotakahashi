<div class="row">
    <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
    <div class="col-md-6 mb-2 form-group"   >
        <label>Title<code>*</code>: </label>
       <input type="text" name="title" id="title" value="{{$data->title}}" class="form-control required_field" placeholder="Enter Title">
    </div> 
    <div class="col-md-6 mb-2 form-group"   >
        <label>Icon<code>*</code>: </label>
       <input type="text" name="icon" id="icon" value="{{$data->icon}}" class="form-control" placeholder="Enter Icon">
    </div> 
    <div class="col-12 form-group">
        <label class="">Image<code>*</code>:</label>
            <div class="file-upload-wrapper" data-text="Select your image!">
            <input name="file" type="file" class="file-upload-field form-control-file"></div>
            @if(!empty($data->image))
            <input type="hidden" name="old_img_file" value="{{$data->image}}" >
            <img src="{{asset('uploads/frontend_tiles/'.$data->image)}}" style="height:150px; width:150px">
            @endif
    </div>
    <div class="col-md-12 mb-2 form-group">
        <label>Content<code>*</code>: </label>
        <textarea name="content" id="content" placeholder="Content" class="form-control">{{$data->content}}</textarea>
    </div>
    <div class="col-md-6 mb-2 form-group"   >
        <label>Order<code>*</code>: </label>
       <input type="text" name="order" id="order" value="{{$data->order}}" class="form-control" placeholder="Enter Order">
    </div> 
    </div>
    <div class="row">
    <div class="col-md-3">
        <div class="form-group">            
            <div class="checkbox">
            <input type="checkbox" id="is_publish" name="is_publish" value="Y" {{$data->is_publish == 'Y' ? 'checked=checked':''}} />
            <label></label>
            <span>Is Publish</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">            
            <div class="checkbox">
            <input type="checkbox" id="for_header" name="for_header" value="Y" {{$data->for_header == 'Y' ? 'checked=checked':''}} />
            <label></label>
            <span>Header</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">            
            <div class="checkbox">
            <input type="checkbox" id="for_body" name="for_body" value="Y" {{$data->for_body == 'Y' ? 'checked=checked':''}} />
            <label></label>
            <span>Body</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">            
            <div class="checkbox">
            <input type="checkbox" id="for_footer" name="for_footer" value="Y" {{$data->for_footer == 'Y' ? 'checked=checked':''}} />
            <label></label>
            <span>Footer</span>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="float-right">
            <button type="submit" class="save btn btn-primary btn-md" data-is_table_refresh="Y" data-target_btn="btnRefresh" > <i class="fa fa-dot-circle-o mr-1"></i>Update</button>
            <button type="button" class="btnreset btn btn-danger btn-md"><i class="fa fa-ban mr-1"></i>Reset</button>  
        </div>
    </div>
    <div class="alert-success success"></div>
    <div class="alert-danger error"></div>
</div>
<script>
load_ckeditor();
</script>