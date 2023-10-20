@extends('layouts.admin') 
@section('content')
<style type="text/css">
   .nav-tabs .nav-link {
   font-weight: 500;
   font-size: 14px;
   padding-top: 7px;
   }
   .heading-dotted {
   background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKAQMAAAC3/F3+AAAABlBMVEX///+QkJApn3LQAAAAAnRSTlMAgJsrThgAAAAOSURBVHheYwCCUAdcJAAnnALqo5TBzAAAAABJRU5ErkJggg==') repeat-x center;
   }
   .h5 {
   margin: 0;
   padding: 0;
   background-color: #fae3e2;
   }
   tr.nk-tb-item.tr-border-red {
   color: red;
   font-weight: 800;
   font-size: 16px;
   }
   #email_part,#filtered_users{
      display: none;
   }
   #dsTable tr {
    white-space: nowrap;
    background-color: #fff;
}

.btn-title {
    width: 100%;
    font-size: 14px;
    text-transform: capitalize;
}

.carousel-control.left {
    background-image: none!important;
    background-repeat: repeat-x;
}
.carousel-control {
    position: absolute;
    top: -16px;
    bottom: 0;
    left: 0;
    width: 0%;
    font-size: 1px;
    color: #000!important;
    text-align: center;
     text-shadow: none;
    filter: alpha(opacity=50);
     opacity: .8;
    font-size: 16px!important;
}
.carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right, .carousel-control .icon-next, .carousel-control .icon-prev {
    width: 30px;
    height: 30px;
    margin-top: -15px;
    font-size: 25px!important;
}
.hide-child{display:none;}
a {
    color: #fff!important;
}
a.script_des {
    color: #ff0000!important;
}
.card_img {
    height: 80px!important;
}
</style>



