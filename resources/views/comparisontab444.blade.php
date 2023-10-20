@extends('layouts.main') 
@section("content")
<style type="text/css">
    .commall, .commall2, .commall3, .commall4, .commall5 {
        border: 1px solid;
        border-radius: 4px;
        padding: 5px;
        margin: 5px 0;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-20">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Archives / Yearly Comparisons</h4>
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
                <ul class="nav nav-tabs nav-button-tabs nav-justified">
                    <li><a href="{{ url('comparison-tab1') }}">Appointment</a></li>
                    <li><a href="{{ url('comparison-tab2') }}">Client Management</a></li>
                    <li><a href="{{ url('comparison-tab3') }}">Email Management</a></li>
                    <li class="active"><a href="{{ url('comparison-tab4') }}">Financial Management</a></li>
                </ul>
                <ul class="nav nav-tabs nav-button-tabs nav-justified  margin-top-10">
                    <li><a href="{{ url('comparison-tab4') }}">Monthly</a></li>
                    <li><a href="{{ url('comparison-tab44') }}">Quarterly</a></li>
                    <li class="active"><a href="{{ url('comparison-tab444') }}">Yearly</a></li>
                </ul>
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-button-tabs nav-justified" style="">
                            <li class="active"><a href="#tab1" data-toggle="tab">Revenue Updates Report</a></li>
                            <li><a href="#tab2" data-toggle="tab">Expense Updates Report</a></li>
                            <li><a href="#tab3" data-toggle="tab">Assets Updates Report</a></li>
                        </ul>

                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                            <div class="tab-pane fade in active" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-right" style="margin-bottom: 10px;">
                                            <button class="btn btn-primary" id="addcompareyear">Click here to add year to compair</button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class=" commall">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label><b>Choose a base year</b></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row" id="years"></div>
                                                </div>
                                            </div>
                                            <div class="row" id="months"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="compare_section"></div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary compare_btn">Compare</button>
                                    </div>
                                    <div class="col-md-12" id="emailcampaigncount"></div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-right" style="margin-bottom: 10px;">
                                            <button class="btn btn-primary" id="addcompareyear2">Click here to add year to compair</button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class=" commall2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label><b>Choose a base year</b></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row" id="years2"></div>
                                                </div>
                                            </div>
                                            <div class="row" id="months2"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="compare_section2"></div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary compare_btn2">Compare</button>
                                    </div>
                                    <div class="col-md-12" id="send_emailcount"></div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-right" style="margin-bottom: 10px;">
                                            <button class="btn btn-primary" id="addcompareyear3">Click here to add year to compair</button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class=" commall3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label><b>Choose a base year</b></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row" id="years3"></div>
                                                </div>
                                            </div>
                                            <div class="row" id="months3"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="compare_section3"></div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary compare_btn3">Compare</button>
                                    </div>
                                    <div class="col-md-12" id="emailcampaigncount3"></div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="allyearmonth" value="">
<input type="hidden" id="allyearmonth2" value="">
<input type="hidden" id="allyearmonth3" value="">
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
        }
        else{
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
        if((fyear != "")){
            allyearmonth.push(fyear); 
        }
        $(".commall").each(function(){
            var lyear = "";
            var lmonth = "";
            $(".comparison_year_check", this).each(function(){
                if($(this).is(':checked')){
                    lyear = $(this).val();
                }
            });
            if((lyear != "")){
                allyearmonth.push(lyear); 
            }
        });
        if(allyearmonth != ""){
            $.ajax({
                  type: "POST",
                  beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
                  url: "yearlyrevenue",
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
        }
        else{
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
        if((fyear != "")){
            allyearmonth2.push(fyear); 
        }
        $(".commall2").each(function(){
            var lyear = "";
            var lmonth = "";
            $(".comparison_year_check2", this).each(function(){
                if($(this).is(':checked')){
                    lyear = $(this).val();
                }
            });
            if((lyear != "")){
                allyearmonth2.push(lyear); 
            }
        });
        if(allyearmonth2 != ""){
            $.ajax({
                  type: "POST",
                  beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
                  url: "yearlycomexpenses",
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
        if((fyear != "")){
            allyearmonth3.push(fyear); 
        }
        $(".commall3").each(function(){
            var lyear = "";
            var lmonth = "";
            $(".comparison_year_check3", this).each(function(){
                if($(this).is(':checked')){
                    lyear = $(this).val();
                }
            });
            if((lyear != "")){
                allyearmonth3.push(lyear); 
            }
        });
        if(allyearmonth3 != ""){
            $.ajax({
                  type: "POST",
                  beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
                  url: "yearlycomasset",
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
    });
</script>


@endsection