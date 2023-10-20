@extends('layouts.main') 
@section("content")
<?php use Carbon\Carbon; ?>
<style type="text/css">
	p, pre, ul, ol, dl, dd, blockquote, address, table, fieldset, form{
		margin-bottom: 0;
	}
	.fc-content-skeleton thead {
		background: transparent;
		color: red;
	}
	span, a {
	    color: #fae3e2;
	}
	.fc-event-time{
	   display : none;
	}
	.fc-time{
	   display : none;
	}
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Dashboard</h4>
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
                <div class="col-md-12 padding-0">
                  <div style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                    <h3>Schedule</h3>
                    <div class="margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px; margin-bottom: 10px">
                      <h4>Today's Birthdays</h4>
                      <?php
                        if(count($birthdays) > 0){
                        ?>
                        <?php
                            foreach ($birthdays as $value) {
                        ?>
                            <p><?= $value->first_name ?> <?= $value->last_name ?>'s birthday is here.</p>
                        <?php
                            }
                        }else{
                        ?>
                        <p>No Result Found</p>
                      <?php } ?>
                    </div>
                    <div style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px; margin-bottom: 10px">
                      <h4>Today's Meeting Schedule</h4>
                      <?php 
                      if(count($meeting_task) > 0){
                        foreach($meeting_task as $value){ 
                      ?>
                          <div class="col-md-12">
                              <div style="">
                                  <h5><?= $value->title ?></h5>
                                  <p><?= $value->description ?></p>
                              </div>
                          </div>
                      <?php }}else{ ?>
                        <p>No Result Found</p>
                      <?php } ?>
                    </div>
                    <div style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px; margin-bottom: 10px">
                      <h4>Today's Appointments</h4>
                      <div class="row">
                        <?php 
                        if(count($appointments) > 0){
                          foreach($appointments as $value){ 
                        ?>
                            <div class="col-md-6 margin-bottom-20">
                                <div class="col-md-12 shadow-boxx">
                                    <div class="col-md-12 text-center margin-bottom-20" style="background-color: #da291c; padding: 0px; border-radius: 10px;">
                                        <h4 style="color: #fff; font-weight: 400; margin-top: 10px; margin-bottom: 10px;">Appointment for <?= $value->client_first_name ?> <?= $value->client_last_name ?></h4>
                                    </div>
                                    <div class="col-md-12 text-center padding-0">
                                        <table class="profile-info margin-bottom-10" style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%"><b>Date : </b></td>
                                                    <td style="width: 70%"><?= date('d F Y', strtotime($value->appointment_date)) ?>, <?= Carbon::parse($value->appointment_date)->format('l') ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%"><b>Time : </b></td>
                                                    <td style="width: 70%"><?= date('h:i A', strtotime($value->appointment_time)) ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%"><b>With : </b></td>
                                                    <td style="width: 70%"><?= $value->affiliate_first_name ?> <?= $value->affiliate_last_name ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Company: </b></td>
                                                    <td>&nbsp;<?= $value->client_company ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: baseline;"><b>Address: </b></td>
                                                    <td>&nbsp;<?= $value->client_address ?>,<br> State- <?= $value->client_state ?>, Country- <?= $value->client_country ?>, <?= $value->client_city ?>-<?= $value->client_zip ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Phone: </b></td>
                                                    <td>&nbsp;<?= $value->client_phone ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="width: 30%; vertical-align: baseline;"><b>Reason : </b></td>
                                                  <td style="width: 70%"><?= $value->appointment_reason ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php }}else{ ?>
                          <p>No Result Found</p>
                        <?php } ?>
                      </div>
                    </div>
                    <div style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px; margin-bottom: 10px">
                      <h4>Today's New Client</h4>
                      <div class="row">
                        <?php 
                        if(count($clients) > 0){
                          foreach($clients as $value){ 
                        ?>
                            <div class="col-md-6 margin-bottom-20">
                                <div class="col-md-12 shadow-boxx">
                                    <div class="col-md-12 text-center padding-0">
                                        <table class="profile-info margin-bottom-10" style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%"><b>Name : </b></td>
                                                    <td style="width: 70%">{{ $value->first_name }} {{ $value->last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%"><b>Email : </b></td>
                                                    <td style="width: 70%">{{ $value->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%"><b>Address : </b></td>
                                                    <td style="width: 70%">{{ $value->address }}<br>State : {{ $value->state }}, Country : {{ $value->country }}<br>{{ $value->city }}-{{ $value->zip_code }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Company: </b></td>
                                                    <td>&nbsp;<?= $value->company ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Phone: </b></td>
                                                    <td>&nbsp;<?= $value->cell_phone ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="width: 30%;"><b>Religion : </b></td>
                                                  <td style="width: 70%"><?= $value->religion ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php }}else{ ?>
                          <p>No Result Found</p>
                        <?php } ?>
                      </div>
                    </div>
                    <div style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px; margin-bottom: 10px">
                      <h4>Today's New Email</h4>
                      <div class="row">
                        <?php 
                        if((count($email_campaigns) > 0) || (count($send_emails) > 0) || (count($send_cards) > 0) || (count($send_videos) > 0) || (count($send_sms) > 0)){
                          foreach($email_campaigns as $value){ 
                        ?>
                            <div class="col-md-6 margin-bottom-20">
                                <div class="col-md-12 shadow-boxx">
                                    <div class="col-md-12 text-center padding-0">
                                        <table class="profile-info margin-bottom-10" style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%"><b>Email : </b></td>
                                                    <td style="width: 70%">{{ $value->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%"><b>Message : </b></td>
                                                    <td style="width: 70%">{!! $value->message !!}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        }
                        foreach($send_emails as $value2){
                        ?>
                          <div class="col-md-6 margin-bottom-20">
                                <div class="col-md-12 shadow-boxx">
                                    <div class="col-md-12 text-center padding-0">
                                        <table class="profile-info margin-bottom-10" style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%"><b>Email : </b></td>
                                                    <td style="width: 70%">{{ $value2->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%"><b>Message : </b></td>
                                                    <td style="width: 70%">{!! $value2->message !!}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        } 
                        foreach($send_cards as $value3){
                        ?>
                          <div class="col-md-6 margin-bottom-20">
                              <div class="col-md-12 shadow-boxx">
                                  <div class="col-md-12 text-center padding-0">
                                      <table class="profile-info margin-bottom-10" style="width: 100%">
                                          <tbody>
                                              <tr>
                                                  <td style="width: 30%"><b>Email : </b></td>
                                                  <td style="width: 70%">{{ $value3->email }}</td>
                                              </tr>
                                              <tr>
                                                  <td style="width: 30%"><b>Message : </b></td>
                                                  <td style="width: 70%">{!! $value3->message !!}</td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                        <?php 
                        } 
                        foreach($send_videos as $value4){
                        ?>
                          <div class="col-md-6 margin-bottom-20">
                              <div class="col-md-12 shadow-boxx">
                                  <div class="col-md-12 text-center padding-0">
                                      <table class="profile-info margin-bottom-10" style="width: 100%">
                                          <tbody>
                                              <tr>
                                                  <td style="width: 30%"><b>Email : </b></td>
                                                  <td style="width: 70%">{{ $value4->email }}</td>
                                              </tr>
                                              <tr>
                                                  <td style="width: 30%"><b>Message : </b></td>
                                                  <td style="width: 70%">{!! $value4->message !!}</td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                        <?php 
                        } 
                        foreach($send_sms as $value5){
                        ?>
                          <div class="col-md-6 margin-bottom-20">
                              <div class="col-md-12 shadow-boxx">
                                  <div class="col-md-12 text-center padding-0">
                                      <table class="profile-info margin-bottom-10" style="width: 100%">
                                          <tbody>
                                              <tr>
                                                  <td style="width: 30%"><b>Email : </b></td>
                                                  <td style="width: 70%">{{ $value5->email }}</td>
                                              </tr>
                                              <tr>
                                                  <td style="width: 30%"><b>Message : </b></td>
                                                  <td style="width: 70%">{!! $value5->message !!}</td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                        <?php
                        }
                        }else{ ?>
                          <p>No Result Found</p>
                        <?php } ?>
                      </div>
                    </div>
                    <div style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px; margin-bottom: 10px">
                      <h4>Today's Revenue Records</h4>
                      <div class="margin-bottom-20">
                        <?php 
                        if((count($revenue_records) > 0)){
                        ?>
                          <table class="table table-striped table-borde#da291c table-hover" id="datatable_sample">
                            <thead>
                                <tr>
                                    <th>Transaction Date</th>
                                    <th>Accounts / Desc</th>
                                    <th>Charged / Bill</th>
                                    <th>Tax</th>
                                    <th>Shipping</th>
                                    <th>Total</th>
                                    <th>Amount Paid</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="listid">
                                <?php
                                foreach ($revenue_records as $value) {
                                ?>
                                    <tr>
                                        <td>
                                            <label class="checkbox chk-sm">
                                                <input class="tran_check" type="checkbox" value="<?= $value->id ?>" onchange="tran_check()" />
                                                <i></i> <?= date('d F Y', strtotime($value->transaction_date)); ?>
                                            </label>
                                        </td>
                                        <td><?= $value->account_description ?></td>
                                        <td><?= $value->bill ?></td>
                                        <td><?= $value->tax ?></td>
                                        <td><?= $value->shipping ?></td>
                                        <td><?= $value->total ?></td>
                                        <td><?= $value->amount_paid ?></td>
                                        <td><?= $value->balance ?></td>
                                        <td>
                                            <a href="{{ url('edit_revenue_record') }}/<?= $value->id ?>" class="btn btn-xs btn-info">Edit</a>
                                            <a id="<?= $value->id ?>" class="btn btn-xs btn-info delete">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                          </table>
                        
                        <?php }else{ ?>
                          <p>No result found</p>
                        <?php } ?>
                      </div>
                      <h4>Today's Expense Records</h4>
                      <div class="">
                        <?php 
                        if((count($expense_records) > 0)){
                        ?>
                          <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                            <thead>
                                <tr>
                                    <th style="text-align: center !important;">Transaction Date</th>
                                    <th>Accounts / Desc</th>
                                    <th>Charged / Bill</th>
                                    <th>Amount paid</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($expense_records as $value) {
                                ?>
                                    <tr>
                                        <td><?= date('d F Y', strtotime($value->transaction_date)); ?></td>
                                        <td><?= $value->account_description ?></td>
                                        <td><?= $value->total ?></td>
                                        <td><?= $value->amount_paid ?></td>
                                        <td><?= $value->balance ?></td>
                                        <td>
                                            <a href="{{ url('edit_expense_record') }}/<?= $value->id ?>" class="btn btn-xs btn-info">Edit</a>
                                            <a id="<?= $value->id ?>" class="btn btn-xs btn-info delete">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        
                        <?php }else{ ?>
                          <p>No result found</p>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection