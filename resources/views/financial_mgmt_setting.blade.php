@extends('layouts.main')
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Settings / Financial Management</h4>
                    </div>
                    <div class="col-md-12 text-right margin-bottom-20">
                        <a href="#" class="btn btn-md btn-info margin-right-10">View Offers</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My Faith</a>
                        <a href="{{ url('birthplace') }}" class="btn btn-md btn-info margin-right-10">My Birth Place</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">Sharing</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My City Guide</a>
                        <?php if($chat != "off"){ ?>
                            <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                        <?php } ?>
                        <?php if($tools != "off"){ ?>
                            <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                        <?php } ?>
                        <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">My Daily Briefing</a>
                        <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                    </div>
                    <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-30">
                        <li class="active"><a href="{{ url('financial_mgmt_setting') }}">Create Revenue Account</a></li>
                        <li><a href="{{ url('financial_mgmt_expenses_settings') }}">Create Expense Account</a></li>
                        <li><a href="{{ url('financial_mgmt_invoice_setup') }}">Invoice Setup</a></li>
                        <li><a href="{{ url('balancesheet_template1') }}">Balance Sheet</a></li>
                        <li><a href="{{ url('financial_mgmt_choose_template') }}">Activate Financial Accounts</a></li>
                    </ul>

                    <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                        <li><a href="{{ url('create_budget') }}">Budget Set-up</a></li>
                        <li><a href="{{ url('projection_setup') }}">Projection Set-up</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <div class="tab-pane fade in active" id="tab1">
                            <form id="revenue_account_submit" class="" method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12" style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">Account Name</label>
                                            <input type="text" class="form-control" name="account_name" id="revenue_account_name" />
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">Default Amount (optional)</label>
                                            <input type="text" class="form-control" name="amount" id="revenue_amount" />
                                        </div>
                                    </div>
                                    <div class="col-md-5" id="edit_reason" style="display: none;">
                                        <div class="form-group">
                                            <label class="form-label">Reson for Editing</label>
                                            <textarea class="form-control" name="edit_reason"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 25px;">
                                        <input id="revenueid" type="hidden" name="id" value="">
                                        <button type="submit" class="btn btn-md btn-info" id="revenue_submit">Save</button>
                                        <a class="btn btn-md btn-info" id="revenue_cancel" style="display: none;">Cancel</a>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                            <div class="divider divider-center divider-short">
                                <!-- divider -->
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                                    <thead>
                                        <tr>
                                            <th>List of accounts</th>
                                            <th>Date Created</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($revenue as $value){
                                         $del_check = \App\Http\Controllers\MainController::account_revenue_exits($value->account_name);
                                        ?>
                                            <tr>
                                                <td><?= $value->account_name ?></td>
                                                <td><?= date('d F Y', strtotime($value->date)) ?></td>
                                                <td><?= $value->amount ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-xs btn-success edit" id="edit<?= $value->id ?>">Edit</a>
                                                     @if($del_check == 1)
                                                    <a href="javascript:void(0);" class="btn btn-xs btn-info no_delete" >Delete</a>
                                                     @else
                                                    <a href="javascript:void(0);" class="btn btn-xs btn-info delete" id="delete<?= $value->id ?>">Delete</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
                    <a class="btn btn-info" id="delete_revenuee">Save changes</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).on("click", ".no_delete", function () {
     alert('This account can not be delete because it link with transactions');

});
    $("#sample_editable_1").on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).attr("id");
        var url = "<?php echo url('/'); ?>/edit_revenue_aacount";
        $.ajax({
              url: url,
              data: 'id=' + id + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // $(".holiday_date").html(response);
                // alert(response[0]);
                $("#revenue_amount").val(response[1]);
                $("#revenue_account_name").val(response[0]);
                $("#revenue_submit").html("Update");
                $("#revenue_cancel").show();
                $("#edit_reason").show();
                $("#revenueid").val(id);
                $('html, body').animate({
                    scrollTop: $(".nav-button-tabs").offset().top
                }, 500);
            }
        });
    });
    $("#revenue_cancel").on('click', function(e){
        $("#revenue_amount").val("");
        $("#revenue_account_name").val("");
        $("#revenue_submit").html("Save");
        $("#revenue_cancel").hide();
        $("#revenueid").val("");
    });
    $("#sample_editable_1").on('click', '.delete', function (e) {
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
        var url = "<?php echo url('/'); ?>/delete_revenue_aacount";
        $.ajax({
              url: url,
              data: 'id=' + id + '&delete_reason=' + delete_reason + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                alert("Deleted Succesfully.");
                location.reload();
                // alert(response);
            }
        });
    });
    $(document).ready(function(){
        $("#revenue_account_submit").submit(function(e) {
            // alert("hi");
            e.preventDefault();
            var submit_value  = $("#revenue_submit").html();
            var formData = new FormData(this);
            if(submit_value == "Save"){
                $.ajax({
                  type: "POST",
                  beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
                  url: "revenue_account_submit",
                  data:  formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                  success: function(html) {
                    alert("Inserted Succesfully.");

                    location.reload();
                  },
                  complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                  }
                });
            }
            if(submit_value == "Update"){
                $.ajax({
                  type: "POST",
                  beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
                  url: "revenue_account_update",
                  data:  formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                  success: function(html) {
                    location.reload();
                    alert("Updated Succesfully.");
                    $("#revenueid").val("");
                  },
                  complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                  }
                });
            }
        });
    });
</script>

@endsection
