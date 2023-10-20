@extends('layouts.main')
@section('content')
    <link href="{{ asset('public/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('public/morris/morris.min.js') }}" type="text/javascript"></script>
    <style type="text/css">
        .commall,
        .commall2,
        .commall3,
        .commall4,
        .commall5 {
            border: 1px solid;
            border-radius: 4px;
            padding: 5px;
            margin: 5px 0;
        }

        .outl {
            outline: rgb(218, 41, 28) auto 6px !important;
        }

        #monthlylist,
        #monthlylistq,
        #monthlylisty,
        #monthlylistv,
        #monthlylistz,
        #monthlylistk {
            list-style-type: none;
            width: 100%;
            padding: 0;
            margin-bottom: 5px;
        }

        #monthlylist li,
        #monthlylisty li,
        #monthlylistq li,
        #monthlylistv li,
        #monthlylistz li,
        #monthlylistk li {
            display: inline-table;
            background: #da291c;
            color: white;
            padding: 3px 15px;
            margin: 10px 0;
            border-radius: 4px;
            cursor: pointer;
        }

        #monthlylist1,
        #monthlylist1q,
        #monthlylist1y,
        #monthlylist1v,
        #monthlylist1z,
        #monthlylist1k {
            list-style-type: none;
            width: 100%;
            padding: 0;
            margin-bottom: 5px;
        }

        #monthlylist1 li,
        #monthlylist1q li,
        #monthlylist1y li,
        #monthlylist1v li,
        #monthlylist1z li,
        #monthlylist1k li {
            display: inline-table;
            background: #da291c;
            color: white;
            padding: 3px 15px;
            margin: 10px 0;
            border-radius: 4px;
            cursor: pointer;
        }

        .monthlylist,
        .monthlylistq,
        .monthlylisty,
        .monthlylistv,
        .monthlylistz,
        .monthlylistk {
            list-style-type: none;
            width: 100%;
            padding: 0;
            margin-bottom: 5px;
        }

        .monthlylist li,
        .monthlylistq li,
        .monthlylisty li,
        .monthlylistv li,
        .monthlylistz li,
        .monthlylistk li {
            display: inline-table;
            background: #da291c;
            color: white;
            padding: 3px 15px;
            margin: 10px 2px;
            border-radius: 4px;
            cursor: pointer;
        }

        .monthlylist1,
        .monthlylist1q,
        .monthlylist1y,
        .monthlylist1v,
        .monthlylist1z,
        .monthlylist1k {
            list-style-type: none;
            width: 100%;
            padding: 0;
            margin-bottom: 5px;
        }

        .monthlylist1 li,
        .monthlylist1q li,
        .monthlylist1y li,
        .monthlylist1v li,
        .monthlylist1z li,
        .monthlylist1k li {
            display: inline-table;
            background: #da291c;
            color: white;
            padding: 3px 15px;
            margin: 10px 2px;
            border-radius: 4px;
            cursor: pointer;
        }

        table td a {
            color: #da291c !important;
        }

        #monthly_details th,
        #monthly_details td {
            text-align: left !important;
        }

        #monthly_details td {
            color: grey !important;
        }

        .table-striped tfoot tr td {
            text-align: left;
        }

        .cyear,
        .cmonth {
            background: #336f05 !important;
        }

        .monthlylist li.cyear,
        .monthlylistq li.cyear,
        .monthlylisty li.cyear,
        .monthlylistv li.cyear,
        .monthlylistz li.cyear,
        .monthlylistk li.cyear {
            background: #2b02d0 !important;
        }

        .monthlylist1 li.cmonth,
        .monthlylist1q li.cmonth,
        .monthlylist1y li.cmonth,
        .monthlylist1v li.cmonth,
        .monthlylist1z li.cmonth,
        .monthlylist1k li.cmonth {
            background: #2b02d0 !important;
        }

        .clipboard {
            display: inline-block;
        }

        /* You just need to get this field */
        .copy-input {
            max-width: 324px;
            width: 100%;
            cursor: pointer;
            background-color: #eaeaeb;
            border: none;
            color: #6c6c6c;
            font-size: 14px;
            border-radius: 5px;
            padding: 10px 45px 10px 15px;
            font-family: 'Montserrat', sans-serif;
            border: #da291c7a 1px solid !important
                /* box-shadow: 0 3px 15px #b8c6db;
     -moz-box-shadow: 0 3px 15px #b8c6db;
      -webkit-box-shadow: 0 3px 15px #b8c6db;*/
        }

        .copy-input:focus {
            outline: none;
        }

        .copy-btn {
            width: 40px;
            background-color: #eaeaeb;
            font-size: 16px;
            padding: 6px 9px;
            border-radius: 5px;
            border: none;
            color: #6c6c6c;
            margin-left: -50px;
            transition: all .4s;
        }

        .copy-btn:hover {
            transform: scale(1.1);
            color: #1a1a1a;
            cursor: pointer;
        }

        .copy-btn:focus {
            outline: none;
        }

        .copied {
            font-family: 'Montserrat', sans-serif;
            width: 75px;
            display: none;
            position: absolute;
            bottom: 0px;
            left: 150px;
            margin: auto;
            color: #000;
            padding: 15px 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 3px 15px #b8c6db;
            -moz-box-shadow: 0 3px 15px #b8c6db;
            -webkit-box-shadow: 0 3px 15px #b8c6db;
        }

        .copied1 {
            font-family: 'Montserrat', sans-serif;
            width: 75px;
            display: none;
            position: absolute;
            bottom: 0px;
            left: 470px;

            margin: auto;
            color: #000;
            padding: 15px 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 3px 15px #b8c6db;
            -moz-box-shadow: 0 3px 15px #b8c6db;
            -webkit-box-shadow: 0 3px 15px #b8c6db;
        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2) {
            .copy-btn {
                width: 30px;
                background-color: #eaeaeb;
                font-size: 16px;
                padding: 6px 9px;
            }

            .copied {
                bottom: 130px;
                left: 150px;
            }

            .copied1 {
                bottom: 90px;
                left: 150px;
            }

            .copy-input {
                margin-bottom: 10px;
            }
        }
    </style>
    <script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>

    <section>
        <div class="container">
            <div class="row">
                <!-- tabs content -->
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12">
                        <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                            <h4>Financial Management / Financial Comparisons</h4>
                        </div>
                    </div>
                    <div class="col-md-12 text-center margin-bottom-20">
                        <span style="display:inline-block;max-width: 344px;width: 100%;">
                            <label style="display:block;text-align: center;">Your Website link</label>
                            <input onclick="copy1()" class="copy-input" value="{{ $my_profile_link }}" id="copyClipboard1"
                                style="margin-right:20px;" readonly>
                        </span>
                        <button type="button" class="copy-btn" id="copyButton" onclick="copy1()"><i
                                class="far fa-copy"></i></button>
                        <div id="copied-success1" class="copied">
                            <span>Copied!</span>
                        </div>
                        <span style="display:inline-block;max-width: 344px;width: 100%;">

                            <label style="display:block;text-align: center;">Referral link</label>
                            <input onclick="copy()" class="copy-input" value="{{ $my_referral_link }}" id="copyClipboard"
                                style="margin-right:20px;" readonly>
                        </span>
                        <button type="button" class="copy-btn" id="copyButton" onclick="copy()"><i
                                class="far fa-copy"></i></button>
                        <div id="copied-success" class="copied1">
                            <span>Copied!</span>
                        </div>
                        <div class="margin-top-10">
                            <a href="#" class="btn btn-md btn-info margin-right-10">View Offers</a>
                            <a href="#" class="btn btn-md btn-info margin-right-10">My Faith</a>
                            <a href="{{ url('birthplace') }}" class="btn btn-md btn-info margin-right-10">My Birth Place</a>
                            <a href="#" class="btn btn-md btn-info margin-right-10">Sharing</a>
                            <a href="#" class="btn btn-md btn-info margin-right-10">My City Guide</a>
                            <?php if($chat != "off"){ ?>
                            <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                            <?php } ?>
                            <?php if($tools != "off"){ ?>
                            <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                            <?php } ?>
                            <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">My Daily
                                Briefing</a>
                            <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-button-tabs nav-justified  margin-top-10">
                        <li class="active"><a href="{{ url('comparison_email') }}">Monthly</a></li>
                        <li><a href="{{ url('comparison_email2') }}">Quarterly</a></li>
                        <li><a href="{{ url('comparison_email3') }}">Yearly</a></li>
                    </ul>
                    <div class="tab-content margin-top-10"
                        style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li class="active"><a href="#tab1" data-toggle="tab">Email Campaigns</a></li>
                                <li><a href="#tab2" data-toggle="tab">Send Email</a></li>
                                <li><a href="#tab3" data-toggle="tab">Send Card</a></li>
                                <li><a href="#tab4" data-toggle="tab">Send Videos</a></li>
                                <li><a href="#tab5" data-toggle="tab">Send SMS</a></li>
                                <li><a href="#tab6" data-toggle="tab">Chat</a></li>
                            </ul>
                            <div class="tab-content margin-top-10"
                                style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                                <div class="tab-pane fade in active" id="tab1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="comparisontabs">
                                                <div class="margin-top-10"
                                                    style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label style="margin: 12px 0;">Choose a base year</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="">
                                                                <ul class="" id="yearlist" style="display: none;">
                                                                    <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                    <?php } ?>
                                                                </ul>
                                                                <ul class="" id="monthlylist">
                                                                    <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label style="margin: 12px 0;">Choose a base month</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="">
                                                                <ul class="" id="monthlylist1">
                                                                    <li class="act">Jan</li>
                                                                    <li class="act">Feb</li>
                                                                    <li class="act">Mar</li>
                                                                    <li class="act">Apr</li>
                                                                    <li class="act">May</li>
                                                                    <li class="act">Jun</li>
                                                                    <li class="act">Jul</li>
                                                                    <li class="act">Aug</li>
                                                                    <li class="act">Sep</li>
                                                                    <li class="act">Oct</li>
                                                                    <li class="act">Nov</li>
                                                                    <li class="act">Dec</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <!-- <i class="fas fa-plus-circle addcomprsntab"></i> -->
                                            <button class="btn btn-primary addcomprsntab" id="addcompareyear">Add
                                                Year/Month</button>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-primary compare_btn"
                                                style="display: none;">Compare</button>
                                        </div>
                                        <div class="col-md-12" id="emailcampaigncount"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in " id="tab2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="comparisontabsq">
                                                <div class="margin-top-10"
                                                    style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label style="margin: 12px 0;">Choose a base year</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="">
                                                                <ul class="" id="yearlistq" style="display: none;">
                                                                    <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                    <?php } ?>
                                                                </ul>
                                                                <ul class="" id="monthlylistq">
                                                                    <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label style="margin: 12px 0;">Choose a base month</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="">
                                                                <ul class="" id="monthlylist1q">
                                                                    <li class="act">Jan</li>
                                                                    <li class="act">Feb</li>
                                                                    <li class="act">Mar</li>
                                                                    <li class="act">Apr</li>
                                                                    <li class="act">May</li>
                                                                    <li class="act">Jun</li>
                                                                    <li class="act">Jul</li>
                                                                    <li class="act">Aug</li>
                                                                    <li class="act">Sep</li>
                                                                    <li class="act">Oct</li>
                                                                    <li class="act">Nov</li>
                                                                    <li class="act">Dec</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <!-- <i class="fas fa-plus-circle addcomprsntab"></i> -->
                                            <button class="btn btn-primary addcomprsntabq" id="addcompareyearq">Add
                                                Year/Month</button>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-primary compare_btnq"
                                                style="display: none;">Compare</button>
                                        </div>
                                        <div class="col-md-12" id="emailcampaigncountq"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in " id="tab3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="comparisontabsy">
                                                <div class="margin-top-10"
                                                    style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label style="margin: 12px 0;">Choose a base year</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="">
                                                                <ul class="" id="yearlisty" style="display: none;">
                                                                    <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                    <?php } ?>
                                                                </ul>
                                                                <ul class="" id="monthlylisty">
                                                                    <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label style="margin: 12px 0;">Choose a base month</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="">
                                                                <ul class="" id="monthlylist1y">
                                                                    <li class="act">Jan</li>
                                                                    <li class="act">Feb</li>
                                                                    <li class="act">Mar</li>
                                                                    <li class="act">Apr</li>
                                                                    <li class="act">May</li>
                                                                    <li class="act">Jun</li>
                                                                    <li class="act">Jul</li>
                                                                    <li class="act">Aug</li>
                                                                    <li class="act">Sep</li>
                                                                    <li class="act">Oct</li>
                                                                    <li class="act">Nov</li>
                                                                    <li class="act">Dec</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <!-- <i class="fas fa-plus-circle addcomprsntab"></i> -->
                                            <button class="btn btn-primary addcomprsntaby" id="addcompareyeary">Add
                                                Year/Month</button>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-primary compare_btny"
                                                style="display: none;">Compare</button>
                                        </div>
                                        <div class="col-md-12" id="emailcampaigncounty"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in " id="tab4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="comparisontabsv">
                                                <div class="margin-top-10"
                                                    style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label style="margin: 12px 0;">Choose a base year</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="">
                                                                <ul class="" id="yearlistv" style="display: none;">
                                                                    <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                    <?php } ?>
                                                                </ul>
                                                                <ul class="" id="monthlylistv">
                                                                    <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label style="margin: 12px 0;">Choose a base month</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="">
                                                                <ul class="" id="monthlylist1v">
                                                                    <li class="act">Jan</li>
                                                                    <li class="act">Feb</li>
                                                                    <li class="act">Mar</li>
                                                                    <li class="act">Apr</li>
                                                                    <li class="act">May</li>
                                                                    <li class="act">Jun</li>
                                                                    <li class="act">Jul</li>
                                                                    <li class="act">Aug</li>
                                                                    <li class="act">Sep</li>
                                                                    <li class="act">Oct</li>
                                                                    <li class="act">Nov</li>
                                                                    <li class="act">Dec</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <!-- <i class="fas fa-plus-circle addcomprsntab"></i> -->
                                            <button class="btn btn-primary addcomprsntabv" id="addcompareyearv">Add
                                                Year/Month</button>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-primary compare_btnv"
                                                style="display: none;">Compare</button>
                                        </div>
                                        <div class="col-md-12" id="emailcampaigncountv"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in " id="tab5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="comparisontabsz">
                                                <div class="margin-top-10"
                                                    style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label style="margin: 12px 0;">Choose a base year</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="">
                                                                <ul class="" id="yearlistz" style="display: none;">
                                                                    <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                    <?php } ?>
                                                                </ul>
                                                                <ul class="" id="monthlylistz">
                                                                    <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label style="margin: 12px 0;">Choose a base month</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="">
                                                                <ul class="" id="monthlylist1z">
                                                                    <li class="act">Jan</li>
                                                                    <li class="act">Feb</li>
                                                                    <li class="act">Mar</li>
                                                                    <li class="act">Apr</li>
                                                                    <li class="act">May</li>
                                                                    <li class="act">Jun</li>
                                                                    <li class="act">Jul</li>
                                                                    <li class="act">Aug</li>
                                                                    <li class="act">Sep</li>
                                                                    <li class="act">Oct</li>
                                                                    <li class="act">Nov</li>
                                                                    <li class="act">Dec</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <!-- <i class="fas fa-plus-circle addcomprsntab"></i> -->
                                            <button class="btn btn-primary addcomprsntabz" id="addcompareyearz">Add
                                                Year/Month</button>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-primary compare_btnz"
                                                style="display: none;">Compare</button>
                                        </div>
                                        <div class="col-md-12" id="emailcampaigncountz"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <div id="CompareModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="margin-top: -29px;"><span aria-hidden="true">&times;</span></button>
                    <div class="row">
                        <div id="comparebody"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="allyearmonth" value="">
    <input type="hidden" id="allyearmonth2" value="">
    <input type="hidden" id="allyearmonth3" value="">
    <script type="text/javascript">
        function copy() {
            var copyText = document.getElementById("copyClipboard");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            $('#copied-success').fadeIn(800);
            $('#copied-success').fadeOut(800);
        }

        function copy1() {
            var copyText = document.getElementById("copyClipboard1");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            $('#copied-success1').fadeIn(800);
            $('#copied-success1').fadeOut(800);
        }
    </script>
    <script type="text/javascript">
        var x = 1;
        $(document).ready(function() {
            $(".addcomprsntab").on("click", function() {
                var yearlist = $("#yearlist").html();
                var html =
                    '<div class="margin-top-10 commall" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;"> <div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a year to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylist"> ' +
                    yearlist +
                    ' </ul> </div></div></div><div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a month to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylist1"> <li class="act">Jan</li><li class="act">Feb</li><li class="act">Mar</li><li class="act">Apr</li><li class="act">May</li><li class="act">Jun</li><li class="act">Jul</li><li class="act">Aug</li><li class="act">Sep</li><li class="act">Oct</li><li class="act">Nov</li><li class="act">Dec</li></ul> </div></div></div><div class="clearfix"></div></div>';
                $(".comparisontabs").append(html);
            });
            $(document).on("click", ".monthlylist li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cyear");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cyear");
                $(".compare_btn").trigger("click");
            });
            $(document).on("click", ".monthlylist1 li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cmonth");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cmonth");
                $(".compare_btn").trigger("click");
            });
            $(document).on("click", "#monthlylist li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cyear");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cyear");
                $(".compare_btn").trigger("click");
            });
            $(document).on("click", "#monthlylist1 li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cmonth");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cmonth");
                $(".compare_btn").trigger("click");
            });
        });
        $(document).on("click", ".compare_btn", function() {
            var allyearmonth = [];
            var fyear = "";
            var fmonth = "";
            fyear = $("#monthlylist li.cyear").text();
            var fmonthh = $("#monthlylist1 li.cmonth").text();
            if (fmonthh == 'Jan') {
                fmonth = '01';
            } else if (fmonthh == 'Feb') {
                fmonth = '02';
            } else if (fmonthh == 'Mar') {
                fmonth = '03';
            } else if (fmonthh == 'Apr') {
                fmonth = '04';
            } else if (fmonthh == 'May') {
                fmonth = '05';
            } else if (fmonthh == 'Jun') {
                fmonth = '06';
            } else if (fmonthh == 'Jul') {
                fmonth = '07';
            } else if (fmonthh == 'Aug') {
                fmonth = '08';
            } else if (fmonthh == 'Sep') {
                fmonth = '09';
            } else if (fmonthh == 'Oct') {
                fmonth = '10';
            } else if (fmonthh == 'Nov') {
                fmonth = '11';
            } else if (fmonthh == 'Dec') {
                fmonth = '12';
            }
            if ((fyear != "") && (fmonth != "")) {
                allyearmonth.push(fyear + "nqd" + fmonth);
            }
            $(".commall").each(function() {
                var lyear = "";
                var lmonth = "";
                $(this).find(".monthlylist li.cyear").each(function() {
                    lyear = $(this).text();
                });
                $(this).find(".monthlylist1 li.cmonth", this).each(function() {
                    var lmonthh = $(this).text();
                    if (lmonthh == 'Jan') {
                        lmonth = '01';
                    } else if (lmonthh == 'Feb') {
                        lmonth = '02';
                    } else if (lmonthh == 'Mar') {
                        lmonth = '03';
                    } else if (lmonthh == 'Apr') {
                        lmonth = '04';
                    } else if (lmonthh == 'May') {
                        lmonth = '05';
                    } else if (lmonthh == 'Jun') {
                        lmonth = '06';
                    } else if (lmonthh == 'Jul') {
                        lmonth = '07';
                    } else if (lmonthh == 'Aug') {
                        lmonth = '08';
                    } else if (lmonthh == 'Sep') {
                        lmonth = '09';
                    } else if (lmonthh == 'Oct') {
                        lmonth = '10';
                    } else if (lmonthh == 'Nov') {
                        lmonth = '11';
                    } else if (lmonthh == 'Dec') {
                        lmonth = '12';
                    }
                });
                if ((lyear != "") && (lmonth != "")) {
                    allyearmonth.push(lyear + "nqd" + lmonth);
                }
            });
            if (allyearmonth != "") {
                $.ajax({
                    type: "POST",
                    // beforeSend: function(){
                    //   $("#loading").show();
                    //   $("#wrapper").hide();
                    // },
                    url: "monthlyyearlycomemail_campaign",
                    data: 'allyearmonth=' + allyearmonth + '&_token={{ csrf_token() }}',
                    success: function(html) {
                        // alert(html);
                        $("#emailcampaigncount").html(html);
                    },
                    // complete: function(){
                    //   $("#loading").hide();
                    //   $("#wrapper").show();
                    // }
                });
            } else {
                $("#emailcampaigncount").html("");
            }
        });
    </script>
    <script type="text/javascript">
        var x = 1;
        $(document).ready(function() {
            $(".addcomprsntabq").on("click", function() {
                var yearlist = $("#yearlistq").html();
                var html =
                    '<div class="margin-top-10 commallq" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;"> <div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a year to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylistq"> ' +
                    yearlist +
                    ' </ul> </div></div></div><div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a month to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylist1q"> <li class="act">Jan</li><li class="act">Feb</li><li class="act">Mar</li><li class="act">Apr</li><li class="act">May</li><li class="act">Jun</li><li class="act">Jul</li><li class="act">Aug</li><li class="act">Sep</li><li class="act">Oct</li><li class="act">Nov</li><li class="act">Dec</li></ul> </div></div></div><div class="clearfix"></div></div>';
                $(".comparisontabsq").append(html);
            });
            $(document).on("click", ".monthlylistq li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cyear");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cyear");
                $(".compare_btnq").trigger("click");
            });
            $(document).on("click", ".monthlylist1q li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cmonth");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cmonth");
                $(".compare_btnq").trigger("click");
            });
            $(document).on("click", "#monthlylistq li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cyear");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cyear");
                $(".compare_btnq").trigger("click");
            });
            $(document).on("click", "#monthlylist1q li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cmonth");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cmonth");
                $(".compare_btnq").trigger("click");
            });
        });
        $(document).on("click", ".compare_btnq", function() {
            var allyearmonth = [];
            var fyear = "";
            var fmonth = "";
            fyear = $("#monthlylistq li.cyear").text();
            var fmonthh = $("#monthlylist1q li.cmonth").text();
            if (fmonthh == 'Jan') {
                fmonth = '01';
            } else if (fmonthh == 'Feb') {
                fmonth = '02';
            } else if (fmonthh == 'Mar') {
                fmonth = '03';
            } else if (fmonthh == 'Apr') {
                fmonth = '04';
            } else if (fmonthh == 'May') {
                fmonth = '05';
            } else if (fmonthh == 'Jun') {
                fmonth = '06';
            } else if (fmonthh == 'Jul') {
                fmonth = '07';
            } else if (fmonthh == 'Aug') {
                fmonth = '08';
            } else if (fmonthh == 'Sep') {
                fmonth = '09';
            } else if (fmonthh == 'Oct') {
                fmonth = '10';
            } else if (fmonthh == 'Nov') {
                fmonth = '11';
            } else if (fmonthh == 'Dec') {
                fmonth = '12';
            }
            if ((fyear != "") && (fmonth != "")) {
                allyearmonth.push(fyear + "nqd" + fmonth);
            }
            $(".commallq").each(function() {
                var lyear = "";
                var lmonth = "";
                $(this).find(".monthlylistq li.cyear").each(function() {
                    lyear = $(this).text();
                });
                $(this).find(".monthlylist1q li.cmonth", this).each(function() {
                    var lmonthh = $(this).text();
                    if (lmonthh == 'Jan') {
                        lmonth = '01';
                    } else if (lmonthh == 'Feb') {
                        lmonth = '02';
                    } else if (lmonthh == 'Mar') {
                        lmonth = '03';
                    } else if (lmonthh == 'Apr') {
                        lmonth = '04';
                    } else if (lmonthh == 'May') {
                        lmonth = '05';
                    } else if (lmonthh == 'Jun') {
                        lmonth = '06';
                    } else if (lmonthh == 'Jul') {
                        lmonth = '07';
                    } else if (lmonthh == 'Aug') {
                        lmonth = '08';
                    } else if (lmonthh == 'Sep') {
                        lmonth = '09';
                    } else if (lmonthh == 'Oct') {
                        lmonth = '10';
                    } else if (lmonthh == 'Nov') {
                        lmonth = '11';
                    } else if (lmonthh == 'Dec') {
                        lmonth = '12';
                    }
                });
                if ((lyear != "") && (lmonth != "")) {
                    allyearmonth.push(lyear + "nqd" + lmonth);
                }
            });
            if (allyearmonth != "") {
                $.ajax({
                    type: "POST",
                    // beforeSend: function(){
                    //   $("#loading").show();
                    //   $("#wrapper").hide();
                    // },
                    url: "monthlyyearlycomsend_email",
                    data: 'allyearmonth=' + allyearmonth + '&_token={{ csrf_token() }}',
                    success: function(html) {
                        // alert(html);
                        $("#emailcampaigncountq").html(html);
                    },
                    // complete: function(){
                    //   $("#loading").hide();
                    //   $("#wrapper").show();
                    // }
                });
            } else {
                $("#emailcampaigncountq").html("");
            }
        });
    </script>

    <script type="text/javascript">
        var x = 1;
        $(document).ready(function() {
            $(".addcomprsntaby").on("click", function() {
                var yearlist = $("#yearlisty").html();
                var html =
                    '<div class="margin-top-10 commally" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;"> <div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a year to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylisty"> ' +
                    yearlist +
                    ' </ul> </div></div></div><div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a month to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylist1y"> <li class="act">Jan</li><li class="act">Feb</li><li class="act">Mar</li><li class="act">Apr</li><li class="act">May</li><li class="act">Jun</li><li class="act">Jul</li><li class="act">Aug</li><li class="act">Sep</li><li class="act">Oct</li><li class="act">Nov</li><li class="act">Dec</li></ul> </div></div></div><div class="clearfix"></div></div>';
                $(".comparisontabsy").append(html);
            });
            $(document).on("click", ".monthlylisty li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cyear");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cyear");
                $(".compare_btny").trigger("click");
            });
            $(document).on("click", ".monthlylist1y li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cmonth");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cmonth");
                $(".compare_btny").trigger("click");
            });
            $(document).on("click", "#monthlylisty li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cyear");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cyear");
                $(".compare_btny").trigger("click");
            });
            $(document).on("click", "#monthlylist1y li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cmonth");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cmonth");
                $(".compare_btny").trigger("click");
            });
        });
        $(document).on("click", ".compare_btny", function() {
            var allyearmonth = [];
            var fyear = "";
            var fmonth = "";
            fyear = $("#monthlylisty li.cyear").text();
            var fmonthh = $("#monthlylist1y li.cmonth").text();
            if (fmonthh == 'Jan') {
                fmonth = '01';
            } else if (fmonthh == 'Feb') {
                fmonth = '02';
            } else if (fmonthh == 'Mar') {
                fmonth = '03';
            } else if (fmonthh == 'Apr') {
                fmonth = '04';
            } else if (fmonthh == 'May') {
                fmonth = '05';
            } else if (fmonthh == 'Jun') {
                fmonth = '06';
            } else if (fmonthh == 'Jul') {
                fmonth = '07';
            } else if (fmonthh == 'Aug') {
                fmonth = '08';
            } else if (fmonthh == 'Sep') {
                fmonth = '09';
            } else if (fmonthh == 'Oct') {
                fmonth = '10';
            } else if (fmonthh == 'Nov') {
                fmonth = '11';
            } else if (fmonthh == 'Dec') {
                fmonth = '12';
            }
            if ((fyear != "") && (fmonth != "")) {
                allyearmonth.push(fyear + "nqd" + fmonth);
            }
            $(".commally").each(function() {
                var lyear = "";
                var lmonth = "";
                $(this).find(".monthlylisty li.cyear").each(function() {
                    lyear = $(this).text();
                });
                $(this).find(".monthlylist1y li.cmonth", this).each(function() {
                    var lmonthh = $(this).text();
                    if (lmonthh == 'Jan') {
                        lmonth = '01';
                    } else if (lmonthh == 'Feb') {
                        lmonth = '02';
                    } else if (lmonthh == 'Mar') {
                        lmonth = '03';
                    } else if (lmonthh == 'Apr') {
                        lmonth = '04';
                    } else if (lmonthh == 'May') {
                        lmonth = '05';
                    } else if (lmonthh == 'Jun') {
                        lmonth = '06';
                    } else if (lmonthh == 'Jul') {
                        lmonth = '07';
                    } else if (lmonthh == 'Aug') {
                        lmonth = '08';
                    } else if (lmonthh == 'Sep') {
                        lmonth = '09';
                    } else if (lmonthh == 'Oct') {
                        lmonth = '10';
                    } else if (lmonthh == 'Nov') {
                        lmonth = '11';
                    } else if (lmonthh == 'Dec') {
                        lmonth = '12';
                    }
                });
                if ((lyear != "") && (lmonth != "")) {
                    allyearmonth.push(lyear + "nqd" + lmonth);
                }
            });
            if (allyearmonth != "") {
                $.ajax({
                    type: "POST",
                    // beforeSend: function(){
                    //   $("#loading").show();
                    //   $("#wrapper").hide();
                    // },
                    url: "monthlyyearlycomsend_card",
                    data: 'allyearmonth=' + allyearmonth + '&_token={{ csrf_token() }}',
                    success: function(html) {
                        // alert(html);
                        $("#emailcampaigncounty").html(html);
                    },
                    // complete: function(){
                    //   $("#loading").hide();
                    //   $("#wrapper").show();
                    // }
                });
            } else {
                $("#emailcampaigncounty").html("");
            }
        });
    </script>
    <script type="text/javascript">
        var x = 1;
        $(document).ready(function() {
            $(".addcomprsntabv").on("click", function() {
                var yearlist = $("#yearlistv").html();
                var html =
                    '<div class="margin-top-10 commallv" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;"> <div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a year to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylistv"> ' +
                    yearlist +
                    ' </ul> </div></div></div><div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a month to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylist1v"> <li class="act">Jan</li><li class="act">Feb</li><li class="act">Mar</li><li class="act">Apr</li><li class="act">May</li><li class="act">Jun</li><li class="act">Jul</li><li class="act">Aug</li><li class="act">Sep</li><li class="act">Oct</li><li class="act">Nov</li><li class="act">Dec</li></ul> </div></div></div><div class="clearfix"></div></div>';
                $(".comparisontabsv").append(html);
            });
            $(document).on("click", ".monthlylistv li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cyear");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cyear");
                $(".compare_btnv").trigger("click");
            });
            $(document).on("click", ".monthlylist1v li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cmonth");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cmonth");
                $(".compare_btnv").trigger("click");
            });
            $(document).on("click", "#monthlylistv li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cyear");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cyear");
                $(".compare_btnv").trigger("click");
            });
            $(document).on("click", "#monthlylist1v li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cmonth");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cmonth");
                $(".compare_btnv").trigger("click");
            });
        });
        $(document).on("click", ".compare_btnv", function() {
            var allyearmonth = [];
            var fyear = "";
            var fmonth = "";
            fyear = $("#monthlylistv li.cyear").text();
            var fmonthh = $("#monthlylist1v li.cmonth").text();
            if (fmonthh == 'Jan') {
                fmonth = '01';
            } else if (fmonthh == 'Feb') {
                fmonth = '02';
            } else if (fmonthh == 'Mar') {
                fmonth = '03';
            } else if (fmonthh == 'Apr') {
                fmonth = '04';
            } else if (fmonthh == 'May') {
                fmonth = '05';
            } else if (fmonthh == 'Jun') {
                fmonth = '06';
            } else if (fmonthh == 'Jul') {
                fmonth = '07';
            } else if (fmonthh == 'Aug') {
                fmonth = '08';
            } else if (fmonthh == 'Sep') {
                fmonth = '09';
            } else if (fmonthh == 'Oct') {
                fmonth = '10';
            } else if (fmonthh == 'Nov') {
                fmonth = '11';
            } else if (fmonthh == 'Dec') {
                fmonth = '12';
            }
            if ((fyear != "") && (fmonth != "")) {
                allyearmonth.push(fyear + "nqd" + fmonth);
            }
            $(".commallv").each(function() {
                var lyear = "";
                var lmonth = "";
                $(this).find(".monthlylistv li.cyear").each(function() {
                    lyear = $(this).text();
                });
                $(this).find(".monthlylist1v li.cmonth", this).each(function() {
                    var lmonthh = $(this).text();
                    if (lmonthh == 'Jan') {
                        lmonth = '01';
                    } else if (lmonthh == 'Feb') {
                        lmonth = '02';
                    } else if (lmonthh == 'Mar') {
                        lmonth = '03';
                    } else if (lmonthh == 'Apr') {
                        lmonth = '04';
                    } else if (lmonthh == 'May') {
                        lmonth = '05';
                    } else if (lmonthh == 'Jun') {
                        lmonth = '06';
                    } else if (lmonthh == 'Jul') {
                        lmonth = '07';
                    } else if (lmonthh == 'Aug') {
                        lmonth = '08';
                    } else if (lmonthh == 'Sep') {
                        lmonth = '09';
                    } else if (lmonthh == 'Oct') {
                        lmonth = '10';
                    } else if (lmonthh == 'Nov') {
                        lmonth = '11';
                    } else if (lmonthh == 'Dec') {
                        lmonth = '12';
                    }
                });
                if ((lyear != "") && (lmonth != "")) {
                    allyearmonth.push(lyear + "nqd" + lmonth);
                }
            });
            if (allyearmonth != "") {
                $.ajax({
                    type: "POST",
                    // beforeSend: function(){
                    //   $("#loading").show();
                    //   $("#wrapper").hide();
                    // },
                    url: "monthlyyearlycomsend_video",
                    data: 'allyearmonth=' + allyearmonth + '&_token={{ csrf_token() }}',
                    success: function(html) {
                        // alert(html);
                        $("#emailcampaigncountv").html(html);
                    },
                    // complete: function(){
                    //   $("#loading").hide();
                    //   $("#wrapper").show();
                    // }
                });
            } else {
                $("#emailcampaigncountv").html("");
            }
        });
    </script>
    <script type="text/javascript">
        var x = 1;
        $(document).ready(function() {
            $(".addcomprsntabz").on("click", function() {
                var yearlist = $("#yearlistz").html();
                var html =
                    '<div class="margin-top-10 commallz" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;"> <div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a year to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylistz"> ' +
                    yearlist +
                    ' </ul> </div></div></div><div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a month to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylist1z"> <li class="act">Jan</li><li class="act">Feb</li><li class="act">Mar</li><li class="act">Apr</li><li class="act">May</li><li class="act">Jun</li><li class="act">Jul</li><li class="act">Aug</li><li class="act">Sep</li><li class="act">Oct</li><li class="act">Nov</li><li class="act">Dec</li></ul> </div></div></div><div class="clearfix"></div></div>';
                $(".comparisontabsz").append(html);
            });
            $(document).on("click", ".monthlylistz li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cyear");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cyear");
                $(".compare_btnz").trigger("click");
            });
            $(document).on("click", ".monthlylist1z li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cmonth");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cmonth");
                $(".compare_btnz").trigger("click");
            });
            $(document).on("click", "#monthlylistz li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cyear");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cyear");
                $(".compare_btnz").trigger("click");
            });
            $(document).on("click", "#monthlylist1z li.act", function() {
                $(this).parent("ul").children("li").css("text-decoration", "none");
                $(this).parent("ul").children("li").removeClass("cmonth");
                $(this).css("text-decoration", "underline");
                $(this).addClass("cmonth");
                $(".compare_btnz").trigger("click");
            });
        });
        $(document).on("click", ".compare_btnz", function() {
            var allyearmonth = [];
            var fyear = "";
            var fmonth = "";
            fyear = $("#monthlylistz li.cyear").text();
            var fmonthh = $("#monthlylist1z li.cmonth").text();
            if (fmonthh == 'Jan') {
                fmonth = '01';
            } else if (fmonthh == 'Feb') {
                fmonth = '02';
            } else if (fmonthh == 'Mar') {
                fmonth = '03';
            } else if (fmonthh == 'Apr') {
                fmonth = '04';
            } else if (fmonthh == 'May') {
                fmonth = '05';
            } else if (fmonthh == 'Jun') {
                fmonth = '06';
            } else if (fmonthh == 'Jul') {
                fmonth = '07';
            } else if (fmonthh == 'Aug') {
                fmonth = '08';
            } else if (fmonthh == 'Sep') {
                fmonth = '09';
            } else if (fmonthh == 'Oct') {
                fmonth = '10';
            } else if (fmonthh == 'Nov') {
                fmonth = '11';
            } else if (fmonthh == 'Dec') {
                fmonth = '12';
            }
            if ((fyear != "") && (fmonth != "")) {
                allyearmonth.push(fyear + "nqd" + fmonth);
            }
            $(".commallz").each(function() {
                var lyear = "";
                var lmonth = "";
                $(this).find(".monthlylistz li.cyear").each(function() {
                    lyear = $(this).text();
                });
                $(this).find(".monthlylist1z li.cmonth", this).each(function() {
                    var lmonthh = $(this).text();
                    if (lmonthh == 'Jan') {
                        lmonth = '01';
                    } else if (lmonthh == 'Feb') {
                        lmonth = '02';
                    } else if (lmonthh == 'Mar') {
                        lmonth = '03';
                    } else if (lmonthh == 'Apr') {
                        lmonth = '04';
                    } else if (lmonthh == 'May') {
                        lmonth = '05';
                    } else if (lmonthh == 'Jun') {
                        lmonth = '06';
                    } else if (lmonthh == 'Jul') {
                        lmonth = '07';
                    } else if (lmonthh == 'Aug') {
                        lmonth = '08';
                    } else if (lmonthh == 'Sep') {
                        lmonth = '09';
                    } else if (lmonthh == 'Oct') {
                        lmonth = '10';
                    } else if (lmonthh == 'Nov') {
                        lmonth = '11';
                    } else if (lmonthh == 'Dec') {
                        lmonth = '12';
                    }
                });
                if ((lyear != "") && (lmonth != "")) {
                    allyearmonth.push(lyear + "nqd" + lmonth);
                }
            });
            if (allyearmonth != "") {
                $.ajax({
                    type: "POST",
                    // beforeSend: function(){
                    //   $("#loading").show();
                    //   $("#wrapper").hide();
                    // },
                    url: "monthlyyearlycomsend_sms",
                    data: 'allyearmonth=' + allyearmonth + '&_token={{ csrf_token() }}',
                    success: function(html) {
                        // alert(html);
                        $("#emailcampaigncountz").html(html);
                    },
                    // complete: function(){
                    //   $("#loading").hide();
                    //   $("#wrapper").show();
                    // }
                });
            } else {
                $("#emailcampaigncountz").html("");
            }
        });
    </script>
@endsection
