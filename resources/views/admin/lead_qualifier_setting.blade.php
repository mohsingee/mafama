@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Lead Qualifier Setting</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('lead-qualifier-setting-update') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">
										
										
									
										<div class="col-md-6">
										    
										
											<div class="form-group">
												<label class="form-label font-weight-bold	"><b>1.After Profile Pic Update No. Of Lead</b></label>
												<input type="text" class="form-control" placeholder="No. of lead" name="pro_pic_update_lead"  value="{{ isset($setting->id)?$setting->pro_pic_update_lead:0}}"  required>
											</div>
										</div>
										<div class="col-md-6">
										    	<label class="form-label font-weight-bold"><b>Default Lead Distributed Category </b></label>
											   <select  class="form-control select2"  name="default_category[]" multiple>
											       <option value=''>Select</option>
											       @if(!empty($lead_categories))
											       
											         @foreach($lead_categories as $cate)
											         
											       <option value="{{$cate->id}}" <?=isset($setting->id) && in_array($cate->id,explode(',',$setting->default_category))?'selected':'';?>>{{$cate->category}} ({{ \App\UploadLeads::total_leads($cate->id)}})</option>
											       
											          @endforeach
											       @endif
											   </select>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">
													<b>2.After Banner Update No. Of Lead</b>
												</label>
												<input type="text" class="form-control" placeholder="No. of lead" name="banner_update_lead"  value="{{ isset($setting->id)?$setting->banner_update_lead:0}}"  required>
												
											</div>
										</div>
										<div class="col-md-6">
										    
										</div>
										<div class="col-md-12">						
										<b>3.For Team Network Leads </b>	
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">For total team network size</label>
												<input type="text" class="form-control" placeholder="No. of team size" name="team_network"  value="{{ isset($setting->id)?$setting->team_network:0}}"  required>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">For direct sponsor</label>
												<input type="text" class="form-control" placeholder="No. of direct sponsor" name="direct_sponsor"  value="{{ isset($setting->id)?$setting->direct_sponsor:0}}"  required>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">For no. of paid users</label>
												<input type="text" class="form-control" placeholder="No. of paid users" name="paid_users"  value="{{ isset($setting->id)?$setting->paid_users:0}}"  required>
												
											</div>
										</div>
                                      <div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Team network leads</label>
												<input type="text" class="form-control" placeholder="No. of leads" name="team_network_leads"  value="{{ isset($setting->id)?$setting->team_network_leads:0}}"  required>
												
											</div>
										</div>
										<div class="col-md-8"></div>
                                    <div class="col-md-6">
											<div class="form-group">
												<label class="form-label">
													<b>4. No. of sending invitation emails</b></label>
												<input type="text" class="form-control" placeholder="No. of invitations emails" name="sending_email"  value="{{ isset($setting->id)?$setting->sending_email:0}}"  required>
												
											</div>
										</div>  
								 <div class="col-md-6">
								 	<div class="form-group">
												<label class="form-label"> Invitation email leads</label>
												<input type="text" class="form-control" placeholder="No. of lead" name="invites_leads"  value="{{ isset($setting->id)?$setting->invites_leads:0}}"  required>
												
											</div>
								 </div>
								 <div class="col-md-6">
											<div class="form-group">
												<label class="form-label">
													<b>5.No. of times affiliate takes video training</b>
												</label>
												<input type="text" class="form-control" placeholder="No. of times" name="no_of_times_training"  value="{{ isset($setting->id)?$setting->no_of_times_training:0}}"  required>
												
											</div>
										</div>  
									 <div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Video training taken by affiliate within x days </label>
												<input type="text" class="form-control" placeholder="No. of days" name="training_taken_days"  value="{{ isset($setting->id)?$setting->training_taken_days:0}}"  required>
												
											</div>
										</div>  	     	
	                                	 <div class="col-md-4">
											<div class="form-group">
												<label class="form-label">No. of leads for video training </label>
												<input type="text" class="form-control" placeholder="No. of leads" name="training_leads"  value="{{ isset($setting->id)?$setting->training_leads:0}}"  required>
												
											</div>
										</div> 
										
									</div>
									<div class="clearfix"></div>	
									
									@if(permission_access('lead_qualifier_edit')==1)
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