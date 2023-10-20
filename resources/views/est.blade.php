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
                    <h4>Financial Management & Analysis</h4>
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

                    <div style="padding: 10px 0px;">
                        <!-- <div class="modal_chart" id="bar-chartm" style="height: 300px;"></div>
                        <div class="text-center">
                            <h4>Revenue</h4>
                        </div> -->
                        @php
                            $mon = array($jantotalactual,$febtotalactual,$martotalactual,$aprtotalactual,$maytotalactual,$juntotalactual,$jultotalactual,$augtotalactual,$septotalactual,$octtotalactual, $novtotalactual, $dectotalactual);

                            $sum = array_sum($mon);
                            $sort_arr = arsort($mon);
                            $total = max($mon);

                            $year = date('Y');
                            $uid = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

                            $rev = DB::table('revenue_record')->whereYear('transaction_date', $year)->where('uid', $uid)->sum('total');
                        @endphp
                        <div class="col-md-12 margin-top-10 padding-0">

                            <div style="display: flex">

                                <div class="container bg-white col-md-8 mx-auto">
                                    <div>
                                        <h3 style="text-align: center; margin-bottom:0px !important">
                                            Total Estimated Profit/Loss : {{round($sum,0)}}
                                        </h3>
                                        <h4 style="text-align: center">
                                            For {{$year}}
                                        </h4>
                                    </div>
                                    <table>
                                        <style>
                                            td{
                                                padding: 1px 2px 7px 2px;
                                            }
                                        </style>
                                        @foreach ($mon as $ind => $gd)
                                        @php
                                        // dd($mon);
                                            $rgbColor = array();
                                            foreach(array('r', 'g', 'b') as $color){
                                                $rgbColor[$color] = mt_rand(0, 255);
                                            }
                                        @endphp
                                            <tr>
                                                <td style="text-align:left; color:#da291c">{{date('F', mktime(0, 0, 0, $ind+1, 10))}}</td>
                                                <td>
                                                    <div class="badge" style="background: #0000df">
                                                        <div style="padding-left:5px;padding-right:5px;">
                                                            {{round($gd, 0)}}
                                                        </div>


                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 400px; display:flex">
                                                        <div class="grp_{{$loop->index}}" style="border-radius:2px; width: {{$gd/$sum * 100}}%; background: rgb(<?= implode(",", $rgbColor); ?>); height: 20px;color:white">
                                                        </div>
                                                        <div style="margin-left: 5px">
                                                            @if ($gd!=0)
                                                                {{round($gd/$sum * 100, 2)}}%

                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <script type="text/javascript">
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
                                      labels: ['Budget','Actual'],
                                      hideHover: 'auto',
                                      xLabelMargin: 10,
                                      padding: 30,
                                    });
                                  });
                        </script> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


