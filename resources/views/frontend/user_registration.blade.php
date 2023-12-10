@extends('frontend.layouts.app')
<style>
    .input-group {
        display: flex;
        position: relative;
    }

    .input-group .form-control {
        flex: 1;
    }

    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>
@if (isset($validator))
    ;
    <?php
    
    print_r($validator);
    ?>
@endif


@section('content')
    <div class="py-4 py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-5 text-center">
                                <h1 class="h3 text-primary mb-0">{{ translate('Create Your Account') }}</h1>
                                <p>{{ translate('Fill out the form to get started') }}.</p>
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="form-default" id="reg-form" role="form" action="{{ route('register') }}"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="on_behalf">{{ translate('Created By') }}</label>
                                            @php $on_behalves = \App\Models\OnBehalf::all(); @endphp
                                            <select
                                                class="form-control aiz-selectpicker @error('on_behalf') is-invalid @enderror"
                                                name="on_behalf" required>
                                                @foreach ($on_behalves as $on_behalf)
                                                    <option value="{{ $on_behalf->id }}">{{ $on_behalf->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('on_behalf')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="name">{{ translate('First Name') }}</label>

                                            <input type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" id="first_name"
                                                placeholder="{{ translate('First Name') }}"
                                                value="{{ old('first_name') }}" onchange="validation();" required>
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="name">{{ translate('Middle Name') }}</label>
                                            <input type="text"
                                                class="form-control @error('middle_name') is-invalid @enderror"
                                                name="middle_name" id="middle_name"
                                                placeholder="{{ translate('Middle Name') }}"
                                                value="{{ old('middle_name') }}">
                                            @error('middle_name')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="name">{{ translate('Last Name') }}</label>
                                            <input type="text"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                name="last_name" id="last_name" placeholder="{{ translate('Last Name') }}"
                                                value="{{ old('last_name') }}">
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label"
                                                for="phone">{{ translate('Mobile Number') }}</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                onchange="validation();" name="phone" value="{{ old('phone') }}"
                                                id="phone" placeholder="{{ translate('Mobile Number') }}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="gender">{{ translate('Gender') }}</label>
                                            <select
                                                class="form-control aiz-selectpicker @error('gender') is-invalid @enderror"
                                                name="gender" required>
                                                <option value="1">{{ translate('Male') }}</option>
                                                <option value="2">{{ translate('Female') }}</option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label"
                                                for="name">{{ translate('Date Of Birth') }}</label>
                                            <input type="text" onchange="validation();"
                                                class="form-control aiz-date-range @error('date_of_birth') is-invalid @enderror"
                                                name="date_of_birth" id="date_of_birth"
                                                placeholder="{{ translate('Date Of Birth') }}" data-single="true"
                                                data-show-dropdown="true" data-max-date="{{ get_max_date() }}"
                                                autocomplete="off" value="{{ old('date_of_birth') }}" required>
                                            @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label"
                                                for="email">{{ translate('Email address') }}</label>
                                            <input type="email" onchange="validation();"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                id="signinSrEmail" value="{{ old('email') }}"
                                                placeholder="{{ translate('Email Address') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="password">{{ translate('Password') }}</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="password"
                                                    onchange="validation();" id="password"
                                                    value="{{ old('password') }}" placeholder="********"
                                                    aria-label="********" required>
                                                <div class="password-toggle">
                                                    <span class="input-group-text">
                                                        <i class="toggle-password fas fa-eye-slash"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <small>{{ translate('Minimum 8 characters') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label"
                                                for="password-confirm">{{ translate('Confirm password') }}</label>
                                            <input type="password" class="form-control" value="{{ old('first_name') }}"
                                                id="password_confirmation" onchange="validation();"
                                                name="password_confirmation" placeholder="********" required>
                                            <small>{{ translate('Minimun 8 characters') }}</small>
                                        </div>
                                    </div>
                                </div>

                                @if (addon_activation('referral_system'))
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label"
                                                    for="email">{{ translate('Referral Code') }}</label>
                                                <input type="text"
                                                    class="form-control{{ $errors->has('referral_code') ? ' is-invalid' : '' }}"
                                                    value="{{ old('referral_code') }}"
                                                    placeholder="{{ translate('Referral Code') }}" name="referral_code">
                                                @if ($errors->has('referral_code'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('referral_code') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (get_setting('google_recaptcha_activation') == 1)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                        @error('g-recaptcha-response')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="checkbox_example_1" required>
                                        <span class=opacity-60>{{ translate('By signing up you agree to our') }}
                                            <a href="{{ env('APP_URL') . '/terms-conditions' }}"
                                                target="_blank">{{ translate('terms and conditions') }}.</a>
                                        </span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                @error('checkbox_example_1')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                                <div class="mb-5">
                                    <button type="submit" class="btn btn-block btn-primary"
                                        id="submitBtn">{{ translate('Create Account') }}</button>
                                    <button type="button" class="btn btn-block btn-primary" id="disable"
                                        disable>{{ translate('Fill Required Details') }}</button>
                                    <div id="errorMsg" class="text-danger mt-2" style="display: none;"></div>
                                </div>
                                @if (get_setting('google_login_activation') == 1 ||
                                        get_setting('facebook_login_activation') == 1 ||
                                        get_setting('twitter_login_activation') == 1 ||
                                        get_setting('apple_login_activation') == 1)
                                    <div class="mb-5">
                                        <div class="separator mb-3">
                                            <span class="bg-white px-3">{{ translate('Or Join With') }}</span>
                                        </div>
                                        <ul class="list-inline social colored text-center">
                                            @if (get_setting('facebook_login_activation') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}"
                                                        class="facebook" title="{{ translate('Facebook') }}"><i
                                                            class="lab la-facebook-f"></i></a>
                                                </li>
                                            @endif
                                            @if (get_setting('google_login_activation') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                                        class="google" title="{{ translate('Google') }}"><i
                                                            class="lab la-google"></i></a>
                                                </li>
                                            @endif
                                            @if (get_setting('twitter_login_activation') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}"
                                                        class="twitter" title="{{ translate('Twitter') }}"><i
                                                            class="lab la-twitter"></i></a>
                                                </li>
                                            @endif
                                            @if (get_setting('apple_login_activation') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'apple']) }}"
                                                        class="apple" title="{{ translate('Apple') }}"><i
                                                            class="lab la-apple"></i></a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif

                                <div class="text-center">
                                    <p class="text-muted mb-0">{{ translate('Already have an account?') }}</p>
                                    <a href="{{ route('login') }}">{{ translate('Login to your account') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade interest_reject_modal" id="updateMassageModal" tabindex="-1" role="dialog"
        aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Complete your profile !') }}</h4>
                </div>
                <div class="modal-body">
                    <p class="mt-1">Your account is not yet approved by admin. Please wait for approval.</p>
                    <button type="button" class="btn btn-info mt-2 action-btn"
                        data-dismiss="modal">{{ translate('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Add Font Awesome for eye icon (if not already added) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            validation();
        });

        function validation() {
            var inputValue = document.getElementById('first_name').value;
            var phone = document.getElementById('phone').value;
            var date_of_birth = document.getElementById('date_of_birth').value;
            var email = document.getElementById('signinSrEmail').value;
            var password = document.getElementById('password').value;
            var password_confirmation = document.getElementById('password_confirmation').value;

            var submitBtn = document.getElementById('submitBtn');
            var disable = document.getElementById('disable');

            if (inputValue === '' || phone === '' || date_of_birth === '' || email === '' || password === '' ||
                password_confirmation === '') {
                submitBtn.style.display = 'none';
                disable.style.display = 'block';
            } else {
                disable.style.display = 'none';
                submitBtn.style.display = 'block';
            }

        }
    </script>
    <script>
        $(document).ready(function() {
            $('.password-toggle').each(function() {
                let input = $(this).prev('.form-control');
                let eye = $(this);

                eye.on('click', function() {
                    if (input.attr('type') === 'password') {
                        input.attr('type', 'text');
                        // eye.removeClass('.fa-eye-slash').addClass('.fa-eye');
                    } else {
                        input.attr('type', 'password');
                        // eye.removeClass('fa-eye').addClass('fa-eye-slash');
                    }
                });
            });
        });
    </script>

    <script>
        /* document.addEventListener('DOMContentLoaded', function () {
            var form = $("#reg-form");
            var submitBtn = $("#submitBtn");
            var errorMsg = $("#errorMsg");

            // Initialize jQuery Validation
            form.validate({
                rules: {
                    first_name: "required",
                    phone: "required",
                    date_of_birth: "required",
                    email: {
                        required: true,
                        email: true
                    },
    				password: {
                        required: true,
                        minlength: 8,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    },
                    checkbox_example_1: "required"
                },
                messages: {
                    first_name: "Please enter your First Name.",
                    phone: "Please enter your Mobile Number.",
                    date_of_birth: "Please enter your Date of Birth.",
                    email: "Please enter a valid email address.",
                    password: {
                        required: "",
                        minlength: "",
                    },
                    password_confirmation: {
                        required: "Please confirm your password.",
                        !equalTo: "Password and Confirm Password must match."
                    },
                    checkbox_example_1: "Please agree to the terms and conditions."
                },
                errorPlacement: function (error, element) {
            // Check if the element has a specific ID for error placement
            var errorElementId = element.attr('id') + '_error';
            var errorElement = $("#" + errorElementId);

            if (errorElement.length) {
                // If the error element exists, display the error message in it
                errorElement.html(error);
            } else {
                // Otherwise, display the error message after the input element
                error.insertAfter(element);
            }
        },
                submitHandler: function (form) {
                    // Log the form data
                    console.log($(form).serializeArray());
                    // Your existing submit handler code...
                }
            });

        });*/
    </script>

<script>
    $(document).ready(function () {
        // Target the form by its ID
        var form = $('#reg-form');

        // Show loader on form submission
        form.on('submit', function () {
            $('.loader-wrapper').show();
        });
    });
</script>

    @if (get_setting('google_recaptcha_activation') == 1)
        @include('partials.recaptcha')
    @endif
    @if (addon_activation('otp_system'))
        @include('partials.emailOrPhone')
    @endif
@endsection
