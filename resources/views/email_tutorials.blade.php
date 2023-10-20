@extends('layouts.main')
@section('content')
    <style>
        .clipboard {
            display: inline-block;
        }

        /* You just need to get this field */
        .copy-input {
            max-width: 324px;
            width: 100%;
            cursor: pointer;
            background-color: #eaeaeb;
            border: none;
            color: #6c6c6c;
            font-size: 14px;
            border-radius: 5px;
            padding: 10px 45px 10px 15px;
            font-family: 'Montserrat', sans-serif;
            border: #da291c7a 1px solid !important
                /* box-shadow: 0 3px 15px #b8c6db;
     -moz-box-shadow: 0 3px 15px #b8c6db;
      -webkit-box-shadow: 0 3px 15px #b8c6db;*/
        }

        .copy-input:focus {
            outline: none;
        }

        .copy-btn {
            width: 40px;
            background-color: #eaeaeb;
            font-size: 16px;
            padding: 6px 9px;
            border-radius: 5px;
            border: none;
            color: #6c6c6c;
            margin-left: -50px;
            transition: all .4s;
        }

        .copy-btn:hover {
            transform: scale(1.1);
            color: #1a1a1a;
            cursor: pointer;
        }

        .copy-btn:focus {
            outline: none;
        }

        .copied {
            font-family: 'Montserrat', sans-serif;
            width: 75px;
            display: none;
            position: absolute;
            bottom: 0px;
            left: 150px;
            margin: auto;
            color: #000;
            padding: 15px 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 3px 15px #b8c6db;
            -moz-box-shadow: 0 3px 15px #b8c6db;
            -webkit-box-shadow: 0 3px 15px #b8c6db;
        }

        .copied1 {
            font-family: 'Montserrat', sans-serif;
            width: 75px;
            display: none;
            position: absolute;
            bottom: 0px;
            left: 470px;

            margin: auto;
            color: #000;
            padding: 15px 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 3px 15px #b8c6db;
            -moz-box-shadow: 0 3px 15px #b8c6db;
            -webkit-box-shadow: 0 3px 15px #b8c6db;
        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2) {
            .copy-btn {
                width: 30px;
                background-color: #eaeaeb;
                font-size: 16px;
                padding: 6px 9px;
            }

            .copied {
                bottom: 130px;
                left: 150px;
            }

            .copied1 {
                bottom: 90px;
                left: 150px;
            }

            .copy-input {
                margin-bottom: 10px;
            }
        }
    </style>
    <script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
    <section>
        <div class="container">
            <div class="row">
                <!-- tabs content -->
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12 ">
                        <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                            <h4>Email Management / Tutorials</h4>
                        </div>
                        <div class="col-md-12 text-center margin-bottom-20" style="padding:0;">
                            <span style="display:inline-block;max-width: 344px;width: 100%;">
                                <label style="display:block;text-align: center;">Your Website link</label>
                                <input onclick="copy1()" class="copy-input" value="{{ $my_profile_link }}"
                                    id="copyClipboard1" style="margin-right:20px;" readonly>
                            </span>
                            <button type="button" class="copy-btn" id="copyButton" onclick="copy1()"><i
                                    class="far fa-copy"></i></button>
                            <div id="copied-success1" class="copied">
                                <span>Copied!</span>
                            </div>
                            <span style="display:inline-block;max-width: 344px;width: 100%;">
                                <label style="display:block;text-align: center;">Referral link</label>
                                <input onclick="copy()" class="copy-input" value="{{ $my_referral_link }}"
                                    id="copyClipboard" style="margin-right:20px;" readonly>
                            </span>
                            <button type="button" class="copy-btn" id="copyButton" onclick="copy()"><i
                                    class="far fa-copy"></i></button>
                            <div id="copied-success" class="copied1">
                                <span>Copied!</span>
                            </div>

                            <div class="margin-top-10">
                                <a href="#" class="btn btn-md btn-info margin-right-10">View Offers</a>
                                <a href="#" class="btn btn-md btn-info margin-right-10">My Faith</a>
                                <a href="{{ url('birthplace') }}" class="btn btn-md btn-info margin-right-10">My Birth
                                    Place</a>
                                <a href="#" class="btn btn-md btn-info margin-right-10">Sharing</a>
                                <a href="#" class="btn btn-md btn-info margin-right-10">My City Guide</a>
                                <?php if($chat != "off"){ ?>
                                <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                                <?php } ?>
                                <?php if($tools != "off"){ ?>
                                <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                                <?php } ?>
                                <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">My Daily
                                    Briefing</a>
                                <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                            </div>
                        </div>



                        <!--<ul class="nav nav-tabs nav-button-tabs nav-justified   margin-bottom-40">
                                        <li class="active"><a href="#tab1" data-toggle="tab" >Email Tutorials</a></li>
                                        <li><a href="#tab2" data-toggle="tab" >Card Tutorials</a></li>
                                        <li><a href="#tab3" data-toggle="tab" >Videos  Tutorials</a></li>
                                        <li><a href="#tab4" data-toggle="tab" >Chat  Tutorials</a></li>
                                        <li><a href="#tab5" data-toggle="tab" >SMS  Tutorials</a></li>
                                        
                                    </ul>
                                    <div class="tab-content margin-top-10"  style="border:1px solid #da291c !important; border-radius:10px;padding:20px;">
                                    <div class="tab-pane fade in active" id="tab1">-->
                        <div class="row">
                            <?php 
                            foreach ($tutorials as $video) {
                        ?>
                            <div class="col-md-6 col-sm-6">
                                <div class="margin-bottom-10">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <video width="100%" height="450" controls="true" poster="" id="video"
                                            class="get_vid" data-vid="<?= $video->id ?>" muted>
                                            <source src="<?php echo asset('public/videos'); ?>/<?= $video->video ?>" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                                <h4 class="text-center"><?= $video->name ?></h4>
                            </div>
                            <input type="hidden" id="video_id" value="<?= $video->id ?>">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="played">
    <script type="text/javascript">
        function copy() {
            var copyText = document.getElementById("copyClipboard");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            $('#copied-success').fadeIn(800);
            $('#copied-success').fadeOut(800);
        }

        function copy1() {
            var copyText = document.getElementById("copyClipboard1");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            $('#copied-success1').fadeIn(800);
            $('#copied-success1').fadeOut(800);
        }
    </script>
    <script>
        var base_url = window.location.origin + '/mafama/';
        var video = document.getElementById("video");
        var video_id = document.getElementById("video_id").value;
        var timeStarted = -1;
        var timePlayed = 0;
        var duration = 0;
        // If video metadata is laoded get duration
        if (video.readyState > 0)
            getDuration.call(video);
        //If metadata not loaded, use event to get it
        else {
            video.addEventListener('loadedmetadata', getDuration);
        }
        // remember time user started the video
        function videoStartedPlaying() {
            timeStarted = new Date().getTime() / 1000;
        }

        function videoStoppedPlaying(event) {
            // Start time less then zero means stop event was fired vidout start event
            if (timeStarted > 0) {
                var playedFor = new Date().getTime() / 1000 - timeStarted;
                timeStarted = -1;
                // add the new number of seconds played
                timePlayed += playedFor;
            }
            //document.getElementById("played").innerHTML = Math.round(timePlayed)+"";
            document.getElementById("played").value = Math.round(timePlayed) + "";
            // Count as complete only if end of video was reached
            if (timePlayed >= duration && event.type == "ended") {
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

        function run_complete(video_id) {

            var _token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                method: "POST",
                url: base_url + 'update_video_watching',
                data: {
                    video_id: video_id,
                    _token: _token
                },
                success: function(data) {
                    var data = jQuery.parseJSON(data);
                    if (data.valid == 1) {}
                }
            });
        }
    </script>
@endsection
