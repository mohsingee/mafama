@extends('layouts.main') 
@section('abanner')
<?php if(count($bbbanner) > 0){ ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="appndbanner" style="margin-bottom: 20px; margin-top: 20px;">
                {!! $bbbanner[0]->preview !!}
            </div>
        </div>
    </div>
</div>
<?php } ?>
@endsection
@section("content")
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.5.0/print.min.css" integrity="sha512-zrPsLVYkdDha4rbMGgk9892aIBPeXti7W77FwOuOBV85bhRYi9Gh+gK+GWJzrUnaCiIEm7YfXOxW8rzYyTuI1A==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.5.0/print.min.js" integrity="sha512-lzGE9ZqdrztBEk1wtq4O60N3WbsTlIvvm6ULCxWRt+CwpRD4WUbgC5aatbtourCUC15PJpqcpZk3VLs12vpNoA==" crossorigin="anonymous"></script>
<style type="text/css">
    .profile-info td:first-child {
        width: 28%;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-40">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Appointments / Steps to make appointment</h4>
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
                    <div class="row process-wizard process-wizard-info">
                        <div class="col-xs-5th process-wizard-step complete">
                            <div class="text-center process-wizard-stepnum">Step 1</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Locate the Professional by Location or by Keyword.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step complete">
                            <!-- complete -->
                            <div class="text-center process-wizard-stepnum">Step 2</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Click Make an Appointment to go to next step.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step complete">
                            <!-- complete -->
                            <div class="text-center process-wizard-stepnum">Step 3</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Click on any available date below to view available time for that date.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step complete">
                            <!-- active -->
                            <div class="text-center process-wizard-stepnum">Step 4</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Enter reason for Appointment.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step complete">
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
                        <div class="col-md-6 col-md-offset-3 margin-bottom-20">
                            <div class="col-md-12 shadow-boxx">
                                <div class="col-md-12 text-center margin-bottom-20" style="background-color: #da291c; padding: 0px; border-radius: 10px;">
                                    <h4 style="color: #fff; font-weight: 400; margin-top: 10px; margin-bottom: 10px;">Appointment for <?= $affiliates->first_name ?> <?= $affiliates->last_name ?></h4>
                                </div>
                                <div class="col-md-4 padding-0">
                                    <img src="{{ asset('public/images/affiliates') }}/<?= $affiliates->image ?>" style="border: 1px solid #da291c73 !important; border-radius: 5px; padding: 5px" width="140" height="140" alt="featured item" />
                                </div>
                                <div class="col-md-8 text-center padding-0">
                                    <table class="profile-info margin-bottom-10">
                                        <tbody>
                                            <tr>
                                                <td><b>Date: </b></td>
                                                <td><input type="text" class="form-control" value="<?= $appointment_date ?>, <?= $day ?>" readonly /></td>
                                            </tr>
                                            <tr>
                                                <td><b>Time: </b></td>
                                                <td><input type="text" class="form-control" value="<?= date('h:i A', strtotime($appointment_time)) ?>" readonly /></td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: baseline;"><b>Address: </b></td>
                                                <td>&nbsp;<?= $affiliates->address ?>, State- <?= $affiliates->state ?>, Country- <?= $affiliates->country ?>, <?= $affiliates->city ?>-<?= $affiliates->zip_code ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Phone: </b></td>
                                                <td>&nbsp;<?= $affiliates->cellphone ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Faith: </b></td>
                                                <td>&nbsp;<?= $affiliates->religion ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button class="btn btn-sm btn-info" style="margin-right: 10px; width: 200px;" id="printMe" onclick="printDiv('print_appointment','Appointment Details')">Print</button>
                            <a href="{{ url('/') }}" class="btn btn-sm btn-info" style="margin-right: 10px; width: 200px;">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div style="display: none">
    <div id="print_appointment">
        <div style="padding: 10px 20px">
            <div style="border: 2px solid red; padding: 10px;">
                <div class="row" style="">
                    <div class="col-md-12" style="margin-bottom: 10px">
                        {!! $banner->preview !!}
                    </div>
                    <div class="col-md-12" style="margin-bottom: 20px; text-align: center;">
                        <div style="background-color: #da291c !important; border-radius: 10px; padding: 10px">
                            <h4 style="color: #fff !important; font-weight: 400; margin-top: 10px; margin-bottom: 10px;">Appointment for <?= $affiliates->first_name ?> <?= $affiliates->last_name ?></h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="text-align: center">
                        <img src="{{ asset('public/images/affiliates') }}/<?= $affiliates->image ?>" style="border: 1px solid #da291c73 !important; border-radius: 5px; padding: 5px" width="140" height="140" alt="featured item" />
                    </div>
                    <div class="col-md-9">
                        <table style="margin-bottom: 20px">
                            <tbody>
                                <tr>
                                    <td><b>Date: </b></td>
                                    <td><b><?= $appointment_date ?>, <?= $day ?></b></td>
                                </tr>
                                <tr>
                                    <td><b>Time: </b></td>
                                    <td><b><?= date('h:i A', strtotime($appointment_time)) ?></b></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: baseline;"><b>Address: </b></td>
                                    <td>&nbsp;<?= $affiliates->address ?>, <br>State- <?= $affiliates->state ?>, Country- <?= $affiliates->country ?>, <br><?= $affiliates->city ?>-<?= $affiliates->zip_code ?></td>
                                </tr>
                                <tr>
                                    <td><b>Phone: </b></td>
                                    <td>&nbsp;<?= $affiliates->cellphone ?></td>
                                </tr>
                                <tr>
                                    <td><b>Faith: </b></td>
                                    <td>&nbsp;<?= $affiliates->religion ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function printDiv(divId, title) {
      var stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css';
      let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

      mywindow.document.write(`<html><head><title>${title}</title>`);
      mywindow.document.write('<link rel="stylesheet" href="' + stylesheet + '">');
      mywindow.document.write('</head><body >');
      mywindow.document.write(document.getElementById(divId).innerHTML);
      mywindow.document.write('</body></html>');

      mywindow.document.close(); // necessary for IE >= 10
      mywindow.focus(); // necessary for IE >= 10*/

      mywindow.print();
      // mywindow.close();

      return true;
    };
</script>
@endsection