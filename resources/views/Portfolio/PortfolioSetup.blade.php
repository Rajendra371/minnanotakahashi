    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       

           <div class="col-md-6 mb-2 form-group"   >
            <label>Category Name:<code>*</code> </label>
            <select name="portfolio_categoryid" id="portfolio_categoryid" class="form-control">
                <option>--Select--</option>
                @if(!empty($category))
                   
                    @foreach($category as $cat)
                   
                        <option value="{{$cat->id}}" @if($data->portfolio_categoryid==$cat->id) {{"selected=selected"}} @endif  >{{$cat->category_name}} </option>
                    @endforeach
                @endif
            </select>
        </div> 
        

         <div class="col-md-6 mb-2 form-group">
            <label>Name:<code>*</code> </label>
            <input  name="name" id="name" class="form-control" placeholder="Enter Name" value={{!empty($data->name)?$data->name:''}}></input>
        </div>

        <div class="col-md-12 mb-2 form-group">
            <label>Content:<code>*</code> </label>
            <textarea name="content" id="content" class="form-control ckeditor">{{!empty($data->content)?$data->content:''}}</textarea>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Website:<code>*</code> </label>
            <input name="website" id="website" class="form-control" placeholder="Website" value={{!empty($data->website)?$data->website:''}}></input>
        </div>

        <div class="col-6 form-group">
            <label class="">Image<code>*</code>:</label>
              <div class="file-upload-wrapper" data-text="Select your image!">
              <input name="file" type="file" class="file-upload-field form-control-file"></div>
              @if(!empty($data->image))
              <input type="hidden" name="old_img_file" value="{{$data->image}}" >
              <img src="{{asset('uploads/portfolio_image/'.$data->image)}}" style="height:150px; width:150px">
              @endif
          </div>


        
        <div class="col-md-6 mb-2 form-group">
            <label>Start Date:<code>*</code> </label>
            <input name="startdate" id="startdate" placeholder="YYYY-MM-DD" class="form-control datepicker" value={{!empty($data->startdate)?$data->startdate:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>End Date:<code>*</code> </label>
            <input name="enddate" id="enddate" placeholder="YYYY-MM-DD" class="form-control datepicker" value={{!empty($data->enddate)?$data->enddate:''}}></input>
        </div>
        
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Title:</label>
            <input name="meta_title" id="meta_title" placeholder="Meta Title" class="form-control" value={{!empty($data->meta_title)?$data->meta_title:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Keyword:</label>
            <input name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword" class="form-control" value={{!empty($data->meta_keyword)?$data->meta_keyword:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Description:</label>
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
<script>
    load_datepicker('N');
    load_ckeditor();
</script>