@extends('layouts.master2')
@section('css')

    <style>
        .panel {display: none;}
    </style>


    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{URL::asset('Dashboard/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1>
                                        <ul class="nav">
                                            <li class="">
                                                <div class="dropdown  nav-itemd-none d-md-flex">
                                                    <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <?php

                                                    // dd([
                                                    //     'locale' => app()->getLocale(),
                                                    //     'url' => request()->url()
                                                    // ]);
                                                    ?>
                                                        @if (App::getLocale() == 'ar')
                                                            <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                                                    src="{{URL::asset('Dashboard/img/flags/arabic_flag.jpg')}}" alt="img"></span>
                                                            <strong
                                                                class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                                        @else
                                                            <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                                                    src="{{URL::asset('Dashboard/img/flags/us_flag.jpg')}}" alt="img"></span>
                                                            <strong
                                                                class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                                        @endif
                                                        <div class="my-auto">
                                                        </div>
                                                    </a>
                                                    <?php
                                                    // dd(request());
                                                    ?>
                                                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                                            href="{{  LaravelLocalization::getLocalizedURL($localeCode, null, [], true)}}">
                                                                @if($properties['native'] == "English")
                                                                    <i class="flag-icon flag-icon-us"></i>
                                                                @elseif($properties['native'] == "العربية")
                                                                    <i class="flag-icon flag-icon-eg"></i>
                                                                @endif

                                                                {{ $properties['native'] }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>{{trans('login_page.welcome_back')}}</h2>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif


                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <input type="hidden" name="type" value="user">
                                                <div class="form-group">
                                                    <label>{{ trans('login_page.email') }}</label> <input class="form-control" placeholder="{{ trans('login_page.enter_your_email') }}" type="email" name="email" :value="old('email')" required autofocus>
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ trans('login_page.password') }}</label> <input class="form-control" placeholder="{{ trans('login_page.enter_your_password') }}" type="password" name="password" required autocomplete="current-password">
                                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                </div>
                                                        <!-- Remember Me -->
                                                <div class="block mt-4">
                                                    <label for="remember_me" class="inline-flex items-center">
                                                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ trans('login_page.remember_me') }}</span>
                                                    </label>
                                                </div>
                                                <button class="btn btn-main-primary btn-block" type="submit">{{ trans('login_page.login') }}</button>
                                                <div class="row row-xs">
                                                    <div class="col-sm-6">
                                                        <button class="btn btn-block"><i class="fab fa-facebook-f"></i> {{ trans('login_page.signup_with_facebook') }}</button>
                                                    </div>
                                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                        <button class="btn btn-info btn-block"><i class="fab fa-twitter"></i> {{ trans('login_page.signup_with_twitter') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="main-signin-footer mt-5">
                                                <p><a href="">{{ trans('login_page.forgot_password') }}</a></p>
                                                <p>{{ trans('login_page.donot_have_an_account') }} <a href="{{ url('/' . $page='signup') }}">{{ trans('login_page.create_account') }}</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection
@section('js')
@endsection
