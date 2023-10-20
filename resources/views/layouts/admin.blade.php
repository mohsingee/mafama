@php
    $lead_menu = \App\Setting::lead_categories_menu_list();
@endphp
<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="@@page-discription" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!--phone inp api start-->
        <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <!--phone api end-->
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon2.ico') }}?v=2" />
    <!-- Page Title  -->
    <title>MAFAMA.COM</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/dashlite.css') }}?ver=1.6.0" />
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin_assets/css/theme.css') }}?ver=1.6.0" />
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin_assets/css/colorpicker.css') }}" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Merriweather" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap-formhelpers.min.css') }}">
    {{-- <script  src="{{ asset('assets/plugins/jquery/jquery-2.1.4.min.js') }}"></script> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js" defer></script>



</head>
<style>
    body {
        font-family: Merriweather !important;
    }

    .nk-menu-link {
        font-family: Merriweather !important;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    a,
    label,
    span {
        font-family: Merriweather !important;
    }

    .logo-img {
        max-height: 75px;
        width: 100%;
    }

    .nk-content {
        margin-top: 50px;
    }

    .nk-menu-link:hover,
    .active>.nk-menu-link {
        color: #c0c1c5fa;
    }

    .nk-menu-link {
        color: #fff;
        font-size: 18px;
    }

    .nk-menu-link:hover .nk-menu-icon,
    .nk-menu-item.active>.nk-menu-link .nk-menu-icon,
    .nk-menu-item.current-menu>.nk-menu-link .nk-menu-icon {
        color: #c0c1c5fa;
    }

    .nk-menu-icon {
        color: #fff;
    }

    .nk-menu-sub .nk-menu-link {
        padding: 0.375rem 40px 0.375rem 36px;
        font-family: Roboto;
        font-weight: 400;
        font-size: 14px;
        letter-spacing: normal;
        text-transform: none;
        line-height: 1.25rem;
        color: #fff;
    }

    .nk-menu-sub .nk-menu-link:hover,
    .nk-menu-item.active,
    .nk-menu-item.current-menu {
        color: #c0c1c5fa;
    }

    .nk-menu-sub .active>.nk-menu-link {
        color: #c0c1c5fa;
    }

    .dashboard-block .card-bordered {
        border: 1px solid #dbdfea;
    }

    .dashboard-block .card-title .subtitle {
        color: #fff;
    }

    .dashboard-block .card-amount .amount {
        color: #fff;
    }

    .invest-data-history .amount {
        color: #fff;
    }

    .invest-data-history .amount span {
        color: #fff;
    }

    .invest-data-history .title {
        color: #fff;
    }

    .mybtn {
        margin-right: 10px !important;
    }

    .dashboard-block .card {
        height: 140px;
    }

    .nk-tb-actions {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        position: relative;
    }

    .dataTable td {
        white-space: initial;
    }

    .is-dark .nk-menu-toggle:after,
    .is-theme .nk-menu-toggle:after {
        color: rgb(255, 255, 255);
    }

    @media (min-width: 992px) {

        .modal-lg,
        .modal-xl {
            max-width: 800px;
        }
    }

    /****************new css**************/
    .nk-sidebar.is-dark {
        background: #8a26e9;
        border-right-color: #8a26e9;
    }

    .is-dark .nk-sidebar-head {
        border-color: #7e12e4;
    }

    .nk-menu-link:hover,
    .active>.nk-menu-link {
        color: #fff;
        background-color: #8500ec;
    }

    .nk-menu-link:hover .nk-menu-icon,
    .nk-menu-item.active>.nk-menu-link .nk-menu-icon,
    .nk-menu-item.current-menu>.nk-menu-link .nk-menu-icon {
        color: #fff;
    }

    .nk-menu-sub .active>.nk-menu-link {
        color: #fff;
    }

    .nk-menu-link {
        color: #fff;
        font-size: 16px;
    }

    li.nk-menu-item {
        padding-left: 15px;
        padding-right: 15px;
        border-radius: 10px;
    }

    .nk-menu-link:hover,
    .active>.nk-menu-link {
        color: #fff;
        background-color: #6705b3;
        border-radius: 10px;
    }

    .nk-sidebar .nk-menu>li .nk-menu-sub .nk-menu-link {
        padding-left: 25px;
    }

    .user-avatar,
    [class^="user-avatar"]:not([class*="-group"]) {
        color: #fff;
        background: #8a26e9;
    }

    a {
        color: #6705b3;
    }

    .page-title {
        color: #6705b3;
    }

    .btn-primary {
        color: #fff;
        /*background-color: #8a26e9;
            border-color: #8a26e9;*/
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #6705b3;
        border-color: #6705b3;
    }

    .dropdown-menu-s1 {
        border-top: 3px solid #6705b3;
    }

    .link-list a:hover {
        color: #8a26e9;
    }

    .custom-control-input:checked~.custom-control-label::before {
        color: #fff;
        background-color: #8a26e9 !important;
        border-color: #8a26e9 !important;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #8a26e9;
        border-color: #8a26e9;
    }

    .form-control:focus {
        color: #3c4d62;
        background-color: #fff;
        border-color: #8a26e9;
        outline: 0;
        box-shadow: 0 0 0 3px rgba(138, 38, 233, 0.09);
    }

    /* .nk-sidebar-element .nk-sidebar-content {
            overflow: hidden;
            width: 100%;
            max-height: 500px;
            height:500px;
            overflow-y: scroll;
        } */
    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #b71a0f;
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #b71a0f;
    }

    .nk-sidebar-content .nk-sidebar-menu[data-simplebar] {
        height: auto;
    }

    .price-plan-media .icon {
        font-size: 100px;
        color: #6705b3;
    }

    li.nav-item {
        background-color: #8a26e9;
        margin-right: 5px;
        border-radius: 5px;
        text-align: center;
    }

    .nav-tabs .nav-link {
        text-align: center;
        padding: 0.5rem 1rem;
        color: #fff;
    }

    .nav-tabs .nav-item {
        padding-right: 0px;
    }

    .nav-tabs .nav-link:after {
        background: #6705b3;
        opacity: 0;
    }

    .nav-tabs .nav-link.active {
        color: #fff;
        border: none;
        background-color: #6705b3;
    }

    .nav-tabs .nav-link:hover {
        color: #fff;
        background-color: #6705b3;
    }

    .btn-primary:not(:disabled):not(.disabled):active,
    .btn-primary:not(:disabled):not(.disabled).active,
    .show>.btn-primary.dropdown-toggle {
        color: #fff;
        background-color: #6705b3;
        border-color: #6705b3;
    }

    /*** colorpicker css ***/
    .relative {
        position: relative;
    }

    input.colorpicker {
        padding-right: 65px;
    }

    input.colorpicker {
        display: inline-block !important;
    }

    input.colorpicker+.sp-replacer {
        right: 0;
        width: 55px;
        position: absolute;
        margin-left: -55px;
        z-index: 10;
    }

    .sp-replacer {
        margin: 0;
        overflow: hidden;
        cursor: pointer;
        padding: 4px;
        display: inline-block;
        *zoom: 1;
        *display: inline;
        border: solid 2px #ddd;
        background: #eee;
        color: #333;
        vertical-align: middle;
        height: 40px;
    }

    .sp-container,
    .sp-replacer,
    .sp-preview,
    .sp-dragger,
    .sp-slider,
    .sp-alpha,
    .sp-clear,
    .sp-alpha-handle,
    .sp-container.sp-dragging .sp-input,
    .sp-container button {
        -webkit-user-select: none;
        -moz-user-select: -moz-none;
        -o-user-select: none;
        user-select: none;
    }

    .sp-preview,
    .sp-alpha,
    .sp-thumb-el {
        position: relative;
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAMCAIAAADZF8uwAAAAGUlEQVQYV2M4gwH+YwCGIasIUwhT25BVBADtzYNYrHvv4gAAAABJRU5ErkJggg==);
    }

    .sp-preview {
        position: relative;
        width: 28px;
        height: 28px;
        border: solid 1px #222;
        margin-right: 5px;
        float: left;
        z-index: 0;
    }

    .sp-preview-inner,
    .sp-alpha-inner,
    .sp-thumb-inner {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }

    .sp-dd {
        padding: 2px 0;
        height: 16px;
        line-height: 25px;
        float: left;
        font-size: 10px;
    }

    #colorSelector {
        position: relative;
        width: 36px;
        height: 36px;
        background: url(images/select.png);
    }

    #colorSelector div {
        position: absolute;
        top: 3px;
        left: 3px;
        width: 30px;
        height: 30px;
        background: url(images/select.png) center;
    }

    /* .card-bordered {
            border: 1px solid #dbdfea;
            background-color: #26e92c36;
        }
        .datatable-wrap {
            border: 1px solid #b7c6e8;
            border-radius: 4px;
        }
        table.dataTable {
            background-color: #fff;
        }
        thead
        {
            background-color: #d8ded9;
        }
        .nav-tabs .nav-link {
            text-align: center;
            padding: 0.5rem 1.65rem;
            color: #fff;
        }
        .nav-tabs {
            font-family: Nunito;
            margin: 0;
            font-size: 0.8125rem;
            border-bottom: 1px solid #6705b3;
        }
        .dataTable tr {
            white-space: pre-wrap;
        }
        .dataTable td {
            white-space: initial;
            text-align: center;
        }
        .custom-control-sm
        {
            float:right;
        }*/
    /******* colorboxx css ************/
    .color-td {
        height: 20px !important;
        width: 20px !important;
    }

    .color1 {
        background-color: #F0F8FF !important;
    }

    .color2 {
        background-color: #FAEBD7 !important;
    }

    .color3 {
        background-color: #00FFFF !important;
    }

    .color4 {
        background-color: #7FFFD4 !important;
    }

    .color5 {
        background-color: #F0FFFF !important;
    }

    .color6 {
        background-color: #F5F5DC !important;
    }

    .color7 {
        background-color: #FFE4C4 !important;
    }

    .color8 {
        background-color: #000000 !important;
    }

    .color9 {
        background-color: #FFEBCD !important;
    }

    .color10 {
        background-color: #0000FF !important;
    }

    .color11 {
        background-color: #8A2BE2 !important;
    }

    .color12 {
        background-color: #A52A2A !important;
    }

    .color13 {
        background-color: #DEB887 !important;
    }

    .color14 {
        background-color: #5F9EA0 !important;
    }

    .color15 {
        background-color: #7FFF00 !important;
    }

    .color16 {
        background-color: #D2691E !important;
    }

    .color17 {
        background-color: #FF7F50 !important;
    }

    .color18 {
        background-color: #6495ED !important;
    }

    .color19 {
        background-color: #FFF8DC !important;
    }

    .color20 {
        background-color: #BDB76B !important;
    }

    .color21 {
        background-color: #8FBC8F !important;
    }

    .color22 {
        background-color: #E6E6FA !important;
    }

    .btn-xs {
        padding: 1px 5px;
        font-size: 12px;
        line-height: 1.25rem;
        border-radius: 3px;
    }

    .nav-tabs .nav-link {
        text-align: center;
        padding: 3px 5px;
        font-size: 12px;
        line-height: 1.25rem;
        border-radius: 3px;
        color: #fff;
    }

    .nk-menu-link:hover,
    .active>.nk-menu-link {
        color: #fff;
        background-color: #b71a0f;
        border-radius: 10px;
    }

    .nav-tabs .nav-item {
        padding-right: 0px;
        width: 100%;
    }

    .nav-tabs .active {
        color: #fff;
        border: none;
        background-color: #b71a0f !important;
    }

    /* .nav-tabs:hover  {
            color: #fff;
            border: none;
            background-color: #6705b3 !important;
        } */
    .nav {
        display: flex;
        flex-wrap: inherit;
    }

    .nk-menu-link {
        color: #fff;
        background-color: #b71a0f;
        border-radius: 10px;
    }

    .nk-menu-sub .nk-menu-link {
        color: #fff;
        background-color: #b71a0f;
        border-radius: 6px;
    }

    .nk-menu-sub .active .nk-menu-link {
        color: #6b0101 !important;
    }

    .email-btn .btn {
        display: inherit !important;
    }

    /***** new color theme css ****/
    .nk-sidebar.is-dark {
        background: #da291c;
        border-right-color: #da291c;
    }

    .is-dark .nk-sidebar-head {
        border-color: #b7190d;
    }

    .nk-header.is-light:not([class*=bg-]) {
        background: #4285f4;
    }

    .user-avatar,
    [class^="user-avatar"]:not([class*="-group"]) {
        color: #4285f4;
        background: #ffffff;
    }

    .user-avatar,
    [class^="user-avatar"]:not([class*="-group"]) {
        color: #4285f4;
        background: #ffffff;
    }

    .user-avatar+.user-info,
    [class^="user-avatar"]:not([class*="-group"])+.user-info {
        margin-left: 1rem;
        color: #fff;
    }

    .user-name {
        color: #b71a0f;
    }

    .bg-lighter {
        background-color: #fae3e2 !important;
    }

    .card-bordered {
        border: 1px solid #da291c99;
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fae3e2;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: #da291c;
    }

    .page-title {
        color: #da291c;
    }

    .btn-primary {
        color: #fff;
        /*background-color: #da291c;
            border-color: #da291c;*/
    }

    .form-control {
        border: 1px solid #da291c73;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #da291c73;
    }

    .form-control:focus {
        color: #3c4d62;
        background-color: #fff;
        border-color: #da291c;
        outline: 0;
        box-shadow: 0 0 0 3px rgba(218, 41, 28, 0.11);
    }

    .custom-control-input:not(:disabled):active~.custom-control-label::before {
        color: #fff;
        background-color: #ffffff;
        border-color: #da291c;
    }

    .custom-control-label::before {
        position: absolute;
        top: -0.02813rem;
        left: -2.25rem;
        display: block;
        width: 1.5rem;
        height: 1.5rem;
        pointer-events: none;
        content: "";
        background-color: #fff;
        border: #da291c9c solid 2px;
    }

    .custom-control-label:after {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-image: none !important;
        font-family: "Nioicon";
        color: #da291c;
        opacity: 0;
    }

    .custom-control-input:checked~.custom-control-label::before {
        color: #fff;
        background-color: #ffffff !important;
        border-color: #da291c !important;
    }

    .nk-tb-head .nk-tb-col {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        color: #ffffff;
        font-size: .9em;
        border-bottom: 1px solid #da291c;
        background-color: #da291c;
    }

    .sub-text {
        display: block;
        font-size: 13px;
        color: #ffffff;
        font-weight: 400;
    }

    .dataTable tr {
        white-space: nowrap;
        background-color: #fff;
    }

    .nk-tb-item:not(.nk-tb-head):hover,
    .nk-tb-item:not(.nk-tb-head).seleted {
        background: #f5f0f0;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #da291c;
        border-color: #da291c;
    }

    .page-item.disabled .page-link {
        color: #da291c;
        pointer-events: none;
        cursor: auto;
        background-color: #fff;
        border-color: #da291c59;
    }

    body {
        color: #333;
    }

    .nk-tb-list {
        display: table;
        width: 100%;
        font-size: 13px;
        color: #333;
    }

    .form-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #333;
        margin-bottom: .5rem;
    }

    .nk-footer-copyright {
        color: #fff;
    }

    .nk-footer-copyright a {
        color: #fff;
    }

    .btn-primary:not(:disabled):not(.disabled):active,
    .btn-primary:not(:disabled):not(.disabled).active,
    .show>.btn-primary.dropdown-toggle {
        color: #fff;
        background-color: #b71a0f;
        border-color: #b71a0f;
    }

    .btn-primary:not(:disabled):not(.disabled):active:focus,
    .btn-primary:not(:disabled):not(.disabled).active:focus,
    .show>.btn-primary.dropdown-toggle:focus {
        box-shadow: 0 0 0 0.2rem rgba(218, 41, 28, 0.14);
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #b71a0f;
        border-color: #b71a0f;
    }

    li.nav-item {
        background-color: #da291c;
    }

    .nav-tabs .active {
        color: #fff;
        border: none;
        background-color: #da291c !important;
    }

    .nav-tabs .nav-link:after {
        background: #b71a0f;
        opacity: 0;
    }

    .btn {
        font-weight: 400;
    }

    .nav-tabs .nav-link {
        font-weight: 400;
    }

    .nav-tabs .nav-link:hover {
        color: #fff;
        background-color: #da291c;
    }

    div.divider.divider-center {
        text-align: center;
    }

    div.divider {
        margin: 40px 0;
        position: relative;
        display: block;
        min-height: 20px;
    }

    div.divider.divider-center.divider-short:before {
        left: auto !important;
        right: 50%;
        margin-right: 20px;
        width: 15%;
    }

    div.divider.divider-center:before {
        left: 0 !important;
        right: 50%;
        margin-right: 20px;
        content: '';
        position: absolute;
        top: 8px;
        height: 0;
        border-top: 1px solid #c97e7e;
    }

    div.divider i {
        line-height: 1;
        font-size: 18px;
        color: #c97e7e;
    }

    div.divider.divider-center.divider-short:after {
        left: 50% !important;
        right: auto !important;
        margin-left: 20px;
        width: 15%;
    }

    /* div.divider:after {
            content: '';
            position: absolute;
            top: 8px;
            left: 0;
            right: 0;
            height: 0;
           border-top: 1px solid #c97e7e61;
        } */
    .divider {
        border-top: 1px solid #c97e7e61 !important;
    }

    .nk-menu-text {
        font-weight: 400;
    }

    .table thead tr:last-child th {
        font-weight: 400;
        border-bottom: 1px solid #da291c;
    }

    .table {
        color: #333;
    }

    .custom-control .custom-control-input[disabled]~.custom-control-label,
    .custom-control .custom-control-input:disabled~.custom-control-label {
        opacity: 1;
        color: #333;
    }

    .table th,
    .table td {
        padding: 0.5rem;
        vertical-align: top;
        border-top: 1px solid #da291c38;
    }

    .table .thead-light th {
        color: #ffffff;
        background-color: #da291c;
        border-color: #dbdfea;
    }

    .custom-file-label {
        border: 1px solid #eb8f89;
        border-radius: 4px;
    }

    .custom-file-label::after {
        color: #ffffff;
        content: "Browse";
        background-color: #da291c;
    }

    .custom-switch .custom-control-input:checked~.custom-control-label::before {
        color: #fff;
        background-color: #da291c !important;
        border-color: #da291c !important;
    }

    .btn-danger {
        color: #fff;
        background-color: #da291c;
        border-color: #da291c;
    }

    .nk-footer {
        margin-top: auto;
        background: #1b5cc7;
    }

    .dataTable thead tr {
        white-space: normal;
        background-color: #da291c;
        color: #fff;
    }

    .btn-success {
        color: #fff;
        background-color: #da291c;
        border-color: #da291c;
    }

    .btn-success:hover {
        color: #fff;
        background-color: #da291c;
        border-color: #da291c;
    }

    .nk-header.is-light:not([class*=bg-]) {
        background: #1b5cc7;
    }

    .is-dark .nk-sidebar-head {
        border-color: #0d1ab7;
    }

    .nk-sidebar.is-dark {
        background: #1b5cc7;
        border-right-color: #4285f4;
    }

    .nk-menu-link {
        color: #fff;
        background-color: #3d76d5;
        border-radius: 10px;
    }

    .nk-menu-sub .nk-menu-link {
        color: #fff;
        background-color: #b71a0f;
        border-radius: 6px;
    }
    .bg_green {
        background-color: #1dbf73;
    }
    .bg_blue {
        background-color: #002d72;
    }

    .nk-menu-sub .active>.nk-menu-link {
        color: black !important;
        background: #ea2d1f !important;
        font-weight: bold !important;
    }

    .nk-menu-link:hover,
    .active>.nk-menu-link {
        color: #fff;
        background-color: #3d76d5;
        border-radius: 10px;
    }

    .btn-black {
        background-color: #000;
        color: #fff;
    }

    .col-md-5th {
        width: 20%;
        float: left;
    }

    .col-xs-5th,
    .col-sm-5th,
    .col-md-5th,
    .col-lg-5th {
        position: relative;
        min-height: 1px;
        padding-right: 10px;
        padding-left: 10px;
        width: 20%;
        float: left;
    }

    /* th, td {
            text-align: center;
        } */
    .red {
        color: red;
    }

    .green {
        color: green;
    }

    .fsize-20 {
        font-size: 20px !important;
    }

    .nk-chat-body.profile-shown {
        padding-right: 240px;
    }

    .nk-chat-profile {
        position: absolute;
        top: 0;
        right: 0;
        width: 240px;
    }

    .nk-chat-profile {
        border-left: 1px solid #da291c33;
        background-color: #fae3e2;
    }

    .nk-chat-aside {
        background: #fae3e2;
        border-right: 1px solid #da291c33;
    }

    .nk-chat-aside {
        background: #fae3e2;
    }

    .nk-chat-body {
        background: #fae3e2;
    }

    .nk-chat-editor {
        background-color: #fae3e2;
    }

    .nk-chat-aside-user .title {
        font-size: 1.875rem;
        color: #da291c;
    }

    .nk-chat-head {
        background-color: #da291c;
    }

    .bg-purple {
        background-color: #1b5cc7 !important;
    }

    .bg-purple span {
        color: #fff;
         !important;
    }

    .nk-chat-aside-head {
        background-color: #da291c;
        padding: 1.125rem 1.25rem 0.420rem;
        margin-bottom: 10px;
    }

    .nk-chat-aside-head .title {
        color: #fff;
    }

    .pricing-table .nk-tb-col {
        position: relative;
        display: table-cell;
        vertical-align: middle;
        padding: .5rem .5rem;
    }

    .dataTable tr {
        white-space: inherit;
    }

    .chat-media {
        height: 70px;
        width: 80px;
        border-radius: 0%;
    }

    .user-avatar img,
    [class^="user-avatar"]:not([class*="-group"]) img {
        border-radius: 0% !important;
    }

    .img-tr th {
        vertical-align: middle;
        padding-top: 80px !important;
        padding-bottom: 80px !important;
        border: 1px solid #da291c85;
        text-align: center;
    }

    .img-tr span {
        font-size: 16px;
    }

    tr,
    td {
        text-align: center;
    }

    .nk-chat-profile {
        border-left: 1px solid #da291c33;
        background-color: #E1F5FE !important;
    }

    .nk-chat-body {
        background: #E1F5FE !important;
    }

    .nk-chat-aside {
        background: #E1F5FE !important;
    }

    .nk-chat-editor {
        background-color: #E1F5FE !important;
    }

    .nk-chat-body {
        background: #E1F5FE !important;
    }

    .nk-chat-panel {
        background-color: #E1F5FE !important;
    }

    .chat-from .name {
        font-size: 0.9375rem;
        margin-bottom: 0;
        font-weight: 500;
        color: #0c62fb;
    }

    .chat-context .text {
        width: calc(100% - 2.5rem);
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        font-size: 13px;
        color: #010d1d;
    }

    .overline-title-alt {
        font-family: Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: 0.15em;
        font-size: 11px;
        color: #086bf3;
        text-transform: uppercase;
    }

    .btn-info:hover {
        color: #fff;
        background-color: #0c6ff7;
        border-color: #0c6ff7;
    }

    .btn-info {
        color: #fff;
        background-color: #0c6ff7;
        border-color: #0c6ff7;
    }

    btn-warning:not(:disabled):not(.disabled):active,
    .btn-warning:not(:disabled):not(.disabled).active,
    .show>.btn-warning.dropdown-toggle {
        color: #fff;
        background-color: #6309c6;
        border-color: #6309c6;
    }

    .btn-warning {
        color: #fff;
        /*background-color: #6309c6;
            border-color: #6309c6;*/
    }

    .nk-tb-item .nk-tb-col:first-child {
        text-align: left !important;
        padding-left: 1.5rem;
    }

    .no-js #loader {
        display: none;
    }

    .js #loader {
        display: block;
        position: absolute;
        left: 100px;
        top: 0;
    }

    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url(images/loader-64x/Preloader_2.gif) center no-repeat #fff;
    }

    #preloader {
        position: fixed;
        z-index: 9999999;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;

        background: #fff;
    }

    .inner {
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;

        width: 54px;
        height: 54px;
        margin: auto;
    }

    .page-loader {
        display: block;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        background: #fefefe;
        z-index: 100000;
    }

    #preloader span.loader {
        width: 50px;
        height: 50px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -25px 0 0 -25px;
        font-size: 10px;
        text-indent: -12345px;
        border-top: 1px solid rgba(0, 0, 0, 0.08);
        border-right: 1px solid rgba(0, 0, 0, 0.08);
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        border-left: 1px solid rgba(0, 0, 0, 0.5);

        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;

        -webkit-animation: spinner 700ms infinite linear;
        -moz-animation: spinner 700ms infinite linear;
        -ms-animation: spinner 700ms infinite linear;
        -o-animation: spinner 700ms infinite linear;
        animation: spinner 700ms infinite linear;

        z-index: 100001;
    }

    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-o-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    #loader {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.75) url(images/loader-64x/Preloader_2.gif) no-repeat center center;
        z-index: 10000;
    }

    .nk-menu-text {
        color: #fff;
    }
