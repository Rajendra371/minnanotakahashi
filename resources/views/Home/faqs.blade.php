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
							<li>FAQS</li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Frequently Asked Questions</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/ End Breadcrumb -->

<section class="faqs section-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
            <div class="section-title default text-center">
                <div class="section-top">
                <h1><span>Faqs</span><b>Frequently Asked Questions</b></h1>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="faqs-main m-top-30">
                    @if(!empty($categories) && count($categories))
                    @foreach ($categories as $index => $category)
                    <h5>{{$category->category_name}}</h5>
                    
                    <div class="row">
                        <div class="col-12">
                            <div id="accordion" role="tablist">
                                <!-- Single Faq -->
                                @if(count($category->faqs))
                                @foreach ($category->faqs as $key => $faq)
                                <div class="single-faq">
                                <div class="faq-heading" role="tab" id="{{"faq_$index$key"}}">
                                    <h4 class="faq-title">
                                        <a  data-toggle="collapse" href="{{"#collapse_$index$key"}}" aria-expanded="true" aria-controls="{{"collapse_$index$key"}}">
                                            <i class="fa fa-plus"></i>
                                            <i class="fa fa-minus"></i>
                                            {{$faq->title}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="{{"collapse_$index$key"}}" class="collapse {{ $key == 0 ? "show" : ""}}" role="tabpanel" aria-labelledby="{{"faq_$index$key"}}" data-parent="#accordion">
                                    <div class="faq-body">
                                        {!! $faq->description !!}
                                    </div>
                                </div>
                                </div>
                                @endforeach
                                @endif											
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>

@endsection
