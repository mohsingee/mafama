@extends('layouts.main') 
@section("content")
<link href="{{ asset('public/morris/morris.css') }}" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('public/morris/morris.min.js') }}" type="text/javascript"></script>
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
    #monthlylist {
        list-style-type: none;
        width: 100%;
        padding: 0;
        margin-bottom: 5px;
    }
    #monthlylist li {
        display: inline-table;
        background: #da291c;
        color: white;
        padding: 3px 25px;
        margin: 10px 0;
        border-radius: 4px;
        cursor: pointer;
    }
    #monthlylist1 {
        list-style-type: none;
        width: 100%;
        padding: 0;
        margin-bottom: 5px;
    }
    #monthlylist1 li {
        display: inline-table;
        background: #da291c;
        color: white;
        padding: 3px 15px;
        margin: 10px 0;
        border-radius: 4px;
        cursor: pointer;
    }
    .monthlylist {
        list-style-type: none;
        width: 100%;
        padding: 0;
        margin-bottom: 5px;
    }
    .monthlylist li {
        display: inline-table;
        background: #da291c;
        color: white;
        padding: 3px 15px;
        margin: 10px 2px;
        border-radius: 4px;
        cursor: pointer;
    }
    .monthlylist1 {
        list-style-type: none;
        width: 100%;
        padding: 0;
        margin-bottom: 5px;
    }
    .monthlylist1 li {
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
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Financial Management / Financial Comparisons</h4>
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
                <ul class="nav nav-tabs nav-button-tabs nav-justified  margin-top-10">
                    <li class="active"><a href="">Monthly</a></li>
                    <li><a href="">Quarterly</a></li>
                    <li><a href="">Yearly</a></li>
                </ul>
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <div class="col-md-12">
                        <div class="comparisontabs">
                            <div class="margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label style="margin: 12px 0;">Choose a base year</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="">
                                            <ul class="" id="monthlylist">
                                                <?php foreach($years as $value){ ?>
                                                    <li class="act">{{ $value }}</li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label style="margin: 12px 0;">Choose a base month</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="">
                                            <ul class="" id="monthlylist1">
                                                <li class="act">Jan</li>
                                                <li class="act">Feb</li>
                                                <li class="act">Mar</li>
                                                <li class="act">Apr</li>
                                                <li class="act">May</li>
                                                <li class="act">Jun</li>
                                                <li class="act">Jul</li>
                                                <li class="act">Aug</li>
                                                <li class="act">Sep</li>
                                                <li class="act">Oct</li>
                                                <li class="act">Nov</li>
                                                <li class="act">Dec</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <i class="fas fa-plus-circle addcomprsntab"></i>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<div id="CompareModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -29px;"><span aria-hidden="true">&times;</span></button>
                <div class="row">
                    <div id="comparebody"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="allyearmonth" value="">
<input type="hidden" id="allyearmonth2" value="">
<input type="hidden" id="allyearmonth3" value="">
<script type="text/javascript">
    var x = 1;
    $(document).ready(function(){

        $(".addcomprsntab").on("click", function(){
            var html = '<div class="margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 5px;"> <div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a year to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylist"> <li class="act">2021</li><li class="act">2020</li><li class="act">2019</li><li class="act">2018</li><li class="act">2017</li> </ul> </div></div></div><div class="row"> <div class="col-md-3"> <label style="margin: 12px 0;">Choose a month to compare</label> </div><div class="col-md-9"> <div class=""> <ul class="monthlylist1"> <li class="act">Jan</li><li class="act">Feb</li><li class="act">Mar</li><li class="act">Apr</li><li class="act">May</li><li class="act">Jun</li><li class="act">Jul</li><li class="act">Aug</li><li class="act">Sep</li><li class="act">Oct</li><li class="act">Nov</li><li class="act">Dec</li></ul> </div></div></div><div class="clearfix"></div></div>';
            $(".comparisontabs").append(html);
        });
        $(document).on("click", ".monthlylist li.act", function(){
            $(this).parent("ul").children("li").css("text-decoration", "none");
            $(this).css("text-decoration", "underline");
        });
        $(document).on("click", ".monthlylist1 li.act", function(){
            $(this).parent("ul").children("li").css("text-decoration", "none");
            $(this).css("text-decoration", "underline");
        });
        $(document).on("click", "#monthlylist li.act", function(){
            $(this).parent("ul").children("li").css("text-decoration", "none");
            $(this).css("text-decoration", "underline");
        });
        $(document).on("click", "#monthlylist1 li.act", function(){
            $(this).parent("ul").children("li").css("text-decoration", "none");
            $(this).css("text-decoration", "underline");
        });
        
        setTimeout(function() {
            var yearr = (new Date()).getFullYear();
              var current = yearr;
              var year = yearr + 1;
              // year -= 0;
              for (var i = 4; i > 0; i--) {
                // if ((year-i) == current)
                    // $(this).append('<option selected value="' + (year - i) + '">' + (year - i) + '</option>');
                    $("#years").append('<div class="col-md-3"><input type="checkbox" class="year_check" id="' + (year - i) + '1" name="year" value="' + (year - i) + '" style="float: left; margin-right: 5px;"><label for="' + (year - i) + '1"><b> ' + (year - i) + '</b></label><br></div>');
                // else
                //     $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
              }
        },10);
        $("#addcompareyear").on("click", function()
        {
            
            $("#compare_section").append('<div class="commall"><div class="row comparisonyears"><div class="col-md-4"><label><b>Choose a base year to compare with</b></label></div><div class="col-md-8"><div class="row comyear" id="comparisonyears'+x+'"></div></div></div><div class="row comparison_month" id="comparison_month'+x+'"></div></div>');
            var yearr = (new Date()).getFullYear();
            var current = yearr;
            var year = yearr + 1;
            for (var i = 4; i > 0; i--) {
                $("#comparisonyears"+x).append('<div class="col-md-3"><input type="checkbox" class="comparison_year_check" id="' + (year - i) + '1" name="year" value="' + (year - i) + '" style="float: left; margin-right: 5px;"><label for="' + (year - i) + '1"><b> ' + (year - i) + '</b></label><br></div>');
            }   
            x++;
        });

    });
    $(document).on("change", ".year_check", function(){
        var deta = $("#allyearmonth").val();
        var allyearmonth = deta.split(',');
        if($(this).prop('checked') == true){
            $(".year_check").prop('checked', false);
            $(this).prop('checked', true);

            var val = $(this).val();
            if(allyearmonth != ""){
                allyearmonth.push(val);
                $("#allyearmonth").val(allyearmonth);
            }
            else{
                $("#allyearmonth").val(val);
            }
            
            var year = $(this).attr("id");
            $("#months").html('<div class="col-md-12" style="margin-bottom: 20px"><div class="row"><div class="col-md-2"><b>Choose a base month</b></div><div class="col-md-10"><table style="width: 100%"><tr><td><input type="checkbox" name="month" value="01" style="float: left;"><b></b>Jan</td><td><input type="checkbox" name="month" value="02" style="float: left;"><b></b>Feb</td><td><input type="checkbox" name="month" value="03" style="float: left;"><b></b>Mar</td><td><input type="checkbox" name="month" value="04" style="float: left;"><b></b>Apr</td><td><input type="checkbox" name="month" value="05" style="float: left;"><b></b>May</td><td><input type="checkbox" name="month" value="06" style="float: left;"><b></b>Jun</td><td><input type="checkbox" name="month" value="07" style="float: left;"><b></b>Jul</td><td><input type="checkbox" name="month" value="08" style="float: left;"><b></b>Aug</td><td><input type="checkbox" name="month" value="09" style="float: left;"><b></b>Sep</td><td><input type="checkbox" name="month" value="10" style="float: left;"><b></b>Oct</td><td><input type="checkbox" name="month" value="11" style="float: left;"><b></b>Nov</td><td><input type="checkbox" name="month" value="12" style="float: left;"><b></b>Dec</td></tr></table></div></div></div>');
            checkcurrmon();
        }
        else{
            $("#months").html("");
            var val = $(this).val();
            if(!!~jQuery.inArray(val, allyearmonth) != -1) {
                // alert("hi");
                allyearmonth.remove(val);
            } 
            $("#allyearmonth").val(allyearmonth);
        }
        
    });
    $(document).on("change", ".comparison_year_check", function(){
        var id = $(this).closest(".comyear").attr("id");
        // alert("#"+id);
        if($(this).prop('checked') == true){
            // alert("#"+id+" .comparison_year_check");
            $("#"+id+" .comparison_year_check").prop('checked', false);
            $(this).prop('checked', true);
                var year = $(this).attr("id");

                $("#"+id).closest(".comparisonyears").next(".comparison_month").html('<div class="col-md-12" style="margin-bottom: 20px"><div class="row"><div class="col-md-2"><b>Choose a base month</b></div><div class="col-md-10"><table style="width: 100%"><tr><td><input type="checkbox" name="month" value="01" style="float: left;"><b></b>Jan</td><td><input type="checkbox" name="month" value="02" style="float: left;"><b></b>Feb</td><td><input type="checkbox" name="month" value="03" style="float: left;"><b></b>Mar</td><td><input type="checkbox" name="month" value="04" style="float: left;"><b></b>Apr</td><td><input type="checkbox" name="month" value="05" style="float: left;"><b></b>May</td><td><input type="checkbox" name="month" value="06" style="float: left;"><b></b>Jun</td><td><input type="checkbox" name="month" value="07" style="float: left;"><b></b>Jul</td><td><input type="checkbox" name="month" value="08" style="float: left;"><b></b>Aug</td><td><input type="checkbox" name="month" value="09" style="float: left;"><b></b>Sep</td><td><input type="checkbox" name="month" value="10" style="float: left;"><b></b>Oct</td><td><input type="checkbox" name="month" value="11" style="float: left;"><b></b>Nov</td><td><input type="checkbox" name="month" value="12" style="float: left;"><b></b>Dec</td></tr></table></div></div></div>');
                checkcurrmon11();
        }
        else{
            $("#"+id).closest(".comparisonyears").next(".comparison_month").html("");
        }
        
    });

    Array.prototype.remove = function() {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };

    $(document).on("click", ".compare_btn", function(){
        var allyearmonth = [];
        var fyear = "";
        var fmonth = "";
        $(".year_check").each(function() { 
            if($(this).is(':checked')){
                fyear = $(this).val();
            }
        });
        $("#months input").each(function() { 
            if($(this).is(':checked')){
                fmonth = $(this).val();
            }
        });
        if((fyear != "") && (fmonth != "")){
            allyearmonth.push(fyear+"n"+fmonth); 
        }
        $(".commall").each(function(){
            var lyear = "";
            var lmonth = "";
            $(".comparison_year_check", this).each(function(){
                if($(this).is(':checked')){
                    lyear = $(this).val();
                }
            });
            $(".comparison_month input", this).each(function() { 
                if($(this).is(':checked')){
                    lmonth = $(this).val();
                }
            });
            if((lyear != "") && (lmonth != "")){
                allyearmonth.push(lyear+"n"+lmonth); 
            }
        });
        if(allyearmonth != ""){
            $.ajax({
                  type: "POST",
                  beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
                  url: "monthlyyearlyrevenue",
                  data:  'allyearmonth=' + allyearmonth + '&_token={{ csrf_token() }}',
                  success: function(html) {
                    // alert(html);
                    $("#emailcampaigncount").html(html);
                  },
                  complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                  }
            });
        }
        else{
            $("#emailcampaigncount").html("");
        }
    });
</script>
<script type="text/javascript">
    var x = 1;
    $(document).ready(function(){
        
        setTimeout(function() {
            var yearr = (new Date()).getFullYear();
              var current = yearr;
              var year = yearr + 1;
              // year -= 0;
              for (var i = 4; i > 0; i--) {
                // if ((year-i) == current)
                    // $(this).append('<option selected value="' + (year - i) + '">' + (year - i) + '</option>');
                    $("#years2").append('<div class="col-md-3"><input type="checkbox" class="year_check2" id="' + (year - i) + '1" name="year" value="' + (year - i) + '" style="float: left; margin-right: 5px;"><label for="' + (year - i) + '1"><b> ' + (year - i) + '</b></label><br></div>');
                // else
                //     $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
              }
        },10);
        $("#addcompareyear2").on("click", function()
        {
            
            $("#compare_section2").append('<div class="commall2"><div class="row comparisonyears2"><div class="col-md-4"><label><b>Choose a base year to compare with</b></label></div><div class="col-md-8"><div class="row comyear2" id="comparisonyears2'+x+'"></div></div></div><div class="row comparison_month2x" id="comparison_month2x'+x+'"></div></div>');
            var yearr = (new Date()).getFullYear();
            var current = yearr;
            var year = yearr + 1;
            for (var i = 4; i > 0; i--) {
                $("#comparisonyears2"+x).append('<div class="col-md-3"><input type="checkbox" class="comparison_year_check2" id="' + (year - i) + '1" name="year" value="' + (year - i) + '" style="float: left; margin-right: 5px;"><label for="' + (year - i) + '1"><b> ' + (year - i) + '</b></label><br></div>');
            }   
            x++;
        });

    });
    $(document).on("change", ".year_check2", function(){
        var deta = $("#allyearmonth2").val();
        var allyearmonth2 = deta.split(',');
        if($(this).prop('checked') == true){
            $(".year_check2").prop('checked', false);
            $(this).prop('checked', true);

            var val = $(this).val();
            if(allyearmonth2 != ""){
                allyearmonth2.push(val);
                $("#allyearmonth2").val(allyearmonth2);
            }
            else{
                $("#allyearmonth2").val(val);
            }
            
            var year = $(this).attr("id");
            $("#months2").html('<div class="col-md-12" style="margin-bottom: 20px"><div class="row"><div class="col-md-2"><b>Choose a base month</b></div><div class="col-md-10"><table style="width: 100%"><tr><td><input type="checkbox" name="month" value="01" style="float: left;"><b></b>Jan</td><td><input type="checkbox" name="month" value="02" style="float: left;"><b></b>Feb</td><td><input type="checkbox" name="month" value="03" style="float: left;"><b></b>Mar</td><td><input type="checkbox" name="month" value="04" style="float: left;"><b></b>Apr</td><td><input type="checkbox" name="month" value="05" style="float: left;"><b></b>May</td><td><input type="checkbox" name="month" value="06" style="float: left;"><b></b>Jun</td><td><input type="checkbox" name="month" value="07" style="float: left;"><b></b>Jul</td><td><input type="checkbox" name="month" value="08" style="float: left;"><b></b>Aug</td><td><input type="checkbox" name="month" value="09" style="float: left;"><b></b>Sep</td><td><input type="checkbox" name="month" value="10" style="float: left;"><b></b>Oct</td><td><input type="checkbox" name="month" value="11" style="float: left;"><b></b>Nov</td><td><input type="checkbox" name="month" value="12" style="float: left;"><b></b>Dec</td></tr></table></div></div></div>');
            checkcurrmon2();
        }
        else{
            $("#months2").html("");
            var val = $(this).val();
            if(!!~jQuery.inArray(val, allyearmonth2) != -1) {
                // alert("hi");
                allyearmonth2.remove(val);
            } 
            $("#allyearmonth2").val(allyearmonth2);
        }
        
    });
    $(document).on("change", ".comparison_year_check2", function(){
        var id = $(this).closest(".comyear2").attr("id");
        // alert("#"+id);
        if($(this).prop('checked') == true){
            // alert("#"+id+" .comparison_year_check2");
            $("#"+id+" .comparison_year_check2").prop('checked', false);
            $(this).prop('checked', true);
                var year = $(this).attr("id");

                $("#"+id).closest(".comparisonyears2").next(".comparison_month2x").html('<div class="col-md-12" style="margin-bottom: 20px"><div class="row"><div class="col-md-2"><b>Choose a base month</b></div><div class="col-md-10"><table style="width: 100%"><tr><td><input type="checkbox" name="month" value="01" style="float: left;"><b></b>Jan</td><td><input type="checkbox" name="month" value="02" style="float: left;"><b></b>Feb</td><td><input type="checkbox" name="month" value="03" style="float: left;"><b></b>Mar</td><td><input type="checkbox" name="month" value="04" style="float: left;"><b></b>Apr</td><td><input type="checkbox" name="month" value="05" style="float: left;"><b></b>May</td><td><input type="checkbox" name="month" value="06" style="float: left;"><b></b>Jun</td><td><input type="checkbox" name="month" value="07" style="float: left;"><b></b>Jul</td><td><input type="checkbox" name="month" value="08" style="float: left;"><b></b>Aug</td><td><input type="checkbox" name="month" value="09" style="float: left;"><b></b>Sep</td><td><input type="checkbox" name="month" value="10" style="float: left;"><b></b>Oct</td><td><input type="checkbox" name="month" value="11" style="float: left;"><b></b>Nov</td><td><input type="checkbox" name="month" value="12" style="float: left;"><b></b>Dec</td></tr></table></div></div></div>');
                checkcurrmon22();
        }
        else{
            $("#"+id).closest(".comparisonyears2").next(".comparison_month2x").html("");
        }
        
    });

    Array.prototype.remove = function() {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };
    $(document).on("click", ".compare_btn2", function(){
        var allyearmonth2 = [];
        var fyear = "";
        var fmonth = "";
        $(".year_check2").each(function() { 
            if($(this).is(':checked')){
                fyear = $(this).val();
            }
        });
        $("#months2 input").each(function() { 
            if($(this).is(':checked')){
                fmonth = $(this).val();
            }
        });
        if((fyear != "") && (fmonth != "")){
            allyearmonth2.push(fyear+"n"+fmonth); 
        }
        $(".commall2").each(function(){
            var lyear = "";
            var lmonth = "";
            $(".comparison_year_check2", this).each(function(){
                if($(this).is(':checked')){
                    lyear = $(this).val();
                }
            });
            $(".comparison_month2x input", this).each(function() { 
                if($(this).is(':checked')){
                    lmonth = $(this).val();
                }
            });
            if((lyear != "") && (lmonth != "")){
                allyearmonth2.push(lyear+"n"+lmonth); 
            }
        });
        if(allyearmonth2 != ""){
            $.ajax({
                  type: "POST",
                  beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
                  url: "monthlyyearlycomexpenses",
                  data:  'allyearmonth2=' + allyearmonth2 + '&_token={{ csrf_token() }}',
                  success: function(html) {
                    // alert(html);
                    $("#send_emailcount").html(html);
                  },
                  complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                  }
            });
        }
        else{
            $("#send_emailcount").html("");
        }
    });
