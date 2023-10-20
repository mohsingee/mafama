@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-20">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Email Managements / Manage</h4>
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
                    <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
                        <li><a href="{{ url('manage_folders') }}">Manage Folders</a></li>
                        <li><a href="{{ url('manage_contacts') }}">Manage Contacts</a></li>
                        <li><a href="{{ url('manage_emails') }}">Manage Emails</a></li>
                        <li class="active"><a href="{{ url('uploads') }}">Uploads</a></li>
                        <!--<li><a href="#">My Mailbox</a></li>-->
                    </ul>
                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <?php
                            foreach ($category as $value) {
                        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><?= $value->category ?></h4>
                                </div>
                                <?php 
                                    $imgs = \App\Http\Controllers\HomeController::get_imag($value->category);
                                    foreach ($imgs as $img) { 
                                ?>
                                        <div class="col-md-2 col-sm-2 margin-bottom-10">
                                            <img src="<?php echo asset('public/images')?>/<?= $img->image ?>" alt="" style="width: 100%;" />
                                        </div>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="clearfix"></div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection