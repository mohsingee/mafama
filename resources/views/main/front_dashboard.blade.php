@extends('layouts.main') 
@section("content")
<?php use Carbon\Carbon; ?>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/solid.min.css" integrity="sha512-xIEmv/u9DeZZRfvRS06QVP2C97Hs5i0ePXDooLa5ZPla3jOgPT/w6CzoSMPuRiumP7A/xhnUBxRmgWWwU26ZeQ==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/solid.min.js" integrity="sha512-tmaD3q45JFEAXSixAxEo5p9K8ocD26I5zy42OQ5p7ZwnIx/JaGicXVHNawlZiZTHAU7jBNTl5XyZ8IcGwPG7gQ==" crossorigin="anonymous"></script>
<link href="{{ asset('public/assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
        <link href="{{ asset('public/assets/demo/demo.css') }}" rel="stylesheet" />
<!-- <link href="{{ asset('public/assets/demo/demo.css') }}" rel="stylesheet" /> -->
<style type="text/css">
  #topNav #topMain>li.mega-menu div.row div {
      float: left;
  }
   .card-stats .card-header.card-header-icon .appointmenttt .card-title {

    font-size: 16px;
    font-weight: 400;
    color: purple;
}
.card [class*="card-header-"] .card-icon,  {
    padding: 10px!important;

}
.card-stats .card-header .card-category:not([class*="text-"]) {
    color: purple!important;
    font-size: 14px!important;
    font-weight: 700!important;
}
.margin-bottom-none .card {
    margin-bottom: 4px!important;
}
.col-md-9.padding-o {
    padding-left: 0;
    padding-right: 0pc;
}
.col-md-9.padding-o .content {
    padding-left: 0px;
    padding-right: 0px;
}
.col-md-9.padding-o .container-fluid {
    padding-left: 0px;
    padding-right: 2px;
}

table#datatable_sample3 thead td {
    padding-top: 8px;
    padding-bottom: 8px;
    font-size: 18px;
}
table#datatable_sample3 thead th {
    font-size: 20px;
}
.text-purple {
    color:purple!important;
    font-weight: 900;

}
.text-green {
    color: green !important;
    font-weight: 900;

}
.text-blue {
    color:blue !important;
    font-weight: 900;

}
.text-red {
    color: red !important;
    font-weight: 900;
}
.bg-purple {
    background-color: purple!important;
}

.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    padding: 6px 8px;
    vertical-align: middle;
    border-color: #ddd;
    font-size: 20px;

}

