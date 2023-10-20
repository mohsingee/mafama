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
                    <h4>Financial Managemnet / Projection</h4>
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
                            <h4><?= $value->name ?></h4>
                        </div>
                        <script type="text/javascript">
                              $(function () {
                                    "use strict";

                                    //BAR CHART
                                    var bar = new Morris.Bar({
                                      element: 'bar-chartm',
                                      resize: true,
                                      data: [
                                        {y: 'Jan', a: <?= $value->jan ?>, b: <?php echo $actual_jan = App\Http\Controllers\HomeController::getjanactual($value->name); ?>},
                                        {y: 'Feb', a: <?= $value->feb ?>, b: <?php echo $actual_feb = App\Http\Controllers\HomeController::getfebactual($value->name); ?>},
                                        {y: 'Mar', a: <?= $value->mar ?>, b: <?php echo $actual_mar = App\Http\Controllers\HomeController::getmaractual($value->name); ?>},
                                        {y: 'Apr', a: <?= $value->apr ?>, b: <?php echo $actual_apr = App\Http\Controllers\HomeController::getapractual($value->name); ?>},
                                        {y: 'May', a: <?= $value->may ?>, b: <?php echo $actual_may = App\Http\Controllers\HomeController::getmayactual($value->name); ?>},
                                        {y: 'Jun', a: <?= $value->jun ?>, b: <?php echo $actual_jun = App\Http\Controllers\HomeController::getjunactual($value->name); ?>},
                                        {y: 'Jul', a: <?= $value->jul ?>, b: <?php echo $actual_jul = App\Http\Controllers\HomeController::getjulactual($value->name); ?>},
                                        {y: 'Aug', a: <?= $value->aug ?>, b: <?php echo $actual_aug = App\Http\Controllers\HomeController::getaugactual($value->name); ?>},
                                        {y: 'Sep', a: <?= $value->sep ?>, b: <?php echo $actual_sep = App\Http\Controllers\HomeController::getsepactual($value->name); ?>},
                                        {y: 'Oct', a: <?= $value->oct ?>, b: <?php echo $actual_oct = App\Http\Controllers\HomeController::getoctactual($value->name); ?>},
                                        {y: 'Nov', a: <?= $value->nov ?>, b: <?php echo $actual_nov = App\Http\Controllers\HomeController::getnovactual($value->name); ?>},
                                        {y: 'Dec', a: <?= $value->decem ?>, b: <?php echo $actual_decem = App\Http\Controllers\HomeController::getdecemactual($value->name); ?>}
                                      ],
                                      barColors: ['#00a65a', '#f56954'],
                                      xkey: 'y',
                                      ykeys: ['a', 'b'],
                                      labels: ['Projected','Actual'],
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


