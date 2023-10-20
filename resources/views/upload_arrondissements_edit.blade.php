@extends('layouts.admin') 
@section('content')


<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Arrondissements</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('arrondissements_upload_update') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf	
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Upload Arrondissement	</label>
												<div class="custom-file">
													<input type="file" name="image" class="custom-file-input" id="customFile" >
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Arrondissement Name</label>
												<select class="form-control" name="arrondissement_id">
												<?php
													$deptid = $uploads[0]->arrondissement_id;
													foreach($arrondissements as $value){
												?>
														<option value="<?= $value->id ?>" <?php if($value->id == $deptid){ ?> selected <?php } ?>><?= $value->arrondissement ?></option>
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