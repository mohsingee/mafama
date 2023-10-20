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
						<h3 class="nk-block-title page-title"   style="width:935px;">General Setting</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('update_general_setting') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">
										
										
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Membership grace period in days</label>
												<input type="text" class="form-control"   name="grace_period" placeholder="" value="{{ isset($setting->id)?$setting->grace_period:''}}" required>
											</div>
										</div>
										<div class="col-md-6">
										    	<input type="hidden" class="form-control"   name="registration_fee" placeholder="Registration fee" value="{{ isset($setting->id)?$setting->registration_fee:''}}" required>
										
											<div class="form-group">
												<label class="form-label">After complete payment no. of share field step1</label>
												<input type="text" class="form-control" placeholder="Shareable fields" name="shareable_fields_one"  value="{{ isset($setting->id)?$setting->shareable_fields_one:''}}"  required>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">After complete payment no. of share field step2</label>
												<input type="text" class="form-control"  placeholder="Shareable fields" name="shareable_fields_two"  value="{{ isset($setting->id)?$setting->shareable_fields_two:''}}"  required>
												
											</div>
										</div>
										<div class="col-md-6">
											
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Registration success page message</label>
												<textarea class="form-control"  placeholder="Registration success page message" name="success_page_message" rows="10">{{ isset($setting->id)?$setting->success_page_message:''}}</textarea>
											</div>
										</div>
                                      <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Invitation Email Subject</label>
												<input type="text" class="form-control"  placeholder="Email Subject" name="invitation_email_subject"  value="{{ isset($setting->id)?$setting->invitation_email_subject:''}}"  required>
												
											</div>
										</div>	
								       <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Invitation Email Template Body</label>
												
												<textarea name="invitation_email_body" class="editor1" rows="10">{{ isset($setting->id)?$setting->invitation_email_body:''}}</textarea>
											</div>
										</div>	
                                                 <div class="col-md-12">
									 	<div class="form-group">
									 			<h4 class="nk-block-title page-title"   >Invitation Email shortcodes</h4>
									 		<table class="table table-bordered borderless">
									 			<tr>
									 				<th>{sponsor_name}</th>
									 				<td> Name of sponsor name </td>
									 			</tr>
									 			<tr>
									 				<th>{profile_photo}</th>
									 				<td>Sponsor profile image </td>
									 			</tr>
									 			<tr>
									 				<th>{sponsor_link}</th>
									 				<td> Sponsor referral link </td>
									 			</tr>
									 			<tr>
									 				<th>{fullname}</th>
									 				<td>User fullname </td>
									 			</tr>
									 			
									 		</table>
									 		<i><b>Note:</b> Please use above shortcodes during email template creation.</i>
									 	</div>
									 </div>	
										   <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Welcome Email Subject</label>
												<input type="text" class="form-control"  placeholder="Email Subject" name="email_subject"  value="{{ isset($setting->id)?$setting->email_subject:''}}"  required>
												
											</div>
										</div>	
								       <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Welcome Email Template Body</label>
												
												<textarea name="email_body" class="editor1" rows="10">{{ isset($setting->id)?$setting->email_body:''}}</textarea>
											</div>
										</div>	
									 <div class="col-md-12">
									 	<div class="form-group">
									 			<h4 class="nk-block-title page-title"   >Welcome Email shortcodes</h4>
									 		<table class="table table-bordered borderless">
									 			
									 			<tr>
									 				<th>{fullname}</th>
									 				<td>User fullname </td>
									 			</tr>
									 			<tr>
									 				<th>{email}</th>
									 				<td>User email </td>
									 			</tr>
									 			<tr>
									 				<th>{password}</th>
									 				<td>User login password </td>
									 			</tr>
									 		</table>
									 		<i><b>Note:</b> Please use above shortcodes during email template creation.</i>
									 	</div>
									 </div>		
										
									</div>
									<div class="clearfix"></div>	
									@if(permission_access('general_settings_edit')==1)
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="submit" class="btn btn-lg btn-primary" value="Update">
									</div>
									@endif
								</form>
								<?php 
								if(session()->has('success')){
								?>
								<script type="text/javascript">
								$(function(){
								swal({
									title: 'Success',
									text: "General settings successfully updated",
									type: 'success',
									showConfirmButton: false,
									showCancelButton: true,
									cancelButtonColor: '#d33',
									cancelButtonText: ' Ok',
								})
							})
							</script>
								<?php 
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>
<script type="text/javascript">
	 CKEDITOR.replace('email_body');
	 CKEDITOR.replace('invitation_email_body');
	 CKEDITOR.replace('success_page_message');
</script>
@endsection