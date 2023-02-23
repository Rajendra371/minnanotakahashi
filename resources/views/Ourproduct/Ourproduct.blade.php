
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}

    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
        <div class="col-md-6 mb-2 form-group"   >
            <label>Product Category<code>*</code>: </label>
            <select name="product_catid" id="product_catid" class="form-control">
                <option>--Select--</option>
                @if(!empty($product_category)) 
                @foreach($product_category as $cat)
                    <option value="{{$cat->id}}" @if($data->product_catid==$cat->id) {{"selected=selected"}} @endif  >{{$cat->ourproduct_cat}} </option>
                @endforeach
                @endif
            </select>
        </div>

         <div class="col-md-6 mb-2 form-group">
            <label>Name<code>*</code>: </label>
            <input name="title" id="title" placeholder="Enter Name" class="form-control" value="{{!empty($data->title)?$data->title:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Code<code>*</code>: </label>
            <input name="code" id="code" placeholder="Enter Code" class="form-control" value="{{!empty($data->code)?$data->code:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Slug: </label>
            <input name="slug" id="slug" class="form-control" value="{{!empty($data->slug)?$data->slug:''}}" readonly></input>
        </div>
          
        <div class="col-12 form-group">
            <label class="">Image<code>*</code>:</label>
              <div class="file-upload-wrapper" data-text="Select your image!">
              <input name="file" type="file" class="file-upload-field form-control-file"></div>
              @if(!empty($data->image))
              <input type="hidden" name="old_img_file" value="{{$data->image}}" >
              <img src="{{asset('uploads/product_image/'.$data->image)}}" style="height:150px; width:150px">
              @endif
        </div>
        <div class="col-12 form-group">
            <label>Short Content<code>*</code>: </label>
            <textarea  name="short_description" id="short_description" placeholder="Short Content" class="form-control">{{!empty($data->short_description)?$data->short_description:''}}</textarea>
        </div>
        

        <div class="col-md-12 mb-2">
            <label>Description<code>*</code>: </label>
            <textarea name="description" id="description" class="form-control ckeditor ">{{!empty($data->description)?$data->description:''}}</textarea>
        </div>
        <div class="col-md-12 mb-2">
            <label>Features<code>*</code>: </label>
            <textarea name="features" id="features" class="form-control ckeditor ">{{!empty($data->features)?$data->features:''}}</textarea>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Customer: </label>
            <input name="customer" id="customer" placeholder="Customer" class="form-control " value="{{!empty($data->customer)?$data->customer:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Website: </label>
            <input name="website" id="website" placeholder="Website" class="form-control " value="{{!empty($data->website)?$data->website:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Start Date: </label>
            <input name="start_date" id="start_date" placeholder="YYYY-MM-DD" class="form-control datepicker" value="{{!empty($data->start_date)?$data->start_date:''}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>End Date: </label>
            <input name="end_date" id="end_date" placeholder="YYYY-MM-DD" class="form-control datepicker" value="{{!empty($data->end_date)?$data->end_date:''}}"></input>
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