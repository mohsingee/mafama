@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"  style="width:980px;">Enterprise Profile
								<a href="add_enterprise_profile.php" class="btn btn-sm btn-primary" style="float:right;">Add New</a>
							</h3>
                            
                        </div><!-- .nk-block-head-content -->
                        
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
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
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Email</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Company Name</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
											
										</tr>
									</thead>
									<tbody>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>John</span>
												
											</td>
											<td class="nk-tb-col">
												<span>Deo</span>
												
											</td>
											<td class="nk-tb-col tb-col-md">
												<span>john11@gmail.com</span>
											</td>
											<td class="nk-tb-col tb-col-md">
												<span>Austrilla</span>
											</td>
											<td class="nk-tb-col tb-col-md">
												<span>XYZ</span>
											</td>
											<td class="nk-tb-col tb-col-md">
												<a href="view_enterprise_profile.php" class="btn btn-xs btn-primary">View</a>
												<a href="add_enterprise_profile.php" class="btn btn-xs btn-primary">Edit</a>
												<a href="#" class="btn btn-xs btn-primary">Delete</a>
											</td>
											
											
										</tr><!-- .nk-tb-item  -->
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>Harry</span>
												
											</td>
											<td class="nk-tb-col">
												<span>Pattrick</span>
												
											</td>
											<td class="nk-tb-col tb-col-md">
												<span>harry11@gmail.com</span>
											</td>
											<td class="nk-tb-col tb-col-md">
												<span>Austrilla</span>
											</td>
											<td class="nk-tb-col tb-col-md">
												<span>XYZ</span>
											</td>
											<td class="nk-tb-col tb-col-md">
												<a href="view_enterprise_profile.php" class="btn btn-xs btn-primary">View</a>
												<a href="add_enterprise_profile.php" class="btn btn-xs btn-primary">Edit</a>
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