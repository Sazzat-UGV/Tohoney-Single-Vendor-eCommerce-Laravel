@extends('frontend.layout.master')

@section('fronend_title')
    Homepage
@endsection   


@section('frontend_content')
    @include('frontend.pages.widgets.slider')

    @include('frontend.pages.widgets.featured')

    @include('frontend.pages.widgets.countdown')

    @include('frontend.pages.widgets.best-seller')

    @include('frontend.pages.widgets.letest-product')

    @include('frontend.pages.widgets.testmonial')
@endsection
