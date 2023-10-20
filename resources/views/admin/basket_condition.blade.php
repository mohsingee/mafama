@extends('layouts.admin') 
@section('content')


<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:900px;">Basket Condition Setting</h3>
					<!--<a href="add_access_roles.php" class="btn btn-sm btn-primary" style="float:right;">Add New</a>-->
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="" action="{{ url('update_basket_condition') }}" method="POST" enctype="multipart/form-data">	
								@csrf	
									<input type="hidden" name="id" value="{{ isset($setting->id)?$setting->id:''}}">
							<input type="hidden" name="basket_id" value="{{ $basket_id}}">	
									<div class="row gy-4">
									    	@if($errors->any())
													<p style="color: red">{{$errors->first()}}</p>
												@endif
										
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">X # of Active Affiliates </label>
												<input type="text" class="form-control" name="active_affiliates" value="{{ isset($setting->id)?$setting->active_affiliates:''}}" required>
											</div>
										</div>
											
										
										
										


										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Plus X # of Users </label>
												<input type="text" class="form-control" name="plus_users" value="{{ isset($setting->id)?$setting->plus_users:''}}" required>
											</div>
										</div>

										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">From Date</label>
												<input type="text" class="form-control date-picker" name="from_date" value="{{ isset($setting->id)?$setting->from_date:''}}" required>
											</div>
										</div>
										
											
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">To Date</label>
												<input type="text" class="form-control date-picker" name="to_date"value="{{ isset($setting->id)?$setting->to_date:''}}" required>
											</div>
										</div>
										
													
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">System will take X # of contacts Closest location  </label>
												<input type="text" class="form-control" name="closest_contacts" value="{{ isset($setting->id)?$setting->closest_contacts:''}}" required>
											</div>
										</div>

									  <div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Place contacts in the basket of affiliate  </label>
												<select name="place_basket" class="form-control">
													@foreach($baskets as $basket )
													<option value="{{ $basket->id }}"  {{ isset($setting->id) && $setting->place_basket == $basket->id ?'selected':''}} >{{ $basket->name }}</option>
													@endforeach
												</select>
											</div>
										</div>

									 <div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Categories  </label>
												<select name="categories[]" class="form-control select2"  multiple="">
													<option></option>
													@foreach($leads_category as $basket )
													<option value="{{ $basket->id }}"  {{ isset($setting->id) && in_array($basket->id,explode(',', $setting->categories)) ?'selected':''}} >{{ $basket->category }}</option>
													@endforeach
												</select>
											</div>
										</div>	
										
										
										<div class="col-12 text-center">
											<input type="submit" class="btn btn-sm btn-primary" value="Update">
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