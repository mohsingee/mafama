



/**************Manage user profile************/ 
$("#manageVerification").submit(function(e)
{    
    e.preventDefault();
        $elm=$(".btn1");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: base_url+'manageVerification',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                resp=JSON.parse(resp);
                if(resp.valid==1){ 
                    redirect_notify(resp.msg," ",resp.url,"success");      
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





/**************Manage user profile************/ 


$("#updateuserprofile").submit(function(e)
{    
    e.preventDefault();
        $elm=$(".btn1");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: base_url+'updateUser',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                resp=JSON.parse(resp);
                if(resp.valid==1){ 
                    redirect_notify(resp.msg," ",resp.url,"success");      
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

/******************Update password*********************/
$("#updatePassword").submit(function(e)
{    
    e.preventDefault();
        $elm=$(".btn1");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: base_url+'updatePassword',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                resp=JSON.parse(resp);
                if(resp.valid==1){ 
                    redirect_notify(resp.msg," ",resp.url,"success");      
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


/******************Manage amount deposit*********************/
$("#managedeposit").submit(function(e)
{    
    e.preventDefault();
     swal({
        title: 'Would you like to proceed?',
        text: " ",
        type: 'info',
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
            $elm=$(".btn4");
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
            $form=$(this);
            var formData = new FormData(this);
            $.ajax({
                method: 'POST',
                url: base_url+'manageDepositMoney',
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(resp) {
                    resp=JSON.parse(resp);
                    if(resp.valid==1){ 
                        redirect_notify(resp.msg," ",resp.url,"success");      
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
        }
    });

         
});


/******************Manage amount Withdraw*********************/
$("#manageWithdraw").submit(function(e)
{    
    e.preventDefault();

     swal({
        title: 'Would you like to proceed?',
        text: "",
        type: 'info',
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
            $elm=$(".btn4");
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
            $form=$(this);
            var formData = new FormData(this);
            $.ajax({
                method: 'POST',
                url: base_url+'manageWidthdrawMoney',
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(resp) {
                    resp=JSON.parse(resp);
                    if(resp.valid==1){ 
                        redirect_notify(resp.msg,resp.msg2,resp.url,"success");      
                     }else{                   
                        notify(resp.msg,"info");               
                        }
                    $(".submit-loading").remove();
                    $elm.show();
                    return false;
                },
                error: function(data) {
                }
            }); 

        }
    })     
});

/******************Update password*********************/
$("#manageinvestmentform").submit(function(e)
{    
    e.preventDefault();
    var amount =$('input[name="invest_amount"]').val();
    var username =$('input[name="user_name"]').val();
    var project_name =$('input[name="project_name"]').val();
    if(amount=='')
    {
        return false;
    }
    
      swal({
        //title: 'Dear '+username+', you decided to invest '+amount+' USD on '+project_name,
        //text: "Are you sure?",
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
        $elm=$(".btn4");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: base_url+'manageinvestmentform',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
             beforeSend: function () {
                $(".btn4").addClass("btn-formloading");
                $(".btn4").append('<div class="la-ball-clip-rotate"><div></div></div>');
                
                },
            success: function(resp) {
                resp=JSON.parse(resp);
                if(resp.valid==1){ 
                    redirect_notify(resp.msg," ",resp.url,"success");      
                 }
                 else if(resp.valid==2){
                     window.location.href=resp.url;
                 }
                 else{                   
                    notify(resp.msg,"error");               
                    }
                 $(".btn4").removeClass("btn-formloading");
                $(".btn4").find('.la-ball-clip-rotate').remove();    
                $(".submit-loading").remove();
                $elm.show();
                return false;
            },
            error: function(data) {
            }
        }); 
     }
  });  
});


$(document).on('click', '.submit-request', function(e)
{
     e.preventDefault();
      swal({
        title: 'Would you like to proceed?',
        text: " ",
        type: 'info',
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
        var ref_id = $(this).attr("data-ref_id");
        var token = $("meta[name='csrf-token']").attr("content");           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'submitDepositRequest',
            data:{id:id,ref_id:ref_id,_token:token},
            success:function(data)
            {
                
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
             redirect_notify(data.msg,'Please wait while we redirect',data.url,"success");

            }
            else
            {
                notify(data.msg, "info");
                return false;
                    
            }
            }
        });
        }
    })  
    
});



$(document).on('click', '.exit-invest', function(e)
{
     e.preventDefault();
     
      swal({
        title: 'Would you like to proceed?',
        text: "",
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
        //alert(id);
        var uid = $(this).attr("data-uid");        
        var pid = $(this).attr("data-pid");        
        var fee = $(this).attr("data-fee");        
        var amount = $(this).attr("data-price");        
        var pstatus = $(this).attr("data-pstatus");        
        var token = $("meta[name='csrf-token']").attr("content");           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'exitFromRequest',
            data:{id:id,uid:uid,pid:pid,fee:fee,pstatus:pstatus,amount:amount,_token:token},
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


$(document).on('click', '#invest-project-btn1', function(e)
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
          document.invest_project_form1.submit();   
        
        }
    })
    
});


$(document).on('click', '#invest-project-btn-send', function(e)
{
     e.preventDefault();
    /*** 
      swal({
        title: 'Would you like to proceed?',
        text: "Are you sure for Invest ",
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
        { **/
          $("#invest-project-form").submit();   
        
    /**    }
    })***/
    
});




function confirm_redirect(url,type,form_id)
{
    
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
            
             $("#"+form_id).submit(); 
        
        }
    })
    
}



function redirect(url,type)
{
    window.location.href=url;  
    /***
      swal({
        title: 'Would you like to proceed?',
        text: "Are you sure for  "+type,
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
            
             window.location.href=url;  
        
        }
    })***/
    
}



$(document).on('click', '#invest-project-btn', function(e)
{
     e.preventDefault();
     
      swal({
        title: 'Would you like to proceed?',
        text: "",
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
            var id = $(this).attr("data-id");
             window.location.href=base_url+'ChooseInvestAmount/'+id;  
        
        }
    })
    
});



