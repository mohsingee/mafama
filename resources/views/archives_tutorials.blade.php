@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-20">
                    <div class="col-md-12 text-right">
                        <a href="{{ url('/') }}" class="btn btn-md btn-info">Back</a>
                    </div>
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Archives / Tutorials</h4>
                    </div>
                    <div class="col-md-12 text-right margin-bottom-40">
                        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">Tools</a>
                        <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info">Calender meetings / tasks</a>
                    </div>
                    <!--<ul class="nav nav-tabs nav-button-tabs nav-justified   margin-bottom-20" style="">
                                    <li class="active"><a href="#tab1" data-toggle="tab">Appointment Tutorials</a></li>
                                    <li><a href="#tab2" data-toggle="tab">Client Management Tutorials</a></li>
                                    <li><a href="#tab3" data-toggle="tab">Email Management Tutorials</a></li>
                                    <li><a href="#tab4" data-toggle="tab">Financial Management tutorials</a></li>
                                    
                                </ul>
                                <div class="tab-content margin-top-10"  style="border:1px solid #da291c !important;   border-radius:10px;padding:10px;">-->
                    <div class="tab-pane fade in active" id="tab1">
                        <div class="row">
                            <?php 
                            $video_id='';
                            if(count($tutorials)>0)
                            {
                            foreach ($tutorials as $video) {
                                $video_id=$video->id;
                        ?>
                            <div class="col-md-6 col-sm-6">
                                <div class="margin-bottom-10">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <video width="100%"  height="450"  controls="true" poster="" id="video" class="get_vid" data-vid="<?=$video->id;?>" muted>
                                            <source src="<?php echo asset("public/videos") ?>/<?= $video->video ?>" type="video/mp4">
                                        </video>
                                    </div>
                                </div>

                                <h4 class="text-center"><?= $video->name ?></h4>
                            </div>
                        <?php } } ?>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</section>

<input type="hidden" id="video_id" value="<?=$video_id;?>" >
<input type="hidden" id="played" >

<script>
var base_url = window.location.origin+'/mafama/';
var video = document.getElementById("video");
var video_id = document.getElementById("video_id").value;


var timeStarted = -1;
var timePlayed = 0;
var duration = 0;
// If video metadata is laoded get duration
if(video.readyState > 0)
  getDuration.call(video);
//If metadata not loaded, use event to get it
else
{
  video.addEventListener('loadedmetadata', getDuration);
}
// remember time user started the video
function videoStartedPlaying() {
  timeStarted = new Date().getTime()/1000;
}
function videoStoppedPlaying(event) {
  // Start time less then zero means stop event was fired vidout start event
  if(timeStarted>0) {
    var playedFor = new Date().getTime()/1000 - timeStarted;
    timeStarted = -1;
    // add the new number of seconds played
    timePlayed+=playedFor;
  }
  //document.getElementById("played").innerHTML = Math.round(timePlayed)+"";
  document.getElementById("played").value = Math.round(timePlayed)+"";
  // Count as complete only if end of video was reached
  if(timePlayed>=duration && event.type=="ended") {
   // alert('ho gya ');
   run_complete(video_id);
    //document.getElementById("status").className="complete";
  }
}

function getDuration() {
  duration = video.duration;
  //document.getElementById("duration").appendChild(new Text(Math.round(duration)+""));
  console.log("Duration: ", duration);
}

video.addEventListener("play", videoStartedPlaying);
video.addEventListener("playing", videoStartedPlaying);

video.addEventListener("ended", videoStoppedPlaying);
video.addEventListener("pause", videoStoppedPlaying);

function run_complete(video_id){   
    
        var _token = $("meta[name='csrf-token']").attr("content");                 
           $.ajax({
            method:"POST",
            url:base_url+'update_video_watching',
            data:{video_id:video_id,_token:_token},
            success:function(data)
            {                
              var data = jQuery.parseJSON(data);
              if(data.valid == 1)
              {  

              }
            }
        });
}

</script>
@endsection