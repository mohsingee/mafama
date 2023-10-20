@extends('layouts.admin') 
@section('content')
<style type="text/css">
	.imgg{
		width: 100px;
	    float: right;
	    border: 3px solid #b71a0f;
	    border-radius: 10px;
	    padding: 5px;
	    margin-bottom: 20px;
	}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="content-page wide-md m-auto">
					
					<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Form Library</h3>
						<!-- <a href="{{ url('admin/affilates_registration') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>  -->
											</div><!-- .nk-block-head-content -->
					<div class="nk-block">
						<div class="card card-bordered">
							<div class="card-inner card-inner-xl">
								<div class="col-md-12 text-center" style="padding-top:20px;padding-bottom:20px;">
								<h5>Profile Information</h5>
								</div>
								
								<table class="table">
												
									<tbody>
										<tr>
											<td style="border:0px!important;padding-left:0px;">
												@if(!empty($details[0]->code))
												Affiliate Code<input type="text" class="form-control" value="<?= $details[0]->code ?>" disabled>
												@endif
											</td>
											<td style="border:0px!important;"></td>
											<td style="border:0px!important;padding-right:0px;">
												<img src="<?php echo asset("public/images/affiliates") ?>/<?= $details[0]->image ?>" class="imgg">
											</td>
																									
										</tr>
										<tr>
											<td style="border:0px!important;padding-left:0px;">First Name<input type="text" class="form-control" value="<?= $details[0]->first_name ?>" disabled></td>
											<td style="border:0px!important;">Last Name<input type="text" class="form-control" value="<?= $details[0]->last_name ?>" disabled></td>
											<td style="border:0px!important;padding-right:0px;">Cell Phone<input type="text" class="form-control" value="<?= $details[0]->cellphone ?>" disabled></td>
																									
										</tr>
										<tr>
											<td style="border:0px!important;padding-left:0px;">Email<input type="text" class="form-control" value="<?= $details[0]->email ?>" disabled></td>
											<td style="border:0px!important;">Address<input type="text" class="form-control" value="<?= $details[0]->address ?>" disabled></td>
											<td style="border:0px!important;padding-right:0px;">Zipcode<input type="text" class="form-control" value="<?= $details[0]->zip_code ?>" disabled></td>
																									
										</tr>
										<tr>
											<td style="border:0px!important;padding-left:0px;">City<input type="text" class="form-control" value="<?= $details[0]->city ?>" disabled></td>
											<td style="border:0px!important;">State
												<span class="bfh-states form-control" data-country="<?= $details[0]->country ?>" data-state="<?= $details[0]->state ?>" style="background: aliceblue;text-align: left;"></span>
											</td>
											<td style="border:0px!important;padding-right:0px;">Country
												<span class="bfh-countries form-control" data-country="<?= $details[0]->country ?>" style="background: aliceblue;text-align: left;"></span>
											</td>
																									
										</tr>
										<tr>
											<td style="border:0px!important;padding-left:0px;">Category<input type="text" class="form-control" value="<?= $details[0]->category ?>" disabled></td>
											<td style="border:0px!important;">Office Phone<input type="text" class="form-control" value="<?= $details[0]->business_telephone ?>" disabled></td>
											
											<td style="border:0px!important;padding-right:0px;">Religious Faith<input type="text" class="form-control" value="<?= $details[0]->religion ?>" disabled></td>														
										</tr>
										
									</tbody>
								</table>
								
								<div class="col-md-12 text-center" style="padding-top:20px;padding-bottom:20px;">
								<h5>Billing Information</h5>
								</div>
								<table class="table">
									
									<tbody>
										<tr>
											<td style="border:0px!important;padding-left:0px;">Street Address<input type="text" class="form-control" value="<?= $details[0]->billing_address ?>" disabled></td>
											<td style="border:0px!important;">Zip Code<input type="text" class="form-control" value="<?= $details[0]->billing_zip_code ?>" disabled></td>
											<td style="border:0px!important;padding-right:0px;">City<input type="text" class="form-control" value="<?= $details[0]->billing_city ?>" disabled></td>
																									
										</tr>
										<tr>
											<td style="border:0px!important;padding-left:0px;">State
												<span class="bfh-states form-control" data-country="<?= $details[0]->billing_country ?>" data-state="<?= $details[0]->billing_state ?>" style="background: aliceblue;text-align: left;"></span>
											</td>
											<td style="border:0px!important;">Country
												<span class="bfh-countries form-control" data-country="<?= $details[0]->billing_country ?>" style="background: aliceblue;text-align: left;"></span>
											</td>
											<td style="border:0px!important;padding-right:0px;"></td>
																									
										</tr>
										
										
									</tbody>
								</table>
								
								
							</div>
							
							
						</div>
					</div><!-- .nk-block -->
				</div><!-- .content-page -->
			</div>
		</div>
	</div>
</div>
@endsection