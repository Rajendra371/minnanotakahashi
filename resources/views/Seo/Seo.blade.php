    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
        <div class="col-md-6 mb-2 form-group"   >
            <label>SEO Page <code>*</code>: </label>
            <select name="seo_pageid" id="seo_pageid" class="form-control">
                <option>--Select--</option>
                @if(!empty($seo_page))
                    @foreach($seo_page as $men)
                        <option value="{{$men->id}}" @if($data->seo_pageid==$men->id) {{"selected=selected"}} @endif  >{{$men->page_name}} </option>
                    @endforeach
                @endif
            </select>
        </div> 
         <div class="col-md-6 mb-2 form-group">
            <label>Title <code>*</code>: </label>
            <input name="seo_title" id="seo_title" class="form-control" value="{{!empty($data->seo_title)?$data->seo_title:''}}"></input>
        </div>

         <div class="col-md-6 mb-2 form-group">
            <label>SEO Meta Keyword : </label>
            <input name="seo_metakeyword" id="seo_metakeyword" class="form-control" value="{{!empty($data->seo_metakeyword)?$data->seo_metakeyword:''}}"></input>
        </div>

         <div class="col-md-6 mb-2 form-group">
            <label>SEO Meta Description : </label>
            <textarea  name="seo_metadescription" id="seo_metadescription" class="form-control" >{{!empty($data->seo_metadescription)? "$data->seo_metadescription":''}}</textarea>
        </div>

         <div class="col-md-6 mb-2 form-group">
            <label>Schema 1: </label>
            @php($db_schema1=!empty($data->schema1)?$data->schema1:'')
         <input name="schema1" id="schema1" class="form-control" value="{{$db_schema1}}"></input>
        </div>
        <div class="col-md-6 mb-2 form-group">
            <label>Schema 2: </label>
            <input name="schema2" id="schema2" class="form-control" value={{!empty($data->schema2)?"$data->schema2":''}}></input>
        </div>             
        <div class="col-md-6">
            <div class="form-group">            
                
              <div class="checkbox">
                <input type="checkbox" id="isactive" name="isactive" value="Y" {{$data->isactive == 'Y' ? 'checked':''}} />
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