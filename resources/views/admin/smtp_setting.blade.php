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
				<h3 class="nk-block-title page-title"   style="width:935px;">SMTP Setting</h3>
				<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
			</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('update_smtp_setting') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">						
								       <div class="col-md-6">
											<div class="form-group">
												<label class="form-label">MAIL ENCRYPTION</label>
												<br>
												@php
												 $enc=env('MAIL_ENCRYPTION');
												@endphp
												<label>
													<input type="radio" name="MAIL_ENCRYPTION" value="tls" {{isset($enc) && $enc=='tls'?'checked':''}} > TLS
												</label>
												<label>
													<input type="radio" name="MAIL_ENCRYPTION" value="ssl" {{isset($enc) && $enc=='ssl'?'checked':''}}> SSL
												</label>
											</div>
										</div>
									</div>
									<div class="row gy-4" style="padding-bottom:20px;">						
								       <div class="col-md-8">
											<div class="form-group">
												<label class="form-label">MAIL_DRIVER</label>
												<input type="text" name="MAIL_DRIVER" class="form-control" value="{{ env('MAIL_DRIVER')}}">
												
											</div>
										</div>
									</div>
									<div class="row gy-4" style="padding-bottom:20px;">						
								       <div class="col-md-8">
											<div class="form-group">
												<label class="form-label">MAIL_HOST   </label>
												<input type="text" name="MAIL_HOST" class="form-control" value="{{ env('MAIL_HOST')}}">
												
											</div>
										</div>
									</div>
									<div class="row gy-4" style="padding-bottom:20px;">						
								       <div class="col-md-8">
											<div class="form-group">
												<label class="form-label">MAIL_PORT   </label>
												<input type="text" name="MAIL_PORT" class="form-control" value="{{ env('MAIL_PORT')}}">
												
											</div>
										</div>
									</div>
									<div class="row gy-4" style="padding-bottom:20px;">						
								       <div class="col-md-8">
											<div class="form-group">
												<label class="form-label">MAIL_USERNAME   </label>
												<input type="text" name="MAIL_USERNAME" class="form-control" value="{{ env('MAIL_USERNAME')}}">
												
											</div>
										</div>
									</div>
									
									<div class="row gy-4" style="padding-bottom:20px;">						
								       <div class="col-md-8">
											<div class="form-group">
												<label class="form-label">MAIL_PASSWORD   </label>
												<input type="password" name="MAIL_PASSWORD" class="form-control" value="{{ env('MAIL_PASSWORD')}}">
												
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										@if(permission_access('smtp_setting_edit')==1) 
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