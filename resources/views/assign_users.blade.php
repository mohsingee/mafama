@extends('layouts.admin') 
@section('content')


<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Assign Users</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('update_assign_users_conditions') }}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="row gy-4">
										<div class="col-md-2">
											<label class="form-label">Affiliates</label>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<input type="number" name="affiliate" required class="form-control" placeholder="8" value="{{$list->affiliate}}">
											</div>
										</div>
									</div>
									<div class="row gy-4">
										<div class="col-md-2">
											<label class="form-label">Enterprises Member</label>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<input type="number" name="enterprises" required class="form-control"  placeholder="5"  value="{{$list->enterprises}}">
											</div>
										</div>
									</div>
									<div class="row gy-4">
										<div class="col-md-2">
											<label class="form-label">Gold Member</label>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<input type="number" name="gold" required class="form-control"  placeholder="5"  value="{{$list->gold}}">
											</div>
										</div>
									</div>
									<div class="row gy-4">
										<div class="col-md-2">
											<label class="form-label">Silver Member</label>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<input type="number" name="silver" required class="form-control"  placeholder="3"  value="{{$list->silver}}">
											</div>
										</div>
									</div>
									<div class="row gy-4">	
										<div class="col-12">
											<button type="submit" class="btn btn-sm btn-primary">Save</button>
											
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