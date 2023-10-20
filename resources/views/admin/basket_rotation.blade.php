@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:900px;">Basket Lead Rotation Setting</h3>
					<!--<a href="add_access_roles.php" class="btn btn-sm btn-primary" style="float:right;">Add New</a>-->
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="" action="{{ url('update_basket_rotation') }}" method="POST" enctype="multipart/form-data">	
								@csrf	
									<input type="hidden" name="id" value="{{ isset($setting->id)?$setting->id:''}}">
									<div class="row gy-4">
									    	@if($errors->any())
													<p style="color: red">{{$errors->first()}}</p>
												@endif
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">No. of x days old leads</label>
												<input type="text" class="form-control" name="old_lead" value="{{ isset($setting->id)?$setting->old_lead:''}}" required>
											</div>
										</div>
										<div class="col-md-6">
										
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Directly sponsored affiliates</label>
												<input type="text" class="form-control" name="direct_affiliates" value="{{ isset($setting->id)?$setting->direct_affiliates:''}}" required>
											</div>
										</div>
									<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for=""> Affiliates stays actives for X months</label>
												<input type="text" class="form-control" name="stay_active" value="{{ isset($setting->id)?$setting->stay_active:''}}" required>
											</div>
										</div>	
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Plus x numbers of active users</label>
												<input type="text" class="form-control" name="active_users" value="{{ isset($setting->id)?$setting->active_users:''}}" required>
											</div>
										</div>
									<div class="col-md-6"></div>
									 <div class="col-md-12">
												<label class="form-label" for=""><b>Send x number emails per x months from basket 1</b></label>
									</div>
										
							            <div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for=""> Send x number emails</label>
												<input type="text" class="form-control" name="send_emails" value="{{ isset($setting->id)?$setting->send_emails:''}}" required>
											</div>
										</div>
										 <div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for=""> per x months  from basket 1</label>
												<input type="text" class="form-control" name="email_month" value="{{ isset($setting->id)?$setting->email_month:''}}" required>
											</div>
										</div>
                                     <div class="col-md-12">
												<label class="form-label" for=""><b>Earned X number of points for x months</b></label>
									</div> 
							           
									 <div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for=""> Earned X number of points </label>
												<input type="text" class="form-control" name="earned_points" value="{{ isset($setting->id)?$setting->earned_points:''}}" required>
											</div>
										</div>
										
									<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">  for x months</label>
												<input type="text" class="form-control" name="point_month" value="{{ isset($setting->id)?$setting->point_month:''}}" required>
											</div>
										</div>
										
									<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for=""> Sponsor x number of any new paid users</label>
												<input type="text" class="form-control" name="paid_users" value="{{ isset($setting->id)?$setting->paid_users:''}}" required>
											</div>
										</div>	
											
									
										
														
											
										
										
										
										<div class="col-12 text-center">
											@if(permission_access('basket_leads_edit')==1)
											<input type="submit" class="btn btn-sm btn-primary" value="Update">
											@endif
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div><!-- .nk-block -->
				
				
				
			</div>
		</div>
	</div>
</div>
@endsection