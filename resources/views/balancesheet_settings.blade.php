@extends('layouts.main') 
@section("content")

<!-- -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-40">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Settings / Financial Management</h4>
                    </div>
                </div>
                <div class="col-md-12 text-right margin-bottom-20">
                        <?php if($chat != "off"){ ?>
                            <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                        <?php } ?>
                        <?php if($tools != "off"){ ?>
                            <a href="{{ url('tools') }}" class="btn btn-md btn-info  margin-right-10">Tools</a>
                        <?php } ?>
                        <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info btn-sm margin-right-10">Calender meetings / tasks</a>
                        <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                    </div>
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
                        <li><a href="{{ url('financial_mgmt_setting') }}">Create Revenue Account</a></li>
                        <li><a href="{{ url('financial_mgmt_expenses_settings') }}">Create Expense Account</a></li>
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
                                <li><a href="{{ url('balancesheet_template2') }}">Balance Sheet Template 2</a></li>
                                <li class="active"><a href="{{ url('balancesheet_settings') }}">Balance Sheet Settings</a></li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="margin-top-10" style="">
                                <div class="col-md-12 margin-bottom-40 margin-top-20 padding-0 shadow-boxx">
                                    <div class="col-md-12 padding-0 text-center margin-top-20">
                                        <h4 style="font-size: 30px; margin-bottom: 0px;">Balance Sheet Settings</h4>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="divider divider-center divider-short margin-top-10 margin-bottom-10">
                                        <!-- divider -->
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="col-md-6 margin-bottom-20">
                                       <div class="col-md-12">  
                                            <div class="col-md-12 padding-0 margin-top-20">
                                                <h4>List of assets accounts</h4>
                                                <table class="table margin-bottom-10" style="width: 100%;">
                                                    <tbody class="asset_account_body">
                                                      @if(count($balancesheet_assets) > 0)  
                                                      @foreach($balancesheet_assets as $template)
                                                        @php 
                                                        $count = \App\Http\Controllers\MainController::balance_account_existance($template->account_name);
                                                         $amount = \App\Http\Controllers\MainController::asset_account_price($template->account_name);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <label class="checkbox chk-sm">
                                                                    <input type="checkbox" value="{{$template->id}}" @if($count == 'exist') checked  data-id="{{$template->id}}" class="delete_account"  @endif />
                                                                    <i></i> {{$template->account_name}}
                                                                </label>
                                                                 <span class="input_field" style="float: right;margin-top:2px;font-size:12px;color:#404040">
                                                                         

                                                                        <input type="text" class="form-control" name="asset_amount" id="asset_amount_{{ $template->id }}" placeholder="Amount" value="{{$amount}}" style="width: 130px;height:28px!important;float: right;font-size: 10px;margin-top: -4px;" >
                                                                        
                                                                      </span>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                       
                                                    </tbody>
                                                </table>
                                                 <a href="javascript:void();" class="btn btn-md btn-info btn-sm margin-right-10 asset_account_sub">Save</a>
                                                <a href="javascript:void();" class="btn btn-md btn-info btn-sm margin-right-10" data-toggle="modal" data-target="#assetsModal">Add Accounts</a>
                                            </div>
                                            </div>
                                     <div class="col-md-12">        
                                       <div class="col-md-12 padding-0 margin-top-20">
                                                <h4>List of Non-Assets Accounts</h4>
                                                <table class="table margin-bottom-10" style="width: 100%;">
                                                    <tbody class="nonasset_account_body">
                                                      @if(count($balancesheet_nonassets) > 0)  
                                                      @foreach($balancesheet_nonassets as $template)
                                                        @php 
                                                        $count = \App\Http\Controllers\MainController::balance_account_existance($template->account_name);
                                                         $amount = \App\Http\Controllers\MainController::asset_account_price($template->account_name);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <label class="checkbox chk-sm">
                                                                    <input type="checkbox" value="{{$template->id}}" @if($count == 'exist') checked data-id="{{$template->id}}" class="delete_account"  @endif />
                                                                    <i></i> {{$template->account_name}}
                                                                </label>
                                                                 <span class="input_field" style="float: right;margin-top:2px;font-size:12px;color:#404040">
                                                                         

                                                                        <input type="text" class="form-control" name="nonasset_amount" id="nonasset_amount_{{ $template->id }}" placeholder="Amount" value="{{$amount}}" style="width: 130px;height:28px!important;float: right;font-size: 10px;margin-top: -4px;" >
                                                                        
                                                                      </span>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                       
                                                    </tbody>
                                                </table>
                                                 <a href="javascript:void();" class="btn btn-md btn-info btn-sm margin-right-10 non_asset_account_sub">Save</a>
                                                <a href="javascript:void();" class="btn btn-md btn-info btn-sm margin-right-10" data-toggle="modal" data-target="#nonassetsModal">Add Accounts</a>
                                      </div> 
                                      </div> 
                                    </div>

                                    <div class="col-md-6 margin-bottom-20">
                                        <div class="col-md-12">
                                            <div class="col-md-12 padding-0 margin-top-20">
                                                <h4>List of Liability Accounts</h4>
                                                <table class="table margin-bottom-10" style="width: 100%;">
                                                    <tbody class="liability_account_body">
                                                    @if(count($balancesheet_liability) > 0)  
                                                      @foreach($balancesheet_liability as $template)
                                                      @php 
                                                        $count = \App\Http\Controllers\MainController::balance_account_existance($template->account_name);
                                                         $amount = \App\Http\Controllers\MainController::asset_account_price($template->account_name);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <label class="checkbox chk-sm">
                                                                    <input type="checkbox" value="{{$template->id}}" @if($count == 'exist') checked data-id="{{$template->id}}" class="delete_account"   @endif />
                                                                    <i></i> {{$template->account_name}}
                                                                </label>
                                                                 <span class="input_field" style="float: right;margin-top:2px;font-size:12px;color:#404040">
                                                                         

                                                                        <input type="text" class="form-control" name="liab_amount" id="liab_amount_{{ $template->id }}" placeholder="Amount" value="{{$amount}}" style="width: 130px;height:28px!important;float: right;font-size: 10px;margin-top: -4px;" >
                                                                        
                                                                      </span>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                                 <a href="javascript:void();" class="btn btn-md btn-info btn-sm margin-right-10 liability_account_sub">Save</a>
                                                <a href="javascript:void();" class="btn btn-md btn-info btn-sm margin-right-10" data-toggle="modal" data-target="#liabilityModal">Add Accounts</a>
                                            </div>                                           
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-12 padding-0 margin-top-20">
                                                <h4>List of Non-Liability Accounts</h4>
                                                <table class="table margin-bottom-10" style="width: 100%;">
                                                    <tbody class="nonliability_account_body">
                                                    @if(count($balancesheet_nonliability) > 0)  
                                                      @foreach($balancesheet_nonliability as $template)
                                                      @php 
                                                        $count = \App\Http\Controllers\MainController::balance_account_existance($template->account_name);
                                                         $amount = \App\Http\Controllers\MainController::asset_account_price($template->account_name);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <label class="checkbox chk-sm">
                                                                    <input type="checkbox" value="{{$template->id}}" @if($count == 'exist') checked data-id="{{$template->id}}" class="delete_account"   @endif />
                                                                    <i></i> {{$template->account_name}}
                                                                </label>
                                                                 <span class="input_field" style="float: right;margin-top:2px;font-size:12px;color:#404040">
                                                                         

                                                                        <input type="text" class="form-control" name="nonliab_amount" id="nonliab_amount_{{ $template->id }}" placeholder="Amount" value="{{$amount}}" style="width: 130px;height:28px!important;float: right;font-size: 10px;margin-top: -4px;" >
                                                                        
                                                                      </span>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                                 <a href="javascript:void();" class="btn btn-md btn-info btn-sm margin-right-10 non_liability_account_sub">Save</a>
                                                <a href="javascript:void();" class="btn btn-md btn-info btn-sm margin-right-10" data-toggle="modal" data-target="#nonliabilityModal">Add Accounts</a>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-bottom-20">
                                        <div class="col-md-12">
                                            

                                            <div class="col-md-12 padding-0 margin-top-40">
                                                <h4>List of Equity Accounts</h4>
                                                <table class="table margin-bottom-10" style="width: 100%;">
                                                     <tbody class="equity_account_body">
                                                    @if(count($balancesheet_equity) > 0)  
                                                      @foreach($balancesheet_equity as $template)
                                                      @php 
                                                        $count = \App\Http\Controllers\MainController::balance_account_existance($template->account_name);
                                                        $amount = \App\Http\Controllers\MainController::asset_account_price($template->account_name); 
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <label class="checkbox chk-sm">
                                                                    <input type="checkbox" value="{{$template->id}}" @if($count == 'exist') checked data-id="{{$template->id}}" class="delete_account"  @endif />
                                                                    <i></i> {{$template->account_name}}
                                                                </label>
                                                              <span class="input_field" style="float: right;margin-top:2px;font-size:12px;color:#404040">
                                                                         

                                                                        <input type="text" class="form-control" name="equity_amount" id="equity_amount_{{ $template->id }}" placeholder="Amount" value="{{$amount}}" style="width: 130px;height:28px!important;float: right;font-size: 10px;margin-top: -4px;" >
                                                                        
                                                                      </span>   
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                                 <a href="javascript:void();" class="btn btn-md btn-info btn-sm margin-right-10 equity_account_sub">Save</a>
                                                <a href="javascript:void();" class="btn btn-md btn-info btn-sm margin-right-10" data-toggle="modal" data-target="#equityModal">Add Accounts</a>
                                            </div>
                                        </div>
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
</section>
<!-- / -->

