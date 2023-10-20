@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-20">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Email Management / Manage</h4>
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
                    <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
                        <li><a href="{{ url('manage_folders') }}">Manage Folders</a></li>
                        <li><a href="{{ url('manage_contacts') }}">Manage Contacts</a></li>
                        <li class="active"><a href="{{ url('manage_emails') }}">Manage Emails</a></li>
                        <li><a href="{{ url('uploads') }}">Uploads</a></li>
                        <!--<li><a href="#">My Mailbox</a></li>-->
                    </ul>
                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                         <form method="POST" id="searf" role="form" enctype="multipart/form-data">
                        @csrf
                            <div class="col-md-12" style="border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">First 3 letters of first name or last name </label>
                                        <input type="text" class="form-control" name="sustr" placeholder="" required />                                        
                                    </div>
                                </div>

                                <div class="col-md-6" style="margin-top: 25px; margin-bottom: 20px;">
                                    <input type="submit" class="btn btn-md btn-info" value="Search">
                                </div>
                            </div>
                        </form>

                        <div class="col-md-12 margin-top-20">
                            <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>Action</th>
                                        <th>Move</th>
                                    </tr>
                                </thead>
                                <tbody id="mailb">
                                    <?php
                                        foreach ($emails as $value) {
                                    ?>
                                        <tr>
                                            <td><?= $value->first_name ?> <?= $value->last_name ?></td>
                                            <td><?= $value->email ?></td>
                                            <td>
                                                <?php if(($value->folder == 7) || ($value->folder == 8) || ($value->folder == 9) || ($value->folder == 10) || ($value->folder == 11) || ($value->folder == 12) || ($value->folder) == 13){ ?>
                                        
                                                <?php }else{ ?>
                                                <form action="{{ url('edit_manage_emails') }}" method="POST" id="" enctype="multipart/form-data" style="display: inline-flex;">
                                                @csrf
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <input type="submit" class="btn btn-xs btn-success" value="Edit">
                                                </form>
                                                <form action="{{ url('delete_manage_emails') }}" method="POST" id="" enctype="multipart/form-data" style="display: inline-flex;">
                                                @csrf
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                                </form>
                                                <?php } ?>
                                            </td>
                                            <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                        </tr>
                                    <?php 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    // $(document).ready(function() {
      $("#searf").submit(function(e) {
        e.preventDefault();
        // alert('hi');
          var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "get_manage_emails",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(html) {
                // console.log(html);
                $("#mailb").html(html);
            }
        });
      });
      
    // });
</script>
@endsection