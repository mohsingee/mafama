@extends('layouts.main')
@section('content')

    <style>
        .heading-div {
            background-color: #da291c;
            border-radius: 5px;
        }

        .heading-div h4 {
            color: #fff;
            margin-top: 10px;
            margin-bottom: 10px;
            font-weight: 400;
        }

        .form-info td {
            text-align: left !important;
            font-size: 12px;
            vertical-align: top;
            border: 1px solid #da291c40;
            padding: 10px;
        }

        .grid-3 {
            text-align: left !important;
            font-size: 12px;
            vertical-align: top;
            border: 1px solid #da291c40;
            padding: 10px;
        }
    </style>
    <!-- -->
    <section>
        <div class="container">
            <div class="row">
                <!-- tabs content -->
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12" style="padding-bottom: 20px;">
                            <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Settings / Upload Forms Library</h4>
                            </div>
                            <div class="col-md-12 text-right margin-bottom-20">
                                <a href="#" class="btn btn-md btn-info margin-right-10">View Offers</a>
                                <a href="#" class="btn btn-md btn-info margin-right-10">My Faith</a>
                                <a href="{{ url('birthplace') }}" class="btn btn-md btn-info margin-right-10">My Birth
                                    Place</a>
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
                            <!--<ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                                                <li class="active"><a href="add_appointment_setting.php">Appointment</a></li>
                                                <li><a href="#">Client Management</a></li>
                                                <li><a href="#">Email Management</a></li>
                                                <li><a href="#">Financial Management</a></li>
                                                
                                            </ul>

                                            <div class="tab-content margin-top-10"  style="border:1px solid #da291c !important;  border-radius:10px;padding:10px;">-->
                            <div class="col-md-12 margin-bottom-40">
                                <div class="col-md-12 shadow-boxx">
                                    <div class="col-md-12 text-center">
                                        <h4 class="margin-bottom-0">General Forms</h4>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    <div class="col-md-12 text-center padding-0 margin-top-20">
                                        <table class="form-info margin-bottom-10" style="width: 100%;">
                                            <tbody class="general_form_body">

                                                @if (count($general_forms) > 0)
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($general_forms as $form)
                                                        @php
                                                            $count = \App\Http\Controllers\MLMHomeController::library_existance($form->id);
                                                        @endphp
                                                        @if ($i == 1)
                                                            <tr>
                                                        @endif
                                                        <td>
                                                            <label class="checkbox">
                                                                <input type="checkbox" id="general_form"
                                                                    value="{{ $form->id }}"
                                                                    @if ($count == 'exist') checked @endif />
                                                                <i></i> {{ $form->name }}
                                                            </label>
                                                        </td>
                                                        @if ($i == 4)
                                                            </tr>
                                                        @endif
                                                        <?php
                                                        if ($i == 4) {
                                                            $i = 0;
                                                        }
                                                        ?>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    <div class="col-md-12 text-center padding-0">
                                        <a href="javascript:void(0)"
                                            class="btn btn-sm btn-info margin-right-40 general_form_submit"
                                            style="width: 150px;">SAVE </a>
                                        <!-- <a href="#" class="btn btn-xs btn-info" style="width: 150px;">Remove from front</a> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 margin-bottom-40">
                                <div class="col-md-12 shadow-boxx">
                                    <div class="col-md-12 text-center">
                                        <h4 class="margin-bottom-0">Medical Forms</h4>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    <div class="col-md-12 text-center padding-0 margin-top-20">
                                        <table class="form-info margin-bottom-10" style="width: 100%;">
                                            <tbody class="medical_form_body">
                                                @if (count($medical_forms) > 0)
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($medical_forms as $form)
                                                        @php
                                                            $count = \App\Http\Controllers\MLMHomeController::library_existance($form->id);
                                                        @endphp

                                                        @if ($i == 1)
                                                            <tr>
                                                        @endif
                                                        <td>
                                                            <label class="checkbox">
                                                                <input type="checkbox" id="medical_form"
                                                                    value="{{ $form->id }}"
                                                                    @if ($count == 'exist') checked @endif />
                                                                <i></i> {{ $form->name }}
                                                            </label>
                                                        </td>
                                                        @if ($i == 4)
                                                            </tr>
                                                        @endif
                                                        <?php
                                                        if ($i == 4) {
                                                            $i = 0;
                                                        }
                                                        ?>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    <div class="col-md-12 text-center padding-0">
                                        <a href="javascript:void(0)"
                                            class="btn btn-sm btn-info margin-right-40 medical_form_submit"
                                            style="width: 150px;">SAVE </a>
                                        <!--  <a href="#" class="btn btn-xs btn-info" style="width: 150px;">Remove from front</a> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 margin-bottom-40">
                                <div class="col-md-12 shadow-boxx">
                                    <div class="col-md-12 text-center">
                                        <h4 class="margin-bottom-0">Dentist Forms</h4>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    <div class="col-md-12 text-center padding-0 margin-top-20">
                                        <table class="form-info margin-bottom-10" style="width: 100%;">
                                            <tbody class="dentist_form_body">
                                                @if (count($dentist_forms) > 0)
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($dentist_forms as $form)
                                                        @php
                                                            $count = \App\Http\Controllers\MLMHomeController::library_existance($form->id);
                                                        @endphp

                                                        @if ($i == 1)
                                                            <tr>
                                                        @endif
                                                        <td>
                                                            <label class="checkbox">
                                                                <input type="checkbox" id="dentist_form"
                                                                    value="{{ $form->id }}"
                                                                    @if ($count == 'exist') checked @endif />
                                                                <i></i> {{ $form->name }}
                                                            </label>
                                                        </td>
                                                        @if ($i == 4)
                                                            </tr>
                                                        @endif
                                                        <?php
                                                        if ($i == 4) {
                                                            $i = 0;
                                                        }
                                                        ?>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    <div class="col-md-12 text-center padding-0">
                                        <a href="javascript:void(0)"
                                            class="btn btn-sm btn-info margin-right-40 dentist_form_submit"
                                            style="width: 150px;">SAVE </a>
                                        <!-- <a href="#" class="btn btn-xs btn-info" style="width: 150px;">Remove from front</a> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 margin-bottom-40">
                                <div class="col-md-12 shadow-boxx">
                                    <div class="col-md-12 text-center">
                                        <h4 class="margin-bottom-0">Pedriatric Forms</h4>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    <div class="col-md-12 text-center padding-0 margin-top-20">
                                        <table class="form-info margin-bottom-10" style="width: 100%;">
                                            <tbody class="pedriatric_form_body">
                                                @if (count($pedriatric_forms) > 0)
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($pedriatric_forms as $form)
                                                        @php
                                                            $count = \App\Http\Controllers\MLMHomeController::library_existance($form->id);
                                                        @endphp

                                                        @if ($i == 1)
                                                            <tr>
                                                        @endif
                                                        <td>
                                                            <label class="checkbox">
                                                                <input type="checkbox" id="pedriatric_form"
                                                                    value="{{ $form->id }}"
                                                                    @if ($count == 'exist') checked @endif />
                                                                <i></i> {{ $form->name }}
                                                            </label>
                                                        </td>
                                                        @if ($i == 4)
                                                            </tr>
                                                        @endif
                                                        <?php
                                                        if ($i == 4) {
                                                            $i = 0;
                                                        }
                                                        ?>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    <div class="col-md-12 text-center padding-0">
                                        <a href="javascript:void(0)"
                                            class="btn btn-sm btn-info margin-right-40 pedriatric_form_submit"
                                            style="width: 150px;">SAVE </a>
                                        <!--  <a href="#" class="btn btn-xs btn-info" style="width: 150px;">Remove from front</a> -->
                                    </div>
                                </div>
                            </div>
                            <!--<div class="clearfix"></div>
                                            </div>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script type="text/javascript">
        $(".general_form_submit").on("click", function() {
            var sub_arr = [];
            // $(".general_form_body tr").each(function(){
            //     if ($(this).find("input").is(':checked')) {
            //         var id = $(this).find("input").val();
            //         sub_arr.push(id);

            //     }
            // });
            var sub_arr = $(".general_form_body tr input:checkbox:checked").map(function() {
                return $(this).val();
            }).get();
            if (sub_arr != "") {
                $.ajax({
                    url: "add_affiliate_library_form",
                    data: {
                        'form_cat_id': 1,
                        'sub_arr': JSON.stringify(sub_arr),
                        '_token': '<?= csrf_token() ?>'
                    },
                    type: 'POST',
                    success: function(result) {
                        console.log(result);
                        location.reload();
                    }
                });
            }
        });



        $(".medical_form_submit").on("click", function() {
            var sub_arr = [];
            // $(".medical_form_body tr").each(function(){
            //     if ($(this).find("input").is(':checked')) {
            //         var id = $(this).find("input").val();
            //         sub_arr.push(id);

            //     }
            // }); 
            var sub_arr = $(".medical_form_body tr input:checkbox:checked").map(function() {
                return $(this).val();
            }).get();
            if (sub_arr != "") {
                $.ajax({
                    url: "add_affiliate_library_form",
                    data: {
                        'form_cat_id': 3,
                        'sub_arr': JSON.stringify(sub_arr),
                        '_token': '<?= csrf_token() ?>'
                    },
                    type: 'POST',
                    success: function(result) {
                        console.log(result);
                        location.reload();
                    }
                });
            }
        });


        $(".dentist_form_submit").on("click", function() {
            var sub_arr = [];
            // $(".dentist_form_body tr").each(function(){
            //     if ($(this).find("input").is(':checked')) {
            //         var id = $(this).find("input").val();
            //         sub_arr.push(id);

            //     }
            // });
            var sub_arr = $(".dentist_form_body tr input:checkbox:checked").map(function() {
                return $(this).val();
            }).get();
            if (sub_arr != "") {
                $.ajax({
                    url: "add_affiliate_library_form",
                    data: {
                        'form_cat_id': 2,
                        'sub_arr': JSON.stringify(sub_arr),
                        '_token': '<?= csrf_token() ?>'
                    },
                    type: 'POST',
                    success: function(result) {
                        console.log(result);
                        location.reload();
                    }
                });
            }
        });


        $(".pedriatric_form_submit").on("click", function() {
            var sub_arr = [];
            // $(".pedriatric_form_body tr").each(function(){
            //     if ($(this).find("input").is(':checked')) {
            //         var id = $(this).find("input").val();
            //         sub_arr.push(id);

            //     }
            // }); 
            var sub_arr = $(".pedriatric_form_body tr input:checkbox:checked").map(function() {
                return $(this).val();
            }).get();
            if (sub_arr != "") {
                $.ajax({
                    url: "add_affiliate_library_form",
                    data: {
                        'form_cat_id': 4,
                        'sub_arr': JSON.stringify(sub_arr),
                        '_token': '<?= csrf_token() ?>'
                    },
                    type: 'POST',
                    success: function(result) {
                        console.log(result);
                        location.reload();
                    }
                });
            }
        });
    </script>



@endsection
