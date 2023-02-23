<div class="position-relative row form-group">
    <input name="id" id="id" type="hidden" class="form-control" value="{{ $data['userdetail']->id}}">
    <div class="col-6 col-sm-6 col-md-6">
        <label class=""><span>User Name</span> <code>*</code>:</label>
    <input name="username" placeholder="User Name" type="text" class="required_field form-control" value="{{ $data['userdetail']->username}}">
    </div>
    <div class="col-6 col-sm-6 col-md-6"><label class=""><span>User Email</span> <code>*</code>:</label>
        <input name="email" placeholder="john@example.com" type="text" class="required_field form-control" value="{{ $data['userdetail']->email}}">
    </div>
</div>
<div class="position-relative row form-group">
        <div class="col-6 col-sm-6 col-md-6">
        <label class=""><span>Password</span> :</label>
        <span id="change_password">******<a href="javascript:void(0)" class="pull-right font_12" id="chang_pass">Change Password</a></span>
            <span id="ChangeResponse"></span>
        </div>
        </div>
       
    </div>

    <div class="position-relative row form-group">
        <div class="col-6 col-sm-6 col-md-6"><label class=""><span>Fullname</span><code>*</code>:</label><input name="fullname" placeholder="Full Name" type="text" class="required_field form-control" value="{{ $data['userdetail']->fullname}}">
        </div>
        <div class="col-6 col-sm-6 col-md-6"><label class=""> <span>Contact</span>:</label><input name="contact" placeholder="Contact Number" type="number" class="form-control" value="{{ $data['userdetail']->contact}}">
        </div>
    </div>

    <div class="position-relative row form-group">
        <div class="col-6 col-sm-6 col-md-6"><label class=""><span>Location</span>: <code>*</code>:</label>
            <select name="user_locationid" id="select" class="form-control select2">
                <option>--Select Location--</option>
              @if(!empty($data['location']))
                @foreach($data['location'] as $loc)
                <option value="{{$loc->id}}" @if($data['userdetail']->user_locationid==$loc->id) {{"selected=selected"}} @endif  >{{$loc->locname}}</option>
                @endforeach
              @endif
            </select> 
        </div>
        <div class="col-6 col-sm-6 col-md-6"><label class=""><span>User Group</span>: <code>*</code>:</label>
            <select name="group_id" id="select1" class="form-control ">
                <option>--Select Usergroup--</option>
                @if(!empty($data['usergroup']))
                @foreach($data['usergroup'] as $usr)
                <option value="{{$usr->id}}"  @if($data['userdetail']->group_id==$usr->id) {{"selected=selected"}} @endif  >{{$usr->groupname}}</option>
                @endforeach
              @endif
            </select> 
        </div>
    </div>
    <div class="clearfix">
    <div class="card-footer" style="margin-top: 40x;">
        <div class="clearfix">
            <div class="float-right">
                <button type="submit" class="save btn btn-primary btn-md"><i class="fa fa-dot-circle-o"></i> <span>Save</span></button> &nbsp;&nbsp;&nbsp;<button type="button" class="btnreset btn btn-danger btn-md"><i class="fa fa-ban"></i> <span>Reset</span></button>
            </div>
        </div>
        <div class="alert-success success"></div>
        <div class="alert-danger error"></div>
    </div>

    <script>
    $('.select2').select2();

    $(document).off('click',"#changed");
    $(document).on('click','#changed',function(){
    var password=$('#password').val();
    var userid=$('#id').val();
    // alert(userid);
    // return false;
    var post_url = '/api/change_password';
    axios
    .post(post_url, { password:password,userid:userid })
    .then(response => {
      var resp = response.data;
    //   console.log(resp.status);
    //   return false;
      if (resp.status == "error") {
        alert(resp.message);
        return false;
      }
      if (resp.status == "success") {
        $('#change_password').html('<p class="text-success">'+resp.message+'</p>');
                     setTimeout(function(){
                   $("#change_password").html('');
                   $("#change_password").html('****** <a href="javascript:void(0);" id="chang_pass">Change Password</a>');
                  },4000);
      } else {
        var focus='';
                  if(data.field=='password')
                  {
                     $("#password").focus()
                  }
                  $('#ChangeResponse').html('<p class="text-danger">'+resp.message+'</p>');
                   setTimeout(function(){
                    $('#ChangeResponse').html('');
                   },3000);
      }
    })
    .catch(error => {
      console.log(error);
    });
});
    </script>