</style>

<body class="nk-body bg-lighter npc-general has-sidebar smoothscroll enable-animation boxed">
    <div id="loading"
        style="width: 50px; display: none;
  height: 50px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -25px 0 0 -25px;">
        <img src="{{ asset('images/loader.gif') }}">
    </div>
    <!--<script type="text/javascript">
        -- >
        <
        !--jQuery("body").prepend('<div id="preloader">Loading...</div>');
        -- >
        <
        !--jQuery(document).ready(function() {
            -- >
            <
            !--jQuery("#preloader").remove();
            -- >
            <
            !--
        });
        -- >
        <
        !--
    </script>-->
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main" id="wrapper">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark" data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="{{ url('admin') }}" class="logo-link nk-sidebar-logo">
                            <!--<img class="logo-light logo-img" src="{{ asset('admin_assets/images/logo_light.png') }}" alt="logo">
                            <img class="logo-dark logo-img" src="{{ asset('admin_assets/images/logo_light.png') }}" alt="logo-dark">-->
                            <h3 style="color: #fff;">Admin</h3>
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none"
                            data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
                <!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element" style="height: 560px; overflow-y: scroll;">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                @if (permission_access1('dashboard_view') == 1)
                                    <li class="nk-menu-item">
                                        <a href="{{ url('admin') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                                            <span class="nk-menu-text">Dashboard </span>
                                        </a>
                                    </li>
                                @endif
                                <!-- .nk-menu-item -->
                                @if (permission_access1('admininstrator_view') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-puzzle-fill"></em></span>
                                            <span class="nk-menu-text">Administrators</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('access_role') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/admin-list') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Access/Roles </span>
                                                    </a>
                                                </li>
                                            @endif


                                            @if (permission_access1('table_of_level') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('level_table') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Table of Level </span>
                                                    </a>
                                                </li>
                                            @endif

                                            @if (permission_access1('registered_affiliates') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/affilates_registration') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Registered Affiliates</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('registered_buissness') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/registered_business') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Registered Business</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('registration_requests') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/affilates_registration_enquiry') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Registration Requests</span>
                                                    </a>
                                                </li>
                                            @endif

                                            @if (permission_access1('religion') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_religion') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Religion</span>
                                                    </a>
                                                </li>
                                            @endif

                                            @if (permission_access1('access_monitoring') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('access_monitoring') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Access Monitoring</span>
                                                    </a>
                                                </li>
                                            @endif
                                            <!--   <li class="nk-menu-item">
                                                <a href="{{ url('logActivity') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span><span class="nk-menu-text">User Log Activities</span>
                                                </a>
                                            </li>-->

                                            @if (permission_access1('general_settings') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('general-setting') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">General Setting</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('earning_points') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('earning-point-setting') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Earning Points</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('lead_qualifier_setting') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('lead-qualifier-setting') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Lead Qualifier Setting</span>
                                                    </a>
                                                </li>
                                            @endif

                                            @if (permission_access1('terms_and_condition') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('terms-conditions') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Terms and Conditions</span>
                                                    </a>
                                                </li>
                                            @endif

                                            @if (permission_access1('administrator_hide_unhide_links') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('show_hide_links') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Hide/Unhide Links</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('restrict_of_signups') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('restrict_signup') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Restrict # of Sign-ups</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('assign_of_users') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('assign_users') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Assign # of Users</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('search_and_send_sms') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('search_send_sms') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Search & Send SMS</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('search_and_send_email') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('search_send_emails') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Search & Send Emails</span>
                                                    </a>
                                                </li>
                                            @endif

                                            @if (permission_access1('search_and_send_email') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('fix-commission-setting') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Fix commission setting</span>
                                                    </a>
                                                </li>
                                            @endif
                                            <!--// software developer Ravi coding start 9660813935-->
                                            {{-- @if (permission_access1('country_status_setting') == 1) --}}
                                            <li class="nk-menu-item">
                                                <a href="{{ url('country-status-setting') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-forward-arrow-fill"></em></span><span
                                                        class="nk-menu-text">Country Status Setting</span>
                                                </a>
                                            </li>
                                            {{-- @endif --}}
                                            <!--// software developer Ravi coding end  9660813935-->

                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                @endif
                                <!-- @if (permission_access1('adminrole_view') == 1 ||
                                        permission_access1('roles_view') == 1 ||
                                        permission_access1('admin_list_view') == 1)
<li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title="" title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-puzzle-fill"></em></span>
                                            <span class="nk-menu-text">Admin Roles</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('roles_view') == 1)
<li class="nk-menu-item">
                                             <a href="{{ url('admin/admin-roles') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span><span class="nk-menu-text">Roles </span>
                                                </a>
                                            </li>
@endif
                                            @if (permission_access1('admin_list_view') == 1)
<li class="nk-menu-item">
                                             <a href="{{ url('admin/admin-list') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span><span class="nk-menu-text">Admin List </span>
                                                </a>
                                            </li>
@endif


                                        </ul>
                                    </li>
@endif -->
                                @if (permission_access1('email_templates_view') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em
                                                    class="icon ni ni-property-alt"></em></span>
                                            <span class="nk-menu-text">Email Templates</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('affiliate_email_template') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('affiliate-email-template') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Affiliate Email Template</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('client_registration_email_template') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('client-registration-email-template') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Client Registration Email
                                                            Template</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('business_registration_email_template') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('business-registration-email-template') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Business Registration Email
                                                            Template</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('record_transaction_email_template') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('record-transactions-email-template') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Record Transactions Email
                                                            Template</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('minus_balance_email_template') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('minus-balance-email-template') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text"> Minus Balance Email Template</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('member_management_view') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-setting-alt"></em></span>
                                            <span class="nk-menu-text">Member Management</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <!--  <li class="nk-menu-item">
                                                <a href="#" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Assign Status A/I </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('move_baskets') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Move Leads to Baskets X </span>
                                                </a>
                                            </li>-->
                                            @if (permission_access1('affiliate_management') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/affilates_registration') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Affiliate Management</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('enterprise_management') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/nonaffiliates_registration') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Enterprise Management </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('home_page_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-home-fill"></em></span>
                                            <span class="nk-menu-text">Home Page</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <!-- <li class="nk-menu-item">
                                                <a href="{{ url('admin/rating') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Ratings ***** (4-5) </span>
                                                </a>
                                            </li> -->
                                            @if (permission_access1('hide_unhide_links') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/hide_unhide') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Hide/Unhide Links </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('affiliates_feedback') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/photo_slides') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Affiliates Feedback </span>
                                                    </a>
                                                </li>
                                            @endif
                                            <!--   <li class="nk-menu-item">
                                                <a href="#" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Set-up Polls/Contests </span>
                                                </a>
                                            </li>-->
                                            @if (permission_access1('home_page_top_banner') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/top_banner') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Home Page Top Banner
                                                            (<?= Session::get('topbannercount') ?>) </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('home_page_banner_for_text') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/text_banner') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Home Page Banner for Text
                                                            (<?= Session::get('textbannercount') ?>)</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('home_page_videos') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/home_videos') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Home Page Videos
                                                            (<?= Session::get('homevideocount') ?>) </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('home_page_videos') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/home_top_videos') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Home Page top Videos
                                                            (<?= Session::get('hometopvideocount') ?>) </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('home_page_video_main') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/home_main_videos') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Home Page Video-Main
                                                            (<?= Session::get('homemainvideocount') ?>) </span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="nk-menu-item">
                                                <a href="{{ url('admin/setting/transaction') }}"
                                                    class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Transaction Settings </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('site_banners_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-layers-fill"></em></span>
                                            <span class="nk-menu-text">Site Banners</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('settings') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/setting_banner') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Settings
                                                            (<?= Session::get('settingbannercount') ?>) </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('appoitment') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/appointment_banner') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Appointment
                                                            (<?= Session::get('appointmentbannercount') ?>) </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('clients_management') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/client_management_banner') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Clients Management
                                                            (<?= Session::get('clientmanagementbannercount') ?>) </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('emails_management') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/email_management_banner') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Emails Management
                                                            (<?= Session::get('emailmanagementbannercount') ?>) </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('financial_management') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/financial_management_banner') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Financial Management
                                                            (<?= Session::get('financialmanagementbannercount') ?>)
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('archives') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/archives_banner') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Archives
                                                            (<?= Session::get('archivesbannercount') ?>) </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('site_videos_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-movie"></em></span>
                                            <span class="nk-menu-text">Site Videos</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('introduction_videos') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/introduction-videos/en') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Introduction Videos English</span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/introduction-videos/es') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Introduction Videos Espagnol</span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/introduction-videos/fr') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Introduction Videos French</span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/introduction-videos/cre') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Introduction Videos Kreyol
                                                            Haitien</span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/introduction-videos/ar') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Introduction Videos Arabic</span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/introduction-videos/pt') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Introduction Videos Portugues</span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/introduction-videos/ko') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Introduction Videos Korean</span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/introduction-videos/ja') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Introduction Videos Japanese</span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/introduction-videos/de') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Introduction Videos German</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('settings_tutorial') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/setting_tutorials') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Settings Tutorial </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('appoitment_tutorial') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/appoitment_tutorials') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Appointment Tutorial </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('clients_m_tutorial') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/client_tutorials') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Clients M. Tutorial </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('emails_m_tutorial') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/email_tutorials') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Emails M Tutorial </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('financial_tutorial') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/finance_tutorials') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Financial Tutorial </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('archives_tutorial') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/archive_tutorials') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Archives Tutorial </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif

                                @if (permission_access1('sign_in_popups_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-notice"></em></span>
                                            <span class="nk-menu-text">Sign-In Pop-ups</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('create_category_popup') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_category_popup1') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Create Categories-Pop-up1 </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('upload_popup_business_category1') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_upload_popup1') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Uploads- Pop-up (Business Category1)
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('upload_popup_buisiness_category2') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_upload_popup2') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Uploads- Pop-up (Business Category2)
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('popup_settings') == 1)
                                                <li>
                                                    <a href="{{ url('popup1_settings') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Pop-up Settings</span>
                                                    </a>
                                                </li>
                                            @endif
                                             <li>
                                                    <a href="{{ url('plan-expire-popup') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Plan Expire Popup Message</span>
                                                    </a>
                                                </li>
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('templates_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em
                                                    class="icon ni ni-property-alt"></em></span>
                                            <span class="nk-menu-text">Templates</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('create_client_templates_categories') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('create_template_category') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Create Client Templates Categories
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                            <!--   <li class="nk-menu-item">
                                                <a href="{{ url('create_financial_template_category') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Create Financial Templates Categories </span>
                                                </a>
                                            </li> -->
                                            @if (permission_access1('upload_client_templates') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_upload_template_category') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Upload Client Templates </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('upload_financial_templates') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_upload_financial_template_category') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Upload Financial Templates </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('upload_balancesheet_templates') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_upload_balancesheet_template_category') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Upload Balancesheet Templates
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('create_categories_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-view-x3"></em></span>
                                            <span class="nk-menu-text">Create Categories</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('cards') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_card_category') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Cards </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('scripts') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_script_category') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Scripts </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('business') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_business_category') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Business </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('leads') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_leads_category') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Leads </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('personalised_greetings') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_personalised_greeting') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Personalised Greetings</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('upload_to_categories_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-view-x2"></em></span>
                                            <span class="nk-menu-text">Upload to Categories</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('upload_cards') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_upload_card') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Cards </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('upload_scripts') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_upload_script') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Scripts </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('upload_business') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_upload_business') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Business </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('upload_leads') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_upload_leads') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Leads </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('condition_for_baskets_movements_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                                            <span class="nk-menu-text">Conditions For Baskets Movements</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('leads_by_category') == 1)
                                                <li class="nk-menu-item has-sub">
                                                    <a href="#" class="nk-menu-link nk-menu-toggle"
                                                        data-original-title="" title="">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-help-alt"></em></span>
                                                        <span class="nk-menu-text">Leads by Category</span>
                                                    </a>
                                                    <ul class="nk-menu-sub">
                                                        @if ($lead_menu->count() > 0)
                                                            @foreach ($lead_menu as $menu)
                                                                <li class="nk-menu-item">
                                                                    <a href="{{ url('leads-by-category/' . str_replace(' ', '-', strtolower($menu->id))) }}"
                                                                        class="nk-menu-link">
                                                                        <span class="nk-menu-icon"><em
                                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                                        <span
                                                                            class="nk-menu-text">{{ $menu->category }}({{ \App\UploadLeads::total_leads($menu->id) }})
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                            @endif
                                            @if (permission_access1('basket_leads_rotation') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('basket-rotation') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Basket Leads Rotation </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('move_leads_to_baskets1') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('basket1_condition') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Move Leads to Baskets1 </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('move_leads_to_baskets2') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('basket2_condition') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Move Leads to Baskets2 </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('move_leads_to_baskets3') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('basket3_condition') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Move Leads to Baskets3 </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('move_leads_to_baskets4') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('basket4_condition') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Move Leads to Baskets4 </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                <!-- <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title="" title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-aperture"></em></span>
                                            <span class="nk-menu-text">Baskets Movements</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="#" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Basket Leads Rotation </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="#" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Move Leads to Baskets1 </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="#" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Move Leads to Baskets2 </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="#" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Move Leads to Baskets3 </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="#" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Move Leads to Baskets4 </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li> -->
                                @if (permission_access1('commission_setup_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-offer-fill"></em></span>
                                            <span class="nk-menu-text">Commission Set-up</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('commission_setup_table') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('comm_table') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Commission Set-up Table </span>
                                                    </a>
                                                </li>
                                            @endif

                                            @if (permission_access1('affiliate_commission_setting') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('affiliate_commission_setting') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Affiliate Commission Setting </span>
                                                    </a>
                                                </li>
                                            @endif

                                            <li class="nk-menu-item">
                                                <a href="{{ url('show_hide_bonus_pools') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Hide/ Unhide Bonus Pool </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('bonus_prizes_setup_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-award"></em></span>
                                            <span class="nk-menu-text">Bonus & Prizes Set up</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('bonus_condition_table') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('bonus_condition_table') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Bonus Conditions Table </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('bonus_pool_prize_setting') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('bonus-pool-price-list') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span><span
                                                            class="nk-menu-text">Bonus Pool Price Setting</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('prizes_table') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('prize_condition_table') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Prizes table </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('other_table') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('other_condition_table') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Other table </span>
                                                    </a>
                                                </li>
                                            @endif
                                            <!--- <li class="nk-menu-item">
                                                <a href="{{ url('show_hide_prize_btn') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Hide/ Unhide Prize Button </span>
                                                </a>
                                            </li>-->
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('affiliates_management_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em
                                                    class="icon ni ni-user-list-fill"></em></span>
                                            <span class="nk-menu-text">Affiliates Management</span>
                                        </a>
                                        <ul class="nk-menu-sub">

                                            <li class="nk-menu-item">
                                                <a href="{{ url('affiliates_promotion_condition') }}"
                                                    class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Promotion Conditions </span>
                                                </a>
                                            </li>
                                            @if (permission_access1('network') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/network') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Network </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif

                                @if (permission_access1('notification_management_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-reports"></em></span>
                                            <span class="nk-menu-text">Notification Management</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('notifications') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/notifications') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-bell"></em></span>
                                                        <span class="nk-menu-text">Notifications </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('notifications_cms') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/notification-cms') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-bell"></em></span>
                                                        <span class="nk-menu-text">Notifications CMS</span>
                                                    </a>
                                                </li>
                                            @endif

                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('reports_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-reports"></em></span>
                                            <span class="nk-menu-text">Reports</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('bonus_income_report') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/bonus-income-report') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text"> Bonus Income Report </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('level_income_report') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/level-income-report') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Level Income Report </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('prize_report') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/prize-report') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text"> Prize Report </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('other_report') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/other-report') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text"> Other Report </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('transactions') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/transaction-history') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Transactions </span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="nk-menu-item">
                                                <a href="{{ url('user_report') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Users Report </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('©') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Genealogy Report </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('performance_report') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Performance Report </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('qualification_report') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Qualification Report </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('reconciliation_report') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Reconciliation Report </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('comission_report') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Commision Report </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('comprehensive_report') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni  ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Comprehensive Report </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('package_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em
                                                    class="icon ni ni-package-fill"></em></span>
                                            <span class="nk-menu-text">Manage Packages</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('pricing_table') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('pricing_table') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Pricing Table </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('upgrade') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('upgarde_package') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Upgrade </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('feature_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-star-round"></em></span>
                                            <span class="nk-menu-text">Features Access</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('affiliates') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('affilate_features_access') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Affiliates </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('gold') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('gold_features_access') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Gold </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('silver') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('sliver_features_access') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Silver </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('enterprises') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('enterprises_feature_access') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Enterprises </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('front_editing_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title=""
                                            title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-note-add"></em></span>
                                            <span class="nk-menu-text">Front End Editing</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('front_settings') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('setting_front') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Settings </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('front_appoitments') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('appointment_front') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Appointment </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('front_client_management') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('client_mgmt_front') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Clients Management </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('front_email_management') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('email_mgmt_front') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Emails Management </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('front_financial_management') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('financial_mgmt_front') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Financial Management </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('front_appoitments') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('front_archives') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Archives </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('chat_room_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle"
                                            data-original-title="" title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-chat"></em></span>
                                            <span class="nk-menu-text">Chats Rooms</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('manage_chat_rooms') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('chat_room') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Manage Chat Rooms </span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="nk-menu-item">
                                                <a href="{{ url('manage_blog') }}" class="nk-menu-link">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-forward-arrow-fill"></em></span>
                                                    <span class="nk-menu-text">Manage Professional Blogs </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('countries_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle"
                                            data-original-title="" title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-db"></em></span>
                                            <span class="nk-menu-text">Countries</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('create_department') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('manage_department') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Create Department </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('upload_departments') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('upload_department') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Upload Departments </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('create_arroundissements') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('arrondissements') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Create Arrondissements </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('upload_arroundissements') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('upload_arrondissements') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Upload Arrondissements </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('create_communes') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('manage_communes') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Create Communes </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('upload_communes') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('upload_communes') }}" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Upload Communes </span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="nk-menu-item">
                                                <a href="{{ url('admin_birthplace') }}" class="nk-menu-link bg_green">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-setting"></em></span>
                                                    <span class="nk-menu-text">Birthplace - City Projects Setting</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="javascript::void(0)" class="nk-menu-link bg_green">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-setting"></em></span>
                                                    <span class="nk-menu-text">Diaspo-Connection Setting</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('admin_arts_and_culture') }}" class="nk-menu-link bg_green">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-setting"></em></span>
                                                    <span class="nk-menu-text">Arts & Culture Setting</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('admin_top_city_news') }}" class="nk-menu-link bg_green">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-setting"></em></span>
                                                    <span class="nk-menu-text">Top City News Setting</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('admin_my_faith') }}" class="nk-menu-link bg_green">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-setting"></em></span>
                                                    <span class="nk-menu-text">My Faith Setting</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="javascript::void(0)" class="nk-menu-link bg_green">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-setting"></em></span>
                                                    <span class="nk-menu-text">City Management Setting</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('admin/leadersboard') }}" class="nk-menu-link bg_green">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-setting"></em></span>
                                                    <span class="nk-menu-text">Leaders Board</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('admin/user_leadersboard') }}" class="nk-menu-link bg_green">
                                                    <span class="nk-menu-icon"><em
                                                            class="icon ni ni-setting"></em></span>
                                                    <span class="nk-menu-text">Leaders Board Reports</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif

                                @if (permission_access1('archives_views') == 1)
                                    <li class="nk-menu-item">
                                        <a href="{{ url('admin/archives') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-folders"></em></span>
                                            <span class="nk-menu-text">Archives </span>
                                        </a>
                                    </li>
                                @endif
                                @if (permission_access1('forms_library_views') == 1)
                                    <li class="nk-menu-item">
                                        <a href="{{ url('admin/forms_library') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em
                                                    class="icon ni ni-property-alt"></em></span>
                                            <span class="nk-menu-text">Forms Library </span>
                                        </a>
                                    </li>
                                @endif
                                @if (permission_access1('google_analysis_views') == 1)
                                    <li class="nk-menu-item">
                                        <a href="{{ url('admin/google-analytics') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                                            <span class="nk-menu-text">Google Analysis </span>
                                        </a>
                                    </li>
                                @endif
                                @if (permission_access1('payment_gateway_views') == 1)
                                    <li class="nk-menu-item">
                                        <a href="{{ url('admin/payment-gateway-setting') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em
                                                    class="icon ni ni-wallet-alt"></em></span>
                                            <span class="nk-menu-text">Payment Gateway </span>
                                        </a>
                                    </li>
                                @endif
                                @if (permission_access1('smtp_setting_views') == 1)
                                    <li class="nk-menu-item">
                                        <a href="{{ url('admin/smtp-setting') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em
                                                    class="icon ni ni-wallet-alt"></em></span>
                                            <span class="nk-menu-text">SMTP Setting </span>
                                        </a>
                                    </li>
                                @endif
                                <!-- @if (permission_access1('change_password_view') == 1)
-->
                                <li class="nk-menu-item">
                                    <a href="{{ url('change_password') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em
                                                class="icon ni ni-account-setting-fill"></em></span>
                                        <span class="nk-menu-text">Change Password </span>
                                    </a>
                                </li>
                                <!--
@endif -->
                                @if (permission_access1('shedule_holiday_views') == 1)
                                    <li class="nk-menu-item">
                                        <a href="{{ url('admin_schedule_holiday') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-db"></em></span>
                                            <span class="nk-menu-text">Schedule Holiday </span>
                                        </a>
                                    </li>
                                @endif
                                @if (permission_access1('background_color_views') == 1)
                                    <li class="nk-menu-item">
                                        <a href="{{ url('admin_set_background') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-db"></em></span>
                                            <span class="nk-menu-text">Background Color </span>
                                        </a>
                                    </li>
                                @endif
                                @if (permission_access1('survey_polls_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle"
                                            data-original-title="" title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-db"></em></span>
                                            <span class="nk-menu-text">Survey/Polls </span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('survey_questions') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_survey_polls') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Survey Questions</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (permission_access1('survey_result') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin_user_records') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Survey Result</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif

                                @if (permission_access1('terms_condition_views') == 1)
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle"
                                            data-original-title="" title="">
                                            <span class="nk-menu-icon"><em class="icon ni ni-todo-fill"></em></span>
                                            <span class="nk-menu-text">Terms & Condition</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @if (permission_access1('upload') == 1)
                                                <li class="nk-menu-item">
                                                    <a href="{{ url('admin/terms_conditions') }}"
                                                        class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em
                                                                class="icon ni ni-forward-arrow-fill"></em></span>
                                                        <span class="nk-menu-text">Upload </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                @if (permission_access1('test_components_views') == 1)
                                    <li class="nk-menu-item">
                                        <a href="{{ url('admin/tests_components') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-db"></em></span>
                                            <span class="nk-menu-text">Tests Components </span>
                                        </a>
                                    </li>
                                @endif

                                @if (permission_access1('test_components_views') == 1)
                                    <li class="nk-menu-item">
                                        <a href="{{ url('change_password') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                                            <span class="nk-menu-text">Change Password</span>
                                        </a>
                                    </li>
                                @endif



                            </ul>
                            <!-- .nk-menu -->
                        </div>
                        <!-- .nk-sidebar-menu -->
                    </div>
                    <!-- .nk-sidebar-content -->
                </div>
                <!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon"
                                    data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="{{ url('admin') }}" class="logo-link">
                                    <img class="logo-light logo-img"
                                        src="{{ asset('admin_assets/images/logo_light.png') }}" alt="logo" />
                                    <img class="logo-dark logo-img"
                                        src="{{ asset('admin_assets/images/logo_light.png') }}" alt="logo-dark" />
                                </a>
                            </div>
                            <!-- .nk-header-brand -->
                            <!--<div class="nk-header-news d-none d-xl-block">
                                <div class="nk-news-list">
                                    <a class="nk-news-item" href="#">
                                        <div class="nk-news-icon">
                                            <em class="icon ni ni-card-view"></em>
                                        </div>
                                        <div class="nk-news-text">
                                            <p>Do you know the latest update of 2019? <span> A overview of our is now available on YouTube</span></p>
                                            <em class="icon ni ni-external"></em>
                                        </div>
                                    </a>
                                </div>
                            </div>-->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">Administrator</div>
                                                    <div class="user-name dropdown-indicator">
                                                        {{ Auth::user()->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div
                                            class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li>
                                                        <a class="" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                            <em
                                                                class="icon ni ni-signout"></em><span>{{ __('Logout') }}</span>
                                                        </a>
                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- .dropdown -->
                                </ul>
                                <!-- .nk-quick-nav -->
                            </div>
                            <!-- .nk-header-tools -->
                        </div>
                        <!-- .nk-header-wrap -->
                    </div>
                    <!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                @if (Session::has('status'))
                    <div class="message_aalert">
                        <div class="alert alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                            {{ Session::get('status') }}
                        </div>
                    </div>
                @endif
                @yield('content')
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright">&copy; <?= date('Y') ?> <a
                                    href="">MAFAMA.COM</a></div>
                            <!--<div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                                </ul>
                            </div>-->
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('admin_assets/js/bundle.js') }}?ver=1.6.0"></script>
    <script src="{{ asset('admin_assets/js/scripts.js') }}?ver=1.6.0"></script>
    <script src="{{ asset('admin_assets/js/charts/gd-general.js') }}?ver=1.6.0"></script>
    <script src="{{ asset('admin_assets/js/colorpicker.js') }}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap-formhelpers.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}" defer></script>
    <script src="{{ asset('assets/toastr/toastr.js') }}" defer></script>
    <script src="{{ asset('genealogy/treeview.js') }}"></script>


    <script type="text/javascript" src="{{ asset('includes/common.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('includes/backendscript.js') }}" defer></script>

    <script>
        $(".color-td").click(function() {
            var color = $(this).css("background-color");
            //alert(color);
            $(".msgbox").css("background-color", color);
            //some code
        });
    </script>
    <script>
        /*$(function() {
                                $('#colorpickerHolder').ColorPicker({flat: true});

                                $('#colorSelector').ColorPicker({
                                    color: '#0000ff',
                                    onShow: function (colpkr) {
                                        $(colpkr).fadeIn(500);
                                        return false;
                                    },
                                    onHide: function (colpkr) {
                                        $(colpkr).fadeOut(500);
                                        return false;
                                    },
                                    onChange: function (hsb, hex, rgb) {
                                        $('#colorSelector div').css') }}('backgroundColor', '#' + hex);
                                    }
                                });

                                $('#colorpickerField').ColorPicker({
                                    onSubmit: function(hsb, hex, rgb, el) {

                                        $(el).val(hex);
                                        $('.msgbox').css') }}('background-color', '#' + hex);
                                        $('#colorpickerField').css') }}('background-color', '#' + hex);
                                        $(el).ColorPickerHide();
                                    },
                                    onBeforeShow: function () {
                                        $(this).ColorPickerSetColor(this.value);
                                    }
                                })
                                .bind('keyup', function(){
                                    $(this).ColorPickerSetColor(this.value);
                                });
                            });*/
    </script>
    <!-- @@ Profile Edit Modal @e -->
    <div class="modal fade" tabindex="-1" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <h5 class="title">Update Profile</h5>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#address">Address</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#edit-password">Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#limit">Limit Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#joining-date">Date Joined</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#address">Crypto Address</a>
                        </li>
                    </ul>
                    <!-- .nav-tabs -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="personal">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="full-name">Full Name</label>
                                        <input type="text" class="form-control form-control-lg" id="full-name"
                                            value="Abu Bin Ishtiyak" placeholder="Enter Full name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="display-name">Username</label>
                                        <input type="text" class="form-control form-control-lg"
                                            id="display-name" value="Ishtiyak" placeholder="Enter display name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="phone-no">Phone Number</label>
                                        <input type="text" class="form-control form-control-lg" id="phone-no"
                                            value="+880" placeholder="Phone Number" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="birth-day">Date of Birth</label>
                                        <input type="text" class="form-control form-control-lg date-picker"
                                            id="birth-day" placeholder="Enter your name" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <a href="#" class="btn btn-lg btn-primary">Update Profile</a>
                                        </li>
                                        <li>
                                            <a href="#" data-dismiss="modal"
                                                class="link link-light">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- .tab-pane -->
                        <div class="tab-pane" id="address">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l1">Address Line 1</label>
                                        <input type="text" class="form-control form-control-lg" id="address-l1"
                                            value="2337 Kildeer Drive" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l2">Address Line 2</label>
                                        <input type="text" class="form-control form-control-lg" id="address-l2"
                                            value="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-st">State</label>
                                        <input type="text" class="form-control form-control-lg" id="address-st"
                                            value="Kentucky" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-county">Country</label>
                                        <select class="form-select" id="address-county" data-ui="lg">
                                            <option>Canada</option>
                                            <option>United State</option>
                                            <option>United Kindom</option>
                                            <option>Australia</option>
                                            <option>India</option>
                                            <option>Bangladesh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <a href="#" class="btn btn-lg btn-primary">Update Address</a>
                                        </li>
                                        <li>
                                            <a href="#" data-dismiss="modal"
                                                class="link link-light">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- .tab-pane -->
                        <div class="tab-pane" id="edit-password">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Old Password</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="xxxxxx" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">New Password</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="XXXXX" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="XXXXXX" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <a href="#" class="btn btn-lg btn-primary">Update Password</a>
                                        </li>
                                        <li>
                                            <a href="#" data-dismiss="modal"
                                                class="link link-light">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- .tab-pane -->
                        <div class="tab-pane" id="limit">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l1">Limit Profit Winning</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="10" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l1">Limit Withdrawal / Profit
                                            amount</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="10" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <a href="#" class="btn btn-lg btn-primary">Update</a>
                                        </li>
                                        <li>
                                            <a href="#" data-dismiss="modal"
                                                class="link link-light">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- .tab-pane -->
                        <div class="tab-pane" id="joining-date">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l1">Date Joined</label>
                                        <input type="text" class="form-control form-control-lg date-picker"
                                            value="" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <a href="#" class="btn btn-lg btn-primary">Update</a>
                                        </li>
                                        <li>
                                            <a href="#" data-dismiss="modal"
                                                class="link link-light">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- .tab-pane -->
                        <div class="tab-pane" id="crypto-address">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l1">Crpto Wallet Address</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="FSJYTGT63KJ&" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <a href="#" class="btn btn-lg btn-primary">Update</a>
                                        </li>
                                        <li>
                                            <a href="#" data-dismiss="modal"
                                                class="link link-light">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- .tab-pane -->
                    </div>
                    <!-- .tab-content -->
                </div>
                <!-- .modal-body -->
            </div>
            <!-- .modal-content -->
        </div>
        <!-- .modal-dialog -->
    </div>
    <!-- .modal -->
    <!-- PRELOADER -->
    <div id="preloader">
        <div class="inner">
            <span class="loader"></span>
        </div>
    </div>
    <!-- /PRELOADER -->
    <div id="lloader"></div>
    <script>
        var spinner = $('#lloader');
        // $(function() {
        //   $('form').submit(function(e) {
        //     e.preventDefault();
        //     spinner.show();
        //     $.ajax({
        //       url: 't2228.php',
        //       data: $(this).serialize(),
        //       method: 'post',
        //       dataType: 'JSON'
        //     }).done(function(resp) {
        //       spinner.hide();
        //       alert(resp.status);
        //     });
        //   });
        // });
    </script>
</body>
<!-- <script type="text/javascript">
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('.date-picker').attr('min', maxDate);
    });
</script> -->
<script type="text/javascript">
    $('.select2').select2({
        placeholder: 'Select Category',
        //allowClear: true
    });
    $('.timepicker').timepicker({
        format: 'HH:mm'
    });
    $(".date-picker").datepicker({
        format: "yyyy-mm-dd",
        startDate: new Date()
    });
    $(".date-picker1").datepicker({
        format: "yyyy-mm-dd",
        //startDate: new Date()
    });
    // $(document).ready(function() {
    //     $('.datatable-init').DataTable( {
    //         aaSorting: [[1, 'desc']]
    //     });
    // } );
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300
        });
    });
</script>

<script>
    $(document).ready(function() {
        
        $('.hmd_uplines_ajax').click(function() {
            
            let user_id = $(this).attr("user-id");
            console.log(user_id);
            
            $.ajax({
                type: 'GET',
                url: '/get_genealogy_uplines_data',
                data: {
                    user_id: user_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                }
            });
        });
        
        $('.hmd_downlines_ajax').click(function() {
            
            let user_id = $(this).attr("user-id");
            console.log(user_id);
            
            $.ajax({
                type: 'GET',
                url: '/get_genealogy_downlines_data',
                data: {
                    user_id: user_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#append_genealogy_report').html(data);
                }
            });
        });
        
    });
</script>

@yield('script')

</html>

</html>
