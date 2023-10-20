 $("#select_all").change(function(){
            if ($(this).prop('checked')) {
                this.setAttribute("checked", "checked");
                $('.select_one').prop('checked', true);
            }
            else{
                this.removeAttribute("checked");
                $('.select_one').prop('checked', false);
            }
            $('.select_one').trigger('change');
        });
$(document).on('click','.move-into-basket',function(e){
     e.preventDefault();
      swal({
        title: 'Would you like to proceed?',
        text: " ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: ' Yes ',
        cancelButtonText: ' No ',
        confirmButtonClass: 'btn btn-success btn-md mybtn',
        cancelButtonClass: 'btn btn-primary btn-md mybtn',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) =>
    {
        if(result.value)
        { 
     var selected_user = []; 
    $(".select_one:checked").each(function() { 
        selected_user.push($(this).val()); 
    });
    if(selected_user.length > 0){
        //alert(selected_user);
  //  var selected_user_ids= $("input[name='selected_user_ids']").val(selected_user);   
   // alert(selected_user_ids);
   //  $('#basket_model').modal('show');   
      var token = $("meta[name='csrf-token']").attr("content");  
         $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');  
       $.ajax({
            method:"POST",
            url:base_url+'manageBasketForm',
            data:{selected_user_ids:selected_user,_token:token},
            success:function(data)
            {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
             redirect_notify(data.msg,'Please wait while we redirect',window.location.reload(),"success");
            }
            else
            {
                notify(data.msg, "info");
                return false;
            }
            }
        });
    }
    else{
         notify("Please select atleast one user", "info");
         return false;
    }
        }
    })        
});
/*-----View Upload_lead User Single Row Data-----*/
$(document).on('click', '.view_lead_user', function(e)
{
     e.preventDefault();
        var id = $(this).attr("data-id");
        var token = $("meta[name='csrf-token']").attr("content");           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'view_lead_user',
            data:{id:id,_token:token},
            success:function(data)
            {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
             $('#lead_user_details').html(data.html);
             $("#user_lead_model").modal('show');
            }
            else
            {
                notify(data.msg, "info");
                return false;
            }
            }
        });
});
/*-----Delete Single Row Data-----*/
$(document).on('click', '.deleterow', function(e)
{
     e.preventDefault();
      swal({
        title: 'Would you like to proceed?',
        text: " ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: ' Yes ',
        cancelButtonText: ' No ',
        confirmButtonClass: 'btn btn-success btn-md mybtn',
        cancelButtonClass: 'btn btn-primary btn-md mybtn',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) =>
    {
        if(result.value)
        {
        var id = $(this).attr("data-id");
        var list = $(this).attr("data-list");
        var token = $("meta[name='csrf-token']").attr("content");           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'deleteRow',
            data:{id:id,list:list,_token:token},
            success:function(data)
            {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
             redirect_notify(data.msg,'Please wait while we redirect',window.location.reload(),"success");
            }
            else
            {
                notify(data.msg, "info");
                return false;
            }
            }
        });
            return false;
        }
    })
});
/*-----Delete Single Row Data-----*/
$(document).on('click', '.deleteaffiliate', function(e)
{
     e.preventDefault();
      swal({
        title: 'Would you like to proceed?',
        text: " ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: ' Yes ',
        cancelButtonText: ' No ',
        confirmButtonClass: 'btn btn-success btn-md mybtn',
        cancelButtonClass: 'btn btn-primary btn-md mybtn',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) =>
    {
        if(result.value)
        {
        var email = $(this).attr("data-email");
        var list = $(this).attr("data-list");
        var token = $("meta[name='csrf-token']").attr("content");           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'delete_affilates_registration',
            data:{email:email,list:list,_token:token},
            success:function(data)
            {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
             redirect_notify(data.msg,'Please wait while we redirect',window.location.reload(),"success");
            }
            else
            {
                notify(data.msg, "info");
                return false;
            }
            }
        });
            return false;
        }
    })
});
$(document).on('click', '.deletenonaffiliate', function(e)
{
     e.preventDefault();
      swal({
        title: 'Would you like to proceed?',
        text: " ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: ' Yes ',
        cancelButtonText: ' No ',
        confirmButtonClass: 'btn btn-success btn-md mybtn',
        cancelButtonClass: 'btn btn-primary btn-md mybtn',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) =>
    {
        if(result.value)
        {
        var email = $(this).attr("data-email");
        var list = $(this).attr("data-list");
        var token = $("meta[name='csrf-token']").attr("content");           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'delete_nonaffiliates_registration',
            data:{email:email,list:list,_token:token},
            success:function(data)
            {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
             redirect_notify(data.msg,'Please wait while we redirect',window.location.reload(),"success");
            }
            else
            {
                notify(data.msg, "info");
                return false;
            }
            }
        });
            return false;
        }
    })
});
/*-----Delete Single Row Data-----*/
$(document).on('click', '.update_account_status', function(e)
{
     e.preventDefault();
      swal({
        title: $(this).attr("data-msg"),
        text: " ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: ' Yes ',
        cancelButtonText: ' No ',
        confirmButtonClass: 'btn btn-success btn-md mybtn',
        cancelButtonClass: 'btn btn-primary btn-md mybtn',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) =>
    {
        if(result.value)
        {
        var uid = $(this).attr("data-id");
        var status = $(this).attr("data-status");
        var token = $("meta[name='csrf-token']").attr("content");           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'update_account_status',
            data:{uid:uid,status:status,_token:token},
            success:function(data)
            {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
             redirect_notify(data.msg,'Please wait while we redirect',window.location.reload(),"success");
            }
            else
            {
                notify(data.msg, "info");
                return false;
            }
            }
        });
            return false;
        }
    })
});
$(document).on('click', '.approve_coponent', function(e)
{
     e.preventDefault();
      swal({
        title: 'Would you like to proceed?',
        text: " ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: ' Yes ',
        cancelButtonText: ' No ',
        confirmButtonClass: 'btn btn-success btn-md mybtn',
        cancelButtonClass: 'btn btn-primary btn-md mybtn',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) =>
    {
        if(result.value)
        {
        var id = $(this).attr("data-id");
        var token = $("meta[name='csrf-token']").attr("content");           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'approve_test_component',
            data:{id:id,_token:token},
            success:function(data)
            {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
             redirect_notify(data.msg,'Please wait while we redirect',window.location.reload(),"success");
            }
            else
            {
                notify(data.msg, "info");
                return false;
            }
            }
        });
            return false;
        }
    })
});
/*-----Delete Single Row Data-----*/
$(document).on('click', '.run-jobs', function(e)
{
     e.preventDefault();
      swal({
        title: 'Would you like to proceed?',
        text: " ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: ' Yes ',
        cancelButtonText: ' No ',
        confirmButtonClass: 'btn btn-success btn-md mybtn',
        cancelButtonClass: 'btn btn-primary btn-md mybtn',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) =>
    {
        if(result.value)
        {
        var token = $("meta[name='csrf-token']").attr("content");           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'test-jobs',
            data:{_token:token},
            success:function(data)
            {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
             redirect_notify(data.msg,'Please wait while we redirect',window.location.reload(),"success");
            }
            else
            {
                notify(data.msg, "info");
                return false;
            }
            }
        });
            return false;
        }
    })
});
  function loadAccessMonitoringData()
  {
    var _token = $("meta[name='csrf-token']").attr("content"); 
    var cdate=$("#monitoring_date").val();       
    var month=$("#monitoring_month").val();       
    var year=$("#monitoring_year").val();  
    var url=base_url+"access_monitoring?date="+cdate+"&month="+month+"&year="+year ;
   window.location.href=url;
    // $.ajax({
    //   url: base_url+'loadAccessMonitoringData',
    //   method: 'POST',
    //   data:{cdate:cdate,month:month,year:year,_token:_token},      
    //   success: function(resp){   
    //     resp=JSON.parse(resp);        
    //     $("#access-monitoring-data-filter").append(resp.html);
    //   }
    // });
  } 
