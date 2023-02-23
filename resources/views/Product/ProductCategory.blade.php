    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       
        <div class="col-md-6 mb-2 form-group"   >
            <label>Parent Category: </label>
            <select name="parentid" id="parentid" class="form-control">
                <option value="0">--Select--</option>
                @if(!empty($parentcat))
                    @foreach($parentcat as $men)
                        <option value="{{$men->id}}" @if($data->parentid==$men->id) {{"selected=selected"}} @endif  >{{$men->category_name}} </option>
                    @endforeach
                @endif
            </select>
        </div> 
         <div class="col-md-6 mb-2 form-group">
            <label>Category Name<code>*</code>: </label>
            <input name="category_name" placeholder="Category Name" id="category_name" class="form-control" value="{{!empty($data->category_name)?$data->category_name:''}}"></input>
        </div>
         <div class="col-md-6 mb-2 form-group">
            <label>Category Code:</label>
            <input name="category_code" placeholder="Category Code" id="category_code" class="form-control" value="{{!empty($data->category_code)?$data->category_code:''}}" readonly></input>
        </div>

         <div class="col-md-6 mb-2 form-group">
            <label>Icon: </label>
            <input  name="icon" id="icon" placeholder="fa fa-icon-name" class="form-control" value="{{!empty($data->icon)?$data->icon:''}}"></input>
        </div>
         <div class="col-md-12 mb-2 form-group">
            <label>Description: </label>
            <textarea  name="category_description" id="category_description" class="form-control ckeditor" >{{!empty($data->category_description)?$data->category_description:''}}</textarea>
        </div>

        <div class="col-6 form-group">
            <label class="">Image<code>*</code>:</label>
              <div class="file-upload-wrapper" data-text="Select your image!">
              <input name="file" type="file" class="file-upload-field form-control-file"></div>
              @if(!empty($data->image))
              <input type="hidden" name="old_img_file" value="{{$data->image}}" >
              <img src="{{asset('uploads/product_image/'.$data->image)}}" style="height:150px; width:150px">
              @endif
          </div>

       
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Keyword: </label>
            <input name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword" class="form-control" value="{{!empty($data->meta_keyword)?$data->meta_keyword:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Title: </label>
            <input name="meta_title" id="meta_title" placeholder="Meta Title" class="form-control" value="{{!empty($data->meta_title)?$data->meta_title:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Description: </label>
            <input name="meta_description" id="meta_description" placeholder="Meta Description" class="form-control " value="{{!empty($data->meta_description)?$data->meta_description:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Display Order: </label>
            <input type="number" name="order" id="order" class="form-control" value="{{!empty($data->order)?$data->order:''}}"></input>
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
                <input type="checkbox" id="is_featured" name="is_featured" value="Y" {{$data->is_featured == 'Y' ? 'checked':''}} />
                <label></label>
                <span>Is Featured</span>
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
    $(document).off("keyup", "#category_name");
    $(document).on("keyup", "#category_name", function(e) {
    let cat_name = $("#category_name").val();
    if (cat_name !== undefined || cat_name !== "") {
        let cat_code = cat_name.toLowerCase();
        cat_code = cat_code.replace(/\s/g, "");
        $("#category_code").val(cat_code);
    }
    });
</script>