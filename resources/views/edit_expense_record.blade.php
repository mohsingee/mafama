@extends('layouts.main') 
@section("content")
<style type="text/css">
    input#transaction_date, input#reminderdate {
        position: relative;
        /*width: 150px; height: 20px;*/
        /*color: white;*/
    }
    input#transaction_date:before, input#reminderdate:before {
        position: absolute;
        /*top: 3px; left: 3px;*/
        content: attr(data-date);
        display: inline-block;
        color: black;
    }

    input#transaction_date::-webkit-datetime-edit, input#transaction_date::-webkit-inner-spin-button, input#transaction_date::-webkit-clear-button {
        display: none;
    }
    input#reminderdate::-webkit-datetime-edit, input#reminderdate::-webkit-inner-spin-button, input#reminderdate::-webkit-clear-button {
        display: none;
    }

    input#transaction_date::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
    input#reminderdate::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
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
                    <li><a href="{{ url('revenue_records') }}"> Record Revenue</a></li>
                    <li class="active"><a href="{{ url('expenses_reord') }}"> Record Expenses</a></li>
                    <li><a href="{{ url('manage_assets') }}">Record / Manage Assets</a></li>
                    <?php if($upload_files != "off"){ ?>
                        <li><a href="{{ url('upload_files') }}">Upload Files</a></li>
                    <?php } ?>
                </ul>
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <div class="col-md-12">
                        
                         <div class="row margin-bottom-20">
                            <form action="{{ url('expense_record_update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-4">
                                    <label>Trasaction Date</label>
                                    <input type="date" name="transaction_date" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= $expense_record->transaction_date ?>" id="transaction_date" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Accounts / Description</label>
                                    <select class="form-control" name="account_description" id="account_description">
                                        <?php
                                            foreach($expenses_account as $value){
                                        ?>
                                                <option value="<?= $value->account_name ?>" <?php if($expense_record->account_description == $value->account_name){ ?> selected <?php } ?>><?= $value->account_name ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Charged / Bill</label>
                                    <input type="number" name="total" class="form-control" value="<?= $expense_record->total ?>" id="bill" <?php if($expense_record->total != ""){ ?> readonly <?php } ?> required>
                                </div>
                                <div class="col-md-4">
                                    <label>Amount Paid</label>
                                    <input type="number" name="amount_paid" class="form-control" value="<?= $expense_record->amount_paid ?>" id="amount_paid" required>
                                    <p id="paid_alert" style="color: red; margin-bottom: 5px"></p>
                                </div>
                                <div class="col-md-4">
                                    <label>Balance</label>
                                    <input type="text" name="balance" class="form-control" value="<?= $expense_record->balance ?>" id="balance" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label>Reason for updating</label>
                                    <textarea class="form-control" name="reason" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 padding-0 text-center margin-bottom-20">
                                <input type="hidden" name="id" value="<?= $expense_record->id ?>">
                                <button type="submit" class="btn btn-xs btn-info" style="width: 100px;">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $("#bill").on("input", function(){
        var bill = $(this).val();
        var amount_paid = $("#amount_paid").val();
        
        var balance = $("#balance").val();
        if(amount_paid != 0){
            var balance_amount = parseFloat(amount_paid) - parseFloat(bill); 
            $("#balance").val(balance_amount);
        }
        else if(amount_paid == 0){
            $("#balance").val("NaN");
        }
        else{
            $("#balance").val("NaN");
        }
    });
    $("#amount_paid").on("input", function(){
        var bill = $("#bill").val();
        var amount_paid = $(this).val();
        var balance = $("#balance").val();
        if(amount_paid != 0){
            var balance_amount = parseFloat(amount_paid) - parseFloat(bill); 
            $("#balance").val(balance_amount);
        }
        else if(amount_paid == 0){
            $("#balance").val("NaN");
        }
        else{
            $("#balance").val("NaN");
        }

    });
    setTimeout(function() {
        $("#account_description").trigger('change');
    },1000);
    $("#account_description").change(function(){
        var val = $(this).val();
        // alert(val);
        var url = "<?php echo url('/'); ?>/account_description_amount2";
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
            }
        });
    });
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
</script>

@endsection