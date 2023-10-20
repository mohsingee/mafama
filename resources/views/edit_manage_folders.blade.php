@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
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
                        <li class="active"><a href="{{ url('manage_folders') }}">Manage Folders</a></li>
                        <li><a href="{{ url('manage_contacts') }}">Manage Contacts</a></li>
                        <li><a href="{{ url('manage_emails') }}">Manage Emails</a></li>
                        <li><a href="{{ url('uploads') }}">Uploads</a></li>
                        <li><a href="#">My Mailbox</a></li>
                    </ul>
                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <form action="{{ url('manage_folders_update') }}" method="POST" id="" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="id" value="<?= $folder[0]->id ?>">
                            <div class="col-md-12" style="border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Folder Name </label>
                                        <input type="text" class="form-control" placeholder="" name="folder_name" value="<?= $folder[0]->folder_name ?>" />
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-top: 25px; margin-bottom: 20px;">
                                    <input type="submit" class="btn btn-md btn-info" value="Update">
                                </div>
                            </div>
                        </form>

                        
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection