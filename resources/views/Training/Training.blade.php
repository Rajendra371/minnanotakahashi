
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       

         <div class="col-md-6 mb-2 form-group">
            <label>Training Title:<code>*</code>: </label>
            <input name="title" id="title" placeholder="Enter Training Title" class="form-control" value="{{!empty($data->title)?$data->title:''}}"></input>
        </div>

        <div class="col-md-6 mb-2 form-group">
            <label>Icon<code>*</code>: </label>
            <input name="icon_name" id="icon_name" placeholder="Enter icon_name" class="form-control" value="{{!empty($data->icon_name)?$data->icon_name:''}}"></input>
        </div> 

        <div class="col-md-6 mb-2 form-group">
            <label>Slug: </label>
            <input name="slug" id="slug" class="form-control" value="{{!empty($data->slug)?$data->slug:''}}"></input>
        </div> 

        <div class="col-md-12 mb-2">
            <label>Content<code>*</code>: </label>
            <textarea name="description" id="content" class="form-control ckeditor ">{{!empty($data->description)?$data->description:''}}</textarea>
        </div>

        <div class="col-md-6 mb-2 form-group">
            <label>Short Content<code>*</code>: </label>
            <textarea  name="short_description" id="short_description" placeholder="Short Content" class="form-control">{{!empty($data->short_description)?$data->short_description:''}}</textarea>
        </div>
        
        <div class="col-12 form-group">
            <label class="">Image<code>*</code>:</label>
              <div class="file-upload-wrapper" data-text="Select your image!">
              <input name="file" type="file" class="file-upload-field form-control-file"></div>
              @if(!empty($data->training_image))
              <input type="hidden" name="old_img_file" value="{{$data->training_image}}" >
              <img src="{{asset('uploads/training_image/'.$data->training_image)}}" style="height:150px; width:150px">
              @endif
          </div>

          {{-- <div class="col-md-6 mb-2 form-group">
            <label>Trainer Name: </label>
            <input name="trainer_name" id="trainer_name" class="form-control" value="{{!empty($data->trainer_name)?$data->trainer_name:''}}"></input>
         </div> 

         <div class="col-12 form-group">
            <label class="">TRAINER Image<code>*</code>:</label>
              <div class="file-upload-wrapper" data-text="Select your image!">
              <input name="file" type="file" class="file-upload-field form-control-file"></div>
              @if(!empty($data->trainer_image))
              <input type="hidden" name="old_img_file" value="{{$data->trainer_image}}" >
              <img src="{{asset('uploads/trainer_image/'.$data->trainer_image)}}" style="height:150px; width:150px">
              @endif
          </div> --}}

          <div class="col-md-6 mb-2 form-group">
            <label>Start Date: </label>
            <input name="start_date" id="start_date" placeholder="YYYY-MM-DD" class="form-control datepicker" value="{{!empty($data->start_date)?$data->start_date:''}}"></input>
         </div>
         <div class="col-md-6 mb-2 form-group">
            <label>End Date: </label>
            <input name="end_date" id="end_date" placeholder="YYYY-MM-DD" class="form-control datepicker" value="{{!empty($data->end_date)?$data->end_date:''}}"></input>
         </div>

         <div class="col-md-6 mb-2 form-group">
            <label>Class Start: </label>
            <input name="class_start" id="class_start" placeholder="YYYY-MM-DD" class="form-control datepicker" value="{{!empty($data->class_start)?$data->class_start:''}}"></input>
         </div>
         <div class="col-md-6 mb-2 form-group">
            <label>Class End: </label>
            <input name="class_end" id="class_end" placeholder="YYYY-MM-DD" class="form-control datepicker" value="{{!empty($data->class_end)?$data->class_end:''}}"></input>
         </div>

        
        
       
        
        <div class="col-md-6 mb-2 form-group">
            <label>SEO Title: </label>
            <input name="meta_title" id="meta_title" placeholder="SEO Title" class="form-control " value="{{!empty($data->meta_title)?$data->meta_title:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>SEO Keyword: </label>
            <input name="meta_keyword" id="meta_keyword" placeholder="SEO Keyword" class="form-control " value="{{!empty($data->meta_keyword)?$data->meta_keyword:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>SEO Description: </label>
            <input name="meta_description" id="meta_description" placeholder="SEO Description" class="form-control " value="{{!empty($data->meta_description)?$data->meta_description:''}}"></input>
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