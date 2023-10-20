@extends('layouts.admin') 
@section('content')
<style>
  
.borderless tr td, .borderless tr th {
    
    text-align: left;
    
}
h6.nk-block-title.page-title {
    font-size: 16px;
}
.borderless tr td, .borderless tr th {
    padding-bottom: 0px!important;
    padding-top: 8px !important;
}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				
			<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
				<h3 class="nk-block-title page-title"   style="width:935px;">Payment Gateway Setting</h3>
				<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
			</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('update_payment_gateway_setting') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">						
								       <div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Paypal Payment Gateway Mode</label>
												<br>
												@php
												 $mode=env('PAYPAL_MODE');
												@endphp
												<label>
													<input type="radio" name="mode" value="sandbox" {{isset($mode) && $mode=='sandbox'?'checked':''}} > Sandbox
												</label>
												<label>
													<input type="radio" name="mode" value="live" {{isset($mode) && $mode=='live'?'checked':''}}> Live
												</label>
											</div>
										</div>
									</div>
									<div class="row gy-4" style="padding-bottom:20px;">						
								       <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">PAYPAL CLIENT ID</label>
												<input type="text" name="paypal_client_id" class="form-control" value="{{ env('PAYPAL_CLIENT_ID')}}">
												
											</div>
										</div>
									</div>
									<div class="row gy-4" style="padding-bottom:20px;">						
								       <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">PAYPAL SECRET KEY   </label>
												<input type="text" name="paypal_secret_key" class="form-control" value="{{ env('PAYPAL_SECRET')}}">
												
											</div>
										</div>
									</div>
									<div class="clearfix"></div>	
									
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										@if(permission_access('payment_gateway_edit')==1)
										<input type="submit" class="btn btn-lg btn-primary" value="Update">
										@endif
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