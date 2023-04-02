<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('fronend_title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('frontend.layout.inc.style')
</head>

<body>
    <!--Start Preloader-->
    <div class="preloader-wrap">
        <div class="spinner"></div>
    </div>
    @include('frontend.layout.inc.search')

    @include('frontend.layout.inc.header')


    @yield('frontend_content')


    @include('frontend.layout.inc.newsletter')

    @include('frontend.layout.inc.footer')

    @include('frontend.layout.inc.modal')
    
    @include('frontend.layout.inc.script')
</body>

</html>
