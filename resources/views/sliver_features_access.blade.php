@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Silver Features Access</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="">	
									<div class="row gy-4">
										
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Settings</label>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck1">
													<label class="custom-control-label" for="customCheck1">Allow Free</label>
												</div>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck2">
													<label class="custom-control-label" for="customCheck2">Allow VIP</label>
												</div>
												
											</div>
										</div>
										
										
									</div>
									<div class="row gy-4">
										
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Appointment</label>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck3">
													<label class="custom-control-label" for="customCheck3">Allow Free</label>
												</div>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck4">
													<label class="custom-control-label" for="customCheck4">Allow VIP</label>
												</div>
												
											</div>
										</div>
										
									</div>
									<div class="row gy-4">
										
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Client Management</label>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck5">
													<label class="custom-control-label" for="customCheck5">Allow Free</label>
												</div>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck6">
													<label class="custom-control-label" for="customCheck6">Allow VIP</label>
												</div>
												
											</div>
										</div>
										
										
									</div>
									<div class="row gy-4">
										
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Email Management</label>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck7">
													<label class="custom-control-label" for="customCheck7">Allow Free</label>
												</div>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck8">
													<label class="custom-control-label" for="customCheck8">Allow VIP</label>
												</div>
												
											</div>
										</div>
										
									</div>
									<div class="row gy-4">
										
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Financial Management</label>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck9">
													<label class="custom-control-label" for="customCheck9">Allow Free</label>
												</div>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck10">
													<label class="custom-control-label" for="customCheck10">Allow VIP</label>
												</div>
												
											</div>
										</div>
										
									</div>
									<div class="row gy-4">
										
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Archives</label>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck11">
													<label class="custom-control-label" for="customCheck11">Allow Free</label>
												</div>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck12">
													<label class="custom-control-label" for="customCheck12">Allow VIP</label>
												</div>
												
											</div>
										</div>
										
									</div>
									
									<div class="row gy-4" style="padding-top:30px;">
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Number of days for Free User Access</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Number of emails Free User can send per month </label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Number of emails VIP User can send per month</label>
												<input type="text" class="form-control">
											</div>
										</div>
										
										
									</div>
									<div class="row gy-4">
										<div class="col-md-12" style="margin-top:30px;">
											<a href="#" class="btn btn-lg btn-primary">Update</a>
											
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