@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <!-- tabs -->
                <section>
                    <div class="container">
                        <div class="row">
                            <!-- tabs content -->
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-12">
                                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                        <h4>Appointments / Steps to make appointment</h4>
                                    </div>
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
                                    <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">My
                                        Daily Briefing</a>
                                    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                                </div>
                                <!--<ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                                        <li class="active"><a href="add_appointment_setting.php">Appointment</a></li>
                                        <li><a href="#">Client Management</a></li>
                                        <li><a href="#">Email Management</a></li>
                                        <li><a href="#">Financial Management</a></li>
                                        
                                    </ul>-->
                                <div class="col-md-12">
                                    <div class="row process-wizard process-wizard-info">
                                        <div class="col-xs-5th process-wizard-step active">
                                            <div class="text-center process-wizard-stepnum">Step 1</div>
                                            <div class="progress">
                                                <div class="progress-bar"></div>
                                            </div>
                                            <a href="#" class="process-wizard-dot"></a>
                                            <div class="process-wizard-info text-center">Locate the Professional by Location
                                                or by Keyword.</div>
                                        </div>

                                        <div class="col-xs-5th process-wizard-step disabled">
                                            <!-- complete -->
                                            <div class="text-center process-wizard-stepnum">Step 2</div>
                                            <div class="progress">
                                                <div class="progress-bar"></div>
                                            </div>
                                            <a href="#" class="process-wizard-dot"></a>
                                            <div class="process-wizard-info text-center">Click Make an Appointment to go to
                                                next step.</div>
                                        </div>

                                        <div class="col-xs-5th process-wizard-step disabled">
                                            <!-- complete -->
                                            <div class="text-center process-wizard-stepnum">Step 3</div>
                                            <div class="progress">
                                                <div class="progress-bar"></div>
                                            </div>
                                            <a href="#" class="process-wizard-dot"></a>
                                            <div class="process-wizard-info text-center">Click on any available date below
                                                to view available time for that date.</div>
                                        </div>

                                        <div class="col-xs-5th process-wizard-step disabled">
                                            <!-- active -->
                                            <div class="text-center process-wizard-stepnum">Step 4</div>
                                            <div class="progress">
                                                <div class="progress-bar"></div>
                                            </div>
                                            <a href="#" class="process-wizard-dot"></a>
                                            <div class="process-wizard-info text-center">Enter reason for Appointment.</div>
                                        </div>

                                        <div class="col-xs-5th process-wizard-step disabled">
                                            <!-- active -->
                                            <div class="text-center process-wizard-stepnum">Step 5</div>
                                            <div class="progress">
                                                <div class="progress-bar"></div>
                                            </div>
                                            <a href="#" class="process-wizard-dot"></a>
                                            <div class="process-wizard-info text-center">Click on Set Appointment to
                                                Proceed.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 margin-bottom-20 margin-top-40">
                                        <div class="col-md-6">
                                            <div class="col-md-12 shadow-boxx">
                                                <div class="col-md-12 text-center">
                                                    <h4>By Religion & Location</h4>
                                                </div>
                                                <form action="{{ url('appointment_step2') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Religion</label>
                                                            <select class="form-control select2" name="religion">
                                                                <option value="all">All</option>
                                                                <?php
                                                            foreach($religion as $value){
                                                            ?>
                                                                <option value="<?= $value->religion ?>">
                                                                    <?= $value->religion ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <select id="countries_states1"
                                                                class="form-control bfh-countries" name="country"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <select class="form-control bfh-states"
                                                                data-country="countries_states1" name="state"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <input type="text" class="form-control" placeholder="City"
                                                                name="city" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Zipcode</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Zipcode" name="zipcode" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 text-center"
                                                        style="margin-top: 20px; margin-bottom: 20px;">
                                                        <button type="submit" class="btn btn-sm btn-info">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="col-md-12 shadow-boxx">
                                                <div class="col-md-12 text-center">
                                                    <h4>By Keyword</h4>
                                                </div>
                                                <form action="{{ url('appointment_stepp2') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-md-12">
                                                        <span>Search by first three letters of :</span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group text-center">
                                                            <label class="text-left">First Name</label>
                                                            <!-- <input type="text" class="form-control" placeholder="First Name" minlength="3" /> -->
                                                            <input name="first_name" type="text" class="form-control"
                                                                placeholder="First Name" pattern=".{3,}"
                                                                title="3 characters minimum">
                                                            <br />
                                                            OR
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group text-center">
                                                            <label class="text-left">Last Name</label>
                                                            <input name="last_name" type="text" class="form-control"
                                                                placeholder="Last Name" pattern=".{3,}"
                                                                title="3 characters minimum" />
                                                            <br />
                                                            OR
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Company Name</label>
                                                            <input name="company" type="text" class="form-control"
                                                                placeholder="Company Name" pattern=".{3,}"
                                                                title="3 characters minimum" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 text-center"
                                                        style="margin-top: 20px; margin-bottom: 20px;">
                                                        <button type="submit" class="btn btn-sm btn-info">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="divider divider-center divider-short">
                                        <!-- divider -->
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- divider -->
                                        <div class="col-md-12 margin-bottom-20"
                                            style="background-color: #f6cbc9; border: 1px solid #888; padding-top: 10px; padding-bottom: 10px;">
                                            <p class="margin-bottom-0 text-center"
                                                style="font-size: 15px; color: #da291c;">Categories</p>
                                        </div>

                                        <?php
                                    foreach ($category as $value) {
                                    ?>
                                        <div class="col-md-3">
                                            <a onclick="categorysubmit(this.id)" id="<?= $value->id ?>"><i
                                                    class="fa fa-check-square-o"></i> <?= $value->category ?></a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                        <form action="{{ url('appointment_steppp2') }}" method="POST" id=""
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="category" id="categoryname">
                                            <button type="submit" id="categorysubmitbtn" style="display: none"></button>
                                        </form>
                                        <!-- <div class="col-md-3">
                                            <ul class="category-li" style="list-style: none;">
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category1</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category2</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category3</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category4</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category5</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category6</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category7</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category8</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category9</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category10</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category11</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category12</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category13</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category14</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category15</a>
                                                </li>
                                            </ul>
                                        </div> -->
                                        <!-- <div class="col-md-3">
                                            <ul class="category-li" style="list-style: none;">
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category1</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category2</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category3</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category4</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category5</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category6</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category7</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category8</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category9</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category10</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category11</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category12</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category13</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category14</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category15</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <ul class="category-li" style="list-style: none;">
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category1</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category2</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category3</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category4</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category5</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category6</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category7</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category8</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category9</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category10</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category11</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category12</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category13</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category14</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category15</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <ul class="category-li" style="list-style: none;">
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category1</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category2</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category3</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category4</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category5</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category6</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category7</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category8</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category9</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category10</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category11</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category12</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category13</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category14</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('appointment_step2') }}"><i class="fa fa-check-square-o"></i> Category15</a>
                                                </li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </section>
    <script type="text/javascript">
        function categorysubmit(id) {
            var name = id;
            // alert(name);
            $("#categoryname").val(name);
            $("#categorysubmitbtn").trigger('click');
        }
    </script>
@endsection
