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
                                    <li>Message</li>
                                </ul>
                            </div>
                            <div class="bread-title"><h2>Message from Founder</h2></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Breadcrumb -->

        <!-- Message -->
        @if(!empty($foundermessage[0]))
        <section class="section-space message">
            <div class="container">
                <div class="bubbles" data-v-57059ab4 data-v-d293d346>
                    <div class="bubble-1" data-v-d293d346></div>
                    <div class="bubble-2" data-v-d293d346></div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-12">
                        <div class="message-inner">                            
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    @if(!empty($foundermessage[0]->image))
                                    <figure>
                                        <img src="{{ asset('uploads/testimonial_image/' . $foundermessage[0]->image) }}"
                                            alt="{{!empty($foundermessage[0]->name)?$foundermessage[0]->name:''}}">
                                    </figure>
                                    @endif
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                                    @if(!empty($foundermessage[0]->description))
                                    <div class="message-box">
                                        {!!$foundermessage[0]->description!!}
                                        <h5><span>✍️</span> {{!empty($foundermessage[0]->name)?$foundermessage[0]->name:''}}</h5>
                                        <h6>{{!empty($foundermessage[0]->designation)?$foundermessage[0]->designation:''}} <small> | Global Eye Education</small></h6>
                                    </div>
                                    @endif
                                <div class="clearfix"></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!--/ End Message -->

@endsection