
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="position-relative row form-group" >
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       

         <div class="col-6 col-sm-6 col-md-6 form-group">
          <label class="">Banner Heading<code>*</code>:</label>
            <input name="heading" placeholder="Enter Heading" class="required_field form-control " value="{{!empty($data->heading)?$data->heading:''}}"></input>
        </div>


        <div class="col-6 form-group">
          <label class="">Banner Image<code>*</code>:</label>
            <div class="file-upload-wrapper" data-text="Select your image!">
            <input name="file" type="file" class="file-upload-field form-control-file"></div>
            @if(!empty($data->banner_img))
            <input type="hidden" name="old_img_file" value="{{$data->banner_img}}" >
            <img src="{{asset('uploads/banner_image/'.$data->banner_img)}}" style="height:150px; width:150px">
            @endif
        </div>


        <div class="col-6 col-sm-6 col-md-12 form-group">
            <label>Banner Content<code>*</code>: </label>
            <textarea  placeholder="Enter Content Here" name="content" id="content" class="form-control ckeditor"?>{{!empty($data->content)?$data->content:''}}</textarea>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Button 1 Text: </label>
            <input name="button_text1" id="button_text1" placeholder="Button 1 Text" class="form-control" value="{{!empty($data->button_text1)?$data->button_text1:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Button 1 URL: </label>
            <input name="button_url1" id="button_url1" placeholder="Button 1 URL" class="form-control" value="{{!empty($data->button_url1)?$data->button_url1:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Button 2 Text: </label>
            <input name="button_text2" id="button_text2" placeholder="Button 2 Text" class="form-control" value="{{!empty($data->button_text2)?$data->button_text2:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Button 2 URL: </label>
            <input name="button_url2" id="button_url2" placeholder="Button 2 URL" class="form-control " value="{{!empty($data->button_url2)?$data->button_url2:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Start Date<code>*</code>: </label>
            <input name="startdate" id="startdate" placeholder="YYYY-MM-DD" value="{{!empty($data->startdate)?$data->startdate:''}}" class="form-control datepicker" ></input>
        </div>
       
        <div class="col-md-6 mb-2 form-group">
            <label>End Date<code>*</code>: </label>
            <input name="enddate" id="enddate" placeholder="YYYY-MM-DD" class="form-control datepicker" value="{{!empty($data->enddate)?$data->enddate:''}}"></input>
        </div>
        
        <div class="col-md-6 mb-2 form-group">
            <label>Order: </label>
            <input type="number"  name="order" id="order" placeholder="Order" class="form-control" value="{{!empty($data->order)?$data->order:''}}"></input>
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
                <input type="checkbox" id="is_unlimited" name="is_unlimited" value="Y" {{$data->is_unlimited == 'Y' ? 'checked':''}} />
                <label></label>
                <span>Is Unlimited</span>
             
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