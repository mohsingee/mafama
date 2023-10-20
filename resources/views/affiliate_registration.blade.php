@extends('layouts.main')
@section('content')
<style type="text/css">
	input#sendon,
	input#reminderdate {
		position: relative;
		/*width: 150px; height: 20px;*/
		/*color: white;*/
	}

	input#sendon:before,
	input#reminderdate:before {
		position: absolute;
		/*top: 3px; left: 3px;*/
		content: attr(data-date);
		display: inline-block;
		color: black;
	}

	input#sendon::-webkit-datetime-edit,
	input#sendon::-webkit-inner-spin-button,
	input#sendon::-webkit-clear-button {
		display: none;
	}


	input#sendon::-webkit-calendar-picker-indicator {
		position: absolute;
		/*top: 3px;*/
		right: 0;
		color: black;
		opacity: 1;
	}
</style>
<section>
	<div class="container">
		<div class="row">
			<!-- tabs content -->
			<div class="col-md-12 col-sm-12">
				<div class="row">
					<form name="submit_register" method="POST" id="manageRegister" enctype="multipart/form-data">
						@csrf
						<div class="" style="padding-bottom: 20px;">
							<div class="col-md-12 text-right">
								<a href="{{ url('/') }}" class="btn btn-md btn-info">Back</a>
							</div>
							<div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
								<h4>Affiliate Registration</h4>
							</div>

							@if($affiliate_reg_status=='off')
							<div class="row" style="display: flex; align-items: center; flex-wrap: wrap;">
								<div class="col-md-12 text-center">
									<h4>Currently affiliate registrations are closed.</h4>
								</div>
							</div>
							@else
							<div class="row " style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; padding-bottom:20px;">
								<div class="col-md-4" style="width: 35rem">
									<div class="form-group" >
										<label class="form-label">Affiliate Code</label>
										<input type="text" class="form-control" placeholder="Affilate Code" name="code" id="affiliate_code" autocomplete="off" value="{{ isset($code)?$code:'' }}" {{ !empty($code)?'readonly':'' }}>
										<span style="color: red;" id="codeexitstance"></span>
									</div>
								</div>

								@if(!empty($user_id))
								<div class="col-md-4" style="width: 35rem">
									<div class="form-group">
										<label class="form-label">Sponsor Id</label>
										<input type="text" class="form-control" placeholder="Sponsor Id" name="sponsor_id" id="sponsor_id" autocomplete="off" value="{{ isset($user_id)?$user_id:'' }}" {{ isset($user_id)?"readonly":"" }}>
										<span style="color: red;" id="codeexitstance"></span>
									</div>
								</div>
								@else
								<input type="hidden" name="sponsor_id" id="sponsor_id" value='admin@gmail.com'>
								@endif
							</div>


							<!--<div class="clearfix"></div>-->
							<!--<div class="divider"><!-- divider -->
						</div>
						<!---->
		<div class="row" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; padding-bottom:20px;">
							<div class="col-md-12 text-center heading-title">
								<h4 style="color: black;">Profile Information</h4>
							</div>




							<?php $today = date('Y-m-d') ?>
							<input type="hidden" name="joining_date" value="<?= $today ?>">
							<!-- <div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Joining Date</label>
												<input type="text" class="form-control date-picker"  placeholder="Joining Date" name="joining_date" autocomplete="off" required>
											</div>
										</div> -->









							<div style="width: 35rem;" class="col-md-4">
								<div class="form-group">
									<label class="form-label" for="">Country Of Birth</label>
									<select id="birth_countries_states1" class="form-control bfh-countries" name="birth_country" required></select>
									<span class="text-danger birth_country_message" style="display:none">Before going to the next step select Country of birth first</span>
								</div>
							</div>

							<div style="width: 35rem;" class="col-md-4 birth_comm" style="display:none">
								<div class="form-group">
									<label class="form-label" for="">Birth State/Province/Commune</label>
									<select id="birth_commune" onchange="onBirthCommuneChange()" class="form-control bfh-commune" name="birth_commune" required>
										<option value=""></option>
										@foreach($communes as $commune)
										<option value="{{ $commune->id }}">{{ $commune->commune }}</option>
										@endforeach
									</select>
									<span class="text-danger birth_commune_message" style="display:none">Before going to the next field select Commune first</span>
								</div>
							</div>

							<div style="width: 35rem;" class="col-md-4 birth_state" style="display:none">
								<div class="form-group">
									<label class="form-label" for="">Birth State/Province/Commune</label>
									<select id="birth_state" class="form-control bfh-states birth-state-focus" data-country="birth_countries_states1" name="birth_state" required></select>
									<span class="text-danger birth_state_message" style="display:none">Before going to the next field select State/Province first</span>
								</div>
							</div>











							<div style="width: 35rem;" class="col-md-4">
								<div class="form-group">
									<label class="form-label">First Name</label>
									<input type="text" class="form-control" placeholder="Profile First Name" name="first_name" required value="{{old('first_name')}}" required>
								</div>
							</div>
							<div style="width: 35rem;" class="col-md-4">
								<div class="form-group">
									<label class="form-label">Last Name</label>
									<input type="text" class="form-control" placeholder="Profile Last Name" name="last_name" value="{{old('last_name')}}" required>
								</div>
							</div>
							<div style="width: 35rem;" class="col-md-4">
								<div class="form-group">
									<label class="form-label" for="">Cell Phone</label>
									<input style="width: 32rem;" class="form-control" placeholder="" onchange="getPhoneNo()" id="cellphone" name="format-cellphone"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "tel" maxlength = "10" value="{{old('cellphone')}}" required>
									<span class="text-danger" id="cellPhoneToast" style="display:none">Please enter correct number</span>
									<input type="hidden" name="cellphone" id="cellphone-inp"/>
								</div>
							</div>
							<div style="width: 35rem;" class="col-md-4">
								<div class="form-group">
									<label  class="form-label"  for="">Business Telephone</label>
									<input style="width: 32rem;" type="tel" class="form-control" placeholder="" id="business_telephone" name="business_telephone_inp" onchange="getBusinessPhoneNo()" value="{{old('business_telephone')}}" required>
									<span class="text-danger" id="businessPhoneToast" style="display:none">Please enter correct number</span>
									<input type="hidden" name="business_telephone" id="business_telephone_inp"/>
								</div>
							</div>

							<div style="width: 35rem;" class="col-md-4">
								<div class="form-group">
									<label class="form-label" for="">Religious Faith/ Spirituality</label>
									<select class="form-control" name="religion" id="otherreligion">
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
							<div style="width: 35rem;" class="col-md-4" id="relother" style="display:none">
								<div class="form-group">
									<label class="form-label" for="">Religious Faith/ Spirituality</label>
									<input type="text" class="form-control" name="religionother" id="religionother" placeholder="Enter your Religion">
								</div>
							</div>
							<div style="width: 35rem;" class="col-md-4">
								<div class="form-group">
									<label class="form-label">Email</label>
									<input type="text" class="form-control" placeholder="Profile Email" name="email" id="affiliateemail" required value="{{old('email')}}">
									<span style="color: red" id="emailexitstance"></span>
								</div>
							</div>

							<div style="width: 35rem;" class="col-md-4">
								<div class="form-group">
									<label class="form-label">Date Of Birth</label>

									<input type="hidden" name="dob" class="form-control" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" id="sendon" value="{{old('dob')}}">





									<select id="dob_day" name="day" class="bg-white width-100" required>
										<option value="0">Day</option>
										@for($i=01; $i<=31; $i++) <option value="{{$i}}">{{$i}}</option>
											@endfor
									</select>



									<select id="dob_month" name="month" class="bg-white width-100" required>
										<option value="0">Month</option>
										<option value="01">Jan</option>
										<option value="02">Feb</option>
										<option value="03">Mar</option>
										<option value="04">Apr</option>
										<option value="05">May</option>
										<option value="06">Jun</option>
										<option value="07">Jul</option>
										<option value="08">Aug</option>
										<option value="09">Sep</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
									</select>

									@php
									$year_start = 1940;
									$year_end = date('Y') - 19; // current Year
									@endphp

									<select id="dob_year" name="year" class="bg-white width-100" required>
										<option value="0">Year</option>
										@for($i=$year_start; $i<=$year_end; $i++) <option value="{{$i}}">{{$i}}</option>
											@endfor
									</select>











								</div>
							</div>

							<div style="width: 35rem;" class="col-md-4">
								<div class="form-group">
									<label class="form-label" for="">Country Of Residense</label>
									<select id="countries_states1" class="form-control bfh-countries" name="country" required></select>
									<span class="text-danger country_message" style="display:none">Before going to the next step select Country of residence first</span>
									<span class="text-danger country_message_2" style="display:none">Before going to the next step select Country of residence first</span>
								</div>
							</div>
							<div style="width: 35rem;" class="col-md-4 select_state" style="display:none">
								<div class="form-group">
									<label class="form-label" for="">State/Province/Commune</label>
									<select id="state" class="form-control bfh-states state-focus" data-country="countries_states1" name="state" required></select>
									<span class="text-danger state_message" style="display:none">Before going to the next field select State/Province first</span>
								</div>
							</div>

							<div style="width: 35rem;" class="col-md-4 comm" style="display:none">
								<div class="form-group">
									<label class="form-label" for="">State/Province/Commune</label>
									<select id="commune" onchange="onCommuneChange()" class="form-control bfh-commune" name="commune" required>
										<option value=""></option>
										@foreach($communes as $commune)
										<option value="{{ $commune->id }}">{{ $commune->commune }}</option>
										@endforeach
									</select>
									<span class="text-danger commune_message" style="display:none">Before going to the next field select Commune first</span>
								</div>
							</div>

							<div style="width: 35rem;" class="col-md-4 zip_code" style="display:none"">
											<div class=" form-group">
								<label class="form-label" for="">Zip Code</label>
								<input class="form-control" id="zip_code" placeholder="" name="zip_code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" value="{{old('zip_code')}}" maxlength="6" required>
							</div>
						</div>

						<div style="width: 35rem;" class="col-md-4">
							<div class="form-group">
								<label class="form-label" for="">Street Address</label>
								<input type="text" class="form-control" placeholder="" name="address" value="{{old('address')}}" required>
							</div>
						</div>
						<div style="width: 35rem;" class="col-md-4">
							<div class="form-group">
								<label class="form-label" for=""> City </label>
								<input type="text" class="form-control" placeholder="" name="city" required value="{{old('city')}}">
							</div>
						</div>
						<!--business_cat -->
						<div style="width: 35rem;" class="col-md-4">
							<div class="form-group">
								<label class="form-label" for="">Choose a Business Category</label>
								<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="business_category" id="businesscat" required>
									<option value="">Select</option>
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
						<div style="width: 35rem;" class="col-md-4" id="otherbusiness" style="display:none">
							<div class="form-group">
								<label class="form-label" for="">Other Business</label>
								<input type="text" id="businessother" name="businessother" class="form-control" placeholder="Enter your other business">
							</div>
						</div>
						<div style="width: 35rem;" class="col-md-4">
							<div class="form-group">
								<label class="form-label" for=""> Profession/Study</label>
								<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="lead_category">
									<option value="">Select</option>
									@foreach($lead_cats as $value)

									<option value="{{ $value->id }}">{{$value->category}} </option>
									@endforeach

								</select>
							</div>
						</div>


						<div style="width: 35rem;" class="col-md-4">
							<div class="form-group">
								<label class="form-label" for="">Uplaod Picture</label>
								<div class="fancy-file-upload fancy-file-info">
									<i class="fa fa-upload"></i>
									<input type="file" class="form-control" name="image" onchange="jQuery(this).next('input').val(this.value);" />
									<input type="text" class="form-control" placeholder="no file selected" readonly="" />
									<span class="button">Choose File</span>
								</div>
							</div>
						</div>

						<div style="width: 35rem;" class="col-md-4">
							<div class="form-group">
								<label class="form-label">Password</label>
								<input type="password" class="form-control" placeholder="Password" id="mypass" name="password" value="{{old('password')}}" autocomplete="off" required>
							</div>
							@if ($errors->has('password'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif
						</div>

						<div style="width: 35rem;" class="col-md-4">
							<div class="form-group">
								<label class="form-label">Confirm Password</label>
								<input type="password" class="form-control" placeholder="Confirm assword" name="confirm_password" id="confirm_password" autocomplete="off" required>
							</div>
							<span class="cpass"></span>
							@if ($errors->has('confirm_password'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('confirm_password') }}</strong>
							</span>
							@endif
						</div>
						<div style="width: 35rem;" class="col-md-4">
							<div class="form-group">
								<label class="form-label">Company Name</label>
								<input type="text" class="form-control" placeholder="Company Name" name="company" autocomplete="off" required value="{{old('company')}}">
							</div>
						</div>
				</div>
				<div class="clearfix"></div>
				<!--<div class="divider"><!-- divider </div>	-->
				<!--<div class="row gy-4" style="padding-bottom:20px;">-->

				<!--	<div class="col-md-12 text-center" style="margin-top:20px;">-->
				<!--		<h6>Billing Information</h6>-->
				<!--	</div>-->
				<!--	<div class="col-md-6">-->
				<!--		<div class="form-group">-->
				<!--			<label class="form-label" for="">Street Address</label>-->
				<!--			<input type="text" class="form-control"  placeholder="" name="billing_address" value="{{old('billing_address')}}" required>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--	<div class="col-md-6">-->
				<!--		<div class="form-group">-->
				<!--			<label class="form-label" for="">Zip Code</label>-->
				<!--			<input class="form-control"  placeholder="" id="billing_zip_code" name="billing_zip_code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "6" required value="{{old('billing_zip_code')}}">-->
				<!--		</div>-->
				<!--	</div>-->
				<!--	<div class="col-md-4">-->
				<!--		<div class="form-group">-->
				<!--			<label class="form-label" for=""> City </label>-->
				<!--			<input type="text" class="form-control"  placeholder="" name="billing_city" required value="{{old('billing_city')}}">-->
				<!--		</div>-->
				<!--	</div>-->
				<!--	<div class="col-md-4">-->
				<!--		<div class="form-group">-->
				<!--			<label class="form-label" for="">Country</label>-->
				<!--			<select id="countries_states2" class="form-control bfh-countries" data-country="US" name="billing_country" required ></select>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--	<div class="col-md-4">-->
				<!--		<div class="form-group">-->
				<!--			<label class="form-label" for="">State/Province</label>-->
				<!--			<select class="form-control bfh-states" data-country="countries_states2" name="billing_state" required></select>-->
				<!--		</div>-->
				<!--	</div>-->


				<!--</div>-->
				<div class="col-md-12" style="margin-left: 40px;">
					<h4>
						<label class="checkbox chk-sm" style="color: #da291c;">
							<input type="checkbox" name="terms" value="1" required="" />
							<i></i> Agree <a href="javascript:void(0)" data-toggle="modal" data-target="#termData">terms and conditions</a>
						</label>
					</h4>
				</div>
				<div class="col-md-12" style="margin-top:10px; text-align:center;">
					<input type="button" data-action="{{ url('adaffiliate_entry') }}" class="btn btn-lg btn-primary btn_submit" value="Save">
				</div>
			</div>
			</form>
			@endif
		</div>
	</div>
	</div>
	</div>
</section>


<div id="termData" class="modal fade" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Term & Conditions</h4>
			</div>
			<div class="modal-body ">
				<div class="row">
					<div class="col-md-12">
						{!! $terms !!}
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on('click', '.btn_submit', function(e) {

		if ($('#countries_states1').val() == "") {
			$(".country_message").show();
			$(".country_message").focus();
			$('#countries_states1').focus();
			return false;
		}
		e.preventDefault();
		swal({
			title: 'Confirm Business Category',
			text: "Please make sure business category first after make any transaction it could not be update",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: ' Continue ',
			cancelButtonText: ' Edit ',
			confirmButtonClass: 'btn btn-success btn-md mybtn',
			cancelButtonClass: 'btn btn-primary btn-md mybtn',
			buttonsStyling: false,
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$elm = $(this);
				$elm.hide();
				$elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
				var action = $(this).attr("data-action");
				var form = $("#manageRegister");
				form.attr('action', action);
				form.submit();
				$(".submit-loading").remove();
				$elm.show();


			}
		})

	});

	$(document).on('blur', '#confirm_password', function() {
		var password = $("#mypass").val();
		var confirm_password = $(this).val();
		//alert(password+'='+confirm_password);
		if (confirm_password == password) {

			$(".cpass").text('Password and confirm matches.');
			$(".cpass").css('color', 'green');
		} else {
			$(".cpass").text('Password and confirm password does not match');
			$(".cpass").css('color', 'red');
		}
	});
	$(document).on('change', '#zip_code', function() {
		var pincode = $(this).val();
		var _token = "{{ csrf_token() }}";
		var url = "<?= url('/'); ?>/get_street_info";
		$.ajax({
			url: url,
			data: {
				pincode: pincode,
				_token: _token
			},
			type: "POST",
			success: function(resp) {
				resp = JSON.parse(resp);
				$("input[name='city']").val(resp.city);
				$("input[name='address']").val(resp.street);
				console.log(resp);

			}
		});


	});

	$(document).on('change', "input[name='birth_zip_code']", function() {
		$(".birth_city").show();
		// $(".birth_state").show();
		var pincode = $(this).val();
		var _token = "{{ csrf_token() }}";
		var url = "<?= url('/'); ?>/get_street_info";
		$.ajax({
			url: url,
			data: {
				pincode: pincode,
				_token: _token
			},
			type: "POST",
			success: function(resp) {
				resp = JSON.parse(resp);
				$("input[name='birth_city']").val(resp.city);
				$("input[name='birth_address']").val(resp.street);
			}
		});


	});



	$(document).on('change', '#billing_zip_code', function() {
		var pincode = $(this).val();
		var _token = "{{ csrf_token() }}";
		var url = "<?= url('/'); ?>/get_street_info";
		$.ajax({
			url: url,
			data: {
				pincode: pincode,
				_token: _token
			},
			type: "POST",
			success: function(resp) {
				resp = JSON.parse(resp);
				$("input[name='billing_city']").val(resp.city);
				$("input[name='billing_address']").val(resp.street);
				console.log(resp);

			}
		});


	});

	$("#affiliate_code").change(function() {
		varr = $(this).val();
		// alert(varr);
		var url = "<?php echo url('/'); ?>/adcodeavailability";
		$.ajax({
			url: url,
			data: 'code=' + varr + '&_token={{ csrf_token() }}',
			type: "POST",
			success: function(response) {
				// alert(response);
				if (response == "exists") {
					$("#codeexitstance").html("");
				} else if (response == "expired") {
					$("#codeexitstance").html("The code has been expired!!!");
					$("#affiliate_code").val("");
				} else if (response == "fail") {
					$("#codeexitstance").html("The code does not exists!!!");
					$("#affiliate_code").val("");
				} else {
					$("#codeexitstance").html("Validation start date for this code is " + response);
					$("#affiliate_code").val("");
				}
			}
		});
	});
	$("#affiliateemail").change(function() {
		varr = $(this).val();
		$("#emailexitstance").hide();
		// alert(varr);
		var url = "<?php echo url('/'); ?>/ademailavailability";
		$.ajax({
			url: url,
			data: 'email=' + varr + '&_token={{ csrf_token() }}',
			type: "POST",
			success: function(response) {
				// alert(response);
				if (response == "success") {
					$("#emailexitstance").show();
					$("#emailexitstance").html("The email already exists!!!");
					$("#affiliateemail").val("");
				}
			}
		});
	});

	$(function() {
		var dtToday = new Date();

		var month = dtToday.getMonth() + 1;
		var day = dtToday.getDate();
		var year = dtToday.getFullYear();
		if (month < 10)
			month = '0' + month.toString();
		if (day < 10)
			day = '0' + day.toString();

		var maxDate = year + '-' + month + '-' + day;
		// alert(maxDate);

		// $('#sendon').attr('min', maxDate);
	});
	$("#sendon").on("change", function() {
		this.setAttribute(
			"data-date",
			moment(this.value, "YYYY-MM-DD")
			.format(this.getAttribute("data-date-format"))
		)
	}).trigger("change");
</script>

<script>
	$(document).on("change", "#countries_states1", function() {
		haiti = $("#countries_states1").val();
		$(".country_message").hide();
		// alert(haiti);
		if (haiti == "HT") {
			$(".comm").show();
			$(".dep").show();
			$(".arr").show();
			$(".zip_code").hide();
			$(".select_state").hide();

		} else if (haiti == "US" || haiti == "CA") {
			$(".zip_code").show();
			$(".select_state").show();
			$(".comm").hide();
			$(".dep").hide();
			$(".arr").hide();
		} else {
			$(".select_state").show();
			$(".zip_code").hide();
			$(".comm").hide();
			$(".dep").hide();
			$(".arr").hide();
		}
	})


	$(document).on("change", "#birth_countries_states1", function() {
		haiti = $("#birth_countries_states1").val();
		$(".birth_country_message").hide();
		if (haiti == "HT") {
			$(".birth_comm").show();
			$(".birth_state").hide();
		} else {
			$(".birth_state").show();
			$(".birth_comm").hide();
		}
	})
</script>


<script>
	$(document).on("focus", "input, select", function() {
		if ($('#birth_countries_states1').val() == "") {
			$(".birth_country_message").show();
			$(".birth_country_message").focus();
			$('#birth_countries_states1').focus();
			return false;
		}

		if ($('#birth_countries_states1').val() != "" && $('#birth_countries_states1').val() != "HT") {
			if ($('.birth-state-focus').val() == "") {
				$(".birth_state_message").show();
				$(".birth_state_message").focus();
				$('.birth-state-focus').focus();
				return false;
			}
		}
		if ($('#birth_countries_states1').val() != "" && $('#birth_countries_states1').val() == "HT") {
			if ($('#birth_commune').val() == "") {
				$(".birth_commune_message").show();
				$(".birth_commune_message").focus();
				$('#birth_commune').focus();
				return false;
			}
		}
		if ($('#countries_states1').val() != "" && $('#countries_states1').val() != "HT") {
			if ($('.state-focus').val() == "") {
				$(".state_message").show();
				$(".state_message").focus();
				$('.state-focus').focus();
				return false;
			}
		}
		if ($('#countries_states1').val() != "" && $('#countries_states1').val() == "HT") {
			if ($('#commune').val() == "") {
				$(".commune_message").show();
				$(".commune_message").focus();
				$('#commune').focus();
				return false;
			}
		}
	});

	$(".birth-state-focus").on("change", function() {
		$(".birth_state_message").hide();
	}).trigger("change");

	$(".state-focus").on("change", function() {
		$(".state_message").hide();
	}).trigger("change");
</script>


<script>
	$(document).on("change", "#department", function() {
		dep = $("#department").val();
		// alert(dep);
		var url = "<?= url('/'); ?>/select_arr";

		if (haiti == "HT" && commune != "" && dep != "") {
			$.ajax({
				url: url,
				data: 'dep=' + dep,
				type: "GET",
				success: function(data) {
					$("#arro").html(data);
				}
			})
		}

	})
</script>


<script>
	$(document).on("change", "#birth_department", function() {
		dep = $("#birth_department").val();
		// alert(dep);
		var url = "<?= url('/'); ?>/select_arr";

		if (haiti == "HT" && commune != "" && dep != "") {
			$.ajax({
				url: url,
				data: 'dep=' + dep,
				type: "GET",
				success: function(data) {
					$("#birth_arro").html(data);
				}
			})
		}

	})
</script>


<script>
$(document).on("change", "#countries_states1", function() {
		commune = $(this).val();
		haiti = $(this).val();
		$(".country_message_2").hide();
		var url = "<?= url('/'); ?>/verify_country_code";
			$.ajax({
				url: url,
				data: 'code=' + commune,
				type: "GET",
				success: function(data) {
    				    if(data.status == 2){
    				        $(".country_message_2").show();
    				        $(".country_message_2").html(data.msg);
    				    }
				
				}
			})
		
	})
	$(document).on("change", "#commune", function() {
		commune = $("#commune").val();
		haiti = $("#countries_states1").val();
		$(".commune_message").hide();
		var url = "<?= url('/'); ?>/select_department";

		if (haiti == "HT" && commune != "") {
			$.ajax({
				url: url,
				data: 'haiti=' + haiti,
				type: "GET",
				success: function(data) {
					$("#department").html(data);
				}
			})
		}
	})

	$(document).on("change", "#birth_commune", function() {
		commune = $("#birth_commune").val();
		haiti = $("#birth_countries_states1").val();
		$(".birth_commune_message").hide();
		var url = "<?= url('/'); ?>/select_department";

		if (haiti == "HT" && commune != "") {
			$.ajax({
				url: url,
				data: 'haiti=' + haiti,
				type: "GET",
				success: function(data) {
					$("#birth_department").html(data);
				}
			})
		}
	})
</script>
<script>
	$(document).on("change", "#otherreligion", function() {
		// alert("ok");
		otherreligion = $("#otherreligion").val();
		if (otherreligion == "Other") {

			$("#relother").show();

		} else {
			$("#relother").hide();
			$("#religionother").val("");

		}
	})
</script>

<script>
	$(document).on("change", "#businesscat", function() {
		// alert("ok");
		businesscat = $("#businesscat").val();
		if (businesscat == 13) {

			$("#otherbusiness").show();

		} else {
			$("#otherbusiness").hide();
			$("#businessother").val("");

		}
	})
</script>

<script>
	$(document).on("change", "#dob_day, #dob_month, #dob_year", function() {
		var dtToday = new Date();

		var dobDay = $('#dob_day').val();
		var dobMonth = $('#dob_month').val();
		var dobYear = $('#dob_year').val();

		if (dobDay == "0") {
			dobDay = dtToday.getDate();
		} else if (dobDay < 10) {
			dobDay = "0" + dobDay;
		}

		if (dobMonth == "0") {
			dobMonth = dtToday.getMonth() + 1;
		}

		if (dobYear == "0") {
			dobYear = dtToday.getFullYear();
		}

		$('#sendon').val(dobYear + "-" + dobMonth + "-" + dobDay);
	})
</script>
<script>
       const phoneInputField = document.querySelector("#cellphone");
       const phoneInput = window.intlTelInput(phoneInputField, {
         utilsScript:
           "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
       });
       const getPhoneNo = () => {
        const phoneNumber = phoneInput.getNumber()
		if(phoneNumber.includes('+')) {
			const cellphoneInp = document.getElementById('cellphone-inp')
			cellphoneInp.value = phoneNumber
			console.log(phoneNumber)
			cellPhoneToast.style.display = 'none'
		} else {
			// if liberary not loaded 
			const cellphoneInp = document.getElementById('cellphone-inp')
			cellphoneInp.value = phoneInputField.value
			// 
			let cellPhoneToast = document.getElementById('cellPhoneToast')
			cellPhoneToast.style.display = 'block'
		}
       }
       const businessPhoneInputField = document.querySelector("#business_telephone");
       const businessPhoneInput = window.intlTelInput(businessPhoneInputField, {
         utilsScript:
           "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
       });
       const getBusinessPhoneNo = () => {
        const businessPhoneNumber = businessPhoneInput.getNumber()
        if(businessPhoneNumber.includes('+')) {
			const businessPhoneInp = document.getElementById('business_telephone_inp')
			businessPhoneInp.value = businessPhoneNumber
			businessPhoneToast.style.display = 'none'
		} else {
			// if liberary not loaded
			const businessPhoneInp = document.getElementById('business_telephone_inp')
			businessPhoneInp.value = businessPhoneInputField.value

			let businessPhoneToast = document.getElementById('businessPhoneToast')
			businessPhoneToast.style.display = 'block'
		}
       }
          const onBirthCommuneChange = () => {
        const birthState = document.getElementById('birth_state')
        const birthCommune = document.getElementById('birth_commune')
        birthState.value = 'OU'
        // birthCommune.value
      }
      const onCommuneChange = () => {
        const state = document.getElementById('state')
        const commune = document.getElementById('commune')
        state.value = 'OU'
        // commune.value
        console.log(state)
        console.log(commune)
      }
</script>
@endsection