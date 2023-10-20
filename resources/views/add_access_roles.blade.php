@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:935px;">Access/Roles</h3>
					<a href="{{ url('access_roles') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="">	
									<div class="row gy-4">
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">First Name	</label>
												<input type="text" class="form-control" placeholder="First Name" name="first_name">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Last Name	</label>
												<input type="text" class="form-control" placeholder="Last Name" name="last_name">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Password</label>
												<input type="password" class="form-control" placeholder="Password" name="password">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Confirm Password</label>
												<input type="password" class="form-control" placeholder="Confirm Password">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Cell Phone</label>
												<input class="form-control"  placeholder="" name="cellphone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Email	Address</label>
												<input type="text" class="form-control"  placeholder="Email" name="email" id="affiliateemail" required>
												<span style="color: red" id="emailexitstance"></span>
											</div>
										</div>
										
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Date</label>
												<input type="text" class="form-control date-picker" placeholder="" name="date">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Address</label>
												<input type="text" class="form-control"  placeholder="" name="address"  required>
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
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Zip Code</label>
												<input class="form-control"  placeholder="" name="zip_code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "6" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> City </label>
												<input type="text" class="form-control"  placeholder="" name="city" required>
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
												<label class="form-label">Video Upload</label>
												<div class="form-control-wrap">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="customFile" name="video" accept="video/*">
														<label class="custom-file-label" for="customFile">Choose file</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">File Upload</label>
												<div class="form-control-wrap">
													<div class="custom-file">
														<input type="file" multiple="" class="custom-file-input" id="customFile" name="file">
														<label class="custom-file-label" for="customFile">Choose file</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<h6>Set Access Days Time</h6>
											<table class="table">
												<thead class="thead-light">
													<tr>
													  <th scope="col">Days</th>
													  <th scope="col">Set Start Time</th>
													  <th scope="col">Set End Time</th>
													  <th scope="col">Block Days</th>
													</tr>
												</thead>
												<tbody>
													<tr>
													    <th scope="row">Monday</th>
													    <td><input type="time" class="form-control time-picker dayaccess" name="monday_start" id="monday_start"></td>
													    <td><input type="time" class="form-control time-picker dayaccess" name="monday_end" id="monday_end"></td>
													    <td>
															<div class="custom-control custom-control-sm custom-checkbox">
																<input type="checkbox" class="custom-control-input breakacess" id="mondaybreak">
																<label class="custom-control-label" for="mondaybreak"></label>
															</div>
													    </td> 
													</tr>
													<tr>
														<th scope="row">Tuesday</th>
														<td><input type="time" class="form-control time-picker dayaccess" name="tuesday_start" id="tuesday_start"></td>
													    <td><input type="time" class="form-control time-picker dayaccess" name="tuesday_end" id="tuesday_end"></td>
													    <td>
															<div class="custom-control custom-control-sm custom-checkbox">
																<input type="checkbox" class="custom-control-input breakacess" id="tuesdaybreak">
																<label class="custom-control-label" for="tuesdaybreak"></label>
															</div>
													    </td> 
													</tr>
													<tr>
														<th scope="row">Wednesday</th>
														<td><input type="time" class="form-control time-picker dayaccess" name="wednesday_start" id="wednesday_start"></td>
													    <td><input type="time" class="form-control time-picker dayaccess" name="wednesday_end" id="wednesday_end"></td>
													    <td>
															<div class="custom-control custom-control-sm custom-checkbox">
																<input type="checkbox" class="custom-control-input breakacess" id="wednesdaybreak">
																<label class="custom-control-label" for="wednesdaybreak"></label>
															</div>
													    </td> 
													</tr>
													<tr>
														<th scope="row">Thursday</th>
														<td><input type="time" class="form-control time-picker dayaccess" name="thursday_start" id="thursday_start"></td>
													    <td><input type="time" class="form-control time-picker dayaccess" name="thursday_end" id="thursday_end"></td>
													    <td>
															<div class="custom-control custom-control-sm custom-checkbox">
																<input type="checkbox" class="custom-control-input breakacess" id="thursdaybreak">
																<label class="custom-control-label" for="thursdaybreak"></label>
															</div>
													    </td> 
													</tr>
													<tr>
														<th scope="row">Friday</th>
														<td><input type="time" class="form-control time-picker dayaccess" name="friday_start" id="friday_start"></td>
													    <td><input type="time" class="form-control time-picker dayaccess" name="friday_end" id="friday_end"></td>
													    <td>
															<div class="custom-control custom-control-sm custom-checkbox">
																<input type="checkbox" class="custom-control-input breakacess" id="fridaybreak">
																<label class="custom-control-label" for="fridaybreak"></label>
															</div>
													    </td> 
													</tr>
													<tr>
														<th scope="row">Saturday</th>
														<td><input type="time" class="form-control time-picker dayaccess" name="saturday_start" id="saturday_start"></td>
													    <td><input type="time" class="form-control time-picker dayaccess" name="saturday_end" id="saturday_end"></td>
													    <td>
															<div class="custom-control custom-control-sm custom-checkbox">
																<input type="checkbox" class="custom-control-input breakacess" id="saturdaybreak">
																<label class="custom-control-label" for="saturdaybreak"></label>
															</div>
													    </td> 
													</tr>
													<tr>
														<th scope="row">Sunday</th>
														<td><input type="time" class="form-control time-picker dayaccess" name="sunday_start" id="sunday_start"></td>
													    <td><input type="time" class="form-control time-picker dayaccess" name="sunday_end" id="sunday_end"></td>
													    <td>
															<div class="custom-control custom-control-sm custom-checkbox">
																<input type="checkbox" class="custom-control-input breakacess" id="sundaybreak">
																<label class="custom-control-label" for="sundaybreak"></label>
															</div>
															
													    </td> 
													</tr>
												</tbody>
											</table>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Note</label>
												<textarea  class="form-control" placeholder="" name="note"></textarea>
											</div>
										</div>
										
										
									</div>
									
									
									<div class="row gy-4" style="padding-top:30px;">
										<div class="col-md-3">
											<h6 class="title-color">Appointment Feature</h6>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input">
												<label class="custom-control-label" for="customCheck2">Make Appointment Now</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input">
												<label class="custom-control-label" for="customCheck3">Change Appointment</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input">
												<label class="custom-control-label" for="customCheck4">Cancel Appointment</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input">
												<label class="custom-control-label" for="customCheck5">General Settings</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input">
												<label class="custom-control-label" for="customCheck6">Edit/View Banner</label>
											</div>
											<!-- <div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input">
												<label class="custom-control-label" for="customCheck7">Add New Client</label>
											</div> -->
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input">
												<label class="custom-control-label" for="customCheck8">Manage Clients</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input">
												<label class="custom-control-label" for="customCheck9">Manage Appointment</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck10">Block Dates</label>
											</div>
											
										</div>
										<div class="col-md-3">
											<h6 class="title-color">Email Management Feature</h6>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck11">Import Contacts</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck12">My Mailbox</label>
											</div><br>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck13">Send Email</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck14">Email Campaign</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck15">Send Video</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck16">Manage Contacts</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck17">Manage Folders</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck18">Search Emails</label>
											</div>
											
											
										</div>
										
										<div class="col-md-3">
											<h6 class="title-color">Finance Feature</h6>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck19">Create Revenue Account Now</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck20">Create Expense Account</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck21">Create Expense Account</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck22">Record Revenue</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck23">Record Expense</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck24">Invoice Setup</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck25">Record/ View Assets</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck26">Payment & Billing Report</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck27">View Chart of Account</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck28">Financial Report</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck29">Revenue Report</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck30">Expense Report</label>
											</div>
											
											
										</div>
										<div class="col-md-3">
											<h6 class="title-color">My Archives Feature</h6>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck31">Monthly Appointments</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck32">Quarterly Appointments</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck34">Monthly Financial</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck35">Quarterly Financial</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck36">Event Posted (World)</label>
											</div>
											<div class="custom-control custom-control-sm custom-checkbox">
												<input type="checkbox" class="custom-control-input breakacess" id="break">
												<label class="custom-control-label" for="customCheck33">Editing/Deletion</label>
											</div>
											
										</div>
									</div>
									<div class="row gy-4">
										<div class="col-md-12 text-center" style="margin-top:30px;margin-bottom:30px;">
											<a href="#" class="btn btn-lg btn-primary">Save</a>
											
										</div>
									</div>
									
								</form>
							</div>
						</div>
					</div>
				</div>
				
				
				
			</div>
		</div>
	</div>
</div>

@endsection