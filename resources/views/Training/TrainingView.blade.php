<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Service Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Title:</label>
            <span>{{$data->title}}</span>
         </div>
         <div class="col-md-4 col-sm-4">
            <label>Image:</label>
            @if(!empty($data->trainer_image))
             <span><img src="{{asset('uploads/trainer_image/'.$data->trainer_image)}}" height="100px" width="100px">'</span>
            @endif
         </div>
         <div class="col-md-4 col-sm-4">
            <label> Content :</label>
            <?php
            echo $data->description;
            ?>
            {{-- <span>{{$data->description}}</span> --}}
         </div>
         <div class="col-md-4 col-sm-4">
            <label>Trainer Name :</label>
            <span>{{$data->trainer_name}}</span>
         </div>

         <div class="col-md-4 col-sm-4">
            <label>Is Publish:</label>
            <span>{{$data->is_publish}}</span>
         </div> 
         
           
   @endif
       
       {{-- <div class="col-md-4 col-sm-4">
         <label>Icon :</label>
         <span>{{$data->icon_name}}</span>
      </div> --}}
      
     
     
{{--      
     <div class="col-md-4 col-sm-4">
        <label> Title:</label>
        <span>{{$data->title}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>seo Keyword:</label>
        <span>{{$data->meta_keyword}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
        <label>SEO Description:</label>
        <span>{{$data->meta_description}}</span>
     </div>  --}}
     {{-- <div class="col-md-4 col-sm-4">
        <label>Order:</label>
        <span>{{$data->order}}</span>
     </div>  --}}
     
       
    </div>
   
      