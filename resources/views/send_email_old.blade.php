@extends('layouts.main') 
@section("content")
<style type="text/css">
    p{
        margin-bottom: 0px;
    }
    p, pre, ul, ol, dl, dd, blockquote, address, table, fieldset, form {
        margin-bottom: 0px !important;
    }
    input#sendon, input#reminderdate {
        position: relative;
        /*width: 150px; height: 20px;*/
        /*color: white;*/
    }
    input#sendon:before, input#reminderdate:before {
        position: absolute;
        /*top: 3px; left: 3px;*/
        content: attr(data-date);
        display: inline-block;
        color: black;
    }
    input#sendon::-webkit-datetime-edit, input#sendon::-webkit-inner-spin-button, input#sendon::-webkit-clear-button {
        display: none;
    }
    input#reminderdate::-webkit-datetime-edit, input#reminderdate::-webkit-inner-spin-button, input#reminderdate::-webkit-clear-button {
        display: none;
    }
    input#sendon::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
    input#reminderdate::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
.clipboard {
  display: inline-block;
}
/* You just need to get this field */
.copy-input {
  max-width: 324px;
  width: 100%;
  cursor: pointer;
  background-color: #eaeaeb;
  border:none;
  color:#6c6c6c;
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
  outline:none;
}
.copy-btn {
  width:40px;
  background-color: #eaeaeb;
  font-size: 16px;
  padding: 6px 9px;
  border-radius: 5px;
  border:none;
  color:#6c6c6c;
  margin-left:-50px;
  transition: all .4s;
}
.copy-btn:hover {
  transform: scale(1.1);
  color:#1a1a1a;
  cursor:pointer;
}
.copy-btn:focus {
  outline:none;
}
.copied {
  font-family: 'Montserrat', sans-serif;
  width: 75px;
  display: none;
  position:absolute;
    bottom: 0px;
    left: 150px;
    margin: auto;
  color:#000;
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
  position:absolute;
    bottom: 0px;
    left: 470px;
    
    margin: auto;
  color:#000;
  padding: 15px 15px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 3px 15px #b8c6db;
  -moz-box-shadow: 0 3px 15px #b8c6db;
  -webkit-box-shadow: 0 3px 15px #b8c6db;
}
@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2) {
    .copy-btn {
  width:30px;
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
.copy-input{
    margin-bottom:10px;
}
}



.btn-title {
    width: 100%;
    font-size: 14px;
    text-transform: capitalize;
}

.carousel-control.left {
   
    background-image: none!important;
    background-repeat: repeat-x;
}
.carousel-control {
    position: absolute;
    top: -16px;
    bottom: 0;
    left: 0;
    width: 0%;
    font-size: 1px;
    color: #000!important;
    text-align: center;
     text-shadow: none; 
    filter: alpha(opacity=50);
     opacity: .8; 
    font-size: 16px!important;
}
.carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right, .carousel-control .icon-next, .carousel-control .icon-prev {
    width: 30px;
    height: 30px;
    margin-top: -15px;
    font-size: 25px!important;
}
.hide-child{display:none;}
</style>
<script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Email Management / Send Email</h4>
                </div>
               <div class="col-md-12 text-right margin-bottom-20">
                  <span style="display:inline-block;max-width: 344px;width: 100%;">
                    <label  style="display:block;text-align: center;">Your Website link</label>
                	<input  onclick="copy1()" class="copy-input" value="{{ $my_profile_link }}"  id="copyClipboard1" style="margin-right:20px;" readonly>
                </span>
                    <button type="button" class="copy-btn" id="copyButton" onclick="copy1()"><i class="far fa-copy"></i></button>
                    <div id="copied-success1" class="copied">
                      <span>Copied!</span>
                    </div> 
                    <span  style="display:inline-block;max-width: 344px;width: 100%;">

                     <label  style="display:block;text-align: center;">Referral link</label>
                    <input  onclick="copy()" class="copy-input" value="{{ $my_referral_link }}"  id="copyClipboard" style="margin-right:20px;" readonly>
                     </span>
                    <button type="button" class="copy-btn" id="copyButton" onclick="copy()"><i class="far fa-copy"></i></button>
                    <div id="copied-success" class="copied1">
                      <span>Copied!</span>
                    </div>
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
                    <form action="" method="POST" id="register" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12" style="background-color: #f6cbc9; border: 1px solid #888; padding-top: 10px; padding-bottom: 10px;">
                                     <div class="col-md-4">
                                     <p class="margin-bottom-0" style="font-size: 15px; color: #da291c;">Folders    <a href="{{ url('manage_contacts') }}"  class="chk-sm" style="color: #fff;margin-left:20px;font-weight:900;font-size:14px!important;background:#10c310e0;padding:4px">Manage/Add Contact</a></p>
                                 </div>
                                <div class="col-md-8 text-center email-btn" >
                                        <div class="row">
                                          <div id="owl-demo" class="owl-carousel owl-theme">
                                            <?php 
                                                $cnt = 1;
                                                foreach($titles as $value){ ?>
                                               <div class=" col-md-12 text-center item " >
                                                        <a onclick="titleClick(this.id)" class="btn btn-xs btn-black btn-title"  id="{{ $value->subject }}">{{ $value->subject }}</a>
                                                    </div>
                                            <?php
                                                $cnt++;
                                                if($cnt == 5){
                                                   // break;
                                                }
                                                }
                                            ?>
                                            </div>
     
        <a class="left carousel-control prev" href="javascript:void(0)" ><i class="glyphicon glyphicon-chevron-left"></i></a>
        <a class="right carousel-control next" href="javascript:void(0)" ><i class="glyphicon glyphicon-chevron-right"></i></a>
      
                                        </div>
                                    </div>
                                 </div>
                                <div class="col-md-2" style="border-right: 1px solid #f6cbc9;">
                                    <h4 style="border-bottom: 1px solid #f6cbc9;">
                                        <label class="checkbox chk-sm" style="color: #da291c;">
                                            <input type="checkbox" value="1" id="folderall" />
                                            <i></i> Select All
                                        </label>
                                    </h4>
                                    <?php 
                                        foreach ($folders as $value) {
                                    ?>                                        
                                            <div class="col-md-12 padding-0">
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" value="<?= $value->id ?>" {{ !empty($id) && ($value->id == $id)?'checked':'' }} class="folder_check" />
                                                    <i></i> <?= $value->folder_name ?>
                                                </label>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                    
                                </div>
                                <div class="col-md-2" style="border-right: 1px solid #f6cbc9; overflow-x: hidden; overflow-y: scroll; height: 500px;">
                                    <h4 style="border-bottom: 1px solid #f6cbc9;">
                                        <label class="checkbox chk-sm" style="color: #da291c;">
                                            <input type="checkbox" value="1" id="contactall" />
                                            <i></i> Select All
                                        </label>
                                    </h4>
                                    <div id="contact_sec">
                                        <?php 
                                        if($contacts !="")
                                        {
                                            foreach ($contacts as $valuee) {
                                        ?>                                        
                                                <div class="col-md-12 padding-0">
                                                    <label class="checkbox chk-sm">
                                                        <input type="checkbox" value="<?= $valuee->id ?>" class="contact_mail" />
                                                        <i></i> <?= $valuee->first_name ?> <?= $valuee->last_name ?>
                                                    </label>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <input type="hidden" name="" value="" id="contactid">
                                </div>
                                <div class="col-md-8">
                                    <div class="col-md-12 text-center email-btn" style="">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <a class="btn btn-xs btn-info text-center personalized_btn" style="margin-top: 10px; margin-right: 3px; margin-bottom: 10px;">Personalized</a>
                                                <a class="btn btn-xs btn-info text-center scripts_btn" style="margin-top: 10px; margin-right: 3px; margin-bottom: 10px;">Scripts</a>
                                                <!-- <a href="#" class="btn btn-xs btn-info" style="margin-top: 10px; margin-bottom: 10px;">Use Scripts</a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 personalized_sec" style="display: none">
                                        <div class="col-md-12 padding-0" style="padding-top: 10px; padding-bottom: 10px;">
                                            <div class="" style="margin-bottom: 10px; border: 1px solid #da291c; border-radius: 3px; padding: 0px 10px;">
                                            <?php
                                                foreach($greetings as $value){
                                            ?>
                                                <div class="text-left" style="padding-left: 0px; display: inline-flex;">
                                                    <a class="btn btn-xs btn-black greetings" style="padding: 3px 20px; margin-top: 10px; margin-bottom: 10px;" id="<?= $value->greetings ?>"><?= $value->greetings ?></a>
                                                </div>
                                            <?php
                                                }
                                            ?> 
                                            <input type="hidden" name="greeting" id="greeting" value="">
                                            </div>       
                                        </div>
                                    </div>
                                    <div class="col-md-12 scripts_sec" style="display: none;">
                                        <div class="col-md-12 padding-0 text-center" style="background-color: #da291c; color: #fff; padding-top: 10px; padding-bottom: 10px;">
                                            Use Scripts
                                        </div>
                                        <div class="col-md-12 padding-0">
                                            <ul class="nav nav-tabs nav-bottom-border category-ul">
                                                <?php 
                                                $c = 0;
                                                    foreach($scripts as $value){
                                                ?>
                                                        <li class="script_cat <?php if($c == 0){echo 'active';} ?>"><a href="#<?= $value->category ?>" data-toggle="tab"><?= $value->category ?></a></li>
                                                <?php
                                                $c++;
                                                    }
                                                ?>
                                                <li  class="script_cat"><a href="#<?=get_business_category();?>" data-toggle="tab"><?=get_business_category();?></a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <?php 
                                                $k = 0;
                                                    foreach($scripts as $value){
                                                        $imgs = \App\Http\Controllers\HomeController::get_scripts_image($value->category);
                                                        // print_r($imgs);
                                                ?>
                                                <div class="tab-pane fade in <?php if($k == 0){echo 'active';} ?>" id="<?= $value->category ?>">
                                                    <div class="col-md-12 padding-0  parent-<?= $value->category ?>">
                                                        <?php 
                                                        foreach ($imgs as $img) { ?>
                                                            <div class="col-md-12 hide-child  child-<?= $value->category ?>" style="margin-bottom: 10px;border: 1px solid #da291c; border-radius: 3px; padding: 5px 10px;">
                                                                <!-- <img src="<?php echo asset('public/images')?>/<?= $img->image ?>" alt="" class="script_img" style="width: 100%;" /> -->
                                                                <a class="script_des"><?= $img->description ?></a>
                                                            </div>
                                                            
                                                        <?php } ?>
                                                        
                                                    </div>
                                                    <div class="col-md-12 padding-0" >
                                                        <a href="javascript:void(0)"   data-id="<?= $value->category ?>" class="btn btn-xs btn-danger text-center loadMore"><i class="fa fa-plus"></i></a>
                                                        <a href="javascript:void(0)"  data-id="<?= $value->category ?>" class="btn btn-xs btn-danger text-center showLess"><i class="fa fa-minus"></i></a>
                                                        </div>
                                                      
                                                </div>
                                                <?php
                                                $k++;
                                                    }
                                                     
                                                ?>
                                                <div class="tab-pane fade in " id="<?=get_business_category();?>">
                                                    <div class="col-md-12 padding-0 parent-<?=get_business_category();?>">
                                                       <?=get_business_category_desc();?>
                                                    </div>
                                                    <div class="col-md-12 padding-0" >
                                                        <a href="javascript:void(0)"   data-id="<?=get_business_category();?>" class="btn btn-xs btn-danger text-center loadMore"><i class="fa fa-plus"></i></a>
                                                        <a href="javascript:void(0)"  data-id="<?=get_business_category();?>" class="btn btn-xs btn-danger text-center showLess"><i class="fa fa-minus"></i></a>
                                                        </div>
                                                </div>
                                                <input type="hidden" id="script_path" val="">
                                                <input type="hidden" name="script_description" id="script_description">
                                                <input type="hidden" name="script_category" id="script_category">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 margin-top-20">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" placeholder="To" id="malto" name="malto" />
                                            <div class="email-id-row">
                                                <span class="to-input">To</span>
                                                <div class="all-mail"></div>
                                                <input type="text" name="email" class="enter-mail-id" placeholder="Enter the email id .." />
                                            </div>
                                        </div>
                                        <p style="color: red" id="emailer"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Campaign Name"  id="campaign_name" name="campaign_name" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-2 padding-0">
                                            <label class="margin-top-10">Attachments: </label>
                                        </div>
                                        <div class="col-md-10 padding-0">
                                            <div class="fancy-file-upload fancy-file-danger">
                                                <i class="fa fa-upload"></i>
                                                <input type="file" class="form-control"  name="img_path" onchange="jQuery(this).next('input').val(this.value);" required />
                                                <input type="text" class="form-control" placeholder="no file selected" readonly="" id="imggg" />
                                                <span class="button">Choose File</span>
                                            </div>
                                        </div>
                                         <div class="previmgsec" style="display: none;">
                                                <img src="" id="previmg" width="200px;">
                                                <input type="hidden" name="previmage" id="previmage" value="">
                                            </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="col-md-2 padding-0">
                                            <label class="margin-top-10">Background: </label>
                                        </div>
                                        <div class="col-md-10 padding-0">
                                            <ul style="list-style-type: none; padding: 0; margin: 0">@foreach($colors as $color)<li class="color-td" style="background-color: {{ $color->color }}; display: inline-block;"></li>@endforeach</ul>
                                            <input type="hidden" id="bakg" name="bakg">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea type="color" class="form-control summernote msgbox" rows="6" placeholder="Message"></textarea>
                                        </div>
                                        <p style="color: red" id="textre"></p>
                                        <input type="hidden" name="forecolorr" value="#000000" id="forecolorr">
                                    </div>
                                    <div class="col-md-12" style="">
                                        <div class="row">
                                            <div class="col-md-12 text-center email-btn" style="margin-top: 10px;">
                                                <div class="row">
                                                    <!--<div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">-->
                                                    <!--    <a class="btn btn-xs btn-info subbtn" style="width: 100%;">Send With Clock</a>-->
                                                    <!--</div>-->
                                                    <div class="col-md-5th text-center" style="padding: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info reminderonsub" style="width: 100%;">Send With Reminders</a>
                                                    </div>
                                                    <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info prvbtn" style="width: 100%;">Preview</a>
                                                    </div>
                                                    <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info subbtn" style="width: 100%;">Send Now</a>
                                                    </div>
                                                    <div class="col-md-5th text-center" style="padding: 0px;">
                                                        <a class="btn btn-xs btn-info dateonsub" style="width: 100%;">Send On</a>
                                                    </div>
                                                    <input type="submit" id="submit_button" value="" style="display: none">
                                                </div>
                                            </div>
                                            <div class="col-md-12 dateon" style="margin-top: 10px; display: none;">
                                                <div class="row">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <!-- <input type="date" class="form-control" name="sendon" id="sendon"> -->
                                                        <!-- <input type="date" class="form-control" data-date="" data-date-format="DD MMMM YYYY"  name="sendon" id="sendon"> -->
                                                        <input type="date" name="sendon" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" id="sendon">
                                                        <p style="color: red" id="send_on_alert"></p>
                                                    </div>
                                                    <div class="col-md-2" style="padding: 0; ">
                                                        <a class="btn btn-xs btn-info subbtn" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send On</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 reminderon" style="margin-top: 10px; display: none;">
                                                <div class="row">
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <input type="date" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" name="reminderdate" id="reminderdate">
                                                        <p style="color: red" id="reminder_date_alert"></p>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <input type="time" class="form-control" name="remindertime" id="remindertime">
                                                        <p style="color: red" id="reminder_time_alert"></p>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0; ">
                                                        <a class="btn btn-xs btn-info subbtn" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send With Reminder</a>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-md-12 reminderon" style="margin-top: 10px; display: none;">
                                                <div class="row">
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <select class="form-control" name="reminderdate">
                                                            <option value="1">every hour</option>
                                                            <option value="2">every 2 hour</option>
                                                            <option value="3">every 3 hour</option>
                                                            <option value="4">every 4 hour</option>
                                                            <option value="5">every 5 hour</option>
                                                            <option value="6">every 6 hour</option>
                                                            <option value="24">every day</option>
                                                            <option value="48">every 2 day</option>
                                                            <option value="72">every 3 day</option>
                                                            <option value="96">every 4 day</option>
                                                            <option value="120">every 5 day</option>
                                                            <option value="144">every 6 day</option>
                                                            <option value="168">every week</option>
                                                        </select>
                                                        <p style="color: red" id="reminder_date_alert"></p>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <!-- <input type="time" class="form-control" name="remindertime" id="remindertime"> -->
                                                        <select class="form-control" name="remindertimes">
                                                            <option value="2">2times</option>
                                                            <option value="3">3times</option>
                                                            <option value="4">4times</option>
                                                            <option value="5">5times</option>
                                                            <option value="6">6times</option>
                                                            <option value="7">7times</option>
                                                            <option value="8">8times</option>
                                                            <option value="9">9times</option>
                                                            <option value="10">10times</option>
                                                        </select>
                                                        <p style="color: red" id="reminder_time_alert"></p>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0; ">
                                                        <a class="btn btn-xs btn-info subbtn" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Save</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center" style="padding: 15px">
                                        <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</section>
<div id="modall" class="modal fade" role='dialog'>
    <div class="modal-dialog">
        <div class="modal-content" style="background: white">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div  id= "modal-body"></div>
            </div>
        </div>
    </div>
</div>
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
<script type="text/javascript">
 $(".personalized_btn").click(function(){
            $(".personalized_sec").toggle();
        });
        $(".scripts_btn").click(function(){
            $(".scripts_sec").toggle();
        });
        $(".greetings").click(function(){
            // alert($(this).html());
            if($(this).hasClass('btn-info')){
                $(".greetings.btn-info").addClass("btn-black");
                $(".greetings.btn-info").removeClass("btn-info");
                $("#greeting").val("");
                $(this).addClass("btn-black");
                $(this).removeClass("btn-info");
            }
            else{
                $(".greetings.btn-info").addClass("btn-black");
                $(".greetings.btn-info").removeClass("btn-info");
                $("#greeting").val($(this).html());
                $(this).removeClass("btn-black");
                $(this).addClass("btn-info");
            }
        });
    function titleClick(id)
    { 
        $(".personalized_sec").hide();
        $(".scripts_sec").hide();
        var email = []; 
        $.ajax({
              url: 'emmail_prev_details',
              data: 'id=' + id + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                for(var i=0; i < response.length; i++)
                {
                    email.push(response[i]['email']);
                    // alert(email);
                }  
                var base_url = {!! json_encode(url('/')) !!};
                // alert(base_url);
                $("#subject").val(response[0]['subject']);
                $(".previmgsec").show();
                $("#previmg").attr('src', base_url+"/public/videos/"+response[0]['image']);
                $("#previmage").val(response[0]['image']);
                $(".summernote").code(response[0]['message']);
                $("#forecolorr").val(response[0]['forecolorr']);
                $(".note-editable").css("background-color", response[0]['backhground']);
                $("#bakg").val(response[0]['backhground']);
                $("#img_path").removeAttr("required");
                $("#malto").val("");
                $(".email-ids .ema").parent().remove();
                $("#greeting").val(response[0]['greeting']);
                if(response[0]['greeting'] != null){
                    $(".personalized_sec").show();
                    $(".greetings.btn-info").addClass('btn-black');
                    $(".greetings.btn-info").removeClass('btn-info');
                    $(".greetings#"+response[0]['greeting']).trigger('click');
                }
                else{
                    $(".greetings.btn-info").addClass('btn-black');
                    $(".greetings.btn-info").removeClass('btn-info');
                    $(".personalized_sec").hide();
                    $(".scripts_sec").hide();
                }
            }
        }).then( function( data ) {
            $.ajax({
                url: 'title_wise_email',
                data: 'email=' + email + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function (response) {
                    $("#contact_sec").html(response);
                        if($("#contactall").is(':checked')){
                            $("#contactall").prop("checked", false);
                        } 
                    $('.contact_mail').trigger('click');
                }
            })   
        });
    }




    $(document).ready(function() {
        $(".subbtn").click(function() {
            var submit_value = $(this).text();
            $("#submit_button").val(submit_value);
            $("#submit_button").trigger('click');
        });
        $("#register").submit(function(e) {
            //---------------^---------------
            e.preventDefault();
            if($("#malto").val() == ""){
                $("#emailer").html("Please enter atleast one email id !!");
                $('html, body').animate({
                    scrollTop: $(".email-btn").offset().top
                }, 500);
            }
            else{
                $("#emailer").html("");
                if($(".summernote").code() == ""){
                    $("#textre").html("Please Enter message !!!");
                    $('html, body').animate({
                        scrollTop: $(".summernote").offset().top
                    }, 500);
                }
                else{
                    $("#textre").html("");
                    var submit_value  = $("#submit_button").val();
                    var message       = $(".summernote").code();
                    var bakg          = $("#bakg").val();
                    var formData = new FormData(this);
                    formData.append("message", message);
                    formData.append("bakg", bakg);
                    // alert(message);
                    if(submit_value == "Send Now"){
                        $.ajax({
                          type: "POST",
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          url: "send_email_submit",
                          data:  formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                          success: function(html) {
                                $("#success_card").html(html);
                                $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('#malto').val("");
                                $('#subject').val("");
                                $(".summernote").code("");
                                $('#campaign_name').val("");
                                $("#img_path").val("");
                                $("#imggg").val("");
                                $(".email-ids").remove("");
                                $(".folder_check").prop("checked", false);
                                $("#folderall").prop("checked", false);
                                $(".contact_mail").prop("checked", false);
                                $("#contactall").prop("checked", false);
                          },
                          complete: function(){
                            $("#loading").hide();
                            $("#wrapper").show();
                          }
                        });
                    }
                    else if(submit_value == "Send On"){
                        if($("#sendon").val() == "")
                        {
                            $("#send_on_alert").html("Date is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "send_email_send_on",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                // alert(html);
                                $("#success_card").html(html);
                                $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('#malto').val("");
                                $('#subject').val("");
                                $(".summernote").code("");
                                $("#img_path").val("");
                                $("#imggg").val("");
                                $(".email-ids").remove("");
                                $(".folder_check").prop("checked", false);
                                $("#folderall").prop("checked", false);
                                $(".contact_mail").prop("checked", false);
                                $("#contactall").prop("checked", false);
                                $("#sendon").val("");
                                $(".dateon").hide();
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                              }
                            });
                        }
                    }
                    else if(submit_value == "Save"){
                        
                        if($("#reminderdate").val() == "")
                        {
                            $("#reminder_date_alert").html("Date is required!");
                        }
                        else if($("#remindertime").val() == "")
                        {
                            $("#reminder_date_alert").hide();
                            $("#reminder_time_alert").html("Time is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "send_email_send_with_reminder",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                // alert(html);
                                $("#success_card").html(html);
                                $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('#malto').val("");
                                $('#subject').val("");
                                $(".summernote").code("");
                                $("#img_path").val("");
                                $("#imggg").val("");
                                $(".email-ids").remove("");
                                $(".folder_check").prop("checked", false);
                                $("#folderall").prop("checked", false);
                                $(".contact_mail").prop("checked", false);
                                $("#contactall").prop("checked", false);
                                $("#sendon").val("");
                                $(".dateon").hide();
                                $(".reminderon").hide();
                                $("#reminderdate").val("");
                                $("#remindertime").val("");
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                              }
                            });
                        }
                    }
                }
            }
        });
        $(".prvbtn").click(function(){
            var bakg      = $("#bakg").val();
            var message       = $(".summernote").code();
            var url = "<?php echo url('/'); ?>/user_banner_details";
            $.ajax({
                  url: url,
                  data: '_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    var user_banner = response;
                    var preview = '<div style="padding:10px; background-color:'+bakg+'"><div style="padding: 5px">'+user_banner+'</div><p style="margin-bottom: 0;">'+message+'</p></div>';
                    $("#modall #modal-body").html(preview);   
                    $('#modall').modal('show');
                }
            });
        });
        $(".color-td").click(function(){
            var classs = $(this).attr("class");
            var cls = classs.split("color-td ");
            var mainc = cls[1];
            // alert(mainc);
            var bakg = $(this).css("background-color");
            // alert(bakg);
            $("#bakg").val(bakg);
        });
        $("#folderall").change(function(){
            if ($(this).prop('checked')) {
                this.setAttribute("checked", "checked");
                $('.folder_check').prop('checked', true);
            }
            else{
                this.removeAttribute("checked");
                $('.folder_check').prop('checked', false);
                var boxes = $('.contact_mail:checked');
                boxes.each(function(){
                    $(this).prop('checked', true);
                    $(this).trigger('click');
                });
            }
            $('.folder_check').trigger('change');
        });
        $("#contactall").change(function(){
            if ($(this).prop('checked')) {
                // alert("bi");
                var boxes = $('.contact_mail:not(:checked)');
                boxes.each(function(){
                    $(this).prop('checked', false);
                    $(this).trigger('click');
                });
            }
            else{
                // alert("hi");
                $('.contact_mail').prop('checked', true);
                $('.contact_mail').trigger('click');
            }
        });
        $('.folder_check').change(function() {
            if ($(this).prop('checked')) {
                // var checkboxes = $('.folder_checkinput:checked').length;
                var folder_arr = []; 
                $(".folder_check:checked").each(function() { 
                    folder_arr.push($(this).val()); 
                });
                var contactid = $("#contactid").val();
                var url = "<?php echo url('/'); ?>/folderwisecontact";
                $.ajax({
                      url: url,
                      data: 'folder_arr=' + folder_arr + '&contactid=' + contactid + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        // console.log(response);
                        $("#contact_sec").html(response);
                        if($("#contactall").is(':checked')){
                            $("#contactall").prop("checked", false);
                        } 
                    }
                });
            }
            else {
                var remfolder = $(this).val();
                var fstres = "";
                // alert(remfolder);
                var folder_arr = []; 
                $(".folder_check:checked").each(function() { 
                    folder_arr.push($(this).val()); 
                });
                var contactid = $("#contactid").val();
                var url = "<?php echo url('/'); ?>/folderwisecontact";
                $.ajax({
                      url: url,
                      data: 'folder_arr=' + folder_arr + '&contactid=' + contactid + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        // console.log(response);
                        // $("#contact_sec").html(response);
                        fstres = response;
                    }
                })
                .then( function( data ) {
                    $.ajax({
                        url: "<?php echo url('/'); ?>/folderwisecontactids",
                        data: 'remfolder=' + remfolder + '&_token={{ csrf_token() }}',
                        type: "POST",
                        success: function (response) {
                            // alert(response);
                            
                            for ( var i = 0, l = response.length; i < l; i++ ) {
                                // alert(response[i]);
                                var boxes = $('.contact_mail:checked');
                                boxes.each(function(){
                                    // alert($(this).val());
                                    var vau = $(this).val();
                                    if(vau == response[i]){
                                        $(this).trigger('click');
                                    }
                                });
                            }
                            $("#contact_sec").html(fstres);
                            if($("#folderall").is(':checked')){
                                $("#folderall").prop("checked", false);
                            }
                        }
                    })
                });
            }
        });
        $(".enter-mail-id").keydown(function (e) {
            if (e.keyCode == 13 || e.keyCode == 32) {
            //alert('You Press enter');
                var getValue = $(this).val();
                $('.all-mail').append('<span class="email-ids"><span class="ema">'+ getValue +'</span><span class="cancel-email">x</span></span>');
                var mail_arr = []; 
                $(".email-ids .ema").each(function() { 
                    mail_arr.push($(this).html()); 
                });
                // alert(mail_arr);
                $('#malto').val(mail_arr);
                $(this).val('');
            }
        });
        $(document).on('click','.cancel-email',function(){
              
              $(this).parent().remove();
              var mail_arr = []; 
                $(".email-ids .ema").each(function() { 
                    mail_arr.push($(this).html()); 
                });
                // alert(mail_arr);
                $('#malto').val(mail_arr);
        
        });
        $(document).on('click','.contact_mail',function(){
            // alert("hi");
            if ($(this).prop('checked')) {
                // alert($(this).val());
                var id = $(this).val();
                this.setAttribute("checked", "checked");
                var url = "<?php echo url('/'); ?>/contactwisemail";
                $.ajax({
                      url: url,
                      data: 'id=' + id + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        // alert(response);
                        $('.all-mail').append('<span class="email-ids"><span class="ema">'+ response +'</span><span class="cancel-email">x</span></span>');
                        var mail_arr = []; 
                        $(".email-ids .ema").each(function() { 
                            mail_arr.push($(this).html()); 
                        });
                        // alert(mail_arr);
                        $('#malto').val(mail_arr);
                        // $("#contact_sec").html(response);
                        var contactids = $("#contactid").val();
                        if(contactids == ""){
                            $("#contactid").val(id);
                        }
                        else{
                            var contactid = contactids.split(',');
                            contactid.push(id);
                            $("#contactid").val(contactid);
                        }
                    }
                });
            }
            else{
                var id = $(this).val();
                this.removeAttribute("checked");
                var url = "<?php echo url('/'); ?>/contactwisemaild";
                var smail = "";
                var mails = $("#malto").val();
                $.ajax({
                      url: "<?php echo url('/'); ?>/contactwisemail",
                      data: 'id=' + id + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        smail = response;
                    }
                })
                .done( function( data ) {
                    // Handles successful responses only
                } )
                .fail( function( reason ) {
                    console.info( reason );
                } )
                .then( function( data ) {
                    $.ajax({
                          url: url,
                          data: 'id=' + id + '&mails=' + mails + '&_token={{ csrf_token() }}',
                          type: "POST",
                        success: function (response) {
                            $(".email-ids .ema").each(function() {
                                var ddemail = $(this).html();
                                // alert(smail);
                                if(ddemail == smail){
                                    // alert(smail);
                                    $(this).parent().remove();
                                      // var mail_arr = []; 
                                      //   $(".email-ids .ema").each(function() { 
                                      //       mail_arr.push($(this).html()); 
                                      //   });
                                      //   $('#malto').val(mail_arr);
                                }
                            });   
                            var box = [];
                            var boxes = $('.contact_mail:checked');
                            boxes.each(function(){
                                // alert($(this).val());
                                box.push($(this).val());
                            }); 
                            $("#contactid").val(box);   
                            if($("#contactall").is(':checked')){
                                $("#contactall").prop("checked", false);
                            }    
                            // $('#malto').val(response);         
                        }
                    });
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click",".note-color-btn",function(){
            $("#forecolorr").val($(this).attr("data-value"));
        });
        $(".dateonsub").click(function(){
            $(".dateon").show();
            $(".reminderon").hide();
        });
        $(".reminderonsub").click(function(){
            $(".reminderon").show();
            $(".dateon").hide();
        });
    });
    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#reminderdate').attr('min', maxDate);
        $('#sendon').attr('min', maxDate);
    });
    $("#sendon").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change");
    $("#reminderdate").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change");
    
    
    function titleClickrrr(id)
    { 
        $(".personalized_sec").hide();
        $(".scripts_sec").hide();
        var email = []; 
        $.ajax({
              url: 'emmail_prev_details',
              data: 'id=' + id + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                for(var i=0; i < response.length; i++)
                {
                    email.push(response[i]['email']);
                    // alert(email);
                }  
                var base_url = {!! json_encode(url('/')) !!};
                // alert(base_url);
                $("#subject").val(response[0]['subject']);
                $(".previmgsec").show();
                $("#previmg").attr('src', base_url+"/public/videos/"+response[0]['image']);
                $("#previmage").val(response[0]['image']);
                $(".summernote").code(response[0]['message']);
                $("#forecolorr").val(response[0]['forecolorr']);
                $(".note-editable").css("background-color", response[0]['backhground']);
                $("#bakg").val(response[0]['backhground']);
                $("#img_path").removeAttr("required");
                $("#malto").val("");
                $(".email-ids .ema").parent().remove();
                $("#greeting").val(response[0]['greeting']);
                if(response[0]['greeting'] != null){
                    $(".personalized_sec").show();
                    $(".greetings.btn-info").addClass('btn-black');
                    $(".greetings.btn-info").removeClass('btn-info');
                    $(".greetings#"+response[0]['greeting']).trigger('click');
                }
                else{
                    $(".greetings.btn-info").addClass('btn-black');
                    $(".greetings.btn-info").removeClass('btn-info');
                    $(".personalized_sec").hide();
                    $(".scripts_sec").hide();
                }
            }
        }).then( function( data ) {
            $.ajax({
                url: 'title_wise_email',
                data: 'email=' + email + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function (response) {
                    $("#contact_sec").html(response);
                        if($("#contactall").is(':checked')){
                            $("#contactall").prop("checked", false);
                        } 
                    $('.contact_mail').trigger('click');
                }
            })   
        });
    }  
    
    
 var x=3;
 $('.parent-<?=get_business_category();?> div:lt('+x+')').show();
</script>
<?php  
foreach($scripts as $value){ ?>

<script>
     $('.parent-<?=$value->category;?> div:lt('+x+')').show();
</script>
<?php } ?>
<script>
$(document).ready(function () {
    
    $('.loadMore').click(function () {
        var cls=$(this).attr('data-id');
        var size = $('.child-'+cls).size();
        x= (x+3 <= size) ? x+3 : size;
        $('.parent-'+cls+' div:lt('+x+')').show();
       
    });
    $('.showLess').click(function () {
        var cls=$(this).attr('data-id');
         var size = $('.child-'+cls).size();
         x=(x-3< 0) ? 3 : x-3;
         if(x<=0)
         {
             x=size-3;
         }
         $('.parent-'+cls+' div').not(':lt('+x+')').hide();
         
    });
});

 
  $("#owl-demo").owlCarousel({
      pagination: false,
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1000,4], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0;
      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
  });
 var owl = $("#owl-demo");
 $(".next").click(function(){
    owl.trigger('owl.next');
  })
  $(".prev").click(function(){
    owl.trigger('owl.prev');
  })
</script>
@endsection