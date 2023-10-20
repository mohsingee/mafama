@php
    //die(request()->session()->get('language_code'));
    //die(Auth::user()->language);
    if (isset(Auth::user()->language)) {
        $lang_code = Auth::user()->language;
    } else {
        $lang_code = 'en';
    }
    $mysharing_link = \App\User::mysharing_link();
    // $mysharing_link = $mysharing_link . '/' . Auth::user()->language;
    $google_analytics = \App\User::google_analytics_code();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <style>
        .total_expense_by_month,
        .revenue_expense_by_month {
            font-weight: 600;
        }
    </style>
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@@page-discription">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon2.ico') }}?v=2">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Page Title  -->
    <title>MAFAMA.COM</title>
    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- cdn end -->
<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<!-- phone format input lbrary cdn start -->
<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
   <!-- phone format input library cdn end -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Merriweather" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/solid.min.css"
        integrity="sha512-xIEmv/u9DeZZRfvRS06QVP2C97Hs5i0ePXDooLa5ZPla3jOgPT/w6CzoSMPuRiumP7A/xhnUBxRmgWWwU26ZeQ=="
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/solid.min.js"
        integrity="sha512-tmaD3q45JFEAXSixAxEo5p9K8ocD26I5zy42OQ5p7ZwnIx/JaGicXVHNawlZiZTHAU7jBNTl5XyZ8IcGwPG7gQ=="
        crossorigin="anonymous"></script>
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- REVOLUTION SLIDER -->
    <link href="{{ asset('assets/plugins/slider.revolution/css/extralayers.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/slider.revolution/css/settings.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/essentials.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/layout.css') }}" rel="stylesheet" type="text/css" />
    <!-- PAGE LEVEL SCRIPTS -->
    <link href="{{ asset('assets/css/header-1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/color_scheme/green.css') }}" rel="stylesheet" type="text/css" id="color_scheme" />
    <link href="{{ asset('assets/css/layout-datatables.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/fullcalendar.print.css') }}" media="print">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap-formhelpers.min.css') }}">
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>



    {!! $google_analytics !!}
