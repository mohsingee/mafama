@extends('layouts.main') 
@section("content")
<style type="text/css">
    .profile-info td {
        text-align: left !important;
        /*font-size: 12px;*/
        padding: 0 2px;
        vertical-align: baseline;
    }
    .listbox {
        border: 1px solid #da291c73 !important;
        border-radius: 10px;
        padding-top: 20px;
        padding-bottom: 20px;
        box-shadow: 1px 4px 10px 3px #da291c57;
        height: 300px;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Search for a Business</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 margin-bottom-40 margin-top-20">
                            <div class="col-md-12 margin-bottom-20 margin-top-40">
                                <div class="col-md-6">
                                    <div class="col-md-12 shadow-boxx">
                                        <div class="col-md-12 text-center">
                                            <h4>By Religion & Location</h4>
                                        </div>
                                        <form action="{{ url('business_search_step2') }}" method="POST" enctype="multipart/form-data"> 
                                            @csrf   
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Religion</label>
                                                    <select class="form-control select2" name="religion">
                                                        <option value="all">All</option>
                                                        <?php
                                                        foreach($religion as $value){
                                                        ?>
                                                            <option value="<?= $value->religion ?>"><?= $value->religion ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select id="countries_states1" class="form-control bfh-countries" name="country"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <select class="form-control bfh-states" data-country="countries_states1" name="state"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" placeholder="City" name="city" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Zipcode</label>
                                                    <input type="text" class="form-control" placeholder="Zipcode" name="zipcode" />
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center" style="margin-top: 20px; margin-bottom: 20px;">
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
                                        <form action="{{ url('business_search_stepp2') }}" method="POST" enctype="multipart/form-data"> 
                                            @csrf
                                            <div class="col-md-12">
                                                <span>Search by first three letters of :</span>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group text-center">
                                                    <label class="text-left">First Name</label>
                                                    <!-- <input type="text" class="form-control" placeholder="First Name" minlength="3" /> -->
                                                    <input name="first_name" type="text" class="form-control" placeholder="First Name"  pattern=".{3,}" title="3 characters minimum">
                                                    <br />
                                                    OR
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group text-center">
                                                    <label class="text-left">Last Name</label>
                                                    <input name="last_name" type="text" class="form-control" placeholder="Last Name"  pattern=".{3,}" title="3 characters minimum" />
                                                    <br />
                                                    OR
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Company Name</label>
                                                    <input name="company" type="text" class="form-control" placeholder="Company Name"  pattern=".{3,}" title="3 characters minimum" />
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center" style="margin-top: 20px; margin-bottom: 20px;">
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
                                <div class="col-md-12 margin-bottom-20" style="background-color: #f6cbc9; border: 1px solid #888; padding-top: 10px; padding-bottom: 10px;">
                                    <p class="margin-bottom-0 text-center" style="font-size: 15px; color: #da291c;">Categories</p>
                                </div>
                            
                                <?php
                                foreach ($category as $value) {
                                ?>
                                    <div class="col-md-3">
                                         <a onclick="categorysubmit(this.id)" id="<?= $value->id ?>"><i class="fa fa-check-square-o"></i> <?= $value->category ?></a>
                                    </div>
                                <?php
                                }
                                ?>
                                <form action="{{ url('business_search_steppp2') }}" method="POST" id="" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="category" id="categoryname">
                                    <button type="submit" id="categorysubmitbtn" style="display: none"></button>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                            <div class="divider divider-center divider-short">
                                <!-- divider -->
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="col-md-12 text-center margin-bottom-20">
                                <div class="col-md-12 margin-bottom-20" style="background-color: #f6cbc9; border: 1px solid #888; padding-top: 10px; padding-bottom: 10px;">
                                    <p class="margin-bottom-0 text-center" style="font-size: 15px; color: #da291c;">Search Result</p>
                                </div>
                                <h4><?= $searchf ?></h4>
                            </div>
                            
                            
                            <div class="col-md-12 member_src_sec">
                                
                                <?php
                                foreach ($affiliates as $value) {
                                    ?>
                                        <div class="col-md-6 margin-bottom-20">
                                            <div class="col-md-12 shadow-boxx listbox">
                                                <div class="col-md-4 padding-0">
                                                    <img src="{{ asset('public/images/affiliates') }}/<?= $value->image ?>" style="border: 1px solid #da291c73 !important; border-radius: 5px;" width="140" height="140" alt="featured item" />
                                                </div>
                                                <div class="col-md-8 text-center padding-0">
                                                    <table class="profile-info margin-bottom-10">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Name: </b></td>
                                                                <td><?= $value->first_name ?> <?= $value->last_name ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Address: </b></td>
                                                                <td><?= $value->address ?>, State- <?= $value->state ?>, Country- <?= $value->country ?>, <?= $value->city ?>-<?= $value->zip_code ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Phone: </b></td>
                                                                <td><?= $value->cellphone ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Email: </b></td>
                                                                <td><?= $value->email ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Faith: </b></td>
                                                                <td><?= $value->religion ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Business Telephone: </b></td>
                                                                <td><?= $value->business_telephone ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr />
                                                <div class="col-md-12 text-center">
                                                    @if(Auth::id() == "")
                                                        <a href="{{ url('appointment_login') }}" class="btn btn-xs btn-info" style="margin-right: 10px; width: auto;">Make Appointment</a>
                                                    @elseif((Auth::id() != "") && (Auth::user()->role == "client"))
                                                        <a href="{{ url('member_appointment_step3') }}/<?= base64_encode($value->email) ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: auto;">Make Appointment</a>
                                                    @elseif((Auth::id() != "") && (Auth::user()->role == "temp_user"))
                                                        <a href="{{ url('user_appointment_step3') }}/<?= base64_encode($value->email) ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: auto;">Make Appointment</a>
                                                    @endif
                                                    <a href="{{url('user/'.$value->username)}}" class="btn btn-xs btn-info" style="margin-right: 10px; width: 110px;">More Info</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                                ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function categorysubmit(id){
        var name = id;
        // alert(name);
        $("#categoryname").val(name);
        $("#categorysubmitbtn").trigger('click');
    }
</script>
@endsection