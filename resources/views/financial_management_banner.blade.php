@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Financial Management Banner</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								@if(permission_access('financial_mgmt_add')==1)
								<form id="" action="{{ url('financial_management_banner_entry') }}" method="POST" enctype="multipart/form-data">	
									@csrf
									<div class="row gy-4">
										<div class="col-md-1">
											<div class="custom-control custom-control-lg custom-checkbox">
												<input type="checkbox" name="status" class="custom-control-input" id="customCheck46" value="on">
												<label class="custom-control-label" for="customCheck46"></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-control-wrap">
												<div class="custom-file">
													<input type="file" name="image" class="form-control custom-file-input" id="customFileim" reqiured>
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												@if($errors->any())
												<span style="color: red">{{$errors->first()}}</span>
												@endif
												<p>*Recommended: .jpg/.jpeg/.png(1280 x 720 px) </p>
											</div>
											<div style="margin-top:10px; text-align: right;">
												<img src="" style="width:100%;height:200px;display: none;" id="blah">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<input type="text" class="form-control date-picker" placeholder="Start Date" value="" name="startdate" autocomplete="off" required />
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<input type="text" class="form-control date-picker" placeholder="End Date" value="" name="enddate" autocomplete="off" required />
											</div>
										</div>
										
										<div class="col-md-1">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
										</div>
									</div>
								</form>
								<form action="{{ url('banner_paytime') }}" method="POST">
									@csrf
									<div class="row gy-4" style="padding-top:30px;">
										<div class="col-md-3">
											<div class="form-group">
												<label>Play time (seconds)</label>
												<input type="number" class="form-control" placeholder="" name="playtime" value="<?= $playtime[0]->playtime/100 ?>" />
											</div>
										</div>
										<div class="col-md-1" style="margin-top:40px;">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
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
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Id</span></th>
											<th class="nk-tb-col"><span class="sub-text">Banner</span></th>
											<th class="nk-tb-col"><span class="sub-text">Start Date</span></th>
											<th class="nk-tb-col"><span class="sub-text">End Date</span></th>
											<th class="nk-tb-col"><span class="sub-text">Slide On/Off</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
						                  	foreach ($banners as $banner) {
						                ?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span><?= $i ?></span>
											</td>
											<td class="nk-tb-col">
												<img src="<?php echo asset("public/images") ?>/<?= $banner->image ?>" style="width:300px;height:120px;">
											</td>
											<td class="nk-tb-col">
												<?= date('d M Y', strtotime($banner->startdate)) ?>
											</td>
											<td class="nk-tb-col">
												<?= date('d M Y', strtotime($banner->enddate)) ?>
											</td>
											<td class="nk-tb-col">
												<?= $banner->status ?>
											</td>
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('financial_mgmt_edit')==1)
												<a href="<?php echo url('editfinancial_management_banner') ?>/<?= $banner->id ?>" class="btn btn-sm btn-primary">Edit</a>
												@endif
												@if(permission_access('financial_mgmt_delete')==1)
												<a href="<?php echo url('deletefinancial_management_banner') ?>/<?= $banner->id ?>" class="btn btn-sm btn-danger">Delete</a>
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
<script type="text/javascript">
	function readURL(input) {
	  	if(input.files && input.files[0]) {
		    var reader = new FileReader();
		    
		    reader.onload = function(e) {
		    	$('#blah').show();
			    $('#blah').attr('src', e.target.result);
		    }
		    
		    reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}
	$("#customFileim").change(function() {
	  readURL(this);
	});
</script>
@endsection