</script>
<script type="text/javascript">
    var x = 1;
    $(document).ready(function(){
        
        setTimeout(function() {
            var yearr = (new Date()).getFullYear();
              var current = yearr;
              var year = yearr + 1;
              // year -= 0;
              for (var i = 4; i > 0; i--) {
                // if ((year-i) == current)
                    // $(this).append('<option selected value="' + (year - i) + '">' + (year - i) + '</option>');
                    $("#years3").append('<div class="col-md-3"><input type="checkbox" class="year_check3" id="' + (year - i) + '1" name="year" value="' + (year - i) + '" style="float: left; margin-right: 5px;"><label for="' + (year - i) + '1"><b> ' + (year - i) + '</b></label><br></div>');
                // else
                //     $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
              }
        },10);
        $("#addcompareyear3").on("click", function()
        {
            
            $("#compare_section3").append('<div class="commall3"><div class="row comparisonyears3"><div class="col-md-4"><label><b>Choose a base year to compare with</b></label></div><div class="col-md-8"><div class="row comyear3" id="comparisonyears3'+x+'"></div></div></div><div class="row comparison_month3x" id="comparison_month3x'+x+'"></div></div>');
            var yearr = (new Date()).getFullYear();
            var current = yearr;
            var year = yearr + 1;
            for (var i = 4; i > 0; i--) {
                $("#comparisonyears3"+x).append('<div class="col-md-3"><input type="checkbox" class="comparison_year_check3" id="' + (year - i) + '1" name="year" value="' + (year - i) + '" style="float: left; margin-right: 5px;"><label for="' + (year - i) + '1"><b> ' + (year - i) + '</b></label><br></div>');
            }   
            x++;
        });

    });
    $(document).on("change", ".year_check3", function(){
        var deta = $("#allyearmonth3").val();
        var allyearmonth3 = deta.split(',');
        if($(this).prop('checked') == true){
            $(".year_check3").prop('checked', false);
            $(this).prop('checked', true);

            var val = $(this).val();
            if(allyearmonth3 != ""){
                allyearmonth3.push(val);
                $("#allyearmonth3").val(allyearmonth3);
            }
            else{
                $("#allyearmonth3").val(val);
            }
            
            var year = $(this).attr("id");
            $("#months3").html('<div class="col-md-12" style="margin-bottom: 20px"><div class="row"><div class="col-md-2"><b>Choose a base month</b></div><div class="col-md-10"><table style="width: 100%"><tr><td><input type="checkbox" name="month" value="01" style="float: left;"><b></b>Jan</td><td><input type="checkbox" name="month" value="02" style="float: left;"><b></b>Feb</td><td><input type="checkbox" name="month" value="03" style="float: left;"><b></b>Mar</td><td><input type="checkbox" name="month" value="04" style="float: left;"><b></b>Apr</td><td><input type="checkbox" name="month" value="05" style="float: left;"><b></b>May</td><td><input type="checkbox" name="month" value="06" style="float: left;"><b></b>Jun</td><td><input type="checkbox" name="month" value="07" style="float: left;"><b></b>Jul</td><td><input type="checkbox" name="month" value="08" style="float: left;"><b></b>Aug</td><td><input type="checkbox" name="month" value="09" style="float: left;"><b></b>Sep</td><td><input type="checkbox" name="month" value="10" style="float: left;"><b></b>Oct</td><td><input type="checkbox" name="month" value="11" style="float: left;"><b></b>Nov</td><td><input type="checkbox" name="month" value="12" style="float: left;"><b></b>Dec</td></tr></table></div></div></div>');
            checkcurrmon3();
        }
        else{
            $("#months3").html("");
            var val = $(this).val();
            if(!!~jQuery.inArray(val, allyearmonth3) != -1) {
                // alert("hi");
                allyearmonth3.remove(val);
            } 
            $("#allyearmonth3").val(allyearmonth3);
        }
        
    });
    $(document).on("change", ".comparison_year_check3", function(){
        var id = $(this).closest(".comyear3").attr("id");
        // alert("#"+id);
        if($(this).prop('checked') == true){
            // alert("#"+id+" .comparison_year_check3");
            $("#"+id+" .comparison_year_check3").prop('checked', false);
            $(this).prop('checked', true);
                var year = $(this).attr("id");

                $("#"+id).closest(".comparisonyears3").next(".comparison_month3x").html('<div class="col-md-12" style="margin-bottom: 20px"><div class="row"><div class="col-md-2"><b>Choose a base month</b></div><div class="col-md-10"><table style="width: 100%"><tr><td><input type="checkbox" name="month" value="01" style="float: left;"><b></b>Jan</td><td><input type="checkbox" name="month" value="02" style="float: left;"><b></b>Feb</td><td><input type="checkbox" name="month" value="03" style="float: left;"><b></b>Mar</td><td><input type="checkbox" name="month" value="04" style="float: left;"><b></b>Apr</td><td><input type="checkbox" name="month" value="05" style="float: left;"><b></b>May</td><td><input type="checkbox" name="month" value="06" style="float: left;"><b></b>Jun</td><td><input type="checkbox" name="month" value="07" style="float: left;"><b></b>Jul</td><td><input type="checkbox" name="month" value="08" style="float: left;"><b></b>Aug</td><td><input type="checkbox" name="month" value="09" style="float: left;"><b></b>Sep</td><td><input type="checkbox" name="month" value="10" style="float: left;"><b></b>Oct</td><td><input type="checkbox" name="month" value="11" style="float: left;"><b></b>Nov</td><td><input type="checkbox" name="month" value="12" style="float: left;"><b></b>Dec</td></tr></table></div></div></div>');
                checkcurrmon33();
        }
        else{
            $("#"+id).closest(".comparisonyears3").next(".comparison_month3x").html("");
        }
        
    });

    Array.prototype.remove = function() {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };
    $(document).on("click", ".compare_btn3", function(){
        var allyearmonth3 = [];
        var fyear = "";
        var fmonth = "";
        $(".year_check3").each(function() { 
            if($(this).is(':checked')){
                fyear = $(this).val();
            }
        });
        $("#months3 input").each(function() { 
            if($(this).is(':checked')){
                fmonth = $(this).val();
            }
        });
        if((fyear != "") && (fmonth != "")){
            allyearmonth3.push(fyear+"n"+fmonth); 
        }
        $(".commall3").each(function(){
            var lyear = "";
            var lmonth = "";
            $(".comparison_year_check3", this).each(function(){
                if($(this).is(':checked')){
                    lyear = $(this).val();
                }
            });
            $(".comparison_month3x input", this).each(function() { 
                if($(this).is(':checked')){
                    lmonth = $(this).val();
                }
            });
            if((lyear != "") && (lmonth != "")){
                allyearmonth3.push(lyear+"n"+lmonth); 
            }
        });
        if(allyearmonth3 != ""){
            $.ajax({
                  type: "POST",
                  beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
                  url: "monthlyyearlycomasset",
                  data:  'allyearmonth3=' + allyearmonth3 + '&_token={{ csrf_token() }}',
                  success: function(html) {
                    // alert(html);
                    $("#emailcampaigncount3").html(html);
                  },
                  complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                  }
            });
        }
        else{
            ("#emailcampaigncount3").html("");
        }
    });
