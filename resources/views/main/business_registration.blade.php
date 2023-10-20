@extends('layouts.main') 
@section('content')

 <style>
.pricingTable {
    text-align: center;
    background: #fff;
    margin: 0 -15px;
    box-shadow: 0 0 10px #ababab;
    padding-bottom: 40px;
    border-radius: 10px;
    color: #cad0de;
    transform: scale(1);
    transition: all .5s ease 0s;
    cursor: pointer;
}

.pricingTable:hover {
    transform: scale(1.05);
    z-index: 1
}

.pricingTable .pricingTable-header {
    padding: 40px 0;
    background: #f5f6f9;
    border-radius: 10px 10px 50% 50%;
    transition: all .5s ease 0s
}

.pricingTable:hover .pricingTable-header {
    background: #ff9624
}

.pricingTable .pricingTable-header i {
    font-size: 50px;
    color: #858c9a;
    margin-bottom: 10px;
    transition: all .5s ease 0s
}

.pricingTable .price-value {
    font-size: 35px;
    color: #ff9624;
    transition: all .5s ease 0s
}

.pricingTable .month {
    display: block;
    font-size: 14px;
    color: #cad0de
}

.pricingTable:hover .month,
.pricingTable:hover .price-value,
.pricingTable:hover .pricingTable-header i {
    color: #fff
}

.pricingTable .heading {
    font-size: 24px;
    color: #ff9624;
    margin-bottom: 20px;
    text-transform: uppercase
}

.pricingTable .pricing-content ul {
    list-style: none;
    padding: 0;
    margin-bottom: 30px
}

.pricingTable .pricing-content ul li {
    line-height: 30px;
    color: #a7a8aa
}

.pricingTable .pricingTable-signup a {
    display: inline-block;
    font-size: 15px;
    color: #fff;
    padding: 10px 35px;
    border-radius: 20px;
    background: #ffa442;
    text-transform: uppercase;
    transition: all .3s ease 0s
}

.pricingTable .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #ffa442
}

.pricingTable.blue .heading,
.pricingTable.blue .price-value {
    color: #4b64ff
}

.pricingTable.blue .pricingTable-signup a,
.pricingTable.blue:hover .pricingTable-header {
    background: #4b64ff
}

.pricingTable.blue .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #4b64ff
}

.pricingTable.red .heading,
.pricingTable.red .price-value {
    color: #ff4b4b
}

.pricingTable.red .pricingTable-signup a,
.pricingTable.red:hover .pricingTable-header {
    background: #ff4b4b
}

.pricingTable.red .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #ff4b4b
}

.pricingTable.green .heading,
.pricingTable.green .price-value {
    color: #40c952
}

.pricingTable.green .pricingTable-signup a,
.pricingTable.green:hover .pricingTable-header {
    background: #40c952
}

.pricingTable.green .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #40c952
}

.pricingTable.blue:hover .price-value,
.pricingTable.green:hover .price-value,
.pricingTable.red:hover .price-value {
    color: #fff
}

