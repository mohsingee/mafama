@extends('layouts.admin') 
@section('content')
<style>  
.borderless tr td, .borderless tr th {    
    text-align: left;    
}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Earned Point Setting</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('update_earning_point_setting') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">
										
										
									
										<div class="col-md-6">
										    	<input type="hidden"  name="id" value="{{ isset($setting->id)?$setting->id:''}}" >
										
											<div class="form-group">
												<label class="form-label"> No. Of Login in a Day</label>
												<input type="text" class="form-control" placeholder="no. of login" name="no_of_login"  value="{{ isset($setting->id)?$setting->no_of_login:''}}"  required>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Earned Point</label>
												<input type="text" class="form-control"  placeholder="Earned point" name="login_points"  value="{{ isset($setting->id)?$setting->login_points:''}}"  required>
												
											</div>
										</div>
								    
									
										<div class="col-md-6">
										    	
										
											<div class="form-group">
												<label class="form-label"> No. Of Hours Time Spend</label>
												<input type="text" class="form-control" placeholder="no. of login" name="no_of_hours"  value="{{ isset($setting->id)?$setting->no_of_hours:''}}"  required>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Earned Point</label>
												<input type="text" class="form-control"  placeholder="Earned point" name="hour_points"  value="{{ isset($setting->id)?$setting->hour_points:''}}"  required>
												
											</div>
										</div>
										
										
											<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Start Date	</label>
												<input type="text" class="form-control date-picker" autocomplete="off"  name="start_date"  value="{{ isset($setting->id)?$setting->start_date:''}}" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">End Date	</label>
												<input type="text" class="form-control date-picker" autocomplete="off"  name="end_date"  value="{{ isset($setting->id)?$setting->end_date:''}}" required>
											</div>
										</div>
											
										
									</div>
									<div class="clearfix"></div>	
									
										@if(permission_access('earning_points_edit')==1)
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="submit" class="btn btn-lg btn-primary" value="Update">
									</div>
									@endif
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