@extends('frontend.layout.master')
@section('fronend_title')
contact
@endsection
@section('frontend_content')
@include('frontend.layout.inc.breadcumb',['pagename'=>'Contact'])
<div class="google-map">
    <div class="contact-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.9147703055!2d-74.11976314309273!3d40.69740344223377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbd!4v1547528325671" allowfullscreen=""></iframe>
    </div>
</div>


<div class="contact-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="contact-form form-style">
                    <div class="cf-msg" style="display: none;"></div>
                    <form action="{{ route('contactFormData') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <input type="text" name="name" placeholder="enter your name" class="form-control @error('name')
                                   is-invalid
                                @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-12  col-sm-6">
                                <input type="email" placeholder="enter your email" id="email" name="email" class="form-control @error('email')
                                     is-invalid
                                @enderror">@error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="text" placeholder="Subject" id="subject" name="subject" class="form-control @error('subject')
                                is-invalid
                                @enderror">
                                @error('subject')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <textarea placeholder="Message" id="msg" name="message" class="form-control @error('message')
                                is-invalid
                                @enderror"></textarea>
                                @error('message')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit">SEND MESSAGE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="contact-wrap">
                    <ul>
                        <li>
                            <i class="fa fa-home"></i> Address:
                            <p>1234, Contrary to popular Sed ut perspiciatis unde 1234</p>
                        </li>
                        <li>
                            <i class="fa fa-phone"></i> Email address:
                            <p>
                                <span>info@yoursite.com </span>
                                <span>info@yoursite.com </span>
                            </p>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i> phone number:
                            <p>
                                <span>+0123456789</span>
                                <span>+1234567890</span>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
