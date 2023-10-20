 
<?php $__env->startSection('content'); ?>

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Affiliates Registration</h3>
						<a href="<?php echo e(url('admin/affilates_registration')); ?>" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="<?php echo e(url('affiliate_update')); ?>" method="POST" id="" enctype="multipart/form-data">	
									<?php echo csrf_field(); ?>
									    <div class="row gy-4" style="padding-bottom:10px;">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="">No. of Emails Allowed</label>
                                                    <input class="form-control" placeholder="0" name="no_email_allowed"
                                                        value="<?= $details[0]->no_email_allowed ?>"
                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                        type="number" maxlength="6">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="">No. of Text Allowed</label>
                                                    <input class="form-control" placeholder="0" name="no_text_allowed"
                                                        value="<?= $details[0]->no_text_allowed ?>"
                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                        type="number" maxlength="6">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="">No. of Users(User Access
                                                        Allowed)</label>
                                                    <input class="form-control" placeholder="0"
                                                        name="no_user_access_allowed"
                                                        value="<?= $details[0]->no_user_access_allowed ?>"
                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                        type="number" maxlength="6">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gy-4" style="padding-bottom:10px; ">
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_xchange" value="1"
                                                        type="checkbox" id="enable_xchange"
                                                        <?php echo e($details[0]->enable_xchange == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_xchange"> Enable
                                                        Xchange</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">

                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_state" value="1"
                                                        type="checkbox" id="enable_state"
                                                        <?php echo e($details[0]->enable_state == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_state"> Enable City Projects</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">

                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_faith" value="1"
                                                        type="checkbox" id="enable_faith"
                                                        <?php echo e($details[0]->enable_faith == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_faith"> Enable
                                                        Faith Connection</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_diaspo_connection" value="1"
                                                        type="checkbox" id="enable_diaspo_connection"
                                                        <?php echo e($details[0]->enable_diaspo_connection == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_diaspo_connection"> Enable
                                                        Diaspo-Connection</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">

                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_gallery_of_leaders" value="1"
                                                        type="checkbox" id="enable_gallery_of_leaders"
                                                        <?php echo e($details[0]->enable_gallery_of_leaders == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_gallery_of_leaders"> Enable Gallery of Leaders</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">

                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_arts_culture" value="1"
                                                        type="checkbox" id="enable_arts_culture"
                                                        <?php echo e($details[0]->enable_arts_culture == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_arts_culture"> Enable
                                                        Arts_Culture</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_shopping" value="1"
                                                        type="checkbox" id="enable_shopping"
                                                        <?php echo e($details[0]->enable_shopping == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_shopping"> Enable
                                                        Shopping</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">

                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_top_city_news" value="1"
                                                        type="checkbox" id="enable_top_city_news"
                                                        <?php echo e($details[0]->enable_top_city_news == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_top_city_news"> Enable Top City News</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">

                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_city_guide" value="1"
                                                        type="checkbox" id="enable_city_guide"
                                                        <?php echo e($details[0]->enable_city_guide == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_city_guide"> Enable City Guide</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_city_management" value="1"
                                                        type="checkbox" id="enable_city_management"
                                                        <?php echo e($details[0]->enable_city_management == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_city_management"> Enable
                                                        City Management</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gy-4" style="padding-bottom:10px; ">
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_setting_xchange" value="1"
                                                        type="checkbox" id="enable_setting_xchange"
                                                        <?php echo e($details[0]->enable_setting_xchange == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_setting_xchange"> Enable
                                                        Setting Xchange</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_setting_birthplace_city_project" value="1"
                                                        type="checkbox" id="enable_setting_birthplace_city_project"
                                                        <?php echo e($details[0]->enable_setting_birthplace_city_project == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_setting_birthplace_city_project"> Enable
                                                        Setting Birthplace City Project</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_setting_art_and_culture" value="1"
                                                        type="checkbox" id="enable_setting_art_and_culture"
                                                        <?php echo e($details[0]->enable_setting_art_and_culture == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_setting_art_and_culture"> Enable Setting Art And Culture</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_setting_diaspo_connection" value="1"
                                                        type="checkbox" id="enable_setting_diaspo_connection"
                                                        <?php echo e($details[0]->enable_setting_diaspo_connection == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_setting_diaspo_connection"> Enable
                                                        Setting Diaspo Connection</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_setting_top_city_news" value="1"
                                                        type="checkbox" id="enable_setting_top_city_news"
                                                        <?php echo e($details[0]->enable_setting_top_city_news == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_setting_top_city_news"> Enable Setting Top City News</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_setting_faith_connection" value="1"
                                                        type="checkbox" id="enable_setting_faith_connection"
                                                        <?php echo e($details[0]->enable_setting_faith_connection == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_setting_faith_connection"> Enable
                                                        Setting Faith Connection</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_setting_board_of_leaders" value="1"
                                                        type="checkbox" id="enable_setting_board_of_leaders"
                                                        <?php echo e($details[0]->enable_setting_board_of_leaders == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_setting_board_of_leaders"> Enable
                                                        Setting Board Of Leaders</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_setting_city_management" value="1"
                                                        type="checkbox" id="enable_setting_city_management"
                                                        <?php echo e($details[0]->enable_setting_city_management == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_setting_city_management"> Enable Setting City Management</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_setting_shopping" value="1"
                                                        type="checkbox" id="enable_setting_shopping"
                                                        <?php echo e($details[0]->enable_setting_shopping == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_setting_shopping"> Enable
                                                        Setting Shopping</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="padding-left:35px">
                                                <div class="form-group">
                                                    <input class="form-check-input" name="enable_setting_city_guide" value="1"
                                                        type="checkbox" id="enable_setting_city_guide"
                                                        <?php echo e($details[0]->enable_setting_city_guide == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="enable_setting_city_guide"> Enable Setting City Guide</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="divider"></div>
                                        <div class="row gy-4">
                                            <div class="col-md-12 text-center">
                                                <h6>User Number</h6>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Update Number - City Project</label>
                                                    <input type="number" class="form-control"  placeholder="0" name="number" id="number" value="<?php echo e(isset($user_birthplace_number->description) ? $user_birthplace_number->description : 0); ?>" >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Update Number-Diaspo Connection</label>
                                                    <input type="number" class="form-control"  placeholder="0" name="diaspo_connection_number" id="diaspo_connection_number" value="<?php echo e(isset($diaspo_connection_number->description) ? $diaspo_connection_number->description : 0); ?>" >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Update Number - Art Culture</label>
                                                    <input type="number" class="form-control"  placeholder="0" name="arts_and_culture_number" id="arts_and_culture_number" value="<?php echo e(isset($arts_and_culture_number->description) ? $arts_and_culture_number->description : 0); ?>" >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Update Number - My Faith</label>
                                                    <input type="number" class="form-control"  placeholder="0" name="my_faith_number" id="my_faith_number" value="<?php echo e(isset($my_faith_number->description) ? $my_faith_number->description : 0); ?>" >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Update Number - Top City News</label>
                                                    <input type="number" class="form-control"  placeholder="0" name="top_city_news_number" id="top_city_news_number" value="<?php echo e(isset($top_city_news_number->description) ? $top_city_news_number->description : 0); ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="divider"></div>
									<div class="row gy-4" style="padding-bottom:20px; ">
									<?php if($details[0]->code != null): ?> 
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Affiliate Code</label>
												<input type="text" class="form-control"  placeholder="Affilate Code" name="code" id="affiliate_code" value="<?= $details[0]->code ?>" >
												<span style="color: red;" id="codeexitstance"></span>
											</div>
										</div>
									<?php endif; ?>										
										<?php if($sponsor_email != null): ?> 
											<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Sponsor ID</label>
												<input type="text" class="form-control"  placeholder="Sponsor ID" name="sponsor_email" id="sponsor_email" value="<?= $sponsor_email ?>" >
												<span style="color: red;" id="codeexitstance"></span>
											</div>
										</div>
										<?php endif; ?>
									</div>
									<?php if($details[0]->code != null || $sponsor_email != null): ?>
									<div class="clearfix"></div>	
									<div class="divider"><!-- divider --></div>	
									<?php endif; ?>
									<div class="row gy-4" style="padding-bottom:20px;">
										<div class="col-md-12 text-center">
											<h6>Profile Information</h6>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Joining Date</label>
												<input type="text" class="form-control date-picker"  placeholder="Joining Date" name="joining_date" value="<?= $details[0]->joining_date ?>" autocomplete="off" 
												>
											</div>
										</div>






										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Country Of Birth</label>
												<select id="birth_countries_states1" class="form-control bfh-countries" data-country="<?= $details[0]->birth_country ?>" name="birth_country" 
												></select>
												<span class="text-danger birth_country_message" style="display:none">Before going to the next step select Country of birth first</span>
											</div>
										</div>

										<div class="col-md-4 birth_comm" <?php if($details[0]->birth_country != "HT"): ?> style="display:none" <?php endif; ?>>
											<div class="form-group">
												<label class="form-label" for="">Commune</label>
												<select id="birth_commune" class="form-control bfh-commune" name="birth_commune" >
													<option value="<?php echo e((isset($details[0]->birth_commune)) ? $details[0]->birth_commune : ''); ?>"><?php echo e((isset($details[0]->birth_commune)) ? showcommuneName($details[0]->birth_commune) : ''); ?></option>
													<?php $__currentLoopData = $communes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commune): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($commune->id); ?>"><?php echo e($commune->commune); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
												<span class="text-danger birth_commune_message" style="display:none">Before going to the next field select Commune first</span>
											</div>
										</div>

										<div class="col-md-4 birth_state" <?php if($details[0]->birth_country == "HT"): ?> style="display:none" <?php endif; ?>>
											<div class="form-group">
												<label class="form-label" for="">State/Province</label>
												<select class="form-control bfh-states birth-state-focus" data-state="<?= $details[0]->birth_state ?>" data-country="birth_countries_states1" name="birth_state" ></select>
												<span class="text-danger birth_state_message" style="display:none">Before going to the next field select State/Province first</span>
											</div>
										</div>


										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">First Name</label>
												<input type="text" class="form-control" value="<?= $details[0]->first_name ?>"  placeholder="Profile First Name" name="first_name" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Last Name</label>
												<input type="text" class="form-control" value="<?= $details[0]->last_name ?>" placeholder="Profile Last Name" name="last_name" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Religious Faith/ Spirituality </label>
												<select class="form-control" name="religion" >
													<?php
		                                                foreach ($religion as $value) {
		                                            ?>
		                                                    <option <?php if ($details[0]->religion == $value->religion) { ?> selected <?php } ?> value="<?= $value->religion ?>"><?= $value->religion ?></option>
		                                            <?php
		                                                }
		                                            ?>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Email</label>
												<input type="email" class="form-control" name="new_email"  placeholder="Profile Email" value="<?= $details[0]->email ?>" >
												<input type="hidden" name="email" value="<?= $details[0]->email ?>">
											</div>
										</div>
										<!---->
										<div class="col-md-4">
								<div class="form-group">
									<label class="form-label" for="">Cell Phone</label>
									<input style="width: 18rem" class="form-control" placeholder="" onchange="getPhoneNo()" id="cellphone" name="format-cellphone" value="<?= $details[0]->cellphone ?>" type="tel" value="<?php echo e(old('cellphone')); ?>" required>
									<span class="text-danger" id="cellPhoneToast" style="display:none">Please enter correct number</span>
									<input type="hidden" name="cellphone" id="cellphone-inp" style=""/>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label  class="form-label"  for="">Business Telephone</label>
									<input style="width: 18rem" type="tel" class="form-control" placeholder="" id="business_telephone" name="business_telephone_inp" onchange="getBusinessPhoneNo()" value="<?= $details[0]->business_telephone ?>" required>
									<span class="text-danger" id="businessPhoneToast" style="display:none">Please enter correct number</span>
									<input type="hidden" name="business_telephone" id="business_telephone_inp"/>
								</div>
							</div>
							<!---->
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Choose a Business Category</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="business_category" >
												  	<?php
		                                                foreach ($business_category as $value) {
		                                            ?>
		                                                    <option <?php if ($details[0]->business_category == $value->id) { ?> selected <?php } ?> value="<?= $value->id ?>"><?= $value->category ?></option>
		                                            <?php
		                                                }
		                                            ?>
												  
												</select>
											</div>
										</div>
									<!--lead_category-->
									<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> Profession/Study</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="lead_category" >
												    
		                                        <?php $__currentLoopData = $lead_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
		                                           
		                                              <option value="<?php echo e($value->id); ?>"><?php echo e($value->category); ?> </option>
		                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												  
												</select>
											</div>
										</div>
										
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Upload Your Picture</label>
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="customFile" name="image">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
										</div>
										
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Street Address</label>
												<input type="text" class="form-control"  placeholder="" value="<?= $details[0]->address ?>" name="address"  >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Zip Code</label>
												<input class="form-control"  placeholder="" name="zip_code" value="<?= $details[0]->zip_code ?>" 
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "text"
    maxlength = "6" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> City </label>
												<input type="text" class="form-control"  placeholder="" name="city" value="<?= $details[0]->city ?>" >
											</div>
										</div>
										
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Country Of Residense</label>
												<select id="countries_states1" class="form-control bfh-countries" data-country="<?= $details[0]->country ?>" name="country" ></select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">State/Province</label>
												<select class="form-control bfh-states" data-state="<?= $details[0]->state ?>" data-country="countries_states1" name="state" ></select>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>	
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="submit" class="btn btn-lg btn-primary" value="Update">
									</div>
								</form>
								<?php 
								if(session()->has('success')){
								?>
								<script type="text/javascript">
								$(function(){
								swal({
									title: 'Success',
									text: "User's information successfully updated",
									type: 'success',
									showConfirmButton: false,
									showCancelButton: true,
									cancelButtonColor: '#d33',
									cancelButtonText: ' Ok',
								})
							})
							</script>
								<?php 
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#affiliate_code").change(function(){
        varr = $(this).val();
        // alert(varr);
        var url = "<?php echo url('/'); ?>/codeavailability";
        $.ajax({
              url: url,
              data: 'code=' + varr + '&_token=<?php echo e(csrf_token()); ?>',
              type: "POST",
            success: function (response) {
                // alert(response);
                if (response == "expired") {
                	$("#codeexitstance").html("The code has been expired!!!");
                	$("#affiliate_code").val("");
                }
                else if(response == "fail") {
                	$("#codeexitstance").html("The code does not exists!!!");
                	$("#affiliate_code").val("");
                }
            }
        });
    });


	$(document).on("change","#birth_countries_states1",function(){
		haiti=$("#birth_countries_states1").val();
		$(".birth_country_message").hide();
		if(haiti=="HT"){
			$(".birth_comm").show();
			$(".birth_state").hide();
		}
		else{
			$(".birth_state").show();
			$(".birth_comm").hide();
		}
	})

</script>
<script>
          const phoneInputField = document.querySelector("#cellphone");
       const phoneInput = window.intlTelInput(phoneInputField, {
         utilsScript:
           "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
       });
       const getPhoneNo = () => {
        const phoneNumber = phoneInput.getNumber()
		if(phoneNumber.includes('+')) {
			const cellphoneInp = document.getElementById('cellphone-inp')
			cellphoneInp.value = phoneNumber
			cellPhoneToast.style.display = 'none'
		} else {
			// if liberary not loaded 
			const cellphoneInp = document.getElementById('cellphone-inp')
			cellphoneInp.value = phoneInputField.value
			// 
			let cellPhoneToast = document.getElementById('cellPhoneToast')
			cellPhoneToast.style.display = 'block'
		}
       }
       const businessPhoneInputField = document.querySelector("#business_telephone");
       const businessPhoneInput = window.intlTelInput(businessPhoneInputField, {
         utilsScript:
           "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
       });
       const getBusinessPhoneNo = () => {
        const businessPhoneNumber = businessPhoneInput.getNumber()
        if(businessPhoneNumber.includes('+')) {
			const businessPhoneInp = document.getElementById('business_telephone_inp')
			businessPhoneInp.value = businessPhoneNumber
			businessPhoneToast.style.display = 'none'
		} else {
			// if liberary not loaded
			const businessPhoneInp = document.getElementById('business_telephone_inp')
			businessPhoneInp.value = businessPhoneInputField.value

			let businessPhoneToast = document.getElementById('businessPhoneToast')
			businessPhoneToast.style.display = 'block'
		}
       }
</script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/edit_affilates_registration.blade.php ENDPATH**/ ?>