@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Financial Templates</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<h4>Revenue Account</h4>
							@if(permission_access('templates_financial_add')==1)
								<form id="" action="{{ url('upload_financial_template_entry') }}" method="POST" enctype="multipart/form-data">	
									@csrf	
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Category</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="category" required>
													<?php 
													foreach ($categories as $value) {
													?>
													  	<option value="<?= $value->id ?>"><?= $value->category ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
	                                        <div class="form-group">
	                                            <label class="form-label">Account Name</label>
	                                            <input type="text" class="form-control" name="account_name" id="revenue_account_name" />
	                                        </div>
	                                    </div>
	                                   <!--  <div class="col-md-3">
	                                        <div class="form-group">
	                                            <label class="form-label">Default Amount (optional)</label>
	                                            <input type="text" class="form-control" name="amount" id="revenue_amount" />
	                                        </div>
	                                    </div> -->
	                                    <input type="hidden" class="form-control" name="amount" id="revenue_amount" />
										
										<div class="col-12">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
										</div>
									</div>
								</form>
								@endif
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Id</span></th>
											<th class="nk-tb-col"><span class="sub-text">Category</span></th>
											<th class="nk-tb-col"><span class="sub-text">Revenue Account</span></th>
											<!-- <th class="nk-tb-col"><span class="sub-text">Amount</span></th> -->
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
						                  	foreach ($templates as $template) {
						                ?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span><?= $i ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $template->category_name ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $template->account_name ?></span>
											</td>
											<!-- <td class="nk-tb-col">
												<span>{{ $template->amount }}</span>
											</td> -->
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('templates_financial_edit')==1)
												<a href="<?php echo url('editupload_financial_template') ?>/<?= $template->rid ?>" class="btn btn-sm btn-primary">Edit</a>
												@endif
												@if(permission_access('templates_financial_delete')==1)
												<a href="<?php echo url('deleteupload_financial_template') ?>/<?= $template->rid ?>" class="btn btn-sm btn-danger">Delete</a>
												@endif
											</td>
										</tr>
										<?php 
											$i++;
											} 
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="card-inner card-inner-lg">
								<h4>Expense Account</h4>
								@if(permission_access('templates_financial_add')==1)
								<form id="" action="{{ url('upload_financial_template_entry2') }}" method="POST" enctype="multipart/form-data">	
									@csrf	
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Category</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="category" required>
													<?php 
													foreach ($categories as $value) {
													?>
													  	<option value="<?= $value->id ?>"><?= $value->category ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
	                                        <div class="form-group">
	                                            <label class="form-label">Account Name</label>
	                                            <input type="text" class="form-control" name="account_name" id="revenue_account_name" />
	                                        </div>
	                                    </div>
	                                   <!--  <div class="col-md-3">
	                                        <div class="form-group">
	                                            <label class="form-label">Default Amount (optional)</label>
	                                            <input type="text" class="form-control" name="amount" id="revenue_amount" />
	                                        </div>
	                                    </div> -->
	                                    <input type="hidden" class="form-control" name="amount" id="revenue_amount" />
										
										<div class="col-12">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
										</div>
									</div>
								</form>
								@endif
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Id</span></th>
											<th class="nk-tb-col"><span class="sub-text">Category</span></th>
											<th class="nk-tb-col"><span class="sub-text">Revenue Account</span></th>
											<!-- <th class="nk-tb-col"><span class="sub-text">Amount</span></th> -->
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
						                  	foreach ($templates2 as $template) {
						                ?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span><?= $i ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $template->category_name ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $template->account_name ?></span>
											</td>
											<!-- <td class="nk-tb-col">
												<span>{{ $template->amount }}</span>
											</td> -->
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('templates_financial_edit')==1)
												<a href="<?php echo url('editupload_financial_template2') ?>/<?= $template->rid ?>" class="btn btn-sm btn-primary">Edit</a>
												@endif
												@if(permission_access('templates_financial_delete')==1)
												<a href="<?php echo url('deleteupload_financial_template2') ?>/<?= $template->rid ?>" class="btn btn-sm btn-danger">Delete</a>
												@endif
											</td>
										</tr>
										<?php 
											$i++;
											} 
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
</div>
@endsection