@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Arrondissements</h3>
					
				</div><!-- .nk-block-head-content -->
				@if(permission_access('create_arrondissements_add')==1)
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('arrondissements_entry') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf	
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="full-name">Arrondissement Name</label>
												<input type="text" class="form-control" name="arrondissement" placeholder="Arrondissement Name" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="display-name">Abbreviation</label>
												<input type="text" class="form-control" name="abbreviation" placeholder="Abbreviation" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="phone-no">Department</label>
												<select class="form-control" name="department_id" required>
													<?php 
														foreach ($departments as $department) 
														{
													?>
															<option value="<?= $department->id ?>"><?= $department->department ?></option>
													<?php
														}
													?>
												</select>
											</div>
										</div>
										
										
										<div class="col-12">
											<button type="submit" class="btn btn-lg btn-primary">Save</button>
											
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				@endif
				<div class="nk-block" id="myGroup" >
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">

							</div>
							<div class="card-inner">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Id</span></th>
											<th class="nk-tb-col"><span class="sub-text">Department Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Abbreviation</span></th>
											<th class="nk-tb-col"><span class="sub-text">Country</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>

										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											foreach ($departments as $department) {
										?>
												<tr class="nk-tb-item collapser " data-toggle="collapse" data-id="<?= $department->id ?>" data-target="#colse<?= $department->id ?>" data-parent="#myGroup" >
													<td class="nk-tb-col">
														<span><?= $i ?></span>
													</td>
													<td class="nk-tb-col">
														<span><?= $department->department ?></span>
													</td>
													<td class="nk-tb-col">
														<span><?= $department->abbreviation ?></span>
													</td>
													<td class="nk-tb-col">
														<span><?= $department->country ?></span>
													</td>
													<td class="nk-tb-col tb-col-md">
														@if(permission_access('create_department_edit')==1)
														<a href="{{ url('edit_manage_department') }}/<?= $department->id ?>" class="btn btn-sm btn-success">Edit</a>
														@endif
														@if(permission_access('create_department_delete')==1)
														<a href="{{ url('delete_manage_department') }}/<?= $department->id ?>" class="btn btn-sm btn-danger">Delete</a>
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

                        <?php
							$i = 1;
							foreach ($departments as $department) {
							?>
							<div class="card-inner collapse " id="colse<?= $department->id ?>">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Arrondissements Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Abbreviation</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php
										$arrond=arrondissements_by_dept($department->id);
											foreach ($arrond as $value) {
										?>
												<tr class="nk-tb-item">
													<td class="nk-tb-col">
														<span><?= $value->arrondissement ?></span>
														
													</td>
													<td class="nk-tb-col">
														<span><?= $value->abbreviation ?></span>
													</td>
													<td class="nk-tb-col tb-col-md">
														@if(permission_access('create_arrondissements_edit')==1)
														<a href="{{ url('arrondissements_edit') }}/<?= $value->id ?>" class="btn btn-sm btn-success">Edit</a>
														@endif
														@if(permission_access('create_arrondissements_delete')==1)
														<a href="{{ url('arrondissements_delete') }}/<?= $value->id ?>" class="btn btn-sm btn-danger">Delete</a>
														@endif
													</td>
												</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
						<?php } ?>
						</div><!-- .card-inner-group -->
					</div><!-- .card -->
				</div><!-- .nk-block -->
				



				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).on('click','.collapser',function(){
  var div=$(this).attr('data-id');
  $('.show').hide();
  $("#colse"+div).show();
});
</script>
@endsection