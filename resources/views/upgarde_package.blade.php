@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Upgrade Package</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="">	
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Package Name</label>
												<input type="text" class="form-control" placeholder="Package Name">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Plan Info</label>
												<input type="text" class="form-control" placeholder="Plan Info">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Package Price</label>
												<input type="text" class="form-control" placeholder="Package Price">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Price Info</label>
												<input type="text" class="form-control" placeholder="Price Info">
											</div>
										</div>
										
										
										<div class="col-12">
											<a href="#" class="btn btn-lg btn-primary">Save</a>
											
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Id</span></th>
											<th class="nk-tb-col"><span class="sub-text">Package Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Plan Info</span></th>
											<th class="nk-tb-col"><span class="sub-text">Package Price</span></th>
											<th class="nk-tb-col"><span class="sub-text">Price Info</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>1</span>
											</td>
											<td class="nk-tb-col">
												<span>Affilate</span>
												
											</td>
											<td class="nk-tb-col">
												<span>If you are a small business amn please select this plan</span>
												
											</td>
											<td class="nk-tb-col">
												<span>$799</span>
												
											</td>
											<td class="nk-tb-col">
												<span>20 User, Billed Yearly</span>
												
											</td>
											<td class="nk-tb-col tb-col-md">
												<a href="upgarde_package.php" class="btn btn-sm btn-success">Edit</a>
												<a href="#" class="btn btn-sm btn-danger">Delete</a>
											</td>
											
											
										</tr><!-- .nk-tb-item  -->
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>2</span>
											</td>
											<td class="nk-tb-col">
												<span>Gold</span>
												
											</td>
											<td class="nk-tb-col">
												<span>If you are a small business amn please select this plan</span>
												
											</td>
											<td class="nk-tb-col">
												<span>$599</span>
												
											</td>
											<td class="nk-tb-col">
												<span>20 User, Billed Yearly</span>
												
											</td>
											<td class="nk-tb-col tb-col-md">
												<a href="upgarde_package.php" class="btn btn-sm btn-success">Edit</a>
												<a href="#" class="btn btn-sm btn-danger">Delete</a>
											</td>
											
											
										</tr><!-- .nk-tb-item  -->
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>3</span>
											</td>
											<td class="nk-tb-col">
												<span>Silver</span>
												
											</td>
											<td class="nk-tb-col">
												<span>If you are a small business amn please select this plan</span>
												
											</td>
											<td class="nk-tb-col">
												<span>$299</span>
												
											</td>
											<td class="nk-tb-col">
												<span>5 User, Billed Yearly</span>
												
											</td>
											<td class="nk-tb-col tb-col-md">
												<a href="upgarde_package.php" class="btn btn-sm btn-success">Edit</a>
												<a href="#" class="btn btn-sm btn-danger">Delete</a>
											</td>
											
											
										</tr><!-- .nk-tb-item  -->
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>4</span>
											</td>
											<td class="nk-tb-col">
												<span>Enterprises</span>
												
											</td>
											<td class="nk-tb-col">
												<span>If you are a small business amn please select this plan</span>
												
											</td>
											<td class="nk-tb-col">
												<span>$99</span>
												
											</td>
											<td class="nk-tb-col">
												<span>1 User, Billed Yearly</span>
												
											</td>
											<td class="nk-tb-col tb-col-md">
												<a href="upgarde_package.php" class="btn btn-sm btn-success">Edit</a>
												<a href="#" class="btn btn-sm btn-danger">Delete</a>
											</td>
											
											
										</tr><!-- .nk-tb-item  -->
										
										
									</tbody>
								</table>
							</div>
						</div><!-- .card-inner-group -->
					</div><!-- .card -->
				</div><!-- .nk-block -->
				
				
			</div>
		</div>
	</div>
</div>

@endsection