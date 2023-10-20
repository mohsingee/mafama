@extends('layouts.main')
@section("content")

<style>
    #status span.status {
  display: none;
  font-weight: bold;
}
span.status.complete {
  color: green;
}
span.status.incomplete {
  color: red;
}
#status.complete span.status.complete {
  display: inline;
}
#status.incomplete span.status.incomplete {
  display: inline;
}

</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-20">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Settings / Tutorials</h4>
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
                    <!--<ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                                    <li class="active"><a href="add_appointment_setting.php">Appointment</a></li>
                                    <li><a href="#">Client Management</a></li>
                                    <li><a href="#">Email Management</a></li>
                                    <li><a href="#">Financial Management</a></li>

                                </ul>

                                <div class="tab-content margin-top-10"  style="border:1px solid #da291c !important;  border-radius:10px;padding:10px;">-->
                    <div class="row">
                        <?php
                         if(count($tutorials) >0)
                        {
                            foreach ($tutorials as $video) {
                        ?>
                            <div class="col-md-6 col-sm-6">
                                <div class="margin-bottom-10">
                                    <div class="embed-responsive embed-responsive-16by9">

                                       <video width="100%"  height="450" controls="true" poster="" id="video" class="get_vid" data-vid="<?=$video->id;?>" muted>
                                    <source src="<?php echo asset("public/videos/intro") ?>/<?= $video->video ?>" type="video/mp4">
                                    </video>


                                    </div>

                                </div>

                                <h4 class="text-center"><?= $video->name ?></h4>
                            </div>
                            <input type="hidden" id="video_id" value="<?=$video->id;?>" >
                        <?php }
                            } ?>
                    </div>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</section>

<input type="hidden" id="played" >



@endsection