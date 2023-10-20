<script>
 $(document).ready(function(){
    $('.summernote').summernote({
    height:300
});





  //  $("#owl-demo").owlCarousel({
  //     pagination: false,
  //     items : 4, //10 items above 1000px browser width
  //     itemsDesktop : [1000,4], //5 items between 1000px and 901px
  //     itemsDesktopSmall : [900,3], // betweem 900px and 601px
  //     itemsTablet: [600,2], //2 items between 600 and 0;
  //     itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
  // });
 // var owl = $("#owl-demo");
 // $(".next").click(function(){
 //    owl.trigger('owl.next');
 //  })
 //  $(".prev").click(function(){
 //    owl.trigger('owl.prev');
 //  })

})
 function getYearlyGenealogybylevel(rank_id="",level="",year="",month="",country="") {

          $("#users_data").empty();
            var url = "<?php echo url('/'); ?>/get_genealogy_user?"+'rank_id=' + rank_id + '&level=' + level +'&year='+year+'&month='+month+'&country='+country+'&_token={{ csrf_token() }}';
            $.ajax({
                  url: url,
                  beforeSend: function(){
                       // $("#rep-section").prepend('<div id="preloader">Loading...</div>');
                      },
                  // data: 'plan_id=' + plan_id + '&level=' + level + '&_token={{ csrf_token() }}',//
                  // type: "POST",
                success: function (data) {
                   var data = jQuery.parseJSON(data);
                  if(data.valid == 1)
                  {
                     var table;
                     $("#filtered_users").css('display','block');
                     $("#email_part").css('display','block');
                     $("#users_data").html(data.html);
                    // $("#dsTable").DataTable();


                  }
                  else
                  {
                    $("#filtered_users").css('display','none');
                     $("#email_part").css('display','none');
                     $("#users_data").empty();
                  }


                },
                    complete: function(){
                    //    $("#preloader").remove();

                    }
            });
          }

          function getMonthlyGenealogy(rank_id="",year="",month="",country="") {

          $("#users_data").empty();
            var url = "<?php echo url('/'); ?>/get_genealogy_user_monthly?"+'rank_id=' + rank_id +'&year='+year+'&month='+month+'&country='+country+'&_token={{ csrf_token() }}';
            $.ajax({
                  url: url,
                  beforeSend: function(){
                       // $("#rep-section").prepend('<div id="preloader">Loading...</div>');
                      },
                  // data: 'plan_id=' + plan_id + '&level=' + level + '&_token={{ csrf_token() }}',//
                  // type: "POST",
                success: function (data) {
                   var data = jQuery.parseJSON(data);

                  if(data.valid == 1)
                  {
                     var table;
                     $("#filtered_users").css('display','block');
                     $("#email_part").css('display','block');
                     $("#users_data").html(data.html);
                    // $("#dsTable").DataTable();


                  }
                  else
                  {
                    $("#filtered_users").css('display','none');
                     $("#email_part").css('display','none');
                     $("#users_data").empty();
                  }


                },
                    complete: function(){
                    //    $("#preloader").remove();

                    }
            });
          }
           function getQuaterlyGenealogy(rank_id="",start_date="",end_date="",month="",country=""){

          $("#users_data").empty();
            var url = "<?php echo url('/'); ?>/get_genealogy_user_quaterly?"+'rank_id=' + rank_id +'&start_date='+start_date+'&end_date='+end_date+'&month='+month+'&country='+country+'&_token={{ csrf_token() }}';
            $.ajax({
                  url: url,
                  beforeSend: function(){
                       // $("#rep-section").prepend('<div id="preloader">Loading...</div>');
                      },
                  // data: 'plan_id=' + plan_id + '&level=' + level + '&_token={{ csrf_token() }}',//
                  // type: "POST",
                success: function (data) {
                   var data = jQuery.parseJSON(data);
                   
                  if(data.valid == 1)
                  {
                     var table;
                     $("#filtered_users").css('display','block');
                     $("#email_part").css('display','block');
                     $("#users_data").html(data.html);
                    // $("#dsTable").DataTable();


                  }
                  else
                  {
                    $("#filtered_users").css('display','none');
                     $("#email_part").css('display','none');
                     $("#users_data").empty();
                  }


                },
                    complete: function(){
                    //    $("#preloader").remove();

                    }
            });
          }

          function getYearlyMemberbylevel(plan_id="",level="",year="",country=""){

          $("#users_data").empty();
            var url = "<?php echo url('/'); ?>/get_yearly_member?"+'plan_id=' + plan_id +'&level='+level+'&year='+year+'&country='+country+'&_token={{ csrf_token() }}';
            $.ajax({
                  url: url,
                  beforeSend: function(){
                       // $("#rep-section").prepend('<div id="preloader">Loading...</div>');
                      },
                  // data: 'plan_id=' + plan_id + '&level=' + level + '&_token={{ csrf_token() }}',//
                  // type: "POST",
                success: function (data) {
                   var data = jQuery.parseJSON(data);
                   
                  if(data.valid == 1)
                  {
                     var table;
                     $("#filtered_users").css('display','block');
                     $("#email_part").css('display','block');
                     $("#users_data").html(data.html);
                    // $("#dsTable").DataTable();


                  }
                  else
                  {
                    $("#filtered_users").css('display','none');
                     $("#email_part").css('display','none');
                     $("#users_data").empty();
                  }


                },
                    complete: function(){
                    //    $("#preloader").remove();

                    }
            });
          }

          function getMonthlyMember(month="",plan_id="",year="",country=""){

          $("#users_data").empty();
            var url = "<?php echo url('/'); ?>/get_monthly_member?"+'plan_id=' + plan_id +'&month='+month+'&year='+year+'&country='+country+'&_token={{ csrf_token() }}';
            $.ajax({
                  url: url,
                  beforeSend: function(){
                       // $("#rep-section").prepend('<div id="preloader">Loading...</div>');
                      },
                  // data: 'plan_id=' + plan_id + '&level=' + level + '&_token={{ csrf_token() }}',//
                  // type: "POST",
                success: function (data) {
                   var data = jQuery.parseJSON(data);
                   
                  if(data.valid == 1)
                  {
                     var table;
                     $("#filtered_users").css('display','block');
                     $("#email_part").css('display','block');
                     $("#users_data").html(data.html);
                    // $("#dsTable").DataTable();


                  }
                  else
                  {
                    $("#filtered_users").css('display','none');
                     $("#email_part").css('display','none');
                     $("#users_data").empty();
                  }


                },
                    complete: function(){
                    //    $("#preloader").remove();

                    }
            });
          }
          function getQuarterlyMember(plan_id="",start_date="",end_date="",country=""){

          $("#users_data").empty();
            var url = "<?php echo url('/'); ?>/get_quarterly_member?"+'plan_id=' + plan_id +'&start_date='+start_date+'&end_date='+end_date+'&country='+country+'&_token={{ csrf_token() }}';
            $.ajax({
                  url: url,
                  beforeSend: function(){
                       // $("#rep-section").prepend('<div id="preloader">Loading...</div>');
                      },
                  // data: 'plan_id=' + plan_id + '&level=' + level + '&_token={{ csrf_token() }}',//
                  // type: "POST",
                success: function (data) {
                   var data = jQuery.parseJSON(data);
                   
                  if(data.valid == 1)
                  {
                     var table;
                     $("#filtered_users").css('display','block');
                     $("#email_part").css('display','block');
                     $("#users_data").html(data.html);
                    // $("#dsTable").DataTable();


                  }
                  else
                  {
                    $("#filtered_users").css('display','none');
                     $("#email_part").css('display','none');
                     $("#users_data").empty();
                  }


                },
                    complete: function(){
                    //    $("#preloader").remove();

                    }
            });
          }
  function getYearlyGenealogyRecord(rank_id,year,month,country) {
       $("#filtered_data").empty();
        var url = "<?php echo url('/'); ?>/get_genealogy_total_user?"+'rank_id=' + rank_id +'&year=' + year + '&month='+month+'&country='+country+'&_token={{ csrf_token() }}';
          $.ajax({
                  url: url,
                  beforeSend: function(){
                       // $("#rep-section").prepend('<div id="preloader">Loading...</div>');
                      },
                  // data: 'plan_id=' + plan_id + '&level=' + level + '&_token={{ csrf_token() }}',//
                  // type: "POST",
                success: function (response) {
                    $("#filtered_data").html(response);
                },
                    complete: function(){
                    //    $("#preloader").remove();

                    }
            });
  }