/**************Manage footer************/ 
$("#manageBasketForm").submit(function(e)
{    e.preventDefault();    
      //var _token= $('input[name="_token"]').val();
        $elm=$(".btn4");
        $elm.hide();  
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: base_url+'manageBasketForm',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                resp=JSON.parse(resp);
                if(resp.valid==1){ 
                    redirect_notify(resp.msg,"Please wait a moment..",resp.url,"success");      
                 }else{                   
                    notify(resp.msg,"error");               
                    }
                $(".submit-loading").remove();
                $elm.show();
                return false;
            },
            error: function(data) {
            }
        });  
});
$("#formAdminRole").submit(function(e){
        e.preventDefault();
        var valid = false;
        $('[name*="permission"]').each(function(){
            if($(this).is(':checked')){
                valid = true;
            }
        })
        if(!valid){
             notify("Select at least one checkbox.","error");
            return false;
        }
        $elm = $(".btn-submit");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type        : 'POST',
            url         :  base_url+'manageAdminRole',
            data : formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                resp=JSON.parse(resp);
                if(resp.valid==1){ 
                    redirect_notify(resp.msg,"Please wait a moment..",resp.url,"success");      
                 }else{                   
                    notify(resp.msg,"error");               
                    }
                $(".submit-loading").remove();
                $elm.show();
                return false;
            },
            error: function(data) {
            }
        });
    });
