@extends('layouts.main') 
@section("content")


<style>
    .checkbox + .checkbox,
    .radio + .radio {
        margin-top: 0px;
    }
    td.radio i,
    .checkbox i {
        position: inherit;
    }
</style>
<!-- -->
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Settings / Email Management Settings</h4>
                    </div>
                    <div class="col-md-12 text-right margin-bottom-20">
                        <div class="margin-top-10">
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
                    </div>
                    <ul class="nav nav-tabs nav-button-tabs margin-bottom-20">
                        <li class="active"><a href="#tab1" data-toggle="tab">Chat Settings</a></li>
                        <!--<li><a  href="#tab2" data-toggle="tab">Form Upload</a></li>-->
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <div class="tab-pane fade in active" id="tab1"></div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection