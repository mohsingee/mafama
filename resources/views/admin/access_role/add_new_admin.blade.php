@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
                    <h3 class="nk-block-title page-title"   style="width:935px;">ADD NEW ADMIN</h3>
                    <a href="{{ url('admin/admin-list') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                             <form action="" id="formAdminAccount" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="row gy-4">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label"> Name </label>
                                                <input type="text" required="" class="form-control" placeholder="Name" name="name" value="{{$admin ? $admin->name:''}}" title="Name is required">
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Email    </label>
                                                <input type="text" required="" class="form-control" placeholder="Email" name="email" {{$admin ? 'readonly':''}} value="{{$admin ? $admin->email:''}}" title="Email is required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Phone    </label>
                                                <input type="number" required="" class="form-control" placeholder="Phone" name="phone" value="{{$admin ? $admin->phone:''}}" title="phone is required">
                                            </div>
                                        </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Password    </label>
                                                <input type="password"  {{$admin ? '':'required'}} class="form-control" placeholder="Password" name="password" value="" title="Password is required">
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Zip Code    </label>
                                                <input type="text" required="" class="form-control" placeholder="zip code" name="zip_code" value="{{$admin ? $admin->zip_code:''}}" title="zip_code is required">
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">City</label>
                                                <input type="text" required="" class="form-control" placeholder="City" name="city" value="{{$admin ? $admin->city:''}}" title="city is required">
                                            </div>
                                        </div>
                                
                                        
                                     <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <textarea class="form-control" placeholder="Address" name="address"  >{{$admin ? $admin->address:''}}</textarea>
                                            </div>
                                        </div>   
                                    </div>
                                     
                                    <div class="row gy-4">
                                        <div class="col-md-12">
                                             <hr>
                        <h6 style="font-size: 16px;">All Permission <span style="margin-left: 450px"> [ Select All ] <input type="checkbox" class="grant_all"></span></h6>
                                        </div>
                                    </div>
                                    <hr>
                <div class="row gy-4">
                                <?php
                                $check='';
       $dashboard_per = array("dashboard_view");
       $admininstrator_per = array("admininstrator_view","access_role","table_of_level","registered_affiliates","registered_buissness","registration_requests","religion","access_monitoring","general_settings","earning_points","lead_qualifier_setting","terms_and_condition","administrator_hide_unhide_links","restrict_of_signups","assign_of_users","search_and_send_sms","search_and_send_email");
       $email_templates_per = array("email_templates_view","affiliate_email_template","client_registration_email_template","business_registration_email_template","record_transaction_email_template","minus_balance_email_template");
       $member_management_per = array("member_management_view","affiliate_management","enterprise_management");
       $home_page_per = array("home_page_views","hide_unhide_links","affiliates_feedback","home_page_top_banner","home_page_banner_for_text","home_page_videos","home_page_video_main");
       $site_banners_per = array("site_banners_views","settings","appoitment","clients_management","emails_management","financial_management","archives");
       $site_videos_per = array("site_videos_views","introduction_videos","settings_tutorial","appoitment_tutorial","clients_m_tutorial","emails_m_tutorial","financial_tutorial","archives_tutorial");
       $sign_in_popups_per = array("sign_in_popups_views","create_category_popup","upload_popup_business_category1","upload_popup_buisiness_category2","popup_settings");
       $templates_per = array("templates_views","create_client_templates_categories","upload_client_templates","upload_financial_templates","upload_balancesheet_templates");
       $create_categories_per = array("create_categories_views","cards","scripts","business","leads","personalised_greetings");
       $upload_to_categories_per = array("upload_to_categories_views","upload_cards","upload_scripts","upload_business","upload_leads");
       $condition_for_baskets_movements_per = array("condition_for_baskets_movements_views","leads_by_category","basket_leads_rotation","move_leads_to_baskets1","move_leads_to_baskets2","move_leads_to_baskets3","move_leads_to_baskets4");
       $commission_setup_per = array("commission_setup_views","commission_setup_table","affiliate_commission_setting");
       $bonus_prizes_setup_per = array("bonus_prizes_setup_views","bonus_condition_table","bonus_pool_prize_setting","prizes_table","other_table");
       $affiliates_management_per = array("affiliates_management_views","network");
       $notification_management_per = array("notification_management_views","notifications","notifications_cms");
       $reports_per = array("reports_views","bonus_income_report","level_income_report","prize_report","other_report","transactions");
       $manage_package_per = array("package_views","pricing_table","upgrade");
       $feature_access_per = array("feature_views","affiliates","gold","silver","enterprises");
      $front_editing_per = array("front_editing_views","front_settings","front_appoitments","front_client_management","front_email_management","front_financial_management","front_archives");
       $chat_room_per = array("chat_room_views","manage_chat_rooms");       
       $countries_per = array("countries_views","create_department","upload_departments","create_arroundissements","upload_arroundissements","create_communes","upload_communes");
       $archives_per = array("archives_views");
       $forms_library_per = array("forms_library_views");
       $google_analysis_per = array("google_analysis_views");
       $payment_gateway_per = array("payment_gateway_views");
       $smtp_setting_per = array("smtp_setting_views");
       $shedule_holiday_per = array("shedule_holiday_views");
       $background_color_per = array("background_color_views");
       $survey_polls_per = array("survey_polls_views","survey_questions","survey_result");
       $terms_condition_per = array("terms_condition_views","upload");
       $test_components_per = array("test_components_views");
                                $PerPages=getPermissionPages();
                                $class1=$view_id='';
                                foreach ($PerPages as $key => $page) {  ?>
                                    <div class="col-sm-4">
                                        <h6 style="font-size: 16px;"><?php echo $page;?></h6>
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
                                            <div>
                                               <input type = "checkbox" class="per_check <?php echo $class1; ?>" data-id="<?php echo $view_id; ?>"  name="permission[<?php echo $value1;?>]" value='1' <?php echo isset($permit->$value1)?'checked':'';?>>  <?=  str_replace(" ","_",$value1); ;?>
                                            </div>
                                            <?php
                                            $c++; }
                                        for($i=$c;$i<=4;$i++)
                                        {
                                            echo "<div></div>";
                                        }
                                        ?>
                                    </div>
                                <?php } ?>                               
                                    </div>
                                    <input type="hidden" value='{"dashboard_view":"1","admininstrator_view":"1","admininstrator_add":"1","admininstrator_edit":"1","admininstrator_delete":"1","roles_view":"1","roles_add":"1","roles_edit":"1","roles_delete":"1","table_level_view":"1","table_level_add":"1","table_level_edit":"1","table_level_delete":"1","reg_affiliate_view":"1","reg_affiliate_add":"1","reg_affiliate_edit":"1","reg_affiliate_delete":"1","reg_business_view":"1","reg_business_add":"1","reg_business_edit":"1","reg_business_delete":"1","reg_request_view":"1","religion_view":"1","religion_add":"1","religion_edit":"1","religion_delete":"1","access_view":"1","general_settings_view":"1","general_settings_edit":"1","earning_points_view":"1","earning_points_edit":"1","lead_qualifier_view":"1","lead_qualifier_edit":"1","terms_view":"1","terms_edit":"1","restrict_signups_view":"1","restrict_signups_add":"1","restrict_signups_edit":"1","restrict_signups_delete":"1","assign_users_view":"1","assign_users_add":"1","assign_users_edit":"1","assign_users_delete":"1","search_sms_view":"1","search_sms_add":"1","search_sms_edit":"1","search_sms_delete":"1","search_emails_view":"1","search_emails_add":"1","search_emails_edit":"1","search_emails_delete":"1","adminrole_view":"1","adminrole_add":"1","adminrole_edit":"1","adminrole_delete":"1","admin_roles_view":"1","admin_roles_add":"1","admin_roles_edit":"1","admin_roles_delete":"1","admin_list_view":"1","admin_list_add":"1","admin_list_edit":"1","admin_list_delete":"1","emailtemplate_view":"1","emailtemplate_edit":"1","aff_email_view":"1","aff_email_edit":"1","client_reg_email_view":"1","client_reg_email_edit":"1","business_reg_email_view":"1","business_reg_email_edit":"1","record_transaction_email_view":"1","record_transaction_email_edit":"1","minus_balance_email_view":"1","minus_balance_email_edit":"1","member_mgmt_view":"1","member_mgmt_add":"1","member_mgmt_edit":"1","member_mgmt_delete":"1","enterprise_mgmt_view":"1","enterprise_mgmt_add":"1","enterprise_mgmt_edit":"1","enterprise_mgmt_delete":"1","homepage_view":"1","homepage_add":"1","homepage_edit":"1","homepage_delete":"1","hide_links_view":"1","hide_links_edit":"1","aff_feedback_view":"1","aff_feedback_add":"1","aff_feedback_edit":"1","aff_feedback_delete":"1","top_banner_view":"1","top_banner_add":"1","top_banner_edit":"1","top_banner_delete":"1","homepage_banner_view":"1","homepage_banner_add":"1","homepage_banner_edit":"1","homepage_banner_delete":"1","homepage_videos_view":"1","homepage_videos_add":"1","homepage_videos_edit":"1","homepage_videos_delete":"1","homepage_topvideos_view":"1","homepage_topvideos_add":"1","homepage_topvideos_edit":"1","homepage_topvideos_delete":"1","homepage_mainvideos_view":"1","homepage_mainvideos_add":"1","homepage_mainvideosedit":"1","homepage_mainvideos_delete":"1","sitebanners_view":"1","sitebanners_add":"1","sitebanners_edit":"1","sitebanners_delete":"1","settings_view":"1","settings_add":"1","settings_edit":"1","settings_delete":"1","appointment_view":"1","appointment_add":"1","appointment_edit":"1","appointment_delete":"1","clients_mgmt_view":"1","clients_mgmt_add":"1","clients_mgmt_edit":"1","clients_mgmt_delete":"1","emails_mgmt_view":"1","emails_mgmt_add":"1","emails_mgmt_edit":"1","emails_mgmt_delete":"1","financial_mgmt_view":"1","financial_mgmt_add":"1","financial_mgmt_edit":"1","financial_mgmt_delete":"1","archives_mgmt_view":"1","archives_mgmt_add":"1","archives_mgmt_edit":"1","archives_mgmt_delete":"1","sitevideos_view":"1","sitevideos_add":"1","sitevideos_edit":"1","sitevideos_delete":"1","settings_tut_view":"1","settings_tut_add":"1","settings_tut_edit":"1","settings_tut_delete":"1","appointment_tut_view":"1","appointment_tut_add":"1","appointment_tut_edit":"1","appointment_tut_delete":"1","clients_tut_view":"1","clients_tut_add":"1","clients_tut_edit":"1","clients_tut_delete":"1","emails_tut_view":"1","emails_tut_add":"1","emails_tut_edit":"1","emails_tut_delete":"1","financial_tut_view":"1","financial_tut_add":"1","financial_tut_edit":"1","financial_tut_delete":"1","archives_tut_view":"1","archives_tut_add":"1","archives_tut_edit":"1","archives_tut_delete":"1","sign_in_popup_view":"1","sign_in_popup_add":"1","sign_in_popup_edit":"1","sign_in_popup_delete":"1","create_cat_popup_view":"1","create_cat_popup_add":"1","create_cat_popup_edit":"1","create_cat_popup_delete":"1","uploadsone_popup_view":"1","uploadsone_popup_add":"1","uploadsone_popup_edit":"1","uploadsone_popup_delete":"1","uploadstwo_popup_view":"1","uploadstwo_popup_add":"1","uploadstwo_popup_edit":"1","uploadstwo_popup_delete":"1","settings_popup_view":"1","settings_popup_add":"1","templates_view":"1","templates_add":"1","templates_edit":"1","templates_delete":"1","templates_cat_view":"1","templates_cat_add":"1","templates_cat_edit":"1","templates_cat_delete":"1","templates_upload_view":"1","templates_upload_add":"1","templates_upload_edit":"1","templates_upload_delete":"1","templates_financial_view":"1","templates_financial_add":"1","templates_financial_edit":"1","templates_financial_delete":"1","templates_balancesheet_view":"1","templates_balancesheet_add":"1","templates_balancesheet_edit":"1","templates_balancesheet_delete":"1","create_categories_view":"1","create_categories_add":"1","create_categories_edit":"1","create_categories_delete":"1","cards_view":"1","cards_add":"1","cards_edit":"1","cards_delete":"1","scripts_view":"1","scripts_add":"1","scripts_edit":"1","scripts_delete":"1","business_view":"1","business_add":"1","business_edit":"1","business_delete":"1","leads_view":"1","leads_add":"1","leads_edit":"1","leads_delete":"1","greetings_view":"1","greetings_add":"1","greetings_edit":"1","greetings_delete":"1","upload_categories_view":"1","upload_categories_add":"1","upload_categories_edit":"1","upload_categories_delete":"1","upload_cards_view":"1","upload_cards_add":"1","upload_cards_edit":"1","upload_cards_delete":"1","upload_scripts_view":"1","upload_scripts_add":"1","upload_scripts_edit":"1","upload_scripts_delete":"1","upload_business_view":"1","upload_business_add":"1","upload_business_edit":"1","upload_business_delete":"1","upload_leads_view":"1","upload_leads_add":"1","upload_leads_edit":"1","upload_leads_delete":"1","basket_move_view":"1","basket_move_add":"1","basket_move_edit":"1","basket_move_delete":"1","leads_category_view":"1","leads_category_edit":"1","leads_category_delete":"1","basket_leads_view":"1","basket_leads_edit":"1","move_leads_basketone_view":"1","move_leads_basketone_edit":"1","move_leads_baskettwo_view":"1","move_leads_baskettwo_edit":"1","move_leads_basketthree_view":"1","move_leads_basketthree_edit":"1","move_leads_basketfour_view":"1","move_leads_basketfour_edit":"1","commission_setup_view":"1","commission_setup_add":"1","commission_setup_edit":"1","commission_setup_delete":"1","bonus_prize_setup_view":"1","bonus_prize_setup_add":"1","bonus_prize_setup_edit":"1","bonus_prize_setup_delete":"1","bonus_pool_setup_view":"1","bonus_pool_setup_edit":"1","bonus_prizes_table_view":"1","bonus_prizes_table_add":"1","bonus_prizes_table_edit":"1","bonus_prizes_table_delete":"1","bonus_other_table_view":"1","bonus_other_table_add":"1","bonus_other_table_edit":"1","bonus_other_table_delete":"1","affiliate_mgt_view":"1","notifications_mgmt_view":"1","notifications_mgmt_add":"1","notifications_mgmt_edit":"1","notifications_mgmt_delete":"1","notifications_view":"1","notifications_delete":"1","notifications_cms_view":"1","notifications_cms_add":"1","notifications_cms_edit":"1","notifications_cms_delete":"1","reports_view":"1","level_view":"1","prize_view":"1","other_view":"1","transactions_view":"1","chat_rooms_view":"1","countries_view":"1","countries_add":"1","countries_edit":"1","countries_delete":"1","create_department_view":"1","create_department_add":"1","create_department_edit":"1","create_department_delete":"1","upload_department_view":"1","upload_department_add":"1","upload_department_edit":"1","upload_department_delete":"1","create_arrondissements_view":"1","create_arrondissements_add":"1","create_arrondissements_edit":"1","create_arrondissements_delete":"1","upload_arrondissements_view":"1","upload_arrondissements_add":"1","upload_arrondissements_edit":"1","upload_arrondissements_delete":"1","create_communes_view":"1","create_communess_add":"1","create_communes_edit":"1","create_communes_delete":"1","upload_communes_view":"1","upload_communes_add":"1","upload_communess_edit":"1","upload_communes_delete":"1","archives_view":"1","archives_add":"1","archives_edit":"1","archives_delete":"1","forms_library_view":"1","forms_library_add":"1","forms_library_edit":"1","forms_library_delete":"1","google_analytics_view":"1","google_analytics_edit":"1","payment_gateway_view":"1","payment_gateway_edit":"1","smtp_setting_view":"1","smtp_setting_edit":"1","smtp_setting_delete":"1","change_password_view":"1","change_password_edit":"1","schedule_holiday_view":"1","schedule_holiday_add":"1","schedule_holiday_edit":"1","schedule_holiday_delete":"1","background_color_view":"1","background_color_add":"1","background_color_edit":"1","background_color_delete":"1","surveypolls_view":"1","surveypolls_add":"1","surveypolls_edit":"1","surveypolls_delete":"1","surveyques_view":"1","surveyques_edit":"1","surveyques_delete":"1","terms_conditions_view":"1","terms_conditions_add":"1","terms_conditions_edit":"1","terms_conditions_delete":"1","test_components_view":"1","test_components_add":"1","test_components_edit":"1","test_components_delete":"1"}' name="permission1">
                                    <div class="row gy-4">
                                        <div class="col-md-12 text-center" style="margin-top:30px;margin-bottom:30px;">
                                        <input type="hidden" name="id"  value="{{$admin ? $admin->id:''}}" >    
                                         <input type="submit" id="formvalidate" data-form="formAdminAccount" class="btn btn-primary btn-lg btn-submit" value="Save">    
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