.row.qualification_data {
    padding-left: 16px;
    padding-right: 16px;
}
.card.card-stats.bg-info {
    background: #9c27b0!important;
    color: #fff!important;
}
.card.weather22 {
    height: 89px;
    margin-top: 9px;
    background: linear-gradient(337deg, #0010d4fa, #9c27b082);
}
.card.weather {
    height: 112px;
    margin-top: 9px;
    background: #06b0c5;
}
.card-body.weather-1 {
    padding: 4px;
}

.wea-table{
width: 100%;
color: #fff;
}
.wea-table tr td{
    text-align: left;
}ul.we-li {
    list-style: none;
    color: #fff;
    line-height: 22px;
    font-size: 12px;
    margin-left: -40px;
}
label.temp {
    font-size: 17px;
    font-weight: 900;
    margin-left: 16px;
    color: #fff;
}
label.wea-text {
    color: #fff;
    font-size: 12px;
    margin-top: 3px;
}

tr.bg-green1.border-bottom-tr {
    border: 2px solid red;
}

.text-light-gray,.text-light-red,.text-gray{
    color:#1212cbc4!important;
}
input.frm {
    font-size: 20px;
    padding-left: 6px;
    color: red;
}
.textbold{
    font-weight:900;
    font-size: 20px;

}
.textp{
    font-size: 16px;
   color:#1212cbc4!important;
}

#calc1 {
    /* text-decoration: underline; */
    padding: 3px 8px  7px 11px;
    border: 2px solid red;
}
#spon1,#spon2,#leadsc1,#calc1 {
    color: red!important;
}
</style>

  <div class="row" style="margin: 20px 0;">
    <div class="col-md-12 padding-o">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-{{ Auth::check() && ($role_type =='affiliate' || $role_type =='free_affiliate')  ? '3' : '4' }}" >
              <div class="card card-chart">
               <!--  <div id="wwo-weather-widget-2"></div><script type='text/javascript' src='https://www.worldweatheronline.com/widget/v5/weather-widget.ashx?loc=2590477&wid=2&tu=1&div=wwo-weather-widget-2' async></script><noscript><a href="https://www.worldweatheronline.com/oakview-weather/maryland/us.aspx" alt="Hour by hour Oakview, Maryland weather">Oakview, Maryland weather forecast hourly</a></noscript> -->
                <div class="card-header card-header-primary">
                   <h3 class="card-title" id="timer">{{ $weather['cdate']}}</h3>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Current Time</h4>
                </div>

              </div>
            </div>


             <div class="col-md-{{ Auth::check() && ($role_type =='affiliate' || $role_type =='free_affiliate')  ? '3' : '4' }}">
              
              <div class="card weather">
                <div class="card-body weather-1">
                    <table class="wea-table" >
                        <tr>
                     <td style="width: 60%;">
                        <img src="{{ $weather['icon']}}" style="width:23px">
                         <label class="temp">{{ $weather['temp_c']}} °C/{{ $weather['temp_f']}} °F</label>
                        <br>
                        <label class="wea-text">{{ $weather['desc']}}</label>
                        </td>
                            <td style="width: 40%;">


                                <ul class="we-li">
                                    <li>Wind: <span class="text-light">{{ $weather['wind']}}</span></li>
                                    <li>Pressure: <span class="text-light">{{ $weather['pressure']}}</span></li>
                                    <li>Humidity: <span class="text-light">{{ $weather['humidity']}}</span></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>

              </div>
            </div>
          @if($role_type =='affiliate' || $role_type =='free_affiliate')
            <div class="col-md-3">
              <div class="card card-chart">
                <div class="card-header card-header-primary">
                <h3 class="card-title expander1" >Commissions/ Qualifications</h3>
                </div>
                <div class="card-body">
                  <a href="javascript:void(0)" class="expander"><h4 class="card-title">Commissions/ Qualifications</h4></a>
                </div>

              </div>
            </div>
            @endif
            
            <div class="col-md-{{ Auth::check() && ($role_type =='affiliate' || $role_type =='free_affiliate')  ? '3' : '4' }}">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                <h3 class="card-title expander2" >Projected Commission Calculator</h3>
                </div>
                <div class="card-body">
                  <a href="javascript:void(0)" class="expander3"><h4 class="card-title">Commission Calculator</h4></a>
                </div>

              </div>
            </div>
           </div>
            <div class="row calc_data"  style="display:none">
                <div class="col-md-12 padding-o">
      <div class="heading-title heading-dotted col-md-12 margin-bottom-1 text-center">
                                <h3>Projected Commission Calculator</h3>
         </div>
      <div class="content">
         <div class="container-fluid">
         <div class="row gy-4" style="padding-bottom:20px;">
        <div class="col-md-4">
            <input type="hidden" id="n1" value="">
            <input type="hidden" id="n2" value="">
            <input type="hidden" id="n3" value="">
            <input type="hidden" id="n4" value="">
            <input type="hidden" id="n5" value="">
            <input type="hidden" id="n6" value="">
            <input type="hidden" id="n7" value="">

            <input type="hidden" id="cn1" value="">
            <input type="hidden" id="cn2" value="">
            <input type="hidden" id="cn3" value="">
            <input type="hidden" id="cn4" value="">
            <input type="hidden" id="cn5" value="">
            <input type="hidden" id="cn6" value="">
            <input type="hidden" id="cn7" value="">

            <input type="hidden" id="btc1" value="">
            <input type="hidden" id="btc2" value="">
            <input type="hidden" id="btc3" value="">
            <input type="hidden" id="btc4" value="">
            <input type="hidden" id="btc5" value="">
            <input type="hidden" id="btc6" value="">
            <input type="hidden" id="btc7" value="">

            <input type="hidden" id="ct1" value="">
            <input type="hidden" id="ct2" value="">
            <input type="hidden" id="ct3" value="">
            <input type="hidden" id="ct4" value="">
            <input type="hidden" id="ct5" value="">
            <input type="hidden" id="ct6" value="">
            <input type="hidden" id="ct7" value="">


            <!--<input type="hidden" id="epu1" value="{{round($share_price,2)}}">-->
            <!--<input type="hidden" id="epu2" value="{{round($share_price/2,2)}}">-->
            <!--<input type="hidden" id="epu3" value="{{round($share_price/3,2)}}">-->
            <!--<input type="hidden" id="epu4" value="{{round($share_price/4,2)}}">-->
            <!--<input type="hidden" id="epu5" value="{{round($share_price/5,2)}}">-->
            <!--<input type="hidden" id="epu6" value="{{round($share_price/6,2)}}">-->
            <!--<input type="hidden" id="epu7" value="{{round($share_price/7,2)}}">-->
            
            <input type="hidden" id="epu1" value="{{round($share_price,2)}}">
            <input type="hidden" id="epu2" value="{{round($share_price,2)}}">
            <input type="hidden" id="epu3" value="{{round($share_price/2,2)}}">
            <input type="hidden" id="epu4" value="{{round($share_price/3,2)}}">
            <input type="hidden" id="epu5" value="{{round($share_price/4,2)}}">
            <input type="hidden" id="epu6" value="{{round($share_price/5,2)}}">
            <input type="hidden" id="epu7" value="{{round($share_price/6,2)}}">
            <div class="form-group">
                <label class="form-label text-gray">Enter below, the number of members you’ ll sponsor. (Ex. 2,3 or 4)</label>
                <input type="text" class="form-control frm" onkeyup="calc()" value="2" name="sponsoredc"autocomplete="off" >
                <br>
                <p class=" text-gray">1) If the number of  Affiliates you bring is <b id="spon1" class="textbold">0.00</b></p>
             <p class=" text-gray">2) Each one of them brings also <b id="spon2" class="textbold">0.00</b></p>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label text-gray">Enter the number of free leads each member will receive from Mafama.com, Inc. (Ex. 2,3 or 4)</label>
                <input type="text" class="form-control frm" onkeyup="calc()"  value="3" name="leadsc"autocomplete="off" >
                <br>
                 <p class=" text-gray" >3)Free Leads you receive from Mafama.com, Inc</p>
             <p class=" text-gray" >who become paid members is <b id="leadsc1" class="textbold" >0.00</b></p>


            </div>

        </div>
         <div class="col-md-4">

           <p class="textp"> then your projected commission for that month  </p>
           <p  class=" text-gray" > will be: <b id="calc1" class="textbold"></b></p>

         </div>
        </div>
            <div class="row ">

               <table class="table table-striped table-bordered table-hover" id="datatable_sample3">
                  <thead>
                     <tr>
                        <th>Level</th>
                        <th>Your Network</th>
                        @if(auth::check())
                        @if(Auth::user()->role == "admin")
                         <th>Earning per Unit</th>
                         @endif
                        @endif
                        <th>Commission on <br>Direct Network </th>
                        <th>Commission on <br> Free Leads</th>
                        <th>Total Commission <br> for the Month</th>
                     </tr>
                  </thead>
                  <tbody>

                     <tr class="bg-blue1" style="display:none">
                        <td class="text-gray">-</td>
                        <td class="text-gray n1">Your Affiliate Id</td>
                        @if(auth::check())
                        @if(Auth::user()->role == "admin")
                        <td class="text-gray epu1">{{round($share_price,2)}}</td>
                         @endif
                        @endif
                        <td class="text-gray cn1" >-</td>
                        <td class="text-light-gray btc1">-</td>
                        <td class="text-light-red ct1">-</td>

                     </tr>

                     <tr>
                        <td class="text-gray">LV-1</td>
                        <td class="text-gray n2">0</td>
                        @if(auth::check())
                        @if(Auth::user()->role == "admin")
                        <td class="text-gray epu2">{{round($share_price/2,2)}}</td>
                         @endif
                        @endif
                        <td class="text-gray cn2">0.00</td>
                        <td class="text-light-gray btc2">0.00</td>
                        <td class="text-light-red ct2">0.00</td>

                     </tr>
                     <tr>
                        <td class="text-gray">LV-2</td>
                        <td class="text-gray n3">0</td>
                        @if(auth::check())
                        @if(Auth::user()->role == "admin")
                        <td class="text-gray epu3">{{round($share_price/3,2)}}</td>
                         @endif
                        @endif
                        <td class="text-gray cn3">0.00</td>
                        <td class="text-light-gray btc3">0.00</td>
                        <td class="text-light-red ct3">0.00</td>
                     </tr>
                     <tr>
                        <td class="text-gray">LV-3</td>
                        <td class="text-gray n4">0</td>
                        @if(auth::check())
                        @if(Auth::user()->role == "admin")
                        <td class="text-gray epu4">{{round($share_price/4,2)}}</td>
                         @endif
                        @endif
                        <td class="text-gray cn4">0.00</td>
                        <td class="text-light-gray btc4">0.00</td>
                        <td class="text-light-red ct4">0.00</td>

                     </tr>
                     <tr>
                        <td class="text-gray">LV-4</td>
                        <td class="text-gray n5">0</td>
                        @if(auth::check())
                        @if(Auth::user()->role == "admin")
                        <td class="text-gray epu5">{{round($share_price/5,2)}}</td>
                         @endif
                        @endif
                        <td class="text-gray cn5">0.00</td>
                        <td class="text-light-gray btc5">0.00</td>
                        <td class="text-light-red ct5">0.00</td>
                     </tr>
                      <tr>
                        <td class="text-gray">LV-5</td>
                        <td class="text-gray n6">0</td>
                        @if(auth::check())
                        @if(Auth::user()->role == "admin")
                        <td class="text-gray epu6">{{round($share_price/6,2)}}</td>
                         @endif
                        @endif
                        <td class="text-gray cn6">0.00</td>
                        <td class="text-light-gray btc6">0.00</td>
                        <td class="text-light-red ct6">0.00</td>

                     </tr>
                     <tr>
                        <td class="text-gray">LV-6</td>
                        <td class="text-gray n7">0</td>
                        @if(auth::check())
                        @if(Auth::user()->role == "admin")
                        <td class="text-gray epu7">{{round($share_price/7,2)}}</td>
                         @endif
                        @endif
                        <td class="text-gray cn7">0.00</td>
                        <td class="text-light-gray btc7">0.00</td>
                        <td class="text-light-red ct7">0.00</td>

                     </tr>


                     <tr class="bg-green1 border-bottom-tr">
                        <td class="text-red ">Total</td>
                        <td class="text-red ntotal">0</td>
                        @if(auth::check())
                        @if(Auth::user()->role == "admin")
                        <td class="text-red eputotal">0.00</td>
                         @endif
                        @endif
                        <td class="text-red cntotal">0.00</td>
                        <td class="text-red btctotal">0.00</td>
                        <td class="text-red cttotal">0.00</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
            </div>
           @if(!empty(Auth::user()->level))

             <div class="row qualification_data"  style="display:none">
                   <table class="table table-striped table-bordered table-hover" id="datatable_sample3">
                                <thead>
                                    <tr>
                                        <th>Commissions/ Qualifications</th>
                                        <th>Commission</th>
                                        @if($level<=4)
                                        <th>Bonus</th>
                                        @endif
                                        <th>Prizes</th>
                                        <th>Other</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @php
                                      $total_current=$bonus_commission+$bonus+$prize+$other;
                                      $ytd_bonus=0;
                                      @endphp

                                 <tr class="bg-blue1">
                                     <td>Year to Date</td>
                                    <td>${{ $ytd_bonus_comm }}</td>
                                      @if($level<=4)
                                     <td>${{ $ytd_bonus }}</td>
                                     @endif
                                     <td>${{ $ytd_prize  }}</td>
                                     <td>${{ $ytd_other}}</td>
                                     <td class="text-red">
                                      @php
                                     
                                      $total_ytd=$ytd_bonus_comm+$ytd_bonus+$ytd_prize+$ytd_other;
                                      @endphp
                                     ${{ $total_ytd }}</td>
                                 </tr>

                                @if(Auth::check())
                                 <tr class="bg-purple1">
                                     <td>Current Month</td>
                                     <td>${{ $bonus_commission }}</td>
                                       @if($level<=4)
                                     <td>${{ $bonus }}</td>
                                     @endif
                                     <td>${{ $prize }}</td>
                                     <td>${{ $other }}</td>
                                     <td class="text-red">

                                     ${{ $total_current }}</td>
                                 </tr>

                                @endif
                                 <tr class="bg-green1">
                                     <td>Total</td>
                                    <td class="text-red">
                                      @php
                                      $total1=$bonus_commission+$ytd_bonus_comm;
                                      $total2=0;
                                      @endphp
                                    ${{ $total1 }}</td>
                                      @if($level<=4)
                                     <td class="text-red">
                                       @php
                                      $total2=$bonus+$ytd_bonus;
                                      @endphp
                                     ${{ $total2 }}</td>
                                       @endif
                                     <td class="text-red">
                                      @php
                                      $total3=$prize+$ytd_prize;
                                      @endphp
                                      ${{ $total3 }}

                                     </td>
                                     <td class="text-red">
                                      @php
                                      $total4=$other+$ytd_other;
                                      @endphp
                                      ${{ $total4 }}
                                     </td>
                                     <td class="text-red">
                                      @php
                                      $total=$total1+$total2+$total3+$total4;
                                      @endphp
                                     ${{ $total }}</td>
                                 </tr>
                                </tbody>
                            </table>


                    <table class="table table-striped table-bordered table-hover" id="datatable_sample3" style="margin-top:20px">
                                <thead>
                                    <tr>
                                        <th>Bonus Pool</th>
                                        <th>Direct Sponsored</th>
                                        <th>Affiliate</th>
                                         <th>Total</th>
                                         <!-- <th># Email sent</th> -->
                                        <th>Point Earned</th>
                                        <!--  <th>New Paid</th>  -->
                                    </tr>
                                    <tr>
                                        @if($level <=4)
                                        <td> ${{ number_format($bonus_pool->price,2)}}</td>
                                        @else
                                         <td>-</td>
                                        @endif
                                        <td>Affiliates</td>
                                        <td>Active Time<br> in days</td>
                                        <td>Active Users<br> per Qtr</td>
                                        <!--  <td>Basket I/Qtr <br> per Month</td>  -->
                                        <td>Month/Qtr</td>
                                      <!--   <td>Month/Qtr</td>  -->
                                    </tr>
                                </thead>
                                <tbody>
                                @if(Auth::check())
                                
                                @if($level <=4)
                                 <tr class="bg-red1">
                                     <th class="text-red">Bonus</th>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                      <td></td>

                                 </tr>

                                 <tr class="bg-purple1">
                                     <td>Qualification (Bonus)</td>
                                     <td class="text-purple">{{ $bonus_condition->downline_affiliate ? $bonus_condition->downline_affiliate:'' }}</td>
                                     <td class="text-purple">{{$bonus_condition->active_days ?$bonus_condition->active_days:''}}</td>
                                     <td class="text-purple">{{$bonus_condition->active_users ?$bonus_condition->active_users:''}}</td>

                                     <td class="text-purple">{{$bonus_condition->point_earned?$bonus_condition->point_earned:''}}</td>

                                 </tr>

                                  <tr class="bg-blue1">
                                     <td>Current Position</td>
                                     <td class="text-blue">{{ $direct_sponsor }}</td>
                                     <td class="text-blue">{{$user_active_days}}</td>
                                     <td class="text-blue">{{$active_users}}</td>
                                     <td class="text-blue">{{$earned_points}}</td>


                                 </tr>
                                  <tr class="bg-green1">
                                     <td>Qualification Needed</td>
                                     <td class="text-green">
                                         @if($bonus_condition->downline_affiliate > $direct_sponsor )

                                              @php
                                               $rem=$bonus_condition->downline_affiliate-$direct_sponsor;
                                              @endphp
                                              {{$rem}}

                                         @else
                                            -
                                         @endif
                                     </td>
                                     <td class="text-green">
                                         @if($bonus_condition->active_days > $user_active_days )

                                              @php
                                               $rem=$bonus_condition->active_days-$user_active_days;
                                              @endphp
                                              {{$rem}}

                                         @else
                                            -
                                         @endif
                                     </td>

                                     <td class="text-green">
                                         @if($bonus_condition->active_users > $active_users )

                                              @php
                                               $rem1=$bonus_condition->active_users-$active_users;
                                              @endphp
                                              {{$rem1}}

                                         @else
                                            -
                                         @endif
                                     </td>
                                      <td class="text-green">
                                         @if($bonus_condition->point_earned > $earned_points )

                                              @php
                                               $rem=$bonus_condition->point_earned-$earned_points;
                                              @endphp
                                              {{$rem}}

                                         @else
                                            -
                                         @endif
                                     </td>


                                 </tr>
                                 @endif

                                  <tr class="bg-red1">
                                     <th class="text-red">Prize</th>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                      <td></td>

                                 </tr>
                                 <tr class="bg-purple1">
                                 <td>Qualification (Bonus)</td>
                                 <td class="text-purple">{{$prize_condition->downline_affiliate}}</td>
                                 <td class="text-purple">{{$prize_condition->active_days}}</td>
                                 <td class="text-purple">{{$prize_condition->active_users}}</td>
                                 <td class="text-purple">{{$prize_condition->point_earned}}</td>

                                 </tr>

                                  <tr class="bg-blue1">
                                    <td>Current Position</td>
                                    <td class="text-blue">{{ $direct_sponsor }}</td>
                                    <td class="text-blue">{{$user_active_days}}</td>
                                    <td class="text-blue">{{$active_users}}</td>
                                    <td class="text-blue">{{$earned_points}}</td>


                                 </tr>
                                  <tr class="bg-green1">
                                     <td>Qualification Needed</td>
                                    <td class="text-green">
                                        @if($prize_condition->downline_affiliate > $direct_sponsor )

                                          @php
                                           $rem=$prize_condition->downline_affiliate-$direct_sponsor;
                                          @endphp
                                              {{$rem}}
                                        @else
                                            -
                                         @endif
                                     </td>
                                    <td class="text-green">
                                        @if($prize_condition->active_days > $user_active_days )

                                          @php
                                           $rem=$prize_condition->active_days-$user_active_days;
                                          @endphp
                                              {{$rem}}
                                        @else
                                            -
                                         @endif
                                     </td>

                                     <td class="text-green">
                                        @if($prize_condition->active_users > $active_users )

                                          @php
                                           $rem1=$prize_condition->active_users-$active_users;
                                          @endphp
                                              {{$rem1}}
                                        @else
                                            -
                                         @endif
                                     </td>
                                     <td class="text-green">
                                        @if($prize_condition->point_earned > $earned_points )

                                          @php
                                           $rem=$prize_condition->point_earned-$earned_points;
                                          @endphp
                                              {{$rem}}
                                        @else
                                            -
                                         @endif
                                     </td>



                                 </tr>

                                  <tr class="bg-red1">
                                     <th class="text-red">Other</th>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                      <td></td>

                                 </tr>
                                  <tr class="bg-purple1">
                                    <td>Qualification (Bonus)</td>
                                    <td class="text-purple">{{$other_condition->downline_affiliate}}</td>
                                    <td class="text-purple">{{$other_condition->active_days}}</td>
                                     <td class="text-purple">{{$other_condition->active_users}}</td>
                                     <td class="text-purple">{{$other_condition->point_earned}}</td>

                                 </tr>

                                  <tr class="bg-blue1">
                                     <td >Current Position</td>
                                    <td class="text-blue">{{ $direct_sponsor }}</td>
                                     <td class="text-blue">{{$user_active_days}}</td>
                                     <td class="text-blue">{{$active_users}}</td>
                                     <td class="text-blue">{{$earned_points}}</td>


                                 </tr>
                                  <tr class="bg-green1">
                                     <td>Qualification Needed</td>
                                     <td class="text-green">
                                        @if($other_condition->downline_affiliate > $direct_sponsor )

                                          @php
                                           $rem=$other_condition->downline_affiliate-$direct_sponsor;
                                          @endphp
                                              {{$rem}}
                                        @else
                                            -
                                         @endif
                                     </td>
                                     <td class="text-green">
                                        @if($other_condition->active_days > $user_active_days )

                                          @php
                                           $rem=$other_condition->active_days-$user_active_days;
                                          @endphp
                                              {{$rem}}
                                        @else
                                            -
                                         @endif
                                     </td>

                                      <td class="text-green">
                                        @if($other_condition->active_users > $active_users )

                                          @php
                                           $rem1=$other_condition->active_users-$active_users;
                                          @endphp
                                              {{$rem1}}
                                        @else
                                            -
                                         @endif
                                     </td>

                                      <td class="text-green">
                                        @if($other_condition->point_earned > $earned_points )

                                          @php
                                           $rem=$other_condition->point_earned-$earned_points;
                                          @endphp
                                              {{$rem}}
                                        @else
                                            -
                                         @endif
                                     </td>


                                 </tr>

                                @endif
                                </tbody>
                            </table>

            </div>
          @endif
          <div class="row">
               <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">

                <div class="card card-stats">
                  <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                     <img src="{{ asset('public/images/icons/revenue.png') }}" width="35px">
                    </div>
                    <p class="card-category"> Revenue Records</p>
                    <div class="appointmenttt appointmenttt_1">
                      <a href="{{ url('revenue_records') }}"> <h3 class="card-title">{{ $total_revenue }}</h3></a>
                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left">
                      <button class="btn-danger dash_btn dash_btn_1">Daily</button>
                      <button class="btn-danger dash_btn dash_btn_1">Weekly</button>
                      <button class="btn-success dash_btn dash_btn_1">Monthly</button>
                      <input type="hidden" id="count_basis_1" value="Monthly">
                      <input type="hidden" id="date_1" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee_1">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>

            </div>
         <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                     <img src="{{ asset('public/images/icons/revenue.png') }}" width="35px">
                    </div>
                    <p class="card-category"> Expense Records</p>
                    <div class="appointmenttt appointmenttt_2">
                      <a href="{{ url('expenses_reord') }}"> <h3 class="card-title">{{ $total_expense }}</h3></a>
                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left">
                      <button class="btn-danger dash_btn dash_btn_2">Daily</button>
                      <button class="btn-danger dash_btn dash_btn_2">Weekly</button>
                      <button class="btn-success dash_btn dash_btn_2">Monthly</button>
                      <input type="hidden" id="count_basis_2" value="Monthly">
                      <input type="hidden" id="date_2" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee_2">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6 col-sm-6  margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                     <img src="{{ asset('public/images/icons/revenue.png') }}" width="35px">
                    </div>
                    <p class="card-category"> Profit Loss</p>
                    <div class="appointmenttt appointmenttt_3">
                        @php
                        $bal=$total_revenue - $total_expense;
                        $bal=str_replace('-',' ',$bal);
                        @endphp
                       <a href="{{ url('profit_loss_stmt') }}"><h3 class="card-title">{{ $bal }}</h3></a>
                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left">
                      <button class="btn-danger dash_btn dash_btn_3">Daily</button>
                      <button class="btn-danger dash_btn dash_btn_3">Weekly</button>
                      <button class="btn-success dash_btn dash_btn_3">Monthly</button>
                      <input type="hidden" id="count_basis_3" value="Monthly">
                      <input type="hidden" id="date_3" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee_3">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>

            </div>


            <div class="col-lg-4 col-md-6 col-sm-6  margin-bottom-none">
              <!-- <a href="{{ url('dashboard_manage_appointment') }}"> -->
                <div class="card card-stats">
                  <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                      <img src="{{ asset('public/images/icons/appointment.png') }}" width="35px">
                    </div>
                    <p class="card-category">Appointments</p>
                    <div class="appointmenttt appointmenttt1">

                      <a href="{{ url('manage_appointment') }}"><h3 class="card-title">{{ $total_appointment }}</h3></a>

                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left">
                      <button class="btn-danger dash_btn dash_btn1">Daily</button>
                      <button class="btn-danger dash_btn dash_btn1">Weekly</button>
                      <button class="btn-success dash_btn dash_btn1">Monthly</button>
                      <input type="hidden" id="count_basis1" value="Monthly">
                      <input type="hidden" id="date1" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee1">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>
              <!-- </a> -->
            </div>
            <!-- <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <img src="{{ asset('public/images/icons/email.png') }}" width="35px">
                  </div>
                  <p class="card-category">Sent Emails</p>
                  <h3 class="card-title">{{ $totalemail }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> For month of {{ date('F') }}
                  </div>
                </div>
              </div>
            </div> -->
           
               <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                       <i class="fas fa-user"></i>
                    </div>
                    <p class="card-category">New Clients</p>
                    <div class="appointmenttt appointmenttt2">
                   
                      <a href="{{ url('new_client_lists') }}"><h3 class="card-title">{{ $new_clients }}</h3></a>
                     
                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left">
                      <button class="btn-danger dash_btn2 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn2 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn2 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis2" value="Monthly">
                      <input type="hidden" id="date2" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee2">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>
            </div>
 @if(Auth::check())

       <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                       <i class="fas fa-user"></i>
                    </div>
                    <p class="card-category">Client Management</p>
                    <div class="appointmenttt appointmenttt3">
                   
                      <a href="{{ url('manage_clients') }}"><h3 class="card-title">{{ $total_client_mgt }}</h3></a>
                     
                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left">
                      <button class="btn-danger dash_btn3 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn3 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn3 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis3" value="Monthly">
                      <input type="hidden" id="date3" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee3">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>
            </div>

             @if($is_medical_user==1)
             <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="fas fa-medkit"></i>
                    </div>
                    <p class="card-category">Today Orders</p>
                    <div class="appointmenttt appointmenttt14">

                        <a href="{{ url('lab/pharmacy?order=today') }}"><h3 class="card-title">{{ $today_orders }}</h3></a>

                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left">
                      <button class="btn-danger dash_btn14 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn14 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn14 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis14" value="Monthly">
                      <input type="hidden" id="date14" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee14">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>
            </div>
             <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                        <i class="fas fa-medkit"></i>
                    </div>
                    <p class="card-category">Total Lab Tests</p>
                    <div class="appointmenttt appointmenttt13">

                      <a href="{{ url('lab/lab-test') }}"><h3 class="card-title">{{ $total_lab_tests }}</h3></a>

                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left">
                      <button class="btn-danger dash_btn13 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn13 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn13 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis13" value="Monthly">
                      <input type="hidden" id="date13" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee13">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="fas fa-medkit"></i>
                    </div>
                    <p class="card-category">Pharmacy Orders</p>
                    <div class="appointmenttt appointmenttt15">

                        <a href="{{ url('lab/pharmacy') }}"><h3 class="card-title">{{ $total_pharmacy_orders }}</h3></a>

                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left">
                      <button class="btn-danger dash_btn15 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn15 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn15 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis15" value="Monthly">
                      <input type="hidden" id="date15" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee15">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>
            </div>


          @endif

              <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                       <img src="{{ asset('public/images/icons/revenue.png')}}" width="35px">
                    </div>
                    <p class="card-category">Payment/Balance</p>
                    <div class="appointmenttt appointmenttt4">
                   
                      <a href="{{ url('/paymentbalance_report') }}"><h3 class="card-title">{{ $payments_total }}/{{ $balance_total }}</h3></a>
                     
                    <!--   <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span> -->
                    </div>
                   <!--  <div class="text-left">
                      <button class="btn-danger dash_btn4 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn4 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn4 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis4" value="Monthly">
                      <input type="hidden" id="date4" value="{{ date('Y-m-d') }}">
                    </div> -->
                  </div>
                  <!-- <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee4">For month of {{ date('F') }}</p>
                    </div>
                  </div> -->
                </div>
            </div>
              <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                       <i class="fas fa-users"></i>
                    </div>
                    <p class="card-category">Basket 1</p>
                    <div class="appointmenttt appointmenttt11">

                      <a href="{{ url('send_email/13') }}"><h3 class="card-title">{{ $basket_1_users }}</h3></a>

                     <!--  <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span> -->
                    </div>
                   <!--  <div class="text-left">
                      <button class="btn-danger dash_btn11 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn11 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn11 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis11" value="Monthly">
                      <input type="hidden" id="date11" value="{{ date('Y-m-d') }}">
                    </div> -->
                  </div>
                 <!--  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee11">For month of {{ date('F') }}</p>
                    </div>
                  </div> -->
                </div>
            </div>
            <!--  <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                       <i class="fas fa-user"></i>
                    </div>
                    <p class="card-category">Birthdays</p>
                    <div class="appointmenttt appointmenttt5">
                   
                      <a href="{{ url('schedule_birthday') }}"><h3 class="card-title">{{ $birthdays_total }}</h3></a>
                     
                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left">
                      <button class="btn-danger dash_btn5 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn5 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn5 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis5" value="Monthly">
                      <input type="hidden" id="date5" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee5">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>
            </div>--->
            <!--
            <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                       <i class="fas fa-user"></i>
                    </div>
                    <p class="card-category">Events</p>
                    <div class="appointmenttt appointmenttt6">
                   
                      <a href="{{ url('calender_meeting') }}"><h3 class="card-title">{{ $events_total }}</h3></a>
                     
                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left">
                      <button class="btn-danger dash_btn6 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn6 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn6 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis6" value="Monthly">
                      <input type="hidden" id="date6" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee6">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>
            </div>--->
            

              <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats bg-info">
                  <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                       <i class="fas fa-users"></i>
                    </div>
                    <p class="card-category"><a href="{{ url('affiliate_dashboard') }}" style="color:#fff">View Full Schedule</a></p>
                    <div class="appointmenttt appointmenttt9">



                    <!--   <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span> -->
                    </div>
                   <!--  <div class="text-left">
                      <button class="btn-danger dash_btn9 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn9 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn9 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis9" value="Monthly">
                      <input type="hidden" id="date9" value="{{ date('Y-m-d') }}">
                    </div> -->
                  </div>
                 <!--  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee9">For month of {{ date('F') }}</p>
                    </div>
                  </div> -->
                </div>
            </div>

              <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none ">
                <div class="card card-stats">
                  <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                       <i class="fas fa-users"></i>
                    </div>
                    <p class="card-category">Clients</p>
                    <div class="appointmenttt appointmenttt8">

                      <a href="{{ url('send_email/9') }}"><h3 class="card-title">{{ $clients_total }}</h3></a>

                   <!--    <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span> -->
                    </div>
                    <!-- <div class="text-left">
                      <button class="btn-danger dash_btn8 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn8 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn8 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis8" value="Monthly">
                      <input type="hidden" id="date8" value="{{ date('Y-m-d') }}">
                    </div> -->
                  </div>
                  <!-- <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee8">For month of {{ date('F') }}</p>
                    </div>
                  </div> -->
                </div>
            </div>

              <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                       <i class="fas fa-users"></i>
                    </div>
                    <p class="card-category">Friends</p>
                    <div class="appointmenttt appointmenttt10">

                      <a href="{{ url('send_email/8') }}"><h3 class="card-title">{{ $friends }}</h3></a>

                     <!--  <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span> -->
                    </div>
                   <!--  <div class="text-left">
                      <button class="btn-danger dash_btn10 dash_btn  bnt">Daily</button>
                      <button class="btn-danger dash_btn10  dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn10  dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis10" value="Monthly">
                      <input type="hidden" id="date10" value="{{ date('Y-m-d') }}">
                    </div> -->
                  </div>
                  <!-- <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee10">For month of {{ date('F') }}</p>
                    </div>
                  </div> -->
                </div>
            </div>

              <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                       <i class="fas fa-users"></i>
                    </div>
                    <p class="card-category">Family</p>
                    <div class="appointmenttt appointmenttt7">

                      <a href="{{ url('send_email/7') }}"><h3 class="card-title">{{ $family_total }}</h3></a>

                      <!-- <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span> -->
                    </div>
                   <!--  <div class="text-left">
                      <button class="btn-danger dash_btn7 dash_btn bnt">Daily</button>
                      <button class="btn-danger dash_btn7 dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn7 dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis7" value="Monthly">
                      <input type="hidden" id="date7" value="{{ date('Y-m-d') }}">
                    </div> -->
                  </div>
                  <!-- <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee7">For month of {{ date('F') }}</p>
                    </div>
                  </div> -->
                </div>
            </div>

            <!--  <div class="col-lg-4 col-md-6 col-sm-6 margin-bottom-none">
                <div class="card card-stats">
                  <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                       <i class="fas fa-users"></i>
                    </div>
                    <p class="card-category">Basket 2</p>
                    <div class="appointmenttt appointmenttt12">
                   
                      <a href="{{ url('send_email/12') }}"><h3 class="card-title">{{ $basket_2_users }}</h3></a>
                     
                      <span class="prev"><i class="fas fa-chevron-left"></i></span>
                      <span class="next"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    <div class="text-left"> 
                      <button class="btn-danger dash_btn12 dash_btn  bnt">Daily</button>
                      <button class="btn-danger dash_btn12  dash_btn bnt">Weekly</button>
                      <button class="btn-success dash_btn12  dash_btn bnt">Monthly</button>
                      <input type="hidden" id="count_basis12" value="Monthly">
                      <input type="hidden" id="date12" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <img src="{{ asset('public/images/icons/calendar.png') }}" style="width: 17px; height: 17px; margin-right: 10px;"> <p id="datetitlee12">For month of {{ date('F') }}</p>
                    </div>
                  </div>
                </div>
            </div>-->
     

 @endif 
 
 
          </div>
@if($business_category==7 )
<div class="row">
    <div class="col-sm-12 lab-search-header" style="display: none">
        <div class="col-md-12 " >
         <!--  <div class="lab-search-header" style="display: none">
            <h4 class="text-pink">Lab Test Results</h4>
         </div>  -->
         <a href="javascript:void(0)" class="btn btn-xs btn-info clearfilter" style="float: right">x</a>
        <div class="col-md-12 margin-bottom-20  text-center ordered_div_info" >
        </div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5">
        <div class="col-md-12 margin-bottom-20  text-center completed_div_info" >
        </div>
        </div>
    </div>
  <div  class="col-md-12 text-center" style="text-align: center;">
    <br>
    <br>
    <h4 style="color: #da291c;font-size: 20px">Lab Tests </h4></div>  
  <div class="col-md-12" id="labTestRecords">
     <table class="table table-striped table-bordered table-hover table1" id="sample_editable_1">
          <thead>
              <tr>
                  <th>Date/Time</th>
                  <th>Ordered By</th>
                 <!--  <th>Completed By</th> -->
                  <th>Test Names</th>
                  <th>Upload</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              @if(count($lab_records) >0 )
              @foreach($lab_records as $lab)
              <tr>
               <td>{{date('M,d,Y :  h:i A',strtotime($lab->created_at))}}</td>
                  <td><a class="get_ordered_info" data-email="{{$lab->email}}" data-id="{{$lab->id}}" style="color:red">{{$lab->name}}</a></td>
                  <!-- <td>
                   @if($lab->status==1)  
                   @php 
                   $user=\App\User::get_user_info($lab->completed_by);
                   @endphp 
                      <a class="get_completed_info3" data-email="{{$user->email}}" data-id="{{$lab->id}}" style="color:red">{{$user->name}}</a>
                    @else
                     -
                    @endif  
                  </td> -->
                  <td>{{$lab->test_name}}</td>
                  <td>
                      @if(!empty($lab->uploaded_file))
                      <a href="{{ url('download_file/'.$lab->id) }}" class="btn btn-xs btn-primary float-right"> <i class="fa fa-download" aria-hidden="true"></i>
                      </a>
                      @endif
                  </td>
                  <td>
                      @if($lab->status==0)
                      <a href="javascript:void(0);" class="btn btn-xs btn-warning">pending</a>
                      @elseif($lab->status==1)
                       <a href="javascript:void(0);" class="btn btn-xs btn-success"  data-id="{{$lab->id }}" >Completed</a>
                      @elseif($lab->status==2)
                        <a href="javascript:void(0);" class="btn btn-xs btn-primary">{{$lab->test_name}} in progress</a>
                      @endif
                  </td>
                   <td>
                   @if($lab->status==0)
                      <a href="{{url('upload-lab-test-result/'.$lab->id)}}" data-id="{{$lab->id}}"  class="btn btn-xs btn-info mark-as-progress22">confirm</a>
                      @elseif($lab->status==1) 
                      @elseif($lab->status==2)
                       <a href="{{url('upload-lab-test-result/'.$lab->id)}}"  class="btn btn-xs btn-info">mark as complete</a>
                      @endif
                  </td>
              </tr>
              @endforeach
              @endif
          </tbody>
      </table>
    </div>
  </div>
@else

@if(Auth::check())
 @if($role_type=='notshow')
 <div class="row">
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="ct-chart" id="dailySalesChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Daily Expenses</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    updated few minutes ago
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-warning">
                  <div class="ct-chart" id="dailyChangeAppointmentChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Daily Change Appointments</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    updated few minutes ago
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-danger">
                  <div class="ct-chart" id="dailyCancelAppointmentChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Daily Cancel Appointments</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    updated few minutes ago
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="ct-chart" id="websiteViewsChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Monthly Revenue Records</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Updated today
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-danger">
                  <div class="ct-chart" id="websiteViewsChart2"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Monthly Expense Records</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Updated today
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="ct-chart" id="websiteViewsChart3"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Monthly New Clients</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Updated today
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="ct-chart" id="websiteViewsChart4"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Monthly Appointments</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Updated today
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-warning">
                  <div class="ct-chart" id="websiteViewsChart5"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Monthly Change Appointments</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Updated today
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-danger">
                  <div class="ct-chart" id="websiteViewsChart6"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Monthly Cancel Appointments</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Updated today
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-danger">
                  <div class="ct-chart" id="completedTasksChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Completed Tasks</h4>
                  <p class="card-category">Last Campaign Performance</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i> campaign sent 2 days ago
                  </div>
                </div>
              </div>
            </div> -->
</div>
 @endif
@endif
@endif          
          <!-- <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title">Tasks:</span>
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#profile" data-toggle="tab">
                            <i class="material-icons">bug_report</i> Bugs
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#messages" data-toggle="tab">
                            <i class="material-icons">code</i> Website
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#settings" data-toggle="tab">
                            <i class="material-icons">cloud</i> Server
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="" checked>
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Sign contract for "What are conference organizers afraid of?"</td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                            </td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="" checked>
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Create 4 Invisible User Experiences you Never Knew About</td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="messages">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="" checked>
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                            </td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Sign contract for "What are conference organizers afraid of?"</td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="settings">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="" checked>
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                            </td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="" checked>
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Sign contract for "What are conference organizers afraid of?"</td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Employees Stats</h4>
                  <p class="card-category">New employees on 15th September, 2016</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Salary</th>
                      <th>Country</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Dakota Rice</td>
                        <td>$36,738</td>
                        <td>Niger</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Minerva Hooper</td>
                        <td>$23,789</td>
                        <td>Curaçao</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Sage Rodriguez</td>
                        <td>$56,142</td>
                        <td>Netherlands</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Philip Chaney</td>
                        <td>$38,735</td>
                        <td>Korea, South</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>

  </div>
  <!-- <script src="{{ asset('public/assets/js/core/jquery.min.js') }}"></script> -->
  <script src="{{ asset('public/assets/js/core/popper.min.js') }}"></script>
  <!-- <script src="{{ asset('public/assets/js/core/bootstrap-material-design.min.js') }}"></script> -->
  <script src="{{ asset('public/assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!-- Plugin for the momentJs  -->
  <!-- <script src="{{ asset('public/assets/js/plugins/moment.min.js') }}"></script> -->
  <!--  Plugin for Sweet Alert -->
  <script src="{{ asset('public/assets/js/plugins/sweetalert2.js') }}"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{ asset('public/assets/js/plugins/jquery.validate.min.js') }}"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <!-- <script src="{{ asset('public/assets/js/plugins/jquery.bootstrap-wizard.js') }}"></script> -->
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <!-- <script src="{{ asset('public/assets/js/plugins/bootstrap-selectpicker.js') }}"></script> -->
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <!-- <script src="{{ asset('public/assets/js/plugins/bootstrap-datetimepicker.min.js') }}"></script> -->
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <!-- <script src="{{ asset('public/assets/js/plugins/jquery.dataTables.min.js') }}"></script> -->
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <!-- <script src="{{ asset('public/assets/js/plugins/bootstrap-tagsinput.js') }}"></script> -->
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <!-- <script src="{{ asset('public/assets/js/plugins/jasny-bootstrap.min.js') }}"></script> -->
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <!-- <script src="{{ asset('public/assets/js/plugins/fullcalendar.min.js') }}"></script> -->
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <!-- <script src="{{ asset('public/assets/js/plugins/jquery-jvectormap.js') }}"></script> -->
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <!-- <script src="{{ asset('public/assets/js/plugins/nouislider.min.js') }}"></script> -->
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js') }}"></script> -->
  <!-- Library for adding dinamically elements -->
  <!-- <script src="{{ asset('public/assets/js/plugins/arrive.min.js') }}"></script> -->
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chartist JS -->
  <script src="{{ asset('public/assets/js/plugins/chartist.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('public/assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('public/assets/js/material-dashboard.js?v=2.1.2') }}" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('public/assets/demo/demo.js') }}"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $sidebar_img_container = $sidebar.find('.sidebar-background');
        $full_page = $('.full-page');
        $sidebar_responsive = $('body > .navbar-collapse');
        window_width = $(window).width();
        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }
        }
        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });
        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');
          $(this).siblings().removeClass('active');
          $(this).addClass('active');
          var new_color = $(this).data('color');
          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }
          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }
          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });
        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');
          var new_color = $(this).data('background-color');
          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });
        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');
          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');
          var new_image = $(this).find("img").attr('src');
          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }
          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }
          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }
          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });
        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');
          $input = $(this);
          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }
            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }
            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }
            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }
            background_image = false;
          }
        });
        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');
          $input = $(this);
          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;
            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
          } else {
            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');
            setTimeout(function() {
              $('body').addClass('sidebar-mini');
              md.misc.sidebar_mini_active = true;
            }, 300);
          }
          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);
          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
     // md.initDashboardPageCharts();
    });
  </script>
  <script type="text/javascript">
      (function() {
        isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;
        if (isWindows) {
          // if we are on windows OS we activate the perfectScrollbar function
          $('.sidebar .sidebar-wrapper, .main-panel, .main').perfectScrollbar();
          $('html').addClass('perfect-scrollbar-on');
        } else {
          $('html').addClass('perfect-scrollbar-off');
        }
      })();
      var breakCards = true;
      var searchVisible = 0;
      var transparent = true;
      var transparentDemo = true;
      var fixedTop = false;
      var mobile_menu_visible = 0,
        mobile_menu_initialized = false,
        toggle_initialized = false,
        bootstrap_nav_initialized = false;
      var seq = 0,
        delays = 80,
        durations = 500;
      var seq2 = 0,
        delays2 = 80,
        durations2 = 500;
      $(document).ready(function() {
        // $('body').bootstrapMaterialDesign();
        $sidebar = $('.sidebar');
        md.initSidebarsCheck();
        window_width = $(window).width();
        // check if there is an image set for the sidebar's background
        md.checkSidebarImage();
        //    Activate bootstrap-select
        if ($(".selectpicker").length != 0) {
          $(".selectpicker").selectpicker();
        }
        //  Activate the tooltips
        $('[rel="tooltip"]').tooltip();
        $('.form-control').on("focus", function() {
          $(this).parent('.input-group').addClass("input-group-focus");
        }).on("blur", function() {
          $(this).parent(".input-group").removeClass("input-group-focus");
        });
        // remove class has-error for checkbox validation
        $('input[type="checkbox"][required="true"], input[type="radio"][required="true"]').on('click', function() {
          if ($(this).hasClass('error')) {
            $(this).closest('div').removeClass('has-error');
          }
        });
      });
      $(document).on('click', '.navbar-toggler', function() {
        $toggle = $(this);
        if (mobile_menu_visible == 1) {
          $('html').removeClass('nav-open');
          $('.close-layer').remove();
          setTimeout(function() {
            $toggle.removeClass('toggled');
          }, 400);
          mobile_menu_visible = 0;
        } else {
          setTimeout(function() {
            $toggle.addClass('toggled');
          }, 430);
          var $layer = $('<div class="close-layer"></div>');
          if ($('body').find('.main-panel').length != 0) {
            $layer.appendTo(".main-panel");
          } else if (($('body').hasClass('off-canvas-sidebar'))) {
            $layer.appendTo(".wrapper-full-page");
          }
          setTimeout(function() {
            $layer.addClass('visible');
          }, 100);
          $layer.click(function() {
            $('html').removeClass('nav-open');
            mobile_menu_visible = 0;
            $layer.removeClass('visible');
            setTimeout(function() {
              $layer.remove();
              $toggle.removeClass('toggled');
            }, 400);
          });
          $('html').addClass('nav-open');
          mobile_menu_visible = 1;
        }
      });
      // activate collapse right menu when the windows is resized
      $(window).resize(function() {
        md.initSidebarsCheck();
        // reset the seq for charts drawing animations
        seq = seq2 = 0;
        setTimeout(function() {
          md.initDashboardPageCharts();
        }, 500);
      });
      md = {
        misc: {
          navbar_menu_visible: 0,
          active_collapse: true,
          disabled_collapse_init: 0,
        },
        checkSidebarImage: function() {
          $sidebar = $('.sidebar');
          image_src = $sidebar.data('image');
          if (image_src !== undefined) {
            sidebar_container = '<div class="sidebar-background" style="background-image: url(' + image_src + ') "/>';
            $sidebar.append(sidebar_container);
          }
        },
        showNotification: function(from, align) {
          type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];
          color = Math.floor((Math.random() * 6) + 1);
          $.notify({
            icon: "add_alert",
            message: "Welcome to <b>Material Dashboard Pro</b> - a beautiful admin panel for every web developer."
          }, {
            type: type[color],
            timer: 3000,
            placement: {
              from: from,
              align: align
            }
          });
        },
        initDocumentationCharts: function() {
          if ($('#dailySalesChart').length != 0 && $('#websiteViewsChart').length != 0) {
            /* ----------==========     Daily Sales Chart initialization For Documentation    ==========---------- */
            dataDailySalesChart = {
              labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
              series: [
                [<?= $weeklycnt[0] ?>, <?= $weeklycnt[1] ?>, <?= $weeklycnt[2] ?>, <?= $weeklycnt[3] ?>, <?= $weeklycnt[4] ?>, <?= $weeklycnt[5] ?>, <?= $weeklycnt[6] ?>]
              ]
            };
            optionsDailySalesChart = {
              lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
              }),
              low: 0,
               // creative tim: we recommend you to set the high sa the biggest value + something for a better look
              chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
              },
            }
            var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);
            var animationHeaderChart = new Chartist.Line('#websiteViewsChart', dataDailySalesChart, optionsDailySalesChart);
          }
        },
        initDocumentationCharts: function() {
          if ($('#dailyChangeAppointmentChart').length != 0 && $('#websiteViewsChart').length != 0) {
            /* ----------==========     Daily Sales Chart initialization For Documentation    ==========---------- */
            datadailyChangeAppointmentChart = {
              labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
              series: [
                [<?= $weeklychangeappointment[0] ?>, <?= $weeklychangeappointment[1] ?>, <?= $weeklychangeappointment[2] ?>, <?= $weeklychangeappointment[3] ?>, <?= $weeklychangeappointment[4] ?>, <?= $weeklychangeappointment[5] ?>, <?= $weeklychangeappointment[6] ?>]
              ]
            };
            optionsdailyChangeAppointmentChart = {
              lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
              }),
              low: 0,
               // creative tim: we recommend you to set the high sa the biggest value + something for a better look
              chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
              },
            }
            var dailyChangeAppointmentChart = new Chartist.Line('#dailyChangeAppointmentChart', datadailyChangeAppointmentChart, optionsdailyChangeAppointmentChart);
            var animationHeaderChart = new Chartist.Line('#websiteViewsChart', datadailyChangeAppointmentChart, optionsdailyChangeAppointmentChart);
          }
        },
        initDocumentationCharts: function() {
          if ($('#dailyCancelAppointmentChart').length != 0 && $('#websiteViewsChart').length != 0) {
            /* ----------==========     Daily Sales Chart initialization For Documentation    ==========---------- */
            datadailyCancelAppointmentChart = {
              labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
              series: [
                [<?= $weeklycancelappointment[0] ?>, <?= $weeklycancelappointment[1] ?>, <?= $weeklycancelappointment[2] ?>, <?= $weeklycancelappointment[3] ?>, <?= $weeklycancelappointment[4] ?>, <?= $weeklycancelappointment[5] ?>, <?= $weeklycancelappointment[6] ?>]
              ]
            };
            optionsdailyCancelAppointmentChart = {
              lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
              }),
              low: 0,
               // creative tim: we recommend you to set the high sa the biggest value + something for a better look
              chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
              },
            }
            var dailyCancelAppointmentChart = new Chartist.Line('#dailyCancelAppointmentChart', datadailyCancelAppointmentChart, optionsdailyCancelAppointmentChart);
            var animationHeaderChart = new Chartist.Line('#websiteViewsChart', datadailyCancelAppointmentChart, optionsdailyCancelAppointmentChart);
          }
        },
        initFormExtendedDatetimepickers: function() {
          $('.datetimepicker').datetimepicker({
            icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
            }
          });
          $('.datepicker').datetimepicker({
            format: 'MM/DD/YYYY',
            icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
            }
          });
          $('.timepicker').datetimepicker({
            //          format: 'H:mm',    // use this format if you want the 24hours timepicker
            format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
            }
          });
        },
        initSliders: function() {
          // Sliders for demo purpose
          var slider = document.getElementById('sliderRegular');
          noUiSlider.create(slider, {
            start: 40,
            connect: [true, false],
            range: {
              min: 0,
              max: 100
            }
          });
          var slider2 = document.getElementById('sliderDouble');
          noUiSlider.create(slider2, {
            start: [20, 60],
            connect: true,
            range: {
              min: 0,
              max: 100
            }
          });
        },
        initSidebarsCheck: function() {
          if ($(window).width() <= 991) {
            if ($sidebar.length != 0) {
              md.initRightMenu();
            }
          }
        },
        checkFullPageBackgroundImage: function() {
          $page = $('.full-page');
          image_src = $page.data('image');
          if (image_src !== undefined) {
            image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>'
            $page.append(image_container);
          }
        },
        initDashboardPageCharts: function() {
          if ($('#dailySalesChart').length != 0 || $('#dailyChangeAppointmentChart').length != 0 || $('#dailyCancelAppointmentChart').length != 0 || $('#completedTasksChart').length != 0 || $('#websiteViewsChart').length != 0 || $('#websiteViewsChart2').length != 0 || $('#websiteViewsChart3').length != 0 || $('#websiteViewsChart4').length != 0 || $('#websiteViewsChart5').length != 0) {
            /* ----------==========     Daily Sales Chart initialization    ==========---------- */
            dataDailySalesChart = {
              labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
              series: [
                [<?= $weeklycnt[0] ?>, <?= $weeklycnt[1] ?>, <?= $weeklycnt[2] ?>, <?= $weeklycnt[3] ?>, <?= $weeklycnt[4] ?>, <?= $weeklycnt[5] ?>, <?= $weeklycnt[6] ?>]
              ]
            };
            optionsDailySalesChart = {
              lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
              }),
              low: 0,
               // creative tim: we recommend you to set the high sa the biggest value + something for a better look
              chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
              },
            }
            var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);
            md.startAnimationForLineChart(dailySalesChart);
            datadailyChangeAppointmentChart = {
              labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
              series: [
                [<?= $weeklychangeappointment[0] ?>, <?= $weeklychangeappointment[1] ?>, <?= $weeklychangeappointment[2] ?>, <?= $weeklychangeappointment[3] ?>, <?= $weeklychangeappointment[4] ?>, <?= $weeklychangeappointment[5] ?>, <?= $weeklychangeappointment[6] ?>]
              ]
            };
            optionsdailyChangeAppointmentChart = {
              lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
              }),
              low: 0,
               // creative tim: we recommend you to set the high sa the biggest value + something for a better look
              chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
              },
            }
            var dailyChangeAppointmentChart = new Chartist.Line('#dailyChangeAppointmentChart', datadailyChangeAppointmentChart, optionsdailyChangeAppointmentChart);
            md.startAnimationForLineChart(dailyChangeAppointmentChart);
            datadailyCancelAppointmentChart = {
              labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
              series: [
                [<?= $weeklycancelappointment[0] ?>, <?= $weeklycancelappointment[1] ?>, <?= $weeklycancelappointment[2] ?>, <?= $weeklycancelappointment[3] ?>, <?= $weeklycancelappointment[4] ?>, <?= $weeklycancelappointment[5] ?>, <?= $weeklycancelappointment[6] ?>]
              ]
            };
            optionsdailyCancelAppointmentChart = {
              lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
              }),
              low: 0,
               // creative tim: we recommend you to set the high sa the biggest value + something for a better look
              chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
              },
            }
            var dailyCancelAppointmentChart = new Chartist.Line('#dailyCancelAppointmentChart', datadailyCancelAppointmentChart, optionsdailyCancelAppointmentChart);
            md.startAnimationForLineChart(dailyCancelAppointmentChart);
            /* ----------==========     Completed Tasks Chart initialization    ==========---------- */
            dataCompletedTasksChart = {
              labels: ['12p', '3p', '6p', '9p', '12p', '3a', '6a', '9a'],
              series: [
                [230, 750, 450, 300, 280, 240, 200, 190]
              ]
            };
            optionsCompletedTasksChart = {
              lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
              }),
              low: 0,
               // creative tim: we recommend you to set the high sa the biggest value + something for a better look
              chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
              }
            }
            var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);
            // start animation for the Completed Tasks Chart - Line Chart
            md.startAnimationForLineChart(completedTasksChart);
            /* ----------==========     Emails Subscription Chart initialization    ==========---------- */
            var dataWebsiteViewsChart6 = {
              labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
              series: [
                [<?= $monthlycancelappointment[0] ?>, <?= $monthlycancelappointment[1] ?>, <?= $monthlycancelappointment[2] ?>, <?= $monthlycancelappointment[3] ?>, <?= $monthlycancelappointment[4] ?>, <?= $monthlycancelappointment[5] ?>, <?= $monthlycancelappointment[6] ?>, <?= $monthlycancelappointment[7] ?>, <?= $monthlycancelappointment[8] ?>, <?= $monthlycancelappointment[9] ?>, <?= $monthlycancelappointment[10] ?>, <?= $monthlycancelappointment[11] ?>]
              ]
            };
            var optionsWebsiteViewsChart6 = {
              axisX: {
                showGrid: false
              },
              low: 0,
              chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
              }
            };
            var responsiveOptions6 = [
              ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                  labelInterpolationFnc: function(value) {
                    return value[0];
                  }
                }
              }]
            ];
            var websiteViewsChart6 = Chartist.Bar('#websiteViewsChart6', dataWebsiteViewsChart6, optionsWebsiteViewsChart6, responsiveOptions6);
            //start animation for the Emails Subscription Chart
            md.startAnimationForBarChart(websiteViewsChart6);
            var dataWebsiteViewsChart5 = {
              labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
              series: [
                [<?= $monthlychangeappointment[0] ?>, <?= $monthlychangeappointment[1] ?>, <?= $monthlychangeappointment[2] ?>, <?= $monthlychangeappointment[3] ?>, <?= $monthlychangeappointment[4] ?>, <?= $monthlychangeappointment[5] ?>, <?= $monthlychangeappointment[6] ?>, <?= $monthlychangeappointment[7] ?>, <?= $monthlychangeappointment[8] ?>, <?= $monthlychangeappointment[9] ?>, <?= $monthlychangeappointment[10] ?>, <?= $monthlychangeappointment[11] ?>]
              ]
            };
            var optionsWebsiteViewsChart5 = {
              axisX: {
                showGrid: false
              },
              low: 0,
              chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
              }
            };
            var responsiveOptions5 = [
              ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                  labelInterpolationFnc: function(value) {
                    return value[0];
                  }
                }
              }]
            ];
            var websiteViewsChart5 = Chartist.Bar('#websiteViewsChart5', dataWebsiteViewsChart5, optionsWebsiteViewsChart5, responsiveOptions5);
            //start animation for the Emails Subscription Chart
            md.startAnimationForBarChart(websiteViewsChart5);
            var dataWebsiteViewsChart4 = {
              labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
              series: [
                [<?= $monthlyappointment[0] ?>, <?= $monthlyappointment[1] ?>, <?= $monthlyappointment[2] ?>, <?= $monthlyappointment[3] ?>, <?= $monthlyappointment[4] ?>, <?= $monthlyappointment[5] ?>, <?= $monthlyappointment[6] ?>, <?= $monthlyappointment[7] ?>, <?= $monthlyappointment[8] ?>, <?= $monthlyappointment[9] ?>, <?= $monthlyappointment[10] ?>, <?= $monthlyappointment[11] ?>]
              ]
            };
            var optionsWebsiteViewsChart4 = {
              axisX: {
                showGrid: false
              },
              low: 0,
              chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
              }
            };
            var responsiveOptions4 = [
              ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                  labelInterpolationFnc: function(value) {
                    return value[0];
                  }
                }
              }]
            ];
            var websiteViewsChart4 = Chartist.Bar('#websiteViewsChart4', dataWebsiteViewsChart4, optionsWebsiteViewsChart4, responsiveOptions4);
            //start animation for the Emails Subscription Chart
            md.startAnimationForBarChart(websiteViewsChart4);
            var dataWebsiteViewsChart3 = {
              labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
              series: [
                [<?= $monthlyclient[0] ?>, <?= $monthlyclient[1] ?>, <?= $monthlyclient[2] ?>, <?= $monthlyclient[3] ?>, <?= $monthlyclient[4] ?>, <?= $monthlyclient[5] ?>, <?= $monthlyclient[6] ?>, <?= $monthlyclient[7] ?>, <?= $monthlyclient[8] ?>, <?= $monthlyclient[9] ?>, <?= $monthlyclient[10] ?>, <?= $monthlyclient[11] ?>]
              ]
            };
            var optionsWebsiteViewsChart3 = {
              axisX: {
                showGrid: false
              },
              low: 0,
              chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
              }
            };
            var responsiveOptions3 = [
              ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                  labelInterpolationFnc: function(value) {
                    return value[0];
                  }
                }
              }]
            ];
            var websiteViewsChart3 = Chartist.Bar('#websiteViewsChart3', dataWebsiteViewsChart3, optionsWebsiteViewsChart3, responsiveOptions3);
            //start animation for the Emails Subscription Chart
            md.startAnimationForBarChart(websiteViewsChart3);
            var dataWebsiteViewsChart = {
              labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
              series: [
                [<?= $monthlyrevenue[0] ?>, <?= $monthlyrevenue[1] ?>, <?= $monthlyrevenue[2] ?>, <?= $monthlyrevenue[3] ?>, <?= $monthlyrevenue[4] ?>, <?= $monthlyrevenue[5] ?>, <?= $monthlyrevenue[6] ?>, <?= $monthlyrevenue[7] ?>, <?= $monthlyrevenue[8] ?>, <?= $monthlyrevenue[9] ?>, <?= $monthlyrevenue[10] ?>, <?= $monthlyrevenue[11] ?>]
              ]
            };
            var optionsWebsiteViewsChart = {
              axisX: {
                showGrid: false
              },
              low: 0,
              chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
              }
            };
            var responsiveOptions = [
              ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                  labelInterpolationFnc: function(value) {
                    return value[0];
                  }
                }
              }]
            ];
            var websiteViewsChart = Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart, optionsWebsiteViewsChart, responsiveOptions);
            //start animation for the Emails Subscription Chart
            md.startAnimationForBarChart(websiteViewsChart);
            var dataWebsiteViewsChart2 = {
              labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
              series: [
                [<?= $monthlyexpense[0] ?>, <?= $monthlyexpense[1] ?>, <?= $monthlyexpense[2] ?>, <?= $monthlyexpense[3] ?>, <?= $monthlyexpense[4] ?>, <?= $monthlyexpense[5] ?>, <?= $monthlyexpense[6] ?>, <?= $monthlyexpense[7] ?>, <?= $monthlyexpense[8] ?>, <?= $monthlyexpense[9] ?>, <?= $monthlyexpense[10] ?>, <?= $monthlyexpense[11] ?>]
              ]
            };
            var optionsWebsiteViewsChart2 = {
              axisX: {
                showGrid: false
              },
              low: 0,
              chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
              }
            };
            var responsiveOptions2 = [
              ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                  labelInterpolationFnc: function(value) {
                    return value[0];
                  }
                }
              }]
            ];
            var websiteViewsChart2 = Chartist.Bar('#websiteViewsChart2', dataWebsiteViewsChart2, optionsWebsiteViewsChart2, responsiveOptions2);
            //start animation for the Emails Subscription Chart
            md.startAnimationForBarChart(websiteViewsChart2);
          }
        },
        initMinimizeSidebar: function() {
          $('#minimizeSidebar').click(function() {
            var $btn = $(this);
            if (md.misc.sidebar_mini_active == true) {
              $('body').removeClass('sidebar-mini');
              md.misc.sidebar_mini_active = false;
            } else {
              $('body').addClass('sidebar-mini');
              md.misc.sidebar_mini_active = true;
            }
            // we simulate the window Resize so the charts will get updated in realtime.
            var simulateWindowResize = setInterval(function() {
              window.dispatchEvent(new Event('resize'));
            }, 180);
            // we stop the simulation of Window Resize after the animations are completed
            setTimeout(function() {
              clearInterval(simulateWindowResize);
            }, 1000);
          });
        },
        checkScrollForTransparentNavbar: debounce(function() {
          if ($(document).scrollTop() > 260) {
            if (transparent) {
              transparent = false;
              $('.navbar-color-on-scroll').removeClass('navbar-transparent');
            }
          } else {
            if (!transparent) {
              transparent = true;
              $('.navbar-color-on-scroll').addClass('navbar-transparent');
            }
          }
        }, 17),
        initRightMenu: debounce(function() {
          $sidebar_wrapper = $('.sidebar-wrapper');
          if (!mobile_menu_initialized) {
            $navbar = $('nav').find('.navbar-collapse').children('.navbar-nav');
            mobile_menu_content = '';
            nav_content = $navbar.html();
            nav_content = '<ul class="nav navbar-nav nav-mobile-menu">' + nav_content + '</ul>';
            navbar_form = $('nav').find('.navbar-form').get(0).outerHTML;
            $sidebar_nav = $sidebar_wrapper.find(' > .nav');
            // insert the navbar form before the sidebar list
            $nav_content = $(nav_content);
            $navbar_form = $(navbar_form);
            $nav_content.insertBefore($sidebar_nav);
            $navbar_form.insertBefore($nav_content);
            $(".sidebar-wrapper .dropdown .dropdown-menu > li > a").click(function(event) {
              event.stopPropagation();
            });
            // simulate resize so all the charts/maps will be redrawn
            window.dispatchEvent(new Event('resize'));
            mobile_menu_initialized = true;
          } else {
            if ($(window).width() > 991) {
              // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
              $sidebar_wrapper.find('.navbar-form').remove();
              $sidebar_wrapper.find('.nav-mobile-menu').remove();
              mobile_menu_initialized = false;
            }
          }
        }, 200),
        startAnimationForLineChart: function(chart) {
          chart.on('draw', function(data) {
            if (data.type === 'line' || data.type === 'area') {
              data.element.animate({
                d: {
                  begin: 600,
                  dur: 700,
                  from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                  to: data.path.clone().stringify(),
                  easing: Chartist.Svg.Easing.easeOutQuint
                }
              });
            } else if (data.type === 'point') {
              seq++;
              data.element.animate({
                opacity: {
                  begin: seq * delays,
                  dur: durations,
                  from: 0,
                  to: 1,
                  easing: 'ease'
                }
              });
            }
          });
          seq = 0;
        },
        startAnimationForBarChart: function(chart) {
          chart.on('draw', function(data) {
            if (data.type === 'bar') {
              seq2++;
              data.element.animate({
                opacity: {
                  begin: seq2 * delays2,
                  dur: durations2,
                  from: 0,
                  to: 1,
                  easing: 'ease'
                }
              });
            }
          });
          seq2 = 0;
        },
        initFullCalendar: function() {
          $calendar = $('#fullCalendar');
          today = new Date();
          y = today.getFullYear();
          m = today.getMonth();
          d = today.getDate();
          $calendar.fullCalendar({
            viewRender: function(view, element) {
              // We make sure that we activate the perfect scrollbar when the view isn't on Month
              if (view.name != 'month') {
                $(element).find('.fc-scroller').perfectScrollbar();
              }
            },
            header: {
              left: 'title',
              center: 'month,agendaWeek,agendaDay',
              right: 'prev,next,today'
            },
            defaultDate: today,
            selectable: true,
            selectHelper: true,
            views: {
              month: { // name of view
                titleFormat: 'MMMM YYYY'
                // other view-specific options here
              },
              week: {
                titleFormat: " MMMM D YYYY"
              },
              day: {
                titleFormat: 'D MMM, YYYY'
              }
            },
            select: function(start, end) {
              // on select we show the Sweet Alert modal with an input
              swal({
                  title: 'Create an Event',
                  html: '<div class="form-group">' +
                    '<input class="form-control" placeholder="Event Title" id="input-field">' +
                    '</div>',
                  showCancelButton: true,
                  confirmButtonClass: 'btn btn-success',
                  cancelButtonClass: 'btn btn-danger',
                  buttonsStyling: false
                }).then(function(result) {
                  var eventData;
                  event_title = $('#input-field').val();
                  if (event_title) {
                    eventData = {
                      title: event_title,
                      start: start,
                      end: end
                    };
                    $calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
                  }
                  $calendar.fullCalendar('unselect');
                })
                .catch(swal.noop);
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
            events: [{
                title: 'All Day Event',
                start: new Date(y, m, 1),
                className: 'event-default'
              },
              {
                id: 999,
                title: 'Repeating Event',
                start: new Date(y, m, d - 4, 6, 0),
                allDay: false,
                className: 'event-rose'
              },
              {
                id: 999,
                title: 'Repeating Event',
                start: new Date(y, m, d + 3, 6, 0),
                allDay: false,
                className: 'event-rose'
              },
              {
                title: 'Meeting',
                start: new Date(y, m, d - 1, 10, 30),
                allDay: false,
                className: 'event-green'
              },
              {
                title: 'Lunch',
                start: new Date(y, m, d + 7, 12, 0),
                end: new Date(y, m, d + 7, 14, 0),
                allDay: false,
                className: 'event-red'
              },
              {
                title: 'Md-pro Launch',
                start: new Date(y, m, d - 2, 12, 0),
                allDay: true,
                className: 'event-azure'
              },
              {
                title: 'Birthday Party',
                start: new Date(y, m, d + 1, 19, 0),
                end: new Date(y, m, d + 1, 22, 30),
                allDay: false,
                className: 'event-azure'
              },
              {
                title: 'Click for Creative Tim',
                start: new Date(y, m, 21),
                end: new Date(y, m, 22),
                url: 'http://www.creative-tim.com/',
                className: 'event-orange'
              },
              {
                title: 'Click for Google',
                start: new Date(y, m, 21),
                end: new Date(y, m, 22),
                url: 'http://www.creative-tim.com/',
                className: 'event-orange'
              }
            ]
          });
        },
        initVectorMap: function() {
          var mapData = {
            "AU": 760,
            "BR": 550,
            "CA": 120,
            "DE": 1300,
            "FR": 540,
            "GB": 690,
            "GE": 200,
            "IN": 200,
            "RO": 600,
            "RU": 300,
            "US": 2920,
          };
          $('#worldMap').vectorMap({
            map: 'world_mill_en',
            backgroundColor: "transparent",
            zoomOnScroll: false,
            regionStyle: {
              initial: {
                fill: '#e4e4e4',
                "fill-opacity": 0.9,
                stroke: 'none',
                "stroke-width": 0,
                "stroke-opacity": 0
              }
            },
            series: {
              regions: [{
                values: mapData,
                scale: ["#AAAAAA", "#444444"],
                normalizeFunction: 'polynomial'
              }]
            },
          });
        }
      }
      // Returns a function, that, as long as it continues to be invoked, will not
      // be triggered. The function will be called after it stops being called for
      // N milliseconds. If `immediate` is passed, trigger the function on the
      // leading edge, instead of the trailing.
      function debounce(func, wait, immediate) {
        var timeout;
        return function() {
          var context = this,
            args = arguments;
          clearTimeout(timeout);
          timeout = setTimeout(function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
          }, wait);
          if (immediate && !timeout) func.apply(context, args);
        };
      };
      
      // appointment
      $(document).on("click", ".dash_btn1", function(){
        $(".dash_btn1").removeClass("btn-success");
        $(".dash_btn1").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis1").val(val);
        $("#date1").val(date);
        // if(val == "Monthly"){
        //   $("#date").val(month);
        // }
        // else if(val == "Daily"){
        //   $("#date").val(date);
        // }
        // else if(val == "Weekly"){
        //   $("#date").val(week);
        // }
        $.ajax({
              url: "<?php echo url('/'); ?>/appointmentdashboardcount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt1 .card-title").html(response[0]);
                $("#datetitlee1").html(response[1]);
                $(".appointmenttt1 a").attr("href", response[2])
            }
        });
      });
      $(document).on("click", ".appointmenttt1 .prev", function(){
        var count_basis = $("#count_basis1").val();
        var date = $("#date1").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/appointmentdashboardcountbasis",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt1 .card-title").html(response[0]);
                $("#date1").val(response[1]);
                $("#datetitlee1").html(response[2]);
                $(".appointmenttt1 a").attr("href", response[3])
            }
        });
      });
      $(document).on("click", ".appointmenttt1 .next", function(){
        var count_basis = $("#count_basis1").val();
        var date = $("#date1").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/appointmentdashboardcountbasiss",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt1 .card-title").html(response[0]);
                $("#date1").val(response[1]);
                $("#datetitlee1").html(response[2]);
                $(".appointmenttt1 a").attr("href", response[3])
            }
        });
      });
      
      // new clients data
      
       $(document).on("click", ".dash_btn2", function(){
        $(".dash_btn2").removeClass("btn-success");
        $(".dash_btn2").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis2").val(val);
        $("#date2").val(date);
        
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardnewclientcount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt2 .card-title").html(response[0]);
                $("#datetitlee2").html(response[1]);
                 $(".appointmenttt2 a").attr("href", response[2])
            }
        });
      });
      $(document).on("click", ".appointmenttt2 .prev", function(){
        var count_basis = $("#count_basis2").val();
        var date = $("#date2").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardnewclientcount_pre",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt2 .card-title").html(response[0]);
                $("#date2").val(response[1]);
                $("#datetitlee2").html(response[2]);
                $(".appointmenttt2 a").attr("href", response[3])
            }
        });
      });
      $(document).on("click", ".appointmenttt2 .next", function(){
        var count_basis = $("#count_basis2").val();
        var date = $("#date2").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardnewclientcount_next",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt2 .card-title").html(response[0]);
                $("#date2").val(response[1]);
                $("#datetitlee2").html(response[2]);
                $(".appointmenttt2 a").attr("href", response[3])
            }
        });
      });
      
      
    $(document).on("click", ".dash_btn3", function(){
        $(".dash_btn3").removeClass("btn-success");
        $(".dash_btn3").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis3").val(val);
        $("#date3").val(date);
        
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardclientmgtcount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt3 .card-title").html(response[0]);
                $("#datetitlee3").html(response[1]);
                $(".appointmenttt3 a").attr("href", response[2])
            }
        });
      });
      $(document).on("click", ".appointmenttt3 .prev", function(){
        var count_basis = $("#count_basis3").val();
        var date = $("#date3").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardclientmgtcount_pre",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt3 .card-title").html(response[0]);
                $("#date3").val(response[1]);
                $("#datetitlee3").html(response[2]);
                $(".appointmenttt3 a").attr("href", response[3])
            }
        });
      });
      $(document).on("click", ".appointmenttt3 .next", function(){
        var count_basis = $("#count_basis3").val();
        var date = $("#date3").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardclientmgtcount_next",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt3 .card-title").html(response[0]);
                $("#date3").val(response[1]);
                $("#datetitlee3").html(response[2]);
                $(".appointmenttt3 a").attr("href", response[3])
            }
        });
      });
      
      
 $(document).on("click", ".dash_btn4", function(){

        $(".dash_btn4").removeClass("btn-success");
        $(".dash_btn4").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis4").val(val);
        $("#date4").val(date);
        
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardbalancecount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt4 .card-title").html(response[0]);
                $("#datetitlee4").html(response[1]);
            }
        });
      });
      $(document).on("click", ".appointmenttt4 .prev", function(){
        var count_basis = $("#count_basis4").val();
        var date = $("#date4").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardbalancecount_pre",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt4 .card-title").html(response[0]);
                $("#date4").val(response[1]);
                $("#datetitlee4").html(response[2]);
            }
        });
      });
      $(document).on("click", ".appointmenttt4 .next", function(){
        var count_basis = $("#count_basis4").val();
        var date = $("#date4").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardbalancecount_next",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt4 .card-title").html(response[0]);
                $("#date4").val(response[1]);
                $("#datetitlee4").html(response[2]);
            }
        });
      });
      
      

               
      
 $(document).on("click", ".dash_btn5", function(){
        $(".dash_btn5").removeClass("btn-success");
        $(".dash_btn5").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis5").val(val);
        $("#date5").val(date);
        
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardbirthdaycount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt5 .card-title").html(response[0]);
                $("#datetitlee5").html(response[1]);
            }
        });
      });
      $(document).on("click", ".appointmenttt5 .prev", function(){
        var count_basis = $("#count_basis5").val();
        var date = $("#date5").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardbirthdaycount_pre",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt5 .card-title").html(response[0]);
                $("#date5").val(response[1]);
                $("#datetitlee5").html(response[2]);
            }
        });
      });
    $(document).on("click", ".appointmenttt5 .next", function(){
        var count_basis = $("#count_basis5").val();
        var date = $("#date5").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardbirthdaycount_next",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt5 .card-title").html(response[0]);
                $("#date5").val(response[1]);
                $("#datetitlee5").html(response[2]);
            }
        });
      });
      
               
      
 $(document).on("click", ".dash_btn6", function(){
        $(".dash_btn6").removeClass("btn-success");
        $(".dash_btn6").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis6").val(val);
        $("#date6").val(date);
        
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardeventscount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt6 .card-title").html(response[0]);
                $("#datetitlee6").html(response[1]);
            }
        });
      });
      $(document).on("click", ".appointmenttt6 .prev", function(){
        var count_basis = $("#count_basis6").val();
        var date = $("#date6").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardeventscount_pre",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt6 .card-title").html(response[0]);
                $("#date6").val(response[1]);
                $("#datetitlee6").html(response[2]);
            }
        });
      });
      $(document).on("click", ".appointmenttt6 .next", function(){
        var count_basis = $("#count_basis6").val();
        var date = $("#date6").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardeventscount_next",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt6 .card-title").html(response[0]);
                $("#date6").val(response[1]);
                $("#datetitlee6").html(response[2]);
            }
        });
      });
      
      
          
      
 $(document).on("click", ".dash_btn7", function(){
        $(".dash_btn7").removeClass("btn-success");
        $(".dash_btn7").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis7").val(val);
        $("#date7").val(date);
        var folder=7;
        
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount",
              data:'folder='+folder+ '&val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt7 .card-title").html(response[0]);
                $("#datetitlee7").html(response[1]);
            }
        });
      });
      $(document).on("click", ".appointmenttt7 .prev", function(){
        var count_basis = $("#count_basis7").val();
        var date = $("#date7").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_pre",
              data: 'folder=7&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt7 .card-title").html(response[0]);
                $("#date7").val(response[1]);
                $("#datetitlee7").html(response[2]);
            }
        });
      });
      $(document).on("click", ".appointmenttt7 .next", function(){
        var count_basis = $("#count_basis7").val();
        var date = $("#date7").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_next",
              data: 'folder=7&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt7 .card-title").html(response[0]);
                $("#date7").val(response[1]);
                $("#datetitlee7").html(response[2]);
            }
        });
      });
      
             
      
 $(document).on("click", ".dash_btn8", function(){
        $(".dash_btn8").removeClass("btn-success");
        $(".dash_btn8").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis8").val(val);
        $("#date8").val(date);
        
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount",
              data: 'folder=9&val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt8 .card-title").html(response[0]);
                $("#datetitlee8").html(response[1]);
            }
        });
      });
      $(document).on("click", ".appointmenttt8 .prev", function(){
        var count_basis = $("#count_basis8").val();
        var date = $("#date8").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_pre",
              data: 'folder=9&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt8 .card-title").html(response[0]);
                $("#date8").val(response[1]);
                $("#datetitlee8").html(response[2]);
            }
        });
      });
      $(document).on("click", ".appointmenttt8 .next", function(){
        var count_basis = $("#count_basis8").val();
        var date = $("#date8").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_next",
              data: 'folder=9&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt8 .card-title").html(response[0]);
                $("#date8").val(response[1]);
                $("#datetitlee8").html(response[2]);
            }
        });
      });
      
      
            
      
 $(document).on("click", ".dash_btn9", function(){
        $(".dash_btn9").removeClass("btn-success");
        $(".dash_btn9").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis9").val(val);
        $("#date9").val(date);
        
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount",
              data: 'folder=10&val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt9 .card-title").html(response[0]);
                $("#datetitlee9").html(response[1]);
            }
        });
      });
      $(document).on("click", ".appointmenttt9 .prev", function(){
        var count_basis = $("#count_basis9").val();
        var date = $("#date9").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_pre",
              data: 'folder=10&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt9 .card-title").html(response[0]);
                $("#date9").val(response[1]);
                $("#datetitlee9").html(response[2]);
            }
        });
      });
      $(document).on("click", ".appointmenttt9 .next", function(){
        var count_basis = $("#count_basis9").val();
        var date = $("#date9").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_next",
              data: 'folder=10&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt9 .card-title").html(response[0]);
                $("#date9").val(response[1]);
                $("#datetitlee9").html(response[2]);
            }
        });
      });
      
              
      
 $(document).on("click", ".dash_btn10", function(){
        $(".dash_btn10").removeClass("btn-success");
        $(".dash_btn10").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis10").val(val);
        $("#date10").val(date);
        
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount",
              data: 'folder=8&val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt10 .card-title").html(response[0]);
                $("#datetitlee10").html(response[1]);
            }
        });
      });
      $(document).on("click", ".appointmenttt10 .prev", function(){
        var count_basis = $("#count_basis10").val();
        var date = $("#date10").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_pre",
              data: 'folder=8&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt10 .card-title").html(response[0]);
                $("#date10").val(response[1]);
                $("#datetitlee10").html(response[2]);
            }
        });
      });
      $(document).on("click", ".appointmenttt10 .next", function(){
        var count_basis = $("#count_basis10").val();
        var date = $("#date10").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_next",
              data: 'folder=8&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt10 .card-title").html(response[0]);
                $("#date10").val(response[1]);
                $("#datetitlee10").html(response[2]);
            }
        });
      });
      
            
      
 $(document).on("click", ".dash_btn11", function(){
        $(".dash_btn11").removeClass("btn-success");
        $(".dash_btn11").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis11").val(val);
        $("#date11").val(date);
        
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount",
              data: 'folder=13&val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt11 .card-title").html(response[0]);
                $("#datetitlee11").html(response[1]);
            }
        });
      });
      $(document).on("click", ".appointmenttt11 .prev", function(){
        var count_basis = $("#count_basis11").val();
        var date = $("#date11").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_pre",
              data: 'folder=13&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt11 .card-title").html(response[0]);
                $("#date11").val(response[1]);
                $("#datetitlee11").html(response[2]);
            }
        });
      });
      $(document).on("click", ".appointmenttt11 .next", function(){
        var count_basis = $("#count_basis11").val();
        var date = $("#date11").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_next",
              data: 'folder=13&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt11 .card-title").html(response[0]);
                $("#date11").val(response[1]);
                $("#datetitlee11").html(response[2]);
            }
        });
      });
      
         
      
 $(document).on("click", ".dash_btn12", function(){
        $(".dash_btn12").removeClass("btn-success");
        $(".dash_btn12").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis12").val(val);
        $("#date12").val(date);
        
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount",
              data: 'folder=12&val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt12 .card-title").html(response[0]);
                $("#datetitlee12").html(response[1]);
            }
        });
      });
      $(document).on("click", ".appointmenttt12 .prev", function(){
        var count_basis = $("#count_basis12").val();
        var date = $("#date12").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_pre",
              data: 'folder=12&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt12 .card-title").html(response[0]);
                $("#date12").val(response[1]);
                $("#datetitlee12").html(response[2]);
            }
        });
      });
      $(document).on("click", ".appointmenttt12 .next", function(){
        var count_basis = $("#count_basis12").val();
        var date = $("#date12").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardfoldercount_next",
              data: 'folder=12&count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt12 .card-title").html(response[0]);
                $("#date12").val(response[1]);
                $("#datetitlee12").html(response[2]);
            }
        });
      });
      
      
                
             
      // new clients data

       $(document).on("click", ".dash_btn_1", function(){
        $(".dash_btn_1").removeClass("btn-success");
        $(".dash_btn_1").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis_1").val(val);
        $("#date_1").val(date);

        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardrevenue_recordscount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt_1 .card-title").html(response[0]);
                $("#datetitlee_1").html(response[1]);
                $(".appointmenttt_1 a").attr("href", response[2])
            }
        });
      });
      $(document).on("click", ".appointmenttt_1 .prev", function(){
        var count_basis = $("#count_basis_1").val();
        var date = $("#date_1").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardrevenue_recordscount_pre",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt_1 .card-title").html(response[0]);
                $("#date_1").val(response[1]);
                $("#datetitlee_1").html(response[2]);
                $(".appointmenttt_1 a").attr("href", response[3])
            }
        });
      });
      $(document).on("click", ".appointmenttt_1 .next", function(){
        var count_basis = $("#count_basis_1").val();
        var date = $("#date_1").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardrevenue_recordscount_next",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt_1 .card-title").html(response[0]);
                $("#date_1").val(response[1]);
                $("#datetitlee_1").html(response[2]);
                $(".appointmenttt_1 a").attr("href", response[3])
            }
        });
      });


       // new clients data

       $(document).on("click", ".dash_btn_2", function(){
        $(".dash_btn_2").removeClass("btn-success");
        $(".dash_btn_2").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis_2").val(val);
        $("#date_2").val(date);

        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardexpense_recordscount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt_2 .card-title").html(response[0]);
                $("#datetitlee_2").html(response[1]);
                 $(".appointmenttt_2 a").attr("href", response[2])
            }
        });
      });
      $(document).on("click", ".appointmenttt_2 .prev", function(){
        var count_basis = $("#count_basis_2").val();
        var date = $("#date_2").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardexpense_recordscount_pre",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt_2 .card-title").html(response[0]);
                $("#date_2").val(response[1]);
                $("#datetitlee_2").html(response[2]);
                 $(".appointmenttt_2 a").attr("href", response[3])
            }
        });
      });
      $(document).on("click", ".appointmenttt_2 .next", function(){
        var count_basis = $("#count_basis_2").val();
        var date = $("#date2").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardexpense_recordscount_next",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt_2 .card-title").html(response[0]);
                $("#date_2").val(response[1]);
                $("#datetitlee_2").html(response[2]);
                 $(".appointmenttt_2 a").attr("href", response[3])
            }
        });
      });


       // new clients data

       $(document).on("click", ".dash_btn_3", function(){
        $(".dash_btn_3").removeClass("btn-success");
        $(".dash_btn_3").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis_3").val(val);
        $("#date_3").val(date);
       //  alert(date);
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardprofitlossscount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt_3 .card-title").html(response[0]);
                $("#datetitlee_3").html(response[1]);
                 $(".appointmenttt_3 a").attr("href", response[2])
            }
        });
      });
      $(document).on("click", ".appointmenttt_3 .prev", function(){
        var count_basis = $("#count_basis_3").val();
        var date = $("#date_3").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardprofitlossscount_pre",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt_3 .card-title").html(response[0]);
                $("#date_3").val(response[1]);
                $("#datetitlee_3").html(response[2]);
                $(".appointmenttt_3 a").attr("href", response[3])
            }
        });
      });
      $(document).on("click", ".appointmenttt_3 .next", function(){
        var count_basis = $("#count_basis_3").val();
        var date = $("#date_3").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardprofitlossscount_next",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt_3 .card-title").html(response[0]);
                $("#date_3").val(response[1]);
                $("#datetitlee_3").html(response[2]);
                $(".appointmenttt_3 a").attr("href", response[3])
            }
        });
      });


                   
                   
              


 $(document).on("click", ".dash_btn13", function(){
        $(".dash_btn13").removeClass("btn-success");
        $(".dash_btn13").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis13").val(val);
        $("#date13").val(date);

        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardlabscount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt13 .card-title").html(response[0]);
                $("#datetitlee13").html(response[1]);
                $(".appointmenttt13 a").attr("href", response[2])
            }
        });
      });
      $(document).on("click", ".appointmenttt13 .prev", function(){
        var count_basis = $("#count_basis13").val();
        var date = $("#date13").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardlabscount_pre",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt13 .card-title").html(response[0]);
                $("#date13").val(response[1]);
                $("#datetitlee13").html(response[2]);
                $(".appointmenttt13 a").attr("href", response[3])
            }
        });
      });
      $(document).on("click", ".appointmenttt13 .next", function(){
        var count_basis = $("#count_basis13").val();
        var date = $("#date13").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardlabscount_next",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt13 .card-title").html(response[0]);
                $("#date13").val(response[1]);
                $("#datetitlee13").html(response[2]);
                $(".appointmenttt13 a").attr("href", response[3])
            }
        });
      });




 $(document).on("click", ".dash_btn14", function(){
        $(".dash_btn14").removeClass("btn-success");
        $(".dash_btn14").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis14").val(val);
        $("#date14").val(date);

        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardpharmacycount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt14 .card-title").html(response[0]);
                $("#datetitlee14").html(response[1]);
                $(".appointmenttt14 a").attr("href", response[2]);
            }
        });
      });
      $(document).on("click", ".appointmenttt14 .prev", function(){
        var count_basis = $("#count_basis14").val();
        var date = $("#date14").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardpharmacycount_pre",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt14 .card-title").html(response[0]);
                $("#date14").val(response[1]);
                $("#datetitlee14").html(response[2]);
                 $(".appointmenttt14 a").attr("href", response[3]);
            }
        });
      });
      $(document).on("click", ".appointmenttt14 .next", function(){
        var count_basis = $("#count_basis14").val();
        var date = $("#date14").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardpharmacycount_next",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt14 .card-title").html(response[0]);
                $("#date14").val(response[1]);
                $("#datetitlee14").html(response[2]);
                 $(".appointmenttt14 a").attr("href", response[3]);
            }
        });
      });


      
      

 $(document).on("click", ".dash_btn15", function(){
        $(".dash_btn15").removeClass("btn-success");
        $(".dash_btn15").addClass("btn-danger");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        var val = $(this).html();
        var d = new Date();
        var month = ("0" + (d.getMonth()+1)).slice(-2);
        var date = d.getFullYear() + "-" + ("0" + month).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        var week = weekAndDay(new Date());
        $("#count_basis15").val(val);
        $("#date15").val(date);

        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardpharmacycount",
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $(".appointmenttt15 .card-title").html(response[0]);
                $("#datetitlee15").html(response[1]);
                 $(".appointmenttt15 a").attr("href", response[2]);
            }
        });
      });
      $(document).on("click", ".appointmenttt15 .prev", function(){
        var count_basis = $("#count_basis15").val();
        var date = $("#date14").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardpharmacycount_pre",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt15 .card-title").html(response[0]);
                $("#date15").val(response[1]);
                $("#datetitlee15").html(response[2]);
                 $(".appointmenttt15 a").attr("href", response[3]);
            }
        });
      });
      $(document).on("click", ".appointmenttt15 .next", function(){
        var count_basis = $("#count_basis15").val();
        var date = $("#date15").val();
        $.ajax({
              url: "<?php echo url('/'); ?>/dashboardpharmacycount_next",
              data: 'count_basis=' + count_basis + '&date=' + date + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".appointmenttt15 .card-title").html(response[0]);
                $("#date15").val(response[1]);
                $("#datetitlee15").html(response[2]);
                 $(".appointmenttt15 a").attr("href", response[3]);
            }
        });
      });



      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      function weekAndDay(date) {
          var days = ['Sunday','Monday','Tuesday','Wednesday',
                      'Thursday','Friday','Saturday'],
              prefixes = ['1', '2', '3', '4', '5'];
          return prefixes[Math.floor(date.getDate() / 7)];
      }
  </script>
  <script type="text/javascript">
