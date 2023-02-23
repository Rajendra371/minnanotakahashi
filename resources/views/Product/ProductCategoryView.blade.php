<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Product Category Detail</h5>
    </div>
    <div class="row">
       <div class="col-md-4 col-sm-4">
          <label>Product Category :</label>
          <span>{{$data->category_name}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
         <label>Category Name :</label>
         <span>{{$data->category_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Icon :</label>
         <span>{{$data->icon}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
        <label>Image :</label>
        <span><img src="{{asset('uploads/product_image/'.$data->image)}}" height="100px" width="100px">'</span>
     </div>
      <div class="col-md-4 col-sm-4">
         <label>Meta Keyword :</label>
         <span>{{$data->meta_keyword}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Meta Title :</label>
         <span>{{$data->meta_title}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Meta Description :</label>
         <span>{{$data->meta_description}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Display Order:</label>
         <span>{{$data->order}}</span>
      </div>
  
      <div class="col-md-4 col-sm-4">
         <label>Is Publish :</label>
         <span>{{$data->is_publish}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Is Featured :</label>
         <span>{{$data->is_featured}}</span>
      </div>
       
       @endif
       
    </div>
   
      