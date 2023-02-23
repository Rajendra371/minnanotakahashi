
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       

         <div class="col-md-6 mb-2 form-group">
            <label>Category Name<code>*</code>: </label>
            <input name="title" id="title" class="form-control" value={{!empty($data->title)?$data->title:''}}></input>
        </div>

          

         <div class="col-md-6 mb-2 form-group">
            <label>Content<code>*</code>: </label>
            <textarea  name="content" id="content" class="form-control">{{!empty($data->content)?$data->content:''}}</textarea>
        </div>

       
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Title: </label>
            <input  name="seo_title" id="seo_title" class="form-control" value={{!empty($data->seo_title)?$data->seo_title:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Keyword: </label>
            <input  name="seo_keyword" id="seo_keyword" class="form-control" value={{!empty($data->seo_keyword)?$data->seo_keyword:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Meta Description: </label>
            <input  name="seo_description" id="seo_description" class="form-control" value={{!empty($data->seo_description)?$data->seo_description:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Order: </label>
            <input type="number" name="order" id="order" class="form-control " value={{!empty($data->order)?$data->order:''}}></input>
        </div>
        


                 
        <div class="col-md-6">
            <div class="form-group">            
                
              <div class="checkbox">
                <input type="checkbox" id="is_active" name="is_active" value="Y" {{$data->is_active == 'Y' ? 'checked':''}} />
                <label></label>
                <span>Is Active</span>
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
</script>