<div id="assetsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Assets Account</h4>
            </div>
              <form action="{{ url('balancesheet_new_account_submit') }}" method="POST">
                @csrf
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="col-md-6">
                        <label>Account Name</label>
                        <input type="text" class="form-control" required="" name="account_name" id="asset_account_name" />
                        <input type="hidden"  name="main_category" value="assets" />
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Amount (optional)</label>
                                <input type="text" class="form-control" name="amount" id="new_amount" />
                            </div>
                        </div>
                    <div class="col-md-12 text-center margin-top-20">
                        <button type="submit" class="btn btn-info">Save changes</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <!-- Modal Footer -->
            </form>
        </div>
    </div>
</div>


<div id="nonassetsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Non-Assets Account</h4>
            </div>
              <form action="{{ url('balancesheet_new_account_submit') }}" method="POST">
                @csrf
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="col-md-6">
                        <label>Account Name</label>
                        <input type="text" class="form-control" required="" name="account_name" id="non_asset_account_name" />
                        <input type="hidden"  name="main_category" value="non_assets" />
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Amount (optional)</label>
                                <input type="text" class="form-control" name="amount" id="new_amount" />
                            </div>
                        </div>
                    <div class="col-md-12 text-center margin-top-20">
                        <button type="submit" class="btn btn-info">Save changes</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <!-- Modal Footer -->
            </form>
        </div>
    </div>
