@extends('layouts.main') 
@section("content")

<!-- <script src="{{ asset('public/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script> -->
   <!--  <link href="{{ asset('public/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('public/morris/morris.min.js') }}" type="text/javascript"></script> -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style type="text/css">
.highcharts-color-0 {
    fill: #da291c;
    stroke: #da291c;
}
    .highcharts-figure, .highcharts-data-table table {
  min-width: 310px;
  max-width: 800px;
  margin: 1em auto;
}



.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}
.highcharts-data-table th {
    font-weight: 600;
  padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
  padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}
.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Financial Managemnet / Budget</h4>
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






                    <div class="modal_chart" id="bar-chartm<?= $value->id ?>" ></div>
                        <div class="text-center">
                            <br>
                            <h4><?= $value->name ?></h4>
                        </div>
                        <script type="text/javascript">
                              // $(function () {
                              //       "use strict";

                              //       //BAR CHART
                              //       var bar<?= $value->id ?> = new Morris.Bar({
                              //         element: 'bar-chartm<?= $value->id ?>',
                              //         resize: true,
                              //         data: [
                              //           {y: 'Jan', a: <?= $value->jan ?>},
                              //           {y: 'Feb', a: <?= $value->feb ?>},
                              //           {y: 'Mar', a: <?= $value->mar ?>},
                              //           {y: 'Apr', a: <?= $value->apr ?>},
                              //           {y: 'May', a: <?= $value->may ?>},
                              //           {y: 'Jun', a: <?= $value->jun ?>},
                              //           {y: 'Jul', a: <?= $value->jul ?>},
                              //           {y: 'Aug', a: <?= $value->aug ?>},
                              //           {y: 'Sep', a: <?= $value->sep ?>},
                              //           {y: 'Oct', a: <?= $value->oct ?>},
                              //           {y: 'Nov', a: <?= $value->nov ?>},
                              //           {y: 'Dec', a: <?= $value->decem ?>}
                              //         ],
                              //         barColors: ['#da291c'],
                              //         xkey: 'y',
                              //         ykeys: ['a'],
                              //         labels: ['<?= $value->name ?>'],
                              //         hideHover: 'auto',
                              //         xLabelMargin: 10,
                              //         padding: 30,
                              //       });
                              //     });
                        </script>

                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    //Source: <a href="http://mafama.com/">mafama.com</a>
    Highcharts.chart('bar-chartm<?= $value->id ?>', {
  chart: {
    type: 'bar'
  },
  title: {
    text: ''
  },
  subtitle: {
    text: ''
  },

  xAxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Budget (USD)',
      align: 'high'
    },
    labels: {
      overflow: 'justify'
    }
  },
  tooltip: {
    valueSuffix: ' USD'
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      },

    }
  },
  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'top',
    x: -40,
    y: 80,
    floating: true,
    borderWidth: 1,
    backgroundColor:
      Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
    shadow: true
  },
  credits: {
    enabled: false
  },
  series: [{
    name: 'Year <?=date("Y");?>',

    data: [<?= $value->jan ?>,  <?= $value->feb ?>,<?= $value->mar ?>,<?= $value->apr ?>,  <?= $value->may ?>,<?= $value->jun ?>,<?= $value->jul ?>,<?= $value->aug ?>,<?= $value->sep ?>,<?= $value->oct ?>,<?= $value->nov ?>,<?= $value->decem ?>]
  }]
});
</script>

@endsection


