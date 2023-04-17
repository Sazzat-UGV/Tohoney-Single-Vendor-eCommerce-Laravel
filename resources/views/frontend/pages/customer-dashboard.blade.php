@extends('frontend.layout.master')
@section('fronend_title')
Customer Page
@endsection


@section('frontend_content')
@include('frontend.layout.inc.breadcumb',['pagename'=>'Customer Dashboard'])
<div class="col-lg-12 col-md-12 m-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title "> Customer Name: {{ $user->name }}</h4>
        </div>
        <div class="card-body">

        </div>
    </div>
</div>

@endsection
