@if (!empty($blog_detail))
<div class="main-image">
    <img src="{{asset('uploads/blog_image/'.$blog_detail->image)}}" alt="Blog Details Image">
</div>
<div class="blog-detail">
    <!-- News meta -->
    <ul class="news-meta">
        <li><i class="fa fa-calendar"></i>{{ date('j F, Y', strtotime($blog_detail->postdatead)) }}</li>
        <li><i class="fa fa-eye"></i>{{$blog_detail->view_count ?: 0}}</li>
    </ul>
    <h4 class="blog-title">{{$blog_detail->blog_title}}</h4>
    {!! $blog_detail->content !!}
    
    <!-- Post Nav -->
    <div class="posts_nav">
        @if ($previous)
        <div class="post-left"><a href="{{route('blog-details',"$previous->blog_slug-$previous->id")}}" >Previous Post</a></div>
        @endif
        @if ($next)
        <div class="post-right"><a href="{{route('blog-details',"$next->blog_slug-$next->id")}}" >Next Post</a></div>
        @endif
    </div>
</div>
@endif