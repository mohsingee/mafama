@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:880px;">Access/Roles</h3>
					@if(permission_access('roles_add')==1)
					<a href="{{ url('add_access_roles') }}" class="btn btn-xs btn-primary" style="float:right;">Add New</a>
					@endif
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">First Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Last Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Email</span></th>
											<th class="nk-tb-col"><span class="sub-text">Password</span></th>
											<th class="nk-tb-col"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>test</span>
											</td>
											<td class="nk-tb-col">
												<span>test1</span>
											</td>
											<td class="nk-tb-col">
												<span>test1@gmail.com</span>
											</td>
											<td class="nk-tb-col">
												<span>12345</span>
											</td>
											<td class="nk-tb-col">
												@if(permission_access('roles_view')==1)
												<a href="view_access_roles" class="btn btn-xs btn-primary">View</a>
												@endif
												@if(permission_access('roles_edit')==1)
												<a href="add_access_roles" class="btn btn-xs btn-primary">Edit</a>
												@endif
												@if(permission_access('roles_delete')==1)
												<a href="#" class="btn btn-xs btn-primary">Delete</a>
												@endif
											</td>
											
										</tr><!-- .nk-tb-item  -->
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>test</span>
											</td>
											<td class="nk-tb-col">
												<span>test1</span>
											</td>
											<td class="nk-tb-col">
												<span>test1@gmail.com</span>
											</td>
											<td class="nk-tb-col">
												<span>12345</span>
											</td>
											<td class="nk-tb-col">
												<a href="view_access_roles.php" class="btn btn-xs btn-primary">View</a>
												<a href="add_access_roles.php" class="btn btn-xs btn-primary">Edit</a>
												<a href="#" class="btn btn-xs btn-primary">Delete</a>
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