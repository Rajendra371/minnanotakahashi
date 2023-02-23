<div class="row">
    <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
    <div class="col-md-6 mb-2 form-group">
        <label>Menu Title<code>*</code>: </label>
        <input name="menu_name" id="menu_name" placeholder="Enter Menu" class="form-control" value="{{!empty($data->menu_name)?$data->menu_name:''}}"></input>
    </div>

    <div class="col-md-6 mb-2 form-group">
        <label>Alias: </label>
        <input name="menu_slug" id="menu_slug" placeholder="Autogenerate from title" class="form-control" value="{{!empty($data->menu_slug)?$data->menu_slug:''}}"></input>
    </div>

    <div class="col-md-6 mb-2 form-group">
        <label>Parent Menu: </label>
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
        <label>Menu Item Type <code>*</code>: </label>
        <select name="menu_typeid" id="menu_typeid" class="form-control">
            <option>--Select--</option>
            <option value="custom" @if($data->menu_typeid=='custom') {{"selected=selected"}} @endif>Custom</option>
            <option value="post" @if($data->menu_typeid=='post') {{"selected=selected"}} @endif>Post</option>
            <option value="page" @if($data->menu_typeid=='page') {{"selected=selected"}} @endif>Page</option>
            <option value="gallery" @if($data->menu_typeid=='gallery') {{"selected=selected"}} @endif>Gallery</option>
            <option value="news" @if($data->menu_typeid=='news') {{"selected=selected"}} @endif>News</option>
        </select>
    </div>

    <div class="col-md-6 mb-2 form-group">
        <label>URL: </label>
        <input name="menu_url" id="menu_url" placeholder="Enter URL" class="form-control" value="{{!empty($data->menu_url)?$data->menu_url:''}}"></input>
    </div>

    <div class="col-md-6 mb-2 form-group">
        <label>Display Order<code>*</code>: </label>
        <input name="menu_order" id="menu_order" placeholder="Enter Display Order" class="form-control" value="{{!empty($data->menu_order)?$data->menu_order:''}}"></input>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">            
            
          <div class="checkbox">
            <input type="checkbox" id="menu_isactive" name="menu_isactive" value="Y" {{$data->menu_isactive == 'Y' ? 'checked':''}} />
            <label></label>
            <span>Is Publish</span>
          </div>
        </div>
          
    </div>

   

    <div class="col-md-6 mb-2 form-group">
        <label>Menu Location: </label>
        <input type="checkbox" id="menu_istop" name="menu_istop" value="Y" {{$data->menu_istop == 'Y' ? 'checked':''}} />
        <label></label>
        <span>Top</span>
        <input type="checkbox" id="menu_ismain" name="menu_ismain" value="Y" {{$data->menu_ismain == 'Y' ? 'checked':''}} />
        <label></label>
        <span>Main</span>
        <input type="checkbox" id="menu_isfooter" name="menu_isfooter" value="Y" {{$data->menu_isfooter == 'Y' ? 'checked':''}} />
        <label></label>
        <span>Footer</span>
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