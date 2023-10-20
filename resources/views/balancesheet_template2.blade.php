@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Settings / Financial Management</h4>
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
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
                        <li><a href="#tab1" data-toggle="tab">Create Revenue Account</a></li>
                        <li><a href="{{ url('financial_mgmt_setting') }}#tab2">Create Expense Account</a></li>
                        <li><a href="{{ url('financial_mgmt_invoice_setup') }}">Invoice Setup</a></li>
                        <li class="active"><a href="{{ url('balancesheet_template1') }}">Balance Sheet</a></li>
                        <li><a href="{{ url('financial_mgmt_choose_template') }}">Activate Accounts</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="col-md-12 tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px;">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li><a href="{{ url('balancesheet_template1') }}">Balance Sheet Template 1</a></li>
                                <li class="active"><a href="{{ url('balancesheet_template2') }}">Balance Sheet Template 2</a></li>
                                <li><a href="{{ url('balancesheet_settings') }}">Balance Sheet Settings</a></li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="tab-content margin-top-10" style="">
                                <div class="col-md-12 margin-bottom-40 margin-top-20">
                                    <div class="col-md-12 padding-0 text-center margin-top-20">
                                        <h4 style="font-size: 30px; margin-bottom: 0px;">Balance Sheet</h4>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="divider divider-center divider-short margin-top-10 margin-bottom-10">
                                        <!-- divider -->
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="col-md-12 margin-bottom-20">
                                        <div class="col-md-12">


                                            <div class="col-md-12 padding-0 margin-top-20">
                                                <table class="table margin-bottom-10" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            @if(count($years))
                                                            @foreach($years as $year)
                                                            <th> {{$year->created_at }} </th>
                                                            @endforeach
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="5" style="text-align: left; color: #da291c; font-size: 24px; padding-top: 20px; padding-bottom: 20px;"><b>Assets : </b></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5" style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;"><b>Current Assets : </b></td>
                                                        </tr>
                                            @php  
                                             $asset_total=array();          
                                             $nonasset_total=array();          
                                             $liability_total=array();          
                                             $liability_total_sum=array();          
                                             $notliability_total=array();          
                                             $equity_total=array();          
                                            @endphp            
                                            @if(count($balancesheet_assets) > 0) 
                                            @php
                                            $i=$asset_sum=0;
                                           
                                            @endphp
                                            @foreach($balancesheet_assets as $asset) 
                                             
                                             <tr>
                                                <td>{{$asset->account_name}} :</td>
                                                 @if(count($years))
                                                
                                                    @foreach($years as $year)
                                                   @php 
                                                    $total = \App\Balance_info::get_total_assest_amount($uid,$i,$asset->id, $year->created_at);
                                                   
                                                   @endphp 
                                                    <td>{{$total}}</td>
                                                   
                                                    @endforeach
                                                 @endif
                                                
                                             </tr>
                                            @php
                                            $i++;
                                            @endphp
                                             @endforeach  
                                             @endif 
                                                     
                                                        <tr class="total-tr">
                                                            <td><b>Total Current Assets : </b>   
                                                      
                                                            </td>
                                                             @if(count($years))
                                                                @foreach($years as $year)
                                                            @php    
                                                            $total = \App\Balance_info::get_sum_of_assetsheet($uid, $year->created_at);
                                                            $asset_total[]=$total;
                                                            @endphp 
                                                                <td><b>{{ $total }}</b></td>
                                                                @endforeach
                                                             @endif
                                                        </tr>

                                                        <tr>
                                                            <td colspan="5" style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;"><b>Non-current Assets : </b></td>
                                                        </tr>
                                        @if(count($balancesheet_nonassets) > 0) 
                                        @php
                                        $i=0;
                                        @endphp
                                             @foreach($balancesheet_nonassets as $asset) 
                                             
                                              <tr>
                                                <td>{{$asset->account_name}} :</td>
                                                 @if(count($years))
                                                    @foreach($years as $year)
                                                     @php 
                                                    $total = \App\Balance_info::get_total_nonassest_amount($uid,$i,$asset->id, $year->created_at);
                                                   
                                                   @endphp 
                                                    <td>{{$total}}</td>
                                                    @endforeach
                                                 @endif
                                                
                                             </tr>
                                             @php
                                             $i++;
                                             @endphp
                                            @endforeach
                                        @endif                
                                                        <tr class="total-tr">
                                                            <td><b>Total Non-current Assets : </b></td>
                                                              @if(count($years))
                                                                @foreach($years as $year)
                                                              @php  
                                                               $total = \App\Balance_info::get_sum_of_nonassetsheet($uid, $year->created_at);
                                                                $nonasset_total[]=$total;
                                                                @endphp 
                                                                <td><b>{{ $total }}</b></td>
                                                                @endforeach
                                                             @endif
                                                        </tr>

                                                        <tr style="background-color: #aee9f3; color: #041777;">
                                                            <td style="text-align: left;"><b>Total Assets : </b></td>

                                                               @if(count($asset_total) >0 )
                                                               @php
                                                               $k=0;
                                                               @endphp
                                                                @foreach($asset_total as $sum)
                                                                @php
                                                                $sum_total=$sum+$nonasset_total[$k];
                                                                @endphp
                                                                <td><b>{{$sum_total}}</b></td>
                                                                 @php
                                                                $k++;
                                                                @endphp
                                                                @endforeach
                                                             @endif
                                                        </tr>

                                                        <tr>
                                                            <td colspan="5" style="text-align: left; color: #da291c; font-size: 24px; padding-top: 20px; padding-bottom: 20px;"><b>Liabilities & Equity </b></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5" style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;"><b>Liabilities : </b></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5" style="text-align: left; color: #da291c;"><b>Current Liabilities : </b></td>
                                                        </tr>
                                                     @if(count($balancesheet_liability) > 0)
                                                     @php 
                                                     $j=0;
                                                     @endphp 
                                                       @foreach($balancesheet_liability as $asset) 
                                             
                                                         <tr>
                                                            <td>{{$asset->account_name}} :</td>
                                                             @if(count($years))
                                                              @foreach($years as $year)
                                                    @php 
                                                    $total = \App\Balance_info::get_total_liability_amount($uid,$j,$asset->id, $year->created_at);
                                                   @endphp 
                                                    <td>{{$total}}</td>
                                                   
                                                                @endforeach
                                                             @endif
                                                            
                                                         </tr>
                                                          @php
                                                    $j++;
                                                    @endphp
                                                          @endforeach
                                                         @endif  
                                                        <tr class="total-tr">
                                                            <td><b>Total Current Liabilities : </b></td>
                                                               @if(count($years))
                                                                @foreach($years as $year)
                                                             @php  
                                                               $total = \App\Balance_info::get_sum_of_liabilitysheet($uid, $year->created_at);
                                                               $liability_total[]=$total;
                                                                @endphp 
                                                                <td><b>{{ $total }}</b></td>
                                                                @endforeach
                                                             @endif
                                                        </tr>

                                                        <tr>
                                                            <td colspan="5" style="text-align: left; color: #da291c;"><b>Non-current Liabilities : </b></td>
                                                        </tr>
                                            @if(count($balancesheet_nonliability) > 0) 
                                            @php
                                            $i=0;
                                            @endphp
                                             @foreach($balancesheet_nonliability as $asset) 
                                                <tr>
                                                    <td>{{$asset->account_name}} :</td>
                                                     @if(count($years))
                                                        @foreach($years as $year)
                                                       @php 
                                                    $total = \App\Balance_info::get_total_nonliability_amount($uid,$i,$asset->id, $year->created_at);
                                                   @endphp 
                                                    <td>{{$total}}</td>
                                                        @endforeach
                                                     @endif
                                                    
                                                 </tr>
                                                 @php
                                                 $i++;
                                                 @endphp
                                                          @endforeach
                                                        @endif  
                                                        <tr class="total-tr">
                                                            <td><b>Total Non-current Liabilities : </b></td>
                                                              @if(count($years))
                                                                @foreach($years as $year)
                                                                 @php  
                                                               $total = \App\Balance_info::get_sum_of_nonliabilitysheet($uid, $year->created_at);
                                                               $nonliability_total[]=$total;
                                                                @endphp 
                                                                <td><b>{{ $total }}</b></td>
                                                                @endforeach
                                                             @endif
                                                        </tr>
                                                        <tr class="total-tr">
                                                            <td style="text-align: left;"><b>Total Liabilities : </b></td>
                                                             @if(count($liability_total) >0 )
                                                               @php
                                                               $k=0;
                                                               @endphp
                                                                @foreach($liability_total as $sum)
                                                                @php
                                                                $sum_total=$sum+$nonliability_total[$k];
                                                                $liability_total_sum[]=$sum_total;
                                                                @endphp
                                                                <td><b>{{$sum_total}}</b></td>
                                                                 @php
                                                                $k++;
                                                                @endphp
                                                                @endforeach
                                                             @endif
                                                        </tr>

                                                        <tr>
                                                            <td colspan="5" style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;"><b>Equity : </b></td>
                                                        </tr>
                                                 @if(count($balancesheet_equity) > 0) 
                                                 @php
                                                 $i=0;
                                                 @endphp
                                                   @foreach($balancesheet_equity as $asset) 
                                                       <tr>
                                                        <td>{{$asset->account_name}} :</td>
                                                         @if(count($years))
                                                            @foreach($years as $year)
                                                                @php 
                                                    $total = \App\Balance_info::get_total_equity_amount($uid,$i,$asset->id, $year->created_at);
                                                   @endphp 
                                                    <td>{{$total}}</td>
                                                            @endforeach
                                                         @endif
                                                        
                                                     </tr>
                                                      @php
                                                 $i++;
                                                 @endphp
                                                        @endforeach
                                                     @endif  
                                                        <tr class="total-tr">
                                                            <td><b>Total Equity : </b></td>
                                                            @if(count($years))
                                                                @foreach($years as $year)
                                                                  @php  
                                                               $total = \App\Balance_info::get_sum_of_equitysheet($uid, $year->created_at);
                                                               $equity_total[]=$total;
                                                                @endphp 
                                                                <td><b>{{ $total }}</b></td>
                                                                @endforeach
                                                             @endif
                                                
                                                        </tr>
                                                       

                                                        <tr style="background-color: #aee9f3; color: #041777;">
                                                            <td style="text-align: left;"><b>Total Liabilities & Equity : </b></td>
                                                             @if(count($equity_total) >0 )
                                                               @php
                                                               $k=0;
                                                               @endphp
                                                                @foreach($equity_total as $sum)
                                                                @php
                                                                $sum_total=$sum+$liability_total_sum[$k];
                                                               
                                                                @endphp
                                                                <td><b>{{$sum_total}}</b></td>
                                                                 @php
                                                                $k++;
                                                                @endphp
                                                                @endforeach
                                                             @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection