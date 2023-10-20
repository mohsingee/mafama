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
	                    <a href="{{ url('/') }}" class="btn btn-md btn-info">Back</a>
					</div>
					<form  action="{{ url('add_user_access') }}" method="POST" id="" enctype="multipart/form-data">	
					@csrf
						<div class="col-md-12"  style="border:1px solid #da291c !important; border-radius:10px;padding-top:30px;padding-bottom:20px;">
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">First Name</label>
									<input type="text" class="form-control" name="first_name" placeholder="First Name" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Last Name	</label>
									<input type="text" class="form-control" name="last_name" placeholder="Last Name"required>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Cell Phone</label>
									<input type="number" class="form-control" name="cellphone" placeholder="Cell Phone"required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Email	Address</label>
									<input type="email" class="form-control" name="email" id="affiliateemail" placeholder="Email Address" required>
									<span style="color: red" id="emailexitstance"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Password</label>
									<input type="password" class="form-control" name="password" placeholder="Password" id="password" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Confirm Password</label>
									<input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" id="confirm_password" required>
									<span id='message'></span>
								</div>
							</div>
							<!-- <div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Date</label>
									<input type="" class="form-control date-picker" placeholder="">
								</div>
							</div> -->
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Address</label>
									<input type="text" class="form-control" name="address" placeholder="" required>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label" for="">Zip Code</label>
									<input type="text" class="form-control" name="zip" placeholder="" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label" for=""> City </label>
									<input type="text" class="form-control" name="city" placeholder="" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label" for="">Country</label>
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
									<label class="form-label" for="">Religious Faith</label>
									<select class="form-control" name="religion">
										<?php
                                            foreach ($religion as $value) {
                                        ?>
                                                <option value="<?= $value->religion ?>"><?= $value->religion ?></option>
                                        <?php
                                            }
                                        ?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Video Upload</label>
									<div class="fancy-file-upload fancy-file-info">
										<i class="fa fa-upload"></i>
										<input type="file" class="form-control" name="video" onchange="jQuery(this).next('input').val(this.value);" required accept="video/*" />
                                        <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                                        <span class="button">Choose File</span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">File Upload</label>
									<div class="fancy-file-upload fancy-file-info">
										<i class="fa fa-upload"></i>
										<input type="file" class="form-control" required name="image" onchange="jQuery(this).next('input').val(this.value);" />
                                        <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                                        <span class="button">Choose File</span>
									</div>
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
										    <th scope="row">Monday</th>
										    <td style="padding: 8px 30px;">
										    	<input type="hidden" name="mon_start" class="form-control" placeholder="" value="06:00 AM" required>
										    	<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="mon_start">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00" selected>06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00">10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="mon_start1">
										    				<option value="AM" selected>AM</option>
										    				<option value="PM">PM</option>
										    			</select>
										    		</div>
										    	</div>
										    </td>
										    <td style="padding: 8px 30px;">
										    	<input type="hidden" name="mon_end" class="form-control" placeholder="" value="10:00 PM" required>
										    	<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="mon_end">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00">06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00" selected>10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="mon_end1">
										    				<option value="AM">AM</option>
										    				<option value="PM" selected>PM</option>
										    			</select>
										    		</div>
										    	</div>
										    </td>
										    <td>
												<label class="checkbox chk-sm">
													<input name="mon_block" id="mon_block" type="checkbox" value="block" class="blockday">
													<i></i> 
												</label>
										    </td> 
										</tr>
										<tr>
											<th scope="row">Tuesday</th>
											<td style="padding: 8px 30px;">
												<input type="hidden" name="tues_start" class="form-control" placeholder="" value="06:00 AM" value="06:00 AM" required>
												<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="tues_start">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00" selected>06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00">10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="tues_start1">
										    				<option value="AM" selected>AM</option>
										    				<option value="PM">PM</option>
										    			</select>
										    		</div>
										    	</div>
											</td>
										    <td style="padding: 8px 30px;">
										    	<input type="hidden" name="tues_end" class="form-control" placeholder="" value="10:00 PM" required>
										    	<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="tues_end">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00">06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00" selected>10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="tues_end1">
										    				<option value="AM">AM</option>
										    				<option value="PM" selected>PM</option>
										    			</select>
										    		</div>
										    	</div>
										    </td>
										    <td>
												<label class="checkbox chk-sm">
													<input type="checkbox" name="tues_block" id="tues_block" value="block" class="blockday">
													<i></i> 
												</label>
										    </td> 
										</tr>
										<tr>
											<th scope="row">Wednesday</th>
											<td style="padding: 8px 30px;">
												<input type="hidden" name="wed_start" class="form-control" placeholder="" value="06:00 AM" required>
												<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="wed_start">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00" selected>06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00">10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="wed_start1">
										    				<option value="AM" selected>AM</option>
										    				<option value="PM">PM</option>
										    			</select>
										    		</div>
										    	</div>
											</td>
										    <td style="padding: 8px 30px;">
										    	<input type="hidden" name="wed_end" class="form-control" placeholder="" value="10:00 PM" required>
										    	<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="wed_end">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00">06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00" selected>10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="wed_end1">
										    				<option value="AM">AM</option>
										    				<option value="PM" selected>PM</option>
										    			</select>
										    		</div>
										    	</div>
										    </td>
										    <td>
												<label class="checkbox chk-sm">
													<input type="checkbox" name="wed_block" id="wed_block" value="block" class="blockday">
													<i></i> 
												</label>
										    </td> 
										</tr>
										<tr>
											<th scope="row">Thursday</th>
											<td style="padding: 8px 30px;">
												<input type="hidden" name="thu_start" class="form-control" placeholder="" value="06:00 AM" required>
												<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="thu_start">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00" selected>06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00">10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="thu_start1">
										    				<option value="AM" selected>AM</option>
										    				<option value="PM">PM</option>
										    			</select>
										    		</div>
										    	</div>
											</td>
										    <td style="padding: 8px 30px;">
										    	<input type="hidden" name="thu_end" class="form-control" placeholder="" value="10:00 PM" required>
										    	<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="thu_end">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00">06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00" selected>10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="thu_end1">
										    				<option value="AM">AM</option>
										    				<option value="PM" selected>PM</option>
										    			</select>
										    		</div>
										    	</div>
										    </td>
										    <td>
												<label class="checkbox chk-sm">
													<input type="checkbox" name="thu_block" id="thu_block" value="block" class="blockday">
													<i></i> 
												</label>
										    </td> 
										</tr>
										<tr>
											<th scope="row">Friday</th>
											<td style="padding: 8px 30px;">
												<input type="hidden" name="fri_start" class="form-control" placeholder="" value="06:00 AM" required>
												<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="fri_start">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00" selected>06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00">10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="fri_start1">
										    				<option value="AM" selected>AM</option>
										    				<option value="PM">PM</option>
										    			</select>
										    		</div>
										    	</div>
											</td>
										    <td style="padding: 8px 30px;">
										    	<input type="hidden" name="fri_end" class="form-control" placeholder="" value="10:00 PM" required>
										    	<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="fri_end">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00">06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00" selected>10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="fri_end1">
										    				<option value="AM">AM</option>
										    				<option value="PM" selected>PM</option>
										    			</select>
										    		</div>
										    	</div>
										    </td>
										    <td>
												<label class="checkbox chk-sm">
													<input type="checkbox" name="fri_block" id="fri_block" value="block" class="blockday">
													<i></i> 
												</label>
										    </td> 
										</tr>
										<tr>
											<th scope="row">Saturday</th>
											<td style="padding: 8px 30px;">
												<input type="hidden" name="sat_start" class="form-control" placeholder="" value="06:00 AM" required>
												<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="sat_start">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00" selected>06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00">10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="sat_start1">
										    				<option value="AM" selected>AM</option>
										    				<option value="PM">PM</option>
										    			</select>
										    		</div>
										    	</div>
											</td>
										    <td style="padding: 8px 30px;">
										    	<input type="hidden" name="sat_end" class="form-control" placeholder="" value="10:00 PM" required>
										    	<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="sat_end">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00">06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00" selected>10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="sat_end1">
										    				<option value="AM">AM</option>
										    				<option value="PM" selected>PM</option>
										    			</select>
										    		</div>
										    	</div>
										    </td>
										    <td>
												<label class="checkbox chk-sm">
													<input type="checkbox" name="sat_block" id="sat_block" value="block" class="blockday">
													<i></i> 
												</label>
										    </td> 
										</tr>
										<tr>
											<th scope="row">Sunday</th>
											<td style="padding: 8px 30px;">
												<input type="hidden" name="sun_start" class="form-control" placeholder="" value="06:00 AM" required>
												<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="sun_start">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00" selected>06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00">10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="sun_start1">
										    				<option value="AM" selected>AM</option>
										    				<option value="PM">PM</option>
										    			</select>
										    		</div>
										    	</div>
											</td>
										    <td style="padding: 8px 30px;">
										    	<input type="hidden" name="sun_end" class="form-control" placeholder="" value="10:00 PM" required>
										    	<div class="row">
										    		<div class="col-md-8" style="padding: 0 5px">
										    			<select class="form-control" id="sun_end">
										    				<option value="01:00">01:00</option>
										    				<option value="01:30">01:30</option>
										    				<option value="02:00">02:00</option>
										    				<option value="02:30">02:30</option>
										    				<option value="03:00">03:00</option>
										    				<option value="03:30">03:30</option>
										    				<option value="04:00">04:00</option>
										    				<option value="04:30">04:30</option>
										    				<option value="05:00">05:00</option>
										    				<option value="05:30">05:30</option>
										    				<option value="06:00">06:00</option>
										    				<option value="06:30">06:30</option>
										    				<option value="07:00">07:00</option>
										    				<option value="07:30">07:30</option>
										    				<option value="08:00">08:00</option>
										    				<option value="08:30">08:30</option>
										    				<option value="09:00">09:00</option>
										    				<option value="09:30">09:30</option>
										    				<option value="10:00" selected>10:00</option>
										    				<option value="10:30">10:30</option>
										    				<option value="11:00">11:00</option>
										    				<option value="11:30">11:30</option>
										    				<option value="12:00">12:00</option>
										    				<option value="12:30">12:30</option>
										    			</select>
										    		</div>
										    		<div class="col-md-4" style="padding: 0 5px">
										    			<select class="form-control" id="sun_end1">
										    				<option value="AM">AM</option>
										    				<option value="PM" selected>PM</option>
										    			</select>
										    		</div>
										    	</div>
											</td>
										    <td>
												<label class="checkbox chk-sm">
													<input type="checkbox" name="sun_block" id="sun_block" value="block" class="blockday">
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
									<textarea  class="form-control" name="note" placeholder="" required></textarea>
								</div>
							</div>
							
							
							
							
							<div class="clearfix" style="margin-bottom:40px;"></div>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										<label class="checkbox chk-sm">
											<input type="checkbox" name="chat" value="off" class="menu_click">
											<i></i> Chat
										</label>
									</div>
									<div class="col-md-2">
										<label class="checkbox chk-sm">
											<input type="checkbox" name="tools" value="off" class="menu_click">
											<i></i> Tools
										</label>
									</div>
									<div class="col-md-2">
										<label class="checkbox chk-sm">
											<input type="checkbox" name="upload_files" value="off" class="menu_click">
											<i></i> Upload Files
										</label>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<h5 class="title-color">Settings</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="setting_profile" value="off" class="menu_click">
										<i></i> Profile
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="setting_banner" value="off" class="menu_click">
										<i></i> Banner
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="setting_import_contact" value="off" class="menu_click">
										<i></i> Import Contact
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="setting_user_access_role" value="off" class="menu_click">
										<i></i> User Access Role
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="setting_survey" value="off" class="menu_click">
										<i></i> Survey/Polls
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="setting_appointment" value="off" class="menu_click">
										<i></i> Appointment
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="setting_client_management" value="off" class="menu_click">
										<i></i> Client Management
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="setting_email_management" value="off" class="menu_click">
										<i></i> Email Management
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="setting_financial_management" value="off" class="menu_click">
										<i></i> Financial Management
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="setting_upload_library" value="off" class="menu_click">
										<i></i> Upload From Library
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="setting_tutorial" value="off" class="menu_click">
										<i></i> Setting Tutorial
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<h5 class="title-color">Appointment</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="make_appointment" value="off" class="menu_click">
										<i></i> Make Appointment
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="change_appointment" value="off" class="menu_click">
										<i></i> Change Appointment
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="cancel_appointment" value="off" class="menu_click">
										<i></i> Cancel Appointment
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="appointment_comparison" value="off" class="menu_click">
										<i></i> Appointment Comparison
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="add_client" value="off" class="menu_click">
										<i></i> Add New Client
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="manage_appointment" value="off" class="menu_click">
										<i></i> Manage Appointment
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="appointment_tutorial" value="off" class="menu_click">
										<i></i> Appointment Tutorial
									</label>
								</div>
								
							</div>
							<div class="col-md-2">
								<h5 class="title-color">Email Management</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="email_campaign" value="off" class="menu_click">
										<i></i> Email Campaign
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="send_emails" value="off" class="menu_click">
										<i></i> Send Emails
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="send_card" value="off" class="menu_click">
										<i></i> Send Cards
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="send_video" value="off" class="menu_click">
										<i></i> Send Video
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="send_sms" value="off" class="menu_click">
										<i></i> Send SMS
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="comparison_email" value="off" class="menu_click">
										<i></i> Comparison Email
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="manage_email" value="off" class="menu_click">
										<i></i> Manage Email
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="email_tutorial" value="off" class="menu_click">
										<i></i> Email Tutorial
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<h5 class="title-color">Client Management</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="add_client_management" value="off" class="menu_click">
										<i></i> Add Client
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="manage_client_profile" value="off" class="menu_click">
										<i></i> Manage Client Profile
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="schedular" value="off" class="menu_click">
										<i></i> Schedular
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="client_comparison" value="off" class="menu_click">
										<i></i> Comparison
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="client_access" value="off" class="menu_click">
										<i></i> Client Access
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="client_tutorial" value="off" class="menu_click">
										<i></i> Client Tutorial
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<h5 class="title-color">Finance Feature</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="record_transaction" value="off" class="menu_click">
										<i></i> Record Transaction
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="create_budget" value="off" class="menu_click">
										<i></i> Create Budget
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="create_projection" value="off" class="menu_click">
										<i></i> Create Projection
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="reports" value="off" class="menu_click">
										<i></i> Reports
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="financial_comparison" value="off" class="menu_click">
										<i></i> Financial Comparison
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="financial_tutorial" value="off" class="menu_click">
										<i></i> Financial Tutorial
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<h5 class="title-color">My Archives</h5>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="archive_edit" value="off" class="menu_click">
										<i></i> Edit
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="archive_delete" value="off" class="menu_click">
										<i></i> Deletion
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="archive_appointment" value="off" class="menu_click">
										<i></i> Appointments
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="archive_finance" value="off" class="menu_click">
										<i></i> Financial Management
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="archive_email" value="off" class="menu_click">
										<i></i> Emails
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="archive_client" value="off" class="menu_click">
										<i></i> Clients
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="archive_comparison" value="off" class="menu_click">
										<i></i> Comparison
									</label>
								</div>
								<div class="col-md-12 padding-0">
									<label class="checkbox chk-sm">
										<input type="checkbox" name="archive_tutorial" value="off" class="menu_click">
										<i></i> Tutorial
									</label>
								</div>
							</div>
						
						<div class="col-md-12" style="margin-top:40px; text-align:center;">
							<input type="submit" class="btn btn-sm btn-info" value="Submit">
						</div>
						</div>
							
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
			var time = $("#"+day+"_start").val();
			var time1 = $("#"+day+"_start1").val();
			var timee = $("#"+day+"_end").val();
			var timee1 = $("#"+day+"_end1").val();
			$("input[name='"+day+"_start'").val(time+" "+time1);
			$("input[name='"+day+"_end'").val(timee+" "+timee1);
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
	// $("#uemail").on("change", function(){
	// 	varr = $(this).val();
 //        $("#emailexitstance").hide();
 //        // alert(varr);
 //        var url = "<?php echo url('/'); ?>/ademailavailability";
 //        $.ajax({
 //              url: url,
 //              data: 'email=' + varr + '&_token={{ csrf_token() }}',
 //              type: "POST",
 //            success: function (response) {
 //                // alert(response);
 //                if(response == "success") {
 //                	$("#emailexitstance").show();
 //                	$("#emailexitstance").html("The email already exists!!!");
 //                	$("#affiliateemail").val("");
 //                }
 //            }
 //        });
	// });
	$(function() {
        setTimeout(function() {
            $("#affiliateemail").trigger('change');
        },10);
    });
    // $(document).on("change", "#affiliateemail", function(){
    $("#affiliateemail").change(function(){
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
                if(response == "success"){
                    // alert("hi");
                    $("#emailexitstance").show();
                    $("#emailexitstance").html("The email already exists!!!");
                    $("#affiliateemail").val("");
                }
                // if(response == "success") {
                    
                // }
                else{
                    // alert("bye");
                }
            }
        });
    });
