@extends('layouts.admin') 
<style>
	.card-inner-group a{
		text-decoration: none;
		color: #fff !important;
	}
	.popover-content{
      display:none !important;
   }
.paginate_button a{
      color: #da291c !important;
   }
   .nav-tabs .nav-link {
   font-weight: 500;
   font-size: 14px;
   padding-top: 7px;
   }
   .heading-dotted {
   background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKAQMAAAC3/F3+AAAABlBMVEX///+QkJApn3LQAAAAAnRSTlMAgJsrThgAAAAOSURBVHheYwCCUAdcJAAnnALqo5TBzAAAAABJRU5ErkJggg==') repeat-x center;
   }
   .h5 {
   margin: 0;
   padding: 0;
   background-color: #fae3e2;
   }
   tr.nk-tb-item.tr-border-red {
   color: red;
   font-weight: 800;
   font-size: 16px;
   }
  
   #dsTable tr {
    white-space: nowrap;
    background-color: #fff;
}

#email_part,#filtered_users{
      display: none;
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

.card-inner-group a{
    color: #fff !important;

}
a.script_des {
    color: #ff0000!important;
}
.card_img {
    height: 80px!important;
}
</style>
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Search & Send SMS</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="search_by_personal_info" method="POST">	
									@csrf
									<div class="row gy-4">
										<div class="col-md-12">
											<h5>Search by personal information :</h5>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Name</label>
												<input type="text" id="name" name="name" class="form-control" placeholder="First 3 letter of name">
												<p class="nameerror text-danger"></p>

											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Email</label>
												<input type="text" id="email" name="email" class="form-control" placeholder="Enter email here">
												<p class="emailerror text-danger"></p>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Telephone</label>
												<input type="text" id="mobile" name="mobile" class="form-control" placeholder="Enter phone here">
												<p class="mobileerror text-danger"></p>

											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label" for="">Religious Faith</label>
												<select class="form-control" id="religious" name="religious">
													<?php
		                                                foreach ($religions as $value) {
		                                            ?>
		                                                    <option value="<?= $value->religion ?>"><?= $value->religion ?></option>
		                                            <?php
		                                                }
		                                            ?>
												</select>
											</div>
										</div>
										
										<div class="col-md-12 text-center">
											<input type="submit" name="" class="btn btn-sm btn-primary" style="margin-top:25px;" value="Search">
											{{-- <a href="#"></a> --}}
											
										</div>
									</div>
								</form>
								<div class="clearfix"></div>	
								<div class="divider"><!-- divider --></div>
								<form id="search_by" method="POST">	
								@csrf	
									<div class="row gy-4">
										<div class="col-md-12">
											<h5>Search by :</h5>
										</div>

										{{-- <div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck2" name="rank[]" value="1">
													<label class="custom-control-label" for="customCheck2">Confirm Founder</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck1" name="rank[]" value="3">
													<label class="custom-control-label" for="customCheck1">Elite Founder</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck02" name="rank[]" value="2">
													<label class="custom-control-label" for="customCheck02">Gold Founder</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck03" name="rank[]" value="4">
													<label class="custom-control-label" for="customCheck03">Executive Founder</label>
												</div>
												
											</div>
										</div> --}}
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck04" name="plan[]" value="4">
													<label class="custom-control-label" for="customCheck04">Silver Member</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck05" name="plan[]" value="3">
													<label class="custom-control-label" for="customCheck05">Gold Member</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck06" name="plan[]" value="2">
													<label class="custom-control-label" for="customCheck06">Enterprise</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck07" name="plan[]" value="1">
													<label class="custom-control-label" for="customCheck07">Free Affilates</label>
												</div>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Country</label>
												<select id="countries_states1" class="form-control bfh-countries" data-country="US" name="country" required></select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">State/Province</label>
												<select class="form-control bfh-states" data-country="countries_states1" name="state" required></select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> City </label>
												<input type="text" name="city" class="form-control"  placeholder="">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Zip Code</label>
												<input type="text" name="zipcode" class="form-control"  placeholder="" >
											</div>
										</div>
										
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Business Category</label>
												
												<select class="form-control form-select select2-hidden-accessible" name="business_category" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="3">
												
												  <?php
		                                                foreach ($business_category as $value) {
		                                            ?>
		                                                    <option value="<?= $value->id ?>"><?= $value->category ?></option>
		                                            <?php
		                                                }
		                                            ?>
												  
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> Affilate Level </label>
												<input type="text" name="level" class="form-control"  placeholder="">
											</div>
										</div>
										
										
										
										
										
										<div class="col-md-12 text-center">
											<input type="submit" class="btn btn-sm btn-primary" name="" value="Search" style="margin-top:25px;">
											
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="nk-block" id="response_block" style="display: none">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<div id="response">
									
								</div>
							</div>
						</div><!-- .card-inner-group -->
					</div><!-- .card -->
				</div><!-- .nk-block -->
				
				
				
				
			</div>
		</div>
		<div class="nk-block">
               <div class="card card-bordered card-stretch">
                  <div class="card-inner-group">

                     <div class="card-inner">
                        <div class="row" style="border-bottom:2px solid #b71a0f; margin-bottom:10px;">

                           <div class="col-md-12 text-center email-btn" style="" >
                              <div class="col-md-12 " style="" >
                                 <div class="row">
                                    <!--  <div id="owl-demo" class="owl-carousel owl-theme"> -->
                                    <?php
                                       $cnt = 1;
                                       foreach($titles as $value){
                                          ?>
                                     <div class="col-md-3 text-center " style="padding-right:5px;padding-left:0px;" >
                                       <a href="javascript:void(0)" onclick="titleClick(this.id)"  id="{{ $value->subject }}"  class="btn btn-xs btn-black"  style="margin-top:10px;margin-bottom:10px;width:100%;">{{ $value->subject }}</a>
                                    </div>
                                            <?php
                                                $cnt++;
                                                if($cnt == 5){
                                                    break;
                                                }
                                                }
                                            ?>
                                     <!--  </div>

        <a class="left carousel-control prev" href="javascript:void(0)" ><i class="glyphicon glyphicon-chevron-left"></i></a>
        <a class="right carousel-control next" href="javascript:void(0)" ><i class="glyphicon glyphicon-chevron-right"></i></a> -->


                                 </div>
                              </div>
                           </div>

                        </div>

                        <div class="row">

                        <div class="col-md-12" >
                        <ul class="nav nav-tabs activetab" style="">
                           <li class="nav-item">
                              <a class="btn-xs nav-link active" data-id="sendEmail" data-toggle="tab" href="#sendEmail">Send SMS</a>
                           </li>
{{--                            <li class="nav-item">
                              <a class="btn-xs nav-link" data-id="sendCard" data-toggle="tab" href="#sendCard">Send Card</a>
                           </li>
                           <li class="nav-item">
                              <a class="btn-xs nav-link" data-id="sendVideos" data-toggle="tab" href="#sendVideos">Send Videos</a>
                           </li> --}}


                        </ul>
                        <div class="col-md-12 text-center" style="" >
                           <div class="row">
                              <div class="col-md-12 text-center ">
                                  <a class="btn btn-xs btn-primary text-center personalized_btn" style="margin-top:10px;margin-right:3px;margin-bottom:15px;">Personalized</a>
                                 <a class="btn btn-xs btn-primary text-center scripts_btn" style="margin-top:10px;margin-bottom:15px;">Scripts</a>
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

                         <div class="col-md-12 padding-0">
                           <ul class="nav nav-tabs" >
                           <?php
                               $c = 0;
                              foreach($scripts as $value){
                           ?>
                           <li class="nav-item script_cat">
                              <a class="btn-xs nav-link <?php if($c == 0){echo 'active';} ?>" data-toggle="tab" href="#script-<?= $value->category ?>"><?= $value->category ?></a>
                           </li>
                           <?php
                              $c++;
                              }
                           ?>

                          </ul>
                          <div class="tab-content">
                           <?php
                           $k = 0;
                         foreach($scripts as $value){
                             $imgs = \App\Http\Controllers\HomeController::get_scripts_image($value->category);
                           ?>
                        <div class="tab-pane  <?php if($k == 0){echo 'active';} ?>" id="script-<?= $value->category ?>" style="border-top:1px solid #cecece;padding-top:10px;">

                           <div class="col-md-12 padding-0  parent-<?= $value->category ?>">
                             <?php
                             foreach ($imgs as $img) { ?>
                                 <div class="col-md-12 hide-child  child-<?= $value->category ?>" style="margin-bottom: 10px;border: 1px solid #da291c; border-radius: 3px; padding: 5px 10px;">
                                     
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

                     <input type="hidden" id="script_path" val="">
                     <input type="hidden" name="script_description" id="script_description">
                     <input type="hidden" name="script_category" id="script_category">
                 </div>
             </div>
         </div>
      </div>
   </div>

   </div>
  </div>
   <div class="tab-content" style="margin-top:10px;">
   <div class="tab-pane active" id="sendEmail">
     <form id="client_manage_submit" class="margin-bottom-0" method="POST" role="form" enctype="multipart/form-data">
       @csrf
         <div class="row gy-2">
            <div class="col-md-12" style="padding:0px;">
               <div class="col-md-12"  style="margin-top: 10px;">
                  <div class="form-group">
      				<input type="text" class="form-control malto" placeholder="To" name="malto" value="" />
                    <input type="hidden" class="form-control" name="subject" id="subject1" placeholder="Subject" value="" required />
                  </div>
                {{-- <div class="row">
             <div class="col-md-2 padding-0">
                 <label>Background: </label>
             </div> --}}
             {{-- <div class="col-md-10 padding-0">
                 <ul style="list-style-type: none; padding: 0; margin: 0">foreach($colors as $color)<li class="color-td" style="background-color: { $color->color }}; display: inline-block;"></li>@endforeach</ul>

                 <input type="hidden" name="bakg" id="bakg">
             </div> --}}
            {{-- </div>

               </div> --}}

               <div class="col-md-12"  style="margin-top: 10px;">

                  <div class="form-group">
                     <textarea type="color" class="form-control summernote msgbox summernote1" rows="6" placeholder="Message"></textarea>
                      <p style="color: red" id="textre"></p>
                </div>

                <input type="hidden" name="forecolorr" value="#000000" id="forecolorr">

               </div>
            </div>
          </div>
            <div class="col-md-12" style="">
          <div class="row" >
            <div class="col-md-12">
            <div class="col-md-12 text-center email-btn" style="margin-top: 10px;">
                 <div class="row">
                     <div class="col-md-4 text-center" style="padding: 0px; padding-right: 5px;">
                         <a class="btn btn-xs btn-info reminderonsub" style="width: 100%;">Send With Reminders</a>
                     </div>
                     {{-- <div class="col-md-3 text-center" style="padding-left: 0px; padding-right: 5px;">
                         <a class="btn btn-xs btn-info prvbtn" style="width: 100%;">Preview</a>
                     </div> --}}
                     <div class="col-md-4 text-center" style="padding-left: 0px; padding-right: 5px;">
                         <a class="btn btn-xs btn-info subbtn" style="width: 100%;">Send Now</a>
                     </div>
                     <div class="col-md-4 text-center" style="padding: 0px;">
                         <a class="btn btn-xs btn-info dateonsub" style="width: 100%;">Send On</a>

                     </div>
                     <input type="submit" id="submit_button" value="" style="display: none">
                 </div>
             </div>
 <?php
// $ip = $_SERVER['REMOTE_ADDR'];
// $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
// $ipInfo = json_decode($ipInfo);
// $timezone = $ipInfo->timezone;
$date = date('Y-m-d');
// $dt = new DateTime($date, new DateTimeZone('America/New_York'));
// $dt->setTimezone(new DateTimeZone($timezone));
// $adate = $dt->format('Y-m-d');
?>
<div class="col-md-12">
    <div class="col-md-12 dateon" style="margin-top: 10px; display: none;">
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-4" style="padding: 0 10px; ">
                <input type="date" name="sendon" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= $date ?>" id="sendon">
                <p style="color: red" id="send_on_alert"></p>
            </div>
            <div class="col-md-2" style="padding: 0; ">
                <a class="btn btn-xs btn-info subbtn" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send On</a>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-12 reminderon" style="margin-top: 10px; display: none;">
        <div class="row">
            <div class="col-md-4" style="padding: 0 10px; ">
                <!-- <input type="date" class="form-control" name="reminderdate" id="reminderdate"> -->
                <!-- <input type="date" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" name="reminderdate" id="reminderdate"> -->
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
<div class="col-md-12 text-center" style="padding: 15px">
    <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card"></span>
</div>

         </div>

       </div>
    </div>

      </form>
     </div>

   
   



</div>
</div>
</div><!-- .card-inner-group -->
</div><!-- .card -->
</div><!-- .nk-block -->
	</div>
</div>
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
<script>



	$("#search_by_personal_info").submit(function(e){
		e.preventDefault();
		var name = $("#name").val();
		var email = $("#email").val();
		var mobile = $("#mobile").val();
		var religious = $("#religious").val();
		if(name==""){
			$(".nameerror").text("This field is empty");
		}else{
			$(".nameerror").hide();
		}
		if(email==""){
			$(".emailerror").text("This field is empty");
		}else{
			$(".emailerror").hide();
		}
		if(mobile==""){
			$(".mobileerror").text("This field is empty");
			// $("#religiouserror").text("This field is empty");
		}else{
			$(".mobileerror").hide();
		}
		$.ajax({
			type:"POST",
			url:"<?=url('/')?>/search_by_personal_info",
			data:'name=' + name +'&email=' + email + '&mobile=' + mobile + '&religious=' + religious + '&_token={{ csrf_token() }}', 
			success:function(response){
				$("#response_block").show();
				$("#response").html(response);
				$("#name").val('');
				$("#email").val('');
				$("#mobile").val('');
			}
		})
		
	})


	// search by rank or plan

	$("#search_by").submit(function(e){
		e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			type:"POST",
			url:"<?=url('/')?>/search_by",
			data:  formData,
       		contentType: false,
       		cache: false,
       		processData:false,
			success:function(response){
				$("#response_block").show();
				$("#response").html(response);
				$("#name").val('');
				$("#email").val('');
				$("#mobile").val('');
			}
		})
		
	})

