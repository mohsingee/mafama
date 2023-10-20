@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Upload Categories Leads</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								@if(permission_access('upload_leads_add')==1)
								<form id="" action="{{ url('uploadleads_entry') }}" method="POST" enctype="multipart/form-data">	
								@csrf	
									<div class="row gy-4">
							<div class="col-md-12">
							
							    @if($errors->any())
								<p style="color: red">{{$errors->first()}}</p>
						     	@endif
							</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Upload File</label>
												<div class="custom-file">
													<input type="file" multiple="" class="custom-file-input" id="customFile" name="select_file" required>
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
					<div  class="panel panel-info mypanel">
                    <div class="panel-heading">
                    <span class="title elipsis">
                        <strong>Upload Categories Leads </strong>
                    </span>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger margin-bottom-30">
                            <h6><a href="{{ asset('public/excel/sample.xls') }}" target="_blank"><strong>Download </strong></a>Sample excel File</h6>
                            <ul>
                                <li>Download the sample xls file by clicking on above download link</li>
                                <li>Remove sample record if any and write your data in correct place</li>
                                <li>Then select the file for upload and click on import</li>
                            </ul>
                        </div>
                       
                    </div>
                </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Category Leads</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="category" required>
													<?php 
													foreach ($category as $value) {
													?>
													  	<option value="<?= $value->id ?>"><?= $value->category ?></option>
													<?php
													}
													?>
												</select>
												
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Category Description</label>
												<input type="text" class="form-control" name="description" required>
											</div>
										</div>
										
										<div class="col-12">
											<input type="submit" class="btn btn-sm btn-primary" value="Import">
										</div>
									</div>
								</form>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								@if(permission_access('upload_leads_delete')==1)
							   <a class="btn btn-sm btn-success pull-left move-into-basket" href="javascript:void(0)">Delete All </a>
							   @endif
							  
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col">
							               	 <label class="checkbox chk-sm" style="color: #da291c;">
                                             <input type="checkbox" value="1" id="select_all" />
                                            <i></i> 
                                        </label
											</th>
											<th class="nk-tb-col"><span class="sub-text">Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Email</span></th>
											<th class="nk-tb-col"><span class="sub-text">Cell Phone</span></th>
											<th class="nk-tb-col"><span class="sub-text">Company</span></th>
											<th class="nk-tb-col"><span class="sub-text">Address</span></th>
											<!--<th class="nk-tb-col"><span class="sub-text">City/Province</span></th>-->
											<!--<th class="nk-tb-col"><span class="sub-text">State</span></th>-->
											<!--<th class="nk-tb-col"><span class="sub-text">Zip Code</span></th>-->
											<!--<th class="nk-tb-col"><span class="sub-text">Country</span></th>-->
											<th class="nk-tb-col"><span class="sub-text">Category</span></th>
											<!--<th class="nk-tb-col"><span class="sub-text">Desc</span></th>-->
											
											
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
						                  	foreach ($popups as $popup) {
						                ?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
											  <label class="checkbox chk-sm" style="color: #da291c;">
                                            <input type="checkbox" value="<?= $popup->id ?>" class="select_one" />
                                            <i></i> 
                                        </label>
											</td>
											<td class="nk-tb-col">
												<span><?= $popup->first_name.' '.$popup->last_name ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $popup->email ?></span>
											</td>
											<td class="nk-tb-col">	<span><?= $popup->phone_no ?></span>	</td>
											<td class="nk-tb-col">	<span><?= $popup->company_name ?></span>	</td>
											<!--<td class="nk-tb-col">	<span><?= $popup->city ?></span>	</td>-->
											<!--<td class="nk-tb-col">	<span><?= $popup->state ?></span>	</td>-->
											<!--<td class="nk-tb-col">	<span><?= $popup->zipcode ?></span>	</td>-->
											<!--<td class="nk-tb-col">	<span><?= $popup->country ?></span>	</td>-->
											
										
											<td class="nk-tb-col">
												<span><?= $popup->address ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $popup->catname ?></span>
											</td>
											<!--<td class="nk-tb-col">-->
											<!--	<span><?= $popup->description ?></span>-->
											<!--</td>-->
										
											
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('upload_leads_view')==1)
												<a href="javascript:void(0)" class="btn btn-sm btn-info view_lead_user" data-id="{{ $popup->id }}">View</a>
												@endif
												@if(permission_access('upload_leads_edit')==1)
                       <a href="<?php echo url('edituploadleads') ?>/<?= $popup->id ?>" class="btn btn-sm btn-primary">Edit</a>
                       @endif
                       @if(permission_access('upload_leads_delete')==1)

												<a data-id="{{$popup->id }}" data-list="upload_leads" href="javascript:void(0)" class="btn btn-sm btn-success deleterow">Delete</a>
												@endif
											</td>
										</tr>
										<?php 
											$i++;
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