$("#formAdminAccount").submit(function(e){
        e.preventDefault();
        $elm = $(".btn-submit");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw submit-loading"></i>');
        var formData = new FormData(this);
        $.ajax({
            type        : 'POST',
            url         :  base_url+'manageAdminAccount',
            data : formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                resp=JSON.parse(resp);
                if(resp.valid==1){ 
                    redirect_notify(resp.msg,"Please wait a moment..",resp.url,"success");      
                 }else{                   
                    notify(resp.msg,"error");               
                    }
                $(".submit-loading").remove();
                $elm.show();
                return false;
            },
            error: function(data) {
            }
        });
    });
//calculate plan balnce
function calculate_balance(){
  var plan_price=parseFloat($("input[name='monthly_fee']").val());
  var management_fee=parseFloat($("input[name='management_fee']").val());
  var bonus_one=parseFloat($("input[name='bonus_one']").val());
  var bonus_two=parseFloat($("input[name='bonus_two']").val());
  var bonus_three=parseFloat($("input[name='bonus_three']").val());
  var bonus_four=parseFloat($("input[name='bonus_four']").val());
  var prize=parseFloat($("input[name='prize']").val());
  var other=parseFloat($("input[name='other']").val());
var total_expense=management_fee+bonus_one+bonus_two+bonus_three+bonus_four+prize+other;
 var balance=plan_price-total_expense;
 var affiliate_share_price=balance/2;
  $("input[name='balance']").val(balance)
  $("input[name='affiliate_share_price']").val(affiliate_share_price)
}
/*-----Delete Single Row Data-----*/
$(document).on('click', '.view-survey-result', function(e)
{
     e.preventDefault();
        var token = $("meta[name='csrf-token']").attr("content");    
        var id=$(this).attr('data-id');       
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'get_survey_result',
            data:{id:id,_token:token},
            success:function(data)
            {
            $(".submit-loading").remove();
            $elm.show();
           // var data = jQuery.parseJSON(data);
                $("#survey_data_modal").modal('show')
               $("#survey_data").html(data);           
            }
        });
});





$("#manageNotificationFilter").submit(function(e)
{    e.preventDefault();
      //var _token= $('input[name="_token"]').val();
        $elm=$(".btn4");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        $(".notification_list_data").html('');
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: base_url+'notificationsfilterbydates',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                resp=JSON.parse(resp);
                $(".notification_list_data").html(resp.html);
                $("#DataTables_Table_0_paginate").css('display','none');
                $(".dataTables_info").css('display','none');

               // if(resp.valid==1){
                   // $(".notification_list_data").html(resp.html);
                    //redirect_notify(resp.msg,"Please wait a moment..",resp.url,"success");
               //  }else{
                  //  notify(resp.msg,"error");
                //    }
                $(".submit-loading").remove();
                $elm.show();
                return false;
            },
            error: function(data) {
            }
        });
});




/*----- Single Row Data-----*/
$(document).on('click', '.active_menu', function(e)
{
    // e.preventDefault();
        var token = $("meta[name='csrf-token']").attr("content");
        var id=$(this).attr('data-id');
        var type=$(this).attr('data-type');
        var val='';
         if($(this).prop("checked") == true){
                 val=1;
            }
            else if($(this).prop("checked") == false){
                val='';

            }
           $.ajax({
            method:"POST",
            url:base_url+'update_plan_menu_perimission',
            data:{id:id,val:val,type:type,_token:token},
            success:function(data)
            {
             toastr.success('Setting updated successfully');
            }
        });
});


/*----- Marina-----*/
$(document).on('click', '.run-weekly-cron-jobs', function(e)
{
     e.preventDefault();
      swal({
        title: 'Would you like to proceed?',
        text: " ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: ' Yes ',
        cancelButtonText: ' No ',
        confirmButtonClass: 'btn btn-success btn-md mybtn',
        cancelButtonClass: 'btn btn-primary btn-md mybtn',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) =>
    {
        if(result.value)
        {
        var token = $("meta[name='csrf-token']").attr("content");           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'weekly-jobs',
            data:{_token:token},
            success:function(data)
            {
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
             redirect_notify(data.msg,'Please wait while we redirect',window.location.reload(),"success");
            }
            else
            {
                notify(data.msg, "info");
                return false;
            }
            }
        });
            return false;
        }
    })
});
