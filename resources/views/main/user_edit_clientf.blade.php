@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Client Management / Edit Client</h4>
                    </div>
                    <form action="{{ url('updateclient_appointment') }}" method="POST" id="" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="<?= $client[0]->id ?>">
                        <div class="col-md-12" style="border: 1px solid #da291c !important; border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4 text-center">
                                    <div>
                                        <img src="{{ asset('public/assets/images/client') }}/<?= $client[0]->image ?>" style="width: 100px; height: 100px; margin: 0 auto; border: 2px solid #da291c" id="blah">
                                    </div>
                                    
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">First Name </label>
                                    <input type="text" class="form-control" placeholder="First Name" required name="first_name" value="<?= $client[0]->first_name ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Last Name </label>
                                    <input type="text" class="form-control" placeholder="Last Name" required name="last_name" value="<?= $client[0]->last_name ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Email Address" required name="email" value="<?= $client[0]->email ?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input class="form-control" placeholder="" name="address" value="<?= $client[0]->address ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="">Zip Code</label>
                                    <input class="form-control" name="zip_code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"  maxlength = "6" value="<?= $client[0]->zip_code ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for=""> City </label>
                                    <input type="text" class="form-control" placeholder="" name="city" value="<?= $client[0]->city ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="">Country</label>
                                    <select id="countries_states1" class="form-control bfh-countries" data-country="<?= $client[0]->country ?>" name="country" required></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="">State/Province</label>
                                    <select class="form-control bfh-states" data-country="countries_states1" data-state="<?= $client[0]->state ?>" name="state" required></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="text" class="form-control datepicker" placeholder="" name="dob" value="<?= $client[0]->dob ?>" required />
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Home Phone</label>
                                    <input class="form-control" placeholder="Cell Phone" name="home_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" value="<?= $client[0]->home_phone ?>" required />
                                </div>
                            </div> -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Work Phone</label>
                                    <input class="form-control" placeholder="Cell Phone" name="work_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" value="<?= $client[0]->work_phone ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Cell Phone</label>
                                    <input class="form-control" placeholder="Cell Phone" name="cell_phone"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" value="<?= $client[0]->cell_phone ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control" placeholder="" name="company" value="<?= $client[0]->company ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" id="imgInp">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Comments</label>
                                    <textarea class="form-control" placeholder="" rows="4" name="comment" required><?= $client[0]->comment ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 40px; text-align: center;">
                            <input type="submit" class="btn btn-lg btn-primary" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function checkPasswordMatch() {
       $("#CheckPasswordMatch").hide();
        var password = $("#password").val();
        var confirmPassword = $("#confirm_password").val();
        if (password != confirmPassword){
            $("#CheckPasswordMatch").show();
            $("#CheckPasswordMatch").html("Passwords does not match!");
            $("#confirm_password").val("");
        }
    }
    $(document).ready(function () {
       $("#confirm_password").change(checkPasswordMatch);
    });
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $("#imgInp").change(function() {
      readURL(this);
    });
</script>

@endsection