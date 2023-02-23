<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">SEO Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>SEO Menu:</label>
            <span>{{$data->page_name}}</span>
         </div>
       <div class="col-md-4 col-sm-4">
          <label>Title :</label>
          <span>{{$data->seo_title}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
        <label>SEO Meta Keyword:</label>
        <span>{{$data->seo_metakeyword}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>SEO Meta Description:</label>
        <span>{{$data->seo_metadescription}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Schema 1:</label>
        <span>{{$data->schema1}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Schema 2:</label>
        <span>{{$data->schema2}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Is Publish:</label>
        <span>{{$data->isactive}}</span>
     </div>
     
       
       @endif
       
    </div>
   
      