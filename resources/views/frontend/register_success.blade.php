@extends('frontend.layouts.app')

@section('content')
<div class="py-6">
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-md-8 mx-auto">
                <div class="bg-white rounded shadow-sm p-4 text-center">
                    <h1 class="h3 fw-600 mb-3">{{ translate('Your profile is successfully created.') }}</h1>
                    <h5 class="fw-300 mb-3">{{ translate('Thank you for registering  with us.')}}</h5>
                    <p class="opacity-60">
                        {{ translate('Further registration process is as follows') }}
                        {{ translate('Login in to your email account registered with us at the time of registration process and confirm the verification mail received and then login in your profile.') }}
                    </p>
                    
                    <a href="{{ route('login') }}" class="btn btn-primary btn-block">{{ translate('Click here to Login') }}</a>

                    <!--<a href="{{ route('verification.resend') }}" class="btn btn-primary btn-block">{{ translate('Click here to request another') }}</a>-->
                    <!--@if (session('resent'))-->
                    <!--    <div class="alert alert-success mt-2 mb-0" role="alert">-->
                    <!--        {{ translate('A fresh verification link has been sent to your email address.') }}-->
                    <!--    </div>-->
                    <!--@endif-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
