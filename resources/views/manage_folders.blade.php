@extends('layouts.main')
@section('content')
    <style>
        .clipboard {
            display: inline-block;
        }

        /* You just need to get this field */
        .copy-input {
            max-width: 324px;
            width: 100%;
            cursor: pointer;
            background-color: #eaeaeb;
            border: none;
            color: #6c6c6c;
            font-size: 14px;
            border-radius: 5px;
            padding: 10px 45px 10px 15px;
            font-family: 'Montserrat', sans-serif;
            border: #da291c7a 1px solid !important
                /* box-shadow: 0 3px 15px #b8c6db;
     -moz-box-shadow: 0 3px 15px #b8c6db;
      -webkit-box-shadow: 0 3px 15px #b8c6db;*/
        }

        .copy-input:focus {
            outline: none;
        }

        .copy-btn {
            width: 40px;
            background-color: #eaeaeb;
            font-size: 16px;
            padding: 6px 9px;
            border-radius: 5px;
            border: none;
            color: #6c6c6c;
            margin-left: -50px;
            transition: all .4s;
        }

        .copy-btn:hover {
            transform: scale(1.1);
            color: #1a1a1a;
            cursor: pointer;
        }

        .copy-btn:focus {
            outline: none;
        }

        .copied {
            font-family: 'Montserrat', sans-serif;
            width: 75px;
            display: none;
            position: absolute;
            bottom: 0px;
            left: 150px;
            margin: auto;
            color: #000;
            padding: 15px 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 3px 15px #b8c6db;
            -moz-box-shadow: 0 3px 15px #b8c6db;
            -webkit-box-shadow: 0 3px 15px #b8c6db;
        }

        .copied1 {
            font-family: 'Montserrat', sans-serif;
            width: 75px;
            display: none;
            position: absolute;
            bottom: 0px;
            left: 470px;

            margin: auto;
            color: #000;
            padding: 15px 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 3px 15px #b8c6db;
            -moz-box-shadow: 0 3px 15px #b8c6db;
            -webkit-box-shadow: 0 3px 15px #b8c6db;
        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2) {
            .copy-btn {
                width: 30px;
                background-color: #eaeaeb;
                font-size: 16px;
                padding: 6px 9px;
            }

            .copied {
                bottom: 130px;
                left: 150px;
            }

            .copied1 {
                bottom: 90px;
                left: 150px;
            }

            .copy-input {
                margin-bottom: 10px;
            }
        }
    </style>
    <script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
    <section>
        <div class="container">
            <div class="row">
                <!-- tabs content -->
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12 margin-bottom-20">
                        <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                            <h4>Email Management / Manage</h4>
                        </div>
                        <div class="col-md-12 text-center margin-bottom-20" style="padding:0;">
                            <span style="display:inline-block;max-width: 344px;width: 100%;">
                                <label style="display:block;text-align: center;">Your Website link</label>
                                <input onclick="copy1()" class="copy-input" value="{{ $my_profile_link }}"
                                    id="copyClipboard1" style="margin-right:20px;" readonly>
                            </span>
                            <button type="button" class="copy-btn" id="copyButton" onclick="copy1()"><i
                                    class="far fa-copy"></i></button>
                            <div id="copied-success1" class="copied">
                                <span>Copied!</span>
                            </div>
                            <span style="display:inline-block;max-width: 344px;width: 100%;">
                                <label style="display:block;text-align: center;">Referral link</label>
                                <input onclick="copy()" class="copy-input" value="{{ $my_referral_link }}"
                                    id="copyClipboard" style="margin-right:20px;" readonly>
                            </span>
                            <button type="button" class="copy-btn" id="copyButton" onclick="copy()"><i
                                    class="far fa-copy"></i></button>
                            <div id="copied-success" class="copied1">
                                <span>Copied!</span>
                            </div>

                            <div class="margin-top-10">
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
                        </div>
                        <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
                            <li class="active"><a href="{{ url('manage_folders') }}">Manage Folders</a></li>
                            <li><a href="{{ url('manage_contacts') }}">Manage Contacts</a></li>
                            <li><a href="{{ url('manage_emails') }}">Manage Emails</a></li>
                            <li><a href="{{ url('uploads') }}">Uploads</a></li>
                            <!--<li><a href="#">My Mailbox</a></li>-->
                        </ul>
                        <div class="tab-content margin-top-10"
                            style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                            <form action="{{ url('manage_folders_entry') }}" method="POST" id=""
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12"
                                    style="border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">New Folder Name </label>
                                            <input type="text" class="form-control" placeholder="" name="folder_name" />
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 25px; margin-bottom: 20px;">
                                        <input type="submit" class="btn btn-md btn-info" value="Save">
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12 margin-top-20">
                                <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                    <thead>
                                        <tr>
                                            <th>Address Book Folder Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($folders as $value) {
                                    ?>
                                        <tr>
                                            <td><?= $value->folder_name ?></td>
                                            <?php if(($value->folder_name == "Family") || ($value->folder_name == "Friends") || ($value->folder_name == "Client") || ($value->folder_name == "VIP client") || ($value->folder_name == "Basket 1") || ($value->folder_name == "Basket 2") || ($value->folder_name) == "Basket X"){ ?>
                                            <td>
                                                <form action="{{ url('view_manage_folders') }}" method="POST"
                                                    id="" enctype="multipart/form-data"
                                                    style="display: inline-flex;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <input type="submit" class="btn btn-xs btn-info" value="View">
                                                </form>
                                            </td>
                                            <?php }else{ ?>
                                            <td>
                                                <form action="{{ url('edit_manage_folders') }}" method="POST"
                                                    id="" enctype="multipart/form-data"
                                                    style="display: inline-flex;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <input type="submit" class="btn btn-xs btn-info" value="Edit">
                                                </form>
                                                <form action="{{ url('delete_manage_folders') }}" method="POST"
                                                    id="" enctype="multipart/form-data"
                                                    style="display: inline-flex;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <input type="submit" class="btn btn-xs btn-info" value="Delete">
                                                </form>
                                                <form action="{{ url('view_manage_folders') }}" method="POST"
                                                    id="" enctype="multipart/form-data"
                                                    style="display: inline-flex;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="<?= $value->id ?>">
                                                    <input type="submit" class="btn btn-xs btn-info" value="View">
                                                </form>
                                                <!-- <a href="#" class="btn btn-xs btn-info">Delete</a>
                                                    <a href="" class="btn btn-xs btn-info">view</a> -->
                                            </td>
                                            <?php }  ?>
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
        function copy() {
            var copyText = document.getElementById("copyClipboard");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            $('#copied-success').fadeIn(800);
            $('#copied-success').fadeOut(800);
        }

        function copy1() {
            var copyText = document.getElementById("copyClipboard1");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            $('#copied-success1').fadeIn(800);
            $('#copied-success1').fadeOut(800);
        }
    </script>
@endsection
