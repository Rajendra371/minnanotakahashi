@extends('Layout.Main')
@section('content')

<!-- Breadcrumb -->
<div class="breadcrumbs" style="background-image:url('{{asset('frontend/img/breadcrumbs-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <!-- Bread Menu -->
                    <div class="bread-menu">
                        <ul>
                            <li>
                                <a href="{{route('home')}}">Home</a>
                            </li>
                            <li>Branches</li>
                        </ul>
                    </div>
                    <div class="bread-title"><h2>Our Branches</h2></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

<section class="branches section-space">
    <div class="container">
        @if(!$national_branch->isEmpty())
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <div class="section-title default text-center">
                    <div class="section-top">
                        <h1><span>Other Offices in Nepal</span> <b>Our National Branches</b></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($national_branch as $key=>$nbranch)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="b_box">
                    <h5>{{!empty($nbranch->branch_name)?$nbranch->branch_name:''}}</h5>
                    <ul>
                        @if(!empty($nbranch->contact_person))
                        <li>
                            <i class="fa fa-user"></i> <span>{{!empty($nbranch->contact_person)?$nbranch->contact_person:''}}</span> 
                        </li>
                        @endif
                        @if(!empty($nbranch->branch_location))
                        <li>
                            <i class="fa fa-map-marker"></i> <span>{{!empty($nbranch->branch_location)?$nbranch->branch_location:''}}</span> 
                        </li>
                        @endif
                        @if(!empty($nbranch->contact_number))
                        <li>
                            <i class="fa fa-phone"></i> <span>{{!empty($nbranch->contact_number)?$nbranch->contact_number:''}}</span>
                        </li>
                        @endif
                        @if(!empty($nbranch->email))
                        <li>
                            <i class="fa fa-envelope"></i> <span>{{!empty($nbranch->email)?$nbranch->email:''}}</span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
        @endif
        @if(!$international_branch->isEmpty())
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <div class="section-title default text-center">
                    <div class="section-top">
                        <h1><b>Our International Branches</b></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($international_branch as $key=>$inbranch)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="b_box">
                    <h5>{{!empty($inbranch->branch_name)?$inbranch->branch_name:''}}</h5>
                    <ul>
                        @if(!empty($inbranch->contact_person))
                        <li>
                            <i class="fa fa-user"></i> <span>{{!empty($inbranch->contact_person)?$inbranch->contact_person:''}}</span> 
                        </li>
                        @endif
                        @if(!empty($inbranch->branch_location))
                        <li>
                            <i class="fa fa-map-marker"></i> <span>{{!empty($inbranch->branch_location)?$inbranch->branch_location:''}}</span> 
                        </li>
                        @endif
                        @if(!empty($inbranch->contact_number))
                        <li>
                            <i class="fa fa-phone"></i> <span>{{!empty($inbranch->contact_number)?$inbranch->contact_number:''}}</span>
                        </li>
                        @endif
                        @if(!empty($inbranch->email))
                        <li>
                            <i class="fa fa-envelope"></i> <span>{{!empty($inbranch->email)?$inbranch->email:''}}</span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
        @endif
    </div>
</section>

@endsection