
<div class="row">
        <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
        <div class="col-md-6 mb-2"   >
        <label>Location Code<code>*</code>: </label>
        <input  name="loccode" id="loccode" class="form-control required_field" value="{{!empty($data->loccode)?$data->loccode:''}}" placeholder='Enter Unique Location Code'></input>
        </div> 

        <div class="col-md-6 mb-2">
        <label>Location<code>*</code>: </label>
        <input  name="locname" id="locname" class="form-control required_field" value="{{!empty($data->locname)?$data->locname:''}}"></input>
        </div>
                
        <div class="col-md-6">
            <div class="form-group">            
              <div class="checkbox">
                <input type="checkbox" id="ismain" name="ismain" value="Y" {{$data->ismain == 'Y' ? 'checked':''}} />
                <label></label>
                <span>Main</span>
              </div>
            </div>
              
        </div>
        <div class="col-md-6">
            <div class="form-group">            
              <div class="checkbox">
                <input type="checkbox" id="isactive" name="isactive" value="Y" {{$data->isactive == 'Y' ? 'checked':''}} />
                <label></label> 
                <span>Active</span>
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
