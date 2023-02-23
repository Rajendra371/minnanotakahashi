<div class="row">
    <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
    <div class="col-md-6 mb-2 form-group"   >
        <label>Blog Category<code>*</code>: </label>
        <select name="blog_categoryid" id="blog_categoryid" class="form-control">
            <option>--Select--</option>
            @if(!empty($category)) 
            @foreach($category as $cat)
                <option value="{{$cat->id}}" @if($data->blog_categoryid==$cat->id) {{"selected=selected"}} @endif  >{{$cat->cat_name}} </option>
            @endforeach
            @endif
        </select>
    </div> 

    <div class="col-md-6 mb-2 form-group">
        <label>Blog Title<code>*</code>: </label>
        <input name="blog_title" id="blog_title" placeholder="Blog Title" class="form-control" value="{{!empty($data->blog_title)?$data->blog_title:''}}"></input>
    </div>

    <div class="col-md-12 mb-2 form-group">
        <label>Content<code>*</code>: </label>
        <textarea  name="content" id="content" class="form-control ckeditor">{{!empty($data->content)?$data->content:''}}</textarea>
    </div>

    <div class="col-12 form-group">
        <label class="">Image<code>*</code>:</label>
        <div class="file-upload-wrapper" data-text="Select your image!">
        <input name="file" type="file" class="file-upload-field form-control-file"></div>
        @if(!empty($data->image))
        <input type="hidden" name="old_img_file" value="{{$data->image}}" >
        <img src="{{asset('uploads/blog_image/'.$data->image)}}" style="height:150px; width:150px">
        @endif
    </div>

    <div class="col-md-6 mb-2 form-group">
        <label>Icon Name: </label>
        <input name="icon" id="icon" class="form-control" placeholder="Icon Name" value="{{!empty($data->icon)?$data->icon:''}}"></input>
    </div>

    <div class="col-md-6 mb-2 form-group">
        <label>Author: </label>
        <input name="author" id="author" class="form-control" placeholder="Author Name" value="{{!empty($data->author)?$data->author:''}}"></input>
    </div>
    
    <div class="col-md-6 mb-2 form-group">
        <label>SEO Title: </label>
        <input name="seo_title" id="seo_title" class="form-control" placeholder="SEO Title" value="{{!empty($data->seo_title)?$data->seo_title:''}}"></input>
    </div>

    <div class="col-md-6 mb-2 form-group">
        <label>SEO Keyword: </label>
        <input name="seo_keyword" id="seo_keyword" class="form-control" placeholder="SEO Keyword" value="{{!empty($data->seo_keyword)?$data->seo_keyword:''}}"></input>
    </div>

    <div class="col-md-6 mb-2 form-group">
        <label>SEO Description: </label>
        <input name="seo_description" id="seo_description" placeholder="SEO Description" class="form-control " value="{{!empty($data->seo_description)?$data->seo_description:''}}"></input>
    </div>

    <div class="col-md-6 mb-2 form-group">
        <label>Order: </label>
        <input type="number" name="order" id="order" placeholder="Order" class="form-control" value="{{!empty($data->order)?$data->order:''}}"></input>
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
            <input type="checkbox" id="is_popular" name="is_popular" value="Y" {{$data->is_popular == 'Y' ? 'checked':''}} />
            <label></label>
            <span>Is Popular</span>
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