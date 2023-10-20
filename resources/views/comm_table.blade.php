@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Commision Set up/ Commission Table  </h3>
					
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<div class="table-responsive">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Mthly Fee</span></th>
											<th class="nk-tb-col"><span class="sub-text">Mgmt Fee</span></th>
											<th class="nk-tb-col"><span class="sub-text">Bonus 1</span></th>
											<th class="nk-tb-col"><span class="sub-text">Bonus 2</span></th>
											<th class="nk-tb-col"><span class="sub-text">Bonus 3</span></th>
											<th class="nk-tb-col"><span class="sub-text">Bonus 4</span></th>
											<th class="nk-tb-col"><span class="sub-text">Prize</span></th>
											<th class="nk-tb-col"><span class="sub-text">Other</span></th>
											<th class="nk-tb-col"><span class="sub-text">Bal</span></th>
											<th class="nk-tb-col"><span class="sub-text">Sponser Affiliate Share</span></th>
											<th class="nk-tb-col"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
									@foreach($plans as $plan)	
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>{{ $plan->name }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $plan->monthly_fee }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $plan->management_fee }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $plan->bonus_one }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $plan->bonus_two }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $plan->bonus_three }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $plan->bonus_four }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $plan->prize }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $plan->other }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $plan->balance }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $plan->affiliate_share_price }}</span>
											</td>
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('commission_setup_edit')==1)
												<a href="{{url('plan/'.$plan->id )}} " class="btn btn-sm btn-success">Edit</a>
												@endif
												
											</td>
											
										</tr><!-- .nk-tb-item  -->
									@endforeach
										
										
									</tbody>
								</table>
							</div>
							</div>
						</div><!-- .card-inner-group -->
					</div><!-- .card -->
				</div><!-- .nk-block -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<div class="table-responsive">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Sponser Affiliate Share</span></th>
											<th class="nk-tb-col"><span class="sub-text">Level 2</span></th>
											<th class="nk-tb-col"><span class="sub-text">Level 3</span></th>
											<th class="nk-tb-col"><span class="sub-text">Level 4</span></th>
											<th class="nk-tb-col"><span class="sub-text">Level 5</span></th>
											<th class="nk-tb-col"><span class="sub-text">Level 6</span></th>
											
											<!--// software developer Ravi coding start rollback -->

											<th class="nk-tb-col"><span class="sub-text">Level 7</span></th>
											<th class="nk-tb-col"><span class="sub-text">Level 8</span></th>
											<th class="nk-tb-col"><span class="sub-text">Level 9</span></th>
											<th class="nk-tb-col"><span class="sub-text">Level 10</span></th>
											<th class="nk-tb-col"><span class="sub-text">Level 11</span></th>
											<th class="nk-tb-col"><span class="sub-text">Level 12</span></th>
											<!--// software developer Ravi coding end rollback -->

											<!--<th class="nk-tb-col"><span class="sub-text">Action</span></th>-->

											
										</tr>
									</thead>
									<tbody>
									@foreach($plans as $plan)
								
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>{{ $plan->name }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $plan->affiliate_share_price}}</span>
											</td>
	                                            <!--// software developer Ravi coding start 9660813935-->
	                                            
	                                            <!--	@for($i=2;$i<=12;$i++)
                                              <td class="nk-tb-col">
												<span>{{ round($plan->affiliate_share_price/$i,2) }}</span>
											</td>
											@endfor-->
											
											@for($i=2;$i<=12;$i++)
                                              <td class="nk-tb-col">
												<span>{{ round($plan->affiliate_share_price/$i,2) }}</span>
											</td>
											@endfor
												<!--// software developer Ravi coding end 9660813935-->
										</tr><!-- .nk-tb-item  -->
										
										@endforeach
@foreach($levels as $level)
										<!--
											<td class="nk-tb-col">
												<span>{{ $level->level_2 }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $level->level_3 }}</span>
											</td>
											<td class="nk-tb-col">
											<span>{{ $level->level_4 }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $level->level_5 }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $level->level_6 }}</span>
											</td>
											<td class="nk-tb-col">
											<span>{{ $level->level_7 }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $level->level_8 }}</span>
											</td>
											<td class="nk-tb-col">
											<span>{{ $level->level_9 }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $level->level_10 }}</span>
											</td>
											<td class="nk-tb-col">
											<span>{{ $level->level_11 }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $level->level_12 }}</span>
											</td>--->
											<!---
											<td class="nk-tb-col tb-col-md">
												<a href="{{url('level-income/'.$level->id )}} " class="btn btn-sm btn-success">Edit</a>

											</td>---->

										@endforeach
										
										
										
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