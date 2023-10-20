@extends('layouts.main')
@section('content')
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
                        <a href="#" class="btn btn-md btn-info margin-right-10">View Offers</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My Faith</a>
                        <a href="{{ url('birthplace') }}" class="btn btn-md btn-info margin-right-10">My Birth Place</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">Sharing</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My City Guide</a>
                        <?php if($chat != "off"){ ?>
                        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                        <?php } ?>
                        <?php if($tools != "off"){ ?>
                        <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                        <?php } ?>
                        <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">My Daily
                            Briefing</a>
                        <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                    </div>

                    <ul class="nav nav-tabs nav-button-tabs nav-justified">
                        <li class="active"><a href="{{ url('comparison-tab1') }}">Appointment</a></li>
                        <li><a href="{{ url('comparison-tab2') }}">Client Management</a></li>
                        <li><a href="{{ url('comparison-tab3') }}">Email Management</a></li>
                        <li><a href="{{ url('comparison-tab4') }}">Financial Management</a></li>
                    </ul>
                    <ul class="nav nav-tabs nav-button-tabs nav-justified  margin-top-10">
                        <li class="active"><a href="{{ url('comparison-tab1') }}">Monthly</a></li>
                        <li><a href="{{ url('comparison-tab11') }}">Quarterly</a></li>
                        <li><a href="{{ url('comparison-tab111') }}">Yearly</a></li>
                    </ul>
                    <div class="tab-content margin-top-10"
                        style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <div class="col-md-12">
                            <div class="text-right" style="margin-bottom: 10px;">
                                <button class="btn btn-primary" id="addcompareyear">Click here to add year to
                                    compair</button>
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
                        <!-- <div class="col-md-12">
                            <div class="row" id="comparison_month" style="margin-bottom: 20px"></div>
                        </div> -->
                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary compare_btn">Compare</button>
                        </div>
                        <div class="col-md-12" id="appointcount"></div>
                        <!-- <div class="col-md-12">
                            <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li class="active"><a href="#tab1" data-toggle="tab">New Clients Comparison</a></li>
                                <li><a href="#tab2" data-toggle="tab">Appointments Comparison</a></li>
                                <li><a href="#tab3" data-toggle="tab">New Appointments Comparison</a></li>
                                <li><a href="#tab4" data-toggle="tab">Change Appointments Comparison</a></li>
                            </ul>

                            <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                                <div class="tab-pane fade in active" id="tab1">
                                    <table class="table table-striped table-bordered table-hover" id="">
                                        <thead>
                                            <tr>
                                                <th>Jan</th>
                                                <th>Feb</th>
                                                <th>Mar</th>
                                                <th>Apr</th>
                                                <th>May</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Aug</th>
                                                <th>Sep</th>
                                                <th>Oct</th>
                                                <th>Nov</th>
                                                <th>Dec</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $months_arr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                                            ?>
                                            <tr class="odd gradeX">
                                                <?php
                                                $tot = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $clcount = \App\Http\Controllers\HomeController::new_client_month_count($valuee);
                                                    $tot += $clcount;
                                                    echo '<td>' . $clcount . '</td>';
                                                }
                                                ?>
                                                    <td><?= $tot ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <table class="table table-striped table-bordered table-hover" id="">
                                        <thead>
                                            <tr>
                                                <th>Client Names</th>
                                                <th>Jan</th>
                                                <th>Feb</th>
                                                <th>Mar</th>
                                                <th>Apr</th>
                                                <th>May</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Aug</th>
                                                <th>Sep</th>
                                                <th>Oct</th>
                                                <th>Nov</th>
                                                <th>Dec</th>
                                                <th>Total</th>
                                                <th>Graph</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                        $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                        foreach($clients as $value){
                                        ?>
                                            <tr class="odd gradeX">
                                                <td><?= $value->first_name ?> <?= $value->last_name ?></td>
                                                <?php
                                                $tot = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $appcount = \App\Http\Controllers\HomeController::appointment_get_month_count($valuee, $value->appointment_id);
                                                
                                                    $tot += $appcount;
                                                
                                                    echo '<td>' . $appcount . '</td>';
                                                }
                                                ?>
                                                <td><?= $tot ?></td>

                                                <td>
                                                    <a href="{{ url('monthly_client_appointment_chartt') }}/<?= $value->appointment_id ?>"><i class="fa fa-bar-chart"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="tab3">
                                    <table class="table table-striped table-bordered table-hover" id="">
                                        <thead>
                                            <tr>
                                                <th>Client Names</th>
                                                <th>Jan</th>
                                                <th>Feb</th>
                                                <th>Mar</th>
                                                <th>Apr</th>
                                                <th>May</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Aug</th>
                                                <th>Sep</th>
                                                <th>Oct</th>
                                                <th>Nov</th>
                                                <th>Dec</th>
                                                <th>Total</th>
                                                <th>Graph</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                        $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                        foreach($clients as $value){
                                        ?>
                                            <tr class="odd gradeX">
                                                <td><?= $value->first_name ?> <?= $value->last_name ?></td>
                                                <?php
                                                $tot = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $appcount = \App\Http\Controllers\HomeController::new_appointment_get_month_count($valuee, $value->appointment_id);
                                                
                                                    $tot += $appcount;
                                                    echo '<td>' . $appcount . '</td>';
                                                }
                                                ?>
                                                <td><?= $tot ?></td>

                                                <td>
                                                    <a href="{{ url('monthly_new_appointment_chartt') }}/<?= $value->appointment_id ?>"><i class="fa fa-bar-chart"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="tab4">
                                    <table class="table table-striped table-bordered table-hover" id="">
                                        <thead>
                                            <tr>
                                                <th>Client Names</th>
                                                <th>Jan</th>
                                                <th>Feb</th>
                                                <th>Mar</th>
                                                <th>Apr</th>
                                                <th>May</th>
                                                <th>Jun</th>
                                                <th>Jul</th>
                                                <th>Aug</th>
                                                <th>Sep</th>
                                                <th>Oct</th>
                                                <th>Nov</th>
                                                <th>Dec</th>
                                                <th>Total</th>
                                                <th>Graph</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                        $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                        foreach($changedappointments as $value){
                                        ?>
                                            <tr class="odd gradeX">
                                                <td><?= $value->first_name ?> <?= $value->last_name ?></td>
                                                <?php
                                                $tot = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $appcount = \App\Http\Controllers\HomeController::changedappointments_get_month_count($valuee, $value->appointment_id);
                                                
                                                    $tot += $appcount;
                                                
                                                    echo '<td>' . $appcount . '</td>';
                                                }
                                                ?>
                                                <td><?= $tot ?></td>

                                                <td>
                                                    <a href="{{ url('monthly_change_appointment_chartt') }}/<?= $value->appointment_id ?>"><i class="fa fa-bar-chart"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="allyearmonth" value="">
    <script type="text/javascript">
        var x = 1;
        $(document).ready(function() {

            setTimeout(function() {
                var yearr = (new Date()).getFullYear();
                var current = yearr;
                var year = yearr + 1;
                // year -= 0;
                for (var i = 4; i > 0; i--) {
                    // if ((year-i) == current)
                    // $(this).append('<option selected value="' + (year - i) + '">' + (year - i) + '</option>');
                    $("#years").append(
                        '<div class="col-md-3"><input type="checkbox" class="year_check" id="' + (year -
                            i) + '1" name="year" value="' + (year - i) +
                        '" style="float: left; margin-right: 5px;"><label for="' + (year - i) +
                        '1"><b> ' + (year - i) + '</b></label><br></div>');
                    // else
                    //     $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
                }
            }, 10);
            $("#addcompareyear").on("click", function() {

                $("#compare_section").append(
                    '<div class="commall"><div class="row comparisonyears"><div class="col-md-4"><label><b>Choose a base year to compare with</b></label></div><div class="col-md-8"><div class="row comyear" id="comparisonyears' +
                    x + '"></div></div></div><div class="row comparison_month" id="comparison_month' +
                    x + '"></div></div>');
                var yearr = (new Date()).getFullYear();
                var current = yearr;
                var year = yearr + 1;
                for (var i = 4; i > 0; i--) {
                    $("#comparisonyears" + x).append(
                        '<div class="col-md-3"><input type="checkbox" class="comparison_year_check" id="' +
                        (year - i) + '1" name="year" value="' + (year - i) +
                        '" style="float: left; margin-right: 5px;"><label for="' + (year - i) +
                        '1"><b> ' + (year - i) + '</b></label><br></div>');
                }
                x++;
            });

        });
        $(document).on("change", ".year_check", function() {
            var deta = $("#allyearmonth").val();
            var allyearmonth = deta.split(',');
            if ($(this).prop('checked') == true) {
                $(".year_check").prop('checked', false);
                $(this).prop('checked', true);

                var val = $(this).val();
                if (allyearmonth != "") {
                    allyearmonth.push(val);
                    $("#allyearmonth").val(allyearmonth);
                } else {
                    // $(".year_check").each(function() { 
                    //     if(!$(this).is(':checked')){
                    //         var vall = $(this).val()
                    //         if(!!~jQuery.inArray(vall, allyearmonth) != -1) {
                    //             alert("hi");
                    //             allyearmonth.remove(val);
                    //         } 
                    //     }
                    // });
                    $("#allyearmonth").val(val);
                }

                var year = $(this).attr("id");
                $("#months").html(
                    '<div class="col-md-12" style="margin-bottom: 20px"><div class="row"><div class="col-md-2"><b>Choose a base month</b></div><div class="col-md-10"><table style="width: 100%"><tr><td><input type="checkbox" name="month" value="01" style="float: left;"><b></b>Jan</td><td><input type="checkbox" name="month" value="02" style="float: left;"><b></b>Feb</td><td><input type="checkbox" name="month" value="03" style="float: left;"><b></b>Mar</td><td><input type="checkbox" name="month" value="04" style="float: left;"><b></b>Apr</td><td><input type="checkbox" name="month" value="05" style="float: left;"><b></b>May</td><td><input type="checkbox" name="month" value="06" style="float: left;"><b></b>Jun</td><td><input type="checkbox" name="month" value="07" style="float: left;"><b></b>Jul</td><td><input type="checkbox" name="month" value="08" style="float: left;"><b></b>Aug</td><td><input type="checkbox" name="month" value="09" style="float: left;"><b></b>Sep</td><td><input type="checkbox" name="month" value="10" style="float: left;"><b></b>Oct</td><td><input type="checkbox" name="month" value="11" style="float: left;"><b></b>Nov</td><td><input type="checkbox" name="month" value="12" style="float: left;"><b></b>Dec</td></tr></table></div></div></div>'
                    );
            } else {
                $("#months").html("");
                var val = $(this).val();
                if (!!~jQuery.inArray(val, allyearmonth) != -1) {
                    // alert("hi");
                    allyearmonth.remove(val);
                }
                $("#allyearmonth").val(allyearmonth);
            }

        });
        $(document).on("change", ".comparison_year_check", function() {
            var id = $(this).closest(".comyear").attr("id");
            // alert("#"+id);
            if ($(this).prop('checked') == true) {
                // alert("#"+id+" .comparison_year_check");
                $("#" + id + " .comparison_year_check").prop('checked', false);
                $(this).prop('checked', true);
                var year = $(this).attr("id");

                $("#" + id).closest(".comparisonyears").next(".comparison_month").html(
                    '<div class="col-md-12" style="margin-bottom: 20px"><div class="row"><div class="col-md-2"><b>Choose a base month</b></div><div class="col-md-10"><table style="width: 100%"><tr><td><input type="checkbox" name="month" value="01" style="float: left;"><b></b>Jan</td><td><input type="checkbox" name="month" value="02" style="float: left;"><b></b>Feb</td><td><input type="checkbox" name="month" value="03" style="float: left;"><b></b>Mar</td><td><input type="checkbox" name="month" value="04" style="float: left;"><b></b>Apr</td><td><input type="checkbox" name="month" value="05" style="float: left;"><b></b>May</td><td><input type="checkbox" name="month" value="06" style="float: left;"><b></b>Jun</td><td><input type="checkbox" name="month" value="07" style="float: left;"><b></b>Jul</td><td><input type="checkbox" name="month" value="08" style="float: left;"><b></b>Aug</td><td><input type="checkbox" name="month" value="09" style="float: left;"><b></b>Sep</td><td><input type="checkbox" name="month" value="10" style="float: left;"><b></b>Oct</td><td><input type="checkbox" name="month" value="11" style="float: left;"><b></b>Nov</td><td><input type="checkbox" name="month" value="12" style="float: left;"><b></b>Dec</td></tr></table></div></div></div>'
                    )
            } else {
                $("#" + id).closest(".comparisonyears").next(".comparison_month").html("");
            }

        });

        Array.prototype.remove = function() {
            var what, a = arguments,
                L = a.length,
                ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };
        $(document).on("click", ".compare_btn", function() {
            var allyearmonth = [];
            var fyear = "";
            var fmonth = "";
            $(".year_check").each(function() {
                if ($(this).is(':checked')) {
                    fyear = $(this).val();
                }
            });
            $("#months input").each(function() {
                if ($(this).is(':checked')) {
                    fmonth = $(this).val();
                }
            });
            if ((fyear != "") && (fmonth != "")) {
                allyearmonth.push(fyear + "n" + fmonth);
            }
            $(".commall").each(function() {
                var lyear = "";
                var lmonth = "";
                $(".comparison_year_check", this).each(function() {
                    if ($(this).is(':checked')) {
                        lyear = $(this).val();
                    }
                });
                $(".comparison_month input", this).each(function() {
                    if ($(this).is(':checked')) {
                        lmonth = $(this).val();
                    }
                });
                if ((lyear != "") && (lmonth != "")) {
                    allyearmonth.push(lyear + "n" + lmonth);
                }
            });
            if (allyearmonth != "") {
                $.ajax({
                    type: "POST",
                    beforeSend: function() {
                        $("#loading").show();
                        $("#wrapper").hide();
                    },
                    url: "monthlyyearlycomappointment",
                    data: 'allyearmonth=' + allyearmonth + '&_token={{ csrf_token() }}',
                    success: function(html) {
                        // alert(html);
                        $("#appointcount").html(html);
                    },
                    complete: function() {
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
                });
            }
        });
    </script>
    <script type="text/javascript">
        $(document).on("change", "#months input", function() {
            if ($(this).is(':checked')) {
                $("#months input").prop('checked', false);
                $(this).prop('checked', true);
            }
        });
        $(document).on("change", ".comparison_month input", function() {
            if ($(this).is(':checked')) {
                var id = $(this).closest(".comparison_month").attr("id");
                $("#" + id + " input").prop('checked', false);
                $(this).prop('checked', true);
            }
        });
    </script>
@endsection
