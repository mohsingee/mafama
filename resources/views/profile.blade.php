@extends('layouts.main') 
@section("content")

<style type="text/css">
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
   

    input#sendon::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }

.clipboard {
  position: relative;
}
/* You just need to get this field */
.copy-input {
  max-width: 342px;
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
    bottom: 20px;
    left: 0;
    right: 0;
    margin: auto;
  color:#000;
  padding: 15px 15px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 3px 15px #b8c6db;
  -moz-box-shadow: 0 3px 15px #b8c6db;
  -webkit-box-shadow: 0 3px 15px #b8c6db;
}

</style>
<script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <form action="{{ url('affiliate_update') }}" method="POST" id="" enctype="multipart/form-data"> 
                    @csrf
                        <div class="" style="padding-bottom: 20px;">
                            <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Settings / Profile Information</h4>
                            </div>
                            <div class="col-md-12 text-right margin-bottom-20">
                                <div class="margin-top-10">
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
                                    <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">My Daily Briefing</a>
                                    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                                </div>
                            </div>
                            <!--<ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                                            <li class="active"><a href="add_appointment_setting.php">Appointment</a></li>
                                            <li><a href="#">Client Management</a></li>
                                            <li><a href="#">Email Management</a></li>
                                            <li><a href="#">Financial Management</a></li>
                                            
                                        </ul>

                                        <div class="tab-content margin-top-10"  style=" border-radius:10px;padding:10px;">-->
                            <div class="col-md-12" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Enter the code that was sent to you</label>
                                        <input type="text" class="form-control" autocomplete="off" id="affiliate_code" value="<?= $details[0]->code ?>" readonly />
                                        <span style="color: red;" id="codeexitstance"></span>
                                        <input type="hidden" class="form-control" name="code" value="<?= $details[0]->code ?>" required>
                                        <input type="hidden" class="form-control" name="joining_date" value="<?= $details[0]->joining_date ?>" required>
                                    </div>

                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">
                                            My Profile Link
                                        </label>
                                        
                                      <div class="clipboard">
<input onclick="copy1()" class="copy-input " value="{{ $my_profile_link }}"  id="copyClipboard1" readonly>
<button type="button" class="copy-btn" id="copyButton" onclick="copy1()"><i class="far fa-copy"></i></button>
</div>
<div id="copied-success1" class="copied">
  <span>Copied!</span>
</div>    
                                           
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">
                                            My Referral Link
                                        </label>
                                         
<div class="clipboard">
<input onclick="copy()" class="copy-input " value="{{ $my_referral_link }}"  id="copyClipboard" readonly>
<button type="button" class="copy-btn" id="copyButton" onclick="copy()"><i class="far fa-copy"></i></button>
</div>
<div id="copied-success" class="copied">
  <span>Copied!</span>
