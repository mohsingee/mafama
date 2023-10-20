@extends('layouts.main') 
@section("content")
<style type="text/css">
	.radio, .checkbox {
	    display: inline-block;
	    margin: 0 3px 3px 0;
	    padding-left: 27px;
	    font-size: 15px;
	    line-height: 27px;
	    color: #404040;
	    cursor: pointer;
	}
</style>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="row">
					<div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
						<h4>Settings / User Access Roles</h4>
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
					<form>
						<input readonly type="hidden" name="email" value="<?= $users->email ?>">
						<div class="col-md-12"  style="border:1px solid #da291c !important; border-radius:10px;padding-top:30px;padding-bottom:20px;">
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">First Name</label>
									<input readonly type="text" class="form-control" name="first_name" value="<?= $users->first_name ?>" placeholder="First Name" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Last Name	</label>
									<input readonly type="text" class="form-control" name="last_name" value="<?= $users->last_name ?>" placeholder="Last Name"required>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Cell Phone</label>
									<input readonly type="number" class="form-control" value="<?= $users->cellphone ?>" name="cellphone" placeholder="Cell Phone"required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Address</label>
									<input readonly type="text" class="form-control" name="address" value="<?= $users->address ?>" placeholder="" required>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label" for="">Zip Code</label>
									<input readonly type="text" class="form-control" name="zip"  value="<?= $users->zip ?>" placeholder="" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label" for=""> City </label>
									<input readonly type="text" class="form-control" name="city" value="<?= $users->city ?>" placeholder="" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label" for="">Country</label>
									<input type="text" class="form-control" name="" value="<?= $users->country ?>" readonly>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label" for="">State/Province</label>
									<input type="text" class="form-control" name="" value="<?= $users->state ?>" readonly>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label" for="">Religious Faith</label>
									<input type="text" class="form-control" value="<?= $users->religion ?>" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Video</label>
									<div id="uploaded_video">
										<video width="400" muted autoplay="">
										  	<source src="{{ asset('public/images/client') }}/<?= $users->video ?>" type="video/mp4">
										</video>
									</div>
									<input readonly type="hidden" name="prevvideo" value="<?= $users->video ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">File</label>
									<div id="uploaded_img">
										<img src="{{ asset('public/images/client') }}/<?= $users->file ?>" width="400">
									</div>
									<input readonly type="hidden" name="previmg" value="<?= $users->file ?>">
								</div>
							</div>
							
							<div class="col-md-12">
								<h6>Set Access Days Time</h6>
								<table class="table">
									<thead class="thead-light">
										<tr>
										  <th class="text-center" scope="col">Days</th>
										  <th  class="text-center" scope="col">Set Start Time</th>
										  <th  class="text-center" scope="col">Set End Time</th>
										  <th  class="text-center" scope="col">Block Days</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<?php 
										    if($users->monday == "block"){ 
										    	$mon_start = "";
										    	$mon_end = "";
										    	$mon_checked = "checked";
										    	$mon_start_disable = "disabled";
										    	$mon_end_disable = "disabled";
										    }
										    else{
										    	$mon = explode(',', $users->monday);
										    	$mon_start = $mon[0];
										    	$mon_end = $mon[1];
										    	$mon_checked = "";
										    	$mon_start_disable = "required";
										    	$mon_end_disable = "required";
										    }
										    ?>
											<th scope="row">monnesday</th>
											<td><input readonly type="text" name="mon_start" value="<?= date('h:i A', strtotime($mon_start)) ?>" class="form-control" placeholder="" <?= $mon_start_disable ?>></td>
										    <td><input readonly type="text" name="mon_end" value="<?= date('h:i A', strtotime($mon_end)) ?>" class="form-control" placeholder="" <?= $mon_end_disable ?>></td>
										    <td>
												<label class="checkbox chk-sm">
													<input disabled type="checkbox" name="mon_block" id="mon_block" value="block" class="blockday" <?= $mon_checked ?>>
													<i></i> 
												</label>
										    </td>  
										</tr>
										<tr>
											<?php 
										    if($users->tuesday == "block"){ 
										    	$tues_start = "";
										    	$tues_end = "";
										    	$tues_checked = "checked";
										    	$tues_start_disable = "disabled";
										    	$tues_end_disable = "disabled";
										    }
										    else{
										    	$tues = explode(',', $users->tuesday);
										    	$tues_start = $tues[0];
										    	$tues_end = $tues[1];
										    	$tues_checked = "";
										    	$tues_start_disable = "required";
										    	$tues_end_disable = "required";
										    }
										    ?>
											<th scope="row">tuesnesday</th>
											<td><input readonly type="text" name="tues_start" value="<?= date('h:i A', strtotime($tues_start)) ?>" class="form-control" placeholder="" <?= $tues_start_disable ?>></td>
										    <td><input readonly type="text" name="tues_end" value="<?= date('h:i A', strtotime($tues_end)) ?>" class="form-control" placeholder="" <?= $tues_end_disable ?>></td>
										    <td>
												<label class="checkbox chk-sm">
													<input disabled type="checkbox" name="tues_block" id="tues_block" value="block" class="blockday" <?= $tues_checked ?>>
													<i></i> 
												</label>
										    </td>  
										</tr>
										<tr>
											<?php 
										    if($users->wednesday == "block"){ 
										    	$wed_start = "";
										    	$wed_end = "";
										    	$wed_checked = "checked";
										    	$wed_start_disable = "disabled";
										    	$wed_end_disable = "disabled";
										    }
										    else{
										    	$wed = explode(',', $users->wednesday);
										    	$wed_start = $wed[0];
										    	$wed_end = $wed[1];
										    	$wed_checked = "";
										    	$wed_start_disable = "required";
										    	$wed_end_disable = "required";
										    }
										    ?>
											<th scope="row">Wednesday</th>
											<td><input readonly type="text" name="wed_start" value="<?= date('h:i A', strtotime($wed_start)) ?>" class="form-control" placeholder="" <?= $wed_start_disable ?>></td>
										    <td><input readonly type="text" name="wed_end" value="<?= date('h:i A', strtotime($wed_end)) ?>" class="form-control" placeholder="" <?= $wed_end_disable ?>></td>
										    <td>
												<label class="checkbox chk-sm">
													<input disabled type="checkbox" name="wed_block" id="wed_block" value="block" class="blockday" <?= $wed_checked ?>>
													<i></i> 
												</label>
										    </td>  
										</tr>
										<tr>
											<?php 
										    if($users->thursday == "block"){ 
										    	$thu_start = "";
										    	$thu_end = "";
										    	$thu_checked = "checked";
										    	$thu_start_disable = "disabled";
										    	$thu_end_disable = "disabled";
										    }
										    else{
										    	$thu = explode(',', $users->thursday);
										    	$thu_start = $thu[0];
										    	$thu_end = $thu[1];
										    	$thu_checked = "";
										    	$thu_start_disable = "required";
										    	$thu_end_disable = "required";
										    }
										    ?>
											<th scope="row">Thursday</th>
											<td><input readonly type="text" name="thu_start" value="<?= date('h:i A', strtotime($thu_start)) ?>" class="form-control" placeholder="" <?= $thu_start_disable ?>></td>
										    <td><input readonly type="text" name="thu_end" value="<?= date('h:i A', strtotime($thu_end)) ?>" class="form-control" placeholder="" <?= $thu_end_disable ?>></td>
										    <td>
												<label class="checkbox chk-sm">
													<input disabled type="checkbox" name="thu_block" id="thu_block" value="block" class="blockday" <?= $thu_checked ?>>
													<i></i> 
												</label>
										    </td>  
										</tr>
										<tr>
											<?php 
										    if($users->friday == "block"){ 
										    	$fri_start = "";
										    	$fri_end = "";
										    	$fri_checked = "checked";
										    	$fri_start_disable = "disabled";
										    	$fri_end_disable = "disabled";
										    }
										    else{
										    	$fri = explode(',', $users->friday);
										    	$fri_start = $fri[0];
										    	$fri_end = $fri[1];
										    	$fri_checked = "";
										    	$fri_start_disable = "required";
										    	$fri_end_disable = "required";
										    }
										    ?>
											<th scope="row">Friday</th>
											<td><input readonly type="text" name="fri_start" value="<?= date('h:i A', strtotime($fri_start)) ?>" class="form-control" placeholder="" <?= $fri_start_disable ?>></td>
										    <td><input readonly type="text" name="fri_end" value="<?= date('h:i A', strtotime($fri_end)) ?>" class="form-control" placeholder="" <?= $fri_end_disable ?>></td>
										    <td>
												<label class="checkbox chk-sm">
													<input disabled type="checkbox" name="fri_block" id="fri_block" value="block" class="blockday" <?= $fri_checked ?>>
													<i></i> 
												</label>
										    </td>  
										</tr>
										<tr>
											<?php 
										    if($users->saturday == "block"){ 
										    	$sat_start = "";
										    	$sat_end = "";
										    	$sat_checked = "checked";
										    	$sat_start_disable = "disabled";
										    	$sat_end_disable = "disabled";
										    }
										    else{
										    	$sat = explode(',', $users->saturday);
										    	$sat_start = $sat[0];
										    	$sat_end = $sat[1];
										    	$sat_checked = "";
										    	$sat_start_disable = "required";
										    	$sat_end_disable = "required";
										    }
										    ?>
											<th scope="row">Saturday</th>
											<td><input readonly type="text" name="sat_start" value="<?= date('h:i A', strtotime($sat_start)) ?>" class="form-control" placeholder="" <?= $sat_start_disable ?>></td>
										    <td><input readonly type="text" name="sat_end" value="<?= date('h:i A', strtotime($sat_end)) ?>" class="form-control" placeholder="" <?= $sat_end_disable ?>></td>
										    <td>
												<label class="checkbox chk-sm">
													<input disabled type="checkbox" name="sat_block" id="sat_block" value="block" class="blockday" <?= $sat_checked ?>>
													<i></i> 
												</label>
										    </td>  
										</tr>
										<tr>
											<?php 
										    if($users->sunday == "block"){ 
										    	$sun_start = "";
										    	$sun_end = "";
										    	$sun_checked = "checked";
										    	$sun_start_disable = "disabled";
										    	$sun_end_disable = "disabled";
										    }
										    else{
										    	$sun = explode(',', $users->sunday);
										    	$sun_start = $sun[0];
										    	$sun_end = $sun[1];
										    	$sun_checked = "";
										    	$sun_start_disable = "required";
										    	$sun_end_disable = "required";
										    }
										    ?>
											<th scope="row">Sunday</th>
											<td><input readonly type="text" name="sun_start" value="<?= date('h:i A', strtotime($sun_start)) ?>" class="form-control" placeholder="" <?= $sun_start_disable ?>></td>
										    <td><input readonly type="text" name="sun_end" value="<?= date('h:i A', strtotime($sun_end)) ?>" class="form-control" placeholder="" <?= $sun_end_disable ?>></td>
										    <td>
												<label class="checkbox chk-sm">
													<input disabled type="checkbox" name="sun_block" id="sun_block" value="block" class="blockday" <?= $sun_checked ?>>
													<i></i> 
												</label>
										    </td> 
										</tr>
									</tbody>
								</table>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-label">Note</label>
									<textarea  class="form-control" name="note" placeholder="" disabled><?= $users->note ?></textarea>
								</div>
							</div>
							
							
							
							
							<div class="clearfix" style="margin-bottom:40px;"></div>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										<label class="checkbox chk-sm">
											<input type="checkbox" name="chat" value="<?= $users->chat ?>" <?php if($users->chat != null){?> checked <?php } ?> class="menu_click" disabled>
											<i></i> Chat
										</label>
									</div>
									<div class="col-md-2">
										<label class="checkbox chk-sm">
											<input type="checkbox" name="<?= $users->tools ?>" value="off" <?php if($users->tools != null){?> checked <?php } ?> class="menu_click" disabled>
											<i></i> Tools
										</label>
									</div>
									<div class="col-md-2">
										<label class="checkbox chk-sm">
											<input type="checkbox" name="upload_files" value="<?= $users->upload_files ?>" <?php if($users->tools != null){?> checked <?php } ?>  disabled>
											<i></i> Upload Files
										</label>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<h5 class="title-color">Settings</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="setting_profile" value="<?= $users->setting_profile ?>" <?php if($users->setting_profile != null){?> checked <?php } ?> class="menu_click">
										<i></i> Profile
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="setting_banner" value="<?= $users->setting_banner ?>" <?php if($users->setting_banner != null){?> checked <?php } ?> class="menu_click">
										<i></i> Banner
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="setting_import_contact" value="<?= $users->setting_import_contact ?>" <?php if($users->setting_import_contact != null){?> checked <?php } ?> class="menu_click">
										<i></i> Import Contact
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="setting_user_access_role" value="<?= $users->setting_user_access_role ?>" <?php if($users->setting_user_access_role != null){?> checked <?php } ?> class="menu_click">
										<i></i> User Access Role
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="setting_survey" value="<?= $users->setting_survey ?>" <?php if($users->setting_survey != null){?> checked <?php } ?> class="menu_click">
										<i></i> Survey/Polls
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="setting_appointment" value="<?= $users->setting_appointment ?>" <?php if($users->setting_appointment != null){?> checked <?php } ?> class="menu_click">
										<i></i> Appointment
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="setting_client_management" value="<?= $users->setting_client_management ?>" <?php if($users->setting_client_management != null){?> checked <?php } ?> class="menu_click">
										<i></i> Client Management
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="setting_email_management" value="<?= $users->setting_email_management ?>" <?php if($users->setting_email_management != null){?> checked <?php } ?> class="menu_click">
										<i></i> Email Management
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="setting_financial_management" value="<?= $users->setting_financial_management ?>" <?php if($users->setting_financial_management != null){?> checked <?php } ?> class="menu_click">
										<i></i> Financial Management
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="setting_upload_library" value="<?= $users->setting_upload_library ?>" <?php if($users->setting_upload_library != null){?> checked <?php } ?> class="menu_click">
										<i></i> Upload From Library
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="setting_tutorial" value="<?= $users->setting_tutorial ?>" <?php if($users->setting_tutorial != null){?> checked <?php } ?> class="menu_click">
										<i></i> Setting Tutorial
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<h5 class="title-color">Appointment</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="make_appointment" value="<?= $users->make_appointment ?>" <?php if($users->make_appointment != null){?> checked <?php } ?> class="menu_click">
										<i></i> Make Appointment
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="change_appointment" value="<?= $users->change_appointment ?>" <?php if($users->change_appointment != null){?> checked <?php } ?> class="menu_click">
										<i></i> Change Appointment
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="cancel_appointment" value="<?= $users->cancel_appointment ?>" <?php if($users->cancel_appointment != null){?> checked <?php } ?> class="menu_click">
										<i></i> Cancel Appointment
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="appointment_comparison" value="<?= $users->appointment_comparison ?>" <?php if($users->appointment_comparison != null){?> checked <?php } ?> class="menu_click">
										<i></i> Appointment Comparison
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="add_client" value="<?= $users->add_client ?>" <?php if($users->add_client != null){?> checked <?php } ?> class="menu_click">
										<i></i> Add New Client
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="manage_appointment" value="<?= $users->manage_appointment ?>" <?php if($users->manage_appointment != null){?> checked <?php } ?> class="menu_click">
										<i></i> Manage Appointment
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="appointment_tutorial" value="<?= $users->appointment_tutorial ?>" <?php if($users->appointment_tutorial != null){?> checked <?php } ?> class="menu_click">
										<i></i> Appointment Tutorial
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<h5 class="title-color">Email Management</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="email_campaign" value="<?= $users->email_campaign ?>" <?php if($users->email_campaign != null){?> checked <?php } ?> class="menu_click">
										<i></i> Email Campaign
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="send_emails" value="<?= $users->send_emails ?>" <?php if($users->send_emails != null){?> checked <?php } ?> class="menu_click">
										<i></i> Send Emails
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="send_card" value="<?= $users->send_card ?>" <?php if($users->send_card != null){?> checked <?php } ?> class="menu_click">
										<i></i> Send Cards
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="send_video" value="<?= $users->send_video ?>" <?php if($users->send_video != null){?> checked <?php } ?> class="menu_click">
										<i></i> Send Video
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="send_sms" value="<?= $users->send_sms ?>" <?php if($users->send_sms != null){?> checked <?php } ?> class="menu_click">
										<i></i> Send SMS
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="comparison_email" value="<?= $users->comparison_email ?>" <?php if($users->comparison_email != null){?> checked <?php } ?> class="menu_click">
										<i></i> Comparison Email
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="manage_email" value="<?= $users->manage_email ?>" <?php if($users->manage_email != null){?> checked <?php } ?> class="menu_click">
										<i></i> Manage Email
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="email_tutorial" value="<?= $users->email_tutorial ?>" <?php if($users->email_tutorial != null){?> checked <?php } ?> class="menu_click">
										<i></i> Email Tutorial
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<h5 class="title-color">Client Management</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="add_client_management"  value="<?= $users->add_client_management ?>" <?php if($users->add_client_management != null){?> checked <?php } ?> class="menu_click">
										<i></i> Add Client
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="manage_client_profile"  value="<?= $users->manage_client_profile ?>" <?php if($users->manage_client_profile != null){?> checked <?php } ?> class="menu_click">
										<i></i> Manage Client Profile
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="schedular" value="<?= $users->schedular ?>" <?php if($users->schedular != null){?> checked <?php } ?> class="menu_click">
										<i></i> Schedular
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="client_comparison" value="<?= $users->client_comparison ?>" <?php if($users->client_comparison != null){?> checked <?php } ?> class="menu_click">
										<i></i> Comparison
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="client_access"  value="<?= $users->client_access ?>" <?php if($users->client_access != null){?> checked <?php } ?> class="menu_click">
										<i></i> Client Access
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="client_tutorial"  value="<?= $users->client_tutorial ?>" <?php if($users->client_tutorial != null){?> checked <?php } ?> class="menu_click">
										<i></i> Client Tutorial
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<h5 class="title-color">Finance Feature</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="record_transaction" value="<?= $users->record_transaction ?>" <?php if($users->record_transaction != null){?> checked <?php } ?> class="menu_click">
										<i></i> Record Transaction
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="create_budget" value="<?= $users->create_budget ?>" <?php if($users->create_budget != null){?> checked <?php } ?> class="menu_click">
										<i></i> Create Budget
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="create_projection" value="<?= $users->create_projection ?>" <?php if($users->create_projection != null){?> checked <?php } ?> class="menu_click">
										<i></i> Create Projection
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="reports" value="<?= $users->reports ?>" <?php if($users->reports != null){?> checked <?php } ?> class="menu_click">
										<i></i> Reports
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="financial_comparison" value="<?= $users->financial_comparison ?>" <?php if($users->financial_comparison != null){?> checked <?php } ?> class="menu_click">
										<i></i> Financial Comparison
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="financial_tutorial" value="<?= $users->financial_tutorial ?>" <?php if($users->financial_tutorial != null){?> checked <?php } ?> class="menu_click">
										<i></i> Financial Tutorial
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<h5 class="title-color">My Archives</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="archive_edit" value="<?= $users->archive_edit ?>" <?php if($users->archive_edit != null){?> checked <?php } ?> class="menu_click">
										<i></i> Edit
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="archive_delete" value="<?= $users->archive_delete ?>" <?php if($users->archive_delete != null){?> checked <?php } ?> class="menu_click">
										<i></i> Deletion
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="archive_appointment" value="<?= $users->archive_appointment ?>" <?php if($users->archive_appointment != null){?> checked <?php } ?> class="menu_click">
										<i></i> Appointments
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="archive_finance" value="<?= $users->archive_finance ?>" <?php if($users->archive_finance != null){?> checked <?php } ?> class="menu_click">
										<i></i> Financial Management
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="archive_email" value="<?= $users->archive_email ?>" <?php if($users->archive_email != null){?> checked <?php } ?> class="menu_click">
										<i></i> Emails
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="archive_client" value="<?= $users->archive_client ?>" <?php if($users->archive_client != null){?> checked <?php } ?> class="menu_click">
										<i></i> Clients
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="archive_comparison" value="<?= $users->archive_comparison ?>" <?php if($users->archive_comparison != null){?> checked <?php } ?> class="menu_click">
										<i></i> Comparison
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input disabled type="checkbox" name="archive_tutorial" value="<?= $users->archive_tutorial ?>" <?php if($users->archive_tutorial != null){?> checked <?php } ?> class="menu_click">
										<i></i> Tutorial
									</label>
								</div>
							</div>
						
						<!-- <div class="col-md-12" style="margin-top:40px; text-align:center;">
							<input readonly type="submit" class="btn btn-sm btn-info" value="Update">
						</div> -->
						</div>
							
					</form>
				</div>
			</div>

		</div>
	</div>