$(document).on("click", ".mark-as-progress", function () {
     if(confirm('{{$lab_name}}, ' + ' Are you sure to do this test?'))
     {
     var id=$(this).attr('data-id');
     $.ajax({
            url: "{{ url('mark-as-progress') }}",
            data: {'id':id,'_token': '<?= csrf_token() ?>' },
            type: 'POST',
            success: function(result) {
              alert('Test marked as progress successfully');
              window.location.reload();
            }
        });
     }else{
        $(this).prop('checked',false);
     }
});
$(document).on('click','.clearfilter',function(){
 $(".lab-search-header").css('display','none');
});
$(document).on('click','.get_ordered_info',function(){
    $(".lab-search-header").css('display','block');
    $(".ordered_div_info").css('display','block');
        $(".ordered_div_info").html("");
        if($(this).html() != 0){
            var id = $(this).attr("data-id");
            var email = $(this).attr("data-email");
            var url = "<?php echo url('/'); ?>/get_ordered_test_info";
            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'id=' + id + '&email=' + email + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {                   
                    $(".ordered_div_info").html(response);
                },
                    complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
            });
        }
});
$(document).on('click','.get_completed_info',function(){
$(".lab-search-header").css('display','block');
$(".completed_div_info").css('display','block');
$(".completed_div_info").html("");
        if($(this).html() != 0){
            var id = $(this).attr("data-id");
            var email = $(this).attr("data-email");
            var url = "<?php echo url('/'); ?>/get_completed_test_info";
            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'id=' + id + '&email=' + email + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {                   
                    $(".completed_div_info").html(response);
                },
                    complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
            });
        }
});
$("#searchLabTestForm").submit(function(e)
{    
    e.preventDefault();
     $("#labTestRecords").html('');
        $elm=$(".btn4");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url:"{{url('get_lab_test_for_laboratory')}}",
             beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                // resp=JSON.parse(resp);
                 $(".submit-loading").remove();
                 $elm.show();
                 $("#labTestRecords").html(resp);
                // if(resp.valid==1){ 
                //  }else{                   
                //   }
                // return false;
            },
             complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    },
            error: function(data) {
            }
        });  
});



