@extends('layouts.admin')
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">

				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Promotion Condition</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('promotion-setting-update') }}" method="POST" id="" enctype="multipart/form-data">
									@csrf

									<div class="row gy-4" style="padding-bottom:20px;">



										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label font-weight-bold	"><b> No. Of Leads Received</b></label>
												<input type="text" class="form-control" placeholder="No. of lead" name="received_lead"  value="{{ isset($setting->id)?$setting->received_lead:0}}"  required>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label font-weight-bold	"><b> Closest Contact</b></label>
												<input type="text" class="form-control" placeholder="No. of lead" name="closest_contact"  value="{{ isset($setting->id)?$setting->closest_contact:0}}"  required>
											</div>
										</div>



										<div class="col-md-6">
										    	<label class="form-label font-weight-bold"><b> From Categories </b></label>
											   <select  class="form-control select2"  name="lead_category[]" multiple required="">
											       <option value=''>Select</option>
											       @if(!empty($lead_categories))

											         @foreach($lead_categories as $cate)

											       <option value="{{$cate->id}}" <?=isset($setting->id) && in_array($cate->id,explode(',',$setting->lead_category))?'selected':'';?>>{{$cate->category}} ({{ \App\UploadLeads::total_leads($cate->id)}})</option>

											          @endforeach
											       @endif
											   </select>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">
													<b>No. of contacts in the basket of the Affiliate	</b>
												</label>

												<select  class="form-control "  name="placed_basket" required="">
											       <option value=''>Select</option>


											       <option value="13" <?=isset($setting->id) && ($setting->placed_basket=='13')?'selected':'13';?>>Basket 1</option>
											         <option value="12" <?=isset($setting->id) && ($setting->placed_basket=='12')?'selected':'12';?>>Basket 2</option>


											   </select>

											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">
													<b>Assign Position	</b>
												</label>
												<input type="text" class="form-control" name="assign_position"  value="{{ isset($setting->id)?$setting->assign_position:''}}"  required>

											</div>
										</div>
										<div class="col-md-6">

										</div>




									</div>
									<div class="clearfix"></div>

<input type="hidden" class="form-control" name="id"  value="{{ isset($setting->id)?$setting->id:''}}"  required>
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
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