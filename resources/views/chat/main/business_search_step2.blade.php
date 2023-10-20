@extends('layouts.main') 
@section("content")
<style type="text/css">
    .profile-info td {
        text-align: left !important;
        /*font-size: 12px;*/
        padding: 0 2px;
        vertical-align: baseline;
    }
    .listbox {
        border: 1px solid #da291c73 !important;
        border-radius: 10px;
        padding-top: 20px;
        padding-bottom: 20px;
        box-shadow: 1px 4px 10px 3px #da291c57;
        height: 300px;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Search for a Business</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 margin-bottom-40 margin-top-20">
                            
                            <div class="col-md-12 text-center margin-bottom-20">
                                <h4><?= $searchf ?></h4>
                            </div>
                            
                            
                            <div class="col-md-12 member_src_sec">
                                
                                <?php
                                foreach ($affiliates as $value) {
                                    ?>
                                        <div class="col-md-6 margin-bottom-20">
                                            <div class="col-md-12 shadow-boxx listbox">
                                                <div class="col-md-4 padding-0">
                                                    <img src="{{ asset('public/images/affiliates') }}/<?= $value->image ?>" style="border: 1px solid #da291c73 !important; border-radius: 5px;" width="140" height="140" alt="featured item" />
                                                </div>
                                                <div class="col-md-8 text-center padding-0">
                                                    <table class="profile-info margin-bottom-10">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Name: </b></td>
                                                                <td><?= $value->first_name ?> <?= $value->last_name ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Address: </b></td>
                                                                <td><?= $value->address ?>, State- <?= $value->state ?>, Country- <?= $value->country ?>, <?= $value->city ?>-<?= $value->zip_code ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Phone: </b></td>
                                                                <td><?= $value->cellphone ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Email: </b></td>
                                                                <td><?= $value->email ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Faith: </b></td>
                                                                <td><?= $value->religion ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Business Telephone: </b></td>
                                                                <td><?= $value->business_telephone ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr />
                                                <div class="col-md-12 text-center">
                                                    @if(Auth::id() == "")
                                                        <a href="{{ url('appointment_login') }}" class="btn btn-xs btn-info" style="margin-right: 10px; width: auto;">Make Appointment</a>
                                                    @elseif((Auth::id() != "") && (Auth::user()->role == "client"))
                                                        <a href="{{ url('member_appointment_step3') }}/<?= base64_encode($value->email) ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: auto;">Make Appointment</a>
                                                    @elseif((Auth::id() != "") && (Auth::user()->role == "temp_user"))
                                                        <a href="{{ url('user_appointment_step3') }}/<?= base64_encode($value->email) ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: auto;">Make Appointment</a>
                                                    @endif
                                                     <a href="{{url('user/'.$value->username)}}" class="btn btn-xs btn-info" style="margin-right: 10px; width: 110px;">More Info</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                                ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection