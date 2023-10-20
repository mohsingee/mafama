@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Manage Department</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('department_update') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Department Name	</label>
												<input type="text" name="department" class="form-control" placeholder="Department Name" value="<?= $departments[0]->department ?>" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Abbreviation	</label>
												<input type="text" name="abbreviation" class="form-control" placeholder="Abbreviation" value="<?= $departments[0]->abbreviation ?>" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Country	</label>
												<select id="countries_states1" class="form-control bfh-countries" data-country="<?= $departments[0]->country ?>" name="country" required></select>
											</div>
										</div>
										<div class="col-12">
											<input type="hidden" name="id" value="<?= $departments[0]->id ?>">
											<button type="submit" class="btn btn-lg btn-primary">Update</button>
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