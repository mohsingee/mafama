@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:900px;">Move Leads To Baskets X</h3>
					<!--<a href="add_access_roles.php" class="btn btn-sm btn-primary" style="float:right;">Add New</a>-->
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<table class="datatable-init table">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th></th>
											<th>Start Date</th>
											<th>End Date</th>
											<th  scope="col" class="">System will take X<br> # of contacts <br>closest location</th>
											<th  scope="col" class="">From Categories All</th>
											<th  scope="col" class="">Place contacts<br> in basket X<br> of the user </th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<span>If Gold Signs-up</span>
											</td>
											<td>
												<span>12/10/2019</span>
											</td>
											<td>
												<span>12//04/2020</span>
											</td>
											<td>
												<span>4</span>
											</td>
											<td>
												<span>Flower, Tailor, All</span>
											</td>
											<td>
												<span>4</span>
											</td>
											
										</tr><!-- .nk-tb-item  -->
										<tr>
											<td>
												<span>If Silver Signs-up</span>
											</td>
											<td>
												<span>12/10/2019</span>
											</td>
											<td>
												<span>12//04/2020</span>
											</td>
											<td>
												<span>3</span>
											</td>
											<td>
												<span>Flower, Tailor, All</span>
											</td>
											<td>
												<span>3</span>
											</td>
											
										</tr><!-- .nk-tb-item  -->
										<tr>
											<td>
												<span>If Enterprise Signs-up</span>
											</td>
											<td>
												<span>12/10/2019</span>
											</td>
											<td>
												<span>12//04/2020</span>
											</td>
											<td>
												<span>3</span>
											</td>
											<td>
												<span>Flower, Tailor, All</span>
											</td>
											<td>
												<span>3</span>
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