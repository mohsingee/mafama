@extends('layouts.main') 
@section("content")
<!-- <script src="{{ asset('public/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script> -->
    <link href="{{ asset('public/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('public/morris/morris.min.js') }}" type="text/javascript"></script>

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Financial Managemnet / Comparison</h4>
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

                <div class="col-md-12 margin-top-10 padding-0">

                    <div style="padding: 30px 0px;">
                        <div class="modal_chart" id="bar-chartm" style="height: 300px;"></div>
                        <div class="text-center">
                            <h4>{{ $description }}</h4>
                        </div>
                        <script type="text/javascript">
                              $(function () {
                                    "use strict";

                                    //BAR CHART
                                    var bar = new Morris.Bar({
                                      element: 'bar-chartm',
                                      resize: true,
                                      data: [
                                      <?php
                                        foreach($allyearmonth as $value){
                                            $val = explode('nqd', $value);
                                            $mnt = $val[1];
                                            $month = "";
                                            if($mnt == 'Jan'){ $month = '01'; }elseif($mnt == 'Feb'){ $month = '02'; }elseif($mnt == 'Mar'){ $month = '03'; }elseif($mnt == 'Apr'){ $month = '04'; }elseif($mnt == 'May'){ $month = '05'; }elseif($mnt == 'Jun'){ $month = '06'; }elseif($mnt == 'Jul'){ $month = '07'; }elseif($mnt == 'Aug'){ $month = '08'; }elseif($mnt == 'Sep'){ $month = '09'; }elseif($mnt == 'Oct'){ $month = '10'; }elseif($mnt == 'Nov'){ $month = '11'; }elseif($mnt == 'Dec'){ $month = '12'; }
                                            $month_year = $val[0]."-".$month;
                                            $cnt = App\Http\Controllers\HomeController::getfcommonthgrpex($month_year, $description);
                                        ?>
                                        
                                        {y: '{{ date("F Y", strtotime($month_year)) }}', a: <?= $cnt ?>},
                                        <?php } ?>
                                      ],
                                      barColors: ['#00a65a'],
                                      xkey: 'y',
                                      ykeys: ['a'],
                                      labels: ['Expenses Update'],
                                      hideHover: 'auto',
                                      xLabelMargin: 10,
                                      padding: 30,
                                    });
                                  });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


