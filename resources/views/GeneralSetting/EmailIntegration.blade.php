<div class="row">
    <input type="hidden" name="id" value="{{!empty($data->id)?$data->id:''}}">
    
    <div class="col-md-6 mb-2">
        <label>Mail From Name<code>*</code>: </label>
        <input name="mail_from_name" id="mail_from_name" class="form-control" value="{{!empty($data->mail_from_name)?$data->mail_from_name:''}}">
    </div>
    
    <div class="col-md-6 mb-2">
        <label>Email<code>*</code>: </label>
        <input name="mail_from_address" id="mail_from_address" class="form-control" value="{{!empty($data->mail_from_address)?$data->mail_from_address:''}}">
    </div>

    <div class="col-md-6 mb-2"   >
        <label>Email Protocol<code>*</code>: </label>
        <select name="email_protocol_typeid" id="email_protocol_typeid" class="form-control">
            <option>--Select--</option>
            @php
                $email_protocol_typeid = $data->email_protocol_typeid ?? '';
            @endphp
            @if(!empty($protocol))
                @foreach($protocol as $men)
                    <option value="{{$men->id}}" @if($email_protocol_typeid==$men->id) {{"selected=selected"}} @endif  >{{$men->protocal_name}} </option>
                @endforeach
            @endif
        </select>
    </div> 

        <div class="col-md-6 mb-2">
        <label>Host Name<code>*</code>: </label>
        <input name="smtp_host" id="smtp_host" class="form-control" value="{{!empty($data->smtp_host)?$data->smtp_host:''}}">
    </div>
    <div class="col-md-6 mb-2">
        <label>SMTP User<code>*</code>: </label>
        <input name="smtp_user" id="smtp_user" class="form-control" value="{{!empty($data->smtp_user)?$data->smtp_user:''}}">
    </div>
    <div class="col-md-6 mb-2">
        <label>Password<code>*</code>: </label>
        <input type="password" name="smtp_password" id="smtp_password" class="form-control" value="{{!empty($data->smtp_password)?$data->smtp_password:''}}">
    </div>
    <div class="col-md-6 mb-2">
        <label>SMTP Port<code>*</code>: </label>
        <input name="smtp_port" id="smtp_port" class="form-control" value="{{!empty($data->smtp_port)?$data->smtp_port:''}}">
    </div>
    <div class="col-md-6 mb-2">
        <label>Email Encryption<code>*</code>: </label>
        <select name="email_encryption_typeid" id="email_encryption_typeid" class="form-control">
            @php
                $email_encryption_typeid = $data->email_encryption_typeid ?? '';
            @endphp
            <option>--Select--</option>
            @if(!empty($encryption))
                
                @foreach($encryption as $men)
                
                    <option value="{{$men->id}}" @if($email_encryption_typeid==$men->id) {{"selected=selected"}} @endif  >{{$men->encryption_name}} </option>
                @endforeach
            @endif
        </select>
    </div> 
    <div class="col-md-6 mb-2">
        <div class="form-group">            
          <div class="checkbox">
            <input type="checkbox" id="is_active" name="is_active" value="Y" {{$data->is_active == 'Y' ? 'checked':''}} /> 
            <label>
            </label>
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
<script>
    load_datepicker('N');
</script>