<?php  $date = date('Y-m-d');?>
<div class="nk-content ">
   <div class="container-fluid">
      <div class="nk-content-inner">
         <div class="nk-content-body">
            <div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
               <h3 class="nk-block-title page-title"   style="width:900px;">Genealogy Report</h3>
            </div>
            <!-- .nk-block-head-content -->
            <div class="nk-block" id="rep-section">
               <div class="card card-bordered card-stretch">
                  <div class="card-aside-wrap">
                     <div class="card-inner card-inner-lg">
                        <ul class="nav nav-tabs">
                           <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#tabItem11">Yearly <br> Genealogy  </a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#tabItem21">Affiliates <br>Monthly<br> Genealogy</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#tabItem31">Affiliates <br>Quarterly<br> Genealogy</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#tabItem4">Yearly <br>Members</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#tabItem5">Monthly <br>Members</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#tabItem6">Quarterly <br>Members</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#tabItem7">Network <br>Total</a>
                           </li>
                        </ul>
                         <div class="row" style="margin-top: 30px;margin-bottom:20px;">
                              <form  method="POST" id="filterForm" enctype="multipart/form-data">
                                 @csrf
                                 <div class="row gy-4">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3">
                                       <div class="form-group">
                                          <select id="countries_states1" class="form-control bfh-countries" data-country="US" name="country" required></select>
                                       </div>
                                    </div>
                                    <div class="col-sm-3">
                                       <select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" name="month">
                                          <option>-- Month --</option>
                                          @foreach(getMonthsName() as $m)
                                          <option value="{{$m}}"  @if(date('m')== $m) selected @endif>{{ date("M", mktime(0, 0, 0, $m, 10)) }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="col-sm-3">
                                       <select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="5" name="year">
                                          <option>-- Year --</option>
                                          @foreach(getYears() as $cyear)
                                          <option value="{{$cyear}}"  @if(date('Y')== $cyear) selected @endif>{{$cyear}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                   <!--  <div class="col-md-2">
                                       <div class="form-group">
                                          <input type="text" class="form-control date-picker"  placeholder="Select Date">
                                       </div>
                                    </div> -->

                                    <div class="col-sm-2">
                                       <button type="submit" class="btn btn-md btn-primary btn4">Search</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        <div class="tab-content report_data"  >
                           <div class="tab-pane active" id="tabItem11">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5>Yearly Genealogy</h5>
                              </div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr  class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Name</th>
                                       @for($i=1;$i<=6;$i++)
                                       <th class="nk-tb-col"><span class="sub-text">Level {{$i}} </th>
                                       @endfor
                                       <th class="nk-tb-col"><span class="sub-text">Total </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>Affiliates (Paid)</span>
                                       </td>
                                       @php
                                       $country='US';
                                       $year=date('Y');

                                       $month=date('m');
                                       $total_paid=0;
                                       @endphp
                                       @for($i=1;$i<=6;$i++)
                                       @php
                                       $paid=getPaidAffiliates($i,$year,$month,$country);
                                       $total_paid +=$paid;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getYearlyGenealogybylevel(0,<?=$i;?>,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
                                          <span>{{$paid}}</span>
                                       </td>
                                       
                                       @endfor
                                       <td class="nk-tb-col" onclick="getYearlyGenealogyRecord(0,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
                                          <span>{{$total_paid}}</span>
                                       </td>
                                    </tr>
                                    @php
                                    $total=0;
                                    $total=$total_paid;
                                    $array=array();
                                    @endphp
                                    @foreach($ranks as $rank)
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>{{$rank->assign_position}}</span>
                                       </td>
                                       @php
                                       $m_sub=0;
                                       @endphp
                                       @for($i=1;$i<=6;$i++)
                                       @php
                                       $mTotal=getGeanologyUserYearly($i,$rank->id,$year,$month,$country);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getYearlyGenealogybylevel(<?=$rank->id;?>,<?=$i;?>,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
                                          <span>{{$mTotal}}</span>
                                       </td>
                                       @endfor
                                       <td class="nk-tb-col" onclick="getYearlyGenealogyRecord(<?=$rank->id;?>,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
                                          <span>{{$m_sub}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    @endforeach
                                    <tr class="nk-tb-item tr-border-red">
                                       <td class="nk-tb-col">
                                          <span>Total</span>
                                       </td>
                                       @for($i=1;$i<=6;$i++)
                                       @php
                                       $paid=getPaidAffiliates($i,$year,$month,$country);
                                       $tot=getGeanologyUserYearlyTotal($i,$year,$month,$country);
                                       $tolal_sub=$paid+$tot;
                                       @endphp
                                       <td class="nk-tb-col">
                                          <span>{{$tolal_sub}}</span>
                                       </td>
                                       @endfor
                                       <td class="nk-tb-col">
                                          <span>{{$total}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                 </tbody>
                              </table>
                           </div>
                           <div class="tab-pane" id="tabItem21">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5 >Affiliates Monthly Genealogy</h5>
                              </div>
                              <div class="row" style="margin-bottom:20px;"></div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Rank</span></th>
                                       @foreach(getMonthsName() as $m)
                                       <th class="nk-tb-col"><span class="sub-text">{{ date("M", mktime(0, 0, 0, $m, 10)) }}</span></th>
                                       @endforeach
                                       <th class="nk-tb-col"><span class="sub-text">Total</span></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>Affiliates (Paid)</span>
                                       </td>
                                       @php

                                       $total_paid=0;
                                       @endphp
                                       @foreach(getMonthsName() as $month)
                                       @php
                                       $paid=getPaidAffiliatesMonthly($month,$year,$country);
                                       $total_paid +=$paid;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getMonthlyGenealogy(0,<?=$year?>,<?=$month?>,'<?=$country?>') ">
                                          <span>{{$paid}}</span>
                                       </td>
                                       @endforeach
                                       <td class="nk-tb-col">
                                          <span>{{$total_paid}}</span>
                                       </td>
                                    </tr>
                                    @php
                                    $total=0;
                                    $total=$total_paid;
                                    $array=array();
                                    @endphp
                                    @foreach($ranks as $rank)
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>{{$rank->assign_position}}</span>
                                       </td>
                                       @php
                                       $m_sub=0;
                                       @endphp
                                       @foreach(getMonthsName() as $month)
                                       @php
                                       $mTotal=getGeanologyUserMonthly($month,$rank->id,$year,$country);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getMonthlyGenealogy(<?=$rank->id?>,<?=$year?>,<?=$month?>,'<?=$country?>') ">
                                          <span>{{$mTotal}}</span>
                                       </td>
                                       @endforeach
                                       <td class="nk-tb-col">
                                          <span>{{$m_sub}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    @endforeach
                                    <tr class="nk-tb-item">
                                       <th class="nk-tb-col">
                                          <span>Total</span>
                                       </th>
                                       @foreach(getMonthsName() as $month)
                                       @php
                                       $paid=getPaidAffiliatesMonthly($month,$year,$country);
                                       $tot=getGeanologyUserMonthlyTotal($month,$year,$country);
                                       $tolal_sub=$paid+$tot;
                                       @endphp
                                       <td class="nk-tb-col">
                                          <span>{{$tolal_sub}}</span>
                                       </td>
                                       @endforeach
                                       <td class="nk-tb-col tb-col-md">
                                          <span>{{$total}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                 </tbody>
                              </table>
                           </div>
                           <div class="tab-pane" id="tabItem31">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5 >Affiliates Quarterly Genealogy</h5>
                              </div>
                              <div class="row" style="margin-bottom:20px;"></div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Rank/Quarterly</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Jan-Mar</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Apr-Jun</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Jul-Sep</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Oct-Dec</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Total</span></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>Affiliates (Paid)</span>
                                       </td>
                                       @php

                                       $total_paid=0;
                                       @endphp
                                       @foreach($quarters as $qtr)
                                       @php
                                       $start_date=$qtr['start_date'];
                                       $end_date=$qtr['end_date'];

                                       $paid=getPaidAffiliatesQuarterly($qtr['start_date'],$qtr['end_date'],$month,$country);
                                       $total_paid +=$paid;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getQuaterlyGenealogy(0,'<?=$start_date?>','<?=$end_date?>',<?=$month?>,'<?=$country?>')">
                                          <span>{{$paid}}</span>
                                       </td>
                                       @endforeach
                                       <td class="nk-tb-col">
                                          <span>{{$total_paid}}</span>
                                       </td>
                                    </tr>
                                    @php
                                    $total=0;
                                    $total=$total_paid;
                                    $array=array();
                                    @endphp
                                    @foreach($ranks as $rank)
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>{{$rank->assign_position}}</span>
                                       </td>
                                       @php
                                       $m_sub=0;
                                       @endphp
                                       @foreach($quarters as $qtr)
                                       @php
                                       $start_date=$qtr['start_date'];
                                       $end_date=$qtr['end_date'];
                                       $mTotal=getGeanologyUserQuarterly($qtr['start_date'],$qtr['end_date'],$rank->id);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getQuaterlyGenealogy(<?=$rank->id?>,'<?=$start_date?>','<?=$end_date?>',<?=$month?>,<?=$country?>)">
                                          <span>{{$mTotal}}</span>
                                       </td>
                                       @endforeach
                                       <td class="nk-tb-col">
                                          <span>{{$m_sub}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    @endforeach
                                    <tr class="nk-tb-item">
                                       <th class="nk-tb-col">
                                          <span>Total</span>
                                       </th>
                                       @foreach($quarters as $qtr)
                                       @php
                                       $paid=getPaidAffiliatesQuarterly($qtr['start_date'],$qtr['end_date'],$month,$country);
                                       $tot=getGeanologyUserQuarterlyTotal($qtr['start_date'],$qtr['end_date'],$month,$country);
                                       $tolal_sub=$paid+$tot;
                                       @endphp
                                       <td class="nk-tb-col">
                                          <span>{{$tolal_sub}}</span>
                                       </td>
                                       @endforeach
                                       <td class="nk-tb-col tb-col-md">
                                          <span>{{$total}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                 </tbody>
                              </table>
                           </div>
                           <div class="tab-pane" id="tabItem4">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5 >Yearly Members</h5>
                              </div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead  class="thead-light">
                                    <tr  class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Name</th>
                                       @for($i=1;$i<=6;$i++)
                                       <th class="nk-tb-col"><span class="sub-text">Level {{$i}} </th>
                                       @endfor
                                       <th class="nk-tb-col"><span class="sub-text">Total </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php
                                    $total=0;
                                    $array=array();
                                    @endphp
                                    @foreach($plans as $plan)
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>{{$plan->name}}</span>
                                       </td>
                                       @php
                                       $m_sub=0;
                                       @endphp
                                       @for($i=1;$i<=6;$i++)
                                       @php
                                       $mTotal=getMemberUserYearly($i,$plan->id,$year,$month,$country);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getYearlyMemberbylevel(<?=$plan->id?>,<?=$i;?>,<?=$year;?>,'<?=$country;?>')">
                                          <span>{{$mTotal}}</span>
                                       </td>
                                       @endfor
                                       <td class="nk-tb-col">
                                          <span>{{$m_sub}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    @endforeach
                                    <tr class="nk-tb-item tr-border-red">
                                       <td class="nk-tb-col">
                                          <span>Total</span>
                                       </td>
                                       @for($i=1;$i<=6;$i++)
                                       @php
                                       $tot=getMemberUserYearlyTotal($i,$year,$month,$country);
                                       $tolal_sub=$tot;
                                       @endphp
                                       <td class="nk-tb-col">
                                          <span>{{$tolal_sub}}</span>
                                       </td>
                                       @endfor
                                       <td class="nk-tb-col">
                                          <span>{{$total}}</span>
                                       </td>
                                    </tr>
                              </table>
                           </div>
                           <div class="tab-pane" id="tabItem5">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5 > Monthly Members</h5>
                              </div>
                              <div class="row" style="margin-bottom:20px;"></div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Plan</span></th>
                                       @foreach(getMonthsName() as $m)
                                       <th class="nk-tb-col"><span class="sub-text">{{ date("M", mktime(0, 0, 0, $m, 10)) }}</span></th>
                                       @endforeach
                                       <th class="nk-tb-col"><span class="sub-text">Total</span></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php
                                    $total=0;
                                    $array=array();
                                    @endphp
                                    @foreach($plans as $plan)
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>{{$plan->name}}</span>
                                       </td>
                                       @php
                                       $m_sub=0;
                                       @endphp
                                       @foreach(getMonthsName() as $month)
                                       @php
                                       $mTotal=getMemberMonthly($month,$plan->id,$year,$country);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getMonthlyMember(<?=$month?>,<?=$plan->id?>,<?=$year?>,'<?=$country?>')">
                                          <span>{{$mTotal}}</span>
                                       </td>
                                       @endforeach
                                       <td class="nk-tb-col">
                                          <span>{{$m_sub}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    @endforeach
                                    <tr class="nk-tb-item">
                                       <th class="nk-tb-col">
                                          <span>Total</span>
                                       </th>
                                       @foreach(getMonthsName() as $month)
                                       @php
                                       $tot=getMemberMonthlyTotal($month,$year,$country);
                                       $tolal_sub=$tot;
                                       @endphp
                                       <td class="nk-tb-col">
                                          <span>{{$tolal_sub}}</span>
                                       </td>
                                       @endforeach
                                       <td class="nk-tb-col tb-col-md">
                                          <span>{{$total}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                 </tbody>
                              </table>
                           </div>
                           <div class="tab-pane" id="tabItem6">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5 > Quarterly Members</h5>
                              </div>
                              <div class="row" style="margin-bottom:20px;"></div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Plan/Quarterly</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Jan-Mar</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Apr-Jun</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Jul-Sep</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Oct-Dec</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Total</span></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php
                                    $total=0;
                                    $array=array();
                                    @endphp

                                    @foreach($plans as $plan)
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>{{$plan->name}}</span>
                                       </td>
                                       @php
                                       $m_sub=0;

                                       @endphp
                                       @foreach($quarters as $qtr)
                                       

                                       @php
                                      
                                       $start_date=$qtr['start_date'];
                                       $end_date=$qtr['end_date'];
                                       $mTotal=getMemberQuarterly($qtr['start_date'],$qtr['end_date'],$plan->id,$country);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getQuarterlyMember(<?=$plan->id?>,'<?=$start_date?>','<?=$end_date?>','<?=$country?>')">
                                          <span>{{$mTotal}}</span>
                                       </td>
                                       @endforeach
                                       <td class="nk-tb-col">
                                          <span>{{$m_sub}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    @endforeach
                                    <tr class="nk-tb-item">
                                       <th class="nk-tb-col">
                                          <span>Total</span>
                                       </th>
                                       @foreach($quarters as $qtr)
                                       @php
                                       $tot=getMemberQuarterlyTotal($qtr['start_date'],$qtr['end_date'],$month,$country);
                                       $tolal_sub=$tot;
                                       @endphp
                                       <td class="nk-tb-col">
                                          <span>{{$tolal_sub}}</span>
                                       </td>
                                       @endforeach
                                       <td class="nk-tb-col tb-col-md">
                                          <span>{{$total}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                 </tbody>
                              </table>
                           </div>
                           <div class="tab-pane " id="tabItem7">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5>Network Total</h5>
                              </div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr  class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Name</th>
                                       @for($i=1;$i<=6;$i++)
                                       <th class="nk-tb-col"><span class="sub-text">Level {{$i}} </th>
                                       @endfor
                                       <th class="nk-tb-col"><span class="sub-text">Total </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>Affiliates (Paid)</span>
                                       </td>
                                       @php

                                       $total_paid=0;
                                       @endphp
                                       @for($i=1;$i<=6;$i++)
                                       @php
                                       $paid=getPaidAffiliates($i,$year,$month,$country);
                                       $total_paid +=$paid;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getYearlyGenealogybylevel(0,<?=$i;?>,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
                                          <span>{{$paid}}</span>
                                       </td>
                                       @endfor
                                       <td class="nk-tb-col">
                                          <span>{{$total_paid}}</span>
                                       </td>
                                    </tr>
                                    @foreach($ranks as $rank)
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>{{$rank->assign_position}}</span>
                                       </td>
                                       @php
                                       $m_sub=0;
                                       @endphp
                                       @for($i=1;$i<=6;$i++)
                                       @php
                                       $mTotal=getGeanologyUserYearly($i,$rank->id,$year,$month,$country);
                                       $m_sub += $mTotal;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getYearlyGenealogybylevel(<?=$rank->id;?>,<?=$i;?>,<?=$year;?>,<?=$month;?>,'<?=$country;?>')">
                                          <span>{{$mTotal}}</span>
                                       </td>
                                       @endfor
                                       <td class="nk-tb-col">
                                          <span>{{$m_sub}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    @endforeach
                                    @foreach($plans as $plan)
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>{{$plan->name}}</span>
                                       </td>
                                       @php
                                       $m_sub=0;
                                       @endphp
                                       @for($i=1;$i<=6;$i++)
                                       @php
                                       $mTotal=getMemberUserYearly($i,$plan->id,$year,$month,$country);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       @endphp
                                       <td class="nk-tb-col" onclick="getYearlyMemberbylevel(<?=$plan->id?>,<?=$i;?>,<?=$year;?>,'<?=$country;?>')">
                                          <span>{{$mTotal}}</span>
                                       </td>
                                       @endfor
                                       <td class="nk-tb-col">
                                          <span>{{$m_sub}}</span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    @endforeach
                                    <tr class="nk-tb-item tr-border-red" >
                                       <td class="nk-tb-col">
                                          <span>Total</span>
                                       </td>
                                       @php
                                       $net_pay=0;
                                       @endphp
                                       @for($i=1;$i<=6;$i++)
                                       @php
                                       $paid=getPaidAffiliates($i,$year,$month,$country);
                                       $mem=getMemberUserYearlyTotal($i,$year,$month,$country);
                                       $tot=getGeanologyUserYearlyTotal($i,$year,$month,$country);
                                       $tolal_sub=$paid+$tot+$mem;
                                       $net_pay +=$tolal_sub;
                                       @endphp
                                       <td class="nk-tb-col">
                                          <span>{{$tolal_sub}}</span>
                                       </td>
                                       @endfor
                                       <td class="nk-tb-col">
                                          <span>{{$net_pay}}</span>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="nk-block" id="filtered_users">
               <div class="card card-bordered card-stretch">
                  <div class="card-inner-group">
                     <div class="card-inner">
                        <table class="datatable-init3 nk-tb-list nk-tb-ulist" data-auto-responsive="false" id="dsTable">
                           <thead>
                              <tr class="nk-tb-item nk-tb-head">
                                 <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                 <th class="nk-tb-col"><span class="sub-text">Email</span></th>
                                 <th class="nk-tb-col"><span class="sub-text">Company</span></th>
                                 <th class="nk-tb-col"><span class="sub-text">Level</span></th>
                                 <th class="nk-tb-col"><span class="sub-text">Phone</span></th>
                                 <th class="nk-tb-col tb-col-lg">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                       <input type="checkbox" class="custom-control-input group-checkable" data-set="#datatable_sample checkboxes" id="uidAll">
                                       <label class="custom-control-label" for="uidAll">Select All</label>
                                    </div>
                                 </th>
                              </tr>
                           </thead>
                           <tbody id="users_data">
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- .card-inner-group -->
               </div>
               <!-- .card -->
            </div>
            <div class="nk-block" id="email_part">
               <div class="card card-bordered card-stretch">
                  <div class="card-inner-group">
                     <div class="card-inner">
                        <div class="row" style="border-bottom:2px solid #b71a0f; margin-bottom:10px;">
                           <div class="col-md-12 text-center email-btn" style="" >
                              <div class="col-md-12 " style="" >
                                 <div id="owl-demo" class="owl-carousel owl-theme">
                                 <div class="row">

                                       <?php
                                          $cnt = 1;
                                          foreach($titles as $value){
                                             ?>
                                       <div class="col-md-3 text-center " style="padding-right:5px;padding-left:0px;" >
                                          <a href="javascript:void(0)" onclick="titleClick(this.id)"  id="{{ $value->subject }}"  class="btn btn-xs btn-black"  style="margin-top:10px;margin-bottom:10px;width:100%;">{{ $value->subject }}</a>
                                       </div>
                                       <?php
                                          $cnt++;
                                          if($cnt == 5){
                                              break;
                                          }
                                          }
                                          ?>
                                    </div>
                                    <a class="left carousel-control prev" href="javascript:void(0)" ><i class="glyphicon glyphicon-chevron-left"></i></a>
                                    <a class="right carousel-control next" href="javascript:void(0)" ><i class="glyphicon glyphicon-chevron-right"></i></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12" >
                              <ul class="nav nav-tabs activetab nav-button-tabs" style="">
                        <li class="nav-item"> <a class="btn-xs nav-link active" data-toggle="tab" data-id="sendEmail" href="#sendEmail">Send Email</a> </li>
                        <li class="nav-item"> <a class="btn-xs nav-link" data-toggle="tab" data-id="sendCard" href="#sendCard">Send Card</a> </li>
                        <li class="nav-item"> <a class="btn-xs nav-link" data-toggle="tab" data-id="sendVideos" href="#sendVideos">Send Videos</a> </li>
                     </ul>

                                 <div class="row">
                                    <div class="col-md-12 text-center ">
                                       <a class="btn btn-xs btn-primary text-center personalized_btn" style="margin-top:10px;margin-right:3px;margin-bottom:15px;">Personalized</a>
                                       <a class="btn btn-xs btn-primary text-center scripts_btn" style="margin-top:10px;margin-bottom:15px;">Scripts</a>
                                    </div>
                                    <div class="col-md-12 personalized_sec" style="display: none">
                                       <div class="col-md-12 padding-0" style="padding-top: 10px; padding-bottom: 10px;">
                                          <div class="" style="margin-bottom: 10px; border: 1px solid #da291c; border-radius: 3px; padding: 0px 10px;">
                                             <?php
                                                foreach($greetings as $value){
                                                ?>
                                             <div class="text-left" style="padding-left: 0px; display: inline-flex;">
                                                <a class="btn btn-xs btn-black greetings" style="padding: 3px 20px; margin-top: 10px; margin-bottom: 10px;" id="<?= $value->greetings ?>"><?= $value->greetings ?></a>
                                             </div>
                                             <?php
                                                }
                                                ?>
                                             <input type="hidden" name="greeting" id="greeting" value="">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-12 scripts_sec" style="display: none;">
                                       <div class="col-md-12 padding-0">
                                          <ul class="nav nav-tabs" >
                                             <?php
                                                $c = 0;
                                                foreach($scripts as $value){
                                                ?>
                                             <li class="nav-item script_cat">
                                                <a class="btn-xs nav-link <?php if($c == 0){echo 'active';} ?>" data-toggle="tab" href="#script-<?= $value->category ?>"><?= $value->category ?></a>
                                             </li>
                                             <?php
                                                $c++;
                                                }
                                                ?>
                                          </ul>
                                          <div class="tab-content">
                                             <?php
                                                $k = 0;
                                                foreach($scripts as $value){
                                                  $imgs = \App\Http\Controllers\HomeController::get_scripts_image($value->category);
                                                ?>
                                             <div class="tab-pane  <?php if($k == 0){echo 'active';} ?>" id="script-<?= $value->category ?>" style="border-top:1px solid #cecece;padding-top:10px;">
                                                <div class="col-md-12 padding-0  parent-<?= $value->category ?>">
                                                   <?php
                                                      foreach ($imgs as $img) { ?>
                                                   <div class="col-md-12 hide-child  child-<?= $value->category ?>" style="margin-bottom: 10px;border: 1px solid #da291c; border-radius: 3px; padding: 5px 10px;">
                                                      <img src="<?php echo asset('public/images')?>/<?= $img->image ?>" alt="" class="script_img" style="width: 100%;" />
                                                      <a class="script_des"><?= $img->description ?></a>
                                                   </div>
                                                   <?php } ?>
                                                </div>
                                                <div class="col-md-12 padding-0" >
                                                   <a href="javascript:void(0)"   data-id="<?= $value->category ?>" class="btn btn-xs btn-danger text-center loadMore"><i class="fa fa-plus"></i></a>
                                                   <a href="javascript:void(0)"  data-id="<?= $value->category ?>" class="btn btn-xs btn-danger text-center showLess"><i class="fa fa-minus"></i></a>
                                                </div>
                                             </div>
                                             <?php
                                                $k++;
                                                    }

                                                ?>
                                             <input type="hidden" id="script_path" val="">
                                             <input type="hidden" name="script_description" id="script_description">
                                             <input type="hidden" name="script_category" id="script_category">
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                           </div>
                        </div>
                        <div class="tab-content" style="margin-top:10px;">
                           <div class="tab-pane active" id="sendEmail">
                              <form id="client_manage_submit" class="margin-bottom-0" method="POST" role="form" enctype="multipart/form-data">
                                 @csrf
                                 <input type="hidden" class="form-control malto" placeholder="To" name="malto" value="" />
                                 <div class="row gy-2">
                                    <div class="col-md-12" style="padding:0px;">
                                       <div class="col-md-12"  style="margin-top: 10px;">
                                          <div class="form-group">
                                             <input type="text" class="form-control" name="subject" id="subject1" placeholder="Subject" required />
                                          </div>
                                          <div class="row">
                                             <div class="col-md-2 padding-0">
                                                <label>Background: </label>
                                             </div>
                                             <div class="col-md-10 padding-0">

                                                <ul style="list-style-type: none; padding: 0; margin: 0">
                                                   @foreach($colors as $color)
                                                   <li class="color-td" style="background-color: {{ $color->color }}; display: inline-block;"></li>
                                                   @endforeach
                                                </ul>
                                                <input type="hidden" name="bakg" id="bakg">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-12"  style="margin-top: 10px;">
                                          <div class="form-group">
                                             <textarea type="color" class="form-control summernote msgbox summernote1" rows="6" placeholder="Message"></textarea>
                                             <p style="color: red" id="textre"></p>
                                          </div>
                                          <input type="hidden" name="forecolorr" value="#000000" id="forecolorr">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12" style="">
                                    <div class="row" >
                                       <div class="col-md-12">
                                          <div class="col-md-12 text-center email-btn" style="margin-top: 10px;">
                                             <div class="row">
                                                <!-- <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                   <a class="btn btn-xs btn-info subbtn" style="width: 100%;">Send With Clock</a>
                                                </div> -->
                                                <div class="col-md-3 text-center" style="padding: 0px; padding-right: 5px;">
                                                   <a class="btn btn-xs btn-info reminderonsub" style="width: 100%;">Send With Reminders</a>
                                                </div>
                                                <div class="col-md-3 text-center" style="padding-left: 0px; padding-right: 5px;">
                                                   <a class="btn btn-xs btn-info prvbtn" style="width: 100%;">Preview</a>
                                                </div>
                                                <div class="col-md-3 text-center" style="padding-left: 0px; padding-right: 5px;">
                                                   <a class="btn btn-xs btn-info subbtn" style="width: 100%;">Send Now</a>
                                                </div>
                                                <div class="col-md-3 text-center" style="padding: 0px;">
                                                   <a class="btn btn-xs btn-info dateonsub" style="width: 100%;">Send On</a>
                                                </div>
                                                <input type="submit" id="submit_button" value="" style="display: none">
                                             </div>
                                          </div>
                                          <?php
                                             $date = date('Y-m-d');
                                             ?>
                                          <div class="col-md-12">
                                             <div class="col-md-12 dateon" style="margin-top: 10px; display: none;">
                                                <div class="row">
                                                   <div class="col-md-6"></div>
                                                   <div class="col-md-4" style="padding: 0 10px; ">
                                                      <input type="date" name="sendon" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= $date ?>" id="sendon">
                                                      <p style="color: red" id="send_on_alert"></p>
                                                   </div>
                                                   <div class="col-md-2" style="padding: 0; ">
                                                      <a class="btn btn-xs btn-info subbtn" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send On</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="col-md-12 reminderon" style="margin-top: 10px; display: none;">
                                                <div class="row">
                                                   <div class="col-md-4" style="padding: 0 10px; ">

                                                      <select class="form-control" name="reminderdate">
                                                         <option value="1">every hour</option>
                                                         <option value="2">every 2 hour</option>
                                                         <option value="3">every 3 hour</option>
                                                         <option value="4">every 4 hour</option>
                                                         <option value="5">every 5 hour</option>
                                                         <option value="6">every 6 hour</option>
                                                         <option value="24">every day</option>
                                                         <option value="48">every 2 day</option>
                                                         <option value="72">every 3 day</option>
                                                         <option value="96">every 4 day</option>
                                                         <option value="120">every 5 day</option>
                                                         <option value="144">every 6 day</option>
                                                         <option value="168">every week</option>
                                                      </select>
                                                      <p style="color: red" id="reminder_date_alert"></p>
                                                   </div>
                                                   <div class="col-md-4" style="padding: 0 10px; ">

                                                      <select class="form-control" name="remindertimes">
                                                         <option value="2">2times</option>
                                                         <option value="3">3times</option>
                                                         <option value="4">4times</option>
                                                         <option value="5">5times</option>
                                                         <option value="6">6times</option>
                                                         <option value="7">7times</option>
                                                         <option value="8">8times</option>
                                                         <option value="9">9times</option>
                                                         <option value="10">10times</option>
                                                      </select>
                                                      <p style="color: red" id="reminder_time_alert"></p>
                                                   </div>
                                                   <div class="col-md-4" style="padding: 0; ">
                                                      <a class="btn btn-xs btn-info subbtn" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Save</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-12 text-center" style="padding: 15px">
                                             <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card"></span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <div class="tab-pane" id="sendCard" style="border-top:1px solid #cecece;padding-top:10px;">
                              <div class="row">
                                 <div class="col-md-12">

                                    <div class="col-md-12 padding-0 text-center" style="background-color: #da291c; color: #fff; padding: 5px; margin-bottom: 10px;">
                                       Card Categories
                                    </div>
                                    <ul class="nav nav-tabs nav-tabs-s2">
                                       <?php
                                          $c = 0;
                                              foreach($category as $value){
                                          ?>
                                       <li class="nav-item ">
                                          <a class="nav-link <?php if($c == 0){echo 'active';} ?>"  href="#card_<?= $value->category ?>" data-toggle="tab"><?= $value->category ?></a>
                                       </li>
                                       <?php
                                          $c++;
                                              }
                                          ?>
                                    </ul>
                                    <div class="tab-content">
                                       <?php
                                          $m = 0;
                                          foreach($category as $value){
                                          $imgs1 = \App\Http\Controllers\HomeController::get_card_image($value->category);
                                                  // print_r($imgs);
                                          ?>
                                       <div class="tab-pane  <?php if($m == 0){echo 'active';} ?>" id="card_<?= $value->category ?>">
                                          <div class="row padding-0 ">
                                             <?php
                                                foreach ($imgs1 as $img) { ?>
                                             <div class="col-md-2" style="margin-bottom: 10px;">
                                                <img src="<?php echo asset('public/images')?>/<?= $img->image ?>" alt="" class="img img-responsive card_img"  />
                                             </div>
                                             <?php } ?>
                                          </div>
                                       </div>
                                       <?php
                                          $m++;
                                              }
                                          ?>
                                    </div>

                  <form class="margin-bottom-0" method="POST" id="manage_client_card_submit_new" role="form" enctype="multipart/form-data">
                            @csrf
                                       <input type="hidden" id="img_path" name="img_path" val="">
                                       <input type="hidden" class="form-control malto" placeholder="To" name="malto" value="" />
                                       <div class="row gy-4">
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Subject" id="subject2" name="subject" required />
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="previmgsec" style="display: none;">
                                                <img src="" id="previmg" width="200px;">
                                                <input type="hidden" name="previmage" id="previmage" value="">
                                             </div>
                                             <div class="row">
                                                <div class="col-md-2 padding-0">
                                                   <label>Background: </label>
                                                </div>
                                                <div class="col-md-10 padding-0">
                                                   <ul style="list-style-type: none; padding: 0; margin: 0">
                                                      @foreach($colors as $color)
                                                      <li class="color-td" style="background-color: {{ $color->color }}; display: inline-block;"></li>
                                                      @endforeach
                                                   </ul>
                                                   <input type="hidden" name="bakg" id="bakg">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <textarea type="color" class="form-control summernote msgbox summernote2" rows="6" placeholder="Message"></textarea>
                                                <p style="color: red" id="textre1"></p>
                                             </div>
                                             <input type="hidden" name="forecolorr" value="#000000" id="forecolorr">
                                          </div>
                                          <div class="col-md-12">
                                             <div class="cardimgg" style="display: none;">
                                                <img src="" width="200px">
                                             </div>
                                          </div>
                                          <div class="col-md-12" style="">
                                        <div class="row">
                                            <div class="col-md-12 text-center email-btn" style="margin-top: 10px;">
                                                <div class="row">

                                                    <div class="col-md-3 text-center" style="padding: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info reminderonsub1" style="width: 100%;">Send With Reminders</a>
                                                    </div>
                                                    <div class="col-md-3 text-center" style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info prvbtn1" style="width: 100%;">Preview</a>
                                                    </div>
                                                    <div class="col-md-3 text-center" style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info subbtn1" style="width: 100%;">Send Now</a>
                                                    </div>
                                                    <div class="col-md-3 text-center" style="padding: 0px;">
                                                        <a class="btn btn-xs btn-info dateonsub1" style="width: 100%;">Send On</a>

                                                    </div>
                                                    <input type="submit" id="submit_button1" value="" style="display: none">
                                                </div>
                                            </div>
                                            <div class="col-md-12 dateon1" style="margin-top: 10px; display: none;">
                                                <div class="row">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <input type="date" name="sendon" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" id="sendon1">
                                                        <p style="color: red" id="send_on_alert1"></p>
                                                    </div>
                                                    <div class="col-md-2" style="padding: 0; ">
                                                        <a class="btn btn-xs btn-info subbtn1" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send On</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 reminderon1" style="margin-top: 10px; display: none;">
                                                <div class="row">

                                                    <div class="col-md-4" style="padding: 0 10px; ">

                                                        <select class="form-control" name="reminderdate">
                                                            <option value="1">every hour</option>
                                                            <option value="2">every 2 hour</option>
                                                            <option value="3">every 3 hour</option>
                                                            <option value="4">every 4 hour</option>
                                                            <option value="5">every 5 hour</option>
                                                            <option value="6">every 6 hour</option>
                                                        </select>
                                                        <p style="color: red" id="reminder_date_alert1"></p>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <!-- <input type="time" class="form-control" name="remindertime" id="remindertime"> -->
                                                        <select class="form-control" name="remindertime">
                                                            <option value="2">2times</option>
                                                            <option value="3">3times</option>
                                                            <option value="4">4times</option>
                                                            <option value="5">5times</option>
                                                            <option value="6">6times</option>
                                                        </select>
                                                        <p style="color: red" id="reminder_time_alert1"></p>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0; ">
                                                        <a class="btn btn-xs btn-info subbtn1" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send With Reminder</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center" style="padding: 15px">
                                        <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card1"></span>
                                    </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="sendVideos" style="border-top:1px solid #cecece;padding-top:10px;">
                              <div class="row">
                                 <div class="col-md-12">
                                 <form class="margin-bottom-0" method="POST" id="manage_client_video_submit_new" role="form" enctype="multipart/form-data">
                                   @csrf
                                       <div class="row gy-4">
                                          <input type="hidden" class="form-control malto" placeholder="To" name="malto" value="" />
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <input type="text" class="form-control" name="subject" id="subject3" placeholder="Subject" required />
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <div class="custom-file">
                                                   <input type="file" name="video" onchange="jQuery(this).next('input').val(this.value);"  accept="video/*" required class="custom-file-input" id="customFile">
                                                   <label class="custom-file-label" for="customFile">Upload Videos</label>
                                                </div>

                                             </div>
                                             <div class="row">
                                                <div class="col-md-2 padding-0">
                                                   <label>Background: </label>
                                                </div>
                                                <div class="col-md-10 padding-0">
                                                   <ul style="list-style-type: none; padding: 0; margin: 0">
                                                      @foreach($colors as $color)
                                                      <li class="color-td" style="background-color: {{ $color->color }}; display: inline-block;"></li>
                                                      @endforeach
                                                   </ul>
                                                   <input type="hidden" name="bakg" id="bakg">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <textarea type="color" class="form-control summernote msgbox summernote3" rows="6" placeholder="Message"></textarea>
                                                <p style="color: red" id="textre2"></p>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="col-md-12 text-center email-btn" style="margin-top: 10px;">
                                                <div class="row">

                                                    <div class="col-md-3 text-center" style="padding: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info reminderonsub2" style="width: 100%;">Send With Reminders</a>
                                                    </div>
                                                    <div class="col-md-3 text-center" style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info prvbtn2" style="width: 100%;">Preview</a>
                                                    </div>
                                                    <div class="col-md-3 text-center" style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info subbtn2" style="width: 100%;">Send Now</a>
                                                    </div>
                                                    <div class="col-md-3 text-center" style="padding: 0px;">
                                                        <a class="btn btn-xs btn-info dateonsub2" style="width: 100%;">Send On</a>

                                                    </div>
                                                    <input type="submit" id="submit_button2" value="" style="display: none">
                                                </div>
                                            </div>
                                        </div>
                                        <?php

                                        $date = date('Y-m-d');

                                        ?>
                                        <div class="col-md-12">
                                            <div class="col-md-12 dateon2" style="margin-top: 10px; display: none;">
                                                <div class="row">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <input type="date" name="sendon" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= $date ?>" id="sendon2">
                                                        <p style="color: red" id="send_on_alert2"></p>
                                                    </div>
                                                    <div class="col-md-2" style="padding: 0; ">
                                                        <a class="btn btn-xs btn-info subbtn2" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send On</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-12 reminderon2" style="margin-top: 10px; display: none;">
                                                <div class="row">

                                                    <div class="col-md-4" style="padding: 0 10px; ">

                                                        <select class="form-control" name="reminderdate">
                                                            <option value="1">every hour</option>
                                                            <option value="2">every 2 hour</option>
                                                            <option value="3">every 3 hour</option>
                                                            <option value="4">every 4 hour</option>
                                                            <option value="5">every 5 hour</option>
                                                            <option value="6">every 6 hour</option>
                                                        </select>
                                                        <p style="color: red" id="reminder_date_alert2"></p>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 10px; ">

                                                        <select class="form-control" name="remindertime">
                                                            <option value="2">2times</option>
                                                            <option value="3">3times</option>
                                                            <option value="4">4times</option>
                                                            <option value="5">5times</option>
                                                            <option value="6">6times</option>
                                                        </select>
                                                        <p style="color: red" id="reminder_time_alert2"></p>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0; ">
                                                        <a class="btn btn-xs btn-info subbtn2" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send With Reminder</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center" style="padding: 15px">
                                            <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card2"></span>
                                        </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- .card-inner-group -->
               </div>
               <!-- .card -->
            </div>
            <!-- .nk-block -->
         </div>
      </div>
   </div>
</div>
<div id="modall" class="modal fade" role='dialog'>
    <div class="modal-dialog modal-lg ">
        <div class="modal-content" style="background: white">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div  id= "modal-body"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@include('admin.report.genealogy_report_script');
@endsection