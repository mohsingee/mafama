@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Change Password</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form method="POST" action="{{ url('change-password') }}">
		                        @csrf 
		   
		                         @foreach ($errors->all() as $error)
		                            <p class="text-danger">{{ $error }}</p>
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
											@if(permission_access('change_password_edit')==1) 
											<button type="submit" class="btn btn-lg btn-primary">Update Password</button>
											@endif
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