</div>

<div id="liabilityModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Liability Account</h4>
            </div>
            <form action="{{ url('balancesheet_new_account_submit') }}" method="POST">
                @csrf
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="col-md-6">
                        <label>Account Name</label>
                        <input type="text" class="form-control" required="" name="account_name" id="liability_account_name" />
                        <input type="hidden"  name="main_category" value="liability" />
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Amount (optional)</label>
                                <input type="text" class="form-control" name="amount" id="new_amount" />
                            </div>
                        </div>
                    <div class="col-md-12 text-center margin-top-20">
                        <button type="submit" class="btn btn-info">Save changes</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <!-- Modal Footer -->
            </form>
        </div>
    </div>
</div>


<div id="nonliabilityModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Non-Liability Account</h4>
            </div>
            <form action="{{ url('balancesheet_new_account_submit') }}" method="POST">
                @csrf
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="col-md-6">
                        <label>Account Name</label>
                        <input type="text" class="form-control" required="" name="account_name" id="non_liability_account_name" />
                        <input type="hidden"  name="main_category" value="non_liability" />
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Amount (optional)</label>
                                <input type="text" class="form-control" name="amount" id="new_amount" />
                            </div>
                        </div>
                    <div class="col-md-12 text-center margin-top-20">
                        <button type="submit" class="btn btn-info">Save changes</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <!-- Modal Footer -->
            </form>
        </div>
    </div>
</div>
<div id="equityModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Equity Account</h4>
            </div>
             <form action="{{ url('balancesheet_new_account_submit') }}" method="POST">
                @csrf
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="col-md-6">
                        <label>Account Name</label>
                        <input type="text" class="form-control" required="" name="account_name" id="equity_account_name" />
                        <input type="hidden"  name="main_category" value="equity" />
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Amount (optional)</label>
                                <input type="text" class="form-control" name="amount" id="new_amount" />
                            </div>
                        </div>s
                    <div class="col-md-12 text-center margin-top-20">
                        <button type="submit" class="btn btn-info">Save changes</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <!-- Modal Footer -->
            </form>
        </div>
    </div>
</div>


<script>

 $("#asset_account_name,#liability_account_name,#non_asset_account_name,#non_liability_account_name,#equity_account_name").on("change", function(){
        var val = $(this).val();
        $.ajax({
                url: "balancesheet_account_check",
                data: {'val':val, '_token': '<?= csrf_token() ?>' },
                type: 'POST',
                success: function(result) {
                    if(result == "exist"){
                        $("#asset_account_name").val("");
                        $("#liability_account_name").val("");
                        $("#equity_account_name").val("");
                        alert("This account is already exists.")
                    }
                }
            });
    });



