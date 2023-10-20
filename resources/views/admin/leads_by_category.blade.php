@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">{{ $category_name }} Category Leads</h3>
					
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
							  <!--  <a class="btn btn-sm btn-success pull-left move-into-basket" href="javascript:void(0)">Move Contact Into Basket </a> -->
							  
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col">
							               	 Sr No.
											</th>
											<th class="nk-tb-col"><span class="sub-text">Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Email</span></th>
											<th class="nk-tb-col"><span class="sub-text">Cell Phone</span></th>
											<th class="nk-tb-col"><span class="sub-text">Company</span></th>
											<th class="nk-tb-col"><span class="sub-text">Address</span></th>
											
											<th class="nk-tb-col"><span class="sub-text">Category</span></th>
											
											
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
										if($leads->count()>0)
										{
											$i = 1;
						                  	foreach ($leads as $lead) {
						                ?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
											  <span><?= $i++ ?>.</span>
											</td>
											<td class="nk-tb-col">
												<span><?= $lead->first_name.' '.$lead->last_name ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $lead->email ?></span>
											</td>
											<td class="nk-tb-col">	<span><?= $lead->phone_no ?></span>	</td>
											<td class="nk-tb-col">	<span><?= $lead->company_name ?></span>	</td>
											
											
										
											<td class="nk-tb-col">
												<span><?= $lead->address ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $lead->catname ?></span>
											</td>
											
											
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('leads_category_view')==1)
												<a href="javascript:void(0)" class="btn btn-sm btn-info view_lead_user" data-id="{{ $lead->id }}">View</a>
												@endif
												@if(permission_access('leads_category_edit')==1)
                        <a href="<?php echo url('edituploadleads') ?>/<?= $lead->id ?>" class="btn btn-sm btn-primary">Edit</a>
                        @endif
                        @if(permission_access('leads_category_delete')==1)

													<a data-id="{{$lead->id }}" data-list="upload_leads" href="javascript:void(0)" class="btn btn-sm btn-success deleterow">Delete</a>
												@endif
											</td>
										</tr>
										<?php 
											
											} 
										}
										?>
									</tbody>
								</table>
							</div>
						</div><!-- .card-inner-group -->
					</div><!-- .card -->
				</div><!-- .nk-block -->
				
				
			</div>
		</div>
	</div>
</div>
<!-- Modal 1 -->
<div class="modal fade" id="basket_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose Basket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <form id="manageBasketForm" method="POST" enctype="multipart/form-data">	
								@csrf	
			<div class="col-md-12">
				<div class="form-group">
					<label class="form-label" for="">Basket</label>
					 <select name="basket_id" class="form-control" required="">
						<option value="">Select </option>
						@for($i=1;$i<=4;$i++)
						<option value="{{ $i }}" >Basket {{ $i }}</option>
						@endfor
					</select>
			
				</div>
			</div>
      </div>
       <div class="modal-footer">
        <input type="hidden" name="selected_user_ids" >   
        <button type="submit" class="btn btn-primary btn4">Move Now </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div> 
      </form>
    </div>
  </div>
</div>
<!-- Modal 2 -->
<div class="modal fade" id="user_lead_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="lead_user_details"></div>
      </div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
@endsection