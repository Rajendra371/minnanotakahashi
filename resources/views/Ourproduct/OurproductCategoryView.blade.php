<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Technology Category Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Category Name:</label>
            <span>{{$data->ourproduct_cat}}</span>
         </div>
         <div class="col-md-4 col-sm-4">
            <label>Code:</label>
            <span>{{$data->code}}</span>
         </div>
         <div class="col-md-4 col-sm-4">
            <label>Slug:</label>
            <span>{{$data->slug}}</span>
         </div>
       <div class="col-md-4 col-sm-4">
          <label>Icon Name:</label>
          <span>{{$data->icon}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
        <label>Description:</label>
        <span>{{$data->description}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>SEO Title:</label>
        <span>{{$data->seo_title}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>SEO Keyword:</label>
        <span>{{$data->seo_keyword}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>SEO Description:</label>
        <span>{{$data->seo_description}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Order:</label>
        <span>{{$data->order}}</span>
     </div> 
     
     <div class="col-md-4 col-sm-4">
        <label>Is Publish:</label>
        <span>{{$data->is_active}}</span>
     </div> 
     
       
       @endif
       
    </div>
   
      