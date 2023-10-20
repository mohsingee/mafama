@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Upload Categories Script</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="" action="{{ url('uploadscript_update') }}" method="POST" enctype="multipart/form-data">	
								@csrf	
									<input type="hidden" name="id" value="<?= $popups[0]->id ?>">
									<div class="row gy-4">
										<!-- <div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Upload Category</label>
												<div class="custom-file">
													<input type="file" multiple="" class="custom-file-input" id="customFile" name="image">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
										</div> -->
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Category Script</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="category" required>
													<?php 
													foreach ($category as $value) {
													?>
													  	<option <?php if($popups[0]->category == $value->category){ ?> selected <?php } ?> value="<?= $value->category ?>"><?= $value->category ?></option>
													<?php
													}
													?>
													<?php 
													foreach ($bcategory as $value) {	?>
													  	<option <?php if($popups[0]->category == $value->category){ ?> selected <?php } ?> value="<?= $value->category ?>"><?= $value->category ?></option>
											
													<?php
													}
													?>
												</select>
												<input type="hidden" name="prevcat" value="<?= $popups[0]->category ?>">
												@if($errors->any())
													<p style="color: red">{{$errors->first()}}</p>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Category Description</label>
												<input type="text" class="form-control" name="description" value="<?= $popups[0]->description ?>" required>
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
			</div>
		</div>
	</div>
</div>


@endsection