@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <!-- tabs content -->
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                            <h4>Client Management / Add Client</h4>
                        </div>
                        <div class="col-md-12 text-right margin-bottom-10">
                            <a href="#" class="btn btn-md btn-info margin-right-10">View Offers</a>
                            <a href="#" class="btn btn-md btn-info margin-right-10">My Faith</a>
                            <a href="{{ url('birthplace') }}" class="btn btn-md btn-info margin-right-10">My Birth Place</a>
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
                        <!--<ul class="nav nav-tabs nav-button-tabs nav-justified" style="padding:10px;">
                                            <li class="active"><a href="profile_info.php">Profile</a></li>
                                            <li><a href="task.php">Task</a></li>
                                            
                                        
                                            
                                        </ul>-->
                        <form action="{{ url('addclient_appointment') }}" method="POST" id=""
                            enctype="multipart/form-data" autocomplete="off">@csrf
                           <!--for border-->
                            <div class="col-md-12"
                                style="border: 1px solid #da291c !important; border-radius: 10px; padding-top: 30px; padding-bottom: 20px;" >
                                    <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">
                                        <div>
                                            <img src="{{ asset('public/images/upload.png') }}"
                                                style="width: 100px; height: 100px; margin: 0 auto; " id="blah">
                                        </div>
                                        <div>
                                            <input type="file" name="image" class="form-control"
                                                style="margin-top: 10px" id="imgInp">
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                               <div style=" display: flex; flex-direction: row; flex-wrap: wrap;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" placeholder="Email Address" required
                                            name="email" id="affiliateemail" />
                                        <span style="color: red" id="emailexitstance"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">Country Of Birth</label>
                                        <select id="birth_countries_states1" class="form-control bfh-countries" data-country="US"
                                            name="birth_country" required></select>
                                        <span class="text-danger birth_country_message" style="display:none">Before going to
                                            the next step select Country of birth first</span>
                                    </div>
                                </div>

                                <div class="col-md-4 birth_comm" style="display:none">
                                    <div class="form-group">
                                        <label class="form-label" for="">Birth State/Province/Commune</label>
                                        <select id="birth_commune" onchange="onCommuneChange()" class="form-control bfh-commune" name="birth_commune"
                                            >
                                            <option value=""></option>
                                            @foreach ($communes as $commune)
                                                <option value="{{ $commune->id }}">{{ $commune->commune }}</option>
                                            @endforeach
                                        </select>
                                        <span id="birth_commune_message" class="text-danger birth_commune_message"  style="display:none">Before going to
                                            the next field select Commune first</span>
                                    </div>
                                </div>

                                <div class="col-md-4 birth_state" style="display:none">
                                    <div class="form-group">
                                        <label class="form-label" for="">Birth State/Province/Commune</label>
                                        <select class="form-control bfh-states birth-state-focus"
                                            data-country="birth_countries_states1" name="birth_state" data-state="CA"></select>
                                        <span class="text-danger birth_state_message" style="display:none">Before going to
                                            the next field select State/Province first</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">First Name </label>
                                        <input type="text" class="form-control" placeholder="First Name" required
                                            name="first_name" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Last Name </label>
                                        <input type="text" class="form-control" placeholder="Last Name"
                                            autocomplete="off" required name="last_name" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <select class="form-control select2" name="religion">
                                            <?php
                                        foreach($religion as $value){
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
                                        <label class="form-label">Address</label>
                                        <input class="form-control" placeholder="" name="address" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">Zip Code</label>
                                        <input class="form-control" name="zip_code"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            type="number" maxlength="6" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for=""> City </label>
                                        <input type="text" class="form-control" placeholder="" name="city"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">Country of Residence</label>
                                        <select id="countries_states1" class="form-control bfh-countries"
                                            data-country="US" name="country" required></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">State/Province/Commune</label>
                                        <select class="form-control bfh-states" data-country="countries_states1"
                                            name="state" required></select>
                                    </div>
                                </div>
                                <div class="col-md-4" >
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
                                                    $year_end = date('Y'); // current Year
                                                @endphp
                                                
                                                <select id="dob_year" name="year" class="bg-white width-100" required>
                                                    <option value="0">Year</option>
                                                    @for($i=$year_start; $i<=$year_end; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>

												
											</div>
                                    <!--<div class="form-group">-->
                                        <!--datepicker-->
                                        <!--<label class="form-label">Date of Birth</label>-->
                                        <!--<input type="date" class="form-control " placeholder=""-->
                                        <!--    data-format="mm/dd/yyyy" name="dob" required />-->
                                    <!--</div>-->
                                </div>
                                <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Home Phone</label>
                                                <input class="form-control" placeholder="Home Phone" name="home_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" />
                                            </div>
                                        </div> -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Work Phone</label>
                                        <!-- <input class="form-control" placeholder="Work Phone" name="work_phone"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            type="number" maxlength="10" /> -->
                                            <input style="width: 35rem;" type="tel" class="form-control" placeholder="" id="business_telephone" name="business_telephone_inp" onchange="getBusinessPhoneNo()" value="{{old('business_telephone')}}" required>
									<span class="text-danger" id="businessPhoneToast" style="display:none">Please enter correct number</span>
									<input type="hidden" name="work_phone" id="work_telephone_inp"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Cell Phone</label>
                                        <!-- <input class="form-control" placeholder="Cell Phone" name="cell_phone"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            type="number" maxlength="10" required /> -->
                                            <input style="width: 35rem;" class="form-control" placeholder="" onchange="getPhoneNo()" id="cellphone" name="format-cellphone"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "tel" maxlength = "10" value="{{old('cellphone')}}" required>
									<span class="text-danger" id="cellPhoneToast" style="display:none">Please enter correct number</span>
									<input type="hidden" name="cell_phone" id="cellphone-inp"/>
                                    </div>
                                </div>
                                <div class="col-md-4" id="">
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password"
                                            placeholder="Password" name="password" required />
                                    </div>
                                </div>
                                <div class="col-md-4" id="">
                                    <div class="form-group">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            placeholder="Confirm Password" name="confirm_password" required />
                                        <p id="CheckPasswordMatch" style="color: red;"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Company</label>
                                        <input type="text" class="form-control" placeholder="" name="company" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Comments</label>
                                        <textarea class="form-control" placeholder="" rows="4" name="comment" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" style="margin-top: 40px; text-align: center;">
                                <input type="submit" class="btn btn-lg btn-primary" value="Save">
                            </div>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="emn" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" data-toggle="modal" href="#ex2"><span
                            aria-hidden="true">&times;</span></button>
                    <p>Your email id is already registered. Do you want to continue with your previous details?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">No</button>
                    <button class="btn btn-primary" onclick="prevdetails()">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkPasswordMatch() {
            $("#CheckPasswordMatch").hide();
            var password = $("#password").val();
            var confirmPassword = $("#confirm_password").val();
            if (password != confirmPassword) {
                $("#CheckPasswordMatch").show();
                $("#CheckPasswordMatch").html("Passwords does not match!");
                $("#confirm_password").val("");
            }
        }
        $(document).ready(function() {
            $("#confirm_password").change(checkPasswordMatch);
        });
        $("#affiliateemail").change(function() {
            // var varr = $(this).val();
            // $("#emailexitstance").hide();
            // // alert(varr);
            // var url = "<?php echo url('/'); ?>/clientemailavailability";
            // $.ajax({
            //       url: url,
            //       data: 'email=' + varr + '&_token={{ csrf_token() }}',
            //       type: "POST",
            //     success: function (response) {
            //         // alert(response);
            //         if(response == "success") {
            //             $('#emn').modal('show');
            //             // $("#emailexitstance").show();
            //             // $("#emailexitstance").html("The email already exists!!!");
            //             // $("#affiliateemail").val("");
            //         }
            //         else if(response == "unuseable"){
            //             alert("You can't use this email id!!!");
            //             $("#affiliateemail").val("");
            //         }
            //     }
            // });
            prevdetails();
        });

        function prevdetails() {
            var varr = $("#affiliateemail").val();
            // alert(varr);
            var url = "<?php echo url('/'); ?>/clientprevdetails";
            $.ajax({
                url: url,
                data: 'email=' + varr + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    if (response != "") {
                        if (response[0] == "client") {
                            $("input[name=first_name]").val(response[1]);
                            $("input[name=last_name]").val(response[2]);
                            $("input[name=address").val(response[3]);
                            $("input[name=dob").val(response[4]);
                            $("input[name=home_phone").val(response[5]);
                            $("input[name=cell_phone").val(response[6]);
                            $("input[name=password").val(response[7]);
                            $("input[name=confirm_password").val(response[7]);
                            $("#passsec").hide();
                            $("#conpasssec").hide();
                            $('#emn').modal('hide');
                        } else if (response[0] == "affiliate") {
                            $("input[name=first_name]").val(response[1]);
                            $("input[name=last_name]").val(response[2]);
                            $("input[name=address").val(response[3]);
                            $("input[name=cell_phone").val(response[4]);
                            $("input[name=password").val(response[5]);
                            $("input[name=confirm_password").val(response[5]);
                            $("#passsec").hide();
                            $("#conpasssec").hide();
                            $('#emn').modal('hide');
                        } else if (response[0] == "user") {
                            $("input[name=first_name]").val(response[1]);
                            $("input[name=last_name]").val(response[2]);
                            $("input[name=address").val(response[3]);
                            $("input[name=cell_phone").val(response[4]);
                            $("input[name=password").val(response[5]);
                            $("input[name=confirm_password").val(response[5]);
                            $("#passsec").hide();
                            $("#conpasssec").hide();
                            $('#emn').modal('hide');
                        }
                    } else {
                        $("input[name=first_name]").val("");
                        $("input[name=last_name]").val("");
                        $("input[name=address").val("");
                        $("input[name=dob").val("");
                        $("input[name=home_phone").val("");
                        $("input[name=cell_phone").val("");
                        $("input[name=password").val("");
                        $("input[name=confirm_password").val("");
                        $("#passsec").show();
                        $("#conpasssec").show();
                    }

                }
            });
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                    $("#blah").css("border", "2px solid #da291c");
                    $("#blah").css("border-radius", "4px");
                    $("#blah").css("padding", "2px");
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
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
                $(".select_state").hide();
                $(".zip_code").hide();

            } else if (haiti == "US" || haiti == "CA") {
                $(".zip_code").show();
                $(".select_state").show();
                $(".comm").hide();
                $(".dep").hide();
                $(".arr").hide();
            } else {
                $(".zip_code").hide();
                $(".select_state").show();
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
                // if ($('#birth_commune').val() === "") {
                //     $(".birth_commune_message").show();
                //     $(".birth_commune_message").focus();
                //     $('#birth_commune').focus();
                //     return false;
                // }
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
			const businessPhoneInp = document.getElementById('work_telephone_inp')
			businessPhoneInp.value = businessPhoneNumber
			businessPhoneToast.style.display = 'none'
		} else {
			// if liberary not loaded
			const businessPhoneInp = document.getElementById('work_telephone_inp')
			businessPhoneInp.value = businessPhoneInputField.value

			let businessPhoneToast = document.getElementById('businessPhoneToast')
			businessPhoneToast.style.display = 'block'
		}
       }
       const onCommuneChange = () => {
        const birthCommune = document.getElementById('birth_commune')
        console.log(birthCommune.value)
        if(birthCommune.value == '') {
            const birth_commune_message = document.getElementById('birth_commune_message')
            console.log(birth_commune_message)
            birth_commune_message.style.display = 'block'
        } else {
            const birth_commune_message = document.getElementById('birth_commune_message')
            console.log(birth_commune_message)
            birth_commune_message.style.display = 'none'
        }
       }
</script>
@endsection