</head>
<style>
    /* nav-tabs.nav-alternate>li>a {
    background-color: #E1F5FE !important;(final one)
    #B3E8FF
}
nav-tabs.nav-alternate>li.active>a {
    background-color: #E1F5FE !important; (final one)
    color: #0a33fb !important;
} */
    .modal-body {
        max-height: 450px;
        overflow-y: auto;
    }

    .folderul {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }

    .folderul li {
        float: left;
    }

    .message_aalert {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #fcffd0;
        border: 2px solid #da291c;
        border-radius: 10px;
        z-index: 999;
    }

    .alert-dismissable .close,
    .alert-dismissible .close {
        font-size: 15px;
        position: relative;
        top: 2px;
        right: -21px;
        color: inherit;
        color: #da291c;
        opacity: .6;
    }

    .alert {
        margin-bottom: 0px
    }

    .full-row td {
        border-left: 0px !important;
        border-right: 0px !important;
    }

    .full-row th {
        border-left: 0px !important;
        border-right: 0px !important;
    }

    .table-scroll {
        position: relative;
        width: 100%;
        margin: auto;
        overflow: hidden;
    }

    .table-wrap {
        width: 100%;
        overflow: auto;
    }

    .table-scroll table {
        width: 100%;
        margin: auto;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-scroll th,
    .table-scroll td {
        padding: 5px 10px;
        white-space: nowrap;
        vertical-align: top;
    }

    .table-scroll thead,
    .table-scroll tfoot {}

    .clone {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
    }

    .clone th,
    .clone td {
        visibility: hidden;
    }

    .clone td,
    .clone th {}

    .clone tbody th {
        visibility: visible;
    }

    .clone .fixed-side {
        text-align: left !important;
        visibility: visible;
    }

    .clone thead,
    .clone tfoot {}

    .fixed-side {
        text-align: left !important;
    }

    .sunmenu-ul {
        padding-left: 0px;
        list-style: none !important;
    }

    .li-submenu .fa-circle {
        font-size: 8px !important;
    }

    section.featured-grid div.row>div .ribbon:before,
    .modal-content {
        border-top-color: #da291c;
    }

    .login_btn {
        line-height: 26px;
    }

    section {
        padding: 25px 0;
    }

    p,
    table {
        margin-bottom: 3px;
    }

    button.swal2-cancel.btn.btn-primary.btn-md.mybtn {
        background: #da291c !important;
        margin-right: 10px;
    }

    .language_flags {
        margin-left: 3px;
        margin-right: 3px;
        width: 25px;
    }
</style>
<!--
        AVAILABLE BODY CLASSES:
        smoothscroll            = create a browser smooth scroll
        enable-animation        = enable WOW animations
        bg-grey                 = grey background
        grain-grey              = grey grain background
        grain-blue              = blue grain background
        grain-green             = green grain background
        grain-blue              = blue grain background
        grain-orange            = orange grain background
        grain-yellow            = yellow grain background
        boxed                   = boxed layout
        pattern1 ... patern11   = pattern background
        menu-vertical-hide      = hidden, open on click
        BACKGROUND IMAGE [together with .boxed class]
        data-background="assets/images/boxed_background/1.jpg') }}"
    -->

<style>
    .grp_0 {
        background: #ff9700 !important;
    }

    .grp_1 {
        background: #00e92c !important;
    }

    .grp_2 {
        background: #ff00d8 !important;
    }

    .grp_3 {
        background: red !important;
    }

    .grp_4 {
        background: #000dff !important;
    }

    .grp_5 {
        background: #f9d163 !important;
    }

    .grp_6 {
        background: #00dbff !important;
    }

    .grp_7 {
        background: #ff46af !important;
    }

    .grp_8 {
        background: #ffc1db !important;
    }

    .grp_9 {
        background: #7cf200 !important;
    }

    .grp_10 {
        background: #80a1ba !important;
    }

    .grp_11 {
        background: #00dbff !important;
    }
</style>

<body class="smoothscroll enable-animation boxed" id="body_listener">

    <div id="loading"
        style="width: 50px; display: none;
  height: 50px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -25px 0 0 -25px;">
        <img src="{{ asset('images/loader.gif') }}">
    </div>
    <!-- wrapper -->
    <div id="wrapper">
        <!-- Top Bar -->
        <div id="topBar">
            <div class="container">
                <nav class="nav-main" style="text-align: center;">
                    <ul id="" class="nav nav-pills text-danger nav-main text-center"
                        style="display: inline-block;">
                        <li class="margin-right-10"><input name="en" value="en" class="language_check mr-4"
                                type="checkbox" {{ $lang_code == 'en' ? 'checked' : '' }} /> <img
                                class="flag-lang language_flags" src="{{ asset('assets/images/flags/us.png') }}"
                                alt="lang" /> English</a></li>
                        <li class="margin-right-10"><input name="es" value="es" class="language_check mr-4"
                                type="checkbox" {{ $lang_code == 'es' ? 'checked' : '' }} /> <img
                                class="flag-lang language_flags" src="{{ asset('assets/images/flags/es.png') }}"
                                alt="lang" /> Espagnol</a></li>
                        <li class="margin-right-10"><input name="fr" value="fr" class="language_check mr-4"
                                type="checkbox" {{ $lang_code == 'fr' ? 'checked' : '' }} /> <img
                                class="flag-lang language_flags" src="{{ asset('assets/images/flags/fr.png') }}"
                                alt="lang" /> Francais</a></li>
                        <li class="margin-right-10"><input name="ht" value="ht" class="language_check mr-4"
                                type="checkbox" {{ $lang_code == 'ht' ? 'checked' : '' }} /> <img
                                class="flag-lang language_flags" src="{{ asset('assets/images/flags/ht.png') }}"
                                alt="lang" /> Kreyol Haiten</a></li>
                        <li class="margin-right-10"><input name="ar" value="ar" class="language_check mr-4"
                                type="checkbox" {{ $lang_code == 'ar' ? 'checked' : '' }} /> <img
                                class="flag-lang language_flags" src="{{ asset('assets/images/flags/sa.png') }}"
                                alt="lang" /> Arabic</a></li>
                        <li class="margin-right-10"><input name="pt" value="pt" class="language_check mr-4"
                                type="checkbox" {{ $lang_code == 'pt' ? 'checked' : '' }} /> <img
                                class="flag-lang language_flags" src="{{ asset('assets/images/flags/pt.png') }}"
                                alt="lang" /> Portuguese</a></li>
                        <li class="margin-right-10"><input name="ko" value="ko" class="language_check mr-4"
                                type="checkbox" {{ $lang_code == 'ko' ? 'checked' : '' }} /> <img
                                class="flag-lang language_flags" src="{{ asset('assets/images/flags/kr.png') }}"
                                alt="lang" /> Korean</a></li>
                        <li class="margin-right-10"><input name="sw" value="sw" class="language_check mr-4"
                                type="checkbox" {{ $lang_code == 'sw' ? 'checked' : '' }} /> <img
                                class="flag-lang language_flags" src="{{ asset('assets/images/flags/tz.png') }}"
                                alt="lang" /> Swahili</a></li>
                        <li class="margin-right-10"><input name="de" value="de" class="language_check mr-4"
                                type="checkbox" {{ $lang_code == 'de' ? 'checked' : '' }} /> <img
                                class="flag-lang language_flags" src="{{ asset('assets/images/flags/de.png') }}"
                                alt="lang" /> German</a></li>
                    </ul>
                </nav>
                <div class="row">
                    <div class="col-md-4 col-xs-12 padding-0">

                        <!-- left -->
                        <!--<ul class="top-links list-inline">
                        <li>
                            <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#"><img class="flag-lang" src="{{ asset('assets/images/flags/us.png') }}" width="16" height="11" alt="lang" /> ENGLISH</a>
                            <ul class="dropdown-langs dropdown-menu">
                                <li><a tabindex="-1" href="#"><img class="flag-lang" src="{{ asset('assets/images/flags/us.png') }}" width="16" height="11" alt="lang" /> ENGLISH</a></li>
                                <li class="divider"></li>
                                <li><a tabindex="-1" href="#"><img class="flag-lang" src="{{ asset('assets/images/flags/de.png') }}" width="16" height="11" alt="lang" /> GERMAN</a></li>
                                <li><a tabindex="-1" href="#"><img class="flag-lang" src="{{ asset('assets/images/flags/ru.png') }}" width="16" height="11" alt="lang" /> RUSSIAN</a></li>
                                <li><a tabindex="-1" href="#"><img class="flag-lang" src="{{ asset('assets/images/flags/it.png') }}" width="16" height="11" alt="lang" /> ITALIAN</a></li>
                            </ul>
                        </li>
                    </ul>-->
                        <ul class="top-links list-inline">
                            <li>
                                <a class="logo" href="{{ url('/') }}">
                                    <img src="{{ asset('images/logo1.jpg') }}" alt="" />
                                </a>
                            </li>
                            <li>
                                @guest
                                    @if (isset($status[0]->affiliatedisplay) && $status[0]->affiliatedisplay == 'on')
                                        <a href="{{ url('affiliate_registration') }}" class="btn btn-lg btn-info"
                                            style="margin-left:10px;width: 100%; line-height: 18px; font-size: 15px;">Affiliate
                                            Registration</a>
                                    @else
                                        <a href="javascript:void(0)" data-toggle="modal"
                                            data-target="#no-registration-form" class="btn btn-lg btn-info"
                                            style="margin-left:10px;width: 100%; line-height: 18px; font-size: 15px;">Affiliate
                                            Registration</a>
                                        @if ($errors->has('contact_no'))
                                            <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                                        @endif
                                    @endif
                                @endguest


                            </li>
                        </ul>

                    </div>

                    <div class="col-md-4 col-xs-12 padding-0 text-center top-bar-sidediv">
                        @if (empty($mysharing_link))
                            <a href="javascript:void(0)" class="btn btn-lg btn-info"
                                style="width: 80%; line-height: 18px; font-size: 15px;">SHARE LINK</a>
                            <div class="margin-top-10">
                                <a class="btn btn-sm btn-success rounded" style="line-height: 10px;">
                                    <i class="fa fa-whatsapp fa-3x padding-0"></i>
                                </a>
                            </div>
                        @else
                            <a data-clipboard-text="{{ $mysharing_link }}" href="javascript:void(0)"
                                class="btn btn-lg btn-info clipboard"
                                style="width: 80%; line-height: 18px; font-size: 15px;">SHARE LINK</a>
                            <div class="margin-top-10">
                                <a class="btn btn-sm btn-success rounded"
                                    href="https://wa.me/?text={{ $mysharing_link }}" style="line-height: 10px;">
                                    <i class="fa fa-whatsapp fa-3x padding-0"></i>
                                </a>
                            </div>
                        @endif
                        <!--<div id="google_translate_button"></div>-->
                        <div id="google_translate_element"></div>
                        <!--<ul class="top-links list-inline text-center" style="float:none;">
                        <li>
                            <a class="no-text-underline"  href="#" style="background-color: #2b7bec;">Link1</a>
                        </li>
                        <li>
                            <a class="no-text-underline"  href="#">Link2</a>
                        </li>
                        <li>
                            <a class="no-text-underline"  href="#">Link3</a>
                        </li>
                        <li>
                            <a class="no-text-underline"  href="#">Link4</a>
                        </li>
                        <li style="border-right:0px;">
                            <a class="no-text-underline"  href="#">Link5</a>
                        </li>
                    </ul>-->
                    </div>
                    <div class="col-md-4 col-xs-12 padding-0 top-bar-sidediv">
                        <!-- right -->
                        <!--<ul class="top-links list-inline pull-right">
                                <li class="text-welcome hidden-xs">Welcome to , <strong>John Doe</strong></li>
                                <li>
                                    <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#"><i class="fa fa-user hidden-xs"></i> MY ACCOUNT</a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a tabindex="-1" href="#"><i class="fa fa-cog"></i> MY SETTINGS</a></li>
                                        <li><a tabindex="-1" href="#"><i class="glyphicon glyphicon-off"></i> LOGOUT</a></li>
                                    </ul>
                                </li>
                            </ul>-->
                        @guest
                            <form method="POST" action="{{ route('login') }}" style="margin-bottom: 0">
                                @csrf
                                <div class="col-md-5 top-bar-col">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="Email Address" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-5 top-bar-col">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2 top-bar-col">
                                    <button type="submit" class="btn btn-sm btn-info login_btn">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="nav-item dropdown text-right userdrop">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-info user-log-button"
                                    href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"
                                        style="margin-left: 10px; color: white;"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <?php
                                        if(Auth::user()->role == "admin"){
                                        ?>
                                    <li>
                                        <a href="{{ url('admin') }}">Dashboard</a>
                                    </li>
                                    <?php } ?>
                                    <?php
                                        if(Auth::user()->role != "admin"){
                                        ?>
                                    <li>
                                        <a href="{{ url('change_password_front') }}">Change Password</a>
                                    </li>
                                    <?php } ?>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        <!-- /Top Bar -->
        <?php

//echo Route::currentRouteName();
            if((Request::is('/')) || in_array(Route::currentRouteName(), ['affiliate_registration','affiliate-preview','paywithpaypal','registration-success','mainpage']) || (Request::is('appointment_login')) || (Request::is('affiliate_registration')) || (Request::is('user_register')) || (Request::is('business_registration')) || (Request::is('search_a_business')) || (Request::is('business_search_step2_detail')) || (Request::is('survey_polls'))){
            ?>
        <div class="row margin-top-10 margin-bottom-10">
            <div class="col-md-3" style="padding-right: 0px;">
                <div style="">
                    @if (count($top_videos) > 0)
                        <div style="margin: auto;">
                            <video width="100%" controls>
                                <source src="<?php echo asset('videos'); ?>/<?= $top_videos[0]->video ?>" type="video/mp4">
                            </video>
                        </div>;
                    @endif

                </div>
            </div>

            <div class="col-md-6 padding-0">
                <div class="owl-carousel nomargin"
                    data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": <?= $slidetime[0]->playtime ?>, "pagination": false}'
                    style="padding: 0 5px;">
                    <?php

                                foreach ($top_banners as $banner) {
                            ?>
                    <div>
                        <img class="img-responsive" src="<?php echo asset('images'); ?>/<?= $banner->image ?>" alt="" />
                    </div>
                    <?php
                                }
                            ?>
                </div>
                <?php
                        if(Auth::id() == null){
                        ?>
                <div class="col-md-6"
                    style="margin-top: 10px; text-align: center; padding-right: 5px; padding-left: 10px;">
                    <a href="{{ url('business_registration') }}" class="btn btn-lg btn-info"
                        style="width: 100%;">Register a Business</a>
                </div>
                <div class="col-md-6"
                    style="margin-top: 10px; text-align: center; padding-left: 5px; padding-right: 10px;">
                    <form action="{{ url('search_a_business') }}" role="form" method="post"
                        style="margin-bottom: 0px;">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="business_search" class="form-control required"
                                placeholder="Search for a Business" style="height: 50px;" />
                            <span class="input-group-btn">
                                <button class="btn btn-info" type="submit" style="height: 50px;"><i
                                        class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <?php
                        }elseif(Auth::id() != ""){
                            if((Auth::user()->role == "client") || (Auth::user()->role == "temp_user")){
                        ?>
                <div class="col-md-6"
                    style="margin-top: 10px; text-align: center; padding-right: 5px; padding-left: 10px;">
                    <a href="{{ url('business_registration') }}" class="btn btn-lg btn-info"
                        style="width: 100%;">Register a Business</a>
                </div>
                <div class="col-md-6"
                    style="margin-top: 10px; text-align: center; padding-left: 5px; padding-right: 10px;">
                    <form action="{{ url('search_a_business') }}" role="form" method="post"
                        style="margin-bottom: 0px;">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="business_search" class="form-control required"
                                placeholder="Search for a Business" style="height: 50px;" />
                            <span class="input-group-btn">
                                <button class="btn btn-info" type="submit" style="height: 50px;"><i
                                        class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <?php
                            }
                       }
                       ?>
            </div>
            @if (count($top_videos) > 0)
                <div class="col-md-3" style="padding-left: 0px;">
                    <div style="">
                        <div style="margin: auto;">
                            <video width="100%" controls>
                                <source src="<?php echo asset('videos'); ?>/<?= $top_videos[0]->video ?>" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <!-- <iframe width="100%" height="260px" src="<?php //echo asset("videos")
                    ?>/<?= $top_videos[0]->video ?>" style="border-radius: 10px"></iframe> -->
                </div>
            @endif
        </div>
        <?php
            }
            elseif((Request::is('banner')) || (Request::segment(1) == 'member_appointment_step3') || (Request::segment(1) == 'member_appointment_step4') || (Request::segment(1) == 'member_appointment_step5') || (Request::segment(1) == 'member_confirm_appointment') || (Request::segment(1) == 'member_print_appointment') || (Request::segment(1) == 'user_appointment_step3') || (Request::segment(1) == 'user_appointment_step4') || (Request::segment(1) == 'user_appointment_step5') || (Request::segment(1) == 'user_confirm_appointment') || (Request::segment(1) == 'user_print_appointment')){
            ?>
        @yield('abanner')
        <?php }elseif(Request::is('calender_meeting')){ ?>
        <?php
            }else{
            ?>
        <div class="row">
            <div class="col-md-12 padding-0" style="margin-bottom: 10px;">
                <?php if(Auth::id() != ""){ ?>
                <?php if((Auth::user()->role == "affiliate")||(Auth::user()->role == "affiliate_user")){ ?>
                <?php if($aabanner[0]->preview == ""){ ?>
                <div class="owl-carousel nomargin"
                    data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": <?= $slidetime[0]->playtime ?>, "pagination": false}'
                    style="padding: 0 5px;">
                    <?php
                                    foreach ($top_banners as $banner) {
                                ?>
                    <div>
                        <img class="img-responsive" src="<?php echo asset('images'); ?>/<?= $banner->image ?>" alt=""
                            style="height: 200px" />
                    </div>
                    <?php
                                    }
                                ?>
                </div>
                <?php }else{ ?>
                {!! $aabanner[0]->preview !!}
                <?php }
                        }else{ ?>
                <div class="owl-carousel nomargin"
                    data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": <?= $slidetime[0]->playtime ?>, "pagination": false}'
                    style="padding: 0 5px;">
                    <?php
                                    foreach ($top_banners as $banner) {
                                ?>
                    <div>
                        <img class="img-responsive" src="<?php echo asset('images'); ?>/<?= $banner->image ?>" alt=""
                            style="height: 200px" />
                    </div>
                    <?php
                                    }
                                ?>
                </div>
                <?php }}
                        else{ ?>
                <div class="owl-carousel nomargin"
                    data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": <?= $slidetime[0]->playtime ?>, "pagination": false}'
                    style="padding: 0 5px;">
                    <?php
                                    foreach ($top_banners as $banner) {
                                ?>
                    <div>
                        <img class="img-responsive" src="<?php echo asset('images'); ?>/<?= $banner->image ?>" alt=""
                            style="height: 200px" />
                    </div>
                    <?php
                            }}
                        ?>
                </div>
            </div>
            <?php
            }
            ?>
            <!--
                AVAILABLE HEADER CLASSES
                Default nav height: 96px
                .header-md      = 70px nav height
                .header-sm      = 60px nav height
                .noborder       = remove bottom border (only with transparent use)
                .transparent    = transparent header
                .translucent    = translucent header
                .sticky         = sticky header
                .static         = static header
                .dark           = dark header
                .bottom         = header on bottom
                shadow-before-1 = shadow 1 header top
                shadow-after-1  = shadow 1 header bottom
                shadow-before-2 = shadow 2 header top
                shadow-after-2  = shadow 2 header bottom
                shadow-before-3 = shadow 3 header top
                shadow-after-3  = shadow 3 header bottom
                .clearfix       = required for mobile menu, do not remove!
                Example Usage:  class="clearfix sticky header-sm transparent noborder"
            -->
            <div id="header" class="sticky clearfix">
                <!-- TOP NAV -->
                <header id="topNav">
                    <div class="container">
                        <!-- Mobile Menu Button -->
                        <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                        <!-- Logo -->
                        <!--<a class="logo pull-left" href="{{ url('/') }}">
                            <img src="{{ asset('images/logo1.jpg') }}" alt="" />
                        </a>-->
                        <!--
                            Top Nav
                            AVAILABLE CLASSES:
                            submenu-dark = dark sub menu
                        -->
                        <div class="navbar-collapse nav-main-collapse collapse submenu-dark" style="float: none;">
                            <?php
                            if((Auth::id() != "") && (Auth::user()->role == "affiliate_user")){
                                $menu = App\Http\Controllers\HomeController::getclientmenu(Auth::user()->email);
                                $menu2 = App\Http\Controllers\HomeController::getclientmenu2(Auth::user()->email);
                                $timee = App\Http\Controllers\HomeController::getclienttime(Auth::user()->email);

                            ?>
                            <nav class="nav-main" style="text-align: center;">
                                <ul id="topMain" class="nav nav-pills nav-main text-center"
                                    style="display: inline-block;">
                                    <?php if((Auth::id() != "") && (Auth::user()->role == "affiliate")){ ?>
                                    <li><a href="{{ url('/') }}"><i class="fas fa-home"
                                                style="font-style: normal"></i></a></li>
                                    <li><a href="{{ url('notifications') }}">
                                            <div class="noti_sec"><i class="fas fa-bell"></i><span
                                                    class="noti_count">{{ notification_count() }}</span></div>
                                        </a></li>
                                    <li><a href="{{ url('front_dashboard') }}">Dashboard</a></li>
                                    <?php }else{ ?>
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <?php } ?>
                                    <?php
                                        if($timee != "block"){
                                            $time = explode(',', $timee);
                                            $starttime = $time[0];
                                            $endtime = $time[0];
                                            $now = date('H:i');

                                         // echo "($now >= $starttime) && ($now <= $endtime)";die;
                                            if( ($now >= $starttime) && ($now <= $endtime)){
                                        ?>
                                    <li class="dropdown mega-menu">
                                        <!-- HOME -->
                                        <a class="dropdown-toggle" href="#">
                                            Settings
                                        </a>
                                        <ul class="dropdown-menu" style="left: 16%;">
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <?php

                                                                                if(($links[0]->status == "on") && ($menu2->setting_profile == "on")){
                                                                            ?>
                                                                <a href="{{ url('profile') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Profile
                                                                </a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[0]->status == "on") && ($menu2->setting_banner == "on")){
                                                                            ?>
                                                                <a href="{{ url('banner') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Banner</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <!--  <li>
                                                                            <?php
                                                                                if(($links[2]->status == "on") && ($menu2->setting_import_contact == "on")){
                                                                            ?>
                                                                                    <a href="{{ url('import_contacts') }}"><i class="fa fa-caret-square-o-right"></i> Import Contact</a>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </li> -->
                                                            <li>
                                                                <?php
                                                                                if(($links[3]->status == "on") && ($menu2->setting_user_access_role == "on")){
                                                                            ?>
                                                                <a href="{{ url('user_access_rights') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> User
                                                                    Access Roles</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[4]->status == "on") && ($menu2->setting_survey == "on")){
                                                                            ?>
                                                                <a href="{{ url('survey_polls') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Survey/Polls</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <!--<li><a href=""><i class="fa fa-caret-square-o-right"></i> Calender meetings/Tasks</a></li>-->
                                                            <li>
                                                                <?php
                                                                                if(($links[5]->status == "on") && ($menu2->setting_appointment == "on")){
                                                                            ?>
                                                                <a href="{{ url('add_appointment_setting') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Appointment</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <?php
                                                                                if(($links[6]->status == "on") && ($menu2->setting_client_management == "on")){
                                                                            ?>
                                                                <a href="{{ url('client_mgmt_setting') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Client
                                                                    Management</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[7]->status == "on") && ($menu2->setting_email_management == "on")){
                                                                            ?>
                                                                <a href="{{ url('email_mgmt_setting') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Email
                                                                    Management</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[8]->status == "on") && ($menu2->setting_financial_management == "on")){
                                                                            ?>
                                                                <a href="{{ url('financial_mgmt_setting') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Financial Management</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[9]->status == "on") && ($menu2->setting_upload_library == "on")){
                                                                            ?>
                                                                <a href="{{ url('forms_library') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Upload
                                                                    Form Library</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>

                                                            <li>
                                                                <?php
                                                                                if(($links[10]->status == "on") && ($menu2->setting_tutorial == "on")){
                                                                            ?>
                                                                <a href="{{ url('setting_tutorials') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Tutorial</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>

                                                            <li>
                                                                <?php
                                                                // if(($links[11]->status == "on") && ($menu2->setting_birthplace == "on")){
                                                                ?>
                                                                <a href="{{ url('setting_birthplace') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Birthplace - City Project</a>
                                                                <?php
                                                                // }
                                                                ?>
                                                            </li>

                                                            <li>
                                                                <a href="{{ url('setting_art_and_culture') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Art and Culture</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('setting_top_city_news') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Top City News</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('setting_my_faith') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    My Faith</a>
                                                            </li>
                                                            @if (Auth::check())
                                                                @php
                                                                    $plan = \App\ActivePlan::is_active_plan();
                                                                @endphp
                                                                @if ($plan == 0)

                                                                    @if (Auth::user()->role == 'affiliate_user')
                                                                        <li>
                                                                            <a href="{{ url('renew-plan') }}"><i
                                                                                    class="fa fa-caret-square-o-right"></i>
                                                                                Renew Plan</a>
                                                                        </li>
                                                                    @endif
                                                                @endif
                                                            @endif

                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                                    if(($menu->make_appointment == "") && ($menu->change_appointment == "") && ($menu->cancel_appointment == "") && ($menu->appointment_comparison == "") && ($menu->add_client == "") && ($menu->manage_appointment == "") && ($menu->appointment_tutorial == "")){}
                                                        else{
                                                ?>
                                    <li class="dropdown mega-menu">
                                        <!-- PAGES -->
                                        <a class="dropdown-toggle" href="#">
                                            Appointment
                                        </a>
                                        <ul class="dropdown-menu" style="left: 24%;">
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <?php
                                                                                if(($links[14]->status == "on") && ($menu->manage_appointment == "on")){
                                                                            ?>
                                                                <a href="{{ url('manage_appointment') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Manage
                                                                    My Appointments</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[12]->status == "on") && ($menu->change_appointment == "on")){
                                                                            ?>
                                                                <a href="{{ url('change_appointment') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Change
                                                                    Appointment</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[13]->status == "on") && ($menu->cancel_appointment == "on")){
                                                                            ?>
                                                                <a href="{{ url('cancel_appointment') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Cancel
                                                                    Appointment</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[58]->status == "on") && ($menu->appointment_comparison == "on")){
                                                                            ?>
                                                                <a href="{{ url('comparison_appointment') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Appointment Comparison</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <!-- <li>
                                                                            <?php
                                                                                if(($links[59]->status == "on") && ($menu->add_client == "on")){
                                                                            ?>
                                                                                    <a href="{{ url('add_client') }}"><i class="fa fa-caret-square-o-right"></i> Add Client</a>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </li> -->

                                                            <li>
                                                                <?php
                                                                                if(($links[11]->status == "on") && ($menu->make_appointment == "on")){
                                                                            ?>
                                                                <a href="{{ url('appointment_step1') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Make
                                                                    Appointment on the Network</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[15]->status == "on") && ($menu->appointment_tutorial == "on")){
                                                                            ?>
                                                                <a href="{{ url('appointment_tutorials') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Tutorial</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                                    }
                                                ?>
                                    <?php
                                                    if(($menu2->add_client_management == "") && ($menu2->manage_client_profile == "") && ($menu2->schedular == "") && ($menu2->client_comparison == "") && ($menu2->client_access == "") && ($menu2->client_tutorial == "")){}
                                                        else{
                                                ?>
                                    <li class="dropdown mega-menu">
                                        <!-- FEATURES -->
                                        <a class="dropdown-toggle" href="#">
                                            Client Management
                                        </a>
                                        <ul class="dropdown-menu" style="left: 36%;">
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <?php
                                                                                if(($links[16]->status == "on") && ($menu2->add_client_management == "on")){
                                                                            ?>
                                                                <a href="{{ url('add_client') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Add
                                                                    Client</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[17]->status == "on") && ($menu2->manage_client_profile == "on")){
                                                                            ?>
                                                                <a href="{{ url('manage_clients') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Manage
                                                                    Client Profile</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[18]->status == "on") && ($menu2->schedular == "on")){
                                                                            ?>
                                                                <a href="{{ url('schedule_birthday') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Scheduler</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <!--  <li>
                                                                            <?php
                                                                                if(($links[19]->status == "on") && ($menu2->client_comparison == "on")){
                                                                            ?>
                                                                                    <a href="{{ url('comparison_client') }}"><i class="fa fa-caret-square-o-right"></i> Comparison</a>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </li> -->
                                                            <li>
                                                                <?php
                                                                                if(($links[20]->status == "on") && ($menu2->client_access == "on")){
                                                                            ?>
                                                                <a href="{{ url('profile_info') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Client
                                                                    Access</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            @if (Auth::check())
                                                                @if (Auth::user()->role == 'affiliate')
                                                                    <li>
                                                                        <?php
                                                                        if($links[4]->status == "on"){
                                                                    ?>
                                                                        <a href="{{ url('client-survey-records') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Client Survey Results</a>
                                                                        <?php
                                                                        }
                                                                    ?>
                                                                    </li>
                                                                @endif
                                                            @endif



                                                            <li>
                                                                <?php
                                                                                if(($links[21]->status == "on") && ($menu2->client_tutorial == "on")){
                                                                            ?>
                                                                <a href="{{ url('client_tutorials') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Tutorial</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                                    }
                                                ?>
                                    <?php
                                                    if(($menu->email_campaign == "") && ($menu->send_emails == "") && ($menu->send_card == "") && ($menu->send_video == "") && ($menu->send_sms == "") && ($menu->comparison_email == "") && ($menu->manage_email == "") && ($menu->email_tutorial == "")){}
                                                        else{
                                                ?>
                                    <li class="dropdown mega-menu">
                                        <!-- PORTFOLIO -->
                                        <a class="dropdown-toggle" href="#">
                                            Email Management
                                        </a>
                                        <ul class="dropdown-menu email-li" style="left: 50%;">
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <?php
                                                                                    if(($links[22]->status == "on") && ($menu->email_campaign == "on")){
                                                                                ?>
                                                                <a href="{{ url('email_campaign') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Email
                                                                    Campaign</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                    if(($links[23]->status == "on") && ($menu->send_emails == "on")){
                                                                                ?>
                                                                <a href="{{ url('send_email') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Send
                                                                    Emails</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                    if(($links[24]->status == "on") && ($menu->send_card == "on")){
                                                                                ?>
                                                                <a href="{{ url('send_cards') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Send
                                                                    Cards</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                    if(($links[25]->status == "on") && ($menu->send_video == "on")){
                                                                                ?>
                                                                <a href="{{ url('send_video') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Send
                                                                    Videos</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <!--<li><a href="chat.php"><i class="fa fa-caret-square-o-right"></i> Chat</a></li>-->
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <?php
                                                                                    if(($links[27]->status == "on") && ($menu->send_sms == "on")){
                                                                                ?>
                                                                <a href="{{ url('send_sms') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Send
                                                                    SMS</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                    if(($links[28]->status == "on") && ($menu->comparison_email == "on")){
                                                                                ?>
                                                                <a href="{{ url('comparison_email') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Comparison</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                    if(($links[29]->status == "on") && ($menu->manage_email == "on")){
                                                                                ?>
                                                                <a href="{{ url('manage_folders') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Manage</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Manage<i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a></a>
                                                                                <ul class="list-unstyled submenu-ul" style="display: none;">
                                                                                    <li><a href="{{ url('manage_folders') }}"><i class="fa fa fa-circle"></i> Manage Folders</a></li>
                                                                                    <li><a href="manage_contacts.php"><i class="fa fa fa-circle"></i> Manage Contacts</a></li>
                                                                                    <li><a href="manage_emails.php"><i class="fa fa fa-circle"></i> Manage Emails</a></li>
                                                                                    <li><a href="uploads.php"><i class="fa fa fa-circle"></i> Uploads</a></li>
                                                                                    <li><a href=""><i class="fa fa fa-circle"></i> My Mailbox</a></li>
                                                                                </ul>
                                                                            </li>-->
                                                            <li>
                                                                <?php
                                                                                    if(($links[34]->status == "on") && ($menu->email_tutorial == "on")){
                                                                                ?>
                                                                <a href="{{ url('email_tutorials') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Tutorial</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                                    }
                                                ?>
                                    <?php
                                                    if(($menu->record_transaction == "") && ($menu->create_budget == "") && ($menu->create_projection == "") && ($menu->reports == "") && ($menu->financial_comparison == "") && ($menu->financial_tutorial == "")){}
                                                    else{
                                                ?>
                                    <li class="dropdown mega-menu">
                                        <!-- BLOG -->
                                        <a class="dropdown-toggle" href="#">
                                            Financial Management
                                        </a>
                                        <ul class="dropdown-menu financial-li" style="">
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Record Transactions<i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a></a>
                                                                            <ul class="list-unstyled submenu-ul" style="display: none;">
                                                                                <li><a href="{{ url('revenue_records') }}"><i class="fa fa fa-circle"></i> Record Revenues</a></li>
                                                                                <li><a href="expenses_reord.php"><i class="fa fa fa-circle"></i> Record Expenses</a></li>
                                                                                <li><a href="manage_assets.php"><i class="fa fa fa-circle"></i> Record / Manage Assets</a></li>
                                                                                <li><a href=""><i class="fa fa fa-circle"></i> Uploads Files</a></li>
                                                                            </ul>
                                                                        </li>-->
                                                            <li>
                                                                <?php
                                                                                if(($links[35]->status == "on") && ($menu->record_transaction == "on")){
                                                                            ?>
                                                                <a href="{{ url('revenue_records') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Record
                                                                    Transactions</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <!-- <li>
                                                                            <?php
                                                                                if(($links[36]->status == "on") && ($menu->record_transaction == "on")){
                                                                            ?>
                                                                                    <a href="{{ url('balancesheet') }}"><i class="fa fa-caret-square-o-right"></i> Balance sheet</a>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </li> -->
                                                            <li>
                                                                <?php
                                                                                if(($links[38]->status == "on") && ($menu->create_budget == "on")){
                                                                            ?>
                                                                <a href="{{ url('create_budget') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Budget</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[39]->status == "on") && ($menu->create_projection == "on")){
                                                                            ?>
                                                                <a href="{{ url('create_projection') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Projection</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <a href="{{ url('calculator') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Calculator</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <?php
                                                                                if(($links[42]->status == "on") && ($menu->reports == "on")){
                                                                            ?>
                                                                <a href="{{ url('profit_loss_stmt') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Reports</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[45]->status == "on") && ($menu->financial_comparison == "on")){
                                                                            ?>
                                                                <a href="{{ url('comparison_finance') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Financial Comparison</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                if(($links[48]->status == "on") && ($menu->financial_tutorial == "on")){
                                                                            ?>
                                                                <a href="{{ url('financial_tutorials') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Tutorial</a>
                                                                <?php
                                                                                }
                                                                            ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                                    }
                                                ?>

                                    <!--     <li><a href="{{ url('front_archives') }}">Archives</a></li> -->

                                    <?php
                                                    if(($menu->archive_edit == "") && ($menu->archive_delete == "") && ($menu->archive_appointment == "") && ($menu->archive_finance == "") && ($menu->archive_email == "") && ($menu->archive_client == "") && ($menu->archive_comparison == "") && ($menu->archive_tutorial == "")){}
                                                        else{
                                                ?>
                                    <li class="dropdown mega-menu">
                                        <a class="dropdown-toggle" href="#">
                                            Archives
                                        </a>
                                        <ul class="dropdown-menu archives-li" style="">
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <?php
                                                                                    if(($links[50]->status == "on") && ($menu->archive_edit == "on")){
                                                                                ?>
                                                                <a href="{{ url('edit_archives') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Edit</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                    if(($links[51]->status == "on") && ($menu->archive_delete == "on")){
                                                                                ?>
                                                                <a href="{{ url('delete_archives') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Deletion</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                    if(($links[52]->status == "on") && ($menu->archive_appointment == "on")){
                                                                                ?>
                                                                <a href="{{ url('appointment_archives') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Appointment</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                    if(($links[53]->status == "on") && ($menu->archive_finance == "on")){
                                                                                ?>
                                                                <a href="{{ url('financial_archives') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Financial Management</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <?php
                                                                                    if(($links[54]->status == "on") && ($menu->archive_client == "on")){
                                                                                ?>
                                                                <a href="{{ url('client_archives') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Clients
                                                                    Management</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                    if(($links[55]->status == "on") && ($menu->archive_email == "on")){
                                                                                ?>
                                                                <a href="{{ url('email_archives') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Email
                                                                    Management</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                    if(($links[56]->status == "on") && ($menu->archive_comparison == "on")){
                                                                                ?>
                                                                <a href="{{ url('comparison-tab1') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i> Yearly
                                                                    Comparison</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                                    if(($links[57]->status == "on") && ($menu->archive_tutorial == "on")){
                                                                                ?>
                                                                <a href="{{ url('archives_tutorials') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Tutorial</a>
                                                                <?php
                                                                                    }
                                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                                    }
                                                ?>
                                    <?php
                                            }
                                        }
                                        ?>
                                </ul>
                            </nav>
                            <?php }elseif ((Auth::id() != "") && (Auth::user()->role == "client")) { ?>
                            <nav class="nav-main">
                                <ul id="topMain" class="nav nav-pills nav-main text-center">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <!-- <li><a href="{{ url('client_profile') }}">Profile</a></li> -->
                                    <li>
                                        <?php
                                                if($links[11]->status == "on"){
                                            ?>
                                        <a href="{{ url('appointment_step1') }}">Make Appointment on the Network</a>
                                        <?php
                                                }
                                            ?>
                                    </li>
                                    <li>
                                        <?php
                                                if($links[12]->status == "on"){
                                            ?>
                                        <a href="{{ url('change_appointment') }}">Change Appointment</a>
                                        <?php
                                                }
                                            ?>
                                    </li>
                                    <li>
                                        <?php
                                                if($links[13]->status == "on"){
                                            ?>
                                        <a href="{{ url('cancel_appointment') }}">Cancel Appointment</a>
                                        <?php
                                                }
                                            ?>
                                    </li>
                                    <li>
                                        <?php
                                                if($links[20]->status == "on"){
                                            ?>
                                        <a href="{{ url('member_profile_info') }}">Client Access</a>
                                        <?php
                                                }
                                            ?>
                                    </li>
                                    <li>
                                        <a href="{{ url('member_library_form') }}">Client Library Form</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('survey_polls') }}">Survey/Polls</a>
                                    </li>
                                </ul>
                            </nav>
                            <?php }else{ ?>
                            @if (Auth::check())

                                <nav class="nav-main">
                                    <ul id="topMain" class="nav nav-pills nav-main text-center">
                                        <?php if((Auth::id() != "") && (Auth::user()->role == "affiliate")){ ?>
                                        <li><a href="{{ url('/') }}"><i class="fas fa-home"
                                                    style="font-style: normal"></i></a></li>
                                        <li><a href="{{ url('notifications') }}">
                                                <div class="noti_sec"><i class="fas fa-bell"></i><span
                                                        class="noti_count">{{ $count = App\Http\Controllers\MainController::notification_count() }}</span>
                                                </div>
                                            </a></li>
                                        <li><a href="{{ url('front_dashboard') }}">Dashboard</a></li>
                                        <?php }else{ ?>
                                        <li><a href="{{ url('/') }}">Home</a></li>
                                        <?php } ?>
                                        <li class="dropdown mega-menu">
                                            <!-- HOME -->
                                            <a class="dropdown-toggle" href="#">
                                                Settings
                                            </a>
                                            <ul class="dropdown-menu" style="left: 16%;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                @if (isLinkAccess($links[0]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[0]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('profile') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Profile</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[0]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[0]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('banner') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Banner</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[2]->id) == 1)
                                                                    <!--  <li>
                                    <?php
                                        if($links[2]->status == "on"){
                                    ?>
                                            <a href="{{ url('import_contacts') }}"><i class="fa fa-caret-square-o-right"></i> Import Contact</a>
                                    <?php
                                        }
                                    ?>
                                </li> -->
                                                                @endif
                                                                @if (isLinkAccess($links[3]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[3]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('user_access_rights') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            User Access Roles</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[6]->id) == 1)
                                                                    <!--<li><a href=""><i class="fa fa-caret-square-o-right"></i> Calender meetings/Tasks</a></li>-->
                                                                    <li>
                                                                        <?php
                                        if($links[5]->status == "on"){
                                    ?>
                                                                        <a
                                                                            href="{{ url('add_appointment_setting') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Appointment</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                 <!--<li>-->
                                                                 <!--           <a href="{{ url('renew-plan') }}" style="color: hwb(120 0% 49.8%) !important;"><i-->
                                                                 <!--                   class="fa fa-caret-square-o-right" ></i>-->
                                                                 <!--               Renew Plan</a>-->
                                                                 <!--       </li>-->
                                                                         @if (Auth::check())
                                                    @php
                                                    
                                                        $plan_day = \App\Balance_info::get_total_plan_day(Auth::id());
                                                      
                                                    @endphp
                                                    @if ($plan_day > 29)
                                                         <li>
                                                                            <a href="{{ url('renew-plan') }}" style="color: hwb(120 0% 49.8%) !important;"><i
                                                                                    class="fa fa-caret-square-o-right" ></i>
                                                                                Renew Plan</a>
                                                                        </li>
                                                    @endif
                                                @endif
                                                                @if (isLinkAccess($links[4]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[4]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('survey_polls') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Survey/Polls</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                @if (isLinkAccess($links[6]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[6]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('client_mgmt_setting') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Client Management</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[7]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[7]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('email_mgmt_setting') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Email Management</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[8]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[8]->status == "on"){
                                    ?>
                                                                        <a
                                                                            href="{{ url('financial_mgmt_setting') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Financial Management</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Appointment <i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a>
                                    <ul class="list-unstyled submenu-ul" style="display: none;">
                                        <li><a href="{{ url('add_appointment_setting') }}"><i class="fa fa fa-circle"></i> Appointment Settings</a></li>
                                        <li><a href="manag_date_settings.php"><i class="fa fa fa-circle"></i> Manage dates Settings</a></li>
                                    </ul>
                                </li>-->
                                                                <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Client Management <i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a>
                                    <ul class="list-unstyled submenu-ul" style="display: none;">
                                        <li><a href=""><i class="fa fa fa-circle"></i> Client Profile Settings</a></li>
                                        <li><a href=""><i class="fa fa fa-circle"></i> Form Upload</a></li>
                                    </ul>
                                </li>
                                <li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Email Management <i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a>
                                    <ul class="list-unstyled submenu-ul" style="display: none;">
                                        <li><a href=""><i class="fa fa fa-circle"></i> Chat Settings</a></li>
                                    </ul>
                                </li>
                                <li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Financial  Management <i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a>
                                    <ul class="list-unstyled submenu-ul" style="display: none;">
                                        <li><a href="create_revenue_account.php"><i class="fa fa fa-circle"></i> Create Revenue Accounts</a></li>
                                        <li><a href="create_expense_account.php"><i class="fa fa fa-circle"></i> Create Expense Accounts</a></li>
                                        <li><a href="invoice_setup.php"><i class="fa fa fa-circle"></i> Invoice Setup </a></li>
                                        <li><a href="#"><i class="fa fa fa-circle"></i> Balance Sheet</a></li>
                                        <li><a href="templates.php"><i class="fa fa fa-circle"></i> Choose a template</a></li>
                                    </ul>
                                </li>-->
                                                                @if (isLinkAccess($links[9]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[9]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('forms_library') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Upload Form Library</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[10]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[10]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('setting_tutorials') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Tutorial</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                <li>
                                                                    <?php
                                                                    // if($links[11]->status == "on"){
                                                                    ?>
                                                                    <a href="{{ url('setting_birthplace') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Birthplace - City Project</a>
                                                                    <?php
                                                                    // }
                                                                    ?>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ url('setting_art_and_culture') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Art and Culture</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ url('setting_top_city_news') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Top City News 1</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ url('setting_my_faith') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        My Faith</a>
                                                                </li>
                                                                @if (Auth::check())
                                                                    @php
                                                                        $plan = \App\ActivePlan::is_active_plan();
                                                                    @endphp
                                                                    @if ($plan == 0)
                                                                        <li>
                                                                            <a href="{{ url('renew-plan') }}"><i
                                                                                    class="fa fa-caret-square-o-right"></i>
                                                                                Renew Plan</a>
                                                                        </li>
                                                                    @endif
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown mega-menu">
                                            <!-- PAGES -->
                                            <a class="dropdown-toggle" href="#">
                                                Appointment
                                            </a>
                                            <ul class="dropdown-menu" style="left: 24%;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                @if (isLinkAccess($links[14]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[14]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('manage_appointment') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Manage My Appointments</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif

                                                                @if (isLinkAccess($links[12]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[12]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('change_appointment') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Change Appointment</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[13]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[13]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('cancel_appointment') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Cancel Appointment</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[58]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[58]->status == "on"){
                                    ?>
                                                                        <a
                                                                            href="{{ url('comparison_appointment') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Appointment Comparison</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                @if (isLinkAccess($links[59]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[59]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('add_client') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Add Client</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif

                                                                @if (isLinkAccess($links[11]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[11]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('appointment_step1') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Make Appointment on the Network</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif

                                                                @if (isLinkAccess($links[15]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[15]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('appointment_tutorials') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Tutorial</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown mega-menu">
                                            <!-- FEATURES -->
                                            <a class="dropdown-toggle" href="#">
                                                Client Management
                                            </a>
                                            <ul class="dropdown-menu" style="left: 36%;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                @if (isLinkAccess($links[16]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[16]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('add_client') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Add Client</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[17]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[17]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('manage_clients') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Manage Client Profile</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[18]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[18]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('schedule_birthday') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Scheduler</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Scheduler <i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a>
                                    <ul class="list-unstyled submenu-ul" style="display: none;">
                                        <li><a href="{{ url('schedule_birthday') }}"><i class="fa fa fa-circle"></i> Schedule Birthday</a></li>
                                        <li><a href="schedule_holiday.php"><i class="fa fa fa-circle"></i> Schedule Holiday</a></li>
                                    </ul>
                                </li>-->
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                @if (isLinkAccess($links[19]->id) == 1)
                                                                    <!-- <li>
                                    <?php
                                        if($links[19]->status == "on"){
                                    ?>
                                            <a href="{{ url('comparison_client') }}"><i class="fa fa-caret-square-o-right"></i> Comparison</a>
                                    <?php
                                        }
                                    ?>
                                </li> -->
                                                                @endif
                                                                @if (isLinkAccess($links[20]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[20]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('profile_info') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Client Access</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (Auth::check())
                                                                    @if (Auth::user()->role == 'affiliate')
                                                                        @if (isLinkAccess($links[4]->id) == 1)
                                                                            <li>

                                                                                <?php
                                        if($links[4]->status == "on"){
                                    ?>
                                                                                <a
                                                                                    href="{{ url('client-survey-records') }}"><i
                                                                                        class="fa fa-caret-square-o-right"></i>
                                                                                    Client Survey Results</a>
                                                                                <?php
                                        }
                                    ?>
                                                                            </li>
                                                                        @endif
                                                                    @endif
                                                                @endif

                                                                @if (Auth::check())
                                                                    @if (Auth::user()->role == 'affiliate')
                                                                        @if (isLinkAccess($links[4]->id) == 1)
                                                                            <li>

                                                                                <?php
                                        if($links[4]->status == "on"){
                                    ?>
                                                                                <a
                                                                                    href="{{ url('client-report-view') }}"><i
                                                                                        class="fa fa-caret-square-o-right"></i>
                                                                                    Client Report View</a>
                                                                                <?php
                                        }
                                    ?>
                                                                            </li>
                                                                        @endif
                                                                    @endif
                                                                @endif

                                                                <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Client Access <i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a></a>
                                    <ul class="list-unstyled submenu-ul" style="display: none;">
                                        <li><a href="{{ url('profile_info') }}"><i class="fa fa fa-circle"></i> Profile</a></li>
                                        <li><a href="tasks.php"><i class="fa fa fa-circle"></i> Tasks</a></li>
                                    </ul>
                                </li>-->
                                                                @if (isLinkAccess($links[21]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[21]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('client_tutorials') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Tutorial</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown mega-menu">
                                            <!-- PORTFOLIO -->
                                            <a class="dropdown-toggle" href="#">
                                                Email Management
                                            </a>
                                            <ul class="dropdown-menu email-li" style="left: 50%;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                @if (isLinkAccess($links[22]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[22]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('email_campaign') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Email Campaign</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[23]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[23]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('send_email') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Send Emails</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[24]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[24]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('send_cards') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Send Cards</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[25]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[25]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('send_video') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Send Videos</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                <!--<li><a href="chat.php"><i class="fa fa-caret-square-o-right"></i> Chat</a></li>-->
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                @if (isLinkAccess($links[27]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[27]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('send_sms') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Send SMS</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[28]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[28]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('comparison_email') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Comparison</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[29]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[29]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('manage_folders') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Manage</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Manage<i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a></a>
                                    <ul class="list-unstyled submenu-ul" style="display: none;">
                                        <li><a href="{{ url('manage_folders') }}"><i class="fa fa fa-circle"></i> Manage Folders</a></li>
                                        <li><a href="manage_contacts.php"><i class="fa fa fa-circle"></i> Manage Contacts</a></li>
                                        <li><a href="manage_emails.php"><i class="fa fa fa-circle"></i> Manage Emails</a></li>
                                        <li><a href="uploads.php"><i class="fa fa fa-circle"></i> Uploads</a></li>
                                        <li><a href=""><i class="fa fa fa-circle"></i> My Mailbox</a></li>
                                    </ul>
                                </li>-->
                                                                @if (isLinkAccess($links[34]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[34]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('email_tutorials') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Tutorial</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown mega-menu">
                                            <!-- BLOG -->
                                            <a class="dropdown-toggle" href="#">
                                                Financial Management
                                            </a>
                                            <ul class="dropdown-menu financial-li" style="left: 65%;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Record Transactions<i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a></a>
                                    <ul class="list-unstyled submenu-ul" style="display: none;">
                                        <li><a href="{{ url('revenue_records') }}"><i class="fa fa fa-circle"></i> Record Revenues</a></li>
                                        <li><a href="expenses_reord.php"><i class="fa fa fa-circle"></i> Record Expenses</a></li>
                                        <li><a href="manage_assets.php"><i class="fa fa fa-circle"></i> Record / Manage Assets</a></li>
                                        <li><a href=""><i class="fa fa fa-circle"></i> Uploads Files</a></li>
                                    </ul>
                                </li>-->
                                                                @if (isLinkAccess($links[35]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[35]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('revenue_records') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Record Transactions</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[36]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[36]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('balancesheet') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Balance sheet</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[38]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[38]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('create_budget') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Budget</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[39]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[39]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('create_projection') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Projection</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                <li>
                                                                    <a href="{{ url('calculator') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Calculator</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                @if (isLinkAccess($links[42]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[42]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('profit_loss_stmt') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Reports</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[45]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[45]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('comparison_finance') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Financial Comparison</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[48]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[48]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('financial_tutorials') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Tutorial</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown mega-menu">

                                            <!--   -->
                                            <a class="dropdown-toggle" href="#">
                                                Archives
                                            </a>
                                            <ul class="dropdown-menu archives-li" style="left: 65%;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                <li> <a href="{{ url('front_archives') }}"> <i
                                                                            class="fa fa-caret-square-o-right"></i>Archives</a>
                                                                </li>
                                                                @php
                                                                    $enable = 2;
                                                                @endphp
                                                                @if (isLinkAccess($links[50]->id) == $enable)
                                                                    <li>
                                                                        <?php
                                        if($links[50]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('edit_archives') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Edit</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[51]->id) == $enable)
                                                                    <li>
                                                                        <?php
                                        if($links[51]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('delete_archives') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Deletion</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[52]->id) == $enable)
                                                                    <li>
                                                                        <?php
                                        if($links[52]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('appointment_archives') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Appointment</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[53]->id) == $enable)
                                                                    <li>
                                                                        <?php
                                        if($links[53]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('financial_archives') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Financial Management</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                @if (isLinkAccess($links[54]->id) == $enable)
                                                                    <li>
                                                                        <?php
                                        if($links[54]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('client_archives') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Clients Management</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                                @if (isLinkAccess($links[55]->id) == $enable)
                                                                    <li>
                                                                        <?php
                                        if($links[55]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('email_archives') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Email Management</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif

                                                                @if (isLinkAccess($links[56]->id) == 1)
                                                                    <li>
                                                                        <?php
                                        if($links[56]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('comparison-tab1') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Yearly Comparison</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif

                                                                @if (isLinkAccess($links[57]->id) == $enable)
                                                                    <li>
                                                                        <?php
                                        if($links[57]->status == "on"){
                                    ?>
                                                                        <a href="{{ url('archives_tutorials') }}"><i
                                                                                class="fa fa-caret-square-o-right"></i>
                                                                            Tutorial</a>
                                                                        <?php
                                        }
                                    ?>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            @else
                                <nav class="nav-main">
                                    <ul id="topMain" class="nav nav-pills nav-main text-center">
                                        <?php if((Auth::id() != "") && (Auth::user()->role == "affiliate")){ ?>
                                        <li><a href="{{ url('/') }}"><i class="fas fa-home"
                                                    style="font-style: normal"></i></a></li>
                                        <li><a href="{{ url('notifications') }}">
                                                <div class="noti_sec"><i class="fas fa-bell"></i><span
                                                        class="noti_count">{{ $count = App\Http\Controllers\MainController::notification_count() }}</span>
                                                </div>
                                            </a></li>
                                        <li><a href="{{ url('front_dashboard') }}">Dashboard</a></li>
                                        <?php }else{ ?>
                                        <li><a href="{{ url('/') }}">Home</a></li>
                                        <?php } ?>
                                        <li class="dropdown mega-menu">
                                            <!-- HOME -->
                                            <a class="dropdown-toggle" href="#">
                                                Settings
                                            </a>
                                            <ul class="dropdown-menu" style="left: 16%;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">

                                                                <li>
                                                                    <?php
                                                    if($links[0]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('profile') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Profile</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>

                                                                <li>
                                                                    <?php
                                                    if($links[0]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('banner') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Banner</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                <!--  <li>
                                                <?php
                                                    if($links[2]->status == "on"){
                                                ?>
                                                        <a href="{{ url('import_contacts') }}"><i class="fa fa-caret-square-o-right"></i> Import Contact</a>
                                                <?php
                                                    }
                                                ?>
                                            </li> -->
                                                                <li>
                                                                    <?php
                                                    if($links[3]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('user_access_rights') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        User Access Roles</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                <!--<li><a href=""><i class="fa fa-caret-square-o-right"></i> Calender meetings/Tasks</a></li>-->
                                                                <li>
                                                                    <?php
                                                    if($links[5]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('add_appointment_setting') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Appointment</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                <li>
                                                                    <?php
                                                    if($links[4]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('survey_polls') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Survey/Polls</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <?php
                                                    if($links[6]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('client_mgmt_setting') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Client Management</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                <li>
                                                                    <?php
                                                    if($links[7]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('email_mgmt_setting') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Email Management</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                <li>
                                                                    <?php
                                                    if($links[8]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('financial_mgmt_setting') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Financial Management</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                
                                                                <li>
                                                                    <?php
                                                    if($links[9]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('forms_library') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Upload Form Library</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                <li>
                                                                    <?php
                                                    if($links[10]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('setting_tutorials') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Tutorial</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                <?php
                                                                // if($links[11]->status == "on"){
                                                                ?>
                                                                <a href="{{ url('setting_birthplace') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Birthplace - City Project</a>
                                                                <?php
                                                                // }
                                                                ?>
                                                </li>
                                                <li>
                                                    <a href="{{ url('setting_art_and_culture') }}"><i
                                                            class="fa fa-caret-square-o-right"></i>
                                                        Art and Culture</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('setting_top_city_news') }}"><i
                                                            class="fa fa-caret-square-o-right"></i>
                                                        Top City News</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('setting_my_faith') }}"><i
                                                            class="fa fa-caret-square-o-right"></i>
                                                        My Faith</a>
                                                </li>
                                                @if (Auth::check())
                                                    @php
                                                        $plan = \App\ActivePlan::is_active_plan();
                                                    @endphp
                                                    @if ($plan == 0)
                                                        <li>
                                                            <a href="{{ url('renew-plan') }}"><i
                                                                    class="fa fa-caret-square-o-right"></i>
                                                                Renew Plan</a>
                                                        </li>
                                                    @endif
                                                @endif
                                            </ul>
                        </div>

                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <?php
                                                    if($links[6]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('client_mgmt_setting') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Client Management</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                <li>
                                                                    <?php
                                                    if($links[7]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('email_mgmt_setting') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Email Management</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                <li>
                                                                    <?php
                                                    if($links[8]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('financial_mgmt_setting') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Financial Management</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                
                                                                <li>
                                                                    <?php
                                                    if($links[9]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('forms_library') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Upload Form Library</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                <li>
                                                                    <?php
                                                    if($links[10]->status == "on"){
                                                ?>
                                                                    <a href="{{ url('setting_tutorials') }}"><i
                                                                            class="fa fa-caret-square-o-right"></i>
                                                                        Tutorial</a>
                                                                    <?php
                                                    }
                                                ?>
                                                                </li>
                                                                <?php
                                                                // if($links[11]->status == "on"){
                                                                ?>
                                                                <a href="{{ url('setting_birthplace') }}"><i
                                                                        class="fa fa-caret-square-o-right"></i>
                                                                    Birthplace - City Project </a>
                                                                <?php
                                                                // }
                                                                ?>
                                                </li>
                                                <li>
                                                    <a href="{{ url('setting_art_and_culture') }}"><i
                                                            class="fa fa-caret-square-o-right"></i>
                                                        Art and Culture</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('setting_top_city_news') }}"><i
                                                            class="fa fa-caret-square-o-right"></i>
                                                        Top City News</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('setting_my_faith') }}"><i
                                                            class="fa fa-caret-square-o-right"></i>
                                                        My Faith</a>
                                                </li>
                                                @if (Auth::check())
                                                    @php
                                                        $plan = \App\ActivePlan::is_active_plan();
                                                    @endphp
                                                    @if ($plan == 0)
                                                        <li>
                                                            <a href="{{ url('renew-plan') }}"><i
                                                                    class="fa fa-caret-square-o-right"></i>
                                                                Renew Plan</a>
                                                        </li>
                                                    @endif
                                                @endif
                                            </ul>
                        </div>
                    </div>
                    </li>
                    </ul>
                    </li>
                    <li class="dropdown mega-menu">
                        <!-- PAGES -->
                        <a class="dropdown-toggle" href="#">
                            Appointment
                        </a>
                        <ul class="dropdown-menu" style="left: 24%;">
                            <li>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li>
                                                <?php
                                                    if($links[14]->status == "on"){
                                                ?>
                                                <a href="{{ url('manage_appointment') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Manage My Appointments</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>

                                            <li>
                                                <?php
                                                    if($links[12]->status == "on"){
                                                ?>
                                                <a href="{{ url('change_appointment') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Change Appointment</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[13]->status == "on"){
                                                ?>
                                                <a href="{{ url('cancel_appointment') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Cancel Appointment</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[58]->status == "on"){
                                                ?>
                                                <a href="{{ url('comparison_appointment') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Appointment Comparison</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li>
                                                <?php
                                                    if($links[59]->status == "on"){
                                                ?>
                                                <a href="{{ url('add_client') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Add Client</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>

                                            <li>
                                                <?php
                                                    if($links[11]->status == "on"){
                                                ?>
                                                <a href="{{ url('appointment_step1') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Make Appointment on the Network</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>

                                            <li>
                                                <?php
                                                    if($links[15]->status == "on"){
                                                ?>
                                                <a href="{{ url('appointment_tutorials') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Tutorial</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown mega-menu">
                        <!-- FEATURES -->
                        <a class="dropdown-toggle" href="#">
                            Client Management
                        </a>
                        <ul class="dropdown-menu" style="left: 36%;">
                            <li>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li>
                                                <?php
                                                    if($links[16]->status == "on"){
                                                ?>
                                                <a href="{{ url('add_client') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Add Client</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[17]->status == "on"){
                                                ?>
                                                <a href="{{ url('manage_clients') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Manage Client Profile</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[18]->status == "on"){
                                                ?>
                                                <a href="{{ url('schedule_birthday') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Scheduler</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Scheduler <i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a>
                                                <ul class="list-unstyled submenu-ul" style="display: none;">
                                                    <li><a href="{{ url('schedule_birthday') }}"><i class="fa fa fa-circle"></i> Schedule Birthday</a></li>
                                                    <li><a href="schedule_holiday.php"><i class="fa fa fa-circle"></i> Schedule Holiday</a></li>
                                                </ul>
                                            </li>-->
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <!-- <li>
                                                <?php
                                                    if($links[19]->status == "on"){
                                                ?>
                                                        <a href="{{ url('comparison_client') }}"><i class="fa fa-caret-square-o-right"></i> Comparison</a>
                                                <?php
                                                    }
                                                ?>
                                            </li> -->
                                            <li>
                                                <?php
                                                    if($links[20]->status == "on"){
                                                ?>
                                                <a href="{{ url('profile_info') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Client Access</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            @if (Auth::check())
                                                @if (Auth::user()->role == 'affiliate')
                                                    <li>
                                                        <?php
                                                    if($links[4]->status == "on"){
                                                ?>
                                                        <a href="{{ url('client-survey-records') }}"><i
                                                                class="fa fa-caret-square-o-right"></i>
                                                            Client Survey Results</a>
                                                        <?php
                                                    }
                                                ?>
                                                    </li>
                                                @endif
                                            @endif
                                            <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Client Access <i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a></a>
                                                <ul class="list-unstyled submenu-ul" style="display: none;">
                                                    <li><a href="{{ url('profile_info') }}"><i class="fa fa fa-circle"></i> Profile</a></li>
                                                    <li><a href="tasks.php"><i class="fa fa fa-circle"></i> Tasks</a></li>
                                                </ul>
                                            </li>-->
                                            <li>
                                                <?php
                                                    if($links[21]->status == "on"){
                                                ?>
                                                <a href="{{ url('client_tutorials') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Tutorial</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown mega-menu">
                        <!-- PORTFOLIO -->
                        <a class="dropdown-toggle" href="#">
                            Email Management
                        </a>
                        <ul class="dropdown-menu email-li" style="left: 50%;">
                            <li>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li>
                                                <?php
                                                    if($links[22]->status == "on"){
                                                ?>
                                                <a href="{{ url('email_campaign') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Email Campaign</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[23]->status == "on"){
                                                ?>
                                                <a href="{{ url('send_email') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Send Emails</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[24]->status == "on"){
                                                ?>
                                                <a href="{{ url('send_cards') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Send Cards</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[25]->status == "on"){
                                                ?>
                                                <a href="{{ url('send_video') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Send Videos</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <!--<li><a href="chat.php"><i class="fa fa-caret-square-o-right"></i> Chat</a></li>-->
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li>
                                                <?php
                                                    if($links[27]->status == "on"){
                                                ?>
                                                <a href="{{ url('send_sms') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Send SMS</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[28]->status == "on"){
                                                ?>
                                                <a href="{{ url('comparison_email') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Comparison</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[29]->status == "on"){
                                                ?>
                                                <a href="{{ url('manage_folders') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Manage</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Manage<i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a></a>
                                                <ul class="list-unstyled submenu-ul" style="display: none;">
                                                    <li><a href="{{ url('manage_folders') }}"><i class="fa fa fa-circle"></i> Manage Folders</a></li>
                                                    <li><a href="manage_contacts.php"><i class="fa fa fa-circle"></i> Manage Contacts</a></li>
                                                    <li><a href="manage_emails.php"><i class="fa fa fa-circle"></i> Manage Emails</a></li>
                                                    <li><a href="uploads.php"><i class="fa fa fa-circle"></i> Uploads</a></li>
                                                    <li><a href=""><i class="fa fa fa-circle"></i> My Mailbox</a></li>
                                                </ul>
                                            </li>-->
                                            <li>
                                                <?php
                                                    if($links[34]->status == "on"){
                                                ?>
                                                <a href="{{ url('email_tutorials') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Tutorial</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown mega-menu">
                        <!-- BLOG -->
                        <a class="dropdown-toggle" href="#">
                            Financial Management
                        </a>
                        <ul class="dropdown-menu financial-li" style="left: 65%;">
                            <li>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <!--<li class="li-submenu"><a class="" href="javascript:void(0);"><i class="fa fa-caret-square-o-right"></i> Record Transactions<i class="fa fa-angle-down pull-right" style="margin-top:5px;"></i></a></a>
                                                <ul class="list-unstyled submenu-ul" style="display: none;">
                                                    <li><a href="{{ url('revenue_records') }}"><i class="fa fa fa-circle"></i> Record Revenues</a></li>
                                                    <li><a href="expenses_reord.php"><i class="fa fa fa-circle"></i> Record Expenses</a></li>
                                                    <li><a href="manage_assets.php"><i class="fa fa fa-circle"></i> Record / Manage Assets</a></li>
                                                    <li><a href=""><i class="fa fa fa-circle"></i> Uploads Files</a></li>
                                                </ul>
                                            </li>-->
                                            <li>
                                                <?php
                                                    if($links[35]->status == "on"){
                                                ?>
                                                <a href="{{ url('revenue_records') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Record Transactions</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[36]->status == "on"){
                                                ?>
                                                <a href="{{ url('balancesheet') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Balance sheet</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[38]->status == "on"){
                                                ?>
                                                <a href="{{ url('create_budget') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Budget</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[39]->status == "on"){
                                                ?>
                                                <a href="{{ url('create_projection') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Projection</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <a href="{{ url('calculator') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Calculator</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li>
                                                <?php
                                                    if($links[42]->status == "on"){
                                                ?>
                                                <a href="{{ url('profit_loss_stmt') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Reports</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[45]->status == "on"){
                                                ?>
                                                <a href="{{ url('comparison_finance') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Financial Comparison</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[48]->status == "on"){
                                                ?>
                                                <a href="{{ url('financial_tutorials') }}"><i
                                                        class="fa fa-caret-square-o-right"></i>
                                                    Tutorial</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown mega-menu">
                    <li><a href="{{ url('front_archives') }}">Archives</a></li>
                    <!-- <a class="dropdown-toggle" href="#">
                            Archives
                        </a>
                        <ul class="dropdown-menu archives-li" style="left: 65%;">
                            <li>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li>
                                                <?php
                                                    if($links[50]->status == "on"){
                                                ?>
                                                        <a href="{{ url('edit_archives') }}"><i class="fa fa-caret-square-o-right"></i> Edit</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[51]->status == "on"){
                                                ?>
                                                        <a href="{{ url('delete_archives') }}"><i class="fa fa-caret-square-o-right"></i> Deletion</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[52]->status == "on"){
                                                ?>
                                                        <a href="{{ url('appointment_archives') }}"><i class="fa fa-caret-square-o-right"></i> Appointment</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[53]->status == "on"){
                                                ?>
                                                        <a href="{{ url('financial_archives') }}"><i class="fa fa-caret-square-o-right"></i> Financial Management</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li>
                                                <?php
                                                    if($links[54]->status == "on"){
                                                ?>
                                                        <a href="{{ url('client_archives') }}"><i class="fa fa-caret-square-o-right"></i> Clients Management</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[55]->status == "on"){
                                                ?>
                                                        <a href="{{ url('email_archives') }}"><i class="fa fa-caret-square-o-right"></i> Email Management</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[56]->status == "on"){
                                                ?>
                                                        <a href="{{ url('comparison-tab1') }}"><i class="fa fa-caret-square-o-right"></i> Yearly Comparison</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    if($links[57]->status == "on"){
                                                ?>
                                                        <a href="{{ url('archives_tutorials') }}"><i class="fa fa-caret-square-o-right"></i> Tutorial</a>
                                                <?php
                                                    }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul> -->
                    </li>
                    </ul>
                    </nav>

                    @endif
                    <?php } ?>
            </div>
        </div>
        </header>
        <!-- /Top Nav -->
    </div>
    @if (Session::has('status'))
        <div class="message_aalert">
            <div class="alert alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                {{ Session::get('status') }}
            </div>
        </div>
    @endif
    @yield('content')
    <!-- FOOTER -->
    <footer id="footer">
        <div class="copyright">
            <div class="container">
                &copy; All Rights Reserved, MAFAMA.COM
            </div>
        </div>
    </footer>
    <!-- /FOOTER -->
    </div>
    <div id="no-registration-form" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Registration Closed</h4>
                </div>
                <div class="modal-body ">
                    <div class="row gy-4" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <p>We are not accepting affiliates at this time, please enter your email address, we
                                will notify you when we will accept new affiliates.</p>
                        </div>
                        <hr>
                        <form action="{{ url('add_enquiry_entry') }}" method="POST" id=""
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12" style="margin-top: 30px;">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        required="" autocomplete="off" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    <span style="color: red;" id="codeexitstance"></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"> Email</label>
                                    <input type="text" class="form-control" placeholder="Email"
                                        name="email_id" required="" autocomplete="off"
                                        value="{{ old('email_id') }}">
                                    @if ($errors->has('email_id'))
                                        <span class="text-danger">{{ $errors->first('email_id') }}</span>
                                    @endif
                                    <span style="color: red;" id="codeexitstance"></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"> Contact No.</label>
                                    <input type="number" class="form-control" placeholder="Contact No."
                                        name="contact_no" required="" autocomplete="off"
                                        value="{{ old('contact_no') }}">
                                    @if ($errors->has('contact_no'))
                                        <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                                    @endif
                                    <span style="color: red;" id="codeexitstance"></span>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top:10px; text-align:center;">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn  btn-primary" value="Submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div id="appointmentModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 style="margin-bottom: 0">Appointment Details</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="margin-top: -29px;"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    <div class="row">
                        <div id="appointmentpopup" style="padding: 10px 20px;"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /wrapper -->
    <!-- SCROLL TO TOP -->
    <a href="#" id="toTop"></a>
    <!-- PRELOADER -->

    {{-- <div id="preloader">
            <div class="inner">
                <span class="loader"></span>
            </div>
        </div> --}}

    <!-- /PRELOADER -->
    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">
        var plugin_path = "<?= url('/') ?>/assets/plugins/";
    </script>
    <script src="{{ asset('assets/plugins/jquery/jquery-2.1.4.min.js') }}"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <!-- <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- REVOLUTION SLIDER -->
    <script type="text/javascript"
        src="{{ asset('assets/plugins/slider.revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/view/demo.revolution_slider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables/js/dataTables.tableTools.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables/js/dataTables.colReorder.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables/js/dataTables.scroller.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('fullcalendar/fullcalendar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap-formhelpers.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}" defer></script>
    <script src="{{ asset('assets/toastr/toastr.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('includes/common.js') }}" defer></script>

    @if (Auth::check() && Auth::user()->role == 'affiliate')
        <!--  <script type="text/javascript" src="{{ asset('includes/eventHandling.js') }}"></script> -->
    @endif
    <!-- <script type="text/javascript" src="{{ asset('includes/eventHandling.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous"></script>
    <script>
        $(".li-submenu").click(function() {
            $(this).find(".submenu-ul").toggle();
            //var element = document.getElementById("myDIV");
            //element.classList.toggle("mystyle");
        });
        $(".color-td").click(function() {
            var color = $(this).css("background-color");
            //alert(color);
            $(".note-editable").css("background-color", color);
            //some code
        });
    </script>
    <script>
        if (jQuery().dataTable) {
            var table = jQuery("#datatable_sample");
            var oTable = table.dataTable({
                lengthMenu: [
                    [10, 15, 20, -1],
                    [10, 15, 20, "All"],
                ],
                pageLength: 5,
                pagingType: "bootstrap_full_number",
                language: {
                    lengthMenu: "  _MENU_ records",
                    paginate: {
                        previous: "Prev",
                        next: "Next",
                        last: "Last",
                        first: "First",
                    },
                },
                columnDefs: [{
                        orderable: false,
                        targets: [0],
                    },
                    {
                        searchable: false,
                        targets: [0],
                    },
                ],
                order: [],
            });
            var tableWrapper = jQuery("#datatable_sample_wrapper");
            // table.find(".group-checkable").change(function () {
            //     var set = jQuery(this).attr("data-set");
            //     var checked = jQuery(this).is(":checked");
            //     jQuery(set).each(function () {
            //         if (checked) {
            //             jQuery(this).attr("checked", true);
            //             jQuery(this).parents("tr").addClass("active");
            //         } else {
            //             jQuery(this).attr("checked", false);
            //             jQuery(this).parents("tr").removeClass("active");
            //         }
            //     });
            //     jQuery.uniform.update(set);
            // });
            table.on("change", "tbody tr .checkboxes", function() {
                jQuery(this).parents("tr").toggleClass("active");
            });
            tableWrapper.find(".dataTables_length select").addClass(
                "form-control input-xsmall input-inline"); // modify table per page dropdown
        }
    </script>
<script>
        if (jQuery().dataTable) {
            var table = jQuery("#datatable_sample5");
            var oTable = table.dataTable({


                language: {
                    lengthMenu: "  _MENU_ records",

                },
                columnDefs: [{
                        orderable: false,
                        targets: [0],
                    },
                    {
                        searchable: false,
                        targets: [0],
                    },
                ],
                order: [],
            });
            var tableWrapper = jQuery("#datatable_sample_wrapper");
            // table.find(".group-checkable").change(function () {
            //     var set = jQuery(this).attr("data-set");
            //     var checked = jQuery(this).is(":checked");
            //     jQuery(set).each(function () {
            //         if (checked) {
            //             jQuery(this).attr("checked", true);
            //             jQuery(this).parents("tr").addClass("active");
            //         } else {
            //             jQuery(this).attr("checked", false);
            //             jQuery(this).parents("tr").removeClass("active");
            //         }
            //     });
            //     jQuery.uniform.update(set);
            // });
            table.on("change", "tbody tr .checkboxes", function() {
                jQuery(this).parents("tr").toggleClass("active");
            });
            tableWrapper.find(".dataTables_length select").addClass(
                "form-control input-xsmall input-inline"); // modify table per page dropdown
        }
    </script>
    <script>
        if (jQuery().dataTable) {
            var table = jQuery("#datatable_sample1");
            var oTable = table.dataTable({
                lengthMenu: [
                    [10, 15, 20, -1],
                    [10, 15, 20, "All"],
                ],
                pageLength: 5,
                pagingType: "bootstrap_full_number",
                language: {
                    lengthMenu: "  _MENU_ records",
                    paginate: {
                        previous: "Prev",
                        next: "Next",
                        last: "Last",
                        first: "First",
                    },
                },
                columnDefs: [{
                        orderable: false,
                        targets: [0],
                    },
                    {
                        searchable: false,
                        targets: [0],
                    },
                ],
                order: [],
            });
            var tableWrapper = jQuery("#datatable_sample_wrapper");
            table.find(".group-checkable").change(function() {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function() {
                    if (checked) {
                        jQuery(this).attr("checked", true);
                        jQuery(this).parents("tr").addClass("active");
                    } else {
                        jQuery(this).attr("checked", false);
                        jQuery(this).parents("tr").removeClass("active");
                    }
                });
                jQuery.uniform.update(set);
            });
            table.on("change", "tbody tr .checkboxes", function() {
                jQuery(this).parents("tr").toggleClass("active");
            });
            tableWrapper.find(".dataTables_length select").addClass(
                "form-control input-xsmall input-inline"); // modify table per page dropdown
        }
    </script>
    <script type="text/javascript">
        $(".date-picker").datepicker({
            format: "yyyy-mm-dd",
            startDate: new Date()
        });
        // $(document).ready(function() {
        //     $('.datatable-init').DataTable( {
        //         aaSorting: [[1, 'desc']]
        //     });
        // } );
        // $(document).ajaxStart(function() {
        //   $("#loading").show();
        //   $("#wrapper").hide();
        // }).ajaxStop(function() {
        //   $("#loading").hide();
        //   $("#wrapper").show();
        // });
    </script>
    <script type="text/javascript">
        function initTable7() {
            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }
                oTable.fnDraw();
            }
            // function editRow(oTable, nRow) {
            //     var aData = oTable.fnGetData(nRow);
            //     var jqTds = $('>td', nRow);
            //     jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            //     jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            //     jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            //     jqTds[3].innerHTML = '<a class="edit btn btn-xs btn-info" href="">Save</a><a class="cancel btn btn-xs btn-info" href="">Cancel</a>';
            //     jqTds[4].innerHTML = '';
            // }
            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 3, false);
                oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 4, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 3, false);
                oTable.fnDraw();
            }
            var table = $('#sample_editable_1');
            var oTable = table.dataTable({
                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "language": {
                    "lengthMenu": " _MENU_ records"
                },
                "columnDefs": [{ // set default column settings
                    'orderable': false,
                    'targets': [0]
                }, {
                    "searchable": true,
                    "targets": [0]
                }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });
            var tableWrapper = $("#sample_editable_1_wrapper");
            tableWrapper.find(".dataTables_length select").select2({
                showSearchInput: false //hide search box with special css class
            }); // initialize select2 dropdown
            var nEditing = null;
            var nNew = false;
            $('#sample_editable_1_new').click(function(e) {
                e.preventDefault();
                if (nNew && nEditing) {
                    if (confirm("Previose row not saved. Do you want to save it ?")) {
                        saveRow(oTable, nEditing); // save
                        $(nEditing).find("td:first").html("Untitled");
                        nEditing = null;
                        nNew = false;
                    } else {
                        oTable.fnDeleteRow(nEditing); // cancel
                        nEditing = null;
                        nNew = false;
                        return;
                    }
                }
                var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
                nNew = true;
            });
        }
        // Table Init
        initTable7();
    </script>
    <?php if(Auth::id() != ""){ ?>
    <script type="text/javascript">
        $(document).ready(function() {
            setInterval("apppointmentnotification()", 60000);
            // setInterval("apppointmentnoti()", 3600000);
            $.ajax({
                url: "<?php echo url('/'); ?>/apppointmentnotificationtime",
                data: '_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    if (response == "hours") {
                        setInterval("apppointmentnoti()", 60000);
                    } else if (response == "days") {
                        var dayInMilliseconds = 1000 * 60 * 60 * 24;
                        setInterval("apppointmentnoti()", dayInMilliseconds);
                    } else {}
                }
            })
        });

        function apppointmentnotification() {
            $.ajax({
                url: "<?php echo url('/'); ?>/apppointmentnotificationpopup",
                data: '_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    if (response == "false") {
                        // alert(response);
                    } else {
                        $("#appointmentpopup").html(response);
                        $("#appointmentModal").modal('show');
                    }
                    // alert("hi");
                }
            })
        }

        function apppointmentnoti() {
            $.ajax({
                url: "<?php echo url('/'); ?>/apppointmentnotification",
                data: '_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    if (response != "false") {
                        // alert(response);
                        $("#appointmentpopup").html(response);
                        $("#appointmentModal").modal('show');
                    }
                    // alert("hi");
                }
            })
        }
    </script>
    <?php } ?>
    <script type="text/javascript">
        // $(document).on('click','.user-log-button',function(e){
        //     $(".userdrop").addClass('open');
        //     $(".user-log-button").attr("aria-expanded","true");
        // });
        // Tooltip
        // $('.clipboard').tooltip({
        //   trigger: 'click',
        //   placement: 'bottom'
        // });
        function setTooltip(btn, message) {
            alert(message);
            // $(btn).tooltip('hide')
            //   .attr('data-original-title', message)
            //   .tooltip('show');
        }

        function hideTooltip(btn) {
            // setTimeout(function() {
            //   $(btn).tooltip('hide');
            // }, 1000);
        }
        // Clipboard
        var clipboard = new Clipboard('.clipboard');
        clipboard.on('success', function(e) {
            $('#copied-success').fadeIn(800);
            $('#copied-success').fadeOut(800);
        });
        clipboard.on('success', function(e) {
            //  alert('Copied!');
            setTooltip(e.trigger, 'Copied!');
            // hideTooltip(e.trigger);
        });
        clipboard.on('error', function(e) {
            setTooltip(e.trigger, 'Failed!');
            // hideTooltip(e.trigger);
        });
    </script>
    <script type="text/javascript">
        getLocation();

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                var innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            $.ajax({
                url: "<?php echo url('/'); ?>/setGeoLocation",
                data: '_token={{ csrf_token() }}' + '&latitude=' + latitude + '&longitude=' + longitude,
                type: "POST",
                success: function(response) {
                    console.log(response);
                }
            })


        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateInit">
    </script>

    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'fr',
                includedLanguages: 'en,es,fr,ar,cre,ja,ko,de,pt',
                autoDisplay: false
            }, 'google_translate_element');
            var a = document.querySelector("#google_translate_element select");
            a.selectedIndex = 1;
            a.dispatchEvent(new Event('change'));
        }
    </script>
    <!--<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->
    <script type="text/javascript">
        function googleTranslateInit() {
            var data = new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'en,es,fr,ar,cr,ht,hat,sw,ko,de,pt',
                },
                'google_translate_button'
            );
        }
        window.setInterval(function() {
            $('.goog-te-combo').on('change', function() {
                language = $("select.goog-te-combo option:selected").text();
                console.log(language)
            });
        }, 5000);



        $(".language_check").change(function() {
            if (this.checked) {
                $('.language_check').not(this).prop('checked', false);
                var language = this.value;
                sessionStorage.setItem("language_code", language);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/update_language',
                    data: {
                        language: language
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {
                        location.reload();
                    }
                });
            }
        });
    </script>

    <script type="text/javascript">
        // if ($(location).attr('hash') == "") {
        //     // if("{{ $lang_code }}" !='en'){
        //     var language_code = "{{ $lang_code }}"
        //     sessionStorage.setItem("language_code", language_code);
        //     var url = $(location).attr('pathname') + "#googtrans(en|" + language_code + ")";
        //     window.location.replace(url);
        //     // }
        //     // else if(sessionStorage.getItem("language_code") !=""){
        //     //     var language_code = sessionStorage.getItem("language_code");
        //     //     var url = $(location).attr('pathname') + "#googtrans(en|" + language_code + ")";
        //     //     window.location.replace(url);
        //     // }
        // } else {
        //     if ("{{ $lang_code }}" != 'en') {
        //         var language_code = "{{ $lang_code }}"
        //     } else if (sessionStorage.getItem("language_code") != "") {
        //         var language_code = sessionStorage.getItem("language_code");
        //     }
        //     var url = $(location).attr('pathname') + "#googtrans(en|" + language_code + ")";
        //     window.location.replace(url);
        // }
    </script>

    @yield('script')
</body>

</html>