</section>
<script type="text/javascript">
	$('#password, #confirm_password').on('keyup', function () {
	$('#message').html("");
	  if ($('#password').val() == $('#confirm_password').val()) {
	    $('#message').html("");
	  } else 
	    $('#message').html("Confirm Password doesn't match with password.").css('color', 'red');
	});
	$(".blockday").on('change', function(){
		var blockday = $(this).attr("id");
		var sday = blockday.split('_');
		var day = sday[0];
		// alert(day);
		if($(this).prop('checked')){
			// alert("checked");
			$("input[name='"+day+"_start'").prop('disabled', true);
			$("input[name='"+day+"_start'").removeAttr("required");
			$("input[name='"+day+"_end'").prop('disabled', true);
			$("input[name='"+day+"_end'").removeAttr("required");
			$("input[name='"+day+"_start'").val("");
			$("input[name='"+day+"_end'").val("");
		}
		else{
			// alert("no");
			$("input[name='"+day+"_start'").prop('disabled', false);
			$("input[name='"+day+"_start'").attr("required", true);
			$("input[name='"+day+"_end'").prop('disabled', false);
			$("input[name='"+day+"_end'").attr("required", true);
		}
	});
	$(".menu_click").on("change", function(){
		if($(this).prop('checked')){
			$(this).val("on");
		}
		else{
			$(this).val("off");
		}
	});
	$("#uemail").on("change", function(){
		varr = $(this).val();
        $("#emailexitstance").hide();
        // alert(varr);
        var url = "<?php echo url('/'); ?>/ademailavailability";
        $.ajax({
              url: url,
              data: 'email=' + varr + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                if(response == "success") {
                	$("#emailexitstance").show();
                	$("#emailexitstance").html("The email already exists!!!");
                	$("#affiliateemail").val("");
                }
            }
        });
	});
	$("input[name='video']").on("change", function(){
		$("#uploaded_video").hide();
	});
	$("input[name='image']").on("change", function(){
		$("#uploaded_img").hide();
	});
</script>
@endsection