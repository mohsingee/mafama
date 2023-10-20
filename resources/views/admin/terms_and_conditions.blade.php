@extends('layouts.admin') 
@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />
<style>
  
.borderless tr td, .borderless tr th {
    
    text-align: left;
    
}
h6.nk-block-title.page-title {
    font-size: 16px;
}
.borderless tr td, .borderless tr th {
    padding-bottom: 0px!important;
    padding-top: 8px !important;
}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Terms and Conditions</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('update_term_condition') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">
										
																				
										
                                    
								       <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Terms and Conditions</label>
												
												<textarea name="terms" class="editor1" rows="10">{{$terms->terms}}</textarea>
											</div>
										</div>	
											
										
									</div>
									<div class="clearfix"></div>	
									
									@if(permission_access('terms_edit')==1)
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="submit" class="btn btn-lg btn-primary" value="Update">
									</div>
									@endif
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>
<script type="text/javascript">
	 CKEDITOR.replace('terms');
	 //CKEDITOR.replace('comm_message');
</script>
@endsection