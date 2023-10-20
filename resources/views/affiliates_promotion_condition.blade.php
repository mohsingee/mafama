@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:900px;">Promotion Conditions</h3>
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
											<th>When Aff gets</th>
											<th  scope="col" class="">System will take X <br># of contacts <br> closest location</th>
											<th  scope="col" class="">From Categories All</th>
											<th  scope="col" class="">Place contacts <br>in the basket <br>of the Affiliate </th>
											<th>Then Aff Become</th>
											<th>Action</th>
											
										</tr>
									</thead>
									<tbody>
									@foreach($lists as $list)
										<tr>
											<td>
												<span> {{$list->received_lead}}</span>
											</td>
											<td>
												<span>{{$list->closest_contact}}</span>
											</td>
											<td>
												<span>{{ get_cat_name($list->lead_category)}}</span>
											</td>
											<td>
												<span>{{ get_basket_name($list->placed_basket)}}</span>
											</td>
											<td>
												<span>{{$list->assign_position}}</span>
											</td>
											<td>
												<a href="{{url('admin/promotion_condition/'.$list->id )}}" class="btn btn-sm btn-success">Edit</a>
											</td>
											
										</tr><!-- .nk-tb-item  -->
									@endforeach
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