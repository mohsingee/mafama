@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Manage Communes</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('communes_upload_update') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf	
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Upload Communes</label>
												<div class="custom-file">
													<input type="file" name="image" class="custom-file-input" id="customFile" >
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Commune Name	</label>
												<select class="form-control" name="communes_id">
												<?php
													foreach($comunes as $value){
												?>
														<option value="<?= $value->id ?>" <?php if($value->id == $uploads[0]->communes_id){ ?> selected <?php } ?>><?= $value->commune ?></option>
												<?php
													}
												?>
												</select>
											</div>
										</div>
										<div class="col-12">
											<input type="hidden" name="id" value="<?= $uploads[0]->id ?>">
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