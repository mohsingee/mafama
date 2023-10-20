 {{-- Front end user can use “Settings”/ Birthplace to upload videos/banner and input text for his own page. --}}

 @extends('layouts.main')
 <style type="text/css">
     p {
         margin-bottom: 5px !important;
     }

     pre,
     ul,
     ol,
     dl,
     dd,
     blockquote,
     address,
     table,
     fieldset,
     form {
         margin-bottom: 10px !important;
     }


     .circle {
         width: 150px;
         height: 150px;
         line-height: 150px;
         border-radius: 50%;
         font-size: 24px;
         color: #fff;
         text-align: center;
         background: rgb(255, 0, 51);
     }
 </style>
 @section('content')
     <link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />

     <!-- -->
     <section>
         <div class="container">
             <div class="row">
                 <!-- tabs -->
                 <?php // include 'setting_header.php';
                 ?>
                 <!-- tabs content -->
                 <div class="col-md-12 col-sm-12">
                     <div class="row">
                         <div class="col-md-5" style="border: 1px solid #da291c !important; ">
                             <?php $option = "navText : [\"<i class='icofont-scroll-left'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              </i>\",\"<i class='icofont-scroll-right'></i>\"]"; ?>
                             <div class="owl-carousel nomargin"
                                 data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": 3000, "pagination": false, "nav": true, "dots": true, "lazyLoad": true }'
                                 style="padding: 0 5px;">
                                 <?php
                                         if(count($admin_birthplace_banner_info)==0){
                                          ?> <p>No record found</p>
                                 <?php }else{
                                        foreach ($admin_birthplace_banner_info as $value) {
                                        ?>
                                 <div>
                                     <h2 class="text-center">{{ $value->title }}</h2>
                                     <img class="img-responsive" src="{{ $value->file_url }}" width="100%" height="100%">
                                     <div class="text-center text-primary">

                                         <p><?= $value->description ?></p>
                                         {{--  --}}
                                     </div>
                                 </div>
                                 <?php
                                    }}

                                ?>
                             </div>
                         </div>
                         <div class="col-md-2">
                             <div class="heading-title  col-md-12 margin-bottom-0 text-center">
                                 <?php //print_r($user_info);
                                 ?>
                                 <h4>Welcome to</h4><br>
                                 <h3> {{ isset($user_info->birth_city) ? $user_info->birth_city . '/' : '' }}
                                     {{ isset($user_info->birth_state) ? $user_info->birth_state : showcommuneName($user_info->birth_commune) }}
                                 </h3>
                             </div>
                             <br><br><br><br><br>


                             <div class="circle text-center">
                                 @if (isset($user_birthplace_number->description))
                                     ${{ number_format($user_birthplace_number->description, 2) }}
                                 @else
                                     ${{ number_format(0, 2) }}
                                 @endif
                             </div>

                         </div>
                         <div class="col-md-5" style="border: 1px solid #da291c !important; ">
                             <div class="owl-carousel nomargin"
                                 data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": 3000, "pagination": false}'
                                 style="padding: 0 5px;">
                                 <?php
                                          if(count($admin_birthplace_video_info)==0){
                                          ?> <p>No record found</p>
                                 <?php }else{
                                        foreach ($admin_birthplace_video_info as $value) {
                                        ?>
                                 <div>
                                     <h2 class="text-center">{{ $value->title }}</h2>

                                     <video width="100%" height="160px" controls>
                                         <source src="{{ $value->file_url }}" type="video/mp4">
                                     </video>

                                     <div class="text-center text-primary">

                                         <p><?= $value->description ?></p>
                                         {{--  --}}
                                     </div>
                                 </div>
                                 <?php
                                    }
                                         }
                                ?>
                             </div>
                         </div>
                     </div>

                     <div class="col-md-12">
                         <div class="heading-title heading-dotted col-md-12 margin-bottom-0 text-center">
                             <h4>My Birthplace</h4>
                         </div>
                         <div class="col-md-12 text-right margin-bottom-20">
                             <div class="margin-top-10">
                                 <a href="{{ url('birthplace') }}" class="btn btn-md btn-info margin-right-10">Project</a>
                                 <a href="{{ url('birthplace_list') }}" class="btn btn-md btn-info margin-right-10">List</a>


                                 <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                             </div>
                         </div>
                         <!--<ul class="nav nav-tabs nav-button-tabs nav-justified  margin-bottom-40">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <li class="active"><a href="add_appointment_setting.php">Appointment</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <li><a href="#">Client Management</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <li><a href="#">Email Management</a></li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <li><a href="#">Financial Management</a></li>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </ul>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="tab-content margin-top-10"  style=" border-radius:10px;padding:10px;">-->




                         <div class="col-md-12"
                             style="border: 1px solid #da291c !important; border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">


                             <div class="col-md-12">

                                 <table class="table table-striped table-bordered table-hover" style="font-size:90%"
                                     id="datatable_sample">
                                     <thead>
                                         <tr>
                                             <th width="5%" class="table-checkbox">
                                                 <input type="checkbox" class="group-checkable"
                                                     data-set="#datatable_sample checkboxes" />
                                             </th>
                                             <th width="20%">Full Name & Picture</th>
                                             <th width="10%">Date of Birth</th>
                                             <th width="10%">State/Commune of Birth</th>
                                             <th width="15%">Country of Residence</th>
                                             <th width="10%">City of Residence</th>
                                             <th width="10%">Biz Name if any</th>
                                             <th width="20%">Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
