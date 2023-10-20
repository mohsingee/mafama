@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Schedule Holiday</h3>
					
				</div><!-- .nk-block-head-content -->
				@if(permission_access('schedule_holiday_add')==1)
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('holiday_entry') }}" method="POST" enctype="multipart/form-data">	
								@csrf
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Holiday name</label>
												<input type="text" class="form-control" placeholder="Holiday Name" name="holiday" required>
												@if($errors->any())
													<p style="color: red">{{$errors->first()}}</p>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Date</label>
												<input type="date" class="form-control" placeholder="" name="date" required>
											</div>
										</div>
										
										<div class="col-12">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				@endif
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
											<th class="nk-tb-col"><span class="sub-text">Holiday</span></th>
											<th class="nk-tb-col"><span class="sub-text">Date</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
						                  	foreach ($holidays as $holiday) {
						                ?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span><?= $i ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $holiday->holiday ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $date = date('d F', strtotime($holiday->date)) ?></span>
											</td>
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('schedule_holiday_delete')==1) 
												<a href="<?php echo url('deleteholiday') ?>/<?= $holiday->id ?>" class="btn btn-sm btn-danger">Delete</a>
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
				</div>
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
</script>
@endsection