@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:900px;">Basket Leads Rotation</h3>
					<!--<a href="add_access_roles.php" class="btn btn-sm btn-primary" style="float:right;">Add New</a>-->
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<div class="table-responsive">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead  class="thead-light">
										<tr  class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text"></th>
											<th class="nk-tb-col"><span class="sub-text">Every X # of Days </th>
											<th class="nk-tb-col"><span class="sub-text">System will take all contacts from basket</th>
											<th class="nk-tb-col"><span class="sub-text">From all uplines</th>
											<th class="nk-tb-col"><span class="sub-text">Lower Level</th>
											<th class="nk-tb-col"><span class="sub-text">Qualification 1 (affiliate active for x days) </th>
											<th class="nk-tb-col"><span class="sub-text">Qualification 2 (affiliate total points) </th>
											<th class="nk-tb-col"><span class="sub-text">Qualification 3 (maintain x # of affiliates) </th>
											<th class="nk-tb-col"><span class="sub-text">Notifications </th>
											<th class="nk-tb-col"><span class="sub-text">Action </th>	
											
										</tr>
									</thead>
									<tbody>
										@if(!empty($settings))

										@foreach($settings as $basket)
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>Affiliates</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $basket->term_days }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $basket->basket_id }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $basket->all_downlines }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $basket->lower_level }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $basket->qualification1 }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $basket->qualification2 }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $basket->qualification3 }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $basket->notification }}</span>
											</td>
											<td class="nk-tb-col">
												<a href="{{ url('basket-rotation/'.$basket->id) }}" class="btn btn-xs btn-success">Edit</a>
											</td>
											
										</tr><!-- .nk-tb-item  -->

										@endforeach
										@endif
										
										
									</tbody>
								</table>
								</div>
							</div>
						</div><!-- .card-inner-group -->
					</div><!-- .card -->
				</div><!-- .nk-block -->
				
				
				
			</div>
		</div>
	</div>
</div>

@endsection