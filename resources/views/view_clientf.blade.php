@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Client Management / Add Client</h4>
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
                    <!--<ul class="nav nav-tabs nav-button-tabs nav-justified" style="padding:10px;">
                                <li class="active"><a href="profile_info.php">Profile</a></li>
                                <li><a href="task.php">Task</a></li>
                                
                            
                                
                            </ul>-->
                    <form>
                        @csrf
                        <input type="hidden" name="id" value="<?= $client[0]->id ?>">
                        <div class="col-md-12" style="border: 1px solid #da291c !important; border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">First Name </label>
                                    <input type="text" class="form-control" placeholder="First Name" disabled name="first_name" value="<?= $client[0]->first_name ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Last Name </label>
                                    <input type="text" class="form-control" placeholder="Last Name" disabled name="last_name" value="<?= $client[0]->last_name ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Email Address" disabled name="email" value="<?= $client[0]->email ?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input class="form-control" placeholder="" name="address" value="<?= $client[0]->address ?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="">Zip Code</label>
                                    <input class="form-control" name="zip_code" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"  maxlength = "6" value="<?= $client[0]->zip_code ?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for=""> City </label>
                                    <input type="text" class="form-control" placeholder="" name="city" value="<?= $client[0]->city ?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="">Country</label>
                                    <select id="countries_states1" class="form-control bfh-countries" data-country="<?= $client[0]->country ?>" name="country" disabled></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="">State/Province</label>
                                    <select class="form-control bfh-states" data-country="countries_states1" data-state="<?= $client[0]->state ?>" name="state" disabled></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="text" class="form-control datepicker" placeholder="" name="dob" value="<?= $client[0]->dob ?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Home Phone</label>
                                    <input class="form-control" placeholder="Cell Phone" name="home_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" value="<?= $client[0]->home_phone ?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Work Phone</label>
                                    <input class="form-control" placeholder="Cell Phone" name="work_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" value="<?= $client[0]->work_phone ?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Cell Phone</label>
                                    <input class="form-control" placeholder="Cell Phone" name="cell_phone"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" value="<?= $client[0]->cell_phone ?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control" placeholder="" name="company" value="<?= $client[0]->company ?>" disabled />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Comments</label>
                                    <textarea class="form-control" placeholder="" rows="4" name="comment" disabled><?= $client[0]->comment ?></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection