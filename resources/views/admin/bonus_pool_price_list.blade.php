@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Bonus Pool Price Settings </h3>
					
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<div class="table-responsive1">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											
											<th class="nk-tb-col"><span class="sub-text">Bonus Level</span></th>
											<th class="nk-tb-col"><span class="sub-text">Pool Price</span></th>
											
											<th class="nk-tb-col"><span class="sub-text">Updated At</span></th>
											<th class="nk-tb-col"><span class="sub-text">Actions</span></th>
											
										</tr>
									</thead>
									<tbody>
										@php
										  $i=1;
										@endphp
								@if($bonuspoolprices->count()>0)		
									@foreach($bonuspoolprices as $bo)	
										<tr class="nk-tb-item">
											
											<td class="nk-tb-col">
												<span>Bonus {{ $bo->level }}</span>
											</td>
											<td class="nk-tb-col">
												<span><b>$</b>{{ number_format($bo->price,2) }}</span>
											</td>
											
											
											<td class="nk-tb-col">
												<span>{{date('m-d-Y h:i A',strtotime($bo->updated_at)) }}</span>
											</td>
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('bonus_pool_setup_edit')==1)
												<a href="{{ url('edit-bonus-pool-price/'.$bo->id) }}"  class="btn btn-sm btn-success ">Edit</a>
												@endif
												
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
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<br>
			<h3 class="nk-block-title page-title">Pool Price Reached </h3>
					
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<div class="table-responsive1">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											
											<th class="nk-tb-col"><span class="sub-text">Bonus 1 Price</span></th>
											<th class="nk-tb-col"><span class="sub-text">Bonus 2 Price</span></th>
											<th class="nk-tb-col"><span class="sub-text">Bonus 3 Price</span></th>
											<th class="nk-tb-col"><span class="sub-text">Bonus 4 Price</span></th>
											
										
											
										</tr>
									</thead>
									<tbody>
										@php
										  $i=1;
										@endphp
								@if($poolprices->count()>0)		
									@foreach($poolprices as $bo)	
										<tr class="nk-tb-item">
											
											<td class="nk-tb-col">
												<span> <b>$</b>{{ number_format($bo->bonus_one_price,2) }}</span>
											</td>
											<td class="nk-tb-col">
												<span><b>$</b>{{ number_format($bo->bonus_two_price,2) }}</span>
											</td>
											<td class="nk-tb-col">
												<span><b>$</b>{{ number_format($bo->bonus_three_price,2) }}</span>
											</td>
											
												<td class="nk-tb-col">
												<span><b>$</b>{{ number_format($bo->bonus_four_price,2) }}</span>
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