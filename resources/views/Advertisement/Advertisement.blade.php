    <div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
         <div class="col-md-6 mb-2">
            <label>Menu Page<code>*</code>: </label>
            <select name="ad_page_id" id="menu" class="form-control">
                <option>--Select--</option>
                @if(!empty($menu))
                    @foreach($menu as $men)
                        <option value="{{$men->id}}" @if($data->ad_page_id==$men->id) {{"selected=selected"}} @endif  >{{$men->menu_name}} </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md-6 mb-2"   >
            <label>Location<code>*</code>: </label>
            <select name="ad_locationid" id="ad_locationid" class="form-control">
                <option>--Select--</option>
                @if(!empty($location))
                    @foreach($location as $men)
                        <option value="{{$men->id}}" @if($data->ad_locationid==$men->id) {{"selected=selected"}} @endif  >{{$men->location_name}} </option>
                    @endforeach
                @endif
            </select>
        </div> 

         <div class="col-md-12 mb-2">
            <label>Content<code>*</code>: </label>
            <textarea name="content" id="content" class="form-control ckeditor">{{!empty($data->content)?$data->content:''}}</textarea>
        </div>

         <div class="col-md-6 mb-2">
            <label>Start Date<code>*</code>: </label>
            <input name="startdate" id="startdate" class="form-control datepicker" value="{{!empty($data->startdate)?$data->startdate:''}}"></input>
        </div>
        <div class="col-md-6 mb-2">
            <label>End Date<code>*</code>: </label>
            <input name="enddate" id="enddate" class="form-control datepicker" value={{!empty($data->enddate)?$data->enddate:''}}></input>
        </div>
        <div class="col-md-6 mb-2">
            <label>order: </label>
            <input type="number" name="order" id="order" class="form-control" value="{{!empty($data->order)?$data->order:''}}"></input>
        </div>
    </div>
    <div class="row">
        <div class="checkbox col-md-4">
            <input type="checkbox" id="is_publish" name="is_publish" value="Y" {{$data->is_publish == 'Y' ? 'checked':''}}  class="form-control"/>
            <label></label>
            <span>Is Publish</span>
          </div>
        
        <div class="checkbox col-md-4">
            <input type="checkbox" id="is_unlimited" name="is_unlimited" value="Y" {{$data->is_unlimited == 'Y' ? 'checked':''}} class="form-control" />
            <label></label>
            <span>Is Unlimited</span>
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

<script>
    load_datepicker('N');
    load_ckeditor();
</script>