foreach ($affiliate_users as $value) {
    //   dd($value)
    ?>
                                         <tr>

                                             <td><input type="checkbox" class="checkboxes" value="<?= $value->id ?>" /></td>


                                             <td style="align:center;text-align: center;">
                                                 @if (isset($value->image) && $value->image != '')
                                                     <img src="{{ url('images/affiliates/' . $value->image) }}"
                                                         width="80" height="80"
                                                         style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;">
                                                     <br>
                                                 @endif
                                                 <?= $value->first_name . ' ' . $value->last_name ?>
                                             </td>
                                             <td><?= date('d F', strtotime($value->dob)) ?></td>

                                             <td><?= (isset($value->birth_state) ? $value->birth_state : isset($value->birth_commune)) ? showcommuneName($value->birth_commune) : '' ?>
                                             </td>
                                             <td><?= isset($value->country) ? getCountryName($value->country) : '' ?>

                                             </td>
                                             <td><?= $value->city ?></td>
                                             <td><?= getBusinessName($value->email) ?></td>
                                             <td width="20%">

                                                 <a href="{{ url('user_birthplace') . '/' . $value->id }}"
                                                     class="btn btn-xs btn-success " id="view_btn"> View</a>
                                                 <a class="btn btn-xs btn-warning " id="view_btn"> Contact</a>

                                                 <a class="btn btn-xs btn-info " id="view_btn"> More info</a>


                                             </td>
                                         </tr>
                                         <?php

}
?>
                                         <?php
                                         if(isset($business_users)){
foreach ($business_users as $value) {
    //  dd($value)
    ?>
                                         <tr>

                                             <td><input type="checkbox" class="checkboxes" value="<?= $value->id ?>" /></td>
                                             <td style="align:center;text-align: center;">
                                                 @if (isset($value->image) && $value->image != '')
                                                     <img src="{{ url('images/affiliates/' . $value->image) }}"
                                                         width="80" height="80"
                                                         style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;">
                                                     <br>
                                                 @endif
                                                 <?= $value->first_name . ' ' . $value->last_name ?>
                                             </td>
                                             <td><?= date('d F', strtotime($value->dob)) ?></td>

                                             <td><?= (isset($value->birth_state) ? $value->birth_state : isset($value->birth_commune)) ? showcommuneName($value->birth_commune) : '' ?>
                                             </td>
                                             <td><?= isset($value->country) ? getCountryName($value->country) : '' ?>

                                             </td>
                                             <td><?= $value->city ?></td>
                                             <td></td>
                                             <td width="20%">

                                                 <a href="{{ url('user_birthplace') . '/' . $value->id }}"
                                                     class="btn btn-xs btn-success " id="view_btn"> View</a>
                                                 <a class="btn btn-xs btn-warning " id="view_btn"> Contact</a>

                                                 <a class="btn btn-xs btn-info " id="view_btn"> More info</a>


                                             </td>
                                         </tr>
                                         <?php

}
                                         }
?>
                                         <?php
                                         if(isset($client_users)){

foreach ($client_users as $value) {
    //   dd($value)
    ?>
                                         <tr>

                                             <td><input type="checkbox" class="checkboxes" value="<?= $value->id ?>" />
                                             </td>
                                             <td style="align:center;text-align: center;">
                                                 @if (isset($value->image) && $value->image != '')
                                                     <img src="{{ url('images/affiliates/' . $value->image) }}"
                                                         width="80" height="80"
                                                         style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;">
                                                     <br>
                                                 @endif
                                                 <?= $value->first_name . ' ' . $value->last_name ?>
                                             </td>
                                             <td><?= date('d F', strtotime($value->dob)) ?></td>

                                             <td><?= (isset($value->birth_state) ? $value->birth_state : isset($value->birth_commune)) ? showcommuneName($value->birth_commune) : '' ?>
                                             </td>
                                             <td><?= isset($value->country) ? getCountryName($value->country) : '' ?>

                                             </td>
                                             <td><?= $value->city ?></td>
                                             <td><?= getBusinessName($value->email) ?></td>
                                             <td width="20%">

                                                 <a href="{{ url('user_birthplace') . '/' . $value->id }}"
                                                     class="btn btn-xs btn-success " id="view_btn"> View</a>
                                                 <a class="btn btn-xs btn-warning " id="view_btn"> Contact</a>

                                                 <a class="btn btn-xs btn-info " id="view_btn"> More info</a>


                                             </td>
                                         </tr>
                                         <?php

}
                                         }
?>
                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
     </section>
     <script type="text/javascript">
         $(document).ready(function() {
             $(".group-checkable").change(function() {
                 if ($(this).prop('checked')) {
                     var boxes = $('.checkboxes:not(:checked)');
                     boxes.each(function() {
                         $(this).prop('checked', false);
                         $(this).trigger('click');
                     });
                 } else {
                     $('.checkboxes').prop('checked', true);

                     $('.checkboxes').trigger('click');
                 }
             });
         });
     </script>
 @endsection
