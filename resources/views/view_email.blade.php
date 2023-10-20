@extends('layouts.main') 
@section("content")
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-20">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>{{ $title }}</h4>
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
                </div>
            </div>
        </div>
        @if($useremail!="")
        <div class="row">
            <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Compaign Name</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Image</th>
                        <th>date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($useremail as $user)
                    <tr>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->campaign_name }}</td>
                        <td>{{ $user->subject }}</td>
                        <td>{{ $user->message }}</td>
                        <td><img src="<?=asset('public/videos/'.$user->image) ?>" alt="" style="width:100px;height: 100px"></td>
                        <td>@if($user->updated_at!=NULL){{ date_formate($user->updated_at) }}@else{{ date_formate($user->created_at) }}@endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        @if($usersms!="")
        <div class="row">
            <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                    <tr>
                        <th>Phone No.</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Greeting</th>
                        <th>Image</th>
                        <th>date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usersms as $user)
                    <tr>
                        <td>{{ $user->phone_no }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->subject }}</td>
                        <td>{{ $user->message }}</td>
                        <td>{{ $user->greeting }}</td>
                        <td><img src="<?=asset('public/videos/'.$user->image) ?>" alt="" style="width:100px;height: 100px"></td>
                        <td>@if($user->updated_at!=NULL){{ date_formate($user->updated_at) }}@else{{ date_formate($user->created_at) }}@endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</section>
@endsection