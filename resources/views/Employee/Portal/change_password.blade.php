@extends('Layout.employee.app')
@section('content')
<div class="container">
    <div class="row">
        @include('Layout.employee.sidebar')
        <div class="col-lg-11 col-md-10 col-sm-9 col-xs-12">
            <div class="my-profile" style="padding: 0 20px">
            <form action="{{route('change-password')}}" class="form-sec" method="POST" id="changePasswordForm">
                <div class="white-box">
                    <h4>Change Password</h4>
                    <p>&nbsp;</p>
                        <div class="form-group">
                            <label>Current Password*</label>
                            <input type="password" name="old_password" class="form-control"
                                placeholder="Current Password" />
                        </div>
                        <div class="form-group">
                            <label>New Password*</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="New Password" />
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password *</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm New Password" />
                        </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12 form-messages"></div>
                <button type="button" class="btn btn-primary save">Change Password</button>
            </form>  
            </div>     
        </div>
    </div>
</div>
</section>
@endsection