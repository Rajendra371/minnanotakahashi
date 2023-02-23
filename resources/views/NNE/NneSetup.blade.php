
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="position-relative row form-group" >
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       
        <div class="col-md-6 mb-2 form-group"   >
            <label>NNE Category<code>*</code>: </label>
            <select name="category_typeid" id="category_typeid" class="form-control">
                <option>--Select--</option>
                @if(!empty($nne_category))
                   {{-- echo "<pre>";
                    print_r($nne_category);
                    die(); --}}
                    @foreach($nne_category as $men)
                   
                        <option value="{{$men->id}}" @if($data->category_typeid==$men->id) {{"selected=selected"}} @endif  >{{$men->category_name}} </option>
                    @endforeach
                @endif
            </select>
        </div> 
         <div class="col-6 col-sm-6 col-md-6 form-group">
          <label class="">Title<code>*</code>:</label>
            <input name="title" placeholder="Enter title" class="required_field form-control " value="{{!empty($data->title)?$data->title:''}}"></input>
        </div>
        <div class="col-6 col-sm-6 col-md-12 form-group">
            <label>Description<code>*</code>: </label>
            <textarea  placeholder="Enter Description Here" name="description" id="description" class="form-control ckeditor"?>{{!empty($data->description)?$data->description:''}}</textarea>
        </div>


        <div class="col-6 form-group">
          <label class="">Image<code>*</code>:</label>
            <div class="file-upload-wrapper" data-text="Select your image!">
            <input name="file" type="file" class="file-upload-field form-control-file"></div>
            @if(!empty($data->image))
            <input type="hidden" name="old_img_file" value="{{$data->image}}" >
            <img src="{{asset('uploads/nne_image/'.$data->image)}}" style="height:150px; width:150px">
            @endif
        </div>


       
        <div class="col-md-6 mb-2 form-group">
            <label>Icon: </label>
            <input name="icon" id="icon" placeholder="Enter Icon Name" class="form-control" value="{{!empty($data->icon)?$data->icon:''}}"></input>
        </div>
      
        <div class="col-md-6 mb-2 form-group">
            <label>Start Date<code>*</code>: </label>
            <input name="startdate" id="startdate" placeholder="YYYY-MM-DD" class="form-control datepicker" value={{!empty($data->startdate)?$data->startdate:''}}></input>
        </div>
       
        <div class="col-md-6 mb-2 form-group">
            <label>End Date<code>*</code>: </label>
            <input name="enddate" id="enddate" placeholder="YYYY-MM-DD" class="form-control datepicker" value={{!empty($data->enddate)?$data->enddate:''}}></input>
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