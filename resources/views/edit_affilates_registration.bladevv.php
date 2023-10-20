@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Affiliates Registration</h3>
						<a href="{{ url('admin/affilates_registration') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('affiliate_update') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									<div class="row gy-4" style="padding-bottom:20px;">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Affiliate Code</label>
												<input type="text" class="form-control"  placeholder="Affilate Code" name="code" id="affiliate_code" value="<?= $details[0]->code ?>" >
												<span style="color: red;" id="codeexitstance"></span>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>	
									<div class="divider"><!-- divider --></div>	
									<div class="row gy-4" style="padding-bottom:20px;">
										<div class="col-md-12 text-center">
											<h6>Profile Information</h6>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Joining Date</label>
												<input type="text" class="form-control date-picker"  placeholder="Joining Date" name="joining_date" value="<?= $details[0]->joining_date ?>" autocomplete="off" required>
											</div>
										</div>






										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Country Of Birth</label>
												<select id="birth_countries_states1" class="form-control bfh-countries" data-country="<?= $details[0]->birth_country ?>" name="birth_country" required></select>
												<span class="text-danger birth_country_message" style="display:none">Before going to the next step select Country of birth first</span>
											</div>
										</div>

										<div class="col-md-4 birth_comm" @if($details[0]->birth_country != "HT") style="display:none" @endif>
											<div class="form-group">
												<label class="form-label" for="">Commune</label>
												<select id="birth_commune" class="form-control bfh-commune" name="birth_commune" required>
													<option value="{{(isset($details[0]->birth_commune)) ? $details[0]->birth_commune : ''}}">{{(isset($details[0]->birth_commune)) ? showcommuneName($details[0]->birth_commune) : ''}}</option>
													@foreach($communes as $commune)
													<option value="{{ $commune->id }}">{{ $commune->commune }}</option>
													@endforeach
												</select>
												<span class="text-danger birth_commune_message" style="display:none">Before going to the next field select Commune first</span>
											</div>
										</div>

										<div class="col-md-4 birth_state" @if($details[0]->birth_country == "HT") style="display:none" @endif>
											<div class="form-group">
												<label class="form-label" for="">State/Province</label>
												<select class="form-control bfh-states birth-state-focus" data-state="<?= $details[0]->birth_state ?>" data-country="birth_countries_states1" name="birth_state" ></select>
												<span class="text-danger birth_state_message" style="display:none">Before going to the next field select State/Province first</span>
											</div>
										</div>


										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">First Name</label>
												<input type="text" class="form-control" value="<?= $details[0]->first_name ?>"  placeholder="Profile First Name" name="first_name" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Last Name</label>
												<input type="text" class="form-control" value="<?= $details[0]->last_name ?>" placeholder="Profile Last Name" name="last_name" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Religious Faith/ Spirituality </label>
												<select class="form-control" name="religion" required>
													<?php
		                                                foreach ($religion as $value) {
		                                            ?>
		                                                    <option <?php if ($details[0]->religion == $value->religion) { ?> selected <?php } ?> value="<?= $value->religion ?>"><?= $value->religion ?></option>
		                                            <?php
		                                                }
		                                            ?>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Email</label>
												<input type="email" class="form-control"  placeholder="Profile Email" value="<?= $details[0]->email ?>" required>
												<input type="hidden" name="email" value="<?= $details[0]->email ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Cell Phone</label>
												<input class="form-control"  placeholder="" name="cellphone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "tel" maxlength = "10" value="<?= $details[0]->cellphone ?>" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Business Telephone</label>
												<input type="tel" class="form-control"  placeholder="" name="business_telephone" value="<?= $details[0]->business_telephone ?>" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Choose a Profession/Study</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="business_category" required>
												  	<?php
		                                                foreach ($business_category as $value) {
		                                            ?>
		                                                    <option <?php if ($details[0]->business_category == $value->id) { ?> selected <?php } ?> value="<?= $value->id ?>"><?= $value->category ?></option>
		                                            <?php
		                                                }
		                                            ?>
												  
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Upload Your Picture</label>
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="customFile" name="image">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Street Address</label>
												<input type="text" class="form-control"  placeholder="" value="<?= $details[0]->address ?>" name="address"  required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Zip Code</label>
												<input class="form-control"  placeholder="" name="zip_code" value="<?= $details[0]->zip_code ?>" 
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "6" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> City </label>
												<input type="text" class="form-control"  placeholder="" name="city" value="<?= $details[0]->city ?>" required>
											</div>
										</div>
										
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Country Of Residense</label>
												<select id="countries_states1" class="form-control bfh-countries" data-country="<?= $details[0]->country ?>" name="country" required></select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">State/Province</label>
												<select class="form-control bfh-states" data-state="<?= $details[0]->state ?>" data-country="countries_states1" name="state" ></select>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>	
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="submit" class="btn btn-lg btn-primary" value="Update">
									</div>
								</form>
								<?php 
								if(session()->has('success')){
								?>
								<script type="text/javascript">
								$(function(){
								swal({
									title: 'Success',
									text: "User's information successfully updated",
									type: 'success',
									showConfirmButton: false,
									showCancelButton: true,
									cancelButtonColor: '#d33',
									cancelButtonText: ' Ok',
								})
							})
							</script>
								<?php 
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#affiliate_code").change(function(){
        varr = $(this).val();
        // alert(varr);
        var url = "<?php echo url('/'); ?>/codeavailability";
        $.ajax({
              url: url,
              data: 'code=' + varr + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                if (response == "expired") {
                	$("#codeexitstance").html("The code has been expired!!!");
                	$("#affiliate_code").val("");
                }
                else if(response == "fail") {
                	$("#codeexitstance").html("The code does not exists!!!");
                	$("#affiliate_code").val("");
                }
            }
        });
    });


	$(document).on("change","#birth_countries_states1",function(){
		haiti=$("#birth_countries_states1").val();
		$(".birth_country_message").hide();
		if(haiti=="HT"){
			$(".birth_comm").show();
			$(".birth_state").hide();
		}
		else{
			$(".birth_state").show();
			$(".birth_comm").hide();
		}
	})

</script>
@endsection