@extends('layouts.admin') 
@section('content')


<div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head-content" style="margin-bottom:20px;">
									<h3 class="nk-block-title page-title">Ratings</h3>
									
								</div>
								<div class="nk-block">
									<div class="card card-bordered card-stretch">
										<div class="card-aside-wrap">
											<div class="card-inner card-inner-lg">
												<form id="">	
													<div class="row gy-4">
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label">Username</label>
																<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="4">
																	<option>John doe</option>
																	<option>Harry Pattrick</option>
																	<option>Test</option>
																	<option>test1</option>
																	<option>Test11</option>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label">Ratings</label>
																<input type="number" class="form-control">
																	
															</div>
														</div>
														
														
														<div class="col-md-12 text-center">
															<a href="#" class="btn btn-xs btn-primary">Save</a>
															
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
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
															<th class="nk-tb-col"><span class="sub-text">Email</span></th>
															<th class="nk-tb-col tb-col-lg"><span class="sub-text">Rating</span></th>
															<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
															
														</tr>
													</thead>
													<tbody>
														<?php 
										                  	foreach ($ratings as $rating) {
										                ?>
														<tr class="nk-tb-item">
															<td class="nk-tb-col">
																<span><?= $rating->first_name ?></span>
																
															</td>
															<td class="nk-tb-col">
																<span><?= $rating->last_name ?></span>
																
															</td>
															<td class="nk-tb-col">
																<span><?= $rating->email ?></span>
															</td>
															<td class="nk-tb-col tb-col-md">
																<span><?= $rating->rating ?></span>
															</td>
															<td class="nk-tb-col tb-col-md">
																<a href="" class="btn btn-xs btn-primary">Edit</a>
																<a href="#" class="btn btn-xs btn-primary">Delete</a>
															</td>
															
														</tr>
														<?php
															}
														?>														
													</tbody>
												</table>
											</div>
                                        </div>
                                    </div>
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>


@endsection