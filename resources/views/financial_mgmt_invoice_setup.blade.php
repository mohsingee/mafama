@extends('layouts.main')
@section("content")

<style>
    input[type="checkbox"] { /* change "blue" browser chrome to yellow */
        filter: hue-rotate(140deg);
        transform: scale(1.3);
        width: 15px;
        height: 18px;
        margin-right: 5px;
        outline-color: #da291c;
    }

    .d-flex{
        display: flex;
    }

    .dis_label{
        font-weight: bold;
        padding-left: 7px;
        font-size: 15px;
        line-height: 27px;
        color: #404040;
    }
</style>

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
                              <h5 class="text-center">To Setup your Invoice, answer the following two questions.</h5>
                                <div class="col-md-6" style="border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                    <div class="row" style="margin: 0px;">
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
                                        <div class="col-md-9 tax-div" style="display: <?=isset($invoice_setup->id) && ($invoice_setup->is_tax ==2) ?'none':'';?>;">
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
                                        <div class="col-md-9 shipping-div" style="display:  <?=isset($invoice_setup->id) && ($invoice_setup->shipping_cost ==1) ?'block':'none';?>;">
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
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12" style="display: flex;">
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

                            <form action="{{route('discount_update')}}" method="POST" id="dis_form" onsubmit="submit_form()">
                                @csrf
                                <div class="col-md-6" style="border-radius: 10px; padding-top: 15px; padding-bottom: 20px;">
                                    {{-- For Setting User --}}
                                     <div class="row">
                                         <div class="col-md-12">
                                             <h5 class="text-center" style="font-size: 18px; margin-bottom: 30px;">
                                                 Discount Setting
                                             </h5>
                                         </div>
                                         <div class="col-md-7">
                                             <h5 style="font-size: 16px; margin-bottom: 14px;">Discount Types</h5>
                                             <div class="d-flex padding-bottom-10">
                                                 <!-- <input type="checkbox" name="mem_discount" value="1"  <?=isset($invoice_setup->id) && ($invoice_setup->is_tax ==1) ?'checked':'';?> /> -->
                                                 <label class="dis_label margin-left-0 margon-top-0">
                                                     Member Reciprocal Discount
                                                 </label>
                                             </div>

                                             <div class="d-flex padding-bottom-10">
                                                 <label class="dis_label margin-left-0 margon-top-0">
                                                     Military Discount
                                                 </label>
                                             </div>

                                             <div class="d-flex padding-bottom-10">
                                                 <label class="dis_label margin-left-0 margon-top-0">
                                                     Student Discount
                                                 </label>
                                             </div>

                                             <div class="d-flex padding-bottom-10">
                                                 <label class="dis_label margin-left-0 margon-top-0">
                                                     Senior Citizen Discount
                                                 </label>
                                             </div>

                                             <div class="d-flex padding-bottom-10">
                                                 <label class="dis_label margin-left-0 margon-top-0">
                                                     Welcome Discount
                                                 </label>
                                             </div>

                                         </div>
                                         <div style="padding-left:5px !important;padding-right:5px !important" class="col-md-5">
                                             <div style="padding-left:5px !important;padding-right:5px !important" class="col-md-5">
                                                 <h5 style="font-size: 16px; margin-bottom: 14px;">%age</h5>
                                                 <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                     <div class="">
                                                        @php
                                                            // dd($disc);
                                                        @endphp
                                                         <input style="height: 31px !important" class="form-control mrd" type="text" name="per_1" id="input_1" value="{{$disc->per_1 ?? ""}}">
                                                     </div>
                                                 </div>
                                                 <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                     <div class="">
                                                         <input style="height: 31px !important" class="form-control othr1" type="text" name="per_2" id="input_3" value="{{$disc->per_2 ?? ""}}">
                                                     </div>
                                                 </div>
                                                 <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                     <div class="">
                                                         <input style="height: 31px !important" class="form-control othr2" type="text" name="per_3" id="input_5" value="{{$disc->per_3 ?? ""}}">
                                                     </div>
                                                 </div>
                                                 <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                     <div class="">
                                                         <input style="height: 31px !important" class="form-control othr3" type="text" name="per_4" id="input_7" value="{{$disc->per_4 ?? ""}}">
                                                     </div>
                                                 </div>
                                                 <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                     <div class="">
                                                         <input style="height: 31px !important" class="form-control othr4" type="text" name="per_5" id="input_9" value="{{$disc->per_5 ?? ""}}">
                                                     </div>
                                                 </div>
                                             </div>

                                             <div style="padding-left:0px !important;padding-right:0px !important" class="col-md-2">

                                                 <h5 style="font-size: 16px; margin-bottom: 14px;">OR</h5>

                                             </div>

                                             <div style="padding-left:5px !important;padding-right:5px !important" class="col-md-5">
                                                 <h5 style="font-size: 16px; margin-bottom: 14px;">Flat</h5>
                                                 <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                     <div class="">
                                                         <input style="height: 31px !important" class="form-control mrd1" type="text" name="flat_1" id="input_2" value="{{$disc->flat_1 ?? ""}}">
                                                     </div>
                                                 </div>
                                                 <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                     <div class="">
                                                         <input style="height: 31px !important" class="form-control othr11" type="text" name="flat_2" id="input_4" value="{{$disc->flat_2 ?? ""}}">
                                                     </div>
                                                 </div>
                                                 <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                     <div class="">
                                                         <input style="height: 31px !important" class="form-control othr21" type="text" name="flat_3" id="input_6" value="{{$disc->flat_3 ?? ""}}">
                                                     </div>
                                                 </div>
                                                 <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                     <div class="">
                                                         <input style="height: 31px !important" class="form-control othr31" type="text" name="flat_4" id="input_8" value="{{$disc->flat_4 ?? ""}}">
                                                     </div>
                                                 </div>
                                                 <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                     <div class="">
                                                         <input style="height: 31px !important" class="form-control othr41" type="text" name="flat_5" id="input_10" value="{{$disc->flat_5 ?? ""}}">
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-md-12" style="margin-top: 1px; margin-bottom: 20px; display:flex">
                                        <button type="submit" class="btn btn-sm btn-info" style="margin-left:auto">Save Discounts</button>
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

    function submit_form() {
        notify("Discount Setting Updated Successfully", "success");
    }

    $('#dis_form').on('keyup', function() {
    var $mrd = $(this).find('.mrd');
    var $othr1 = $(this).find('.othr1');
    var $othr2 = $(this).find('.othr2');
    var $othr3 = $(this).find('.othr3');
    var $othr4 = $(this).find('.othr4');

    var first = parseFloat($mrd.val());
    var second = parseFloat($othr1.val());
    var third = parseFloat($othr2.val());
    var fourth = parseFloat($othr3.val());
    var fifth = parseFloat($othr4.val());

    var $mrd1 = $(this).find('.mrd1');
    var $othr11 = $(this).find('.othr11');
    var $othr21 = $(this).find('.othr21');
    var $othr31 = $(this).find('.othr31');
    var $othr41 = $(this).find('.othr41');

    var first1 = parseFloat($mrd1.val());
    var second1 = parseFloat($othr11.val());
    var third1 = parseFloat($othr21.val());
    var fourth1 = parseFloat($othr31.val());
    var fifth1 = parseFloat($othr41.val());

    if (second > first) {
        // alert("Other Discounts Should be less than or equal to Member Reciprocal Discount");
        $othr1.val(first);
    }

    if (third > first) {
        // alert("Other Discounts Should be less than or equal to Member Reciprocal Discount");
        $othr2.val(first);
    }

    if (fourth > first) {
        // alert("Other Discounts Should be less than or equal to Member Reciprocal Discount");
        $othr3.val(first);
    }

    if (fifth > first) {
        // alert("Other Discounts Should be less than or equal to Member Reciprocal Discount");
        $othr4.val(first);
    }



    if (second1 > first1) {
        notify("Other Discounts Should be less than or equal to Member Reciprocal Discount", "error");
        $othr11.val(first1);
    }

    if (third1 > first1) {
        notify("Other Discounts Should be less than or equal to Member Reciprocal Discount", "error");
        // alert("Other Discounts Should be less than or equal to Member Reciprocal Discount");
        $othr21.val(first1);
    }

    if (fourth1 > first1) {
        notify("Other Discounts Should be less than or equal to Member Reciprocal Discount", "error");
        // alert("Other Discounts Should be less than or equal to Member Reciprocal Discount");
        $othr31.val(first1);
    }

    if (fifth1 > first1) {
        notify("Other Discounts Should be less than or equal to Member Reciprocal Discount", "error");
        // alert("Other Discounts Should be less than or equal to Member Reciprocal Discount");
        $othr41.val(first1);
    }
  });

    let input_1 = $('#input_1');
    let input_2 = $('#input_2');
    let input_3 = $('#input_3');
    let input_4 = $('#input_4');
    let input_5 = $('#input_5');
    let input_6 = $('#input_6');
    let input_7 = $('#input_7');
    let input_8 = $('#input_8');
    let input_9 = $('#input_9');
    let input_10 = $('#input_10');

    $( document ).ready(function() {
        if(input_1.val())
        {
            input_2.prop('disabled', true);
        }
        if(input_3.val())
        {
            input_4.prop('disabled', true);
        }
        if(input_5.val())
        {
            input_6.prop('disabled', true);
        }
        if(input_7.val())
        {
            input_8.prop('disabled', true);
        }

        if(input_9.val())
        {
            input_10.prop('disabled', true);
        }

        if(input_2.val())
        {
            input_1.prop('disabled', true);
        }

        if(input_4.val())
        {
            input_3.prop('disabled', true);
        }

        if(input_6.val())
        {
            input_5.prop('disabled', true);
        }

        if(input_8.val())
        {
            input_7.prop('disabled', true);
        }

        if(input_10.val())
        {
            input_9.prop('disabled', true);
        }
    });

    input_1.on(
        "input propertychange",
        event => input_2.prop(
            'disabled',
            event.currentTarget.value !== "")
    );

    input_3.on(
        "input propertychange",
        event => input_4.prop(
            'disabled',
            event.currentTarget.value !== "")
    );

    input_5.on(
        "input propertychange",
        event => input_6.prop(
            'disabled',
            event.currentTarget.value !== "")
    );

    input_7.on(
        "input propertychange",
        event => input_8.prop(
            'disabled',
            event.currentTarget.value !== "")
    );

    input_9.on(
        "input propertychange",
        event => input_10.prop(
            'disabled',
            event.currentTarget.value !== "")
    );

    input_2.on(
        "input propertychange",
        event => input_1.prop(
            'disabled',
            event.currentTarget.value !== "")
    );
    input_4.on(
        "input propertychange",
        event => input_3.prop(
            'disabled',
            event.currentTarget.value !== "")
    );
    input_6.on(
        "input propertychange",
        event => input_5.prop(
            'disabled',
            event.currentTarget.value !== "")
    );
    input_8.on(
        "input propertychange",
        event => input_7.prop(
            'disabled',
            event.currentTarget.value !== "")
    );
    input_10.on(
        "input propertychange",
        event => input_9.prop(
            'disabled',
            event.currentTarget.value !== "")
    );

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
