@extends('layouts.admin') 
@section('content')


<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Leads Categories</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="" action="{{ url('leads_category_update') }}" method="POST" enctype="multipart/form-data">	
								@csrf
									<input type="hidden" name="id" value="<?= $categories[0]->id ?>">
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Leads Category</label>
												<input type="text" class="form-control" placeholder="Category Name" name="category" value="<?= $categories[0]->category ?>" required>
												@if($errors->any())
													<p style="color: red">{{$errors->first()}}</p>
												@endif
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