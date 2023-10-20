@extends('layouts.main')
@section("content")
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<style type="text/css">
    p{
        margin-bottom: 0px;
    }
    p, pre, ul, ol, dl, dd, blockquote, address, table, fieldset, form {
        margin-bottom: 0px !important;
    }
    input#transaction_date {
        position: relative;
        /*width: 150px; height: 20px;*/
        /*color: white;*/
    }
    input#transaction_date:before{
        position: absolute;
        /*top: 3px; left: 3px;*/
        content: attr(data-date);
        display: inline-block;
        color: black;
    }
    input#transaction_date::-webkit-datetime-edit, input#transaction_date::-webkit-inner-spin-button, input#transaction_date::-webkit-clear-button {
        display: none;
    }
    input#transaction_date::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
    .clientss {
        cursor: pointer;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Financial Management / Record Transactions</h4>
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
                    <li class="active"><a href="{{ url('revenue_records') }}"> Record Revenue</a></li>
                    <li><a href="{{ url('expenses_reord') }}"> Record Expenses</a></li>
                    <li><a href="{{ url('manage_assets') }}">Record / Manage Assets</a></li>
                    <?php if($upload_files != "off"){ ?>
                        <li><a href="{{ url('upload_files') }}">Upload Files</a></li>
                    <?php } ?>
                </ul>
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <!-- <div class="col-md-3 padding-0">
                        <img src="assets/images/demo/people/300x300/11-min.jpg" style="border: 1px solid #da291c73 !important; border-radius: 5px;" width="180" height="160" alt="featured item" />
                    </div>
                    <div class="col-md-9">
                        <h4 style="margin-top: 60px;">John Doe</h4>
                    </div>
                    <div class="clearfix"></div>
                    <hr /> -->

                    <!-- <div class="col-md-2 client-list" style="border-right: 1px solid #f6cbc9; background-color: #e1f5fe; padding-top: 10px;">
                        <h4 style="border-bottom: 1px solid #f6cbc9;">
                            Client Names
                        </h4>
                        <div class="col-md-12 padding-0">
                            <ul style="list-style: none; padding-left: 0px;">
                                <?php
                                    foreach ($clients as $value) {
                                ?>
                                <li class="clientss" id="client<?= $value->id ?>"><?= $value->first_name ?> <?= $value->last_name ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div> -->

                    <div class="col-md-12">
                        <form method="POST" id="record_revenue" role="form" enctype="multipart/form-data">
                            @csrf
                            <div id="client_details" style="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 style="">Client Details</h4>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="row">
                                          <div class="margin-bottom-10 col-md-6">
                                              <b>Client Name: </b> <input type="text" name="client_name" class="form-control" id="client_name" value="<?= $revenue_records->client_name ?>" readonly>
                                          </div>
                                          <div class="margin-bottom-10 col-md-6">
                                              <b>Client Email: </b> <input type="text" name="client_email" class="form-control" id="client_email" value="<?= $revenue_records->client_email ?>" readonly>
                                          </div>
                                      </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="margin-bottom-10">
                                            <b>Client Phone: </b> <input type="text" name="client_phone" class="form-control" id="client_phone" readonly>
                                        </div>
                                        <div class="margin-bottom-10">
                                            <b>Client Address: </b>
                                            <textarea class="form-control" name="client_address" id="client_address" readonly></textarea>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                            </div>
                            <div class="row margin-bottom-20">
                                <div class="col-md-3">
                                    <label>Trasaction Date</label>
                                    <input type="date" name="transaction_date" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= $revenue_records->transaction_date ?>" id="transaction_date" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Accounts / Description</label>
                                    <select class="form-control" name="account_description" id="account_description">
                                        <?php
                                            foreach($revenue_account as $value){
                                        ?>
                                                <option value="<?= $value->account_name ?>" <?php if($revenue_records->account_description == $value->account_name){ ?> selected <?php } ?>><?= $value->account_name ?></option>
                                        <?php
                                            }
                                        ?>
                                        <option value="Other Revenue" <?php if($revenue_records->account_description == "Other Revenue"){ ?> selected <?php } ?>>Other Revenue</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Charged / Bill</label>

                                    <input type="number" step="0.01" name="bill" class="form-control" value="<?= $revenue_records->bill ?>" id="bill" <?php if($account_revenue != ""){ ?> readonly <?php } ?> onkeyup="tax_calc(),empty_f()" required>
                                </div>
                                <div class="col-md-2">
                                    <label>Discount</label>
                                    <input type="number" name="discount" class="form-control" id="discount_field" value="{{$revenue_records->discount}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label>New Charged</label>
                                    <input type="number" class="form-control" id="discounted" readonly>
                                </div>

                                <input type="hidden" name="discount_type" class="form-control" id="discount_type" readonly>

                                <!-- <div class="col-md-4">
                                    <label>Tax</label>
                                    <input type="number" name="tax" class="form-control" value="<?= $revenue_records->tax ?>" id="tax" onkeyup="tax_calc()" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Shipping</label>
                                    <input type="number" name="shipping" class="form-control" value="<?= $revenue_records->shipping ?>" id="shipping" onkeyup="tax_calc()" required>
                                </div> -->
                                <?php
                                    $dnone = "";
                                    $dnone1 ="";
                                    if($invoice_setup->is_tax == 2){
                                        $dnone = "display: none";
                                    }
                                    if($invoice_setup->shipping_cost == 2){
                                        $dnone1 = "display: none";
                                    }
                                ?>
                                <div class="col-md-4" style="margin-bottom: 20px;{{ $dnone }}">
                                    <!--<label>Tax</label>-->
                                    <div style="margin-top: 25px">
                                        <div class="col-md-4">
                                            <label class="checkbox chk-sm ">
                                                <input class="tran_check" type="checkbox" name="tax1" value="{{ isset($invoice_setup->id)?$invoice_setup->tax_rate:$revenue_records->tax }}" <?php if($invoice_setup->is_tax == 1){ ?>checked <?php }else{ ?> readonly <?php } ?> onchange="tax_calc()" />
                                                <i></i> Tax
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                        <input type="text" name="tax" id="tax"  class="form-control" value="0" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="display: none">
                                    <label>Shipping Method</label>
                                    <select class="form-control" id="shipping_method" onchange="tax_calc()">
                                        <option value="percentage"  <?php if($invoice_setup->shipping_method == 1){ ?>selected <?php } ?>>percentage(%) rate</option>
                                        <option value="flat"  <?php if($invoice_setup->shipping_method == 2){ ?>selected <?php } ?>>flat value</option>
                                    </select>
                                </div>
                                <div class="col-md-4" style="margin-bottom: 20px;{{ $dnone1 }}">
                                     <div style="margin-top: 25px">
                                         <div class="col-md-4">
                                        <label class="checkbox chk-sm">
                                          <input class="tran_check" type="checkbox" name="shipping1" value="{{ isset($invoice_setup->id)?$invoice_setup->shipping_rate:$revenue_records->shipping}}" <?php if($invoice_setup->shipping_cost == 1){ ?>checked <?php } else{ ?> readonly <?php } ?> onchange="tax_calc()" />
                                                    <i></i> Shipping

                                             </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="shipping" id="shipping" class="form-control" value="0" readonly>
                                        </div>
                                   </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom: 20px;">
                                    <label>Total Due</label>
                                    <input type="number" name="total" class="form-control" value="<?= $revenue_records->total ?>" id="total" onkeyup="tax_calc()" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label>Amount Paid</label>
                                    <!-- <input type="number" name="amount_paid" class="form-control" value="<?= $revenue_records->amount_paid ?>" id="amount_paid" onkeyup="tax_calc()" required> -->
                                    <input step="0.01" type="number" name="amount_paid" class="form-control" value="<?= $revenue_records->amount_paid ?>" id="amount_paid" onkeyup="finalize()" required>
                                    <p id="paid_alert" style="color: red; margin-bottom: 5px"></p>
                                </div>
                                <div class="col-md-4">
                                    <label>Balance Due</label>
                                    <input type="text" name="balance" class="form-control" value="<?= $revenue_records->balance ?>" id="balance" onkeyup="tax_calc()" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label>Reason for updating</label>
                                    <textarea class="form-control" name="reason" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 padding-0 margin-bottom-30">
                                <div class="" style="display: flex; width:100%">
                                    <div class="mx-auto" style="margin-left: auto; margin-right:auto">
                                        <style>
                                            .info1 {
                                                border-color: blue !important;
                                                color: blue !important;
                                            }

                                            .info1:hover {
                                                background: blue !important;
                                                color: white !important;
                                            }

                                            .info2 {
                                                border-color: green !important;
                                                color: green !important;
                                            }

                                            .info2:hover {
                                                background: green !important;
                                                color: white !important;
                                            }

                                            .btn1 {
                                                border: 2px solid black;
                                                background-color: rgba(255, 255, 255, 0.699);
                                                border-radius: 100px;
                                                color: black;
                                                padding: 5px 20px;
                                                font-size: 13px;
                                                cursor: pointer;
                                                margin: 1px 2px 1px 2px;
                                            }
                                        </style>
                                        <!-- <div class="col-md-12 padding-0 margin-bottom-20">
                                            <button type="submit" class="btn btn-xs btn-info" style="width: 100px;">Update</button>
                                            <a  class="btn btn-xs btn-info" style="width: 100px;" onclick="print_invoice()">Print Invoice</a>
                                        </div> -->
                                        <div>
                                            <input type="hidden" name="id" value="<?= $revenue_records->id ?>">

                                            <button type="submit" class="btn1 info1">Update This Transactions</button>
                                            <!-- <button class="btn1 info1">Email This Invoice</button> -->
                                            <button class="btn1 info1" onclick="print_invoice()">Print This Invoice</button>
                                            <button class="btn1 info2" data-toggle="modal" data-target="#RevenueModal">Check for Discount</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="RevenueModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align-last: center">Check for Discount</h4>
                                        </div>
                                        <!-- <form action="" method="POST">
                                            @csrf -->
                                            <div class="modal-body">
                                                <div id="discount">
                                                    <div class="row" id="">
                                                        <div class="col-md-7" style="float:right !important; padding-bottom: 15px; display:flex">
                                                            <input class="form-control" type="text" name="" id="phone_number" placeholder="Enter Member's Phone Number">
                                                            <a class="btn btn-sm btn-info" style="margin-left: 5px" href="" onclick="find()">Find</a>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <h5 style="font-size: 16px; margin-bottom: 14px;">Discount Types</h5>

                                                            <div class="d-flex padding-bottom-10">
                                                                <div>
                                                                    <label class="radio margin-left-0 margon-top-0">
                                                                        <input type="radio" name="mem_discount" value="Military Discount"/>
                                                                        <i></i>
                                                                        Military Discount
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex padding-bottom-10">
                                                                <div>
                                                                    <label class="radio margin-left-0 margon-top-0">
                                                                        <input type="radio" name="mem_discount" value="Student Discount"/>
                                                                        <i></i>
                                                                        Student Discount
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex padding-bottom-10">
                                                                <div>
                                                                    <label class="radio margin-left-0 margon-top-0">
                                                                        <input type="radio" name="mem_discount" value="Senior Citizen Discount"/>
                                                                        <i></i>
                                                                        Senior Citizen Discount
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex padding-bottom-10">
                                                                <div>
                                                                    <label class="radio margin-left-0 margon-top-0">
                                                                        <input type="radio" name="mem_discount" value="Welcome Discount"/>
                                                                        <i></i>
                                                                        Welcome Discount
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="padding-left:5px !important;padding-right:5px !important" class="col-md-5">
                                                            <div style="padding-left:5px !important;padding-right:5px !important" class="col-md-5">
                                                                <h5 style="font-size: 16px; margin-bottom: 14px;">%age</h5>
                                                                <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                                    <div class="">
                                                                        <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="{{$disc->per_2 ?? 0}} %">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                                    <div class="">
                                                                        <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="{{$disc->per_3 ?? 0}} %">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                                    <div class="">
                                                                        <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="{{$disc->per_4 ?? 0}} %">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                                    <div class="">
                                                                        <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="{{$disc->per_5 ?? 0}} %">
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
                                                                        <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="{{$disc->flat_2 ?? 0}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                                    <div class="">
                                                                        <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="{{$disc->flat_3 ?? 0}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                                    <div class="">
                                                                        <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="{{$disc->flat_4 ?? 0}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group d-flex padding-bottom-0 margin-bottom-10">
                                                                    <div class="">
                                                                        <input style="height: 30px !important" class="form-control" type="text" name="" id="" disabled value="{{$disc->flat_5 ?? 0}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-md-12" style="margin-top: 1px; margin-bottom: 10px; display:flex">
                                                    <button class="btn btn-sm btn-info" onclick="discount_apply()" style="margin-left:auto">Apply Discount</button>
                                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                                {{-- <input type="submit" class="btn btn-sm btn-primary" value="Save"> --}}
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" name="invoice_id" value="<?= $revenue_records->id ?>" id="invoice_id">
<div id="modall" class="modal fade" role='dialog'>
    <div class="modal-dialog">
        <div class="modal-content" style="background: white">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div id= "modal-body"></div>
            </div>
        </div>
    </div>
</div>
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label>Reason for deleting</label>
                    <textarea class="form-control" name="delete_reason" id="delete_reason"></textarea>
                    <input type="hidden" name="delete_id" id="delete_id" value="">
                </div>
                <input type="hidden" id="">
                <div class="col-md-12 text-center margin-top-20">
                    <a class="btn btn-info" id="delete_revenuee">Delete</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div id="bannerse" style="display: none;"><?= $banner->preview ?></div>
<div id="content">
    <!-- <div class="row" style="width: 100%">
        <table style="width: 100%">
            <tr>
            <td style="padding: 10px">
              <div style="border: 1px solid #da291c; padding: 10px">
                  <b>Client Name: </b> <span id="in_client_name"></span><br>
                  <b>Client Phone: </b> <span id="in_client_phone"></span><br>
                  <b>Client Address</b> <span id="in_client_address"></span>
              </div>
            </td>
            <td style="padding: 10px">
              <div style="border: 1px solid #da291c; padding: 10px">
                  <b>Client Email: </b> <span id="in_client_email"></span><br>
                  <b>Company Name: </b> <span id="in_client_company"></span><br>
                  <b>Work Phone: </b> <span id="in_company_phone"></span>
              </div>
            </td>
          </tr>
      </table>
  </div> -->

    <div id="pdf_details" style="display: none;">
        <div id="pdf" style="padding: 0 20px;">
            <div style="padding: 0 20px;">
                <div class="row">
                    <div class="col-md-12">
                        <div style="padding: 15px;">

                            <!-- <div id="img-out"></div> -->
                            {!! $banner->preview  !!}
                        </div>
                    </div>
                </div>
                <div class="row clt">
                    <div class="col-md-12">
                        <div style="width:49%; float: left; margin-right: 2%;">
                            <div style="border: 1px solid #da291c; padding: 10px">
                                  <b>Client Name: </b> <span id="in_client_name"></span><br>
                                  <b>Client Phone: </b> <span id="in_client_phone"></span><br>
                                  <b>Client Address</b> <span id="in_client_address"></span>
                              </div>
                        </div>
                        <div style="width:49%;  float: left">
                            <div style="border: 1px solid #da291c; padding: 10px">
                                  <b>Client Email: </b> <span id="in_client_email"></span><br>
                                  <b>Company Name: </b> <span id="in_client_company"></span><br>
                                  <b>Work Phone: </b> <span id="in_company_phone"></span>
                              </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <h4 style="color: #da291c !important; font-size: 18px; font-weight: bold;">Invoice Details</h4>
                      <table style="width: 100%">
                          <thead style="border: 1px solid #da291c">
                              <tr>
                                  <th><div style="border: 1px solid #da291c; padding: 10px;color: #ffffff !important; background: #da291c !important">Transaction Date</div></th>
                                  <th><div style="border: 1px solid #da291c; padding: 10px;color: #ffffff !important; background: #da291c !important">Accounts / Description</div></th>
                                  <th><div style="border: 1px solid #da291c; padding: 10px;color: #ffffff !important; background: #da291c !important">Amount</div></th>
                              </tr>
                          </thead>
                          <tbody id="in_tbody">

                          </tbody>
                          <tfoot style="border: 1px solid #da291c !important; padding: 10px; background-color: #aee9f3 !important; color: #041777 !important;">
                              <td colspan="3">
                                  <table style="width: 100%; padding: 10px;">
                                      <tr>
                                          <td colspan="2" style="text-align: right">
                                              <b> Charged/Bill: </b>
                                          </td>
                                          <td style="text-align: right; padding-right: 10px;">
                                              <span id="in_charged"></span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td colspan="2" style="text-align: right">
                                              <b> Tax: </b>
                                          </td>
                                          <td style="text-align: right; padding-right: 10px;">
                                              <span id="in_tax"></span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td colspan="2" style="text-align: right">
                                              <b> Shipping: </b>
                                          </td>
                                          <td style="text-align: right;  padding-right: 10px;">
                                              <span id="in_shipping"></span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td colspan="2" style="text-align: right">
                                              <b> Total Amount: </b>
                                          </td>
                                          <td style="text-align: right;  padding-right: 10px;">
                                              <span id="in_total"></span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td colspan="2" style="text-align: right">
                                              <b> Amount Paid: </b>
                                          </td>
                                          <td style="text-align: right; padding-right: 10px;">
                                              <span id="in_paid_amount"></span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td colspan="2" style="text-align: right">
                                              <b> Balance: </b>
                                          </td>
                                          <td style="text-align: right; padding-right: 10px;">
                                              <span id="in_balance"></span>
                                          </td>
                                      </tr>
                                    </table>
                              </td>
                          </tfoot>
                      </table>
                      <!-- <div style="border: 1px solid #da291c; padding: 10px; margin: 0 2px">

                      </div> -->
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="editor"></div>
<!-- <button id="cmd" style="display: none;"></button> -->
<button class="invoice_button" onclick="printDiv('pdf','Invoice')" style="display: none;"></button>
<button class="html2img" style="display: none;"></button>



<script>
    function find() {
        event.preventDefault();
        var phone = document.getElementById('phone_number').value;

        var url1 = "<?php echo url('/'); ?>/find";
        $.ajax({
                url: url1,
                data: 'phone=' + phone + '&_token={{ csrf_token() }}',
                type: "POST",
            success: function (response) {
                if (response == '123') {
                    notify("Record not found", "error");
                } else {
                    notify("Record found as member", "success");
                    $('#discount').html(response);
                    // console.log(document.getElementById('discount').innerHTML);
                    if (document.getElementById('not_found')) {
                        notify("Record not found", "error")
                    }
                }
            }
        })
    }

    function discount_apply() {
        event.preventDefault();
        var ele = document.getElementsByName('mem_discount');
        for(i = 0; i < ele.length; i++) {
                if(ele[i].checked) {
                    var value = ele[i].value;
                    // console.log(value);
                    var url2 = "<?php echo url('/'); ?>/discount_apply";
                    $.ajax({
                        url: url2,
                        data: 'discount=' + value + '&_token={{ csrf_token() }}',
                        type: "POST",
                        success: function (response) {
                            // console.log(response);
                            var before_discount = document.getElementById('bill').value;

                            var old_bill = document.getElementById('total').value;
                            if (response['type'] == 'flat') {
                                var new_bill = old_bill - response['value'];
                                var after_discount = before_discount - response['value'];
                            } else {
                                var new_bill = old_bill-old_bill*response['value']/100;
                                var after_discount = before_discount - before_discount*response['value']/100;
                            }

                            document.getElementById('discounted').value = after_discount.toFixed(2);
                            var tax =  document.getElementById('tax').value;
                            var shipping =  document.getElementById('shipping').value;

                            // document.getElementById('total').value = new_bill;
                            document.getElementById('total').value = (parseFloat(after_discount)+parseFloat(tax)+parseFloat(shipping)).toFixed(2);

                            // console.log(after_discount);

                            // var new_bill1 = document.getElementById('total1').value;

                            var bal = parseFloat(after_discount)+parseFloat(tax)+parseFloat(shipping) - document.getElementById('amount_paid').value;

                            var balance = document.getElementById('balance');

                            if (bal<0) {
                                balance.value = bal.toFixed(2);
                            } else {
                                var bal_n = -1 * bal;
                                balance.value = bal_n.toFixed(2);
                                balance.style.color = 'red';
                            }

                            // document.getElementById('discount_field').value = document.getElementById('bill').value -  document.getElementById('total').value;
                            var final_discount = before_discount - after_discount;

                            if(final_discount < 0){
                                final_discount = -1 * final_discount;
                            }
                            document.getElementById('discount_field').value = final_discount.toFixed(2);

                            document.getElementById('discount_type').value = response['type'];


                            $('#RevenueModal').modal('hide');


                            // $('#').html(response);
                        }
                    })

                }
        }
    }

    function finalize() {

        event.preventDefault();
        var amount = document.getElementById('amount_paid').value;
        var total = document.getElementById('total').value;
        var last_blnc = total-amount;

        if (last_blnc > 0) {
            last_blnc = -1 * last_blnc;
        }

        // alert(last_blnc);


        document.getElementById('balance').value = last_blnc.toFixed(2);
    }
</script>
<script type="text/javascript">
    // function print_invoice(){
    //     var client_email = $("#client_email").val();
    //     // alert(client_email);
    //     var invoice_id = $("#invoice_id").val();
    //     // alert(invoice_id);
    //     if(client_email == ""){
    //         $("#modall").modal('show');
    //         $("#modal-body").html('<div style="text-align: center"><div>1. Save the Transaction.</div><div>2. Select a Client from Client List.</div><div>3. Select the item you want to include in the invoice.</div></div>');
    //     }
    //     else{
    //         if(invoice_id == ""){
    //             $("#modall").modal('show');
    //             $("#modal-body").html('<div style="text-align: center"><div>Select the item you want to include in the invoice.</div></div>')
    //         }
    //         else{
    //             var url = "<?php echo url('/'); ?>/get_invoice_list";
    //             $.ajax({
    //                   url: url,
    //                   data: 'invoice_id=' + invoice_id + '&_token={{ csrf_token() }}',
    //                   type: "POST",
    //                 success: function (response) {
    //                     $("#in_tbody").html(response);
    //                 }
    //             }).then( function( data ) {
    //                 var url = "<?php echo url('/'); ?>/get_invoice_amount";
    //                 $.ajax({
    //                       url: url,
    //                       data: 'invoice_id=' + invoice_id + '&_token={{ csrf_token() }}',
    //                       type: "POST",
    //                     success: function (response) {
    //                         $("#in_charged").html(response[0]);
    //                         $("#in_tax").html(response[1]);
    //                         $("#in_shipping").html(response[2]);
    //                         $("#in_total").html(response[3]);
    //                         $("#in_paid_amount").html(response[4]);
    //                         $("#in_balance").html(response[5]);
    //                         $(".invoice_button").trigger('click');
    //                     }
    //                 })
    //             });
    //         }
    //     }
    // }
    // function printDiv(divId, title) {
    //     // alert("hi");
    //   var stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css';
    //   let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

    //   mywindow.document.write(`<html><head><title>${title}</title>`);
    //   mywindow.document.write('<link rel="stylesheet" href="' + stylesheet + '">');
    //   mywindow.document.write('</head><body >');
    //   mywindow.document.write(document.getElementById(divId).innerHTML);
    //   mywindow.document.write('</body></html>');

    //   mywindow.document.close();
    //   mywindow.focus();

    //   mywindow.print();
    //   // mywindow.close();

    //   return true;
    // };
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
        $('#reminderdate').attr('max', maxDate);
        $('#transaction_date').attr('max', maxDate);
    });
    $("#transaction_date").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change");
    // $("#bill").on("input", function(){
    //     var bill = $(this).val();
    //     var tax = $("#tax").val();
    //     var shipping = $("#shipping").val();
    //     var total = $("#total").val();
    //     var amount_paid = $("#amount_paid").val();
    //     var balance = $("#balance").val();
    //     var total_amount = parseFloat(bill) + parseFloat(tax) + parseFloat(shipping);
    //     if(amount_paid != 0){
    //         var balance_amount = parseFloat(amount_paid) - parseFloat(total_amount);
    //         $("#balance").val(balance_amount);
    //     }
    //     $("#total").val(total_amount);
    //     $("#balance").val("NaN");
    // });
    // $("#tax").on("input", function(){
    //     var bill = $("#bill").val();
    //     var tax = $(this).val();
    //     var shipping = $("#shipping").val();
    //     var total = $("#total").val();
    //     var amount_paid = $("#amount_paid").val();
    //     var balance = $("#balance").val();
    //     var total_amount = parseFloat(bill) + parseFloat(tax) + parseFloat(shipping);
    //     if(amount_paid != 0){
    //         var balance_amount = parseFloat(amount_paid) - parseFloat(total_amount);
    //         $("#balance").val(balance_amount);
    //     }
    //     $("#total").val(total_amount);
    //     $("#balance").val("NaN");

    // });
    // $("#shipping").on("input", function(){
    //     var bill = $("#bill").val();
    //     var tax = $("#tax").val();
    //     var shipping = $(this).val();
    //     var total = $("#total").val();
    //     var amount_paid = $("#amount_paid").val();
    //     var balance = $("#balance").val();
    //     var total_amount = parseFloat(bill) + parseFloat(tax) + parseFloat(shipping);
    //     if(amount_paid != 0){
    //         var balance_amount = parseFloat(amount_paid) - parseFloat(total_amount);
    //         $("#balance").val(balance_amount);
    //     }
    //     $("#total").val(total_amount);
    //     $("#balance").val("NaN");
    // });
    // $("#amount_paid").on("input", function(){
    //     var bill = $("#bill").val();
    //     var tax = $("#tax").val();
    //     var shipping = $("#shipping").val();
    //     var total = $("#total").val();
    //     var amount_paid = $(this).val();
    //     var balance = $("#balance").val();
    //     var total_amount = parseFloat(bill) + parseFloat(tax) + parseFloat(shipping);
    //     var balance_amount = parseFloat(amount_paid) - parseFloat(total_amount);
    //     $("#total").val(total_amount);
    //     $("#balance").val(balance_amount);
    //     $("#paid_alert").hide();

    // });
    function print_invoice(){
      var account_description = $("#account_description").val();
      if(account_description != "Other Revenue"){
        var client_email = $("#client_email").val();
        var invoice_id = $("#invoice_id").val();
        if(client_email == ""){
            $("#modall").modal('show');
            $("#modal-body").html('<div style="text-align: center"><div>1. Save the Transaction.</div><div>2. Select a Client from Client List.</div><div>3. Select the item you want to include in the invoice.</div></div>');
        }
        else{
            if(invoice_id == ""){
                $("#modall").modal('show');
                $("#modal-body").html('<div style="text-align: center"><div>Select the item you want to include in the invoice.</div></div>')
            }
            else{
                var url = "<?php echo url('/'); ?>/get_invoice_list";
                $.ajax({
                      url: url,
                      data: 'invoice_id=' + invoice_id + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        $("#in_tbody").html(response);
                    }
                }).then( function( data ) {
                    var url = "<?php echo url('/'); ?>/get_invoice_amount";
                    $.ajax({
                          url: url,
                          data: 'invoice_id=' + invoice_id + '&_token={{ csrf_token() }}',
                          type: "POST",
                        success: function (response) {
                            $("#in_charged").html(response[0]);
                            $("#in_tax").html(response[1]);
                            $("#in_shipping").html(response[2]);
                            $("#in_total").html(response[3]);
                            $("#in_paid_amount").html(response[4]);
                            $("#in_balance").html(response[5]);
                            $(".invoice_button").trigger('click');
                            // $('#cmd').trigger('click');
                        }
                    })
                });
            }
        }
      }
      else{
        var invoice_id = $("#invoice_id").val();
        var url = "<?php echo url('/'); ?>/get_invoice_list";
                $.ajax({
                      url: url,
                      data: 'invoice_id=' + invoice_id + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        $("#in_tbody").html(response);
                    }
                }).then( function( data ) {
                    var url = "<?php echo url('/'); ?>/get_invoice_amount";
                    $.ajax({
                          url: url,
                          data: 'invoice_id=' + invoice_id + '&_token={{ csrf_token() }}',
                          type: "POST",
                        success: function (response) {
                            $(".clt").hide();
                            $("#in_charged").html(response[0]);
                            $("#in_tax").html(response[1]);
                            $("#in_shipping").html(response[2]);
                            $("#in_total").html(response[3]);
                            $("#in_paid_amount").html(response[4]);
                            $("#in_balance").html(response[5]);
                            $(".invoice_button").trigger('click');
                            // $('#cmd').trigger('click');
                        }
                    })
                });
      }
    }
    function printDiv(divId, title) {
      var stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css';
      let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

      mywindow.document.write(`<html><head><title>${title}</title>`);
      mywindow.document.write('<link rel="stylesheet" href="' + stylesheet + '">');
      mywindow.document.write('</head><body >');
      mywindow.document.write(document.getElementById(divId).innerHTML);
      mywindow.document.write('</body></html>');

      mywindow.document.close(); // necessary for IE >= 10
      mywindow.focus(); // necessary for IE >= 10*/

      mywindow.print();
      // mywindow.close();

      return true;
    };
    // $("#transaction_date").on("change", function() {
    //     this.setAttribute(
    //         "data-date",
    //         moment(this.value, "YYYY-MM-DD")
    //         .format( this.getAttribute("data-date-format") )
    //     )
    // }).trigger("change");
    tax_calc();

    function tax_calc(){

        var shipping_method = $("#shipping_method").val();
        var shipping_price = "";
        if(shipping_method == "percentage"){
            if($("input[name='tax1']").is(':checked')){
                var tax=$("input[name='tax1']").val();
            }else{
                var tax =0;
            }

            if($("input[name='shipping1']").is(':checked')){
                var shipping=$("input[name='shipping1']").val();
            }else{
                var  shipping =0;
            }

            var bill = parseFloat($("#bill").val());
            var tax_price=(bill*tax)/100;
            var tax_price=(parseFloat(tax_price)).toFixed(2);
            shipping_price=(bill*shipping)/100;
            shipping_price=(parseFloat(shipping_price)).toFixed(2);
            $("#tax").val(tax_price);
            $("#shipping").val(shipping_price);

            var total_amount = (parseFloat(bill) + parseFloat(tax_price) + parseFloat(shipping_price)).toFixed(2);
            $("#total").val(total_amount);
            var amount_paid = $('#amount_paid').val();
            var balance_amount = (parseFloat(amount_paid) - parseFloat(total_amount)).toFixed(2);

            $("#balance").val(balance_amount);
            $("#paid_alert").hide();
        }
        else{
            if($("input[name='tax1']").is(':checked')){
                var tax=$("input[name='tax1']").val();
            }else{
                var tax =0;
            }

            if($("input[name='shipping1']").is(':checked')){
                var bill = parseFloat($("#bill").val());
                var tax_price=(bill*tax)/100;
                var tax_price=(parseFloat(tax_price)).toFixed(2);
                $.ajax({
                    url: "<?php echo url('/'); ?>/flat_shipping_charges",
                    data: '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function (response) {
                        $("#shipping").val(response);
                        shipping_price = response;
                        $("#tax").val(tax_price);
                        // $("#shipping").val(shipping_price);

                        var total_amount = (parseFloat(bill) + parseFloat(tax_price) + parseFloat(shipping_price)).toFixed(2);
                        $("#total").val(total_amount);
                        var amount_paid = $('#amount_paid').val();
                        var balance_amount = (parseFloat(amount_paid) - parseFloat(total_amount)).toFixed(2);

                        $("#balance").val(balance_amount);
                        $("#paid_alert").hide();
                    }
                });
            }else{
                var ship = 0;
                var bill = parseFloat($("#bill").val());
                var tax_price=(bill*tax)/100;
                var tax_price=(parseFloat(tax_price)).toFixed(2);
                $("#shipping").val(ship);
                shipping_price = ship;
                $("#tax").val(tax_price);
                // $("#shipping").val(shipping_price);

                var total_amount = (parseFloat(bill) + parseFloat(tax_price) + parseFloat(shipping_price)).toFixed(2);
                $("#total").val(total_amount);
                var amount_paid = $('#amount_paid').val();
                var balance_amount = (parseFloat(amount_paid) - parseFloat(total_amount)).toFixed(2);

                $("#balance").val(balance_amount);
                $("#paid_alert").hide();
            }


        }



    }
    $("#record_revenue").submit(function(e) {
        e.preventDefault();
        var account_description = $("#account_description").val();
        var total = $("#total").val();
        var amount_paid = $("#amount_paid").val();
        if(amount_paid == 0){
            $("#paid_alert").html("Please enter the paid amount.");
            $("#paid_alert").show();
        }
        else{
            if(account_description == "Other Revenue"){
                if(total != amount_paid){
                    notify("Total amount should be equal to Paid amount when selecting Other Revenue.","error");
                }
                else{
                    var formData = new FormData(this);
                    $.ajax({
                          type: "POST",
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          url: "revenue_records_update",
                          data:  formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                          success: function(html) {
                            // alert(html);
                            // location.reload();
                            //alert("Updated Successfully.");
                            //window.location.href = "revenue_records";
                             redirect_notify("Updated Successfully."," ",'revenue_records',"success");
                          },
                          complete: function(){
                            $("#loading").hide();
                            $("#wrapper").show();
                          }
                    });
                }
            }
            else{
                var client_email = $("#client_email").val();

                if((account_description == "Shipping Collected") || (account_description == "Sales Tax Collected")){
                    var formData = new FormData(this);
                        $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "revenue_records_update",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                // alert(html);
                               // alert("Updated Successfully.");
                               // window.location.href = "revenue_records";
                                 redirect_notify("Updated Successfully."," ","revenue_records","success");
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                              }
                        });
                }
                else{
                    if(client_email == ""){
                    notify("Please select a client!!!","error");
                    }
                    else{
                        var formData = new FormData(this);
                        $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "revenue_records_update",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                // console.log(html);
                                // alert(html);
                                //alert("Updated Successfully.");
                                //window.location.href = "revenue_records";
                                 redirect_notify("Updated Successfully."," ","revenue_records","success");
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                              }
                        });
                    }
                }
            }
        }
    });
    $(".clientss").on("click", function(){
        $(".clientss").css("font-weight", "400");
        $(this).css("font-weight", "bold");
        var id = $(this).attr("id");
        var client_email = "";
        $("#invoice_id").val("");
        // alert(id);
        var url = "<?php echo url('/'); ?>/get_client_details";
        $.ajax({
              url: url,
              data: 'id=' + id + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $("#client_details").show();
                $("#client_name").val(response[0]);
                $("#client_email").val(response[1]);
                $("#client_phone").val(response[2]);
                $("#client_address").val(response[3]);
                $("#client_company").val(response[4]);
                $("#company_phone").val(response[5]);
                $("#in_client_name").html(response[0]);
                $("#in_client_email").html(response[1]);
                $("#in_client_phone").html(response[2]);
                $("#in_client_address").html(response[3]);
                $("#in_client_company").html(response[4]);
                $("#in_company_phone").html(response[5]);
                client_email = response[1];
            }
        }).then( function( data ) {
            // alert(client_email);
            $.ajax({
                url: "<?php echo url('/'); ?>/client_revenue_list",
                data: 'client_email=' + client_email + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function (response) {
                    $("#listid").html(response);
                }
            })
        });
    });
    // $(".tran_check").on('change', function(){
    function tran_check(){
         var id = [];

        $( ".tran_check" ).each(function() {
            if($(this).is(":checked")){
                id.push($(this).val());
            }
        });
        $("#invoice_id").val(id);
    }
    // });
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var id = $(this).attr("id");
        $("#delete_id").val(id);
        $("#deleteModal").modal('show');
    });
    $("#delete_revenuee").on('click', function(e){
        e.preventDefault();
        var id = $("#delete_id").val();
        var delete_reason = $("#delete_reason").val();
        // alert(delete_reason);
        var url = "<?php echo url('/'); ?>/delete_revenue_record";
        $.ajax({
              url: url,
              data: 'id=' + id + '&reason=' + delete_reason + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
               // alert("Deleted Succesfully.");
                //location.reload();
                 redirect_notify("Deleted Successfully."," ",location.reload(),"success");
                // alert(response);
            }
        });
    });
    $("#account_description").change(function(){
        var val = $(this).val();
        // alert(val);
        var url = "<?php echo url('/'); ?>/account_description_amount";
        $.ajax({
              url: url,
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                if(response != ""){
                    $("#bill").val(response);
                    $("#bill").attr('readonly', true);
                }
                else{
                    $("#bill").val(0);
                    $("#bill").removeAttr("readonly");
                }
                tax_calc();
            }
        });
    });
</script>


<script>
        var up_bill = document.getElementById('bill').value;
        var up_discount = document.getElementById('discount_field').value;
        var up_amount_paid = document.getElementById('amount_paid').value;

        document.getElementById('bill').value = parseFloat(up_bill).toFixed(2);
        document.getElementById('discount_field').value = parseFloat(up_discount).toFixed(2);
        document.getElementById('amount_paid').value = parseFloat(up_amount_paid).toFixed(2);

        document.getElementById('discounted').value = (up_bill - up_discount).toFixed(2);

        var up_discounted = document.getElementById('discounted').value;
        var up_tax = document.getElementById('tax').value;
        var up_shipping = document.getElementById('shipping').value;
        var up_total = document.getElementById('total').value;

        document.getElementById('total').value = (parseFloat(up_discounted)+parseFloat(up_tax)+parseFloat(up_shipping)).toFixed(2);

        var up_blnc = document.getElementById('total').value - document.getElementById('amount_paid').value;
        var temp_b = document.getElementById('balance');

        temp_b.value = (-1*up_blnc).toFixed(2);
        temp_b.style.color = 'red';

        function empty_f() {
            document.getElementById('discount_field').value = '';
            document.getElementById('discounted').value = '';
        }

</script>

@endsection
