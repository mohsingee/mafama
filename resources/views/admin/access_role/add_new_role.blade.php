@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
             
                   
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:935px;">ADD ROLE</h3>
					<a href="{{ url('access_roles') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
							 <form action="" id="formAdminRole" method="post" enctype="multipart/form-data">
							 	@csrf
									<div class="row gy-4">
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Role Name	</label>
												<input type="text" required="" class="form-control" placeholder="Role Name" name="role_name" value="{{$mrole ? $mrole->admin_role:''}}" title="Role name is required">
											</div>
										</div>
										
									</div>
									<div class="row gy-4">
										<div class="col-md-12">
											 <hr>
                        <h6 style="font-size: 16px;">All Permission <span style="margin-left: 450px"> [ Select All ] <input type="checkbox" class="grant_all"></span></h6>
										</div>
									</div>
									
				<div class="row gy-4">
					
						  <div class="table-responsive">
                            <table class="table table-bordered ">
                                <thead>
                                <tr>
                                    <th style="text-align:left">Roles {Permission}</th>
                                    <th>View</th>
                                    <th>Add</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $check='';
       $dashboard_per = array("dashboard_view");
        $admininstrator_per = array("admininstrator_view","admininstrator_add","admininstrator_edit","admininstrator_delete");
        $roles_per = array("roles_view","roles_add","roles_edit","roles_delete");
        $table_level_per = array("table_level_view","table_level_add","table_level_edit","table_level_delete");
        $reg_affiliate_per = array("reg_affiliate_view","reg_affiliate_add","reg_affiliate_edit","reg_affiliate_delete");
        $reg_business_per = array("reg_business_view","reg_business_add","reg_business_edit","reg_business_delete");
        $reg_request_per = array("reg_request_view");
        $religion_per = array("religion_view","religion_add","religion_edit","religion_delete");
        $access_per = array("access_view");
        $general_settings_per = array("general_settings_view","general_settings_edit");
        $earning_points_per = array("earning_points_view","earning_points_edit");
        $lead_qualifier_per = array("lead_qualifier_view","lead_qualifier_edit");
        $terms_per = array("terms_view","terms_edit");
        $restrict_signups_per = array("restrict_signups_view","restrict_signups_add","restrict_signups_edit","restrict_signups_delete");
        $assign_users_per = array("assign_users_view","assign_users_add","assign_users_edit","assign_users_delete");
        $search_sms_per = array("search_sms_view","search_sms_add","search_sms_edit","search_sms_delete");
        $search_emails_per = array("search_emails_view","search_emails_add","search_emails_edit","search_emails_delete");
        $adminrole_per = array("adminrole_view","adminrole_add","adminrole_edit","adminrole_delete");
        $admin_roles_per = array("admin_roles_view","admin_roles_add","admin_roles_edit","admin_roles_delete");
        $admin_list_per = array("admin_list_view","admin_list_add","admin_list_edit","admin_list_delete");
        $emailtemplate_per = array("emailtemplate_view","emailtemplate_edit");
        $aff_email_per = array("aff_email_view","aff_email_edit");
        $client_reg_email_per = array("client_reg_email_view","client_reg_email_edit");
        $business_reg_email_per = array("business_reg_email_view","business_reg_email_edit");
        $record_transaction_email_per = array("record_transaction_email_view","record_transaction_email_edit");
        $minus_balance_email_per = array("minus_balance_email_view","minus_balance_email_edit");
        $member_mgmt_per = array("member_mgmt_view","member_mgmt_add","member_mgmt_edit","member_mgmt_delete");
        $enterprise_mgmt_per = array("enterprise_mgmt_view","enterprise_mgmt_add","enterprise_mgmt_edit","enterprise_mgmt_delete");
        $homepage_per = array("homepage_view","homepage_add","homepage_edit","homepage_delete");
        $hide_links_per = array("hide_links_view","hide_links_edit");
        $aff_feedback_per = array("aff_feedback_view","aff_feedback_add","aff_feedback_edit","aff_feedback_delete");
        $top_banner_per = array("top_banner_view","top_banner_add","top_banner_edit","top_banner_delete");
        $homepage_banner_per = array("homepage_banner_view","homepage_banner_add","homepage_banner_edit","homepage_banner_delete");
        $homepage_videos_per = array("homepage_videos_view","homepage_videos_add","homepage_videos_edit","homepage_videos_delete");
        $homepage_topvideos_per = array("homepage_topvideos_view","homepage_topvideos_add","homepage_topvideos_edit","homepage_topvideos_delete");
        $homepage_mainvideos_per = array("homepage_mainvideos_view","homepage_mainvideos_add","homepage_mainvideosedit","homepage_mainvideos_delete");
        $sitebanners_per = array("sitebanners_view","sitebanners_add","sitebanners_edit","sitebanners_delete");
        $settings_per = array("settings_view","settings_add","settings_edit","settings_delete");
        $appointment_per = array("appointment_view","appointment_add","appointment_edit","appointment_delete");
        $clients_mgmt_per = array("clients_mgmt_view","clients_mgmt_add","clients_mgmt_edit","clients_mgmt_delete");
        $emails_mgmt_per = array("emails_mgmt_view","emails_mgmt_add","emails_mgmt_edit","emails_mgmt_delete");
        $financial_mgmt_per = array("financial_mgmt_view","financial_mgmt_add","financial_mgmt_edit","financial_mgmt_delete");
        $archives_mgmt_per = array("archives_mgmt_view","archives_mgmt_add","archives_mgmt_edit","archives_mgmt_delete");
        $sitevideos_per = array("sitevideos_view","sitevideos_add","sitevideos_edit","sitevideos_delete");
        $settings_tut_per = array("settings_tut_view","settings_tut_add","settings_tut_edit","settings_tut_delete");
        $appointment_tut_per = array("appointment_tut_view","appointment_tut_add","appointment_tut_edit","appointment_tut_delete");
        $clients_tut_per = array("clients_tut_view","clients_tut_add","clients_tut_edit","clients_tut_delete");
        $emails_tut_per = array("emails_tut_view","emails_tut_add","emails_tut_edit","emails_tut_delete");
        $financial_tut_per = array("financial_tut_view","financial_tut_add","financial_tut_edit","financial_tut_delete");
        $archives_tut_per = array("archives_tut_view","archives_tut_add","archives_tut_edit","archives_tut_delete");
        $sign_in_popup_per = array("sign_in_popup_view","sign_in_popup_add","sign_in_popup_edit","sign_in_popup_delete");
        $create_cat_popup_per = array("create_cat_popup_view","create_cat_popup_add","create_cat_popup_edit","create_cat_popup_delete");
        $uploadsone_popup_per = array("uploadsone_popup_view","uploadsone_popup_add","uploadsone_popup_edit","uploadsone_popup_delete");
        $uploadstwo_popup_per = array("uploadstwo_popup_view","uploadstwo_popup_add","uploadstwo_popup_edit","uploadstwo_popup_delete");
        $settings_popup_per =  array("settings_popup_view","settings_popup_add");
        $templates_per = array("templates_view","templates_add","templates_edit","templates_delete");
        $templates_cat_per = array("templates_cat_view","templates_cat_add","templates_cat_edit","templates_cat_delete");
        $templates_upload_per = array("templates_upload_view","templates_upload_add","templates_upload_edit","templates_upload_delete");
        $templates_financial_per = array("templates_financial_view","templates_financial_add","templates_financial_edit","templates_financial_delete");
        $templates_balancesheet_per = array("templates_balancesheet_view","templates_balancesheet_add","templates_balancesheet_edit","templates_balancesheet_delete");
        $create_categories_per = array("create_categories_view","create_categories_add","create_categories_edit","create_categories_delete");
        $cards_per = array("cards_view","cards_add","cards_edit","cards_delete");
        $scripts_per = array("scripts_view","scripts_add","scripts_edit","scripts_delete");
        $business_per = array("business_view","business_add","business_edit","business_delete");
        $leads_per = array("leads_view","leads_add","leads_edit","leads_delete");
        $greetings_per = array("greetings_view","greetings_add","greetings_edit","greetings_delete");
        $upload_categories_per  = array("upload_categories_view","upload_categories_add","upload_categories_edit","upload_categories_delete");
        $upload_cards_per  = array("upload_cards_view","upload_cards_add","upload_cards_edit","upload_cards_delete");
        $upload_scripts_per = array("upload_scripts_view","upload_scripts_add","upload_scripts_edit","upload_scripts_delete");
        $upload_business_per = array("upload_business_view","upload_business_add","upload_business_edit","upload_business_delete");
        $upload_leads_per = array("upload_leads_view","upload_leads_add","upload_leads_edit","upload_leads_delete");
        $basket_move_per = array("basket_move_view","basket_move_add","basket_move_edit","basket_move_delete");
        $leads_category_per = array("leads_category_view","leads_category_edit","leads_category_delete");
        $basket_leads_per = array("basket_leads_view","basket_leads_edit");
        $move_leads_basketone_per = array("move_leads_basketone_view","move_leads_basketone_edit");
        $move_leads_baskettwo_per = array("move_leads_baskettwo_view","move_leads_baskettwo_edit");
        $move_leads_basketthree_per = array("move_leads_basketthree_view","move_leads_basketthree_edit");
        $move_leads_basketfour_per = array("move_leads_basketfour_view","move_leads_basketfour_edit");
        $commission_setup_per = array("commission_setup_view","commission_setup_add","commission_setup_edit","commission_setup_delete");
        $bonus_prize_setup_per = array("bonus_prize_setup_view","bonus_prize_setup_add","bonus_prize_setup_edit","bonus_prize_setup_delete");
        $bonus_pool_setup_per = array("bonus_pool_setup_view","bonus_pool_setup_edit");
        $bonus_prizes_table_per = array("bonus_prizes_table_view","bonus_prizes_table_add","bonus_prizes_table_edit","bonus_prizes_table_delete");
        $bonus_other_table_per = array("bonus_other_table_view","bonus_other_table_add","bonus_other_table_edit","bonus_other_table_delete");
        $affiliate_mgt_per = array("affiliate_mgt_view");
        $reports_per = array("reports_view");
        $level_per = array("level_view");
        $prize_per = array("prize_view");
        $other_per = array("other_view");
        $transactions_per = array("transactions_view");
        $chat_rooms_per = array("chat_rooms_view");
        $countries_per = array("countries_view","countries_add","countries_edit","countries_delete");
        $create_department_per = array("create_department_view","create_department_add","create_department_edit","create_department_delete");
        $upload_department_per = array("upload_department_view","upload_department_add","upload_department_edit","upload_department_delete");
        $create_arrondissements_per = array("create_arrondissements_view","create_arrondissements_add","create_arrondissements_edit","create_arrondissements_delete");
        $upload_arrondissements_per = array("upload_arrondissements_view","upload_arrondissements_add","upload_arrondissements_edit","upload_arrondissements_delete");
        $create_communes_per = array("create_communes_view","create_communess_add","create_communes_edit","create_communes_delete");
        $upload_communes_per = array("upload_communes_view","upload_communes_add","upload_communess_edit","upload_communes_delete");
        $archives_per = array("archives_view","archives_add","archives_edit","archives_delete");
        $forms_library_per = array("forms_library_view","forms_library_add","forms_library_edit","forms_library_delete");
        $google_analytics_per = array("google_analytics_view","google_analytics_edit");
        $payment_gateway_per = array("payment_gateway_view","payment_gateway_edit");
        $smtp_setting_per = array("smtp_setting_view","smtp_setting_edit","smtp_setting_delete");
        $change_password_per = array("change_password_view","change_password_edit");
        $schedule_holiday_per = array("schedule_holiday_view","schedule_holiday_add","schedule_holiday_edit","schedule_holiday_delete");
        $background_color_per = array("background_color_view","background_color_add","background_color_edit","background_color_delete");
        $surveypolls_per = array("surveypolls_view","surveypolls_add","surveypolls_edit","surveypolls_delete");
        $surveyques_per = array("surveyques_view","surveyques_edit","surveyques_delete");
        $terms_conditions_per = array("terms_conditions_view","terms_conditions_add","terms_conditions_edit","terms_conditions_delete");
        $test_components_per = array("test_components_view","test_components_add","test_components_edit","test_components_delete");
								$PerPages=getPermissionPages();
								$class1=$view_id='';
                                foreach ($PerPages as $key => $page) {  ?>
                                    <tr>
                                        <td style="text-align:left"><?php echo $page;?></td>
                                        <?php
                                        $c=1; 
                                        foreach ($$key as $value1) {
                                            $check=explode('_', $value1);
                                            if(in_array('edit',$check))
                                            {
                                                $view_id=$page.'_view';
                                                $class1=$value1;
                                            }
                                            if(in_array('delete',$check))
                                            {
                                                $view_id=$page.'_view';
                                                $class1=$value1;
                                            }
                                            ?>
                                            <td>
                                                <input type = "checkbox" class="per_check <?php echo $class1; ?>" data-id="<?php echo $view_id; ?>"  name="permission[<?php echo $value1;?>]" value='1' <?php echo isset($permit->$value1)?'checked':'';?>>
                                            </td>
                                            <?php
                                            $c++; }
                                        for($i=$c;$i<=4;$i++)
                                        {
                                            echo "<td></td>";
                                        }
                                        ?>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
									</div>
									
									<div class="row gy-4">
										<div class="col-md-12 text-center" style="margin-top:30px;margin-bottom:30px;">
										<input type="hidden" name="id"  value="{{$mrole ? $mrole->id:''}}" >	
										 <input type="submit" id="formvalidate" data-form="formAdminRole" class="btn btn-primary btn-lg btn-submit" value="Save">	
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
<script type="text/javascript">
	  //add role select all checkbox
    $('.grant_all').click(function()
    {
        var check = $(this).is(":checked");
        if(check)
        {
            $(".per_access").val(1);
            $(".per_check").prop("checked", true);
        }
        else
        {
            $(".per_access").val(0);
            $(".per_check").prop("checked", false);
        }
    });
    
</script>
@endsection