$(document).on("click", ".delete_account", function () {
     if(confirm('Are you sure to remove this account'))
     {
     var id=$(this).attr('data-id');
     $.ajax({
            url: "delete_balancesheet_settings_account_post",
            data: {'id':id, '_token': '<?= csrf_token() ?>' },
            type: 'POST',
            success: function(result) {
                console.log(result);
                location.reload();
            }
        });
     }else{
        $(this).prop('checked',true);
     }
     
});


    $(".asset_account_sub").on("click", function(){
        var sub_arr = []; 
        var amount_arr = []; 

        $(".asset_account_body tr").each(function(){
            if ($(this).find("input").is(':checked')) {
                var id = $(this).find("input").val();
                sub_arr.push(id); 
                var amount =$("#asset_amount_"+id).val();
                 amount_arr.push(amount);              
            }
        });        
        if(sub_arr != ""){
            $.ajax({
                url: "balancesheet_template_submit",
                data: {'main_cat':'assets','sub_arr':JSON.stringify(sub_arr),'amount_arr':JSON.stringify(amount_arr),'_token': '<?= csrf_token() ?>' },
                type: 'POST',
                success: function(result) {
                    console.log(result);
                    location.reload();
                }
            }); 
        }
    });


    
    $(".non_asset_account_sub").on("click", function(){
        var sub_arr = []; 
        var amount_arr = []; 

        $(".nonasset_account_body tr").each(function(){
            if ($(this).find("input").is(':checked')) {
                var id = $(this).find("input").val();
                sub_arr.push(id); 
                var amount =$("#nonasset_amount_"+id).val();
                 amount_arr.push(amount);              
            }
        });        
        if(sub_arr != ""){
            $.ajax({
                url: "balancesheet_template_submit",
                data: {'main_cat':'non_assets','sub_arr':JSON.stringify(sub_arr),'amount_arr':JSON.stringify(amount_arr),'_token': '<?= csrf_token() ?>' },
                type: 'POST',
                success: function(result) {
                    console.log(result);
                    location.reload();
                }
            }); 
        }
    });

    $(".liability_account_sub").on("click", function(){
        var sub_arr = [];   
        var amount_arr = [];   

        $(".liability_account_body tr").each(function(){
            if ($(this).find("input").is(':checked')) {
                var id = $(this).find("input").val();
                sub_arr.push(id); 
                 var amount =$("#liab_amount_"+id).val();
                 amount_arr.push(amount);                
            }
        });        
        if(sub_arr != ""){
            $.ajax({
                url: "balancesheet_template_submit",
                data: {'main_cat':'liability','sub_arr':JSON.stringify(sub_arr),'amount_arr':JSON.stringify(amount_arr),'_token': '<?= csrf_token() ?>' },
                type: 'POST',
                success: function(result) {
                    console.log(result);
                    location.reload();
                }
            }); 
        }
    });


    $(".non_liability_account_sub").on("click", function(){
        var sub_arr = [];   
        var amount_arr = [];   

        $(".nonliability_account_body tr").each(function(){
            if ($(this).find("input").is(':checked')) {
                var id = $(this).find("input").val();
                sub_arr.push(id); 
                 var amount =$("#nonliab_amount_"+id).val();
                 amount_arr.push(amount);                
            }
        });       
        if(sub_arr != ""){
            $.ajax({
                url: "balancesheet_template_submit",
                data: {'main_cat':'non_liability','sub_arr':JSON.stringify(sub_arr),'amount_arr':JSON.stringify(amount_arr),'_token': '<?= csrf_token() ?>' },
                type: 'POST',
                success: function(result) {
                    console.log(result);
                    location.reload();
                }
            }); 
        }
    });
    $(".equity_account_sub").on("click", function(){
        var sub_arr = [];       
        var amount_arr = [];       
        $(".equity_account_body tr").each(function(){
            if ($(this).find("input").is(':checked')) {
                var id = $(this).find("input").val();
                sub_arr.push(id); 
                 var amount =$("#equity_amount_"+id).val();
                 amount_arr.push(amount);                
            }
        });        
        if(sub_arr != ""){
            $.ajax({
                url: "balancesheet_template_submit",
                data: {'main_cat':'equity','sub_arr':JSON.stringify(sub_arr),'amount_arr':JSON.stringify(amount_arr),'_token': '<?= csrf_token() ?>' },
                type: 'POST',
                success: function(result) {
                    console.log(result);
                    location.reload();
                }
            }); 
        }
    });
</script>

@endsection