</script>
<script type="text/javascript">
    $(document).on("change", "#months input", function() { 
        if($(this).is(':checked')){
            $("#months input").prop('checked', false);
            $(this).prop('checked', true);
            
        }
        $(".compare_btn").trigger("click");
    });
    $(document).on("change", ".comparison_month input", function() { 
        if($(this).is(':checked')){
            var id = $(this).closest(".comparison_month").attr("id");
            $("#"+id+" input").prop('checked', false);
            $(this).prop('checked', true);
            
        }
        $(".compare_btn").trigger("click");
    });
    $(document).on("change", "#months2 input", function() { 
        if($(this).is(':checked')){
            $("#months2 input").prop('checked', false);
            $(this).prop('checked', true);
            
        }
        $(".compare_btn2").trigger("click");
    });
    $(document).on("change", ".comparison_month2x input", function() { 
        if($(this).is(':checked')){
            var id = $(this).closest(".comparison_month2x").attr("id");
            $("#"+id+" input").prop('checked', false);
            $(this).prop('checked', true);
            
        }
        $(".compare_btn2").trigger("click");
    });
    $(document).on("change", "#months3 input", function() { 
        if($(this).is(':checked')){
            $("#months3 input").prop('checked', false);
            $(this).prop('checked', true);
            
        }
        $(".compare_btn3").trigger("click");
    });
    $(document).on("change", ".comparison_month3x input", function() { 
        if($(this).is(':checked')){
            var id = $(this).closest(".comparison_month3x").attr("id");
            $("#"+id+" input").prop('checked', false);
            $(this).prop('checked', true);
            
        }
        $(".compare_btn3").trigger("click");
    });
</script>
<script type="text/javascript">
    function monyrcomgraph(id){
        var description = id;
        var allyearmonth = [];
        var fyear = "";
        var fmonth = "";
        $(".year_check").each(function() { 
            if($(this).is(':checked')){
                fyear = $(this).val();
            }
        });
        $("#months input").each(function() { 
            if($(this).is(':checked')){
                fmonth = $(this).val();
            }
        });
        if((fyear != "") && (fmonth != "")){
            allyearmonth.push(fyear+"n"+fmonth); 
        }
        $(".commall").each(function(){
            var lyear = "";
            var lmonth = "";
            $(".comparison_year_check", this).each(function(){
                if($(this).is(':checked')){
                    lyear = $(this).val();
                }
            });
            $(".comparison_month input", this).each(function() { 
                if($(this).is(':checked')){
                    lmonth = $(this).val();
                }
            });
            if((lyear != "") && (lmonth != "")){
                allyearmonth.push(lyear+"n"+lmonth); 
            }
        });
        if(allyearmonth != ""){
            $.ajax({
                  type: "POST",
                  url: "fcomparisonmonthlygraph",
                  data:  'allyearmonth=' + allyearmonth + '&description=' + description + '&_token={{ csrf_token() }}',
                  success: function(html) {
                    $("#comparebody").html(html);
                    $("#CompareModal").modal('show');
                  }
            });
        }
    }
    function checkcurrmon(){
        // alert("hi");
        $("#months input").each(function() { 
            var val = $(this).val();
            var curr_month = "<?= date('m') ?>";
            // alert(curr_month);
            if(curr_month == val){
                $(this).addClass("outl");
                $(this).next("b").css('color', "#da291c");
            }
        });
    };
    function checkcurrmon2(){
        // alert("hi");
        $("#months2 input").each(function() { 
            var val = $(this).val();
            var curr_month = "<?= date('m') ?>";
            // alert(curr_month);
            if(curr_month == val){
                $(this).addClass("outl");
                $(this).next("b").css('color', "#da291c");
            }
        });
    };
    function checkcurrmon3(){
        // alert("hi");
        $("#months3 input").each(function() { 
            var val = $(this).val();
            var curr_month = "<?= date('m') ?>";
            // alert(curr_month);
            if(curr_month == val){
                $(this).addClass("outl");
                $(this).next("b").css('color', "#da291c");
            }
        });
    };
    function checkcurrmon11()
    {
        $(".comparison_month input").each(function() { 
            var val = $(this).val();
            var curr_month = "<?= date('m') ?>";
            // alert(curr_month);
            if(curr_month == val){
                $(this).addClass("outl");
                $(this).next("b").css('color', "#da291c");
            }
        });
    }
    function checkcurrmon22()
    {
        $(".comparison_month2x input").each(function() { 
            var val = $(this).val();
            var curr_month = "<?= date('m') ?>";
            // alert(curr_month);
            if(curr_month == val){
                $(this).addClass("outl");
                $(this).next("b").css('color', "#da291c");
            }
        });
    }
    function checkcurrmon33()
    {
        $(".comparison_month3x input").each(function() { 
            var val = $(this).val();
            var curr_month = "<?= date('m') ?>";
            // alert(curr_month);
            if(curr_month == val){
                $(this).addClass("outl");
                $(this).next("b").css('color', "#da291c");
            }
        });
    }
</script>


@endsection