$(document).on("click",".expander,.expander1",function(){
  $('.qualification_data').toggle();
});


$(document).on("click",".expander2,.expander3",function(){
  $('.calc_data').toggle();
});
  </script>
  
  <script type="text/javascript">
    calc();

function calc(){
  var sponsor = $("input[name='sponsoredc']").val() ? parseFloat($("input[name='sponsoredc']").val()) : 0;
  var leadsc = $("input[name='leadsc']").val() ? parseFloat($("input[name='leadsc']").val()) : 0;
        $("#spon1").text(sponsor);
        $("#spon2").text(sponsor);
        $("#leadsc1").text(leadsc);
  var n1 = 1;//$(".n1").val() ? parseFloat($(".n1").val()) : 0;
         //  $(".n1").text(price_format1(n1));
           $("#n1").val(n1);
           $(".n2").text(price_format1(sponsor*n1));
           $("#n2").val(sponsor*n1);
  var n2 = $("#n2").val() ? parseFloat($("#n2").val()) : 0;
           $(".n3").text(price_format1(sponsor*n2));
           $("#n3").val(sponsor*n2);
  var n3 = $("#n3").val() ? parseFloat($("#n3").val()) : 0;
           $(".n4").text(price_format1(sponsor*n3));
           $("#n4").val(sponsor*n3);
  var n4 = $("#n4").val() ? parseFloat($("#n4").val()) : 0;
           $(".n5").text(price_format1(sponsor*n4)) ;
           $("#n5").val(sponsor*n4) ;
  var n5 = $("#n5").val() ? parseFloat($("#n5").val()) : 0;
           $(".n6").text(price_format1(sponsor*n5));
           $("#n6").val(sponsor*n5);
  var n6 = $("#n6").val() ? parseFloat($("#n6").val()) : 0;
           $(".n7").text(price_format1(sponsor*n6));
           $("#n7").val(sponsor*n6);
  var n7 = $("#n7").val() ? parseFloat($("#n7").val()) : 0;

  var sum1=n1+n2+n3+n4+n5+n6+n7;
  var ntotal = $(".ntotal").text(price_format1(sum1));


  var epu1 = $("#epu1").val() ? parseFloat($("#epu1").val()) : 0;
  var epu2 = $("#epu2").val() ? parseFloat($("#epu2").val()) : 0;
  var epu3 = $("#epu3").val() ? parseFloat($("#epu3").val()) : 0;
  var epu4 = $("#epu4").val() ? parseFloat($("#epu4").val()) : 0;
  var epu5 = $("#epu5").val() ? parseFloat($("#epu5").val()) : 0;
  var epu6 = $("#epu6").val() ? parseFloat($("#epu6").val()) : 0;
  var epu7 = $("#epu7").val() ? parseFloat($("#epu7").val()) : 0;

  var epusum=epu1+epu2+epu3+epu4+epu5+epu6+epu7;
  var eputotal= $(".eputotal").text(price_format(epusum));
           // $(".cn1").text(price_format(n1*epu1));
           
            $(".cn2").text(price_format(n2*epu2));
            $(".cn3").text(price_format(n3*epu3));
            $(".cn4").text(price_format(n4*epu4));
            $(".cn5").text(price_format(n5*epu5));
            $(".cn6").text(price_format(n6*epu6));
            $(".cn7").text(price_format(n7*epu7));

            $("#cn1").val(n1*epu1);
            $("#cn2").val(n2*epu2);
            $("#cn3").val(n3*epu3);
            $("#cn4").val(n4*epu4);
            $("#cn5").val(n5*epu5);
            $("#cn6").val(n6*epu6);
            $("#cn7").val(n7*epu7);
  var cn1 = $("#cn1").val() ? parseFloat($("#cn1").val()) : 0;
  var cn2 = $("#cn2").val() ? parseFloat($("#cn2").val()) : 0;
  var cn3 = $("#cn3").val() ? parseFloat($("#cn3").val()) : 0;
  var cn4 = $("#cn4").val() ? parseFloat($("#cn4").val()) : 0;
  var cn5 = $("#cn5").val() ? parseFloat($("#cn5").val()) : 0;
  var cn6 = $("#cn6").val() ? parseFloat($("#cn6").val()) : 0;
  var cn7 = $("#cn7").val() ? parseFloat($("#cn7").val()) : 0;

  var cntsum=cn1+cn2+cn3+cn4+cn5+cn6+cn7;
  var cntotal = $(".cntotal").text('$'+price_format(cntsum));

           // $(".btc1").text(price_format(n1*leadsc*epu1));
            $(".btc2").text(price_format(n2*leadsc*epu2));
            $(".btc3").text(price_format(n3*leadsc*epu3));
            $(".btc4").text(price_format(n4*leadsc*epu4));
            $(".btc5").text(price_format(n5*leadsc*epu5));
            $(".btc6").text(price_format(n6*leadsc*epu6));
            $(".btc7").text(price_format(n7*leadsc*epu7));

            $("#btc1").val(n1*leadsc*epu1);
            $("#btc2").val(n2*leadsc*epu2);
            $("#btc3").val(n3*leadsc*epu3);
            $("#btc4").val(n4*leadsc*epu4);
            $("#btc5").val(n5*leadsc*epu5);
            $("#btc6").val(n6*leadsc*epu6);
            $("#btc7").val(n6*leadsc*epu7);

  var btc1 = $("#btc1").val() ? parseFloat($("#btc1").val()) : 0;
  var btc2 = $("#btc2").val() ? parseFloat($("#btc2").val()) : 0;
  var btc3 = $("#btc3").val() ? parseFloat($("#btc3").val()) : 0;
  var btc4 = $("#btc4").val() ? parseFloat($("#btc4").val()) : 0;
  var btc5 = $("#btc5").val() ? parseFloat($("#btc5").val()) : 0;
  var btc6 = $("#btc6").val() ? parseFloat($("#btc6").val()) : 0;
  var btc7 = $("#btc7").val() ? parseFloat($("#btc7").val()) : 0;

  var btcsum=btc1+btc2+btc3+btc4+btc5+btc6+btc7;
  var btctotal = $(".btctotal").text('$'+price_format(btcsum));

           // $(".ct1").text(price_format(cn1+btc1));
            $(".ct2").text(price_format(cn2+btc2));
            $(".ct3").text(price_format(cn3+btc3));
            $(".ct4").text(price_format(cn4+btc4));
            $(".ct5").text(price_format(cn5+btc5));
            $(".ct6").text(price_format(cn6+btc6));
            $(".ct7").text(price_format(cn7+btc7));

            $("#ct1").val(cn1+btc1);
            $("#ct2").val(cn2+btc2);
            $("#ct3").val(cn3+btc3);
            $("#ct4").val(cn4+btc4);
            $("#ct5").val(cn5+btc5);
            $("#ct6").val(cn6+btc6);
            $("#ct7").val(cn7+btc7);

  var ct1 = $("#ct1").val() ? parseFloat($("#ct1").val()) : 0;
  var ct2 = $("#ct2").val() ? parseFloat($("#ct2").val()) : 0;
  var ct3 = $("#ct3").val() ? parseFloat($("#ct3").val()) : 0;
  var ct4 = $("#ct4").val() ? parseFloat($("#ct4").val()) : 0;
  var ct5 = $("#ct5").val() ? parseFloat($("#ct5").val()) : 0;
  var ct6 = $("#ct6").val() ? parseFloat($("#ct6").val()) : 0;
  var ct7 = $("#ct7").val() ? parseFloat($("#ct7").val()) : 0;

    var ctsum=ct1+ct2+ct3+ct4+ct5+ct6+ct7;
  var cttotal = $(".cttotal").text('$'+price_format(ctsum));
  $("#calc1").text('$'+price_format(ctsum));

}


function price_format1(nStr)
{
  const options = {
  minimumFractionDigits: 0,
  maximumFractionDigits: 0
  };

  const formatted = Number(nStr).toLocaleString('en', options);
  console.log(formatted);

    return  formatted;
}

function price_format(nStr)
{
  const options = {
  minimumFractionDigits: 2,
  maximumFractionDigits: 2
  };

  const formatted = Number(nStr).toLocaleString('en', options);
  console.log(formatted);

    return  formatted;
}
</script>
@endsection