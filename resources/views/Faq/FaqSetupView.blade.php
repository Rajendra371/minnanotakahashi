<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">FAQ Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>FAQ Category:</label>
            <span>{{$data->category_name}}</span>
         </div>
       <div class="col-md-4 col-sm-4">
          <label>Title :</label>
          <span>{{$data->title}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
        <label>Description:</label>
        <span>{{$data->description}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Order:</label>
        <span>{{$data->order}}</span>
     </div>
     
     <div class="col-md-4 col-sm-4">
        <label>Is Publish:</label>
        <span>{{$data->is_publish}}</span>
     </div> 
     
       
       @endif
       
    </div>
   
      