@extends('layouts.main') 

@section("content")

<style type="text/css">

    .profile-info td {

        text-align: left !important;

        /*font-size: 12px;*/

        padding: 0 2px;

        vertical-align: baseline;

    }

    .shadow-boxx

    {

        border:1px solid #da291c73 !important; 

        border-radius:10px;

        padding-top:20px;

        padding-bottom:20px;

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

                        <h4>Appointments / Steps to make appointment</h4>

                    </div>

                </div>

                <!-- <div class="col-md-12 text-right margin-bottom-20">

                    <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>

                    <a href="#" class="btn btn-md btn-info margin-right-10">Tools</a>

                    <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>

                    <a href="{{ url('appointment_step1') }}" class="btn btn-md btn-info">Back</a>

                </div> -->

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

                <!--<ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">

                                    <li class="active"><a href="add_appointment_setting.php">Appointment</a></li>

                                    <li><a href="#">Client Management</a></li>

                                    <li><a href="#">Email Management</a></li>

                                    <li><a href="#">Financial Management</a></li>

                                    

                                </ul>-->

                <div class="col-md-12">

                    <div class="row process-wizard process-wizard-info">

                        <div class="col-xs-5th process-wizard-step complete">

                            <div class="text-center process-wizard-stepnum">Step 1</div>

                            <div class="progress"><div class="progress-bar"></div></div>

                            <a href="#" class="process-wizard-dot"></a>

                            <div class="process-wizard-info text-center">Locate the Professional by Location or by Keyword.</div>

                        </div>



                        <div class="col-xs-5th process-wizard-step active">

                            <!-- complete -->

                            <div class="text-center process-wizard-stepnum">Step 2</div>

                            <div class="progress"><div class="progress-bar"></div></div>

                            <a href="#" class="process-wizard-dot"></a>

                            <div class="process-wizard-info text-center">Click Make an Appointment to go to next step.</div>

                        </div>



                        <div class="col-xs-5th process-wizard-step disabled">

                            <!-- complete -->

                            <div class="text-center process-wizard-stepnum">Step 3</div>

                            <div class="progress"><div class="progress-bar"></div></div>

                            <a href="#" class="process-wizard-dot"></a>

                            <div class="process-wizard-info text-center">Click on any available date below to view available time for that date.</div>

                        </div>



                        <div class="col-xs-5th process-wizard-step disabled">

                            <!-- active -->

                            <div class="text-center process-wizard-stepnum">Step 4</div>

                            <div class="progress"><div class="progress-bar"></div></div>

                            <a href="#" class="process-wizard-dot"></a>

                            <div class="process-wizard-info text-center">Enter reason for Appointment.</div>

                        </div>



                        <div class="col-xs-5th process-wizard-step disabled">

                            <!-- active -->

                            <div class="text-center process-wizard-stepnum">Step 5</div>

                            <div class="progress"><div class="progress-bar"></div></div>

                            <a href="#" class="process-wizard-dot"></a>

                            <div class="process-wizard-info text-center">Click on Set Appointment to Proceed.</div>

                        </div>

                    </div>

                    <div class="clearfix"></div>

                    <hr />

                    <div class="col-md-12 margin-bottom-40 margin-top-20">

                        

                            <div class="col-md-12 text-center margin-bottom-20">

                                <h4><?= $searchf ?></h4>

                            </div>

                            <!-- <div class="col-md-12 text-center">

                                <label class="radio-inline">

                                  <input type="radio" name="optradio" value="clients" checked><b> Check for existing Clients </b>

                                </label>

                                <label class="radio-inline">

                                  <input type="radio" name="optradio" value="members"><b> Check for all Members</b>

                                </label>

                            </div> -->

                            <!-- <div class="col-md-12 client_src_sec" style="padding: 20px 0">

                                <?php

                                if(count($clients) <= 0){

                                ?>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="text-right">

                                            <a href="{{ url('add_client') }}" class="btn btn-info">Add Member</a>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <h5 class="text-center">No Result Found <?= $searchf ?></h5>

                                    </div>

                                </div>

                                    

                                <?php

                                }

                                else{

                                ?>

                                <?php

                                    foreach ($clients as $value) {

                                        ?>

                                            <div class="col-md-6 margin-bottom-20">

                                                <div class="col-md-12 shadow-boxx">

                                                    <div class="col-md-4 padding-0">

                                                        <img src="{{ asset('public/assets/images/client') }}/<?= $value->image ?>" style="border: 1px solid #da291c73 !important; border-radius: 5px;" width="140" height="140" alt="featured item" />

                                                    </div>

                                                    <div class="col-md-8 text-center padding-0">

                                                        <table class="profile-info margin-bottom-10">

                                                            <tbody>

                                                                <tr>

                                                                    <td><b>Name: </b></td>

                                                                    <td><?= $value->first_name ?> <?= $value->last_name ?></td>

                                                                </tr>

                                                                <tr>

                                                                    <td><b>Company: </b></td>

                                                                    <td><?= $value->company ?></td>

                                                                </tr>

                                                                

                                                                <tr>

                                                                    <td><b>Address: </b></td>

                                                                    <td><?= $value->address ?>, State- <?= $value->state ?>, Country- <?= $value->country ?>, <?= $value->city ?>-<?= $value->zip_code ?></td>

                                                                </tr>

                                                                <tr>

                                                                    <td><b>Phone: </b></td>

                                                                    <td><?= $value->work_phone ?></td>

                                                                </tr>

                                                                <tr>

                                                                    <td><b>Email: </b></td>

                                                                    <td><?= $value->email ?></td>

                                                                </tr>

                                                                <tr>

                                                                    <td><b>Faith: </b></td>

                                                                    <td><?= $value->religion ?></td>

                                                                </tr>

                                                            </tbody>

                                                        </table>

                                                    </div>

                                                    <div class="clearfix"></div>

                                                    <hr />

                                                    <div class="col-md-12 text-center">

                                                        <a href="{{ url('appointment_step3') }}/<?= $value->id ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: 130px;">Make appointment</a>

                                                        <a href="#" data-toggle="modal" data-target="#modalRegister<?= $value->id ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: 130px;">Send Mail</a>

                                                        <a href="#" class="btn btn-xs btn-info" style="margin-right: 10px; width: 130px;">More Info</a>

                                                    </div>

                                                    <div id="modalRegister<?= $value->id ?>" class="modal fade" role="dialog">

                                                        <div class="modal-dialog">

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

                                }

                                ?>

                            </div> -->

                            <div class="col-md-12"> 

                                <label style="display: inline-flex; float: right;">Search:<input type="search" class="form-control input-small input-inline margin-left-10" placeholder="" style="margin-top: -10px;

                                margin-bottom: 10px;" id="filter" /></label>

                            </div>

                            <div class="col-md-12 member_src_sec" id="results">

                                <!-- <?php

                                foreach ($clients2 as $value) {

                                    ?>

                                        <div class="col-md-6 margin-bottom-20">

                                            <div class="col-md-12 shadow-boxx">

                                                <div class="col-md-4 padding-0">

                                                    <img src="{{ asset('public/assets/images/client') }}/<?= $value->image ?>" style="border: 1px solid #da291c73 !important; border-radius: 5px;" width="140" height="140" alt="featured item" />

                                                </div>

                                                <div class="col-md-8 text-center padding-0">

                                                    <table class="profile-info margin-bottom-10">

                                                        <tbody>

                                                            <tr>

                                                                <td><b>Name: </b></td>

                                                                <td><?= $value->first_name ?> <?= $value->last_name ?></td>

                                                            </tr>

                                                            <tr>

                                                                <td><b>Company: </b></td>

                                                                <td><?= $value->company ?></td>

                                                            </tr>

                                                            

                                                            <tr>

                                                                <td><b>Address: </b></td>

                                                                <td><?= $value->address ?>, State- <?= $value->state ?>, Country- <?= $value->country ?>, <?= $value->city ?>-<?= $value->zip_code ?></td>

                                                            </tr>

                                                            <tr>

                                                                <td><b>Phone: </b></td>

                                                                <td><?= $value->work_phone ?></td>

                                                            </tr>

                                                            <tr>

                                                                <td><b>Email: </b></td>

                                                                <td><?= $value->email ?></td>

                                                            </tr>

                                                            <tr>

                                                                <td><b>Faith: </b></td>

                                                                <td><?= $value->religion ?></td>

                                                            </tr>

                                                        </tbody>

                                                    </table>

                                                </div>

                                                <div class="clearfix"></div>

                                                <hr />

                                                <div class="col-md-12 text-center">

                                                    <a href="{{ url('add_to_client') }}/<?= $value->id ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: auto;">Add to your client list</a>

                                                </div>

                                            </div>

                                        </div>

                                    <?php

                                }

                                ?> -->

                                <?php

                                foreach ($affiliates as $value) {

                                    ?>

                                        <div class="col-md-6 margin-bottom-20 reslt">

                                            <div class="col-md-12 shadow-boxx">

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

                                                    <!-- <a href="{{ url('add_to_client2') }}/<?= $value->id ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: auto;">Add to your client list</a> -->

                                                    <div class="col-md-12 text-center">
                                                       @if(Auth::check())
                                                         @if(Auth::user()->role=='affiliate')
                                                        <a href="{{ url('appointment_step3') }}/<?= $value->id?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: 130px;">Make appointment</a>
                                                         @elseif(Auth::user()->role=='user')
                                                          <a href="{{ url('user_appointment_step3') }}/<?= $value->id ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: 130px;">Make appointment</a>
                                                        @else
                                                          <a href="{{ url('member_appointment_step3') }}/<?= $value->id ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: 130px;">Make appointment</a>
                                                        @endif

                                                        @endif

                                                        <a href="#" data-toggle="modal" data-target="#modalRegister<?= $value->id ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: 110px;">Send Mail</a>

                                                        <a href="{{ url('user/'.$value->username) }}" class="btn btn-xs btn-info" style="margin-right: 10px; width: 110px;">More Info</a>

                                                    </div>

                                                    <div id="modalRegister<?= $value->id ?>" class="modal fade" role="dialog">

                                                        <div class="modal-dialog">

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

                                        </div>

                                    <?php

                                }

                                ?>

                                <!-- <?php

                                foreach ($users as $value) {

                                    ?>

                                        <div class="col-md-6 margin-bottom-20 reslt">

                                            <div class="col-md-12 shadow-boxx">

                                               

                                                <div class="col-md-12 text-center padding-0">

                                                    <table class="profile-info margin-bottom-10">

                                                        <tbody>

                                                            <tr>

                                                                <td><b>Name: </b></td>

                                                                <td><?= $value->first_name ?> <?= $value->last_name ?></td>

                                                            </tr>

                                                            <tr>

                                                                <td><b>Address: </b></td>

                                                                <td><?= $value->address ?>, State- <?= $value->state ?>, Country- <?= $value->country ?>, <?= $value->city ?>-<?= $value->zip ?></td>

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

                                                        </tbody>

                                                    </table>

                                                </div>

                                                <div class="clearfix"></div>

                                                <hr />

                                                <div class="col-md-12 text-center">

                                                    <a href="{{ url('add_to_client3') }}/<?= $value->id ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: auto;">Add to your client list</a>

                                                </div>

                                            </div>

                                        </div>

                                    <?php

                                }

                                ?> -->



                            </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<script type="text/javascript">

    $('input[type="radio"]').change(function(){

        var val = $(this).val();

        if(val == "members"){

            $(".member_src_sec").show();

            $(".client_src_sec").hide();

        }

        else if(val == "clients"){

            $(".member_src_sec").hide();

            $(".client_src_sec").show();

        }

    })

</script>

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