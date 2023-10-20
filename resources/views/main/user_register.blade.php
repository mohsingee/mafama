@extends('layouts.main')

@section('content')
<style type="text/css">
    .col-form-label{
        font-size: 14px;
        text-align: left;
    }
    input:-webkit-autofill {
        color: #ffffff !important;
        font-weight: 400;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
            <div class="heading-title heading-dotted col-md-12 margin-bottom-10 margin-top-20">
                <h4>User Registration</h4>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card" style="border: 1px solid red; padding: 10px 20px;margin: 30px 0;text-align: center; font-weight: bold; font-size: 17px">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label text-md-right">First name</label>

                                <div class="">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label text-md-right">Last Name</label>

                                <div class="">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="affiliateemail" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="" style="text-align: left">
                                    <input id="affiliateemail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <span style="color: red; font-size: 12px; font-weight: 400" id="emailexitstance"></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label text-md-right">Phone</label>

                                <div class="">
                                    <input class="form-control"  placeholder="" name="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" value="{{ old('phone') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
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
                else{
                    $("#emailexitstance").hide();
                }
            }
        });
    });
</script>
@endsection
