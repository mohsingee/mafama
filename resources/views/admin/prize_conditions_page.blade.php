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
						<h3 class="nk-block-title page-title"   style="width:935px;">Prize Conditions</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('update_prize_conditions') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">
										
										
										<div class="col-md-6">
											<div class="form-group">
											<label class="form-label">Level </label>
												<select name="level" class="form-control" required="">
													<option>Select Level</option>
													@for($i=1;$i<=12;$i++)
													<option value="{{ $i }}"  {{ isset($bonus->id) && $bonus->level==$i?'selected':''}}>LEVEL {{ $i }}</option>
													@endfor
												</select>
											</div>
										</div>

									
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Point Earned</label>
												<input type="text" class="form-control"   name="point_earned" placeholder="Point Earned" value="{{ isset($bonus->id)?$bonus->point_earned:''}}" required>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Number of Times Log-in/Quarter</label>
												<input type="text" class="form-control"   name="active_days" placeholder="Active Days" value="{{ isset($bonus->id)?$bonus->active_days:''}}" required>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Number of Direct Downline Affiliates	</label>
												<input type="text" class="form-control"   name="downline_affiliate" placeholder="Downline Affiliate" value="{{ isset($bonus->id)?$bonus->downline_affiliate:''}}" required>
											</div>
										</div>

											<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">	Active Users	</label>
												<input type="text" class="form-control"   name="active_users" placeholder="Active Users" value="{{ isset($bonus->id)?$bonus->active_users:''}}" required>
											</div>
										</div>
									
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Start Date	</label>
												<input type="text" class="form-control date-picker" autocomplete="off"  name="start_date"  value="{{ isset($bonus->id)?$bonus->start_date:''}}" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">End Date	</label>
												<input type="text" class="form-control date-picker" autocomplete="off"  name="end_date"  value="{{ isset($bonus->id)?$bonus->end_date:''}}" required>
											</div>
										</div>
												
										
									</div>
									<div class="clearfix"></div>	
									
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="hidden" name="id" value="{{ isset($bonus->id)?$bonus->id:''}}" >
										<input type="submit" class="btn btn-lg btn-primary" value="Update">
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