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
								<form action="{{ url('arrondissements_update') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf	
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="full-name">Arrondissement Name</label>
												<input type="text" class="form-control" name="arrondissement" placeholder="Arrondissement Name" value="<?= $arrondissements[0]->arrondissement ?>" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="display-name">Abbreviation</label>
												<input type="text" class="form-control" name="abbreviation" placeholder="Abbreviation" value="<?= $arrondissements[0]->abbreviation ?>" required>
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
															<option value="<?= $department->id ?>" <?php if($arrondissements[0]->department_id == $department->id){ ?> selected <?php } ?>><?= $department->department ?></option>
													<?php
														}
													?>
												</select>
											</div>
										</div>
										
										
										<div class="col-12">
											<input type="hidden" name="id" value="<?= $arrondissements[0]->id ?>">
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