@media screen and (max-width:990px) {
    .pricingTable {
        margin: 0 0 20px
    }
}
.white-mode {
    text-decoration: none;
    padding: 17px 40px;
    background-color: yellow;
    border-radius: 3px;
    color: black;
    transition: .35s ease-in-out;
    position: absolute;
    left: 15px;
    bottom: 15px
}
.active_plan{
	border: 2px solid blue;

}
</style>

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <form  name="business_register" id="manageBRegister" method="POST"  enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="role" value="free_affiliate"/>
                        <div class="" style="padding-bottom: 20px;">
                            <div class="col-md-12 text-right">
                                <a href="{{ url('/') }}" class="btn btn-md btn-info">Back</a>
                            </div>
                            <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Business Registration</h4>
                            </div>
                            	 <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Choose Package</h4>
      </div>

        <div class="row">
        @if(!empty($plans))
        @php
          $i=1;

        @endphp
		 @foreach($plans as $plan)
		 <?php
		  $class='';
		  $icon='';
		   if($i==1)
		   {
		   	 $class='';
		   	 $icon='fa-adjust';
		   }elseif($i==2){
             $class='green';
             $icon='fa-briefcase';
		   }elseif($i==3){
             $class='blue';
             $icon='fa-diamond';
		   }elseif($i==4){
             $class='red';
             $icon='fa-cube';
		   }
		   ?>
            <div class="col-md-{{ $grid }} col-md-offset-{{ $offset }} ">


                <div class="pricingTable {{ $class }} selectedplan" data-id="{{ $plan->id }}" data-fees="{{ $plan->monthly_fee }}" style="width: 35rem; height: 35rem; margin-top: 10px;">
                    <div class="pricingTable-header">
                        <i class="fa {{ $icon }}"></i>
                        <div class="price-value"> ${{ $plan->monthly_fee }} <span class="month">per month</span> </div>
                    </div>
                    <br>
                    <h3 class="heading">{{ $plan->name }}</h3>
                    <div class="pricing-content">
                        <ul>
                            <li></li>
                            <!--<li><b>50GB</b> Disk Space</li>-->

                        </ul>
                    </div>
                    <div class="pricingTable-signup">

                    </div>
                </div>

            </div>
             @php
              $i++;
            @endphp
          @endforeach
		@endif

        </div>	<input type="hidden" id="plan_id" name="plan_id" value="">
        	<input type="hidden" id="fees" name="fees" value="0">


								<div class="row" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; padding-bottom:20px;">
										<div class="col-md-12 text-center heading-title margin-top-20">
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
										







										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Country Of Birth</label>
												<select id="birth_countries_states1" class="form-control bfh-countries" name="birth_country" required></select>
												<span class="text-danger birth_country_message" style="display:none">Before going to the next step select Country of birth first</span>
											</div>
										</div>

										<div style="width: 35rem" class="col-md-4 birth_comm" style="display:none">
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

										<div style="width: 35rem" class="col-md-4 birth_state" style="display:none">
											<div class="form-group">
												<label class="form-label" for="">Birth State/Province/Commune</label>
												<select id="birth_state" class="form-control bfh-states birth-state-focus" data-country="birth_countries_states1" name="birth_state" required></select>
												<span class="text-danger birth_state_message" style="display:none">Before going to the next field select State/Province first</span>
											</div>
										</div>










										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label">First Name</label>
												<input type="text" class="form-control"  placeholder="Profile First Name" name="first_name" required value="{{old('first_name')}}" required>
											</div>
										</div>
										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label">Last Name</label>
												<input type="text" class="form-control" placeholder="Profile Last Name" name="last_name" value="{{old('last_name')}}" required>
											</div>
										</div>
									
									<!---->
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

							<!---->

										<div style="width: 35rem" class="col-md-4">
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

										<div style="width: 35rem" class="col-md-4" id="relother" style="display:none">
											<div class="form-group"> 
												<label class="form-label" for="">Religious Faith/ Spirituality</label>
												<input type="text" class="form-control" name="religionother" id="religionother" placeholder="Enter your Religion">	
											</div>
										</div>
										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label">Email</label>
												<input type="text" class="form-control"  placeholder="Profile Email" name="email" id="affiliateemail" required value="{{old('email')}}">
												<span style="color: red" id="emailexitstance"></span>
											</div>
										</div>


										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label">Date Of Birth</label>
											
												<input type="hidden" name="dob" class="form-control"  data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" id="sendon" value="{{old('dob')}}">
                                                <select id="dob_day" name="day" class="bg-white width-100" required>
                                                    <option value="0">Day</option>
                                                    @for($i=01; $i<=31; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
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
                                                    $year_start  = 1940;
                                                    $year_end = date('Y') - 19; // current Year
                                                @endphp
                                                
                                                <select id="dob_year" name="year" class="bg-white width-100" required>
                                                    <option value="0">Year</option>
                                                    @for($i=$year_start; $i<=$year_end; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>

												
											</div>
										</div>
										


										
										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Country Of Residence</label>
												<select id="countries_states1" class="form-control bfh-countries" name="country" required></select>
												<span class="text-danger country_message" style="display:none">Before going to the next step select Country of residence first</span>
											</div>
										</div>

										<div style="width: 35rem" class="col-md-4 select_state" style="display:none">
											<div class="form-group">
												<label class="form-label" for="">State/Province/Commune</label>
												<select id="state" class="form-control bfh-states state-focus" data-country="countries_states1" name="state" required></select>
												<span class="text-danger state_message" style="display:none">Before going to the next field select State/Province first</span>
											</div>
										</div>
										
										<div style="width: 35rem" class="col-md-4 comm" style="display:none">
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

										<div style="width: 35rem" class="col-md-4 zip_code" style="display:none">
											<div class="form-group">
												<label class="form-label" for="">Zip Code</label>
												<input class="form-control"  placeholder="" name="zip_code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"  maxlength = "6" value="{{old('zip_code')}}" required>
											</div>
										</div>
										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Street Address</label>
												<input type="text" class="form-control"  placeholder="" name="address" value="{{old('address')}}"  required>
											</div>
										</div>
										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> City </label>
												<input type="text" class="form-control"  placeholder="" name="city" value="{{old('city')}}" required>
											</div>
										</div>
										
										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Choose a Business Category</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" id="businesscat" tabindex="-1" aria-hidden="true" data-select2-id="1" name="business_category" required>
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
										<div style="width: 35rem" class="col-md-4" id="otherbusiness" style="display:none">
											<div class="form-group"> 
												<label class="form-label" for="">Other Business</label>
												<input type="text" id="businessother" name="businessother" class="form-control" placeholder="Enter your other business">	
											</div>
										</div>

										
                                       	<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> Business Category (Type)</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="lead_category" required>
												    
		                                        @foreach($lead_cats as $value) 
		                                           
		                                              <option value="{{ $value->id }}">{{$value->category}} </option>
		                                           @endforeach
												  
												</select>
											</div>
										</div>
										

										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Upload Picture</label>
		                                        <div class="fancy-file-upload fancy-file-info">
		                                            <i class="fa fa-upload"></i>
		                                            <input type="file" class="form-control" name="image" onchange="jQuery(this).next('input').val(this.value);" />
		                                            <input type="text" class="form-control" placeholder="no file selected" readonly="" />
		                                            <span class="button">Choose File</span>
		                                        </div>
											</div>
										</div>
										
										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label">Password</label>
												<input type="password" class="form-control"  placeholder="Password" id="mypass" name="password" autocomplete="off" value="{{old('password')}}" required>
											</div>
												@if ($errors->has('password'))
			                                    <span class="help-block text-danger">
			                                        <strong>{{ $errors->first('password') }}</strong>
			                                    </span>
			                                @endif
										</div>
										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label">Confirm Password</label>
												<input type="password" class="form-control"  placeholder="Confirm assword" name="confirm_password" id="confirm_password" autocomplete="off" required>
											</div>
											<span class="cpass"></span>
											 @if ($errors->has('confirm_password'))
			                                    <span class="help-block text-danger">
			                                        <strong>{{ $errors->first('confirm_password') }}</strong>
			                                    </span>
			                                @endif
										</div>
										<div style="width: 35rem" class="col-md-4">
											<div class="form-group">
												<label class="form-label">Company Name</label>
												<input type="text" class="form-control"  placeholder="Company Name" name="company" autocomplete="off" required>
											</div>
										</div>
									</div>
									<!--<div class="clearfix"></div>	-->
									<!--<div class="divider"><!-- divider --></div>	
									<!-- <div class="row gy-4" style="padding-bottom:20px;">
										
										<div class="col-md-12 text-center" style="margin-top:20px;">
											<h6>Billing Information</h6>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Street Address</label>
												<input type="text" class="form-control"  placeholder="" name="billing_address" value="{{old('billing_address')}}" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Zip Code</label>
												<input class="form-control"  placeholder="" id="billing_zip_code" name="billing_zip_code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "6" required value="{{old('billing_zip_code')}}">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> City </label>
												<input type="text" class="form-control"  placeholder="" name="billing_city" required value="{{old('billing_city')}}">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Country</label>
												<select id="countries_states2" class="form-control bfh-countries" name="billing_country" required ></select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">State/Province</label>
												<select class="form-control bfh-states" data-country="countries_states2" name="billing_state" required></select>
											</div>
										</div>
										
										   
									</div> -->
									
									<div class="col-md-12" style="margin-top:20px; ">
										 <h4 >
                                        <label class="checkbox chk-sm" style="color: #da291c;">
                                            <input type="checkbox"  name="terms" value="1"  required="" />
                                            <i></i> Agree <a href="javascript:void(0)"  data-toggle="modal" data-target="#termData">terms and conditions</a>
                                        </label>
                                    </h4>
									</div>
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="button" data-action="{{ url('free_affiliate_entry') }}" class="btn btn-lg btn-primary btn_submit" value="Register">
									</div>
                        </div>
                    </form>
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


$(document).on('click', '.btn_submit', function(e)
{

    if ($('#countries_states1').val() == "")
    {
        $(".country_message").show();
        $(".country_message").focus();
        $('#countries_states1').focus();
        return false;
    }
     e.preventDefault();
      swal({
        title: 'Confirm Business Category',
        text: "This is an opportunity to verify and confirm the information you entered. If any information is not correct, click on the “Edit” button to change it NOW. Note: Most information cannot be changed later.",
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
    }).then((result) =>
    {
        if(result.value)
        {
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
           var action=$(this).attr("data-action");
           var form=$("#manageBRegister");
            form.attr('action', action);
            form.submit();
             $(".submit-loading").remove();
            $elm.show();


        }
    })

});


$(document).on('click','.selectedplan',function(e){
   e.preventDefault();
   $(".selectedplan").removeClass('active_plan');
   $(this).addClass('active_plan');
    var plan_id = $(this).attr("data-id");
   var fees = $(this).attr("data-fees");
  $("#plan_id").val(plan_id);
  $("#fees").val(fees);

});

$(document).on('blur','#confirm_password',function() {
	var password=$("#mypass").val();
	var confirm_password=$(this).val();	
	//alert(password+'='+confirm_password);
	if(confirm_password == password){
		
		$(".cpass").text('Password and confirm matches.');
		$(".cpass").css('color','green');
	}else{
		$(".cpass").text('Password and confirm password does not match');
		$(".cpass").css('color','red');
	}
});

   $(document).on('change',"input[name='zip_code']",function(){
   	var pincode=$(this).val();
   	 var _token="{{ csrf_token() }}";
   	 var url = "<?=url('/');?>/get_street_info";
        $.ajax({
              url: url,
              data:{pincode:pincode,_token:_token},
              type: "POST",
            success: function (resp) {
            	 resp=JSON.parse(resp);
             $("input[name='city']").val(resp.city);	 
             $("input[name='address']").val(resp.street);	 
              console.log(resp);
               
            }
        });


     });

   $(document).on('change',"input[name='birth_zip_code']",function(){
			$(".birth_city").show();
			// $(".birth_state").show();
   	var pincode=$(this).val();
   	 var _token="{{ csrf_token() }}";
   	 var url = "<?=url('/');?>/get_street_info";
        $.ajax({
              url: url,
              data:{pincode:pincode,_token:_token},
              type: "POST",
            success: function (resp) {
            	 resp=JSON.parse(resp);
             $("input[name='birth_city']").val(resp.city);	 
             $("input[name='birth_address']").val(resp.street);	 
            }
        });


     });

   $(document).on('change','#billing_zip_code',function(){
   	var pincode=$(this).val();
   	 var _token="{{ csrf_token() }}";
   	 var url = "<?=url('/');?>/get_street_info";
        $.ajax({
              url: url,
              data:{pincode:pincode,_token:_token},
              type: "POST",
            success: function (resp) {
            	 resp=JSON.parse(resp);
             $("input[name='billing_city']").val(resp.city);	 
             $("input[name='billing_address']").val(resp.street);	 
              console.log(resp);
               
            }
        });


     });
	
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
                if(response == "success") {
                	$("#emailexitstance").show();
                	$("#emailexitstance").html("The email already exists!!!");
                	$("#affiliateemail").val("");
                }
            }
        });
    });
