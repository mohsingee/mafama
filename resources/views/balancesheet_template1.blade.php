@extends('layouts.main') 
@section("content")
<style type="text/css">
   .btnxs {
   height: 26px!important;
   }
</style>
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
                        <li class="active"><a href="{{ url('balancesheet_template1') }}">Balance Sheet Template 1</a></li>
                        <li><a href="{{ url('balancesheet_template2') }}">Balance Sheet Template 2</a></li>
                        <li><a href="{{ url('balancesheet_settings') }}">Balance Sheet Settings</a></li>
                     </ul>
                  </div>
                  <div class="col-md-12">
                     <div class="tab-content margin-top-10" style="">
                        <div class="col-md-12 margin-bottom-40 margin-top-20 padding-0">
                           <div class="col-md-12 padding-0 text-center margin-top-20">
                              <h4 style="font-size: 30px; margin-bottom: 0px;">Balance Sheet</h4>
                           </div>
                           <div class="clearfix"></div>
                           <div class="divider divider-center divider-short margin-top-10 margin-bottom-10">
                              <!-- divider -->
                              <i class="fa fa-star-o"></i>
                           </div>
                           <div class="col-md-6 margin-bottom-20">
                              <div class="col-md-12">
                                 <div class="col-md-12 padding-0 margin-top-20">
                                    <h4>Assets</h4>
                                    <table class="table margin-bottom-10" style="width: 100%;">
                                       <tbody>
                                          <tr>
                                             <td colspan="2" style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;"><b>Current Assets : </b></td>
                                          </tr>
                                          <form  action="{{ url('add_balancesheet_for_current_assets') }}" id="form1" method="POST" role="form" enctype="multipart/form-data">
                                             @csrf      
                                             @php 
                                             $i=0;
                                             $current_asset= $current_non_asset=$total_asset=0;    
                                             @endphp      
                                             @if(count($balancesheet_assets) > 0) 
                                             @foreach($balancesheet_assets as $asset) 
                                             
                                             <?php
                                                $raw_data1='';
                                                $amount_value=0;
                                                if($asset->account_name=='Account Receivable')
                                                {
                                                $amount = $receivable_amount; 
                                                $amount1 =str_replace('-','',$amount);
                                                $amount_value= $amount1;
                                                $current_asset +=$amount1;
                                                }else{
                                                $amount1=0;   
                                                if(!empty($record1))  
                                                { 
                                                $raw_data1=json_decode($record1->raw_data,true);
                                                 if(array_key_exists($i,$raw_data1)){
                                                   $amount_value=$raw_data1 ? $raw_data1[$i][$asset->id]:$amount1;
                                                  $current_asset += $amount_value;
                                                 }
                                               
                                                } 
                                               }
                                                ?>
                                             <tr>
                                                <td>{{$asset->account_name}} :</td>
                                                <td >
                                                   <span class="input_field" style="float: right;margin-top:0px;font-size:12px;color:#404040">
                                                      <!--  <label >Default Amount  </label> --> 
                                                      <input type="number" class="form-control" name="asset_amount[{{$asset->id}}][]" id="rev_amount" placeholder="Amount" value="{{$amount_value}}" style="width: 130px;height:28px!important;float: right;font-size: 10px;margin-top: -4px;@if($amount1>0) color:red;  @endif " @if($amount1>0) readonly @endif ">
                                                   </span>
                                                </td>
                                             </tr>
                                             @php
                                              $i++;
                                             @endphp
                                             @endforeach  
                                             @endif 
                                             <tr class="total-tr">
                                                <td><b>Total Current Assets : </b></td>
                                                <td><b>{{ $current_asset }}</b></td>
                                             </tr>
                                             <tr>
                                                <td colspan="2" class="text-center">
                                                   <input type="hidden" name="id" value="{{$record1 ?$record1->id:''}}">
                                                   <div class="pull-right">                     
                                                      <button type="submit" class="btn  btn-info btn-xs btnxs">Save</button>
                                                      @if(!empty($raw_data1))
                                                      <button type="button" id="update_form1" class="btn  btn-info btn-xs btnxs  ">Edit</button>
                                                      @endif
                                                   </div>
                                                </td>
                                             </tr>
                                          </form>
                                          <form action="{{ url('add_balancesheet_for_noncurrent_assets') }}" id="form2" method="POST" role="form" enctype="multipart/form-data">
                                             @csrf                                                          
                                             <tr>
                                                <td colspan="2" style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;"><b>Non-current Assets : </b></td>
                                             </tr>
                                             @php
                                             $j=0;
                                             @endphp
                                             @if(count($balancesheet_nonassets) > 0) 
                                             @foreach($balancesheet_nonassets as $asset) 
                                             @php
                                             $amount = \App\Http\Controllers\MainController::balance_account_price($asset->account_name);
                                            
                                             @endphp
                                             <?php
                                                $amount_value2=0;
                                                $raw_data2='';
                                                if(!empty($record2))  
                                                {
                                                $raw_data2=json_decode($record2->raw_data,true);
                                                
                                                 if(array_key_exists($j,$raw_data2)){
                                                   $amount_value2=$raw_data2 ? $raw_data2[$j][$asset->id]:0;
                                                  $current_non_asset += $amount_value2;
                                                 }
                                               
                                                } ?>
                                             <tr>
                                                <td>{{$asset->account_name}} :</td>
                                                <td >
                                                   <span class="input_field" style="float: right;margin-top:0px;font-size:12px;color:#404040">
                                                      <!--  <label >Default Amount  </label> --> 
                                                      <input type="number" class="form-control" name="amount[{{$asset->id}}][]" id="rev_amount" placeholder="Amount" value="{{$amount_value2}}" style="width: 130px;height:28px!important;float: right;font-size: 10px;margin-top: -4px;" >
                                                   </span>
                                                </td>
                                             </tr>
                                             @php
                                             $j++;
                                             @endphp
                                             @endforeach  
                                             @endif 
                                             <tr class="total-tr">
                                                <td><b>Total Non-current Assets : </b></td>
                                                <td><b>{{ $current_non_asset }}</b></td>
                                             </tr>
                                             <tr>
                                              <?php
                                                $total_assets=$current_asset+$current_non_asset;
                                               ?>
                                                <td style="text-align: left;"><b>Total Assets : </b></td>
                                                <td><b>{{$total_assets}}</b></td>
                                             </tr>
                                             <tr>
                                                <td colspan="2" class="text-center">
                                                   <input type="hidden" name="id" value="{{$record2 ?$record2->id:''}}">                                
                                                   <div class="pull-right">                     
                                                      <button type="submit" class="btn  btn-info btn-xs btnxs">Save</button>
                                                      @if(!empty($raw_data2))
                                                      <button type="button" id="update_form2" class="btn  btn-info btn-xs btnxs  ">Edit</button>
                                                      @endif
                                                   </div>
                                                </td>
                                             </tr>
                                          </form>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 margin-bottom-20">
                              <div class="col-md-12">
                                 <div class="col-md-12 padding-0 margin-top-20">
                                    <h4>Liabilities & Equity</h4>
                                    <table class="table margin-bottom-10" style="width: 100%;">
                                       <tbody>
                                          <tr>
                                             <td colspan="2" style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;"><b>Liabilities : </b></td>
                                          </tr>
                                          <tr>
                                             <td colspan="2" style="text-align: left; color: #da291c;"><b>Current Liabilities : </b></td>
                                          </tr>
                                          <form action="{{ url('add_balancesheet_for_current_liability') }}" id="form3" method="POST" role="form" enctype="multipart/form-data">
                                             @csrf                                                     
                                             @php 
                                             $k=0;
                                             $current_liability= $current_non_liability=$total_liability=0;    
                                             @endphp
                                             @if(count($balancesheet_liability) > 0) 
                                             @foreach($balancesheet_liability as $asset) 
                                             @php
                                             $amount = \App\Http\Controllers\MainController::balance_account_price($asset->account_name);
                                            
                                             @endphp
                                             <?php
                                                $raw_data3='';
                                                $amount_value3=0;
                                                if(!empty($record3))  
                                                {
                                                $raw_data3=json_decode($record3->raw_data,true);
                                                 if(array_key_exists($k,$raw_data3)){
                                                   $amount_value3=$raw_data3 ? $raw_data3[$k][$asset->id]:0;
                                                  $current_liability += $amount_value3;
                                                 }
                                               
                                               
                                                } ?>
                                             <tr>
                                                <td>{{$asset->account_name}} :</td>
                                                <td >
                                                   <span class="input_field" style="float: right;margin-top:0px;font-size:12px;color:#404040">
                                                      <!--  <label >Default Amount  </label> --> 
                                                      <input type="number" class="form-control"  name="amount[{{$asset->id}}][]" id="rev_amount" placeholder="Amount" value="{{$amount_value3}}" style="width: 130px;height:28px!important;float: right;font-size: 10px;margin-top: -4px;" >
                                                   </span>
                                                </td>
                                             </tr>
                                             @php
                                             $k++;
                                             @endphp
                                             @endforeach  
                                             @endif 
                                             <tr class="total-tr">
                                                <td><b>Total Current Liabilities : </b></td>
                                                <td><b>{{$current_liability}}</b></td>
                                             </tr>
                                             <tr>
                                             <tr>
                                                <td colspan="2" class="text-center">
                                                   <input type="hidden" name="id" value="{{$record3 ?$record3->id:''}}">                          
                                                   <div class="pull-right">                     
                                                      <button type="submit" class="btn  btn-info btn-xs btnxs">Save</button>
                                                      @if(!empty($raw_data3))
                                                      <button type="button" id="update_form3" class="btn  btn-info btn-xs btnxs  ">Edit</button>
                                                      @endif
                                                   </div>
                                                </td>
                                             </tr>
                                          </form>
                                          <td colspan="2" style="text-align: left; color: #da291c;"><b>Non-current Liabilities : </b></td>
                                          </tr>
                                          <form action="{{ url('add_balancesheet_for_noncurrent_liability') }}" id="form4" method="POST" role="form" enctype="multipart/form-data">
                                             @csrf                                      
                                              @php  
                                             $l=0;        
                                             @endphp          
                                             @if(count($balancesheet_nonliability) > 0) 
                                             @foreach($balancesheet_nonliability as $asset) 
                                             @php
                                             $amount = \App\Http\Controllers\MainController::balance_account_price($asset->account_name);
                                         
                                             @endphp
                                             <?php
                                                $raw_data4='';
                                                $amount_value4=0;
                                                if(!empty($record4))  
                                                {
                                                $raw_data4=json_decode($record4->raw_data,true);
                                                 if(array_key_exists($l,$raw_data4)){
                                                   $amount_value4=$raw_data4 ? $raw_data4[$l][$asset->id]:0;
                                                  $current_non_liability += $amount_value4;
                                                 }
                                               
                                                  
                                                } ?>
                                             <tr>
                                                <td>{{$asset->account_name}} :</td>
                                                <td >
                                                   <span class="input_field" style="float: right;margin-top:0px;font-size:12px;color:#404040">
                                                      <!--  <label >Default Amount  </label> --> 
                                                      <input type="number" class="form-control"  name="amount[{{$asset->id}}][]" id="rev_amount" placeholder="Amount" value="{{$raw_data4 ? $raw_data4[$l][$asset->id]:0}}" style="width: 130px;height:28px!important;float: right;font-size: 10px;margin-top: -4px;" >
                                                   </span>
                                                </td>
                                             </tr>
                                             @php  
                                             $l++;
                                             @endphp 
                                             @endforeach
                                             @endif

                                             <?php
                                             $total_liability=$current_non_liability+$current_liability;
                                             ?>
                                             <tr class="total-tr">
                                                <td><b>Total Non-current Liabilities : </b></td>
                                                <td><b>{{$current_non_liability}}</b></td>
                                             </tr>
                                             <tr class="total-tr">
                                                <td style="text-align: left;"><b>Total Liabilities : </b></td>
                                                <td><b>{{$total_liability }}</b></td>
                                             </tr>
                                             <tr>
                                                <td colspan="2" class="text-center">
                                                   <input type="hidden" name="id" value="{{$record4 ?$record4->id:''}}">   
                                                   <div class="pull-right">                     
                                                      <button type="submit" class="btn  btn-info btn-xs btnxs">Save</button>
                                                      @if(!empty($record4))
                                                      <button type="button" id="update_form4" class="btn  btn-info btn-xs btnxs  ">Edit</button>
                                                      @endif
                                                   </div>
                                                </td>
                                             </tr>
                                          </form>
                                          <tr>
                                             <td colspan="2" style="text-align: left; color: #da291c; padding-top: 20px; padding-bottom: 20px;"><b>Equity : </b></td>
                                          </tr>
                                          <form action="{{ url('add_balancesheet_for_equity') }}" id="form5" method="POST" role="form" enctype="multipart/form-data">
                                             @csrf                                                     
                                              @php 
                                             $total_equity_liability=0;  
                                             $total_equity=0;  

                                             $m=0;  
                                             @endphp   
                                             @if(count($balancesheet_equity) > 0) 
                                             @foreach($balancesheet_equity as $asset) 
                                             @php
                                             $amount = \App\Http\Controllers\MainController::balance_account_price($asset->account_name);
                                            
                                             @endphp
                                             <?php
                                                $raw_data5='';
                                                $amount_value5=0;
                                                if(!empty($record5))  
                                                {
                                                $raw_data5=json_decode($record5->raw_data,true);
                                                if(array_key_exists($m,$raw_data5)){
                                                   $amount_value5=$raw_data5 ? $raw_data5[$m][$asset->id]:0;
                                                  $total_equity += $amount_value5;
                                                 }
                                                
                                                }
                                                  

                                                 ?>
                                             <tr>
                                                <td>{{$asset->account_name}} :</td>
                                                <td >
                                                   <span class="input_field" style="float: right;margin-top:0px;font-size:12px;color:#404040">
                                                      <!--  <label >Default Amount  </label> --> 
                                                      <input type="number" class="form-control"  name="amount[{{$asset->id}}][]" id="rev_amount" placeholder="Amount" value="{{$amount_value5}}" style="width: 130px;height:28px!important;float: right;font-size: 10px;margin-top: -4px;"  >
                                                   </span>
                                                </td>
                                             </tr>
                                             @php
                                             $m++;
                                             @endphp
                                             @endforeach  
                                             @endif 
                                             <tr class="total-tr">
                                                <td><b>Total Equity : </b></td>
                                                <td><b>{{$total_equity}}</b></td>
                                             </tr>
                                             <?php
                                             $total_equity_liability=$total_liability+$total_equity;
                                             ?>
                                             <tr>
                                                <td style="text-align: left;"><b>Total Liabilities & Equity : </b></td>
                                                <td><b>{{ $total_equity_liability}}</b></td>
                                             </tr>
                                             <tr>
                                                <td colspan="2" class="text-center">
                                                   <input type="hidden" name="id" value="{{$record5 ?$record5->id:''}}">  
                                                   <div class="pull-right">                     
                                                      <button type="submit" class="btn  btn-info btn-xs btnxs">Save</button>
                                                      @if(!empty($raw_data5))
                                                      <button type="button" id="update_form5" class="btn  btn-info btn-xs btnxs  ">Edit</button>
                                                      @endif
                                                   </div>
                                                </td>
                                             </tr>
                                          </form>
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
<script type="text/javascript">
   $("#update_form1").click(function(e)
   {    e.preventDefault();    
         $elm=$(this);
           $elm.hide();  
           $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
           $form=$("#form1");
           var formData =  $('#form1').serializeArray();
           
           $.ajax({
               method: 'POST',
               url: "{{ url('update_balancesheet_for_current_assets') }}",
               data:formData,
               // cache:false,
               // contentType: false,
               // processData: false,
               success: function(resp) {
                $(".submit-loading").remove();
                 $elm.show();
                 alert('Amount updated successfully.');
                 window.location.reload();
                 // resp=JSON.parse(resp);
                 // if(resp.valid==1){  }    
               },
               error: function(data) {
               }
           });  
   });
   
   
   $("#update_form2").click(function(e)
   {    e.preventDefault();    
         $elm=$(this);
           $elm.hide();  
           $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
           $form=$("#form2");
           var formData =  $('#form2').serializeArray();
           
           $.ajax({
               method: 'POST',
               url: "{{ url('update_balancesheet_for_noncurrent_assets') }}",
               data:formData,
               success: function(resp) {
                $(".submit-loading").remove();
                 $elm.show();
                 alert('Amount updated successfully.');
                 window.location.reload();
                 
               },
               error: function(data) {
               }
           });  
   });
   
   $("#update_form3").click(function(e)
   {    e.preventDefault();    
         $elm=$(this);
           $elm.hide();  
           $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
           $form=$("#form3");
           var formData =  $('#form3').serializeArray();
           
           $.ajax({
               method: 'POST',
               url: "{{ url('update_balancesheet_for_current_liability') }}",
               data:formData,
               success: function(resp) {
                $(".submit-loading").remove();
                 $elm.show();
                 alert('Amount updated successfully.');
                 window.location.reload();
                 
               },
               error: function(data) {
               }
           });  
   });
   $("#update_form4").click(function(e)
   {    e.preventDefault();    
         $elm=$(this);
           $elm.hide();  
           $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
           $form=$("#form4");
           var formData =  $('#form4').serializeArray();
           
           $.ajax({
               method: 'POST',
               url: "{{ url('update_balancesheet_for_noncurrent_liability') }}",
               data:formData,
               success: function(resp) {
                $(".submit-loading").remove();
                 $elm.show();
                 alert('Amount updated successfully.');
                 window.location.reload();
                 
               },
               error: function(data) {
               }
           });  
   });
   $("#update_form5").click(function(e)
   {    e.preventDefault();    
         $elm=$(this);
           $elm.hide();  
           $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
           $form=$("#form5");
           var formData =  $('#form5').serializeArray();
           
           $.ajax({
               method: 'POST',
               url: "{{ url('update_balancesheet_for_equity') }}",
               data:formData,
               success: function(resp) {
                $(".submit-loading").remove();
                 $elm.show();
                 alert('Amount updated successfully.');
                 window.location.reload();
                 
               },
               error: function(data) {
               }
           });  
   });
   
</script>
@endsection