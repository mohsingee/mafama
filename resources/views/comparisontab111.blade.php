@extends('layouts.main') 
@section("content")
<style type="text/css">
    .commall {
        border: 1px solid;
        border-radius: 4px;
        padding: 5px;
        margin: 5px 0;
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
                        <h4>Archives / Yearly Comparison</h4>
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
                    <li class="active"><a href="{{ url('comparison-tab1') }}">Appointment</a></li>
                    <li><a href="{{ url('comparison-tab2') }}">Client Management</a></li>
                    <li><a href="{{ url('comparison-tab3') }}">Email Management</a></li>
                    <li><a href="{{ url('comparison-tab4') }}">Financial Management</a></li>
                </ul>
                <ul class="nav nav-tabs nav-button-tabs nav-justified  margin-top-10">
                    <li><a href="{{ url('comparison-tab1') }}">Monthly</a></li>
                    <li><a href="{{ url('comparison-tab11') }}">Quarterly</a></li>
                    <li class="active"><a href="{{ url('comparison-tab111') }}">Yearly</a></li>
                </ul>
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
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
                    <div class="col-md-12" id="appointcount"></div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="allyearmonth" value="">
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
            $("#months").html("");
            var val = $(this).val();
            if(!!~jQuery.inArray(val, allyearmonth) != -1) {
                allyearmonth.remove(val);
            } 
            $("#allyearmonth").val(allyearmonth);
        }
        
    });
    // $(document).on("change", ".comparison_year_check", function(){
    //     var id = $(this).closest(".comyear").attr("id");
    //     if($(this).prop('checked') == true){
    //         $("#"+id+" .comparison_year_check").prop('checked', false);
    //         $(this).prop('checked', true);
    //             var year = $(this).attr("id");

    //             $("#"+id).closest(".comparisonyears").next(".comparison_month").html('<div class="col-md-12" style="margin-bottom: 20px"><div class="row"><div class="col-md-2"><b>Choose a base month</b></div><div class="col-md-10"><table style="width: 100%"><tr><td style="text-align: left;"><input type="checkbox" name="month" style="margin-right: 7px;" value="01" style="float: left;"><b></b>Jan - Mar</td><td style="text-align: left;"><input type="checkbox" name="month" style="margin-right: 7px;" value="04" style="float: left;"><b></b>Apr - Jun</td><td style="text-align: left;"><input type="checkbox" name="month" style="margin-right: 7px;" value="07" style="float: left;"><b></b>Jul - Sep</td><td style="text-align: left;"><input type="checkbox" name="month" style="margin-right: 7px;" value="10" style="float: left;"><b></b>Oct - Dec</td></tr></table></div></div></div>')
    //     }
    //     else{
    //         $("#"+id).closest(".comparisonyears").next(".comparison_month").html("");
    //     }
        
    // });

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
                  url: "yearlycomappointment",
                  data:  'allyearmonth=' + allyearmonth + '&_token={{ csrf_token() }}',
                  success: function(html) {
                    // alert(html);
                    $("#appointcount").html(html);
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
    $(document).on("change", ".comparison_year_check", function(){
        var id = $(this).closest(".comyear").attr("id");
        // alert("#"+id);
        if($(this).prop('checked') == true){
            $("#"+id+" .comparison_year_check").prop('checked', false);
            $(this).prop('checked', true);
                
        }
        else{
            $("#"+id).closest(".comparisonyears").next(".comparison_month").html("");
        }
        
    });
</script>
@endsection