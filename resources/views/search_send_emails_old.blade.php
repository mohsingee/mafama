@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Search & Send Emails</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="">	
									<div class="row gy-4">
										<div class="col-md-12">
											<h5>Search by personal information :</h5>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Name</label>
												<input type="text" class="form-control" placeholder="First 3 letter of name">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Email</label>
												<input type="text" class="form-control" placeholder="Enter email here">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Telephone</label>
												<input type="text" class="form-control" placeholder="Enter phone here">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label" for="">Religious Faith</label>
												<select class="form-control">
													<option>Protestantism</option>
													<option>Catholicism</option>
													<option>Hinduism</option>
													<option>Jainism</option>
													<option>Other</option>
													<option>None</option>
												</select>
											</div>
										</div>
										
										<div class="col-md-12 text-center">
											<a href="#" class="btn btn-sm btn-primary"  style="margin-top:25px;">Search</a>
											
										</div>
									</div>
								</form>
								<div class="clearfix"></div>	
								<div class="divider"><!-- divider --></div>	
								<form id="">		
									<div class="row gy-4">
										<div class="col-md-12">
											<h5>Search by :</h5>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck2">
													<label class="custom-control-label" for="customCheck2">Confirm Founder</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck1">
													<label class="custom-control-label" for="customCheck1">Elite Founder</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck02">
													<label class="custom-control-label" for="customCheck02">Gold Founder</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck03">
													<label class="custom-control-label" for="customCheck03">Executive Founder</label>
												</div>
												
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck04">
													<label class="custom-control-label" for="customCheck04">Silver Member</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck05">
													<label class="custom-control-label" for="customCheck05">Gold Member</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck06">
													<label class="custom-control-label" for="customCheck06">Enterprise</label>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="custom-control  custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck07">
													<label class="custom-control-label" for="customCheck07">Free Affilates</label>
												</div>
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Zip Code</label>
												<input type="text" class="form-control"  placeholder="">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> City </label>
												<input type="text" class="form-control"  placeholder="">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">State/Province</label>
												<select class="form-control form-select form-control-lg select2-hidden-accessible" data-search="on" data-select2-id="5" tabindex="-1" aria-hidden="true">
												  <option>Maharashtra</option>
												  <option>Punjab</option>
												  <option>Harayana</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Country</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="4">
												  <option>India</option>
												  <option>USA</option>
												  <option>Brazil</option>
												</select>
											</div>
										</div>
										
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Business Category</label>
												
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="3">
												  <option>Cat1</option>
												  <option>Cat2</option>
												  <option>Cat3</option>
												  
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> Affilate Level </label>
												<input type="text" class="form-control"  placeholder="">
											</div>
										</div>
										
										
										<div class="col-md-12 text-center">
											<a href="#" class="btn btn-sm btn-primary"  style="margin-top:25px;">Search</a>
											
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
											<th class="nk-tb-col"><span class="sub-text">Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Email</span></th>
											<th class="nk-tb-col"><span class="sub-text">Company</span></th>
											<th class="nk-tb-col"><span class="sub-text">Level</span></th>
											<th class="nk-tb-col"><span class="sub-text">Phone</span></th>
											<th class="nk-tb-col tb-col-lg">
												<!--<span class="sub-text">Send Mail</span>-->
												<div class="custom-control custom-control-sm custom-checkbox notext">
													<input type="checkbox" class="custom-control-input" id="uidAll">
													<label class="custom-control-label" for="uidAll">Select All</label>
												</div>
											
											</th>
											
										</tr>
									</thead>
									<tbody>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>ppp </span>
											</td>
											<td class="nk-tb-col">
												<span>ppp@aol.com </span>
											</td>
											<td class="nk-tb-col">
												<span>XYZ </span>
											</td>
											<td class="nk-tb-col">
												<span>2</span>
											</td>
											<td class="nk-tb-col">
												<span>654-3456-456</span>
												
											</td>
											<td class="nk-tb-col tb-col-md">
												<div class="custom-control custom-control-sm custom-checkbox notext">
													<input type="checkbox" class="custom-control-input" id="uid1">
													<label class="custom-control-label" for="uid1"></label>
												</div>
											</td>
											
											
										</tr><!-- .nk-tb-item  -->
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>test </span>
											</td>
											<td class="nk-tb-col">
												<span>test@gmail.com </span>
											</td>
											<td class="nk-tb-col">
												<span>XYZ </span>
											</td>
											<td class="nk-tb-col">
												<span>1 </span>
											</td>
											<td class="nk-tb-col">
												<span>768-6544-890 </span>
											</td>
											<td class="nk-tb-col tb-col-md">
												<div class="custom-control custom-control-sm custom-checkbox notext">
													<input type="checkbox" class="custom-control-input" id="uid2">
													<label class="custom-control-label" for="uid2"></label>
												</div>
											</td>
											
											
										</tr><!-- .nk-tb-item  -->
										
										
									</tbody>
								</table>
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
								<div class="row" style="border-bottom:2px solid #b71a0f; margin-bottom:10px;">
									<div class="col-md-2 text-center" ></div>
									<div class="col-md-8 text-center email-btn" style="" >
										<div class="col-md-12 " style="" >
											<div class="row">
												<div class="col-md-3 text-center " style="padding-right:5px;padding-left:0px;" >
													<a href="#" class="btn btn-xs btn-black"  style="margin-top:10px;margin-bottom:10px;width:100%;">Button1</a>
												</div>
												<div class="col-md-3 text-center " style="padding-left:0px;padding-right:5px;" >
													<a href="#" class="btn btn-xs btn-black"  style="margin-top:10px;margin-bottom:10px;width:100%;">Button2</a>
												</div>
												<div class="col-md-3 text-center " style="padding-left:0px;padding-right:5px;" >
													<a href="#" class="btn btn-xs btn-black"  style="margin-top:10px;margin-bottom:10px;width:100%;">Button3</a>
												</div>
												<div class="col-md-3 text-center " style="padding:0px;" >
													<a href="#" class="btn btn-xs btn-black"  style="margin-top:10px;margin-bottom:10px;width:100%;">Button3</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-2 text-center" ></div>
								</div>
								<div class="row">
								<div class="col-md-2 text-center" ></div>
								<div class="col-md-8" >
								<ul class="nav nav-tabs" style="">
									<li class="nav-item">
										<a class="btn-xs nav-link active" data-toggle="tab" href="#tabItem1">Send Email</a>
									</li>
									<li class="nav-item">
										<a class="btn-xs nav-link" data-toggle="tab" href="#tabItem2">Send Card</a>
									</li>
									<li class="nav-item">
										<a class="btn-xs nav-link" data-toggle="tab" href="#tabItem3">Send Videos</a>
									</li>
									<li class="nav-item"  style="margin-right:0px;">
										<a class="btn-xs nav-link" data-toggle="tab" href="#tabItem4" style="margin-right:0px;">Send SMS</a>
									</li>
									
								</ul>
								</div>
								<div class="col-md-2 text-center" ></div>
								</div>
								<div class="col-md-12 text-center email-btn" style="" >
									<div class="row">
										<div class="col-md-12 text-center "  ">
											<a href="#" class="btn btn-xs btn-primary text-center "  style="margin-top:10px;margin-right:3px;margin-bottom:15px;">Personalized</a>
											<a href="#" class="btn btn-xs btn-primary"  style="margin-top:10px;margin-bottom:15px;">Use Scripts</a>
										</div>
										
									</div>
								</div>
								<div class="col-md-12"  style="padding:0px;" >
									<div class="row">
										<div class="col-lg-12">
											<table style="border:1px solid #da291c4d;margin-bottom: 0px;width:100%;">
												<tbody>
													<tr>
														<td class="color-td color1"></td>
														<td class="color-td color2"></td>
														<td class="color-td color3"></td>
														<td class="color-td color4"></td>
														<td class="color-td color5"></td>
														<td class="color-td color6"></td>
														<td class="color-td color7"></td>
														<td class="color-td color8"></td>
														<td class="color-td color9"></td>
														<td class="color-td color10"></td>
														<td class="color-td color11"></td>
														<td class="color-td color12"></td>
														<td class="color-td color13"></td>
														<td class="color-td color14"></td>
														<td class="color-td color15"></td>
														<td class="color-td color16"></td>
														<td class="color-td color17"></td>
														<td class="color-td color18"></td>
														<td class="color-td color19"></td>
														<td class="color-td color20"></td>
														<td class="color-td color21"></td>
														<td class="color-td color22"></td>
														
													</tr>
												</tbody>
											</table>
										</div>
										
									</div>
									
								</div>
								</div>
								<div class="col-md-2" ></div>
								</div>
								<div class="tab-content" style="margin-top:10px;">
									<div class="tab-pane active" id="tabItem1">
										<form id="">	
											<div class="row gy-2" >
												
												<div class="col-md-2"></div>
												<div class="col-md-8" style="padding:0px;">
													<div class="col-md-12"  style="margin-top: 10px;">
														<div class="form-group">
															<input type="text" class="form-control" placeholder="Subject">
														</div>
													</div>
													
													<div class="col-md-12"  style="margin-top: 10px;">
														<div class="form-group">
															<textarea class="form-control msgbox"  placeholder="Message" ></textarea>
														</div>
													</div>
													
													
													
												</div>
												<div class="col-md-2"></div>
												<div class="col-md-12" style="">
													<div class="row" >
														
														<div class="col-md-1 text-center"></div>
															<div class="col-md-10 text-center email-btn" style="margin-top:10px;" >
																<div class="row">
																	<div class="col-md-5th text-center " style="padding-left:0px;padding-right:5px;" >
																	<a href="#" class="btn btn-xs btn-primary"  style="width:100%;">Send With Clock</a>
																	</div>
																	<div class="col-md-5th text-center " style="padding:0px;padding-right:5px;" >
																	<a href="#" class="btn btn-xs btn-primary"  style="width:100%;">Send With Reminders</a>
																	</div>
																	<div class="col-md-5th text-center " style="padding-left:0px;padding-right:5px;" >
																	<a href="#" class="btn btn-xs btn-primary"  style="width:100%;">Preview</a>
																	</div>
																	<div class="col-md-5th text-center " style="padding-left:0px;padding-right:5px;" >
																	<a href="#" class="btn btn-xs btn-primary"  style="width:100%;">Send Now</a>
																	</div>
																	<div class="col-md-5th text-center " style="padding:0px;" >
																	<a href="#" class="btn btn-xs btn-primary"  style="width:100%;">Send On</a>
																	</div>
																</div>
															</div>
															<div class="col-md-1 text-center"></div>
														
													</div>
												</div>
											</div>
										</form>
										
									</div>
									<div class="tab-pane" id="tabItem2" style="border-top:1px solid #cecece;padding-top:10px;">
										<div class="row">
										<div class="col-md-2"></div>
										<div class="col-md-8">
										<ul class="nav nav-tabs nav-tabs-s2">
											<li class="nav-item">
												<a class="nav-link active" data-toggle="tab" href="#tabItem9">BirthDays</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#tabItem10">Flowers</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#tabItem11">Thank You</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#tabItem12">Misc.</a>
											</li>
											
											
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="tabItem9">
												<div class="row">
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tabItem10">
												<div class="row">
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
													
												</div>
											</div>
											<div class="tab-pane" id="tabItem11">
												<div class="row">
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
													
												</div>
											</div>
											<div class="tab-pane" id="tabItem12">
												<div class="row">
													<div class="col-md-2" style="margin-bottom:10px;">
														<img src="../admin_assets/images/dummy.jpg" alt />
													</div>
													
												</div>
											</div>
										</div>
										<form id="">	
											<div class="row gy-4">
												
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Subject">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<textarea class="form-control" placeholder="Message"></textarea>
													</div>
												</div>
												
												
												
												<div class="col-md-12 text-center">
													<a href="#" class="btn btn-xs btn-primary"  style="margin-top:10px;">Send</a>
													
												</div>
											</div>
										</form>
										
										</div>
										<div class="col-md-2"></div>
										</div>
									</div>
									<div class="tab-pane" id="tabItem3" style="border-top:1px solid #cecece;padding-top:10px;">
										<div class="row">
										<div class="col-md-2"></div>
										<div class="col-md-8">
										<form id="">	
											<div class="row gy-4">
												
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Subject">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<div class="custom-file">
															<input type="file" multiple="" class="custom-file-input" id="customFile">
															<label class="custom-file-label" for="customFile">Upload Videos</label>
														</div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<textarea class="form-control" placeholder="Message"></textarea>
													</div>
												</div>
												
												
												
												<div class="col-md-12 text-center">
													<a href="#" class="btn btn-xs btn-primary"  style="margin-top:10px;">Send</a>
													
												</div>
											</div>
										</form>
										</div>
										<div class="col-md-2"></div>
										</div>
									</div>
									<div class="tab-pane" id="tabItem4" style="border-top:1px solid #cecece;padding-top:10px;">
										<div class="row">
										<div class="col-md-2"></div>
										<div class="col-md-8">
										<form id="">	
											<div class="row gy-4">
												
												<div class="col-md-12">
													<div class="form-group">
														
														<input type="text" class="form-control" placeholder="Subject">
													</div>
												</div>
												<!--<div class="col-md-12"  style="margin-top: 10px;">
														<a href="#" class="btn btn-xs btn-primary"  style="margin-right:10px;">Personalized</a>
														<a href="#" class="btn btn-xs btn-primary"  style="margin-right:10px;">Use Scripts</a>
													</div>-->
												<div class="col-md-12">
													<div class="form-group">
														
														<textarea class="form-control" placeholder="Message"></textarea>
													</div>
												</div>
												
												
												
												<div class="col-md-12 text-center">
													<a href="#" class="btn btn-xs btn-primary"  style="margin-top:10px;">Send</a>
													
												</div>
											</div>
										</form>
										</div>
										<div class="col-md-2"></div>
										</div>
									</div>
									
									
									
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