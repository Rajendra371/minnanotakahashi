
{{-- <form id="pageForm" action="/api/page/store" class="form" method="POST" encType="multipart/form-data"> --}}
    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
       

         <div class="col-md-6 mb-2 form-group">
            <label>Category Name<code>*</code>: </label>
            <input name="category_name" id="category_name" placeholder="Category Name" class="form-control" value={{!empty($data->category_name)?$data->category_name:''}}></input>
        </div>

          

         <div class="col-md-6 mb-2 form-group">
            <label>Icon Name: </label>
            <input  name="icon" id="icon" class="form-control" placeholder="Fa Fa-book" value={{!empty($data->icon)?$data->icon:''}}></input>
        </div>

        <div class="col-md-6 mb-2 form-group">
            <label>Order: </label>
            <input type="number" name="order" id="order" class="form-control" placeholder="order" value={{!empty($data->order)?$data->order:''}}></input>
        </div>
        

                 
                    <div class="col-md-6">
                    <div class="form-group">            
                        
                      <div class="checkbox">
                        <input type="checkbox" id="advertisement@check" name="is_publish" value="Y" {{$data->is_publish == 'Y' ? 'checked':''}} />
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
</script>