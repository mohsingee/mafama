@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Revenue Account</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="" action="{{ url('upload_financial_template_update') }}" method="POST" enctype="multipart/form-data">	
									@csrf	
									<input type="hidden" name="id" value="{{ $templates->id }}">
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Category</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="category" required>
													<?php 
													foreach ($categories as $value) {
													?>
													  	<option value="<?= $value->id ?>" @if($value->id == $templates->category) selected @endif><?= $value->category ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
	                                        <div class="form-group">
	                                            <label class="form-label">Account Name</label>
	                                            <input type="text" class="form-control" name="account_name" id="revenue_account_name" value="{{ $templates->account_name }}" />
	                                        </div>
	                                    </div>
	                                    <!-- <div class="col-md-3">
	                                        <div class="form-group">
	                                            <label class="form-label">Default Amount (optional)</label>
	                                            <input type="text" class="form-control" name="amount" id="revenue_amount" value="{{ $templates->amount }}" />
	                                        </div>
	                                    </div> -->
										  <input type="hidden" class="form-control" name="amount" id="revenue_amount" value="{{ $templates->amount }}" />
										<div class="col-12">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
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