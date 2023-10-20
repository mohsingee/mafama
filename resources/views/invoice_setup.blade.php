@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-20">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Settings / Invoice Setup</h4>
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
                        <li><a href="{{ url('create_revenue_account') }}">Create Revenue Account</a></li>
                        <li><a href="{{ url('create_expenses_account') }}">Create Expense Account</a></li>
                        <li class="active"><a href="{{ url('invoice_setup') }}">Invoice Setup</a></li>
                        <li><a href="#">Balance Sheet</a></li>
                        <li><a href="{{ url('templates') }}">Choose a template</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <form id="" action="" method="">
                            <div class="col-md-12" style="border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                <div class="row" style="margin: 0px;">
                                    <h5 class="text-center">To Setup your Invoice, answer the following two questions.</h5>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex;">
                                            <label class="form-label" style="line-height: 30px;">I will collect sales Tax. : </label>
                                            <label class="radio margin-left-10 margon-top-0">
                                                <input type="radio" name="radio-btn" value="1" checked="checked" />
                                                <i></i> Yes
                                            </label>
                                            <label class="radio margin-top-0">
                                                <input type="radio" name="radio-btn" value="2" />
                                                <i></i> No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 tax-div">
                                        <div class="form-group">
                                            <label class="form-label">Enter the Tax Rate here </label>
                                            <input type="text" class="form-control" placeholder="Example: .05" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin: 0px;">
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex;">
                                            <label class="form-label" style="line-height: 30px;">I will collect shipping cost. : </label>
                                            <label class="radio margin-left-10 margon-top-0">
                                                <input type="radio" name="radio-btn1" value="1" />
                                                <i></i> Yes
                                            </label>
                                            <label class="radio margin-top-0">
                                                <input type="radio" name="radio-btn1" value="2" checked="checked" />
                                                <i></i> No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 shipping-div" style="display: none;">
                                        <div class="form-group">
                                            <label class="form-label">Enter the Shipping cost here </label>
                                            <input type="text" class="form-control" placeholder="Example: 9.50" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px;">
                                    <a href="#" class="btn btn-sm btn-info">Save</a>
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $("input[name=radio-btn]").on("change", function () {
            var test = $(this).val();
            if (test == 1) {
                $(".tax-div").show();
            } else {
                $(".tax-div").hide();
            }
        });
        $("input[name=radio-btn1]").on("change", function () {
            var test = $(this).val();
            if (test == 1) {
                $(".shipping-div").show();
            } else {
                $(".shipping-div").hide();
            }
        });
    });
</script>


@endsection