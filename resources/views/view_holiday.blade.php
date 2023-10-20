@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ url('schedule_holiday') }}" class="btn btn-md btn-info">Back</a>
                    </div>
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Client Management / Holiday Details</h4>
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
                    <div class="col-md-12" style="border: 1px solid #da291c !important; border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Holiday Name </label>
                                <input type="text" class="form-control" placeholder="Holiday Test" readonly />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Date </label>
                                <input type="text" class="form-control datepicker" placeholder="12-04-2020" readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection