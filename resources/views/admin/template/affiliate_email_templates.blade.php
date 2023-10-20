@extends('layouts.admin') 
@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />
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
						<h3 class="nk-block-title page-title"   style="width:935px;">Email Template </h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('update_affiliate_template') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">
										
																				
										
                                      <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Commission Email Subject</label>
												<input type="text" class="form-control"  name="comm_subject"  value="{{ isset($template->id)?$template->comm_subject:''}}"  required>
												
											</div>
										</div>	
								       <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Commission Email Template Message</label>
												
												<textarea name="comm_message" class="editor1" rows="10">{{ isset($template->id)?$template->comm_message:''}}</textarea>
											</div>
										</div>	
                                      <div class="col-md-12">
									 	<div class="form-group">
									 			<h6 class="nk-block-title page-title"   >Commission Email  shortcodes</h6>
									 		<table class="table table-bordered borderless">
									 			<tr>
									 				<th>{sponsor_name}</th>
									 				<td>Sponsor name </td>
									 			</tr>
									 			<tr>
									 				<th>{affiliate_profile_photo}</th>
									 				<td> New joining affiliate profile Pic </td>
									 			</tr>
									 			<tr>
									 				<th>{affiliate_name}</th>
									 				<td>New affiliate name </td>
									 			</tr>
									 			<tr>
									 				<th>{levelname}</th>
									 				<td>Level Name </td>
									 			</tr>
									 			<tr>
									 				<th>{country}</th>
									 				<td>Country Name </td>
									 			</tr>
									 			<tr>
									 				<th>{state}</th>
									 				<td>State/Province </td>
									 			</tr>
									 			<tr>
									 				<th> {transaction_history_link}</th>
									 				<td>Commission page link </td>
									 			</tr>
									 			
									 		</table>
									 		<i><b>Note:</b> Please use above shortcodes during email template creation.</i>
									 	</div>
									 </div>	
									 <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">First Day Bonus Email Subject</label>
												<input type="text" class="form-control"  name="bonus_subject_day"  value="{{ isset($template->id)?$template->bonus_subject_day:''}}"  required>
												
											</div>
										</div>	
								       <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">First Day Bonus Email Template Message</label>
												
												<textarea name="bonus_message_day" class="editor1" rows="10">{{ isset($template->id)?$template->bonus_message_day:''}}</textarea>
											</div>
										</div>	
									
									    <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">First Quarter Bonus Email Subject</label>
												<input type="text" class="form-control"  name="bonus_subject_quarter"  value="{{ isset($template->id)?$template->bonus_subject_quarter:''}}"  required>
												
											</div>
										</div>	
								       <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">First Quarter Bonus Email Template Message</label>
												
												<textarea name="bonus_message_quarter" class="editor1" rows="10">{{ isset($template->id)?$template->bonus_message_quarter:''}}</textarea>
											</div>
										</div>	
									 
									    <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">First Day Prize Email Subject</label>
												<input type="text" class="form-control"  name="prize_subject_day"  value="{{ isset($template->id)?$template->prize_subject_day:''}}"  required>
												
											</div>
										</div>	
								       <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">First Day Prize Email Template Message</label>
												
												<textarea name="prize_message_day" class="editor1" rows="10">{{ isset($template->id)?$template->prize_message_day:''}}</textarea>
											</div>
										</div>	
									 
									    <div class="col-md-12">
											<div class="form-group">
												<label class="form-label"> First Qaurter Prize Email Subject</label>
												<input type="text" class="form-control"  name="prize_subject_quarter"  value="{{ isset($template->id)?$template->prize_subject_quarter:''}}"  required>
												
											</div>
										</div>	
								       <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">First Quarter Prize Email Template Message</label>
												
												<textarea name="prize_message_quarter" class="editor1" rows="10">{{ isset($template->id)?$template->prize_message_quarter:''}}</textarea>
											</div>
										</div>	
									 <div class="col-md-12">
									 	<div class="form-group">
									 			<h6 class="nk-block-title page-title"   >Email shortcodes</h6>
									 		<table class="table table-bordered borderless">
									 			
									 			<tr>
									 				<th>{affiliate_name}</th>
									 				<td> Affiliate name </td>
									 			</tr>
									 			
									 			<tr>
									 				<th>{producer_name1}</th>
									 				<td>Producer Name1 </td>
									 			</tr>
									 			<tr>
									 				<th>{producer_name2}</th>
									 				<td>Producer Name2 </td>
									 			</tr>
									 			<tr>
									 				<th>{producer_name3}</th>
									 				<td>Producer Name3 </td>
									 			</tr>
									 			<tr>
									 				<th>{producer_email1}</th>
									 				<td>Producer Email1 </td>
									 			</tr>
									 			<tr>
									 				<th>{producer_email2}</th>
									 				<td>Producer Email2 </td>
									 			</tr>
									 			<tr>
									 				<th>{producer_email3}</th>
									 				<td>Producer Email3 </td>
									 			</tr>
									 			<tr>
									 				<th>{producer_telephone1}</th>
									 				<td>Producer Telephone1 </td>
									 			</tr>
									 			<tr>
									 				<th>{producer_telephone2}</th>
									 				<td>Producer Telephone2 </td>
									 			</tr>
									 			<tr>
									 				<th>{producer_telephone3}</th>
									 				<td>Producer Telephone3 </td>
									 			</tr>
									 			<tr>
									 				<th> {transaction_history_link}</th>
									 				<td>Transaction history page link </td>
									 			</tr>
									 			<tr>
									 				<th> {bonus_time_period}</th>
									 				<td>ex.  (April-June), 20XX </td>
									 			</tr>
									 		</table>
									 		<i><b>Note:</b> Please use above shortcodes during email template creation.</i>
									 	</div>
									 </div>		
										
									</div>
									<div class="clearfix"></div>	
									
									@if(permission_access('aff_email_edit')==1)
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
<script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>
<script type="text/javascript">
	 CKEDITOR.replace('bonus_message_day');
	 CKEDITOR.replace('comm_message');
	 CKEDITOR.replace('bonus_message_quarter');
	 CKEDITOR.replace('prize_message_day');
	 CKEDITOR.replace('prize_message_quarter');
	 //CKEDITOR.replace('comm_message');
</script>
@endsection