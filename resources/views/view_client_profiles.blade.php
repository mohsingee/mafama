@extends('layouts.main')
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 text-right">
                    <a href="{{ url('manage_clients') }}" class="btn btn-md btn-info">Back</a>
                </div>
                <div class="col-md-12 margin-bottom-40">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Client Management / Profile Details</h4>
                    </div>
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
                    <ul class="nav nav-tabs nav-button-tabs nav-justified">
                        <li><a href="{{ url('manage_clients') }}">Client List</a></li>
                        <li class="active"><a href="{{ url('view_client_profiles') }}">Profile Details</a></li>
                    </ul>
                </div>
                <div class="col-md-12 padding-0">
                    <div class="tab-content margin-top-10" style="">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <label style="display: inline-flex; float: right;">Search:<input type="search" class="form-control input-small input-inline margin-left-10" placeholder="" style="margin-top: -10px;" id="filter" /></label>
                        </div>
                        <div class="col-md-12 margin-bottom-40 margin-top-20 padding-0" id="results">
                            <?php
                            foreach($clients as $value){
                            ?>
                                <div class="col-md-3 margin-bottom-20 reslt">
                                    <div class="col-md-12 shadow-boxx">
                                        <div class="col-md-12 padding-0 text-center">
                                            <img src="{{ asset('public/assets/images/client') }}/<?= $value->image ?>" style="border: 1px solid #da291c73 !important; border-radius: 5px; object-fit:cover" width="130" height="130" alt="featured item" />
                                        </div>
                                        <div class="col-md-12 text-center padding-0 margin-top-20">
                                            <table class="profile-info margin-bottom-10" style="width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td><b>Name : </b></td>
                                                        <td><?= $value->first_name ?> <?= $value->last_name ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Start Date : </b></td>
                                                        <td><?= date('d F Y', strtotime($value->created_at)) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>YTD Paid : </b></td>
                                                        <td><?= $paid_amount = \App\Http\Controllers\HomeController::calculatepaidamount($value->email); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Balance : </b></td>
                                                        <td><?= $paid_amount = \App\Http\Controllers\HomeController::calculatebalance($value->email); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Appointment : </b></td>
                                                        <td><?= $appcount = \App\Http\Controllers\HomeController::appointment_get_count($value->id) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Change Apptmt : </b></td>
                                                        <td><?= $appcount2 = \App\Http\Controllers\HomeController::change_appointment_get_count($value->id) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Cancel Apptmt : </b></td>
                                                        <td><?= $appcount3 = \App\Http\Controllers\HomeController::cancel_appointment_get_count($value->id) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Faith : </b></td>
                                                        <td><?= $value->religion ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12 text-center padding-0">
                                            <a href="{{ url('appointment_step3') }}/<?= $value->id ?>" class="btn btn-xs btn-info custom-padding">Make Apptmt</a>
                                            <a href="#" data-toggle="modal" data-target="#modalRegister<?= $value->id ?>" class="btn btn-xs btn-info custom-padding">Send Mail</a>
                                            <a href="#" class="btn btn-xs btn-info custom-padding">More Info</a>
                                        </div>
                                        {{-- <hr /> --}}

                                        <div id="modalRegister<?= $value->id ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title" style="text-align-last: center">Send Mail</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <form action="{{ url('appointment_email_send') }}" method="POST" role="form" enctype="multipart/form-data">
                                                                    @csrf
                                                                        <div class="col-md-12">
                                                                            <input type="email" class="form-control" placeholder="To" name="email" value="<?= $value->email ?>" readonly />
                                                                        </div>
                                                                        <div class="col-md-12 margin-top-20">
                                                                            <input type="text" name="subject" class="form-control" placeholder="Subject" id="subject">
                                                                        </div>
                                                                        <div class="col-md-12 margin-top-20">
                                                                            <textarea class="form-control" name="message" placeholder="Enter message"></textarea>
                                                                        </div>
                                                                        <div class="col-md-12 text-center margin-top-20">
                                                                            <button type="submit" class="btn btn-info subbtn">Send </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    // $(document).ready(function() {
    //     setTimeout(function() {
    //         $("#filter").trigger('keyup');
    //         folder_check_doc();
    //     },1000);
    // })
    $("#filter").keyup(function() {

      // Retrieve the input field text and reset the count to zero
      var filter = $(this).val(),
        count = 0;

      // Loop through the comment list
      $('#results .reslt').each(function() {


        // If the list item does not contain the text phrase fade it out
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
          $(this).hide();  // MY CHANGE

          // Show the list item if the phrase matches and increase the count by 1
        } else {
          $(this).show(); // MY CHANGE
          count++;
        }

      });

    });
</script>
@endsection
