@extends('layouts.main') 
@section("content")
<style type="text/css">
    .noti_ul li{
        margin: 7px 0;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Notifications</h4>
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
                <div class="col-md-12">

                     <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="tab1">
                            <p style="color: red" id="emailer"></p>
                            <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                <thead>
                                    <tr>
                                         <th>Activity</th>
                                    <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->notification }}</td>
                                    <td>{{ $notification->created_at }}</td>
                                </tr>
                            @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

@endsection