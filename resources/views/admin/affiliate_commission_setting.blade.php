@extends('layouts.admin')
@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />
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
						<h3 class="nk-block-title page-title"   style="width:935px;">Affiliate Commission Setting</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('update_affiliate_commission_setting') }}" method="POST" id="" enctype="multipart/form-data">
									@csrf

									<div class="row gy-4" style="padding-bottom:20px;">



										<div class="col-md-4">
										    	<input type="hidden" name="id" value="{{ isset($setting->id)?$setting->id:''}}" >

											<div class="form-group">
												<label class="form-label">Affiliate Commission Amount</label>
												<input type="text" class="form-control" placeholder="Commission Amount" name="commission_amount"  value="{{ isset($setting->id)?$setting->commission_amount:''}}"  required>
											</div>
										</div>


										<div class="col-md-4">

											<div class="form-group">
												<label class="form-label"> Amount Deduct</label>
												<input type="text" class="form-control" placeholder="Amount" name="deduction_amount"  value="{{ isset($setting->id)?$setting->deduction_amount:''}}"  required>
											</div>
										</div>
                                      <?php
                                       $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12'];
                                      ?>
                                     <div class="col-md-4">

											<div class="form-group">
												<label class="form-label"> Month</label>
												<select class="form-control" name="commission_month"    required>
													 <option value=""> Select Month</option>
													 @foreach($months_arr as $month)
													 <option value="{{$month}}" {{ isset($setting->id) && $setting->commission_month == $month ?'selected':''}}><?=date('F',strtotime('01-'.$month.'-'.date('Y')));?></option>
													 @endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>


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