
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       
        <div class="col-md-6 mb-2 form-group"   >
            <label>Client Category<code>*</code>: </label>
            <select name="client_catid" id="client_catid" class="form-control">
                <option>--Select--</option>
                @if(!empty($category))
                   
                    @foreach($category as $cat)
                   
                        <option value="{{$cat->id}}" @if($data->client_catid==$cat->id) {{"selected=selected"}} @endif  >{{$cat->category_name}} </option>
                    @endforeach
                @endif
            </select>
        </div> 
         <div class="col-md-6 mb-2 form-group">
            <label>Client Name<code>*</code>: </label>
            <input name="client_name" id="client_name" class="form-control" placeholder="Client Name" value={{!empty($data->client_name)?$data->client_name:''}}></input>
        </div>

         <div class="col-md-6 mb-2 form-group">
            <label>URL: </label>
            <input  name="url" id="url" class="form-control" placeholder="URL" value={{!empty($data->url)?$data->url:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Icon: </label>
            <input name="icon" id="icon" class="form-control" placeholder="Icon Name" value={{!empty($data->icon)?$data->icon:''}}></input>
        </div>

         

        <div class="col-12 form-group">
            <label class="">Logo<code>*</code>:</label>
              <div class="file-upload-wrapper" data-text="Select your image!">
              <input name="file" type="file" class="file-upload-field form-control-file"></div>
              @if(!empty($data->logo))
              <input type="hidden" name="old_img_file" value="{{$data->logo}}" >
              <img src="{{asset('uploads/client_logo/'.$data->logo)}}" style="height:150px; width:150px">
              @endif
          </div>


        <div class="col-md-12 mb-2">
            <label>Content<code>*</code>: </label>
            <textarea name="content" id="content" class="form-control ckeditor">{{!empty($data->content)?$data->content:''}}</textarea>
        </div>
        
       
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Title: </label>
            <input name="meta_title" id="meta_title" placeholder="Meta Title" class="form-control" value={{!empty($data->meta_title)?$data->meta_title:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Keyword: </label>
            <input name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword" class="form-control" value={{!empty($data->meta_keyword)?$data->meta_keyword:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Description: </label>
            <input name="meta_description" id="meta_description" placeholder="Meta Description" class="form-control " value={{!empty($data->meta_description)?$data->meta_description:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Order: </label>
            <input type="number" name="order" id="order" placeholder="Order" class="form-control" value={{!empty($data->order)?$data->order:''}}></input>
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