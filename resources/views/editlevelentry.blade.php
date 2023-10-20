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
								<form action="{{ url('updatelevelentry') }}" method="POST" id="">	
									@csrf
									<input type="hidden" name="id" value="<?= $levels[0]->id ?>">
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level</label>
												<select class="form-control" name="level">
													<option value="1" <?php if ($levels[0]->level == 1) { ?> selected <?php } ?>>Level-1</option>
													<option value="2" <?php if ($levels[0]->level == 2) { ?> selected <?php } ?>>Level-2</option>
													<option value="3" <?php if ($levels[0]->level == 3) { ?> selected <?php } ?>>Level-3</option>
													<option value="4" <?php if ($levels[0]->level == 4) { ?> selected <?php } ?>>Level-4</option>
													<option value="5" <?php if ($levels[0]->level == 5) { ?> selected <?php } ?>>Level-5</option>
													<option value="6" <?php if ($levels[0]->level == 6) { ?> selected <?php } ?>>Level-6</option>
													<option value="7" <?php if ($levels[0]->level == 7) { ?> selected <?php } ?>>Level-7</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Code Name</label>
												<input type="text" class="form-control" placeholder="Code Name" name="code_name" value="<?= $levels[0]->code_name ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Validation Start Date</label>
												<input  class="form-control date-picker" placeholder="Validation Start Date" name="vstart_date" value="<?= $levels[0]->vstart_date ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Validation End Date</label>
												<input class="form-control date-picker" placeholder="Validation End Date" name="vend_date" value="<?= $levels[0]->vend_date ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Validation Start Time</label>
												<input type="text"  class="form-control timepicker" placeholder="Validation Start Time" name="vstart_time" value="<?= $levels[0]->vstart_time ?>" autocomplete="off">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Validation End Time</label>
												<input type="text"  class="form-control timepicker" placeholder="Validation End Time" name="vend_time" value="<?= $levels[0]->vend_time ?>" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Fees</label>
												<input type="text" class="form-control" placeholder="Fees" name="fees" value="<?= $levels[0]->fees ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Fees Frequency</label>
												<select class="form-control" name="fees_frequency">
													<option value="monthly" <?php if ($levels[0]->fees_frequency == "monthly") { ?> selected <?php } ?>>Monthly</option>
													<option value="quarterly" <?php if ($levels[0]->fees_frequency == "quarterly") { ?> selected <?php } ?>>Quarterly</option>
													<option value="annually" <?php if ($levels[0]->fees_frequency == "annually") { ?> selected <?php } ?>>Annually</option>
													
												</select>
											</div>
										</div>
										
										<div class="col-12">
											<input type="submit" class="btn btn-lg btn-primary" value="Update">
										</div>
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