$(document).on('click', '#invest-send-form', function(e)
{
     e.preventDefault();
      
        var id = $(this).attr("data-id");
        var token = $("meta[name='csrf-token']").attr("content");   
       // alert(token);
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:base_url+'investSendForm',
            data:{id:id,_token:token},
            success:function(data)
            {
                
            $(".submit-loading").remove();
            $elm.show();
            var data = jQuery.parseJSON(data);
            if(data.valid == 1)
            {  
              window.location.href=data.url;  
            // redirect_notify(data.msg,'Please wait while we redirect',window.location.reload(),"success");

            }
            else
            {
                notify(data.msg, "info");
                return false;
                    
            }
            }
        });
    
});




/******************Manage Contact Us Form*********************/
$("#reset_password_form").submit(function(e)
{    
    e.preventDefault();
   // $("#errors").html('');
        $elm=$(".btn1");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: base_url+'reset_password',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                resp=JSON.parse(resp);
                if(resp.status==1){ 
                   redirect_notify(resp.message," ",resp.url,"success"); 
                 //   $(".fstatus").html("<div class='alert alert-success'>"+resp.msg+"</div>");
                 }else{                   
                    notify(resp.message,"error");   
                 //  $("#error").append("<div class='alert alert-danger'>"+resp.message+"</div>");
                    }
               
                $(".submit-loading").remove();
                $elm.show();
                return false;
            },
        
          error: function(xhr, status, error) 
        {

          $.each(xhr.responseJSON.errors, function (key, item) 
          {
            $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
          });

        }
        });  
});






/******************Manage Contact Us Form*********************/
$("#ContactUs_form").submit(function(e)
{    
    e.preventDefault();
        $elm=$(".btn1");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: base_url+'contact_us_form',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                resp=JSON.parse(resp);
                if(resp.valid==1){ 
                   // redirect_notify(resp.msg," ",resp.url,"success"); 
                    $(".fstatus").html("<div class='alert alert-success'>"+resp.msg+"</div>");
                 }else{                   
                   // notify(resp.msg,"error");   
                   $(".fstatus").html("<div class='alert alert-danger'>"+resp.msg+"</div>");
                    }
                 $('#ContactUs_form')[0].reset();   
                $(".submit-loading").remove();
                $elm.show();
                return false;
            },
            error: function(data) {
            }
        });  
});

//data filter

$(document).on('click','.inactive_btn',function(){
    var active=1;
    if ($(this).is(":checked")) {
             loadAllInvestmentData();  
            } 
            else {
               loadAllInvestmentData(active);  
            }
    
});



  function loadAllInvestmentData(active="")
  {

    var _token = $("meta[name='csrf-token']").attr("content"); 
           
    $.ajax({
      url: base_url+'loadAllInvestmentData',
      method: 'POST',
      data:{active:active,_token:_token},      
      success: function(resp){   
        resp=JSON.parse(resp);        
        $(".user-investment-list").html(resp.html);
       /**
         $("#sample_1_info").css("display","none");
          $("#sample_1_paginate").css("display","none");
           $("#sample_2_info").css("display","none");
          $("#sample_2_paginate").css("display","none");
           $("#sample_4_info").css("display","none");
          $("#sample_4_paginate").css("display","none");***/
      }
    });
  } 

function calc(){
var cal_amount=$("#cal_amount").val();
if(cal_amount!='')
{
    $elm=$(".btn7");
    $elm.hide();
    $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
    var cal_amount=$("#cal_amount").val();
    var cal_rate=$("#cal_rate").val();
    var cal_term=$("#cal_term").val();
        cal_amount=parseFloat(cal_amount);
        cal_rate=parseFloat(cal_rate);
        cal_term=parseInt(cal_term);
    var term  =cal_term*30;
    var interest=(cal_amount*cal_rate)/100
    var earning=cal_term*interest;
      earning=parseFloat(earning);
    var return_amount=cal_amount+earning;
    $(".calc-result").show();
    $(".calc-deposit-amount").text(cal_amount.toFixed(2)+' EUR');
    $(".calc-yield-amount").text(earning.toFixed(2)+' EUR');
    $(".calc-return-amount").text(return_amount.toFixed(2)+' EUR');
    $(".calc-term").text('After '+term+' Days');
    $(".submit-loading").remove();
    $elm.show();
}
}