</script>

<script>
   $(document).ready(function() {
   //    $(".color-td").click(function() {
   //    var classs = $(this).attr("class");
   //    var cls = classs.split("color-td ");
   //    var mainc = cls[1];
   //    var bakg = $(this).css("background-color");
   //    $(".bakg").val(bakg);
   // });
       $(".card_img").click(function()
       {
           // alert($(this).attr('src'));
           $(".card_img").css({'border' : 'none', 'padding' : '0'})
           var img_path = $(this).attr('src');
           $("#img_path").val(img_path);
           $(this).css({'border' : '3px solid red', 'padding' : '2px'});
       });
   });
$(document).ready(function() {
   $("#client_manage_submit").submit(function(e) {
      e.preventDefault();
      var submit_value = $("#submit_button").val();

      var message = $(".summernote1").summernote('code');
      // var bakg = $("#bakg").val();
      var formData = new FormData(this);
      formData.append("message", message);
      // formData.append("bakg", bakg);
      if(submit_value == "Send Now") {
         $.ajax({
            type: "POST",
            beforeSend: function() {
               $("#loading").show();
               $("#wrapper").hide();
            },
            url: "<?php echo url('/'); ?>/admin_send_sms",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(html) {
               // alert(html);
               $(".checkboxes").prop('checked', false);
               $(".group-checkable").prop('checked', false);
               $("tbody tr").removeClass("active");
               $("#success_card").html(html);
               $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
               $('.malto').val("");
               $('#subject').val("");
            },
            complete: function() {
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
        		url: "<?php echo url('/'); ?>/admin_send_sms_send_on",
        		data:  formData,
        		contentType: false,
        		cache: false,
        		processData:false,
                  success: function(html) {
                    // alert(html);
                    $(".checkboxes").prop('checked', false);
                    $(".group-checkable").prop('checked', false);
                    $("tbody tr").removeClass("active");
                    $("#success_card").html(html);
                    $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                    $('.malto').val("");
                    $('#subject').val("");
                    $(".summernote1").summernote('code','');
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
        	if($("#reminderdate").val() == ""){
        		$("#reminder_date_alert").html("Date is required!");
        	}
        	else if($("#remindertime").val() == ""){
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
                  url: "<?php echo url('/'); ?>/send_sms_with_reminder",
                  data:  formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                  success: function(html) {
                    $(".checkboxes").prop('checked', false);
                    $(".group-checkable").prop('checked', false);
                    $("tbody tr").removeClass("active");
                    $("#success_card").html(html);
                    $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                    $('.malto').val("");
                    $('#subject').val("");
                    $(".summernote1").summernote('code','');
                    $(".reminderon").hide();
                    $("#reminderdate").val("");
                    $("#remindertime").val("");
                  },
                  complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                    $(".scroll").trigger('click');
                  }
                });
            }
        }
   })
	$(".dateonsub").click(function() {
    	$(".dateon").show();
      	$(".reminderon").hide();
   });
   $(".reminderonsub").click(function() {
      $(".reminderon").show();
      $(".dateon").hide();
   });
});
$(".subbtn").click(function() {
   var submit_value = $(this).text();
   $("#submit_button").val(submit_value);
   $("#submit_button").trigger('click');
});
$(document).on('click', '.checkboxes', function() {
   if($(this).prop('checked')) {
      $(this).addClass("checked");
      var mail_arr = [];
      $(".checkboxes.checked").each(function() {
         var id = $(this).val();
         mail_arr.push(id);
      });
      var id = $(this).val();
      var url = "<?php echo url('/'); ?>/get_checked_mobile";
      $.ajax({
         url: url,
         data: 'mail_arr=' + mail_arr + '&_token={{ csrf_token() }}',
         type: "POST",
         success: function(response) {
            var marr = [];
            for(var i = 0; i < response.length; ++i) {
               marr.push(response[i]);
            }
            $('.malto').val(marr);
         }
      });
   } else {
      $(this).removeClass("checked");
      var id = $(this).val();
      var smail = "";
      var mails = $(".malto").val();
      $.ajax({
         url: "<?php echo url('/'); ?>/un_checked_email",
         data: 'id=' + id + '&_token={{ csrf_token() }}',
         type: "POST",
         success: function(response) {
            smail = response;
         }
      }).then(function(data) {
         $.ajax({
            url: "<?php echo url('/'); ?>/unchecked_email_boxes",
            data: 'id=' + id + '&mails=' + mails + '&_token={{ csrf_token() }}',
            type: "POST",
            success: function(response) {
               $('.malto').val(response);
            }
         });
      });
   }
});

   
$(document).on("change", ".group-checkable", function() {
   if($(this).prop('checked')) {
      $(".checkboxes").prop("checked", false);
      $(".checkboxes").addClass("checked");
      $(".checkboxes").trigger('click');
      var mail_arr = [];
      $(".checkboxes.checked").each(function() {
         var id = $(this).val();
         mail_arr.push(id);
      });
      var id = $(this).val();
      var url = "<?php echo url('/'); ?>/get_checked_box_mobile";
      $.ajax({
         url: url,
         data: 'mail_arr=' + mail_arr + '&_token={{ csrf_token() }}',
         type: "POST",
         success: function(response) {
            var marr = [];
            for(var i = 0; i < response.length; ++i) {
               marr.push(response[i]);
            }
            $('.malto').val(marr);
            mail_arr.push(response);
         }
      });
   } else {
      $(".checkboxes").prop("checked", false);
      $(".gradeX").removeClass("active");
      $(".checkboxes").removeClass("checked");
      $('.malto').val("");
   }
});
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

        $(document).on("click",".note-color-btn",function(){
            $("#forecolorr").val($(this).attr("data-value"))
            // note-recent-color
        });
        $(document).on('click','.script_des',function(){
         // var myVar = $("#start").find('.myClass').val();
         var active = $('.activetab li').find('.active').attr('data-id');
         // alert(active);
         
           var text = $(this).html();
           var prevtext = $("#"+active+" .summernote").summernote('code');
            // alert(text +"====="+prevtext);
            if(prevtext != null){
                $("#"+active+" .summernote").summernote('code',prevtext+"<br>"+text);

            }
            else{
                $("#"+active+" .summernote").summernote('code',text);
            }
         
         // if(active=='sendCard'){
         //    alert("sendCard");
         // }
         // if(active=='sendVideos'){
         //    alert("sendVideos");
         // }
            
        });
        $(document).ready(function(){
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
        })
    $(document).ready(function(){
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
       
        $(".prvbtn").click(function(){
            // var bakg  = $("#bakg").val();
            var message  = $(".summernote1").summernote('code');
            var url = "<?php echo url('/'); ?>/admin_user_banner_details";
            $.ajax({
                  url: url,
                  data: '_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    var user_banner = response;
                    var preview = '<div style="padding:10px; background-color:none"><div style="padding: 5px">'+user_banner+'</div><p style="margin-bottom: 0;">'+message+'</p></div>';
                    $("#modall #modal-body").html(preview);
                    $('#modall').modal('show');
                }
            });

        });




    });
