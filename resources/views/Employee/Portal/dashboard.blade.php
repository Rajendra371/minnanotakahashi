@extends('Layout.employee.app')
@section('content')
@php
  $user = auth()->guard('employee')->user();
@endphp
    <div class="container">
        <div class="row">
            @include('Layout.employee.sidebar')

            <div class="col-lg-11 col-md-10 col-sm-9 col-xs-12">
                <div class="my-profile">

                    <div class="job-profile section">
                        <div class="user-profile">
                            <div class="user-images">
                                @if ($user->photo)
                                <img class="img-responsive" src="{{ asset("uploads/employee/$user->photo") }}" alt="{{"$user->first_name $user->middle_name $user->last_name"}}">
                                @else
                                <i class="fa fa-user-circle fa-4x img-responsive"></i>    
                                @endif
                            </div>
                            <div class="user">
                                <h2>Hello, <a href="javascript:;">{{"$user->first_name $user->middle_name $user->last_name"}}</a></h2>
                                <h5>You last logged in at: {{$user->last_login_date ?: $user->current_login_date }}</h5>
                                <address>
                                    <ul>
                                        <li>Code: <span>{{$user->empcode}}</span></li>
                                        <li>Designation: <span>{{ $user->designation->designation_name }}</span> </li>
                                        <li>Address: <span>{{ "$user->temp_address1, $user->temp_state, $user->temp_city" }}</span></li>
                                        <li>Phone: <span>{{ $user->mobile1 }}</span> </li>
                                        <li>Email: <span> <a href="javascript:;">{{$user->email}}</a></span>
                                        </li>
                                        <li>Date of Birth:<span>{{ $user->birth_datead ? Carbon\Carbon::parse($user->birth_datead)->format('Y-m-d')  : ''}}</span></li>
                                        <li></li>
                                    </ul>
                                </address>
                            </div>

                            <div class="favorites-user">
                                <div class="my-ads">
                                    <a href="{{route('trainings')}}">{{ $user->trainings()->count() }}<small>Training Completed</small></a>
                                </div>
                            </div>
                        </div><!-- user-profile -->
                    </div><!-- ad-profile -->

                    <div class="resume-content">

                        <div class="career-objective section">
                            <div class="icons">
                                <i class="fa fa-black-tie" aria-hidden="true"></i>
                            </div>
                            <div class="career-info">
                                <h3>Roster </h3>
                                <span>For the week: {{ "$first_week_date - $last_week_date" }}</span>
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active">
                                        <a href="#your_roster" data-toggle="tab" aria-expanded="true">Your Roster</a>
                                    </li>
                                    <li>
                                        <a href="#book_shifts" data-toggle="tab" aria-expanded="false">Extra Shifts</a> 
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    {{-- Employee Roster --}}
                                    <div class="tab-pane  active" id="your_roster">
                                        @include('Employee.Portal.roster_table')
                                    </div> 
                                    {{-- Employee Roster Ends --}} 
                                    {{-- Shift Booking --}}
                                    <div class="tab-pane" id="book_shifts"> 
                                        @include('Employee.Portal.book_shift_table')
                                    </div>
                                    {{-- Shift Booking Ends--}}
                                </div>  
                            </div>
                        </div>
                    </div>
                    <!-- resume-content -->
                </div> 
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script> 
     
    $(document).ready( function () {
      $('#employee_roster').DataTable();
      $('#book_extra_shifts').DataTable();

    });
    
    $(document).off('click','.workStatus');
    $(document).on('click','.workStatus', function(){
        if (confirm('Change Work Status To Complete ?')) {
            let id = $(this).data('id');
            let url = $(this).data('url');
            axios
            .post(url,{id:id})
            .then((response) => {
              if (response.data.status == 'error') {
                alert(response.data.message);
              }
                $('.btnRefresh').trigger('click'); 
            })
            .catch((error) => {
                console.log(error);
            });
        }
    });
    
    $(document).off('click','.clockIn');
    $(document).on('click','.clockIn', function(){
        if (confirm('Confirm Clock In ?')) {
            let id = $(this).data('id');
            let url = $(this).data('url');
            axios
            .post(url,{id:id})
            .then((response) => {
              if (response.data.status == 'error') {
                alert(response.data.message);
              }
                $('.btnRefresh').trigger('click'); 
            })
            .catch((error) => {
                console.log(error);
            });
        }
    });
 

    $(document).off('click','.book_shift');
    $(document).on('click','.book_shift', function(){
        if (confirm('Do You Want To Book This Shift ?')) {
            let id = $(this).data('id');
            let url = $(this).data('url');
            axios
            .post(url,{id:id})
            .then((response) => {
                alert(response.data.message);
                $('.btnRefresh').trigger('click'); 
            })
            .catch((error) => {
                console.log(error);
            });
        }
    });
    </script>
@endsection