</div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>











										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Country Of Birth</label>
												<select id="birth_countries_states1" class="form-control bfh-countries" data-country="<?= $details[0]->birth_country ?>" readonly></select>
											</div>
										</div>

										<div class="col-md-4 birth_comm" @if($details[0]->birth_country != "HT") style="display:none" @endif>
											<div class="form-group">
												<label class="form-label" for="">Commune</label>
												<select id="birth_commune" class="form-control bfh-commune" name="" readonly>
													<option value="{{(isset($details[0]->birth_commune)) ? $details[0]->birth_commune : ''}}">{{(isset($details[0]->birth_commune)) ? showcommuneName($details[0]->birth_commune) : ''}}</option>
												</select>
											</div>
										</div>

										<div class="col-md-4 birth_state" @if($details[0]->birth_country == "HT") style="display:none" @endif>
											<div class="form-group">
												<label class="form-label" for="">State/Province</label>
												<select class="form-control bfh-states birth-state-focus" 
												data-state="<?= $details[0]->birth_state ?>" data-country="<?= $details[0]->birth_country ?>" name="" readonly></select>
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
                                        <label class="form-label" for="">Religious Faith</label>
                                        <select class="form-control" name="religion" id="otherreligion">
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
                                <div class="col-md-4" id="relother" @if($details[0]->religion!="Other")style="display:none"@endif>
                                            <div class="form-group"> 
                                                <label class="form-label" for="">Religious Faith</label>
                                                <input type="text" class="form-control" name="otherreligion" id="religionother" value="{{ $details[0]->otherreligion }}" placeholder="Enter your Religion">  
                                            </div>
                                        </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control"  placeholder="Profile Email" value="<?= $details[0]->email ?>" disabled>
                                        <input type="hidden" name="email" value="<?= $details[0]->email ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Date Of Birth</label>
                                            
                                                <input type="date" name="dob" class="form-control"  data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d',strtotime($details[0]->dob)) ?>" id="sendon">
                                                
                                            </div>
                                        </div>
                                <div class="col-md-4">
                                    <div class="form-group">
									<label class="form-label" for="">Cell Phone</label>
									<input style="width: 35rem;" class="form-control" placeholder="" onchange="getPhoneNo()" id="cellphone" name="format-cellphone"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "tel" maxlength = "10" value="<?= $details[0]->cellphone ?>" required>
									<span class="text-danger" id="cellPhoneToast" style="display:none">Please enter correct number</span>
									<input type="hidden" name="cellphone" id="cellphone-inp"/>
								</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
									<label  class="form-label"  for="">Business Telephone</label>
									<input style="width: 35rem;" type="tel" class="form-control" placeholder="" id="business_telephone" name="business_telephone_inp" onchange="getBusinessPhoneNo()" value="<?= $details[0]->business_telephone ?>" required>
									<span class="text-danger" id="businessPhoneToast" style="display:none">Please enter correct number</span>
									<input type="hidden" name="business_telephone" id="business_telephone_inp"/>
								</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">Business Category1</label>
                                        <select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="business_category" id="businesscat">
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
                                <div class="col-md-4" id="otherbusiness" @if($details[0]->business_category!=13)style="display:none"@endif>

                                            <div class="form-group"> 
                                                <label class="form-label" for="">Other Business</label>
                                                <input type="text" id="businessother" name="otherbusiness" class="form-control" value="{{ $details[0]->otherbusiness }}" placeholder="Enter your other business">    
                                            </div>
                                        </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">Business Category2</label>
                                        <select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="lead_category">
                                            <?php
                                                foreach ($lead_category as $value) {
                                            ?>
                                                    <option <?php if ($details[0]->lead_category == $value->id) { ?> selected <?php } ?> value="<?= $value->id ?>"><?= $value->category ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">Uplaod Picture</label>
                                        <div class="fancy-file-upload fancy-file-info">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control"  name="image" onchange="jQuery(this).next('input').val(this.value);" />
                                            <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                                            <span class="button">Choose File</span>
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
    maxlength = "6" required>
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
                                        <label class="form-label" for="">Country Of Residence</label>
                                        <select id="countries_states1" class="form-control bfh-countries" data-country="<?= $details[0]->country ?>" name="country" required></select>
                                    </div>
                                </div>


                                
                                        <div class="col-md-4 comm" @if($details[0]->commune==NULL)style="display:none"@endif>
                                            <div class="form-group">
                                                <label class="form-label" for="">Commune</label>
                                                <select id="commune" class="form-control bfh-commune" name="commune">
                                                    <option value=""></option>
                                                    @foreach($communes as $commune)
                                                    <option value="{{ $commune->id }}" @if($details[0]->commune==$commune->id){{ "selected" }}@endif>{{ $commune->commune }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 dep" @if($details[0]->department==NULL)style="display:none"@endif>
                                            <div class="form-group">
                                                <label class="form-label" for="">Departments</label>
                                                <select name="selectdepartment" id="department" class="form-control">
                                                    @if($details[0]->department!=NULL)
                                                    <option value="{{ $details[0]->department }}">{{ showdepartmentName($details[0]->department) }}</option>
                                                    @else{
                                                    <option value=""></option>
                                                }@endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 arr" @if($details[0]->arrondissement==NULL)style="display:none"@endif>
                                            <div class="form-group">
                                                <label class="form-label" for="">Arrondissement</label>
                                                <select name="selectarr" id="arro" class="form-control">
                                                    @if($details[0]->arrondissement!=NULL)
                                                    <option value="{{ $details[0]->arrondissement }}">{{ showarrondissementName($details[0]->arrondissement) }}</option>
                                                    @else{
                                                    <option value=""></option>
                                                }
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        
                                        

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">State/Province</label>
                                        <select class="form-control bfh-states" data-state="<?=$details[0]->state ?>" data-country="countries_states1" name="state"></select>
                                    </div>
                                </div>

                                @if($is_medical_user == 1)
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">Licence No.</label>
                                        <input type="text" name="licence_no" class="form-control" value="<?= $details[0]->licence_no ?>">
                                    </div>
                                </div>

                                @else

                                  <input type="hidden" name="licence_no" >
                                @endif

    <!--                            <div class="col-md-12" style="margin-top: 40px;">-->
    <!--                                <h4>Billing Information</h4>-->
    <!--                            </div>-->
    <!--                            <div class="col-md-6">-->
    <!--                                <div class="form-group">-->
    <!--                                    <label class="form-label" for="">Street Address</label>-->
    <!--                                    <input type="text" class="form-control"  placeholder="" name="billing_address" value="<?= $details[0]->billing_address ?>" required>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            <div class="col-md-6">-->
    <!--                                <div class="form-group">-->
    <!--                                    <label class="form-label" for="">Zip Code</label>-->
    <!--                                    <input class="form-control"  placeholder="" name="billing_zip_code" -->
    <!--oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"-->
    <!--type = "number"-->
    <!--maxlength = "6" value="<?php #$details[0]->billing_zip_code ?>" required>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            <div class="col-md-4">-->
    <!--                                <div class="form-group">-->
    <!--                                    <label class="form-label" for=""> City </label>-->
    <!--                                    <input type="text" class="form-control"  placeholder="" name="billing_city" value="<?= $details[0]->billing_city ?>" required>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            <div class="col-md-4">-->
    <!--                                        <div class="form-group">-->
    <!--                                            <label class="form-label" for="">Country</label>-->
    <!--                                            <select id="countries_states2" class="form-control bfh-countries" data-country="<?= $details[0]->billing_country ?>" name="billing_country" required></select>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                    <div class="col-md-4">-->
    <!--                                        <div class="form-group">-->
    <!--                                            <label class="form-label" for="">State/Province</label>-->
    <!--                                            <select class="form-control bfh-states" data-state="<?= $details[0]->billing_state ?>" data-country="countries_states2" name="billing_state" required></select>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                        </div>-->
                            <div class="col-md-12" style="margin-top: 40px; text-align: center;">
                                <input type="submit" class="btn btn-lg btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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
    $("#affiliate_code").change(function(){
        varr = $(this).val();
        $("#codeexitstance").hide();
        // alert(varr);
        var url = "<?php echo url('/'); ?>/checkacode";
        $.ajax({
              url: url,
              data: 'code=' + varr + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                if(response == "fail") {
                    $("#codeexitstance").show();
                    $("#codeexitstance").html("You have entered a wrong code!!!");
                    $("#affiliate_code").val("");
                }
            }
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
   
       // $('#sendon').attr('min', maxDate);
    });
    $("#sendon").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change");
</script>

<script>
    $(document).on("change","#countries_states1",function(){
        haiti=$("#countries_states1").val();
        // alert(haiti);
        if(haiti=="HT"){
            $(".comm").show();
            $(".dep").show();
            $(".arr").show();

        }else{
            $(".comm").hide();
            $(".dep").hide();
            $(".arr").hide();
            $("#commune").val("");
            $("#department").val("");
            $("#arro").val("");


        } 
    })
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
        }else{

            $("#commune").val();
            $("#department").val();
            $("#arro").val();

        }    
        
    })
</script>


<script>
    $(document).on("change","#commune",function(){
        commune=$("#commune").val();
        haiti=$("#countries_states1").val();
        var url = "<?=url('/');?>/select_department";

        if(haiti=="HT" && commune!=""){
        $.ajax({
            url: url,
            data: 'haiti=' + haiti,
            type: "GET",
            success:function(data){
                $("#department").html(data);
            }
        })
        }else{

            $("#commune").val("");
            $("#department").val("");
            $("#arro").val("");

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
</script>
@endsection