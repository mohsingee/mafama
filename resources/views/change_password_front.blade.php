@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Change Password</h4>
                    </div>
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
                <div class="col-md-12">
                	<form method="POST" action="{{ url('change-password') }}">
                        @csrf 
   
                         @foreach ($errors->all() as $error)
                            <p class="text-danger" style="font-weight: bold; margin-bottom: 10px;">** {{ $error }}</p>
                         @endforeach 	
							<div class="row gy-4">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Old Password	</label>
										<input type="password" name="current_password" class="form-control" placeholder="Old Password">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Password</label>
										<input type="password" class="form-control" name="new_password" placeholder="Password">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">Confirm Password</label>
										<input type="password" class="form-control" name="new_confirm_password" placeholder="Confirm Password">
									</div>
								</div>
								
							</div>
							<div class="row gy-4">
								<div class="col-md-12" style="margin-top:30px;">
									<button type="submit" class="btn btn-lg btn-primary">Update Password</button>
								</div>
							</div>
						</form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection