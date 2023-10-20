@extends('layouts.main') 
@section("content")

<style>
.checkbox+.checkbox, .radio+.radio {
    margin-top: 0px;
}
td.radio i, .checkbox i {
    position: inherit;
}
</style>
            <!-- -->
            <section>
                <div class="container">
                    <div class="row">

                        <!-- tabs -->
                        <!-- tabs content -->
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                    <h4>Settings / Client Management Settings</h4>
                                </div>
                                <div class="col-md-12 text-right margin-bottom-20">
                                    <div class="margin-top-10">
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
                                        <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">My Daily Briefing</a>
                                        <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
                                    <li class="active"><a href="#tab1" data-toggle="tab">Client Profile Settings</a></li>
                                    <li><a  href="#tab2" data-toggle="tab">Form Upload</a></li>
                                    
                                </ul>

                                <div class="tab-content margin-top-10"  style=" border:1px solid #da291c !important; border-radius:10px;padding:10px;">
                                    <div class="tab-pane fade in active" id="tab1">
                                        <form class=""> 
                                            <div class="col-md-12"  style="border-radius:10px;padding:10px;">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" class="form-control"  placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Religious Faith</label>
                                                        <select class="form-control">
                                                            <option>Protestantism</option>
                                                            <option>Catholicism</option>
                                                            <option>Hinduism</option>
                                                            <option>Jainism</option>
                                                            <option>Other</option>
                                                            <option>None</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control"  placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Cell Phone</label>
                                                        <input type="text" class="form-control"  placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Business Telephone</label>
                                                        <input type="text" class="form-control"  placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Choose a Business Category</label>
                                                        <select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1">
                                                          <option>test1</option>
                                                          <option>test2</option>
                                                          <option>test3</option>
                                                          <option>test4</option>
                                                          
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Uplaod Picture</label>
                                                        <div class="fancy-file-upload fancy-file-info">
                                                            <i class="fa fa-upload"></i>
                                                            <input type="file" class="form-control" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                            <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                                                            <span class="button">Choose File</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Street Address</label>
                                                        <input type="text" class="form-control"  placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Zip Code</label>
                                                        <input type="text" class="form-control"  placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for=""> City </label>
                                                        <input type="text" class="form-control"  placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">State/Province</label>
                                                        <select class="form-control  select2">
                                                          <option>Maharashtra</option>
                                                          <option>Punjab</option>
                                                          <option>Harayana</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Country</label>
                                                        <select class="form-control  select2">
                                                          <option>India</option>
                                                          <option>USA</option>
                                                          <option>Brazil</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-md-12" style="margin-top:40px;">
                                                    <h4>Billing Information</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Street Address</label>
                                                        <input type="text" class="form-control"  placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Zip Code</label>
                                                        <input type="text" class="form-control"  placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for=""> City </label>
                                                        <input type="text" class="form-control"  placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">State/Province</label>
                                                        <select class="form-control  select2">
                                                          <option>Maharashtra</option>
                                                          <option>Punjab</option>
                                                          <option>Harayana</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Country</label>
                                                        <select class="form-control  select2">
                                                          <option>India</option>
                                                          <option>USA</option>
                                                          <option>Brazil</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                            <div class="col-md-12" style="margin-top:40px; text-align:center;">
                                                <a href="#" class="btn btn-md btn-info">Save Chages</a>
                                                
                                            </div>
                                            <!--<div class="clearfix"></div>
                                            </div>-->
                                        </form>
                                    </div>
                                    
                                    <div class="tab-pane" id="tab2">
                                        
                                        
                                    
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    
                                
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

@endsection