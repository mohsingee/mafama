@extends('layouts.admin') 
@section('content')

@php
 
 $levels=array(

            '1' =>'Bonus 1',
            '2' =>'Bonus 2',
            '3' =>'Bonus 3',
            '4' =>'Bonus 4',

         );

@endphp
<style>  
.borderless tr td, .borderless tr th {    
    text-align: left;    
}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Bonus Pool Price</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('edit_bonus_pool_price_post') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">
										
										
									
										<div class="col-md-6">
										    	<input type="hidden"  name="id" value="{{ isset($pool->id)?$pool->id:''}}" >
										
											<div class="form-group">
												<label class="form-label"> Bonus Level</label>
												<select class="form-control"  name="level">
													@foreach($levels as $key => $value)
                                                    <option value="{{$key}}" <?=isset($pool->id) && ($key==$pool->level)?'selected':'';?>>
                                                    {{ $value }} </option>
													@endforeach
												</select>
												
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Pool Price</label>
												<input type="text" class="form-control"  name="price"  value="{{ isset($pool->id)?$pool->price:''}}"  required>
												
											</div>
										</div>
                                     

								    
									
										
										
										
											
										
									</div>
									<div class="clearfix"></div>	
									
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="submit" class="btn btn-lg btn-primary" value="Update">
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