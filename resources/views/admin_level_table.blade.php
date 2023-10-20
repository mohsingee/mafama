@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Level Information  </h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								@if(permission_access('table_level_add')==1)
								<form action="{{ url('levelentry') }}" method="POST" id="">	
									@csrf
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level</label>
												<select class="form-control" name="level">
													<option value="1">Level-1</option>
													<option value="2">Level-2</option>
													<option value="3">Level-3</option>
													<option value="4">Level-4</option>
													<option value="5">Level-5</option>
													<option value="6">Level-6</option>
													<option value="7">Level-7</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Code Name</label>
												<input type="text" class="form-control" placeholder="Code Name" name="code_name">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Validation Start Date</label>
												<input  class="form-control date-picker" placeholder="Validation Start Date" name="vstart_date" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Validation End Date</label>
												<input class="form-control date-picker" placeholder="Validation End Date" name="vend_date" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Validation Start Time</label>
												<input type="text"  class="form-control timepicker" placeholder="Validation Start Time" name="vstart_time" autocomplete="off">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Validation End Time</label>
												<input type="text"  class="form-control timepicker" placeholder="Validation End Time" name="vend_time" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Fees</label>
												<input type="text" class="form-control" placeholder="Fees" name="fees">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Fees Frequency</label>
												<select class="form-control" name="fees_frequency">
													<option value="monthly">Monthly</option>
													<option value="quarterly">Quarterly</option>
													<option value="annually">Annually</option>
													
												</select>
											</div>
										</div>
										
										<div class="col-12">
											<input type="submit" class="btn btn-lg btn-primary" value="Save">
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
							
							<div class="card-inner">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Id</span></th>
											<th class="nk-tb-col"><span class="sub-text">Levels</span></th>
											<th class="nk-tb-col"><span class="sub-text">Code</span></th>
											<th class="nk-tb-col"><span class="sub-text">Created On</span></th>
											<th class="nk-tb-col"><span class="sub-text">Start Date</span></th>
											<th class="nk-tb-col"><span class="sub-text">End Date</span></th>
											<th class="nk-tb-col"><span class="sub-text">Start Time</span></th>
											<th class="nk-tb-col"><span class="sub-text">End Time</span></th>
											<th class="nk-tb-col"><span class="sub-text">Fees</span></th>
											<th class="nk-tb-col"><span class="sub-text">Fees Frequency</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
						                  	foreach ($levels as $level) {
						                ?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span><?= $i ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $level->level ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $level->code_name ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $level->created_at ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $level->vstart_date ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $level->vend_date ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $level->vstart_time ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $level->vend_time ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $level->fees ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $level->fees_frequency ?></span>
											</td>
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('table_level_edit')==1)
												<a href="<?php echo url('editlevelentry') ?>/<?= $level->id ?>" class="btn btn-sm btn-success">Edit</a>
												@endif
												@if(permission_access('table_level_delete')==1)
												<a href="<?php echo url('deletelevelentry') ?>/<?= $level->id ?>" class="btn btn-sm btn-danger">Delete</a>
												@endif
											</td>
											
											
										</tr>
										<?php
											}
										?>
										
										
									</tbody>
								</table>
								<div class="row" style="margin-top: 20px;">
									<div class="col-md-8">
										<h6>Hide or Show Affiliate button on Welcome screen</h6>
									</div>
									<div class="col-md-4">
									    <label class="radio-inline" style="margin-right: 10px">
									      <input type="radio" name="affiliatedisplay" <?php if($status[0]->affiliatedisplay == "on"){ ?>checked <?php } ?> style="margin-right: 10px" value="on">Show
									    </label>
									    <label class="radio-inline" style="margin-right: 10px">
									      <input type="radio" name="affiliatedisplay" style="margin-right: 10px" value="off" <?php if($status[0]->affiliatedisplay == "off"){ ?>checked <?php } ?>>Hide
									    </label>
									</div>
								</div>
							</div>
							
						</div><!-- .card-inner-group -->
					</div><!-- .card -->
				</div><!-- .nk-block -->
				
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("input[name='affiliatedisplay']").change(function(){
		var status = $("input[name='affiliatedisplay']:checked").val();
	    var url = "<?php echo url('/'); ?>/affiliatedisplay";
        $.ajax({
            url: url,
            data: 'status=' + status + '&_token={{ csrf_token() }}',
            type: "POST",
            success: function (data) {
            	alert("Succesfully "+data+" the affiliate registration button.");
            }
        });
	});
</script>
@endsection