@extends('Layout.Main')
@section('content')
<section class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2><i class="fa fa-pencil"></i>Our Blog</h2>
				<ul>
					<li><a href="{{url('/')}}"><i class="fa fa-home"></i>Home</a></li>
					<li class="active"><i class="fa fa-clone"></i>Blogs</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- Blogs Area -->
<section class="blogs-main archives section">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-12">
				<div class="row">
                    @if(!empty($data['blog']))
                    @foreach($data['blog'] as $key=>$blogs)
					<div class="col-lg-6 col-12">
						<!-- Single Blog -->
						@php
							$blogtitle=$blogs->blog_title;
							$bid=$blogs->id;
							$compstr=$blogtitle.' '.$bid;
							$blogslug= clean_url($compstr);
						@endphp
						<div class="single-blog">
							<div class="blog-head">
								<img src="{{ URL::asset('uploads/blog_image/' . $blogs->image) }}" alt="#">
							</div>
							<div class="blog-bottom">
								<div class="blog-inner">
                                    <h4><a href="{{ url("/blog_detail/{$blogslug}") }}">{{!empty($blogs->blog_title)?$blogs->blog_title:''}}</a></h4>
                                    @if(!empty($blogs->content))
                                    <p>{{str_limit(strip_tags($blogs->content),150)}}</p>
                                    @endif
									<div class="meta">
                                        @if(!empty($blogs->author))
                                        <span><i class="fa fa-user"></i><a href="#">{{$blogs->author}}</a></span>
                                        @endif
                                        @if(!empty($blogs->postdatead))
                                        <span><i class="fa fa-calendar"></i>{{date('j F, Y', strtotime($blogs->postdatead))}}</span>
                                        @endif
										<span><i class="fa fa-eye"></i><a href="#">333k</a></span>
									</div>
								</div>
							</div>
						</div>
						<!-- End Single Blog -->
                    </div>
                    @endforeach
                    @endif
					
				</div>
				<div class="row">
					<div class="col-12">
						<!-- Start Pagination -->
						<div class="pagination-main">
							<ul class="pagination">
								<li class="prev"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
								<li><a href="#">1</a></li>
								<li class="active"><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li class="next"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
							</ul>
						</div>
						<!--/ End Pagination -->
					</div>
				</div>	
			</div>
			<div class="col-lg-4 col-12">
				<!-- Blog Sidebar -->
				<aside class="blog-sidebar">
					<!-- Post Tabs -->
					<div class="single-sidebar post-tab">
						<!-- Tab Nav -->
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#popular" role="tab"><i class="fa fa-trophy"></i>Popular</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#recent" role="tab"><i class="fa fa-list-alt"></i>&nbsp; Recent</a></li>
							
						</ul>
						<!--/ End Tab Nav -->
						<div class="tab-content" id="myTabContent">
							<!-- Popular Posts -->
							<div class="tab-pane fade show active" id="popular" role="tabpanel">
                                <!-- Single Post -->
                                @if(!empty($data['popular_blog']))
								@foreach($data['popular_blog'] as $populars)
								@php
									$blogtitle=$populars->blog_title;
									$bid=$populars->id;
									$compstr=$blogtitle.' '.$bid;
									$blogslug= clean_url($compstr);
								@endphp
								<div class="single-post">
									<div class="post-img">
										<img src="{{ URL::asset('uploads/blog_image/' . $populars->image) }}" alt="#">
									</div>
									<div class="post-info">
										<h4><a href="{{ url("/blog_detail/{$blogslug}") }}">{{!empty($populars->blog_title)?$populars->blog_title:''}}</a></h4>
										<p><i class="fa fa-calendar"></i>{{date('j F, Y', strtotime($populars->postdatead))}}</p>
									</div>
                                </div>
                                @endforeach
                                @endif
								
							</div>
							<!--/ End Popular Posts -->
							
                            <!-- recent -->
                            
							<div class="tab-pane fade" id="recent" role="tabpanel">

                                <!-- Single recent -->
                                @if(!empty($data['recent_blog']))
								@foreach($data['recent_blog'] as $recents)
								@php
									$blogtitle=$recents->blog_title;
									$bid=$recents->id;
									$compstr=$blogtitle.' '.$bid;
									$blogslug= clean_url($compstr);
								@endphp
								<div class="single-post">
									<div class="post-img">
										<img src="{{ URL::asset('uploads/blog_image/' . $recents->image) }}" alt="#">
									</div>
									<div class="post-info">
										<h4><a href="{{ url("/blog_detail/{$blogslug}") }}">{{!empty($recents->blog_title)?$recents->blog_title:''}}</a></h4>
										<p><i class="fa fa-calendar"></i>{{date('j F, Y', strtotime($recents->postdatead))}}</p>
									</div>
                                </div>
                            @endforeach
                            @endif
								
							</div>
							<!--/ End recent -->
						</div>
					</div>
					<!--/ End Post Tabs -->	
					<!-- Blog Category -->
					<div class="single-sidebar category">
						<h2><span><i class="fa fa-pencil"></i>Blog Categories</span></h2>
						<ul>
							@if(!empty($data['blog_categories']))
							@foreach($data['blog_categories'] as $bcg)
							@php
								$catname=$bcg->cat_name;
								$bcid=$bcg->id;
								$compstr=$catname.' '.$bcid;
								$catslug= clean_url($compstr);
							@endphp
							<li><a href="{{ url("/categories/{$catslug}") }}"><i class="fa fa-caret-right"></i>{{!empty($bcg->cat_name)?$bcg->cat_name:''}}
								<span>({{!empty($bcg->count_blog)?$bcg->count_blog:''}})</span></a></li>		
							@endforeach
							@endif	
						</ul>
					</div>
					<!--/ End Blog Category -->									
					<!-- Blog Tags -->
					{{-- <div class="single-sidebar tags">
						<h2><span><i class="fa fa-tag"></i>Popular Tags</span></h2>
						<ul>
							<li><a href="#">Consulting</a></li>			
							<li><a href="#">Business</a></li>	
							<li><a href="#">Website</a></li>	
							<li><a href="#">Design</a></li>	
							<li><a href="#">Service</a></li>	
							<li><a href="#">Digital Seo</a></li>	
						</ul>
					</div> --}}
					<!--/ End Blog Tags -->
				</aside>
				<!--/ End Blog Sidebar -->
			</div>
		</div>		
	</div>
</section>
<!--/ End Blogs Area -->
@endsection




