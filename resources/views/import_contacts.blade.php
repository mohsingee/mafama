@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-10 text-center">
                        <h4>Settings / Import Address Book</h4>
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
                    <!--<ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                                    <li class="active"><a href="add_appointment_setting.php">Appointment</a></li>
                                    <li><a href="#">Client Management</a></li>
                                    <li><a href="#">Email Management</a></li>
                                    <li><a href="#">Financial Management</a></li>
                                    
                                </ul>

                                <div class="tab-content margin-top-10"  style=" border-radius:10px;padding:10px;">-->
                    <form id="register" method="POST" enctype="multipart/form-data"> 
                    @csrf
                        <div class="col-md-12" style="border: 1px solid #da291c !important; border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                            <div class="col-md-12 text-center">
                                <p id="success_card" style="color: green;margin: 10px; font-size: 18px; font-weight: bold"></p>
                            </div>
                            <div class="col-md-12">
                                <h4 class="margin-bottom-20">Click on your Email Provider below you want to import contacts from.</h4>
                            </div>

                            <div class="col-md-12 margin-bottom-20">
                                <ul class="provider-ul" style="padding-left: 0px;">
                                    <li style="margin-right: 10px;"><img src="{{ asset('public/images/aol.jpg') }}" alt="aol" /></li>
                                    <li style="margin-right: 10px;"><img src="{{ asset('public/images/FM.jpg') }}" alt="FM" /></li>
                                    <li style="margin-right: 10px;"><img src="{{ asset('public/images/gmail.jpg') }}" alt="gmail" /></li>
                                    <li style="margin-right: 10px;"><img src="{{ asset('public/images/hotmail.jpg') }}" alt="hotmail" /></li>
                                    <li style="margin-right: 10px;"><img src="{{ asset('public/images/lycos.jpg') }}" alt="lycos" /></li>
                                    <li style="margin-right: 10px;"><img src="{{ asset('public/images/mail.jpg') }}" alt="mail" /></li>
                                    <br />
                                </ul>
                                <br />
                                <ul class="provider-ul" style="padding-left: 0px;">
                                    <li style="margin-right: 10px;"><img src="{{ asset('public/images/mailru.jpg') }}" alt="mailru" /></li>
                                    <li style="margin-right: 10px;"><img src="{{ asset('public/images/rediffmail.jpg') }}" alt="rediffmail" /></li>
                                    <li style="margin-right: 10px;"><img src="{{ asset('public/images/yahoo.jpg') }}" alt="yahoo" /></li>
                                    <li style="margin-right: 10px;"><img src="{{ asset('public/images/zapak.jpg') }}" alt="zapak" /></li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" style="display: flex; vertical-align: middle;">
                                    <label class="form-label margin-top-10">Import From </label>
                                    <input type="text" class="form-control import-input" style="width: 300px; margin-left: 20px; margin-right: 10px;" name="provider" required />
                                    <small class="margin-top-10">(please click on one of the above images )</small>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="divider divider-center divider-short">
                                <!-- divider -->
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="col-md-12">
                                <h4>Enter the Username & Password you use for that same Provider.</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">User Name </label>
                                    <input type="text" class="form-control" name="username" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Password </label>
                                    <input type="password" class="form-control" name="password" />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="divider divider-center divider-short">
                                <!-- divider -->
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="col-md-12">
                                <h4>Select a default folder to put your contacts or you can create a new folder immediately and import your contacts to this new folder(you can create as many folders as you want right on this page.)</h4>
                            </div>
                            
                            <?php if(count($folders) > 0){ ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Select folder (optional) </label>
                                    <select class="form-control select2 foldersel" name="added_folder">
                                        <?php foreach($folders as $value){ ?>
                                            <option value="<?= $value->folder_name ?>"><?= $value->folder_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <a class="btn btn-xs btn-info add-folder" style="margin-top: 35px;">Add New Folder</a>
                                <p id="folder_alert" style="color: red; font-weight: bold;"></p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6 folder-input" style="margin-top: 10px">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Folder Name" name="new_folder" />
                                </div>
                            </div>
                            <div class="col-md-12 text-center" style="margin-top: 20px; margin-bottom: 20px;">
                                <button type="submit" class="btn btn-md btn-info">Import contacts</button>
                                
                            </div>
                        </div>
                    </form>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(".folder-input").hide();
$(".add-folder").click(function(){
  $(".folder-input").show();
});

$("img").click(function(){
  var alt = $(this).attr("alt");
 $("input.import-input").val(alt);
 
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#register").submit(function(e) {
            //---------------^---------------
            e.preventDefault();
            <?php 
            $foldercn = count($folders); 
            ?>
            var foldercnt = <?= $foldercn ?>;
            // alert(foldercnt);
            if((foldercnt == 0) && ($("input[name='new_folder']").val() == ""))
            {
                $("#folder_alert").html("**Folder is required!");
            }
            else{
                $("#folder_alert").html("");
                var formData = new FormData(this);
                $.ajax({
                  type: "POST",
                  beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
                  url: "import_contact_entry",
                  data:  formData,
                    contentType: false,
                    cache: false,
                    processData:false,
                  success: function(html) {
                    // alert(html);
                    $(".foldersel").html(html);
                    $("#success_card").html("Inserted Succesfully.");
                    $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                    $("input[name='new_folder']").val("");
                    $("input[name='username']").val("");
                    $("input[name='password']").val("");
                    $("input[name='provider']").val("");
                  },
                  complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                  }
                });
            }
        });
    })
</script>
@endsection