function titleClick(id)
    {
        $(".personalized_sec").hide();
        $(".scripts_sec").hide();
         var active = $('.activetab li').find('.active').attr('data-id');

        var email = [];

        $.ajax({
              url: '<?=url('/')?>/admin_emmail_prev_details',
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
                $("#"+active+" input[name=subject]").val(response[0]['subject']);
                $(".previmgsec").show();
                $("#previmg").attr('src', base_url+"/public/videos/"+response[0]['image']);
                $("#previmage").val(response[0]['image']);
                $("#"+active+" .summernote").summernote('code',response[0]['message']);
                // $("#forecolorr").val(response[0]['forecolorr']);
                // $(".note-editable").css("background-color", response[0]['backhground']);
                // $("#bakg").val(response[0]['backhground']);
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
                url: '<?=url('/')?>/admin_title_wise_email',
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
   $(document).ready(function(){
    $('.loadMore').click(function () {
        var cls=$(this).attr('data-id');
        var size = $('.child-'+cls).length;
        x= (x+3 <= size) ? x+3 : size;
        $('.parent-'+cls+' div:lt('+x+')').show();

    });
    $('.showLess').click(function () {
        var cls=$(this).attr('data-id');
         var size = $('.child-'+cls).length;
         x=(x-3< 0) ? 3 : x-3;
         if(x<=0)
         {
             x=size-3;
         }
         $('.parent-'+cls+' div').not(':lt('+x+')').hide();

    });
});
</script>

{{-- card submission --}}
<script>
   $(document).ready(function(){
      // $(".prvbtn1").click(function(){
      //      var message  = $(".summernote2").summernote('code');
      //      var url = "<?php echo url('/'); ?>/admin_user_banner_details";
      //      $.ajax({
      //            url: url,
      //            data: '_token={{ csrf_token() }}',
      //            type: "POST",
      //          success: function (response) {
      //              // alert(response);
      //              var user_banner = response;
      //              var preview = '<div style="padding:10px;"><div style="padding: 20px">'+user_banner+'</div><p style="margin-bottom: 0;">'+message+'</p></div>';
      //              $("#modall #modal-body").html(preview);   
      //              $('#modall').modal('show');
      //          }
      //      });
           
      //  });
      // $(".subbtn1").click(function() {
      //    var submit_value = $(this).text();
      //    // alert(submit_value);
      //    $("#submit_button1").val(submit_value);
      //    $("#submit_button1").trigger('click');
      // });
   })
   
</script>

	
@endsection