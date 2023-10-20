@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-20">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Settings / Financial Management</h4>
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
                    <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                        <li><a href="{{ url('financial_mgmt_setting') }}">Create Revenue Account</a></li>
                        <li><a href="{{ url('financial_mgmt_expenses_settings') }}">Create Expense Account</a></li>
                        <li class="active"><a href="{{ url('financial_mgmt_invoice_setup') }}">Invoice Setup</a></li>
                        <li><a href="{{ url('balancesheet_template1') }}">Balance Sheet</a></li>
                        <li><a href="{{ url('financial_mgmt_choose_template') }}">Activate Accounts</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        
                        <div class="tab-pane fade in active" id="tab3">
                           
                        <form action="{{ url('update_financial_invoice_setup') }}" method="POST"  enctype="multipart/form-data"> 
                              @csrf        
                                <div class="col-md-12" style="border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                    <div class="row" style="margin: 0px;">
                                        <h5 class="text-center">To Setup your Invoice, answer the following two questions.</h5>
                                        <div class="col-md-12">
                                            <div class="form-group" style="display: flex;">
                                                <label class="form-label" style="line-height: 30px;">I will collect sales Tax. : </label>
                                                <label class="radio margin-left-10 margon-top-0">
                                                    <input type="radio" name="is_tax" value="1"  <?=isset($invoice_setup->id) && ($invoice_setup->is_tax ==1) ?'checked':'';?> />
                                                    <i></i> Yes
                                                </label>
                                                <label class="radio margin-top-0">
                                                    <input type="radio" name="is_tax" value="2" <?=isset($invoice_setup->id) && ($invoice_setup->is_tax ==2) ?'checked':'';?> />
                                                    <i></i> No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 tax-div" style="display: <?=isset($invoice_setup->id) && ($invoice_setup->is_tax ==2) ?'none':'';?>;">
                                            <div class="form-group">
                                                <label class="form-label">Enter the Tax Rate here(in %)</label>
                                                <input type="text" name="tax_rate" class="form-control" placeholder="Example: .05" value="{{ isset($invoice_setup->id)?$invoice_setup->tax_rate:''}}" <?= isset($invoice_setup->id) && ($invoice_setup->is_tax == 1) ?'required':''; ?> />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin: 0px;">
                                        <div class="col-md-12">
                                            <div class="form-group" style="display: flex;">
                                                <label class="form-label" style="line-height: 30px;">I will collect shipping cost. : </label>
                                                <label class="radio margin-left-10 margon-top-0">
                                                    <input type="radio" name="shipping_cost" value="1"  <?=isset($invoice_setup->id) && ($invoice_setup->shipping_cost ==1) ?'checked':'';?> />
                                                    <i></i> Yes
                                                </label>
                                                <label class="radio margin-top-0">
                                                    <input type="radio" name="shipping_cost" value="2" <?=isset($invoice_setup->id) && ($invoice_setup->shipping_cost ==2) ?'checked':'';?>/>
                                                    <i></i> No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 shipping-div" style="display:  <?=isset($invoice_setup->id) && ($invoice_setup->shipping_cost ==1) ?'block':'none';?>;">
                                            <div class="form-group">
                                                <label class="form-label">Enter the Shipping rate here(in %) </label>
                                                <input type="text" name="shipping_rate" class="form-control" placeholder="Example: 9.50" value="{{ isset($invoice_setup->id)?$invoice_setup->shipping_rate:''}}" <?= isset($invoice_setup->id) && ($invoice_setup->shipping_method== 1) ?'required':''; ?> />
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Enter the Flat Shipping Cost here </label>
                                                <input type="text" name="shipping_amount" class="form-control" placeholder="Example: 15" value="{{ isset($invoice_setup->id)?$invoice_setup->shipping_amount:''}}" <?= isset($invoice_setup->id) && ($invoice_setup->shipping_method== 2) ?'required':''; ?>>
                                            </div>
                                            

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" style="display: flex;">
                                                <label class="form-label" style="line-height: 30px;">Shipping method : </label>
                                                <label class="radio margin-left-10 margon-top-0">
                                                    <input type="radio" name="shipping_method" value="1"  <?php if($invoice_setup == ""){ ?> checked <?php }else{ ?> <?=isset($invoice_setup->id) && ($invoice_setup->shipping_method == 1) ?'checked':'';?> <?php } ?> />
                                                    <i></i> Tax rate
                                                </label>
                                                <label class="radio margin-top-0">
                                                    <input type="radio" name="shipping_method" value="2" <?=isset($invoice_setup->id) && ($invoice_setup->shipping_method ==2) ?'checked':'';?>/>
                                                    <i></i> Flat value
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px;">
                                         <input type="hidden" name="id"value="{{ isset($invoice_setup->id)?$invoice_setup->id:''}}" />
                                        <button type="submit" class="btn btn-sm btn-info">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function() {
        setTimeout(function() {
            $("input[name='shipping_cost']").trigger('change');
        },10);
    });
    $(document).on("change", "input[name='is_tax']", function() { 
        var val = "";
        if($(this).is(':checked')){
          if($(this).val()==1){
            $('.tax-div').css('display','block');
            $("input[name='tax_rate']").attr('required', 'required');
            val = 1;
          }else{
             $('.tax-div').css('display','none');
             $("input[name='tax_rate']").val('');
             $("input[name='tax_rate']").removeAttr('required');
          }
        }
        // var url = "<?php echo url('/'); ?>/sales_tax_account";
        // $.ajax({
        //       url: url,
        //       data: 'val=' + val + '&_token={{ csrf_token() }}',
        //       type: "POST",
        //     success: function (response) {
        //         // alert(response);
        //     }
        // });
    });

     $(document).on("change", "input[name='shipping_cost']", function() { 
        var val = "";
        if($(this).is(':checked')){
          if($(this).val()==1){
            $('.shipping-div').css('display','block');
            var shipping_method = $("input[name='shipping_method']:checked").val();
            if(shipping_method == 1){
                $("input[name='shipping_rate']").attr('required', 'required');
                $("input[name='shipping_amount']").removeAttr('required');
            }
            else if(shipping_method == 2){
                $("input[name='shipping_amount']").attr('required', 'required');
                $("input[name='shipping_rate']").removeAttr('required');
            }
            // val = 1;
          }else{
             $('.shipping-div').css('display','none');
             $("input[name='shipping_rate']").val('');
             $("input[name='shipping_amount']").val('');
             $("input[name='shipping_rate']").removeAttr('required');
             $("input[name='shipping_amount']").removeAttr('required');
          }
            // var url = "<?php echo url('/'); ?>/shipping_collected";
            // $.ajax({
            //       url: url,
            //       data: 'val=' + val + '&_token={{ csrf_token() }}',
            //       type: "POST",
            //     success: function (response) {
            //         // alert(response);
            //     }
            // }); 
        }
    });
    $(document).on("change", "input[name='shipping_method']", function() { 
        if($("input[name='shipping_cost']").is(':checked')){
            if($("input[name='shipping_cost']").val() == 1){
                if($(this).val() ==1){
                    $("input[name='shipping_rate']").attr('required', 'required');
                    $("input[name='shipping_amount']").removeAttr('required');
                }else{
                    $("input[name='shipping_amount']").attr('required', 'required');
                    $("input[name='shipping_rate']").removeAttr('required');
                }
            }
        }
    });
   

</script>

@endsection