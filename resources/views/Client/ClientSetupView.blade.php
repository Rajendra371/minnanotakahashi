<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Client Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Client Category:</label>
            <span>{{$data->client_name}}</span>
         </div>
       <div class="col-md-4 col-sm-4">
          <label>Client Name :</label>
          <span>{{$data->client_name}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
        <label>Logo:</label>
        <span><img src="{{asset('uploads/client_logo/'.$data->logo)}}" height="100px" width="100px">'</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>URL:</label>
        <span>{{$data->url}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Icon:</label>
        <span>{{$data->icon}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Content:</label>
        <span>{{$data->content}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Meta Title:</label>
        <span>{{$data->meta_title}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Meta Keyword:</label>
        <span>{{$data->meta_keyword}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
        <label>Meta Description:</label>
        <span>{{$data->meta_description}}</span>
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
   
      