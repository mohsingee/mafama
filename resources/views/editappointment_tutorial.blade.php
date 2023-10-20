@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Appointment Tutorials</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="" action="{{ url('appointment_tutorials_update') }}" method="POST" enctype="multipart/form-data">	
									@csrf
									<input type="hidden" name="id" value="<?= $videos[0]->id ?>">
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Name</label>
												<input type="text" class="form-control" name="name" required value="<?= $videos[0]->name ?>" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Video</label>
												<div class="form-control-wrap">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="customFile" name="video">
														<label class="custom-file-label" for="customFile">Choose file</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-12">
											<input type="submit" class="btn btn-sm btn-primary" value="Update">
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