@extends('Layout.Main')
@section('content')
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
							<li>
								Blog
							</li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Blog</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>

	<!-- Latest blog -->
    <section class="latest-blog section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="section-title default text-center">
                        <div class="section-top">
                            <h2>
                                {{-- <span>Our Blogs</span> --}}
                                 <b>Latest Blogs</b>
                                </h2>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($data['blog']))
              
                    <div class="blog-latest">
                        <div class="row">
                            @foreach($data['blog'] as $key=>$blog)
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <!-- Single New -->
                                    <div class="single-news">
                                        <div class="news-head overlay">
                                            <figure>
                                                <img src="{{ asset('uploads/blog_image/' . $blog->image) }}" alt="{{ $blog->blog_title }}"/>
                                            </figure>
                                            {{-- <span class="news-img"
                                                style="background-image:url('{{ asset('uploads/blog_image/' . $blog->image) }}')"></span> --}}
                                            <a href="{{ route('blog-details', "$blog->blog_slug-$blog->id") }}"
                                                class="homes-btn theme-2">Read more <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                        <div class="news-body">
                                            <div class="news-content">
                                                <h3 class="news-title">
                                                    <a href="{{ route('blog-details', "$blog->blog_slug-$blog->id") }}">{{ $blog->blog_title }}
                                                    </a>
                                                </h3>
                                                <div class="news-text">
                                                    <p>{{ Illuminate\Support\Str::limit(strip_tags($blog->content), 200, '...') }}
                                                    </p>
                                                </div>
                                                <ul class="news-meta">
                                                    <li class="date"><i
                                                            class="fa fa-calendar"></i>{{ date('j F, Y', strtotime($blog->postdatead)) }}
                                                    </li>
                                                    <li class="view" title="Total Views"><i
                                                            class="fa fa-eye"></i>{{ $blog->view_count ?: 0 }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Single News -->
                                </div>
                            @endforeach
                        </div>
                    </div>
              
            @endif
        </div>
    </section>
    <!--/ End Latest blog -->


@endsection




