 <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
        <div class="col-md-3 mb-2 form-group"   >
            <label>Category<code>*</code>: </label>
            <select name="parentid" id="parentid" class="form-control">
                <option>--Select--</option>
                @if(!empty($parentcat))
                    @foreach($parentcat as $men)
                        <option value="{{$men->id}}" @if($data->parentid==$men->id) {{"selected=selected"}} @endif  >{{$men->category_name}} </option>
                    @endforeach
                @endif
            </select>
        </div> 
        <div class="col-md-3 mb-2 form-group">
           <label>Product ID<code>*</code>: </label>
           <input  name="product_id" id="product_id" class="form-control" value="{{!empty($data->product_id)?$data->product_id:''}}" readonly></input>
       </div>
         <div class="col-md-3 mb-2 form-group">
            <label>Product Title<code>*</code>: </label>
            <input name="product_title" id="product_title" class="form-control" value="{{!empty($data->product_title)?$data->product_title:''}}"></input>
        </div>
         <div class="col-md-3 mb-2 form-group">
            <label>Product Code<code>*</code>: </label>
            <input  name="product_code" id="product_code" class="form-control" value="{{!empty($data->product_code)?$data->product_code:''}}"></input>
        </div>
         <div class="col-md-3 mb-2 form-group">
            <label>Branch: </label>
            <select name="branch_id" id="branch_id" class="form-control">
              @if(!empty($fields['branch']))
              @foreach ($fields['branch'] as $branch)
                <option value="{{$branch->id}}" 
                    @if ($data->branch_id == $branch->id)
                        {{"selected"}}
                    @endif
                    >
                {{$branch->branch_name}}
                {{$branch->is_main == "Y" ? "(Main Branch)" : ""}}
              </option>
              @endforeach
              @endif  
            </select>
        </div>
         <div class="col-md-3 mb-2 form-group">
            <label>Color: </label>
            <select name="color_id[]" id="color_id" class="form-control select2" multiple >
                @if(!empty($fields['color']))
                @php
                $colors = array();
                 if(!empty($data->color_id)){
                     $colors = explode(',',$data->color_id);
                 }   
                @endphp
                @foreach ($fields['color'] as $col)
                  <option value="{{$col->id}}" 
                     @foreach ($colors as $color)
                         @if ($col->id == $color )
                             {{"selected"}}
                         @endif
                     @endforeach
                      >
                  {{$col->color_name}}
                </option>
                @endforeach
                @endif  
            </select>
        </div>
         <div class="col-md-3 mb-2 form-group">
            <label>Material: </label>
            <select name="material_id[]" id="material_id" class="form-control select2" multiple >
                @if(!empty($fields['material']))
                @php
                $mat = array();
                 if(!empty($data->material_id)){
                     $mat = explode(',',$data->material_id);
                 }   
                @endphp
                @foreach ($fields['material'] as $mate)
                  <option value="{{$mate->id}}" 
                     @foreach ($mat as $ma)
                         @if ($mate->id == $ma )
                             {{"selected"}}
                         @endif
                     @endforeach
                      >
                  {{$mate->material_name}}
                </option>
                @endforeach
                @endif  
            </select>
        </div>
         <div class="col-md-3 mb-2 form-group">
            <label>Quality: </label>
            <select name="quality_id[]" id="quality_id" class="form-control select2" multiple >
                @if(!empty($fields['quality']))
                @php
                $mat = array();
                 if(!empty($data->quality_id)){
                     $mat = explode(',',$data->quality_id);
                 }   
                @endphp
                @foreach ($fields['quality'] as $mate)
                  <option value="{{$mate->id}}" 
                     @foreach ($mat as $ma)
                         @if ($mate->id == $ma )
                             {{"selected"}}
                         @endif
                     @endforeach
                      >
                  {{$mate->quality_name}}
                </option>
                @endforeach
                @endif  
            </select>
        </div>
         <div class="col-md-3 mb-2 form-group">
            <label>Style: </label>
            <select name="style_id[]" id="style_id" class="form-control select2" multiple >
                @if(!empty($fields['style']))
                @php
                $mat = array();
                 if(!empty($data->style_id)){
                     $mat = explode(',',$data->style_id);
                 }   
                @endphp
                @foreach ($fields['style'] as $mate)
                  <option value="{{$mate->id}}" 
                     @foreach ($mat as $ma)
                         @if ($mate->id == $ma )
                             {{"selected"}}
                         @endif
                     @endforeach
                      >
                  {{$mate->style_name}}
                </option>
                @endforeach
                @endif  
            </select>
        </div>
         <div class="col-md-3 mb-2 form-group">
            <label>Collection: </label>
            <select name="collection_id[]" id="collection_id" class="form-control select2" multiple >
                @if(!empty($fields['collection']))
                @php
                $mat = array();
                 if(!empty($data->collection_id)){
                     $mat = explode(',',$data->collection_id);
                 }   
                @endphp
                @foreach ($fields['collection'] as $mate)
                  <option value="{{$mate->id}}" 
                     @foreach ($mat as $ma)
                         @if ($mate->id == $ma )
                             {{"selected"}}
                         @endif
                     @endforeach
                      >
                  {{$mate->collection_name}}
                </option>
                @endforeach
                @endif  
            </select>
        </div>
         <div class="col-md-3 mb-2 form-group">
            <label>Brand: </label>
            <select name="brand_id[]" id="brand_id" class="form-control select2" multiple >
                @if(!empty($fields['brand']))
                @php
                $mat = array();
                 if(!empty($data->brand_id)){
                     $mat = explode(',',$data->brand_id);
                 }   
                @endphp
                @foreach ($fields['brand'] as $mate)
                  <option value="{{$mate->id}}" 
                     @foreach ($mat as $ma)
                         @if ($mate->id == $ma )
                             {{"selected"}}
                         @endif
                     @endforeach
                      >
                  {{$mate->brand_name}}
                </option>
                @endforeach
                @endif  
            </select>
        </div>
        <div class="col-md-3 mb-2 form-group">
            <label>Shape: </label>
            <select name="shape_id[]" id="shape_id" class="form-control select2" multiple >
                @if(!empty($fields['shape']))
                @php
                $mat = array();
                 if(!empty($data->shape_id)){
                     $mat = explode(',',$data->shape_id);
                 }   
                @endphp
                @foreach ($fields['shape'] as $mate)
                  <option value="{{$mate->id}}" 
                     @foreach ($mat as $ma)
                         @if ($mate->id == $ma )
                             {{"selected"}}
                         @endif
                     @endforeach
                      >
                  {{$mate->shape_name}}
                </option>
                @endforeach
                @endif  
            </select>
        </div>
        
        <div class="col-md-3 mb-2 form-group">
            <label>Waves: </label>
            <select name="waves_id[]" id="waves_id" class="form-control select2" multiple >
                @if(!empty($fields['waves']))
                @php
                $mat = array();
                 if(!empty($data->waves_id)){
                     $mat = explode(',',$data->waves_id);
                 }   
                @endphp
                @foreach ($fields['waves'] as $mate)
                  <option value="{{$mate->id}}" 
                     @foreach ($mat as $ma)
                         @if ($mate->id == $ma )
                             {{"selected"}}
                         @endif
                     @endforeach
                      >
                  {{$mate->waves_name}}
                </option>
                @endforeach
                @endif  
            </select>
        </div>
        
        <div class="col-md-3 mb-2 form-group">
            <label>Pattern: </label>
            <select name="pattern_id[]" id="pattern_id" class="form-control select2" multiple >
                @if(!empty($fields['pattern']))
                @php
                $mat = array();
                 if(!empty($data->pattern_id)){
                     $mat = explode(',',$data->pattern_id);
                 }   
                @endphp
                @foreach ($fields['pattern'] as $mate)
                  <option value="{{$mate->id}}" 
                     @foreach ($mat as $ma)
                         @if ($mate->id == $ma )
                             {{"selected"}}
                         @endif
                     @endforeach
                      >
                  {{$mate->pattern_name}}
                </option>
                @endforeach
                @endif  
            </select>
        </div>
        
         <div class="col-md-3 mb-2 form-group">
            <label>Is Warrenty ?: </label>
            <select name="is_warrenty" id="is_warrenty" class="form-control">
            <option value="Y" {{ $data->is_warrenty == 'Y' ? "selected" :''}}>Yes</option>
            <option value="N" {{ $data->is_warrenty == 'N' ? "selected" :''}}>No</option>
            </select>
        </div>

        <div class="col-md-3 mb-2 form-group warrenty" style={{$data->is_warrenty == 'Y'? '' : 'display:none'}}> 
            <label>Warrenty Upto<code>*</code>: </label>
            <input name="warrenty_upto" id="warrenty_upto" class="form-control datepicker" value={{!empty($data->warrenty_upto)?$data->warrenty_upto:''}}></input>
        </div>
        
        <div class="col-md-12 mb-2">
            <label>Product Description<code>*</code>: </label>
            <textarea  name="product_description" id="product_description" class="form-control ckeditor">{{!empty($data->product_description)?$data->product_description:''}}</textarea>
        </div>

        <div class="col-sm-8 col-md-6 form-group">
            <label class="">Image<code>*</code>:</label>
              <div class="file-upload-wrapper" data-text="Select your image!">
              <input name="file" type="file" class="file-upload-field form-control-file"></div>
          </div>
        <div class="col-sm-4 col-md-6 form-group mt-2">
        @if(!empty($data->image))
              <input type="hidden" name="old_img_file" value="{{$data->image}}" >
              <img src="{{asset('uploads/product_image/'.$data->image)}}" style="height:150px; width:150px; border-radius:.25rem">
              @endif
        </div>
        <div class="col-md-3 mb-2 form-group">
            <label>Expire Date<code>*</code>: </label>
            <input name="expdatead" id="expdatead" class="form-control datepicker" value={{!empty($data->expdatead)?$data->expdatead:''}}></input>
        </div>
        <div class="col-md-3 mb-2 form-group">
            <label>Price<code>*</code>: </label>
            <input  name="price" id="price" class="form-control" value="{{!empty($data->price)?$data->price:''}}"></input>
        </div>
        <div class="col-md-3 mb-2 form-group">
            <label>Discount<code>*</code>: </label>
            <input  name="discount_pc" id="dis_percent" class="form-control calamt" value="{{!empty($data->discount_pc)?$data->discount_pc:''}}"></input> 
        </div>
        <div class="col-md-3 mb-2 form-group">
            <label>Discounted Price<code>*</code>: </label>
            <input  name="discount_amount" id="dis_amt" class="form-control" value="{{!empty($data->discount_amount)?$data->discount_amount:''}}"></input>
        </div>
        <div class="col-md-12 mb-2 form-group">
            <label>FAQ Description: </label>
            <textarea  name="faq_description" id="faq_description" class="form-control ckeditor">
                {{!empty($data->faq_description)?$data->faq_description:''}}
            </textarea>
        </div>
     
        <div class="col-md-3 mb-2 form-group">
            <label>Meta Title: </label>
            <input name="meta_title" id="meta_title" class="form-control" value="{{!empty($data->meta_title)?$data->meta_title:''}}"></input>
        </div>
        <div class="col-md-3 mb-2 form-group">
            <label>Meta Keyword: </label>
            <input name="meta_keyword" id="meta_keyword" class="form-control" value="{{!empty($data->meta_keyword)?$data->meta_keyword:''}}"></input>
        </div>
        <div class="col-md-3 mb-2 form-group">
            <label>Meta Description: </label>
            <input name="meta_description" id="meta_description" class="form-control " value="{{!empty($data->meta_description)?$data->meta_description:''}}"></input>
        </div>
        <div class="col-md-3 mb-2 form-group">
            <label>Order: </label>
            <input type="number" name="order" id="order" class="form-control " value="{{!empty($data->order)?$data->order:''}}"></input>
        </div>
                 
        <div class="col-md-3 align-self-end">
            <div class="form-group">            
              <div class="checkbox">
                <input type="checkbox" id="is_publish" name="is_publish" value="Y" {{$data->is_publish == 'Y' ? 'checked':''}} />
                <label></label>
                <span>Is Publish</span>
              </div>
            </div>
        </div>
        <div class="card-footer w-100 mx-3 mb-2">
            <div class="float-right">
                <button type="submit" class="save btn btn-primary btn-md" data-targetdiv='education_info_employeediv' data-redirect_type='form' data-is_table_refresh="Y" data-target_btn="btnrefresh_edu" > <i class="fa fa-dot-circle-o mr-1"></i>Update</button>
                &nbsp;&nbsp;
                <button type="button" class="btnreset btn btn-danger btn-md"><i class="fa fa-ban mr-1"></i>Reset</button>  
            </div>
        </div>
        <div class="alert-success success"></div>
        <div class="alert-danger error"></div>

    </div>
<script>
    load_ckeditor();
    load_datepicker();
    load_select2();
</script>