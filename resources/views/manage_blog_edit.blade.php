@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Manage Professional Blogs</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('blog_update') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Blog Title</label>
												<input type="text" class="form-control" placeholder="" value="<?= $blog[0]->title ?>" name="title" required />
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-control-wrap">
												<label class="form-label" for="">Upload Image</label>
												<div class="custom-file">
													<input type="file" name="image" class="form-control custom-file-input" id="customFile">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
											
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Description</label>
												<textarea class="summernote form-control" placeholder="" rows="2" name="description" required ><?= $blog[0]->description ?></textarea>
											</div>
										</div>
										
										
										
										<div class="col-md-12 text-center">
											<input type="hidden" name="id" value="<?= $blog[0]->id ?>">
											<button type="submit" class="btn btn-sm btn-primary">Upload</button>
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