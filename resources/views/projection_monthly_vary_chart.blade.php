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
                            <h4>Revenue Projection</h4>
                        </div>
                        <script type="text/javascript">
                              $(function () {
                                    "use strict";

                                    //BAR CHART
                                    var bar = new Morris.Bar({
                                      element: 'bar-chartm',
                                      resize: true,
                                      data: [
                                        {y: 'Jan', a: <?= $jantotal ?>, b: <?= $jantotalactual ?>},
                                        {y: 'Feb', a: <?= $febtotal ?>, b: <?= $febtotalactual ?>},
                                        {y: 'Mar', a: <?= $martotal ?>, b: <?= $martotalactual ?>},
                                        {y: 'Apr', a: <?= $aprtotal ?>, b: <?= $aprtotalactual ?>},
                                        {y: 'May', a: <?= $maytotal ?>, b: <?= $maytotalactual ?>},
                                        {y: 'Jun', a: <?= $juntotal ?>, b: <?= $juntotalactual ?>},
                                        {y: 'Jul', a: <?= $jultotal ?>, b: <?= $jultotalactual ?>},
                                        {y: 'Aug', a: <?= $augtotal ?>, b: <?= $augtotalactual ?>},
                                        {y: 'Sep', a: <?= $septotal ?>, b: <?= $septotalactual ?>},
                                        {y: 'Oct', a: <?= $octtotal ?>, b: <?= $octtotalactual ?>},
                                        {y: 'Nov', a: <?= $novtotal ?>, b: <?= $novtotalactual ?>},
                                        {y: 'Dec', a: <?= $dectotal ?>, b: <?= $dectotalactual ?>}
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


