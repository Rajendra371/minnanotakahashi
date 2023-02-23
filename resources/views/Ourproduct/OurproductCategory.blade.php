
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       

         <div class="col-md-6 mb-2 form-group">
            <label>Category Name<code>*</code>: </label>
            <input name="ourproduct_cat" id="ourproduct_cat" class="form-control" placeholder="Category Name" value={{!empty($data->ourproduct_cat)?$data->ourproduct_cat:''}}></input>
        </div>

        <div class="col-md-6 mb-2 form-group">
            <label>Code<code>*</code>: </label>
            <input name="code" id="code" class="form-control" placeholder="Code" value={{!empty($data->code)?$data->code:''}}></input>
        </div>
          
        <div class="col-md-6 mb-2 form-group">
            <label>Slug: </label>
            <input name="slug" id="slug" class="form-control" placeholder="Slug" value={{!empty($data->slug)?$data->slug:''}} readonly></input>
        </div>
         <div class="col-md-6 mb-2 form-group">
            <label>Icon Name: </label>
            <input  name="icon" id="icon" class="form-control" placeholder="Icon Name" value="{{!empty($data->icon)?$data->icon:''}}"></input>
        </div>

        <div class="col-md-12 mb-2 form-group">
            <label>Description<code>*</code>: </label>
            <textarea  name="description" id="description" class="form-control ckeditor">{{!empty($data->description)?$data->description:''}}</textarea>
        </div>
        
        <div class="col-md-6 mb-2 form-group">
            <label>SEO Title: </label>
            <input name="seo_title" id="seo_title" placeholder="SEO Title" class="form-control " value={{!empty($data->seo_title)?$data->seo_title:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>SEO Keyword: </label>
            <input name="seo_keyword" id="seo_keyword" placeholder="SEO Keyword" class="form-control " value={{!empty($data->seo_keyword)?$data->seo_keyword:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>SEO Description: </label>
            <input name="seo_description" id="seo_description" placeholder="SEO Description" class="form-control " value={{!empty($data->seo_description)?$data->seo_description:''}}></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Order: </label>
            <input type="number" name="order" id="order" placeholder="Order" class="form-control " value={{!empty($data->order)?$data->order:''}}></input>
        </div>
        


                 
        <div class="col-md-6">
            <div class="form-group">            
                
              <div class="checkbox">
                <input type="checkbox" id="is_active" name="is_active" value="Y" {{$data->is_active == 'Y' ? 'checked':''}} />
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