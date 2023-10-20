@extends('layouts.main')
@section("content")
<style>
    .active1 {
        background: purple !important;
    }
    .regsection{
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: white;
                box-shadow: 0px 60px 100px -10px rgba(35, 47, 70, 0.06); border-radius: 10px; padding: 10px; padding-left: 15px; padding-right: 15px; display: flex; flex-direction: column; align-items: center; justify-content: center;
            }
    .profile_info{
        display: flex;
        flex-direction: column;
    }
    .two_inps{
        width: 35rem;
        
    }
    .two_inps div{
        margin-right: 1.5rem;
        width: 15rem;
    }
    /* .plan_card{
        margin-top: 5px;
        margin-bottom: 5px;
    } */
    .active_plan{
         background-color: #D8291C;
         color: white;
    }
    .active_plan span{
         color: white;
    }
    .plan_card{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
    .selectedplan{
        cursor: pointer;
    }
    .border-none{
        border: 0px!important;
    }
</style>
<section class="border-none">
    <div class="container">
        <div class="row">
            <!-- tabs -->
            @if(Auth::id() != "")
            @if(Auth::user()->role != "client" )

            <div class="col-md-3 col-sm-3">
                @if(Auth::user()->role != "affiliate_user")
                <ul class="nav nav-tabs nav-stacked nav-alternate">


                    @if(request()->has('year'))

                    @if(Auth::user()->level !='')
                    <li class="">
                        <a href="{{ url('back-office') }}">
                            Back Office
                        </a>
                    </li>
                    @else

                    <li class="">
                        <a href="javascript:void(0)">
                            Back Office
                        </a>
                    </li>

                    @endif


                    <li class="active">
                        <a href="#tab_t" data-toggle="tab" aria-expanded="true">
                            Transactions
                        </a>
                    </li>
                    @else

                    @if(Auth::user()->level !='')
                    <li class="active">
                        <a href="{{ url('back-office') }}">
                            Back Office
                        </a>
                    </li>
                    @else

                    <li class="active">
                        <a href="javascript:void(0)">
                            Back Office
                        </a>
                    </li>

                    @endif

                    <li>
                        <a href="#tab_t" data-toggle="tab">
                            Transactions
                        </a>
                    </li>

                    @endif

                    <li>
                        <a href="{{ url('change_password_front') }}">
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('user_access_rights') }}">
                            User Access
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('blog') }}">
                            Blog
                        </a>
                    </li>
                    <?php if (Auth::id() != "") { ?>
                        <?php if ((Auth::user()->role == "affiliate")) { ?>
                            <li>
                                <a href="{{ url('front_dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                    <?php }
                    } ?>
                </ul>
                @endif
            </div>
            @endif
            @else
            @endif

            <!-- tabs content -->
            <!-- @if(Auth::id() != "")
                    @if(Auth::user()->role != "client")
                        <div class="col-md-9 col-sm-9">

                    @else
                        <div class="col-md-12 col-sm-12">

                    @endif
                @else
                    <div class="col-md-12 col-sm-12">

                @endif -->
            <div class="col-md-{{ (Auth::id() != "")?9:12 }} col-sm-{{ (Auth::id() != "")?9:12 }}">

                <div class="tab-content tab-stacked nav-alternate">


                    <div id="tab_g" class="tab-pane">



                        @if(Auth::check())
                        @if(Auth::user()->role != "client")
                        <div class="col-md-12 col-sm-12 padding-0" style="margin-bottom: 20px;">
                            <div class="row">
                                <!--<div class="col-md-4">
                                            <div class="outer-divv" >
                                                <div class="">
                                                    <a href="#">
                                                        <img src="{{ asset('public/images/maxresdefault.jpg') }}" style="width:100%;height:180px;" alt="">
                                                    </a>
                                                </div>
                                                <h5 class="box-heading">Text <span style="float:right;">5 Star</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="outer-divv" >
                                                <div class="">
                                                    <a href="#">
                                                        <img src="{{ asset('public/images/maxresdefault.jpg') }}" style="width:100%;height:180px;" alt="">
                                                    </a>
                                                </div>
                                                <h5 class="box-heading">Text <span style="float:right;">5 Star</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="outer-divv" >
                                                <div class="">
                                                    <a href="#">
                                                        <img src="{{ asset('public/images/maxresdefault.jpg') }}" style="width:100%;height:180px;" alt="">
                                                    </a>
                                                </div>
                                                <h5 class="box-heading">Text <span style="float:right;">5 Star</span></h5>
                                            </div>
                                        </div>-->
                                <div class="col-md-12">
                                    <div class="owl-carousel text-center owl-testimonial nomargin" data-plugin-options='{"items":4, "singleItem": false, "autoPlay": 4000, "navigation": false, "pagination": false, "transitionStyle":"fade"}'>
                                        <?php
                                        foreach ($recent_achievers as $slide) {
                                            $img = \App\User::get_user_profile_pic($slide->email);
                                        ?>
                                            <div class="testimonial">
                                                <div class="col-md-12 testimonial-bordered">
                                                    <figure>
                                                        <img class="rounded" src="<?= $img; ?>" alt="" style="width: 60px !important;height:60px !important" />
                                                    </figure>
                                                    <div class="testimonial-content nopadding">

                                                        <cite>
                                                            <?= $slide->username ?>
                                                            <span class="text-success">New Member</span>{{-- <span><b>$</b><= $slide->amount ></span> --}}
                                                        </cite>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        <style>
                            .mainbox {
                                display: flex;
                                flex-direction: row;
                                align-items: start;
                                justify-content: space-between;

                            }

                            .maincolumn {
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: space-between;

                            }
                          
                        </style>


</div>
<!-- main for row -->
<main class="mainbox">
    <section class="maincolumn" style="border-bottom: 0px!important">
        <div class="row" style="width: 50vw">
            <div class="owl-carousel text-center owl-testimonial nomargin" data-plugin-options='{"items":1, "singleItem": true, "autoPlay": <?= $slidetime2[0]->playtime ?>, "navigation": false, "pagination": false, "transitionStyle":"fade"}'>
                <?php
                foreach ($text_banners as $banner) {
                ?>
                <?php #echo $banner ?> 
                    <div class="col-md-12 col-sm-12 margin-bottom-40">
                        @if(!empty($banner->link))
                        <a href="{{ $banner->link }}" target="_blank">
                            <img src="<?php echo asset("public/images") ?>/<?= $banner->image ?? 'neuron.jpg' ?>" alt="" style="height: 400px;width: 100%" />
                        </a>
                        @else
                        <img src="<?php echo asset("public/images") ?>/<?= $banner->image ?? 'neuron.jpg' ?>" alt="" style="height: 400px;width: 100%" />
                        @endif
                        <h4 class="text-center"><a href=""><?= $banner->text ?></a></h4>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row" style="width: 50vw">
            <div class="owl-carousel text-center owl-testimonial nomargin" data-plugin-options='{"items":1, "singleItem": true, "autoPlay": <?= $slidetime2[0]->playtime ?>, "navigation": false, "pagination": false, "transitionStyle":"fade"}'>
                <?php
                foreach ($home_videos as $video) {
                ?>
                    <div class="col-md-12 col-sm-12 margin-bottom-40">
                        <div class="embed-responsive embed-responsive-16by9">
                            <!-- <iframe class="embed-responsive-item" src="<?php //echo asset("public/videos") 
                                                                            ?>/<?= $video->video ?>" width="800" height="450"></iframe> -->
                            <video width="50%" height="400" controls autoplay muted>
                                <source src="<?php echo asset("public/videos") ?>/<?= $video->video ?>" type="video/mp4">
                            </video>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- registration form -->
    @if(!Auth::user())
    <div class="regsection">
                               <div>
                                   <form name="business_register" id="manageBRegister" method="POST"  enctype="multipart/form-data">
                                    @csrf
                                       
    
    <!-- display: flex; align-items: center; justify-content: center; flex-wrap: wrap; padding-bottom:20px; -->
                                       <div class="profile_info">
                                           <div class="col-md-12 text-center heading-title margin-top-20">
                                               <h4 style="color: black; background-color: white;">Profile Information</h4>
                                           </div>
                                           <?php $today = date('Y-m-d') ?>
                                           <input type="hidden" name="joining_date" value="<?= $today ?>">

                                           <!-- <div class="col-md-6">
                                           <div class="form-group">
                                               <label class="form-label">Joining Date</label>
                                               <input type="text" class="form-control date-picker"  placeholder="Joining Date" name="joining_date" autocomplete="off" required>
                                           </div>
                                       </div> -->

                                       <!-- send user's role -->
                                       <input type="hidden" name="role" value="free_affiliate"/>
    
    
    
    
    
    
    
                                           <div style="width: 35rem" class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label" for="">Country Of Birth</label>
                                                   <select id="birth_countries_states1" class="form-control bfh-countries" name="birth_country" required></select>
                                                   <span class="text-danger birth_country_message" style="display:none">Before going to the next step select Country of birth first</span>
                                               </div>
                                           </div>
    
                                           <div style="width: 35rem; display:none" class="col-md-4 birth_comm" style="display:none">
                                               <input type="hidden" name="birth_state" value="OU" />
                                               <div class="form-group">
                                                   <label class="form-label" for="">State/Province/Commune</label>
                                                   <select id="birth_commune" onchange="onBirthCommuneChange()" class="form-control bfh-commune" name="birth_commune" required>
                                                       <option value=""></option>
                                                       @foreach($communes as $commune)
                                                       <option value="{{ $commune->id }}">{{ $commune->commune }}</option>
                                                       @endforeach
                                                   </select>
                                                   <span class="text-danger birth_commune_message" style="display:none">Before going to the next field select Commune first</span>
                                               </div>
                                           </div>
    
                                           <div style="width: 35rem; display:none" class="col-md-4 birth_state" >
                                               <div class="form-group">
                                                   <label class="form-label" for="">State/Province/Commune</label>
                                                   <select id="birth_state" class="form-control bfh-states birth-state-focus" data-country="birth_countries_states1" name="birth_state" ></select>
                                                   <span class="text-danger birth_state_message" style="display:none">Before going to the next field select State/Province first</span>
                                               </div>
                                           </div>
    
    
    
    
    
    
    
    
    
    
                                       <div class="two_inps">
                                       <div  class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label">First Name</label>
                                                   <input type="text" class="form-control" placeholder="Profile First Name" name="first_name" required value="{{old('first_name')}}" required>
                                               </div>
                                           </div>
                                           <div  class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label">Last Name</label>
                                                   <input type="text" class="form-control" placeholder="Profile Last Name" name="last_name" value="{{old('last_name')}}" required>
                                               </div>
                                           </div>
                                       </div>
    
                                           <!---->
                                           <div style="width: 35rem;" class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label" for="">Cell Phone</label>
                                                   <input style="width: 32rem;" class="form-control" placeholder="" onchange="getPhoneNo()" id="cellphone" name="format-cellphone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="tel" maxlength="10" value="{{old('cellphone')}}" required>
                                                   <span class="text-danger" id="cellPhoneToast" style="display:none">Please enter correct number</span>
                                                   <input type="hidden" name="cellphone" id="cellphone-inp" />
                                               </div>
                                           </div>
                                           <div style="width: 35rem;" class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label" for="">Business Telephone</label>
                                                   <input style="width: 32rem;" type="tel" class="form-control" placeholder="" id="business_telephone" name="business_telephone_inp" onchange="getBusinessPhoneNo()" value="{{old('business_telephone')}}" required>
                                                   <span class="text-danger" id="businessPhoneToast" style="display:none">Please enter correct number</span>
                                                   <input type="hidden" name="business_telephone" id="business_telephone_inp" />
                                               </div>
                                           </div>
    
                                           <!---->
    
                                           <div style="width: 35rem" class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label" for="">Religious Faith/ Spirituality</label>
                                                   <select class="form-control" name="religion" id="otherreligion">
                                                       <?php
                                                       foreach ($religion as $value) {
                                                       ?>
                                                           <option value="<?= $value->religion ?>"><?= $value->religion ?></option>
                                                       <?php
                                                       }
                                                       ?>
                                                   </select>
                                               </div>
                                           </div>
    
                                           <div style="width: 35rem; display:none" class="col-md-4" id="relother" >
                                               <div class="form-group">
                                                   <label class="form-label" for="">Religious Faith/ Spirituality</label>
                                                   <input type="text" class="form-control" name="religionother" id="religionother" placeholder="Enter your Religion">
                                               </div>
                                           </div>
                                           <div style="width: 35rem" class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label">Email</label>
                                                   <input type="text" class="form-control" placeholder="Profile Email" name="email" id="affiliateemail" required value="{{old('email')}}">
                                                   <span style="color: red" id="emailexitstance"></span>
                                               </div>
                                           </div>
    
    
                                           <div style="width: 35rem" class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label">Date Of Birth</label>
    
                                                   <input type="hidden" name="dob" class="form-control" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" id="sendon" value="{{old('dob')}}">
                                                   <select id="dob_day" name="day" class="bg-white width-100" required>
                                                       <option value="0">Day</option>
                                                       @for($i=01; $i<=31; $i++) <option value="{{$i}}">{{$i}}</option>
                                                           @endfor
                                                   </select>
    
                                                   <select id="dob_month" name="month" class="bg-white width-100" required>
                                                       <option value="0">Month</option>
                                                       <option value="01">Jan</option>
                                                       <option value="02">Feb</option>
                                                       <option value="03">Mar</option>
                                                       <option value="04">Apr</option>
                                                       <option value="05">May</option>
                                                       <option value="06">Jun</option>
                                                       <option value="07">Jul</option>
                                                       <option value="08">Aug</option>
                                                       <option value="09">Sep</option>
                                                       <option value="10">Oct</option>
                                                       <option value="11">Nov</option>
                                                       <option value="12">Dec</option>
                                                   </select>
    
                                                   @php
                                                   $year_start = 1940;
                                                   $year_end = date('Y') - 19; // current Year
                                                   @endphp
    
                                                   <select id="dob_year" name="year" class="bg-white width-100" required>
                                                       <option value="0">Year</option>
                                                       @for($i=$year_start; $i<=$year_end; $i++) <option value="{{$i}}">{{$i}}</option>
                                                           @endfor
                                                   </select>
    
    
                                               </div>
                                           </div>
    
    
    
    
                                           <div style="width: 35rem" class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label" for="">Country Of Residence</label>
                                                   <select id="countries_states1" class="form-control bfh-countries" name="country" required></select>
                                                   <span class="text-danger country_message" style="display:none">Before going to the next step select Country of residence first</span>
                                               </div>
                                           </div>
    
                                           <div style="width: 35rem; display:none" class="col-md-4 select_state" >
                                               <div class="form-group">
                                                   <label class="form-label" for="">State/Province/Commune</label>
                                                   <select id="state" class="form-control bfh-states state-focus" data-country="countries_states1" name="state" value="OU"></select>
                                                   <span class="text-danger state_message" style="display:none">Before going to the next field select State/Province first</span>
                                               </div>
                                           </div>
    
                                           <div style="width: 35rem; display:none" class="col-md-4 comm" >
                                               <input type="hidden" name="state" value="OU" />
                                               <div class="form-group">
                                                   <label class="form-label" for="">State/Province/Commune</label>
                                                   <select onchange="onCommuneChange()" id="commune" class="form-control bfh-commune" name="commune" required>
                                                       <option value=""></option>
                                                       @foreach($communes as $commune)
                                                       <option value="{{ $commune->id }}">{{ $commune->commune }}</option>
                                                       @endforeach
                                                   </select>
                                                   <span class="text-danger commune_message" style="display:none">Before going to the next field select Commune first</span>
                                               </div>
                                           </div>
    
                                           <div style="width: 35rem; display:none" class="col-md-4 zip_code" >
                                               <div class="form-group">
                                                   <label class="form-label" for="">Zip Code</label>
                                                   <input class="form-control" placeholder="" name="zip_code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" value="{{old('zip_code')}}" required>
                                               </div>
                                           </div>
                                         
                                           <div class="two_inps">
                                           <div  class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label" for="">Street Address</label>
                                                   <input type="text" class="form-control" placeholder="" name="address" value="{{old('address')}}" required>
                                               </div>
                                           </div>
                                           <div  class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label" for=""> City </label>
                                                   <input type="text" class="form-control" placeholder="" name="city" value="{{old('city')}}" required>
                                               </div>
                                           </div>
                                           </div>
    
                                           <div style="width: 35rem" class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label" for="">Choose a Business Category</label>
                                                   <select class="form-control form-select select2-hidden-accessible" data-search="on" id="businesscat" tabindex="-1" aria-hidden="true" data-select2-id="1" name="business_category" required>
                                                       <?php
                                                       foreach ($business_category as $value) {
                                                       ?>
                                                           <option value="<?= $value->id ?>"><?= $value->category ?></option>
                                                       <?php
                                                       }
                                                       ?>
    
                                                   </select>
                                               </div>
                                           </div>
                                        
                                           <div style="width: 35rem" class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label" for=""> Profession/Study</label>
                                                   <select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="lead_category" required>
    
                                                       @foreach($lead_cats as $value)
    
                                                       <option value="{{ $value->id }}">{{$value->category}} </option>
                                                       @endforeach
    
                                                   </select>
                                               </div>
                                           </div>
    
                                           <div style="width: 35rem; display:none" class="col-md-4" id="otherbusiness" >
                                               <div class="form-group">
                                                   <label class="form-label" for="">Other Business</label>
                                                   <input type="text" id="businessother" name="businessother" class="form-control" placeholder="Enter your other business">
                                               </div>
                                           </div>
    
    
    
                                           <div style="width: 35rem" class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label" for="">Upload Picture</label>
                                                   <div class="fancy-file-upload fancy-file-info">
                                                       <i class="fa fa-upload"></i>
                                                       <input type="file" class="form-control" name="image" onchange="jQuery(this).next('input').val(this.value);" />
                                                       <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                                                       <span class="button">Choose File</span>
                                                   </div>
                                               </div>
                                           </div>
    
                                          <div class="two_inps">
                                          <div  class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label">Password</label>
                                                   <input type="password" class="form-control" placeholder="Password" id="mypass" name="password" autocomplete="off" value="{{old('password')}}" required>
                                               </div>
                                               @if ($errors->has('password'))
                                               <span class="help-block text-danger">
                                                   <strong>{{ $errors->first('password') }}</strong>
                                               </span>
                                               @endif
                                           </div>
                                           <div  class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label">Confirm Password</label>
                                                   <input type="password" class="form-control" placeholder="Confirm assword" name="confirm_password" id="confirm_password" autocomplete="off" required>
                                               </div>
                                               <span class="cpass"></span>
                                               @if ($errors->has('confirm_password'))
                                               <span class="help-block text-danger">
                                                   <strong>{{ $errors->first('confirm_password') }}</strong>
                                               </span>
                                               @endif
                                           </div>
                                          </div>

                                           <div style="width: 35rem" class="col-md-4">
                                               <div class="form-group">
                                                   <label class="form-label">Company Name</label>
                                                   <input type="text" class="form-control" placeholder="Company Name" name="company" autocomplete="off" required>
                                               </div>
                                           </div>
                                           <div style="width: 35rem" class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Select Plan</label>
                                                @if(!empty($plans))
                                                @php
                                                $i=1;
    
                                                @endphp
                                                @foreach($plans as $plan)
                                                   <!-- <div class="plan_card"> -->
                                                   <label class="form-control selectedplan" data-id="{{ $plan->id }}" data-fees="{{ $plan->monthly_fee }}" onclick="checkValue()">
                                                   <!-- <input type="radio" name="selectedplan" > -->
                                                   <p class="plan_card">    
                                                       {{$plan->name}} 
                                                       
                                                       <span>
                                                       {{$plan->monthly_fee}}/per month
                                                       </span>
                                                   </p>
                                                   </label>
                                                   <!-- </div> -->
                                                   @php
                                                   $i++;
                                                   @endphp
                                                   @endforeach
                                                   @endif
                                                </div>
                                                <input type="hidden" id="plan_id" name="plan_id" value="">
                                                <input type="hidden" id="fees" name="fees" value="">
                                           </div>
                                           <script>
                                            function checkValue() {
                                                console.log(document.getElementById('plan_id'));
                                                console.log(document.getElementsByClassName('active_plan'));
                                            }
                                           </script>
                                       </div>
                                       <!--<div class="clearfix"></div>	-->
                                       <!--<div class="divider"><!-- divider -->
                               </div>
                               <!-- <div class="row gy-4" style="padding-bottom:20px;">
                                       
                                       <div class="col-md-12 text-center" style="margin-top:20px;">
                                           <h6>Billing Information</h6>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <label class="form-label" for="">Street Address</label>
                                               <input type="text" class="form-control"  placeholder="" name="billing_address" value="{{old('billing_address')}}" required>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <label class="form-label" for="">Zip Code</label>
                                               <input class="form-control"  placeholder="" id="billing_zip_code" name="billing_zip_code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "6" required value="{{old('billing_zip_code')}}">
                                           </div>
                                       </div>
                                       <div class="col-md-4">
                                           <div class="form-group">
                                               <label class="form-label" for=""> City </label>
                                               <input type="text" class="form-control"  placeholder="" name="billing_city" required value="{{old('billing_city')}}">
                                           </div>
                                       </div>
                                       <div class="col-md-4">
                                           <div class="form-group">
                                               <label class="form-label" for="">Country</label>
                                               <select id="countries_states2" class="form-control bfh-countries" name="billing_country" required ></select>
                                           </div>
                                       </div>
                                       <div class="col-md-4">
                                           <div class="form-group">
                                               <label class="form-label" for="">State/Province</label>
                                               <select class="form-control bfh-states" data-country="countries_states2" name="billing_state" required></select>
                                           </div>
                                       </div>
                                       
                                          
                                   </div> -->
    
                               <div class="col-md-12" style="margin-top:20px; ">
                                   <h4>
                                       <label class="checkbox chk-sm" style="color: #da291c;">
                                           <input type="checkbox" name="terms" value="1" required="" />
                                           <i></i> Agree <a href="javascript:void(0)" data-toggle="modal" data-target="#termData">terms and conditions</a>
                                       </label>
                                   </h4>
                               </div>
    
                               <div class="col-md-12" style="margin-top:40px; text-align:center;">
                                   <input type="button" data-action="{{ url('free_affiliate_entry') }}" class="btn btn-lg btn-primary btn_submit" value="Register">
                               </div>
                               </form>
                               </div>
                           </div>
    <!--  -->
    @endif
</main>
<!--  -->

<div id="tab_t" class="tab-pane {{ request()->has('year') ? 'active' : '' }}">

    <h4>Transactions</h4>

    <div class="row">
        @if(!empty($transaction_section_one))
        <div class="col-sm-6 first-column ">
            <div class="regsection">
                {!! $transaction_section_one->description !!}
            </div>
        </div>
        @endif
        @if(!empty($transaction_section_two))
        <div class="col-sm-6 second-column">
            <div class="regsection">
                {!! $transaction_section_two->description !!}
        
            </div> 
        </div> 
        @endif
    </div>

    <div class="year-filter-wraper">
        <a href="/?year=2023#tab_t" class="{{ (Request::get('year') == '2023' ) ? 'active1' : '' }} btn btn-md btn-info margin-right-10">2023</a>
        <a href="/?year=2022#tab_t" class="{{ (Request::get('year') == '2022' ) ? 'active1' : '' }} btn btn-md btn-info margin-right-10">2022</a>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <?php
                $months_arr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

                ?>
                @foreach ($months_arr as $valuee)
                {{-- <th id="month_record" data-id="{{ $valuee }}" @if($cmonth == $valuee) class="active1" @endif>{{ date("M", mktime(0, 0, 0, $valuee, 10)) }}</th> --}}
                <th id="month_record" class="tab1">{{ date("M", mktime(0, 0, 0, $valuee, 10)) }}</th>
                @endforeach


            </tr>
        </thead>
    </table>
    <table class="table table-striped table-bordered table-hover my_tbl" id="datatable_sample">
        <thead>
            @if(Auth::check())
            <tr>
                <th style="width: 2% !important">LVL</th>
                <th style="width: 5% !important">Amount</th>
                <th>Description</th>
                <th>Name</th>
                <th>Country</th>
                <th style="width: 15% !important">State/Province <br> Commune/Region</th>
                <th style="width: 14% !important">Date</th>
                <th>Time</th>
            </tr>
            @endif

        </thead>
        <tbody class="tabb">
            @if(Auth::check())

            @php
            $i=1;
            $tootal = 0;
            // dd($transactions);
            //print_r( $transactions );
            
            @endphp
            @if(count($transactions) > 0 )
            @foreach($transactions as $trans)
            @php
            $class_les='';
            if(($trans['description'] != "Plan subscribed") &&  ($trans['description'] != "Plan Renew") && (str_contains($trans['description'], 'Commission value reached over') !=1) ){
                $class='ammt';
            }else{
            if((str_contains($trans['description'], 'Commission value reached over') ==1)){
            $class_les='class_les';
            }
            $class='ammt_hwe';
            }
            @endphp
            <tr>
                <td style="width: 2% !important">{{$trans['code']??""}}</td>
                <td class="{{$class}} {{$class_les}}" style="width: 5% !important"><b>$</b>{{$trans['amount']}}</td>
                <td>
                    @if ($trans['description'] == "Level commission income received for joining in network")
                    Downline Earning
                    @endif

                    @if ($trans['description'] == "Affiliate level commission received")
                    Direct Earning
                    @endif

                    @if ($trans['description'] != "Level commission income received for joining in network" && $trans['description'] != "Affiliate level commission received")
                    {!!$trans['description']!!}
                    @endif




                </td>
                <td>{{$trans['first_name'] ?? ""}} {{$trans['last_name'] ?? ""}}</td>
                <td>{{$trans['country'] ?? ""}}</td>
                <td style="width: 15% !important">{{$trans['state'] ?? ""}} {{$trans['city'] ?? ""}} {{$trans['commune'] ?? ""}}</td>
                <td style="width: 14% !important">{{($trans['created_at'])->format('d M Y')}}</td>
                <td>{{($trans['created_at'])->format('h:i A')}}</td>
            </tr>

            @php
            if(($trans['description'] != "Plan subscribed") &&  ($trans['description'] != "Plan Renew") && (str_contains($trans['description'], 'Commission value reached over') !=1) ){

            $tootal += $trans['amount'];
            }else{
            if((str_contains($trans['description'], 'Commission value reached over') ==1)){
            $tootal -= $trans['amount'];
            }
            }
            @endphp
            @endforeach
        <tfoot style="background: purple !IMPORTANT">
            <td style="color: white !important; font-weight:600 !important">Total</td>
            <td id="totaly" style="color: white !important; font-weight:600 !important">${{$tootal}}</td>
            <td style="color: white !important; font-weight:600 !important">0</td>
            <td style="color: white !important; font-weight:600 !important">0</td>
            <td style="color: white !important; font-weight:600 !important">0</td>
            <td style="color: white !important; font-weight:600 !important">0</td>
            <td style="color: white !important; font-weight:600 !important">0</td>
            <td style="color: white !important; font-weight:600 !important">0</td>
        </tfoot>
        @endif
        @else
        <tr>
            <td colspan=""></td>
            <td colspan=""></td>
            <td colspan=""></td>
            <td colspan=""></td>
        </tr>
        @endif
        </tbody>
    </table>
</div>
<div id="tab_h" class="tab-pane">
    <h4>Change Password</h4>
    <p></p>
</div>

<div id="tab_i" class="tab-pane">
    <h4>User Access</h4>
    <p></p>
</div>
</div>
</div>
</div>
</div>
</section>
<div id="plan_expired_popup" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <!-- Modal Header -->
            <div class="modal-header">
               <button type="button" class="close  plan_expired_popup_close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Welcome to Mafama.</h4>
                 <div class="modal-body ">
                     <h4 style="border-bottom: 1px solid #f6cbc9;">
                                {{$plan_expire_message}}
                            </h4>
                     </div>
            </div>
        </div>
    </div>
</div>
<div id="ex1" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <!-- Modal Header -->
            <div class="modal-header">
                <a href="{{ url('birthplace') }}">
                    <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                </a>
                <h4 class="modal-title" id="myModalLabel">Welcome to Mafama.</h4>
            </div>
            <form id="form-id" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <!-- Modal Body -->
                <div class="modal-body ">
                    <?php if ($abanner != "") { ?>
                        <div class="col-md-12">
                            <div style="padding: 0 10px">{!! $abanner->preview !!}</div>
                        </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <?php
                        if ((Auth::id() != "") && (Auth::user()->role == "affiliate")) {
                        ?>
                            <ul style="list-style: none; padding: 0; margin-bottom: 0px">
                                <?php
                                foreach ($details as $value) {
                                ?>
                                    <li class="affiliate_popup1" style="padding: 10px; float: left; margin-bottom: 10px;" id="po<?= $value->id ?>">{!! $value->preview !!}</li>
                                <?php
                                }
                                ?>
                            </ul>
                        <?php } ?>
                        <p style="color: red; margin-bottom: 10px" id="newslettererror"></p>
                        <input type="hidden" name="popup1" id="popup1">
                    </div>
                    @if($popup_setting != "")
                    @if($popup_setting->email_status == '1')
                    @php $mailstatus = ""; @endphp
                    @if($popup_mail != "")
                    @php
                    $new_time = date("Y-m-d H:i:s", strtotime('+'.$popup_setting->time_difference.' hours', strtotime($popup_mail->created_at)));
                    $now = date('Y-m-d H:i:s');
                    if($now >= $new_time){
                    $mailstatus = "on";
                    }
                    @endphp
                    @else
                    @php $mailstatus = "on"; @endphp
                    @endif
                    @if($mailstatus != "")
                    <?php if ($folders != "") { ?>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <label><b>Folders</b></label>
                            <ul class="folderul">
                                <?php
                                foreach ($folders as $value) {
                                ?>
                                    <li>
                                        <label class="checkbox chk-sm">
                                            <input type="checkbox" value="<?= $value->id ?>" class="folder_check" <?php if (($value->uid == "default")) { ?> checked <?php } ?> />
                                            <i></i> <?= $value->folder_name ?>
                                        </label>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div style="display: none;">
                            <h4 style="border-bottom: 1px solid #f6cbc9;">
                                <label class="checkbox chk-sm" style="color: #da291c;">
                                    <input type="checkbox" value="1" id="contactall" />
                                    <i></i> Select All
                                </label>
                            </h4>
                            <div id="contact_sec">

                            </div>
                            <input type="hidden" name="" value="" id="contactid">
                        </div>
                    <?php } ?>
                    <!-- <div class="col-md-12">
                                    <input type="hidden" class="form-control" placeholder="To" id="malto" name="malto" />
                                    <div class="email-id-row">
                                        <span class="to-input">To</span>
                                        <div class="all-mail"></div>
                                        <input type="text" name="email" class="enter-mail-id" placeholder="Enter the email id .." />
                                    </div>
                                    <p style="color: red; margin-bottom: 0px" id="emailer"></p>
                                </div> -->
                    <div class="col-md-12 margin-top-20">
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="To" id="malto" name="malto" />
                            <div class="email-id-row">
                                <span class="to-input">To</span>
                                <div class="all-mail"></div>
                                <input type="text" name="email" class="enter-mail-id" placeholder="Enter the email id .." />
                            </div>
                        </div>
                        <p style="color: red; margin-bottom: 0px" id="emailer"></p>
                    </div>
                    <div class="col-md-12 margin-top-20">
                        <input type="text" name="subject" class="form-control" placeholder="Subject" id="subject">
                    </div>
                    <div class="col-md-12 text-center margin-top-20">
                        <a class="btn btn-info subbtn">Send Now</a>
                        <!-- <a class="btn btn-info dateonsub">Send On</a> -->
                        <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Close</button> -->
                    </div>
                    <!-- <div class="col-md-12 dateon" style="margin-top: 10px; display: none;">
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-6" style="padding: 0 10px; ">
                                                <input type="date" class="form-control" name="sendon" id="sendon">
                                                <p style="color: red" id="send_on_alert"></p>
                                            </div>
                                            <div class="col-md-2" style="padding: 0; ">
                                                <a class="btn btn-xs btn-info subbtn" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send On</a>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                    </div> -->
                    <div class="col-md-12 text-center" style="padding: 15px">
                        <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card"></span>
                    </div>
                    <input type="submit" id="submit_button" value="" style="display: none">
                    @endif
                    @endif
                    @endif
                    <div class="clearfix"></div>
                </div>

                <!-- Modal Footer -->
            </form>
        </div>
    </div>
</div>
<div id="ex2" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <a href="{{ url('front_dashboard') }}">
                    <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                </a>
                <h4 class="modal-title" id="myModalLabel">Todays's Schedule</h4>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="col-md-12">
                        <div style="padding: 5px; border: 1px solid #da291c; border-radius: 4px; margin-bottom: 20px">
                            <h5>Birthdays</h5>
                            <?php
                            if (count($birthdays) > 0) {
                            ?>
                                <?php
                                foreach ($birthdays as $value) {
                                ?>
                                    <p><?= $value->first_name ?> <?= $value->last_name ?>'s birthday is here.</p>
                                <?php
                                }
                            } else {
                                ?>
                                <p>NO Result Found</p>
                            <?php } ?>
                        </div>
                    </div>

                    <?php
                    foreach ($meeting_task as $value) {
                    ?>
                        <div class="col-md-12">
                            <div style="padding: 5px; border: 1px solid #da291c; border-radius: 4px; margin-bottom: 20px">
                                <h5><?= $value->title ?></h5>
                                <p><?= $value->description ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="javascript:void();" class="btn btn-md btn-info margin-right-10 popupmodall" data-toggle="modal" data-target="#ex1" style="display: none;"></a>
@if($current_plan_total_day > 29)
<a href="javascript:void()" class="btn btn-md btn-info margin-right-10 plan_expired_popup" data-toggle="modal" data-target="#plan_expired_popup" style="display: none;"></a>
@endif;
<script type="text/javascript">
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
        $('#reminderdate').attr('min', maxDate);
        $('#sendon').attr('min', maxDate);
    });
</script>
<!-- / -->
<?php
$popup = Session::get('popup');


if ($popup == 1) {
    // if (isset($_SESSION['popup'])) {
?>
    <script>
        $(document).ready(function() {
            // alert("hi");
            setTimeout(function() {
                $(".popupmodall").trigger('click');
                 
                $('.folder_check').trigger('change');
                folder_check_doc();
            }, 1000);
            
            // $( ".popupmodall" ).click();
            // $(".enter-mail-id").keydown(function (e) {
            //     if (e.keyCode == 13 || e.keyCode == 32) {
            //         var getValue = $(this).val();
            //         $('.all-mail').append('<span class="email-ids"><span class="ema">'+ getValue +'</span><span class="cancel-email">x</span></span>');
            //         var mail_arr = [];
            //         $(".email-ids .ema").each(function() {
            //             mail_arr.push($(this).html());
            //         });
            //         // alert(mail_arr);
            //         $('#malto').val(mail_arr);
            //         $(this).val('');
            //         $("#emailer").html("");
            //     }
            // });
            // $(document).on('click','.cancel-email',function(){
            //     $(this).parent().remove();
            //     var mail_arr = [];
            //     $(".email-ids .ema").each(function() {
            //         mail_arr.push($(this).html());
            //     });
            //     $('#malto').val(mail_arr);
            // });
            $(document).on('click', ".affiliate_popup1", function() {
                $("#popup1").val($(this).attr("id"));
                $(this).css("border", "3px solid #da291c");
                $("#newslettererror").hide();
                $("#newslettererror").html("");
            });
            $(".dateonsub").click(function() {
                $(".dateon").show();
                $(".reminderon").hide();
            });
            $(".subbtn").click(function() {
                var submit_value = $(this).text();
                // alert(submit_value);
                $("#submit_button").val(submit_value);
                $("#submit_button").trigger('click');
            });
            $("#form-id").submit(function(e) {
                //---------------^---------------
                e.preventDefault();
                if ($("#malto").val() == "") {
                    $("#emailer").html("Please enter atleast one email id !!");

                } else if ($("#popup1").val() == "") {
                    $("#newslettererror").html("Please select one newsletter !!");
                } else {

                    $("#emailer").html("");
                    var pop = $("#popup1").val();
                    var message = $("#" + pop).html();
                    var submit_value = $("#submit_button").val();
                    var formData = new FormData(this);
                    formData.append("message", message);
                    if (submit_value == "Send Now") {
                        $.ajax({
                            type: "POST",
                            beforeSend: function() {
                                $("#loading").show();
                                $("#wrapper").hide();
                            },
                            url: "popup_mail",
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(html) {
                                // alert(html);
                                $("#success_card").html(html);
                                $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('#malto').val("");
                                $('#subject').val("");
                                $(".email-ids").remove("");
                            },
                            complete: function() {
                                $("#loading").hide();
                                $("#wrapper").show();
                            }
                        });
                    } else if (submit_value == "Send On") {
                        if ($("#sendon").val() == "") {
                            $("#send_on_alert").html("Date is required!");
                        } else {
                            $.ajax({
                                type: "POST",
                                beforeSend: function() {
                                    $("#loading").show();
                                    $("#wrapper").hide();
                                },
                                url: "popup_mail_date",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(html) {
                                    // alert(html);
                                    $("#success_card").html(html);
                                    $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                                    $('#malto').val("");
                                    $('#subject').val("");
                                    $(".email-ids").remove("");
                                    $("#sendon").val("");
                                    $(".dateon").hide();
                                },
                                complete: function() {
                                    $("#loading").hide();
                                    $("#wrapper").show();
                                }
                            });
                        }
                    }

                }
            });
        });
        $(window).ready(function() {
            $("#form-id").on("keypress", function(event) {
                var keyPressed = event.keyCode || event.which;
                if (keyPressed === 13) {
                    // alert("You pressed the Enter key!!");
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
<?php
    Session::put('popup', "");
    // $_SESSION["popup"] = "";
}else if(Session::get('plan_expire_popup') == 1){
    ?>
    <script>
         setTimeout(function() {
                 $(".plan_expired_popup").trigger('click');
                $('.folder_check').trigger('change');
                folder_check_doc();
            }, 1000); 
    </script>
   <?php 
   Session::put('plan_expire_popup', "");
}
?>
<script type="text/javascript">
 $(".plan_expired_popup_close").click(function(){
     $("#plan_expired_popup").hide();
     //$(".modal-backdrop").hide();
 });
    function folder_check_doc() {
        // var checkboxes = $('.folder_checkinput:checked').length;
        // alert("hi");
        var folder_arr = [];
        $(".folder_check:checked").each(function() {
            folder_arr.push($(this).val());
        });
        // alert(folder_arr);
        var contactid = $("#contactid").val();
        var url = "<?php echo url('/'); ?>/folderwisecontact";
        $.ajax({
            url: url,
            data: 'folder_arr=' + folder_arr + '&contactid=' + contactid + '&_token={{ csrf_token() }}',
            type: "POST",
            success: function(response) {
                // alert(response);
                // console.log(response);
                $("#contact_sec").html(response);
                $("#contactall").prop("checked", true);
                // $("#contactall").trigger("change");
                var boxes = $('.contact_mail:not(:checked)');
                boxes.each(function() {
                    $(this).prop('checked', false);
                    $(this).trigger('click');
                });
                // if($("#contactall").is(':checked')){
                //     $("#contactall").prop("checked", false);
                // }
            }
        });
    }

    $("#folderall").change(function() {
        if ($(this).prop('checked')) {
            this.setAttribute("checked", "checked");
            $('.folder_check').prop('checked', true);
        } else {
            this.removeAttribute("checked");
            $('.folder_check').prop('checked', false);
            var boxes = $('.contact_mail:checked');
            boxes.each(function() {
                $(this).prop('checked', true);
                $(this).trigger('click');
            });
        }
        $('.folder_check').trigger('change');
    });
    $(document).on("change", "#contactall", function() {
        if ($(this).prop('checked')) {
            // alert("bi");
            var boxes = $('.contact_mail:not(:checked)');
            boxes.each(function() {
                $(this).prop('checked', false);
                $(this).trigger('click');
            });
        } else {
            // alert("hi");
            $('.contact_mail').prop('checked', true);

            $('.contact_mail').trigger('click');
        }
    });
    $(document).on("change", '.folder_check', function() {
        if ($(this).prop('checked')) {
            // var checkboxes = $('.folder_checkinput:checked').length;
            var folder_arr = [];
            $(".folder_check:checked").each(function() {
                folder_arr.push($(this).val());
            });
            var contactid = $("#contactid").val();
            var url = "<?php echo url('/'); ?>/folderwisecontact";
            $.ajax({
                url: url,
                data: 'folder_arr=' + folder_arr + '&contactid=' + contactid + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // console.log(response);
                    $("#contact_sec").html(response);
                    $("#contactall").prop("checked", true);
                    // $("#contactall").trigger("change");
                    var boxes = $('.contact_mail:not(:checked)');
                    boxes.each(function() {
                        $(this).prop('checked', false);
                        $(this).trigger('click');
                    });
                    // if($("#contactall").is(':checked')){
                    //     $("#contactall").prop("checked", false);
                    // }
                }
            });
        } else {

            var remfolder = $(this).val();
            var fstres = "";
            // alert(remfolder);
            var folder_arr = [];
            $(".folder_check:checked").each(function() {
                folder_arr.push($(this).val());
            });
            var contactid = $("#contactid").val();
            var url = "<?php echo url('/'); ?>/folderwisecontact";
            $.ajax({
                    url: url,
                    data: 'folder_arr=' + folder_arr + '&contactid=' + contactid + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // console.log(response);
                        // $("#contact_sec").html(response);
                        fstres = response;
                    }
                })
                .then(function(data) {
                    $.ajax({
                        url: "<?php echo url('/'); ?>/folderwisecontactids",
                        data: 'remfolder=' + remfolder + '&_token={{ csrf_token() }}',
                        type: "POST",
                        success: function(response) {
                            // alert(response);

                            for (var i = 0, l = response.length; i < l; i++) {
                                // alert(response[i]);
                                var boxes = $('.contact_mail:checked');
                                boxes.each(function() {
                                    // alert($(this).val());
                                    var vau = $(this).val();
                                    if (vau == response[i]) {
                                        $(this).trigger('click');
                                    }
                                });
                            }
                            $("#contact_sec").html(fstres);
                            if ($("#folderall").is(':checked')) {
                                $("#folderall").prop("checked", false);
                            }
                        }
                    })
                });
        }
        // $("#contactall").prop("checked", true);
        // $(".contact_mail").prop("checked", false);
    });
    $(".enter-mail-id").keydown(function(e) {
        if (e.keyCode == 13 || e.keyCode == 32) {
            //alert('You Press enter');
            var getValue = $(this).val();
            $('.all-mail').append('<span class="email-ids"><span class="ema">' + getValue + '</span><span class="cancel-email">x</span></span>');
            var mail_arr = [];
            $(".email-ids .ema").each(function() {
                mail_arr.push($(this).html());
            });
            // alert(mail_arr);
            $('#malto').val(mail_arr);
            $(this).val('');
        }
    });
    $(document).on('click', '.cancel-email', function() {

        $(this).parent().remove();
        var mail_arr = [];
        $(".email-ids .ema").each(function() {
            mail_arr.push($(this).html());
        });
        // alert(mail_arr);
        $('#malto').val(mail_arr);

    });
    // $(".contact_mail").click(function(){
    $(document).on('click', '.contact_mail', function() {
        // alert("hi");
        if ($(this).prop('checked')) {
            // alert($(this).val());
            var id = $(this).val();
            this.setAttribute("checked", "checked");
            var url = "<?php echo url('/'); ?>/contactwisemail";
            $.ajax({
                url: url,
                data: 'id=' + id + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $('.all-mail').append('<span class="email-ids"><span class="ema">' + response + '</span><span class="cancel-email">x</span></span>');
                    var mail_arr = [];
                    $(".email-ids .ema").each(function() {
                        mail_arr.push($(this).html());
                    });
                    // alert(mail_arr);
                    $('#malto').val(mail_arr);
                    // $("#contact_sec").html(response);
                    var contactids = $("#contactid").val();
                    if (contactids == "") {
                        $("#contactid").val(id);
                    } else {
                        var contactid = contactids.split(',');
                        contactid.push(id);
                        $("#contactid").val(contactid);
                    }
                }
            });
        } else {
            var id = $(this).val();
            this.removeAttribute("checked");

            var url = "<?php echo url('/'); ?>/contactwisemaild";
            var smail = "";
            var mails = $("#malto").val();
            $.ajax({
                    url: "<?php echo url('/'); ?>/contactwisemail",
                    data: 'id=' + id + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        smail = response;
                    }
                })
                .done(function(data) {
                    // Handles successful responses only
                })
                .fail(function(reason) {
                    console.info(reason);
                })
                .then(function(data) {
                    $.ajax({
                        url: url,
                        data: 'id=' + id + '&mails=' + mails + '&_token={{ csrf_token() }}',
                        type: "POST",
                        success: function(response) {
                            $(".email-ids .ema").each(function() {
                                var ddemail = $(this).html();
                                // alert(smail);
                                if (ddemail == smail) {
                                    // alert(smail);
                                    $(this).parent().remove();

                                    // var mail_arr = [];
                                    //   $(".email-ids .ema").each(function() {
                                    //       mail_arr.push($(this).html());
                                    //   });
                                    //   $('#malto').val(mail_arr);
                                }
                            });
                            var box = [];
                            var boxes = $('.contact_mail:checked');
                            boxes.each(function() {
                                // alert($(this).val());
                                box.push($(this).val());
                            });
                            $("#contactid").val(box);
                            if ($("#contactall").is(':checked')) {
                                $("#contactall").prop("checked", false);
                            }
                            // $('#malto').val(response);
                        }
                    });
                });
        }
    });
</script>

<script>
    $(document).ready(function() {
        $(".tab1").click(function() {
            $(".tab1").removeClass("active1");
            // $(".tab1").addClass("active"); // instead of this do the below
            $(this).addClass("active1");
        });
    });
</script>

<script>
    $(".tab1").on("click", function() {
        var value = $(this).text();

        $(".my_tbl tr").each(function(index) {
            if (index !== 0) {
                $('.input-inline').val(value);
                $(".input-inline").keyup();
            }
        });

        tabb = $('.ammt').text().split('$');
        tabb_less = $('.class_les').text().split('$');
        desc = $('.desc_hwe').text().split(' ');
        console.log(tabb);
        total = 0;
        less = 0;
        for (var i = 0; i < tabb.length; i++) {
            
            
            total += parseFloat(tabb[i]) || 0;
        }
        for (var i = 0; i < tabb_less.length; i++) {
            
            
            less += parseFloat(tabb_less[i]) || 0;
        }
    //    alert(less.toFixed(2));
        total = (total.toFixed(2)-less.toFixed(2));
        $("#totaly").text("$ " + total);

    });
</script>
<!-- regscript -->

<script type="text/javascript">


$(document).on('click', '.btn_submit', function(e)
{

    if ($('#countries_states1').val() == "")
    {
        $(".country_message").show();
        $(".country_message").focus();
        $('#countries_states1').focus();
        return false;
    }
     e.preventDefault();
      swal({
        title: 'Confirm Business Category',
        text: "This is an opportunity to verify and confirm the information you entered. If any information is not correct, click on the “Edit” button to change it NOW. Note: Most information cannot be changed later.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: ' Continue ',
        cancelButtonText: ' Edit ',
        confirmButtonClass: 'btn btn-success btn-md mybtn',
        cancelButtonClass: 'btn btn-primary btn-md mybtn',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) =>
    {
        if(result.value)
        {
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
           var action=$(this).attr("data-action");
           var form=$("#manageBRegister");
            form.attr('action', action);
            form.submit();
             $(".submit-loading").remove();
            $elm.show();


        }
    })

});


$(document).on('click','.selectedplan',function(e){
   e.preventDefault();
   $(".selectedplan").removeClass('active_plan');
   $(this).addClass('active_plan');
    var plan_id = $(this).attr("data-id");
   var fees = $(this).attr("data-fees");
  $("#plan_id").val(plan_id);
  $("#fees").val(fees);

});

$(document).on('blur','#confirm_password',function() {
	var password=$("#mypass").val();
	var confirm_password=$(this).val();	
	//alert(password+'='+confirm_password);
	if(confirm_password == password){
		
		$(".cpass").text('Password and confirm matches.');
		$(".cpass").css('color','green');
	}else{
		$(".cpass").text('Password and confirm password does not match');
		$(".cpass").css('color','red');
	}
});

   $(document).on('change',"input[name='zip_code']",function(){
   	var pincode=$(this).val();
   	 var _token="{{ csrf_token() }}";
   	 var url = "<?=url('/');?>/get_street_info";
        $.ajax({
              url: url,
              data:{pincode:pincode,_token:_token},
              type: "POST",
            success: function (resp) {
            	 resp=JSON.parse(resp);
             $("input[name='city']").val(resp.city);	 
             $("input[name='address']").val(resp.street);	 
              console.log(resp);
               
            }
        });


     });

   $(document).on('change',"input[name='birth_zip_code']",function(){
			$(".birth_city").show();
			// $(".birth_state").show();
   	var pincode=$(this).val();
   	 var _token="{{ csrf_token() }}";
   	 var url = "<?=url('/');?>/get_street_info";
        $.ajax({
              url: url,
              data:{pincode:pincode,_token:_token},
              type: "POST",
            success: function (resp) {
            	 resp=JSON.parse(resp);
             $("input[name='birth_city']").val(resp.city);	 
             $("input[name='birth_address']").val(resp.street);	 
            }
        });


     });

   $(document).on('change','#billing_zip_code',function(){
   	var pincode=$(this).val();
   	 var _token="{{ csrf_token() }}";
   	 var url = "<?=url('/');?>/get_street_info";
        $.ajax({
              url: url,
              data:{pincode:pincode,_token:_token},
              type: "POST",
            success: function (resp) {
            	 resp=JSON.parse(resp);
             $("input[name='billing_city']").val(resp.city);	 
             $("input[name='billing_address']").val(resp.street);	 
              console.log(resp);
               
            }
        });


     });
	
    $("#affiliateemail").change(function(){
        varr = $(this).val();
        $("#emailexitstance").hide();
        // alert(varr);
        var url = "<?php echo url('/'); ?>/ademailavailability";
        $.ajax({
              url: url,
              data: 'email=' + varr + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                if(response == "success") {
                	$("#emailexitstance").show();
                	$("#emailexitstance").html("The email already exists!!!");
                	$("#affiliateemail").val("");
                }
            }
        });
    });
</script>
<script>
	$(document).on("change","#countries_states1",function(){
		haiti=$("#countries_states1").val();
        $(".country_message").hide();
		// alert(haiti);
		if(haiti=="HT"){
			$(".comm").show();
			$(".dep").show();
			$(".arr").show();
			$(".select_state").hide();
			$(".zip_code").hide();

        }else if(haiti=="US" || haiti=="CA"){
			$(".zip_code").show();
			$(".select_state").show();
			$(".comm").hide();
			$(".dep").hide();
			$(".arr").hide();
		}else{
			$(".zip_code").hide();
			$(".select_state").show();
			$(".comm").hide();
			$(".dep").hide();
			$(".arr").hide();
		}
	})

	$(document).on("change","#birth_countries_states1",function(){
		haiti=$("#birth_countries_states1").val();
		$(".birth_country_message").hide();
		if(haiti=="HT"){
			$(".birth_comm").show();
			$(".birth_state").hide();
		}
		else{
			$(".birth_state").show();
			$(".birth_comm").hide();
		}
	})
</script>

<script>
    $(document).on("focus", "input, select", function()
    { 

        // if ($('#birth_countries_states1').val() == "")
        // {
        //     $(".birth_country_message").show();
        //     $(".birth_country_message").focus();
        //     $('#birth_countries_states1').focus();
        //     return false;
        // }

        if($('#birth_countries_states1').val() != "" && $('#birth_countries_states1').val() != "HT")
        {
            // if ($('.birth-state-focus').val() == "")
            // {
            //     $(".birth_state_message").show();
            //     $(".birth_state_message").focus();
            //     $('.birth-state-focus').focus();
            //     return false;
            // }
        }
        if($('#birth_countries_states1').val() != "" && $('#birth_countries_states1').val() == "HT")
        {
            if ($('#birth_commune').val() == "")
            {
                $(".birth_commune_message").show();
                $(".birth_commune_message").focus();
                $('#birth_commune').focus();
                return false;
            }
        }
        if($('#countries_states1').val() != "" && $('#countries_states1').val() != "HT")
        {
            if ($('.state-focus').val() == "")
            {
                $(".state_message").show();
                $(".state_message").focus();
                $('.state-focus').focus();
                return false;
            }
        }
        if($('#countries_states1').val() != "" && $('#countries_states1').val() == "HT")
        {
            if ($('#commune').val() == "")
            {
                $(".commune_message").show();
                $(".commune_message").focus();
                $('#commune').focus();
                return false;
            }
        }
    });

    $(".birth-state-focus").on("change", function() {
        $(".birth_state_message").hide();
    }).trigger("change");

    $(".state-focus").on("change", function() {
        $(".state_message").hide();
    }).trigger("change");

</script>

<script>
	$(document).on("change","#department",function(){
		dep=$("#department").val();
		// alert(dep);
		var url = "<?=url('/');?>/select_arr";

		if(haiti=="HT" && commune!="" && dep!=""){
		$.ajax({
			url: url,
         	data: 'dep=' + dep,
         	type: "GET",
			success:function(data){
				$("#arro").html(data);
			}
		})
		}	
		
	})
</script>

<script>
	$(document).on("change","#birth_department",function(){
		dep=$("#birth_department").val();
		// alert(dep);
		var url = "<?=url('/');?>/select_arr";

		if(haiti=="HT" && commune!="" && dep!=""){
		$.ajax({
			url: url,
         	data: 'dep=' + dep,
         	type: "GET",
			success:function(data){
				$("#birth_arro").html(data);
			}
		})
		}	
		
	})
</script>


<script>
	$(document).on("change","#commune",function(){
		commune=$("#commune").val();
		haiti=$("#countries_states1").val();
		var url = "<?=url('/');?>/select_department";
		$(".commune_message").hide();

		if(haiti=="HT" && commune!=""){
		$.ajax({
			url: url,
         	data: 'haiti=' + haiti,
         	type: "GET",
			success:function(data){
				$("#department").html(data);
			}
		})
		}	
	})

	$(document).on("change","#birth_commune",function(){
		commune=$("#birth_commune").val();
		haiti=$("#birth_countries_states1").val();
		$(".birth_commune_message").hide();
		var url = "<?=url('/');?>/select_department";

		if(haiti=="HT" && commune!=""){
		$.ajax({
			url: url,
         	data: 'haiti=' + haiti,
         	type: "GET",
			success:function(data){
				$("#birth_department").html(data);
			}
		})
		}	
	})
</script>

<script>
	$(document).on("change","#otherreligion",function(){
		// alert("ok");
		otherreligion=$("#otherreligion").val();
		if(otherreligion=="Other"){

			$("#relother").show();

		}else{
			$("#relother").hide();
			$("#religionother").val("");

		}
	})
</script>

<script>
	$(document).on("change","#businesscat",function(){
		// alert("ok");
		businesscat=$("#businesscat").val();
		if(businesscat==13){

			$("#otherbusiness").show();

		}else{
			$("#otherbusiness").hide();
			$("#businessother").val("");

		}
	})



    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
   
       // $('#sendon').attr('min', maxDate);
    });
    $("#sendon").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change");

	$(document).on("change","#dob_day, #dob_month, #dob_year",function(){
        var dtToday = new Date();

	    var dobDay = $('#dob_day').val();
	    var dobMonth = $('#dob_month').val();
	    var dobYear = $('#dob_year').val();

	    if(dobDay == "0"){
            dobDay = dtToday.getDate();
	    }else if(dobDay < 10){
            dobDay = "0" + dobDay;	        
	    }
	    
	    if(dobMonth == "0"){
            dobMonth = dtToday.getMonth() + 1;
	    }
	    
	    if(dobYear == "0"){
            dobYear = dtToday.getFullYear();
	    }
	    
	    $('#sendon').val(dobYear + "-" + dobMonth + "-" + dobDay);
	})

</script>
<script>
       const phoneInputField = document.querySelector("#cellphone");
       const phoneInput = window.intlTelInput(phoneInputField, {
         utilsScript:
           "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
       });
       const getPhoneNo = () => {
        const phoneNumber = phoneInput.getNumber()
		if(phoneNumber.includes('+')) {
			const cellphoneInp = document.getElementById('cellphone-inp')
			cellphoneInp.value = phoneNumber
			cellPhoneToast.style.display = 'none'
		} else {
			// if liberary not loaded 
			const cellphoneInp = document.getElementById('cellphone-inp')
			cellphoneInp.value = phoneInputField.value
			// 
			let cellPhoneToast = document.getElementById('cellPhoneToast')
			cellPhoneToast.style.display = 'block'
		}
       }
       const businessPhoneInputField = document.querySelector("#business_telephone");
       const businessPhoneInput = window.intlTelInput(businessPhoneInputField, {
         utilsScript:
           "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
       });
       const getBusinessPhoneNo = () => {
        const businessPhoneNumber = businessPhoneInput.getNumber()
        if(businessPhoneNumber.includes('+')) {
			const businessPhoneInp = document.getElementById('business_telephone_inp')
			businessPhoneInp.value = businessPhoneNumber
			businessPhoneToast.style.display = 'none'
		} else {
			// if liberary not loaded
			const businessPhoneInp = document.getElementById('business_telephone_inp')
			businessPhoneInp.value = businessPhoneInputField.value

			let businessPhoneToast = document.getElementById('businessPhoneToast')
			businessPhoneToast.style.display = 'block'
		}
       }
      const onBirthCommuneChange = () => {
        const birthState = document.getElementById('birth_state')
        const birthCommune = document.getElementById('birth_commune')
        birthState.value = 'OU'
        // birthCommune.value
      }
      const onCommuneChange = () => {
        const state = document.getElementById('state')
        const commune = document.getElementById('commune')
        state.value = 'OU'
        // commune.value
        console.log(state)
        console.log(commune)
      }
</script>
@endsection