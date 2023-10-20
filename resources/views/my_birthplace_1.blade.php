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

     /*#blahh {
        border: 2px solid white;
        padding: 2px;
        border-radius: 12px;
        margin: 10px;
    }*/
     /*.modal-body #blah {
        width: 70px !important;
        height: 70px !important;
        border: 2px solid;
        padding: 2px;
        border-radius: 12px;
    }
    @media only screen and (max-width: 600px) {
        #blahh {
            width: 70px;
            height: 70px;
            border: 2px solid;
            padding: 2px;
            border-radius: 12px;
        }
    }*/
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
     <style>
         /* .carousel-indicators li {
                                                                                                                                                                                                                                                                                                                                                                                                                         border: 1px solid #da291c;
                                                                                                                                                                                                                                                                                                                                                                                                                     } */
     </style>

     <!-- -->
     <section>
         <div class="container">
             <div class="row">
                 <!-- tabs -->


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
                             style="border: 1px solid #da291c !important; border-radius: 10px; margin-top:10px; padding-top: 30px; padding-bottom: 20px;">
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="owl-carousel nomargin"
                                         data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": 3000, "pagination": false}'
                                         style="padding: 0 5px;">
                                         <?php
                                         if(count($user_birthplace_banner_info)==0){
                                          ?> <p>No record found</p>
                                         <?php }else{
                                                    foreach ($user_birthplace_banner_info as $value) {
                                                     ?>
                                         <div>
                                             <h2 class="text-center">{{ $value->title }}</h2>
                                             <img class="img-responsive" src="{{ $value->file_url }}" width="100%"
                                                 height="100%">
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

                                 <div class="col-md-6" style="border-left: 1px solid #da291c !important; ">
                                     <div class="owl-carousel nomargin"
                                         data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": 3000, "pagination": false}'
                                         style="padding: 0 5px;">
                                         <?php
                                          if(count($user_birthplace_video_info)==0){
                                            ?> <p>No record found</p>
                                         <?php }else{
                                                foreach ($user_birthplace_video_info as $value) {
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


                                 <div class="col-md-12 text-center" style="border-top: 1px solid #da291c !important; ">
                                     <br>
                                     <?= isset($user_birthplace_text->description) ? $user_birthplace_text->description : '' ?>
                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>
     </section>
 @endsection