</script>
<script>


    $(document).on('click','.script_des',function(){
            var text = $(this).html();

            var prevtext1 = $(".summernote1").summernote('code');
            var prevtext2 = $(".summernote2").summernote('code');
            var prevtext3 = $(".summernote3").summernote('code');
            // alert(prevtext);
            if(prevtext1 != null){
                $(".summernote1").summernote('code',prevtext1+"<br>"+text);
                $(".summernote2").summernote('code',prevtext2+"<br>"+text);
                $(".summernote3").summernote('code',prevtext3+"<br>"+text);
            }
            else{
                $(".summernote1").summernote('code',text);
                $(".summernote2").summernote('code',text);
                $(".summernote3").summernote('code',text);
            }
        });

        $(".personalized_btn").click(function(){
            $(".personalized_sec").toggle();
        });

        $(".scripts_btn").click(function(){
            $(".scripts_sec").toggle();
        });

        $(".greetings").click(function(){
            // alert($(this).html());
            if($(this).hasClass('btn-info')){
                $(".greetings.btn-info").addClass("btn-black");
                $(".greetings.btn-info").removeClass("btn-info");
                $("#greeting").val("");
                $(this).addClass("btn-black");
                $(this).removeClass("btn-info");
            }
            else{
                $(".greetings.btn-info").addClass("btn-black");
                $(".greetings.btn-info").removeClass("btn-info");
                $("#greeting").val($(this).html());
                $(this).removeClass("btn-black");
                $(this).addClass("btn-info");
            }
        });

        $(document).on("click",".note-color-btn",function(){
            $("#forecolorr").val($(this).attr("data-value"))
            // note-recent-color
        });
  $(document).on('click','.checkboxes',function(){
        if ($(this).prop('checked')) {
            $(this).addClass("checked");
            var mail_arr = [];
            $(".checkboxes.checked").each(function() {
                var id = $(this).val();
                mail_arr.push(id);
            });
            // alert(mail_arr);
            var id = $(this).val();
            var url = "<?php echo url('/'); ?>/get_checked_email";
            $.ajax({
                  url: url,
                  data: 'mail_arr=' + mail_arr + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    var marr = [];
                    for (var i = 0; i < response.length; ++i) {
                        marr.push(response[i]);
                    }
                    $('.malto').val(marr);
                    // mail_arr.push(response);
                }
            });
        }
        else{
            $(this).removeClass("checked");
            var id = $(this).val();
            var smail = "";
            var mails = $(".malto").val();
            $.ajax({
                  url: "<?php echo url('/'); ?>/un_checked_email",
                  data: 'id=' + id + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    smail = response;
                }
            })
            .then( function( data ) {
                $.ajax({
                    url:  "<?php echo url('/'); ?>/unchecked_email_boxes",
                    data: 'id=' + id + '&mails=' + mails + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function (response) {
                        $('.malto').val(response);
                    }
                });
            });
        }
    });
  $(document).on("change", ".group-checkable", function(){

        if($(this).prop('checked')){
            $(".checkboxes").prop("checked", false);
            $(".checkboxes").addClass("checked");
            $(".checkboxes").trigger('click');
            var mail_arr = [];
            $(".checkboxes.checked").each(function() {
                var id = $(this).val();
                mail_arr.push(id);
            });

            var id = $(this).val();
            var url = "<?php echo url('/'); ?>/get_checked_email";
            $.ajax({
                  url: url,
                  data: 'mail_arr=' + mail_arr + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    var marr = [];
                    for (var i = 0; i < response.length; ++i) {
                        marr.push(response[i]);
                    }
                    $('.malto').val(marr);
                    mail_arr.push(response);
                }
            });
        }
        else{
            $(".checkboxes").prop("checked", false);
            $(".gradeX").removeClass("active");
            $(".checkboxes").removeClass("checked");
            // $(".checkboxes").trigger('click');
            $('.malto').val("");
        }
    });

    $(document).on("change", "tbody tr .checkboxes", function () {
        if ($(this).prop('checked')) {

        }
        else{
            $(".group-checkable").prop('checked', false);
        }
    });
    $(document).ready(function(){
        $(".dateonsub").click(function(){
            $(".dateon").show();
            $(".reminderon").hide();
        });
        $(".reminderonsub").click(function(){
            $(".reminderon").show();
            $(".dateon").hide();
        });
    });
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#reminderdate').attr('min', maxDate);
        $('#sendon').attr('min', maxDate);
    });
    $(document).ready(function(){

        $("#sendon").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change");
        $("#reminderdate").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change");
        $(".subbtn").click(function() {
            var submit_value = $(this).text();
            // alert(submit_value);
            $("#submit_button").val(submit_value);
            $("#submit_button").trigger('click');
        });


$("#client_manage_submit").submit(function(e) {
            //---------------^---------------
            e.preventDefault();
            if($(".malto").val() == ""){
                $("#emailer").html("Please select atleast one client !!");
                $('html, body').animate({
                    scrollTop: $(".nav-button-tabs").offset().top
                }, 500);
            }
            else{

                $("#emailer").html("");
                if($(".summernote").summernote('code') == ""){
                    $("#textre").html("Please Enter message !!!");
                    $('html, body').animate({
                        scrollTop: $(".summernote1").offset().top
                    }, 500);
                }
                else{
                     // $elm=$(this);
                     // $elm.hide();
                     // $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

                    $("#textre").html("");
                    var submit_value  = $("#submit_button").val();
                    var message       = $(".summernote").summernote('code');
                    var bakg          = $("#bakg").val();
                    var formData = new FormData(this);
                    formData.append("message", message);
                    formData.append("bakg", bakg);
                    if(submit_value == "Send Now"){
                        $.ajax({
                          type: "POST",
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          url: "{{url('admin_manage_client_submit')}}",
                          data:  formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                          success: function(html) {
                            // alert(html);
                            $(".checkboxes").prop('checked', false);
                            $(".group-checkable").prop('checked', false);
                            $("tbody tr").removeClass("active");
                             $('#subject1').val("");
                            $("#success_card").html(html);
                            $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                            $('.malto').val("");
                            $('#subject').val("");
                            $(".summernote").summernote('code','');
                            $(".note-editable").css("background-color", '');
                          },
                          complete: function(){
                            $("#loading").hide();
                            $("#wrapper").show();
                          }
                        });
                    }
                    else if(submit_value == "Send On"){
                        if($("#sendon").val() == "")
                        {
                            $("#send_on_alert").html("Date is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "{{url('admin_manage_client_send_on')}}",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                // alert(html);
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                                $("#success_card").html(html);
                                $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject').val("");
                                $(".summernote").summernote('code','');
                                $("#sendon").val("");
                                $(".dateon").hide();
                                    $(".note-editable").css("background-color", '');
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                              }
                            });
                        }
                    }
                    else if(submit_value == "Save"){

                        if($("#reminderdate").val() == "")
                        {
                            $("#reminder_date_alert").html("Date is required!");
                        }
                        else if($("#remindertime").val() == "")
                        {
                            $("#reminder_date_alert").hide();
                            $("#reminder_time_alert").html("Time is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "{{url('admin_manage_client_send_with_reminder')}}",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                               // $(".greetings").removeClass("btn-info");
                                $("#success_card").html(html);
                                $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject1').val("");
                                $(".summernote").summernote('code','');
                                $(".reminderon").hide();
                                $("#reminderdate").val("");
                                $("#remindertime").val("");
                                $(".note-editable").css("background-color", '');
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                                $(".scroll").trigger('click');
                              }
                            });
                        }
                    }
                }
            }
        });

      $(".prvbtn").click(function(){
            var bakg  = $("#bakg").val();
            var message  = $(".summernote").summernote('code');
            var url = "<?php echo url('/'); ?>/admin_user_banner_details";
            $.ajax({
                  url: url,
                  data: '_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    var user_banner = response;
                    var preview = '<div style="padding:10px; background-color:'+bakg+'"><div style="padding: 5px">'+user_banner+'</div><p style="margin-bottom: 0;">'+message+'</p></div>';
                    $("#modall #modal-body").html(preview);
                    $('#modall').modal('show');
                }
            });

        });


    });
    $(document).on('click', ".scroll", function() {
        var d = $("section");
        d.scrollTop(d[0].scrollHeight);
    });



   $(".color-td").click(function () {
                var color = $(this).css("background-color");
                //alert(color);
                $(".note-editable").css("background-color", color);
                //some code
            });

        $(".color-td").click(function(){
           var classs = $(this).attr("class");
           var cls = classs.split("color-td ");
           var mainc = cls[1];
           // alert(mainc);
           var bakg = $(this).css("background-color");
           // alert(bakg);
           $("#bakg").val(bakg);
       });

    function titleClick(id)
    {
        $(".personalized_sec").hide();
        $(".scripts_sec").hide();
        var email = [];
        var active = $('.activetab li').find('.active').attr('data-id');

        $.ajax({
              url: '<?=url('/')?>/admin_emmail_prev_details',
              data: 'id=' + id + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                for(var i=0; i < response.length; i++)
                {
                    email.push(response[i]['email']);
                    // alert(email);
                }
                var base_url = {!! json_encode(url('/')) !!};
                // alert(base_url);
                $("#"+active+" input[name=subject]").val(response[0]['subject']);
                $(".previmgsec").show();
                $("#previmg").attr('src', base_url+"/public/videos/"+response[0]['image']);
                $("#previmage").val(response[0]['image']);
                $("#"+active+" .summernote").summernote('code',response[0]['message']);
                $("#forecolorr").val(response[0]['forecolorr']);
                $(".note-editable").css("background-color", response[0]['backhground']);
                $("#bakg").val(response[0]['backhground']);
                $("#img_path").removeAttr("required");
                $("#malto").val("");
                $(".email-ids .ema").parent().remove();
                $("#greeting").val(response[0]['greeting']);
                if(response[0]['greeting'] != null){
                    $(".personalized_sec").show();
                    $(".greetings.btn-info").addClass('btn-black');
                    $(".greetings.btn-info").removeClass('btn-info');
                    $(".greetings#"+response[0]['greeting']).trigger('click');
                }
                else{
                    $(".greetings.btn-info").addClass('btn-black');
                    $(".greetings.btn-info").removeClass('btn-info');
                    $(".personalized_sec").hide();
                    $(".scripts_sec").hide();
                }
            }
        }).then( function( data ) {
            $.ajax({
                url: '<?=url('/')?>/admin_title_wise_email',
                data: 'email=' + email + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function (response) {
                    $("#contact_sec").html(response);
                        if($("#contactall").is(':checked')){
                            $("#contactall").prop("checked", false);
                        }
                    $('.contact_mail').trigger('click');
                }
            })
        });
    }