</script>
<script>
	$(document).on("change","#countries_states1",function(){
		haiti=$("#countries_states1").val();
        $(".country_message").hide();
		// alert(haiti);
		if(haiti=="HT"){
			$(".comm").show();
			$(".dep").show();
			$(".arr").show();
			$(".select_state").hide();
			$(".zip_code").hide();

        }else if(haiti=="US" || haiti=="CA"){
			$(".zip_code").show();
			$(".select_state").show();
			$(".comm").hide();
			$(".dep").hide();
			$(".arr").hide();
		}else{
			$(".zip_code").hide();
			$(".select_state").show();
			$(".comm").hide();
			$(".dep").hide();
			$(".arr").hide();
		}
	})

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

<script>
    $(document).on("focus", "input, select", function()
    { 

        if ($('#birth_countries_states1').val() == "")
        {
            $(".birth_country_message").show();
            $(".birth_country_message").focus();
            $('#birth_countries_states1').focus();
            return false;
        }

        if($('#birth_countries_states1').val() != "" && $('#birth_countries_states1').val() != "HT")
        {
            if ($('.birth-state-focus').val() == "")
            {
                $(".birth_state_message").show();
                $(".birth_state_message").focus();
                $('.birth-state-focus').focus();
                return false;
            }
        }
        if($('#birth_countries_states1').val() != "" && $('#birth_countries_states1').val() == "HT")
        {
            if ($('#birth_commune').val() == "")
            {
                $(".birth_commune_message").show();
                $(".birth_commune_message").focus();
                $('#birth_commune').focus();
                return false;
            }
        }
        if($('#countries_states1').val() != "" && $('#countries_states1').val() != "HT")
        {
            if ($('.state-focus').val() == "")
            {
                $(".state_message").show();
                $(".state_message").focus();
                $('.state-focus').focus();
                return false;
            }
        }
        if($('#countries_states1').val() != "" && $('#countries_states1').val() == "HT")
        {
            if ($('#commune').val() == "")
            {
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
	$(document).on("change","#department",function(){
		dep=$("#department").val();
		// alert(dep);
		var url = "<?=url('/');?>/select_arr";

		if(haiti=="HT" && commune!="" && dep!=""){
		$.ajax({
			url: url,
         	data: 'dep=' + dep,
         	type: "GET",
			success:function(data){
				$("#arro").html(data);
			}
		})
		}	
		
	})
</script>

<script>
	$(document).on("change","#birth_department",function(){
		dep=$("#birth_department").val();
		// alert(dep);
		var url = "<?=url('/');?>/select_arr";

		if(haiti=="HT" && commune!="" && dep!=""){
		$.ajax({
			url: url,
         	data: 'dep=' + dep,
         	type: "GET",
			success:function(data){
				$("#birth_arro").html(data);
			}
		})
		}	
		
	})
</script>


<script>
	$(document).on("change","#commune",function(){
		commune=$("#commune").val();
		haiti=$("#countries_states1").val();
		var url = "<?=url('/');?>/select_department";
		$(".commune_message").hide();

		if(haiti=="HT" && commune!=""){
		$.ajax({
			url: url,
         	data: 'haiti=' + haiti,
         	type: "GET",
			success:function(data){
				$("#department").html(data);
			}
		})
		}	
	})

	$(document).on("change","#birth_commune",function(){
		commune=$("#birth_commune").val();
		haiti=$("#birth_countries_states1").val();
		$(".birth_commune_message").hide();
		var url = "<?=url('/');?>/select_department";

		if(haiti=="HT" && commune!=""){
		$.ajax({
			url: url,
         	data: 'haiti=' + haiti,
         	type: "GET",
			success:function(data){
				$("#birth_department").html(data);
			}
		})
		}	
	})
</script>

<script>
	$(document).on("change","#otherreligion",function(){
		// alert("ok");
		otherreligion=$("#otherreligion").val();
		if(otherreligion=="Other"){

			$("#relother").show();

		}else{
			$("#relother").hide();
			$("#religionother").val("");

		}
	})
</script>

<script>
	$(document).on("change","#businesscat",function(){
		// alert("ok");
		businesscat=$("#businesscat").val();
		if(businesscat==13){

			$("#otherbusiness").show();

		}else{
			$("#otherbusiness").hide();
			$("#businessother").val("");

		}
	})



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
   
       // $('#sendon').attr('min', maxDate);
    });
    $("#sendon").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change");

	$(document).on("change","#dob_day, #dob_month, #dob_year",function(){
        var dtToday = new Date();

	    var dobDay = $('#dob_day').val();
	    var dobMonth = $('#dob_month').val();
	    var dobYear = $('#dob_year').val();

	    if(dobDay == "0"){
            dobDay = dtToday.getDate();
	    }else if(dobDay < 10){
            dobDay = "0" + dobDay;	        
	    }
	    
	    if(dobMonth == "0"){
            dobMonth = dtToday.getMonth() + 1;
	    }
	    
	    if(dobYear == "0"){
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