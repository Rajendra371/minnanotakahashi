    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
        <div class="col-md-6 mb-2 form-group"   >
            <label>Page Menu<code>*</code>: </label>
            <select name="menuid" id="menuid" class="form-control">
                <option value="">--Select--</option>
                @if(!empty($menu))
                    @foreach($menu as $men)
                        <option value="{{$men->id}}" @if($data->menuid==$men->id) {{"selected=selected"}} @endif  >{{$men->menu_name}} </option>
                    @endforeach
                @endif
            </select>
        </div> 
         <div class="col-md-6 mb-2 form-group">
            <label>Title<code>*</code>: </label>
            <input name="page_title" id="page_title" placeholder="Enter Title" class="form-control" value="{{!empty($data->page_title)? $data->page_title :''}}"></input>
        </div>

         <div class="col-md-6 mb-2 form-group">
            <label>Page Slug: </label>
            <input  name="page_slug" id="page_slug" placeholder="Page Slug" class="form-control" value="{{!empty($data->page_slug)? $data->page_slug :''}}"></input>
        </div>

        <div class="col-12 form-group">
            <label class="">Image<code>*</code>:</label>
              <div class="file-upload-wrapper" data-text="Select your image!">
              <input name="file" type="file" class="file-upload-field form-control-file"></div>
              @if(!empty($data->images))
              <input type="hidden" name="old_img_file" value="{{$data->images}}" >
              <img src="{{asset('uploads/page_image/'.$data->images)}}" style="height:150px; width:150px">
              @endif
          </div>


        <div class="col-md-6 mb-2 form-group">
            <label>Short Content<code>*</code>: </label>
            <textarea name="short_content" id="short_content" placeholder="Short Content" class="form-control">{{!empty($data->short_content)? "$data->short_content" :''}}</textarea>
        </div>
        <div class="col-md-12 mb-2 form-group">
            <label>Description<code>*</code>: </label>
            <textarea name="description" id="description" class="form-control ckeditor">{{!empty($data->description)? $data->description :''}}</textarea>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Title: </label>
            <input name="meta_title" id="meta_title" placeholder="Meta Title" class="form-control" value="{{!empty($data->meta_title)? $data->meta_title :''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Keyword: </label>
            <input name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword" class="form-control" value="{{!empty($data->meta_keyword)? $data->meta_keyword :''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Description: </label>
            <input name="meta_description" id="meta_description" placeholder="Meta Description" class="form-control " value="{{!empty($data->meta_description)? $data->meta_description:''}}"></input>
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
    load_ckeditor();
</script>