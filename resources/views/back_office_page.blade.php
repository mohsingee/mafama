@extends('layouts.main') 
@section("content")
<style type="text/css">

</style>
<link href="{{ asset('public/genealogy/tree_new.css') }}" rel="stylesheet">
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Back Office</h4>
                    </div>
                </div>
                <div class="col-md-12 text-right margin-bottom-20">
                    <?php if($chat != "off"){ ?>
                        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                    <?php } ?>
                    <?php if($tools != "off"){ ?>
                        <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                    <?php } ?>
                    <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>
                    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                </div>
  <ul class="nav nav-tabs nav-button-tabs nav-justified">
                    <li class="active"><a href="#qualification" data-toggle="tab">Qualification Table</a></li>
                    <li><a href="#genealogy " data-toggle="tab">Genealogy Report </a></li>
                    <li><a href="#commission " data-toggle="tab">Commission Report </a></li>

                </ul>
            <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                <div class="tab-pane fade in active" id="qualification">
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
                  <div  class="tab-pane fade in" id="genealogy">
                      <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">

                                 <div class="row">
                            <div class="col-md-12">
                                <table style="width:100%">
                                    <tr>
                                        <td width="20%" class="ntest1 back-to-home" style="display:none">
                                            <a href="javascript:void(0);" class="back-btn-c1 ntest return-btn" onclick="return get_child(<?=Auth::user()->id;?>,<?=Auth::user()->id;?>)" ><i class="fa fa-angle-left btn-g"></i> Back </a>
                                        <span ></span>
                                        </td>
                                        <td width="20%" class="ntest1">
                                            <a href="javascript:void(0);" class="back-btn-c1 ntest" onclick="return get_child(<?=Auth::user()->id;?>,<?=Auth::user()->id;?>)" ><i class="fa fa-home btn-g"></i> Home </a>

                                        </td>
                                        <td width="20%" align="left"><span class="ntest">Jump to user</span>  </td>
                                        <td width="20%"><input type="text" class="form-control" id="sponserid" placeholder="Insert User Id"></td>
                                        <td>
                                             <button class="bbn" id="SearchID"><i class="fa fa-search btn-g"></i></button>
                                        </td>
                                    </tr>
                                </table>
                            </div>


                        </div>

                         <div class="row">


                         <div class="col-sm-12"  >

                            <hr>
                             <div class="pan-container" >
                              <ul class="tree" id="genealogy_id">
                                           @if(!empty($networks))
                                           {!! $networks !!}
                                            @endif

                                  </ul>
                               <div class="clearfix"></div>
                            </div>


                         </div>
                        </div>


                            </div>
                        </div>
                    </div>
                </div>
                  </div>
                <div  class="tab-pane fade in" id="commission">

                        <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Datetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @if(Auth::check())
                                   @php
                                   $i=1
                                   @endphp
                                   @if($transactions->count() >0 )
                                    @foreach($transactions as $trans)
                                    <tr>
                                       <td>{{$i++}}.</td>
                                       <td><b>$</b>{{$trans->amount}}</td>
                                       <td>{!! $trans->description !!}</td>
                                       <td>{{date_formate($trans->created_at)}}</td>
                                    </tr>
                                    @endforeach
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
            </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script src="{{ asset('public/genealogy/treeview.js') }}"></script>

@endsection