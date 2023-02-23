<!DOCTYPE html>
<html class="no-js"  lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="/" />
     <?php $base_url=\URL::to('/'); ?>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Styles -->
    <!-- <link href="{{ mix('css/frontend/app.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{asset('/css/modal.css')}}" rel="stylesheet"> -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        
        var base_url="<?php echo $base_url;  ?>";
    </script>
   
</head>
<body>
<div id="app_frontend">
    <!-- @yield('content') -->
</div>

<script src="{{mix('js/frontend/manifest.js')}}" defer></script>
<script src="{{mix('js/frontend/vendor.js')}}" defer></script>
<script src="{{mix('js/frontend/app.js')}}" defer></script>
<!-- JS
============================================ -->

<!-- jQuery JS -->
<script src="{{asset('js/frontend/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('js/frontend/vendor/modernizr-2.8.3.min.js')}}"></script>
<!-- Popper JS -->
<script src="{{asset('js/frontend/popper.min.js')}}"></script>
<!-- Plugins JS -->
{{-- <script src="{{asset('js/frontend/plugins.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('js/frontend/main.js')}}"></script> --}}

<script>
// var windows = $(window);
// var screenSize = windows.width();
// windows.on('scroll', function() {
//     var scroll = windows.scrollTop();
//    if (scroll < 50) {
//         $(nav).removeClass('is-sticky');
//     }else{
//         $(nav).addClass('is-sticky');
//     }
// });

// $(window).on('scroll',function(){
//   $('.headroom-wrapper:has(.headroom--unpinned)').addClass('unpinned')
//   $('.headroom-wrapper:has(.headroom--pinned)').removeClass('unpinned')
//   $('.headroom-wrapper:has(.headroom--unfixed)').removeClass('unpinned')
// })

</script>


</body>
</html>
