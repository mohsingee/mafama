@extends('layouts.main') 
@section("content")
<style type="text/css">
    .commall, .commall2, .commall3, .commall4, .commall5 {
        border: 1px solid;
        border-radius: 4px;
        padding: 5px;
        margin: 5px 0;
    }
    .outl {
        outline: rgb(218, 41, 28) auto 6px !important;
    }
    #monthlylist, #monthlylistq, #monthlylisty, #monthlylistv, #monthlylistz, #monthlylistk {
        list-style-type: none;
        width: 100%;
        padding: 0;
        margin-bottom: 5px;
    }
    #monthlylist li, #monthlylisty li, #monthlylistq li, #monthlylistv li, #monthlylistz li, #monthlylistk li {
        display: inline-table;
        background: #da291c;
        color: white;
        padding: 3px 15px;
        margin: 10px 0;
        border-radius: 4px;
        cursor: pointer;
    }
    #monthlylist1, #monthlylist1q, #monthlylist1y, #monthlylist1v, #monthlylist1z, #monthlylist1k {
        list-style-type: none;
        width: 100%;
        padding: 0;
        margin-bottom: 5px;
    }
    #monthlylist1 li, #monthlylist1q li, #monthlylist1y li, #monthlylist1v li, #monthlylist1z li, #monthlylist1k li {
        display: inline-table;
        background: #da291c;
        color: white;
        padding: 3px 15px;
        margin: 10px 0;
        border-radius: 4px;
        cursor: pointer;
    }
    .monthlylist, .monthlylistq, .monthlylisty, .monthlylistv, .monthlylistz, .monthlylistk {
        list-style-type: none;
        width: 100%;
        padding: 0;
        margin-bottom: 5px;
    }
    .monthlylist li,.monthlylistq li, .monthlylisty li, .monthlylistv li, .monthlylistz li, .monthlylistk li {
        display: inline-table;
        background: #da291c;
        color: white;
        padding: 3px 15px;
        margin: 10px 2px;
        border-radius: 4px;
        cursor: pointer;
    }
    .monthlylist1, .monthlylist1q, .monthlylist1y, .monthlylist1v, .monthlylist1z, .monthlylist1k {
        list-style-type: none;
        width: 100%;
        padding: 0;
        margin-bottom: 5px;
    }
    .monthlylist1 li, .monthlylist1q li, .monthlylist1y li, .monthlylist1v li, .monthlylist1z li, .monthlylist1k li {
        display: inline-table;
        background: #da291c;
        color: white;
        padding: 3px 15px;
        margin: 10px 2px;
        border-radius: 4px;
        cursor: pointer;
    }
    table td a {
        color: #da291c !important;
    }
    #monthly_details th, #monthly_details td{
        text-align: left !important;
    }
    #monthly_details td{
        color: grey !important;
    }
    .table-striped tfoot tr td{
        text-align: left;
    }

    .cyear, .cmonth {
        background: #336f05 !important;
    }
    .monthlylist li.cyear, .monthlylistq li.cyear, .monthlylisty li.cyear, .monthlylistv li.cyear, .monthlylistz li.cyear, .monthlylistk li.cyear{
        background: #2b02d0!important;
    }
    .monthlylist1 li.cmonth, .monthlylist1q li.cmonth, .monthlylist1y li.cmonth, .monthlylist1v li.cmonth, .monthlylist1z li.cmonth, .monthlylist1k li.cmonth{
        background: #2b02d0!important;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs -->
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Appointments / Appointment Comparisons</h4>
                    </div>
                </div>
                <div class="col-md-12 text-right margin-bottom-20">
                    <?php if($chat != "off"){ ?>
                        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                    <?php } ?>
                    <?php if($tools != "off"){ ?>
                        <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                    <?php } ?>
                    <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>
                    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                </div>
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-button-tabs nav-justified  margin-top-10">
                        <li><a href="{{ url('comparison_appointment') }}">Monthly</a></li>
                        <li><a href="{{ url('comparison_appointment2') }}">Quarterly</a></li>
                        <li class="active"><a href="{{ url('comparison_appointment3') }}">Yearly</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <div class="tab-pane fade in active" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="comparisontabs">
                                            <div class="margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label style="margin: 12px 0;">Choose a base year</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="">
                                                            <ul class="" id="yearlist" style="display: none;">
                                                                <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                <?php } ?>
                                                            </ul>
                                                            <ul class="" id="monthlylist">
                                                                <?php foreach($years as $value){ ?>
                                                                    <li class="act">{{ $value }}</li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <!-- <i class="fas fa-plus-circle addcomprsntab"></i> -->
                                        <button class="btn btn-primary addcomprsntab" id="addcompareyear">Add Year</button>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary compare_btn" style="display: none;">Compare</button>
                                    </div>
                                    <div class="col-md-12" id="emailcampaigncount"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="allyearmonth" value="">
<script type="text/javascript">
    var x = 1;
    $(document).ready(function(){

        $(".addcomprsntab").on("click", function(){
            var yearlist = $("#yearlist").html();
            var html = '<div class="margin-top-10 commall" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;"> <div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a year to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylist"> '+ yearlist +' </ul> </div></div></div><div class="clearfix"></div></div>';
            $(".comparisontabs").append(html);
        });
        $(document).on("click", ".monthlylist li.act", function(){
            $(this).parent("ul").children("li").css("text-decoration", "none");
            $(this).parent("ul").children("li").removeClass("cyear");
            $(this).css("text-decoration", "underline");
            $(this).addClass("cyear");
            $(".compare_btn").trigger("click");
        });
        $(document).on("click", "#monthlylist li.act", function(){
            $(this).parent("ul").children("li").css("text-decoration", "none");
            $(this).parent("ul").children("li").removeClass("cyear");
            $(this).css("text-decoration", "underline");
            $(this).addClass("cyear");
            $(".compare_btn").trigger("click");
        });

    });

    $(document).on("click", ".compare_btn", function(){
        var allyearmonth = [];
        var fyear = "";
        var fmonth = "";
        fyear = $("#monthlylist li.cyear").text();
        if((fyear != "")){
            allyearmonth.push(fyear); 
        }
        $(".commall").each(function(){
            var lyear = "";
            var lmonth = "";
            $(this).find(".monthlylist li.cyear").each(function(){
                lyear = $(this).text();
            });
            if((lyear != "")){
                allyearmonth.push(lyear); 
            }
        });
        if(allyearmonth != ""){
            $.ajax({
                  type: "POST",
                  // beforeSend: function(){
                  //   $("#loading").show();
                  //   $("#wrapper").hide();
                  // },
                  url: "yearlycomappointment",
                  data:  'allyearmonth=' + allyearmonth + '&_token={{ csrf_token() }}',
                  success: function(html) {
                    // alert(html);
                    $("#emailcampaigncount").html(html);
                  },
                  // complete: function(){
                  //   $("#loading").hide();
                  //   $("#wrapper").show();
                  // }
            });
        }
        else{
            $("#emailcampaigncount").html("");
        }
    });
</script>

@endsection