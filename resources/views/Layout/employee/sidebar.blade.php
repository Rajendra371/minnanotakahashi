@php
$current_route = \Route::currentRouteName();
@endphp
<div class="col-lg-1 col-md-2 col-sm-3 col-xs-12 bk-sidebar-2">
    <div class="bk-box" data-spy="affix" id="sidebar">
        <div class="bk-header">
            <h4>Account Menu</h4>
        </div>
        <div class="ac-menu">
            <ul>
                <li @if ($current_route == 'dashboard')
                    class="active"
                    @endif
                    ><a href='{{route('dashboard')}}'> <i class="fa fa-user-o">&nbsp;</i> My
                        Profile </a></li>
                    <li @if ($current_route == 'trainings')
                        class="active"
                        @endif><a href="{{route('trainings')}}"><i class="fa fa-list">&nbsp;</i> Trainings</a>
                    </li>
                {{-- <li @if ($current_route == 'profile.status')
                    class="active"
                    @endif><a href="#"><i class="fa fa-desktop">&nbsp;</i> My Status</a>
                </li>
                <li @if ($current_route == 'user.training')
                    class="active"
                    @endif><a href="#"><i class="fa fa-briefcase">&nbsp;</i> Applied
                        Traning</a>
                </li> --}}
                <li @if ($current_route == 'change-password')
                    class="active"
                    @endif><a href="{{route('change-password')}}"><i class="fa fa-key">&nbsp;</i> Change Password</a>
                </li>

                <li>
                    <form action="{{route('logout')}}" method="post" id="logoutForm1">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger" style="width: 100%; text-align:left;font-size:16px"><i class="fa fa-sign-out">&nbsp;</i> Logout</button>
                      </form>
                </li>
                {{-- <form action="#" method="post" id="logoutForm1">
                    @csrf
                    <li><a href="#" class="save"><i class="fa fa-sign-out">&nbsp;</i> Logout</a></li>
                </form> --}}
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
