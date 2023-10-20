@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <form action="{{ url('registration_business') }}" method="POST" id="" enctype="multipart/form-data"> 
                    @csrf
                        <div class="" style="padding-bottom: 20px;">
                            <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Register a Business</h4>
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
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
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
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control"  placeholder="Email" name="email" id="affiliateemail" required>
                                        <span style="color: red" id="emailexitstance"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input type="text" class="form-control"  placeholder="Password" name="password" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">Cell Phone</label>
                                        <input class="form-control"  placeholder="" name="cellphone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">Business Telephone</label>
                                        <input type="number" class="form-control"  placeholder="" name="business_telephone" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="">Choose a Business Category</label>
                                        <select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="business_category">
                                            <?php
                                                foreach ($category as $value) {
                                            ?>
                                                    <option value="<?= $value->category ?>"><?= $value->category ?></option>
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
                                <div class="col-md-6">
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
                                        <input type="text" class="form-control"  placeholder="" name="address"  required>
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
<script type="text/javascript">
    $("#affiliateemail").change(function(){
        varr = $(this).val();
        $("#emailexitstance").hide();
        // alert(varr);
        var url = "<?php echo url('/'); ?>/businessemailavailability";
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
@endsection