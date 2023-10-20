@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:880px;">Access/Roles</h3>
						@if(permission_access('admin_roles_add')==1)
					<a href="{{ url('admin/add-new-role') }}" class="btn btn-xs btn-primary" style="float:right;">Add New Role</a>
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
											<th class="nk-tb-col"><span class="sub-text">#ID</span></th>
											<th class="nk-tb-col"><span class="sub-text">Roles</span></th>										
											<th class="nk-tb-col"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										@if($roles->count() >0)
										 @foreach($roles as $role)
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>{{$role->id}}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{$role->admin_role}}</span>
											</td>
											
											
											<td class="nk-tb-col">
												@if(permission_access('admin_roles_edit')==1)
												<a href="{{ url('admin/add-new-role/'.$role->id) }}" class="btn btn-xs btn-primary">Edit</a>
												@endif
												
												@if(permission_access('admin_roles_delete')==1)
												<a data-id="{{$role->id }}" data-list="permission_accesses" href="javascript:void(0)" class="btn btn-xs btn-success deleterow">Delete</a>
												@endif
											</td>
											
										</tr><!-- .nk-tb-item  -->
										@endforeach
										@endif
										
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