</script>
<script type="text/javascript">
	$("#mon_start").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#mon_start1").val();
	    $("input[name='mon_start']").val(mst+" "+mst1);
	});
	$("#mon_start1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#mon_start").val();
	    $("input[name='mon_start']").val(mst+" "+mst1);
	});
	$("#tues_start").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#tues_start1").val();
	    $("input[name='tues_start']").val(mst+" "+mst1);
	});
	$("#tues_start1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#tues_start").val();
	    $("input[name='tues_start']").val(mst+" "+mst1);
	});
	$("#wed_start").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#wed_start1").val();
	    $("input[name='wed_start']").val(mst+" "+mst1);
	});
	$("#wed_start1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#wed_start").val();
	    $("input[name='wed_start']").val(mst+" "+mst1);
	});
	$("#thu_start").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#thu_start1").val();
	    $("input[name='thu_start']").val(mst+" "+mst1);
	});
	$("#thu_start1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#thu_start").val();
	    $("input[name='thu_start']").val(mst+" "+mst1);
	});
	$("#fri_start").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#fri_start1").val();
	    $("input[name='fri_start']").val(mst+" "+mst1);
	});
	$("#fri_start1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#fri_start").val();
	    $("input[name='fri_start']").val(mst+" "+mst1);
	});
	$("#sat_start").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#sat_start1").val();
	    $("input[name='sat_start']").val(mst+" "+mst1);
	});
	$("#sat_start1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#sat_start").val();
	    $("input[name='sat_start']").val(mst+" "+mst1);
	});
	$("#sun_start").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#sun_start1").val();
	    $("input[name='sun_start']").val(mst+" "+mst1);
	});
	$("#sun_start1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#sun_start").val();
	    $("input[name='sun_start']").val(mst+" "+mst1);
	});
	$("#mon_end").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#mon_end1").val();
	    $("input[name='mon_end']").val(mst+" "+mst1);
	});
	$("#mon_end1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#mon_end").val();
	    $("input[name='mon_end']").val(mst+" "+mst1);
	});
	$("#tues_end").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#tues_end1").val();
	    $("input[name='tues_end']").val(mst+" "+mst1);
	});
	$("#tues_end1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#tues_end").val();
	    $("input[name='tues_end']").val(mst+" "+mst1);
	});
	$("#wed_end").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#wed_end1").val();
	    $("input[name='wed_end']").val(mst+" "+mst1);
	});
	$("#wed_end1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#wed_end").val();
	    $("input[name='wed_end']").val(mst+" "+mst1);
	});
	$("#thu_end").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#thu_end1").val();
	    $("input[name='thu_end']").val(mst+" "+mst1);
	});
	$("#thu_end1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#thu_end").val();
	    $("input[name='thu_end']").val(mst+" "+mst1);
	});
	$("#fri_end").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#fri_end1").val();
	    $("input[name='fri_end']").val(mst+" "+mst1);
	});
	$("#fri_end1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#fri_end").val();
	    $("input[name='fri_end']").val(mst+" "+mst1);
	});
	$("#sat_end").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#sat_end1").val();
	    $("input[name='sat_end']").val(mst+" "+mst1);
	});
	$("#sat_end1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#sat_end").val();
	    $("input[name='sat_end']").val(mst+" "+mst1);
	});
	$("#sun_end").on("change", function(){
		var mst = $(this).val();
		var mst1 = $("#sun_end1").val();
	    $("input[name='sun_end']").val(mst+" "+mst1);
	});
	$("#sun_end1").on("change", function(){
		var mst1 = $(this).val();
		var mst = $("#sun_end").val();
	    $("input[name='sun_end']").val(mst+" "+mst1);
	});
</script>
@endsection