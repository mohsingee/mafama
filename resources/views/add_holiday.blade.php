@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
    	<div class="card card-bordered card-stretch">
            <div class="card-aside-wrap">
				<div class="card-inner card-inner-lg">
					<form action="{{ url('front_holiday_entry') }}" method="POST" enctype="multipart/form-data">	
					@csrf
						<div class="row gy-4">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Holiday name</label>
									<input type="text" class="form-control" placeholder="Holiday Name" name="holiday" required>
									@if($errors->any())
										<p style="color: red">{{$errors->first()}}</p>
									@endif
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Date</label>
									<input type="date" class="form-control" placeholder="" name="date" required>
								</div>
							</div>
							
							<div class="col-md-12 text-center">
								<input type="submit" class="btn btn-sm btn-primary" value="Save">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>
</section>


@endsection