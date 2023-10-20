@extends('layouts.main') 
@section("content")
<style type="text/css">
     input#purchase_date, input#reminderdate {
        position: relative;
        /*width: 150px; height: 20px;*/
        /*color: white;*/
    }
    input#purchase_date:before, input#reminderdate:before {
        position: absolute;
        /*top: 3px; left: 3px;*/
        content: attr(data-date);
        display: inline-block;
        color: black;
    }

    input#purchase_date::-webkit-datetime-edit, input#purchase_date::-webkit-inner-spin-button, input#purchase_date::-webkit-clear-button {
        display: none;
    }
    input#purchase_date::-webkit-datetime-edit, input#reminderdate::-webkit-inner-spin-button, input#reminderdate::-webkit-clear-button {
        display: none;
    }

    input#purchase_date::-webkit-calendar-picker-indicator {
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
                <div class="col-md-12 margin-bottom-20">
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
                        <li><a href="{{ url('expenses_reord') }}"> Record Expenses</a></li>
                        <li class="active"><a href="{{ url('manage_assets') }}">Record / Manage Assets</a></li>
                        <?php if($upload_files != "off"){ ?>
                            <li><a href="{{ url('upload_files') }}">Upload Files</a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <div class="col-md-12">
                            <form method="POST" id="record_expense" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12" style="border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"> Purchase Date </label>
                                            <!--<input type="text" class="form-control datepicker" name="purchase_date" placeholder="" value="<?= $record->purchase_date ?>" />-->
                                             <input type="date" name="purchase_date" class="form-control" value="<?= $record->purchase_date ?>"  data-date="" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" id="purchase_date" required>
                           
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Quantity </label>
                                            <input type="number" class="form-control" placeholder="" name="quantity" value="<?= $record->quantity ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Purchase Price </label>
                                            <input type="text" class="form-control" placeholder="" name="price" value="<?= $record->price ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Item Description </label>
                                            <input type="text" class="form-control" placeholder="" name="description" value="<?= $record->description ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Reason for updating</label>
                                        <textarea class="form-control" name="reason" required></textarea>
                                    </div>
                                    <div class="col-md-12 text-center" style="margin-top: 20px; margin-bottom: 20px;">
                                        <input type="hidden" name="id" value="<?= $record->id ?>">
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
     $("#record_expense").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
              type: "POST",
              beforeSend: function(){
                $("#loading").show();
                $("#wrapper").hide();
              },
              url: "asset_records_update",
              data:  formData,
                contentType: false,
                cache: false,
                processData:false,
              success: function(html) {
                // alert(html);
               // location.reload();
               // alert("Updated Successfully.")
                redirect_notify("Updated Successfully."," ","manage_assets","success");
              },
              complete: function(){
                $("#loading").hide();
                $("#wrapper").show();
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
      
        $('#purchase_date').attr('max', maxDate);
    });
    $("#purchase_date").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change");
</script>

@endsection