var x=3;
 $('.parent-<?=get_business_category();?> div:lt('+x+')').show();
</script>
<?php
foreach($scripts as $value){ ?>
<script>
     $('.parent-<?=$value->category;?> div:lt('+x+')').show();
</script>
<?php } ?>
<script>
   $(document).ready(function(){
    $('.loadMore').click(function () {
        var cls=$(this).attr('data-id');
        var size = $('.child-'+cls).length;
        x= (x+3 <= size) ? x+3 : size;
        $('.parent-'+cls+' div:lt('+x+')').show();

    });
    $('.showLess').click(function () {
        var cls=$(this).attr('data-id');
         var size = $('.child-'+cls).length;
         x=(x-3< 0) ? 3 : x-3;
         if(x<=0)
         {
             x=size-3;
         }
         $('.parent-'+cls+' div').not(':lt('+x+')').hide();

    });




});

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".card_img").click(function()
        {
            // alert($(this).attr('src'));
            $(".card_img").css({'border' : 'none', 'padding' : '0'})
            var img_path = $(this).attr('src');
            $("#img_path").val(img_path);
            $(this).css({'border' : '3px solid red', 'padding' : '2px'});
        });
    });
    $(document).ready(function(){
        $(".dateonsub1").click(function(){
            $(".dateon1").show();
            $(".reminderon1").hide();
        });
        $(".reminderonsub1").click(function(){
            $(".reminderon1").show();
            $(".dateon1").hide();
        });
    });
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#reminderdate1').attr('min', maxDate);
        $('#sendon1').attr('min', maxDate);
    });
    $(document).ready(function(){
        $("#sendon1").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change");
        $("#reminderdate1").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change");
        $(".subbtn1").click(function() {
            var submit_value = $(this).text();
            // alert(submit_value);
            $("#submit_button1").val(submit_value);
            $("#submit_button1").trigger('click');
        });

        $("#manage_client_card_submit_new").submit(function(e) {
            //---------------^---------------
            e.preventDefault();
            if($(".malto").val() == ""){
                $("#emailer").html("Please select atleast one client !!");
                $('html, body').animate({
                    scrollTop: $(".nav-tabs").offset().top
                }, 500);
            }
            else{

                $("#emailer").html("");
                if($(".summernote2").summernote('code') == ""){
                    $("#textre1").html("Please Enter message !!!");
                    $('html, body').animate({
                        scrollTop: $(".summernote2").offset().top
                    }, 500);
                }
                else{

                    $("#textre1").html("");
                    var submit_value  = $("#submit_button1").val();
                    var message       = $(".summernote2").summernote('code');
                    var formData = new FormData(this);
                    formData.append("message", message);
                    if(submit_value == "Send Now"){
                        $.ajax({
                          type: "POST",
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          url: "{{url('admin_manage_client_card_submit')}}",
                          data:  formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                          success: function(html) {
                            // alert(html);
                            $(".checkboxes").prop('checked', false);
                            $(".group-checkable").prop('checked', false);
                            $("tbody tr").removeClass("active");
                            $("#success_card1").html(html);
                            $('#success_card1').fadeIn('fast').delay(20000).fadeOut('fast');
                            $('.malto').val("");
                            $('#subject2').val("");
                            $(".summernote2").summernote('code','');
                            $(".note-editable").css("background-color", '');
                          },
                          complete: function(){
                            $("#loading").hide();
                            $("#wrapper").show();
                          }
                        });
                    }
                    else if(submit_value == "Send On"){
                        if($("#sendon1").val() == "")
                        {
                            $("#send_on_alert1").html("Date is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "{{url('admin_manage_client_card_send_on')}}",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                // alert(html);
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                                $("#success_card1").html(html);
                                $('#success_card1').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject2').val("");
                                $(".summernote2").summernote('code','');
                                $("#sendon1").val("");
                                $(".dateon1").hide();
                                $(".note-editable").css("background-color", '');
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                              }
                            });
                        }
                    }
                    else if(submit_value == "Send With Reminder"){

                        if($("#reminderdate1").val() == "")
                        {
                            $("#reminder_date_alert1").html("Date is required!");
                        }
                        else if($("#remindertime1").val() == "")
                        {
                            $("#reminder_date_alert1").hide();
                            $("#reminder_time_alert1").html("Time is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "{{url('admin_manage_client_card_send_with_reminder')}}",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                                $("#success_card1").html(html);
                                $('#success_card1').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject2').val("");
                                $(".summernote2").summernote('code','');
                                $(".reminderon1").hide();
                                $("#reminderdate1").val("");
                                $("#remindertime1").val("");
                                $(".note-editable").css("background-color", '');
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                                $(".scroll").trigger('click');
                              }
                            });
                        }
                    }
                }
            }
        });
        $(".prvbtn1").click(function(){
            var message  = $(".summernote2").summernote('code');
            var url = "<?php echo url('/'); ?>/admin_user_banner_details";
            $.ajax({
                  url: url,
                  data: '_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    var user_banner = response;
                    var preview = '<div style="padding:10px;"><div style="padding: 20px">'+user_banner+'</div><p style="margin-bottom: 0;">'+message+'</p></div>';
                    $("#modall #modal-body").html(preview);
                    $('#modall').modal('show');
                }
            });

        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".dateonsub2").click(function(){
            $(".dateon2").show();
            $(".reminderon2").hide();
        });
        $(".reminderonsub2").click(function(){
            $(".reminderon2").show();
            $(".dateon2").hide();
        });
    });
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#reminderdate2').attr('min', maxDate);
        $('#sendon2').attr('min', maxDate);
    });
    $(document).ready(function(){
        $("#sendon2").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change");
        $("#reminderdate2").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change");
        $(".subbtn2").click(function() {
            var submit_value = $(this).text();
            // alert(submit_value);
            $("#submit_button2").val(submit_value);
            $("#submit_button2").trigger('click');
        });
        $("#manage_client_video_submit_new").submit(function(e) {
            //---------------^---------------
            e.preventDefault();
            if($(".malto").val() == ""){
                $("#emailer").html("Please select atleast one client !!");
                $('html, body').animate({
                    scrollTop: $(".nav-tabs").offset().top
                }, 500);
            }
            else{

                $("#emailer").html("");
                if($(".summernote3").summernote('code') == ""){
                    $("#textre2").html("Please Enter message !!!");
                    $('html, body').animate({
                        scrollTop: $(".summernote3").offset().top
                    }, 500);
                }
                else{
                    $("#textre2").html("");
                    var submit_value  = $("#submit_button2").val();
                    var message       = $(".summernote3").summernote('code');
                    var formData = new FormData(this);
                    formData.append("message", message);
                    if(submit_value == "Send Now"){
                        $.ajax({
                          type: "POST",
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          url: "{{url('admin_manage_client_video_submit')}}",
                          data:  formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                          success: function(html) {
                            // alert(html);
                            $(".checkboxes").prop('checked', false);
                            $(".group-checkable").prop('checked', false);
                            $("tbody tr").removeClass("active");
                            $("#success_card2").html(html);
                            $('#success_card2').fadeIn('fast').delay(20000).fadeOut('fast');
                            $('.malto').val("");
                            $('#subject3').val("");
                            $(".summernote3").summernote('code','');
                            $(".note-editable").css("background-color", '');
                          },
                          complete: function(){
                            $("#loading").hide();
                            $("#wrapper").show();
                          }
                        });
                    }
                    else if(submit_value == "Send On"){
                        if($("#sendon2").val() == "")
                        {
                            $("#send_on_alert2").html("Date is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "{{url('admin_manage_client_video_send_on')}}",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                // alert(html);
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                                $("#success_card2").html(html);
                                $('#success_card2').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject3').val("");
                                $(".summernote3").summernote('code','');
                                $("#sendon2").val("");
                                $(".dateon2").hide();
                                $(".note-editable").css("background-color", '');
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                              }
                            });
                        }
                    }
                    else if(submit_value == "Send With Reminder"){

                        if($("#reminderdate2").val() == "")
                        {
                            $("#reminder_date_alert2").html("Date is required!");
                        }
                        else if($("#remindertime2").val() == "")
                        {
                            $("#reminder_date_alert2").hide();
                            $("#reminder_time_alert2").html("Time is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "{{url('admin_manage_client_video_send_with_reminder')}}",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                                $("#success_card2").html(html);
                                $('#success_card2').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject3').val("");
                                $(".summernote3").summernote('code','');
                                $(".reminderon2").hide();
                                $("#reminderdate2").val("");
                                $("#remindertime2").val("");
                                $(".note-editable").css("background-color", '');
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                                $(".scroll").trigger('click');
                              }
                            });
                        }
                    }
                }
            }
        });
        $(".prvbtn2").click(function(){
            var message  = $(".summernote3").summernote('code');
            var url = "<?php echo url('/'); ?>/admin_user_banner_details";
            $.ajax({
                  url: url,
                  data: '_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    var user_banner = response;
                    var preview = '<div style="padding:10px;"><div style="padding: 20px">'+user_banner+'</div><p style="margin-bottom: 0;">'+message+'</p></div>';
                    $("#modall #modal-body").html(preview);
                    $('#modall').modal('show');
                }
            });

        });
    });



/**************Manage footer************/


$("#filterForm").submit(function(e)
{    e.preventDefault();

        $elm=$(".btn4");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $('.report_data').empty();
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            beforeSend: function(){
                $("#loading").show();
                $("#wrapper").hide();
              },
            url: "{{url('get_genealogyfilter_data')}}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                $(".submit-loading").remove();
                $elm.show();
                $('.report_data').html(resp);
            },
            error: function(data) {
            },
            complete: function(){
               $("#loading").hide();
              $("#wrapper").show();
            $(".scroll").trigger('click');
          }
        });
});






</script>