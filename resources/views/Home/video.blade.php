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
                            <li>Video</li>
                        </ul>
                    </div>
                    <div class="bread-title"><h2>Our Video</h2></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

<!-- Video Gallery -->
<section class="section-space video_gallery">
    <div class="container">
        <div class="row">
            @if(!empty($video_gallery))
                @foreach($video_gallery as $key =>$vid)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                    <iframe src="{{$vid->link}}" title="IELTS Speaking Interview | BAND 9 | Real Test!" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                @endforeach
            @endif
            {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                <iframe src="https://www.youtube.com/embed/sWqvWRU0K7k" title="Speech on importance of education in english || Importance of education speech" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                <iframe src="https://www.youtube.com/embed/xfVlMg8Y77Y" title="How to get 90/90 in PTE speaking? | Read Aloud with demonstration by Anusha | Milestone Study |" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                <iframe src="https://www.youtube.com/embed/rxfwonsEifI" title="IELTS Speaking Interview | BAND 9 | Latest 2023 Test!" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                <iframe src="https://www.youtube.com/embed/FVF-3PeHZpE" title="Australia 🇦🇺Student Visa मा Apply गर्दा कति खर्च लाग्छ ?  घरमा बसी-बसी थाहा पाउनुहोस | Nepali 🇳🇵" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                <iframe src="https://www.youtube.com/embed/gjciW4LgTz4" title="UGC NET 2023 | Research Aptitude Complete Revision with Education | Dr. Priyanka Mam" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div> --}}
        </div>
    </div>
</section>

@endsection