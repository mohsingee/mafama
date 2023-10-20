@extends('layouts.admin')
@section('content')
<!--<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>-->
<!--<link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />-->

     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  

<style>

.borderless tr td, .borderless tr th {

    text-align: left;

}
h6.nk-block-title.page-title {
    font-size: 16px;
}
.borderless tr td, .borderless tr th {
    padding-bottom: 0px!important;
    padding-top: 8px !important;
}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Introduction Video Setting</h3>

				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">


              <form id="" action="{{ url('intro_video_update', $code) }}" method="POST" enctype="multipart/form-data">
									@csrf
									<input type="hidden" name="id" value="<?= $video->id ?>">
									<div class="row gy-4">

											<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Top Heading</label>
												<input type="text" class="form-control" name="top_heading" required value="<?= $video->top_heading ?>" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Heading</label>
												<input type="text" class="form-control" name="heading" required value="<?= $video->heading ?>" />
											</div>
										</div>
											<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Sub Heading</label>
												<input type="text" class="form-control" name="sub_heading" required value="<?= $video->sub_heading ?>" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Video</label>
												<div class="form-control-wrap">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="customFile" name="video">
														<label class="custom-file-label" for="customFile">Choose file</label>
													</div>
												</div>

											</div>
											<video controls id="videoblah" style="height: 200px;">
												  	<source src="<?php echo asset("public/videos/intro") ?>/<?= $video->video ?>" type="video/mp4" id="blah">
												</video>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Clock Time Duration (in minutes)</label>
												<input type="text" class="form-control" name="clock_duration" required value="<?= $video->clock_duration ?>" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Title</label>
												<input type="text" class="form-control" name="title" required value="<?= $video->title ?>" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Registration Page Link</label>
												<input type="text" class="form-control" name="register_link" required value="<?= $video->register_link ?>" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Registration Page Button Text</label>
												<input type="text" class="form-control" name="link_text" required value="<?= $video->link_text ?>" />
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Bar title</label>
												<input type="text" class="form-control" name="title_bar" required value="<?= $video->title_bar ?>" />
											</div>
										</div>
										 <div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Page Content</label>

												<textarea name="page_content" class="editor1" id="summernote" rows="10">{{$video->page_content}}</textarea>
											</div>
										</div>
										
											<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Bottom Banner Image</label>
												<input type="file" class="form-control" name="bottom_banner"   />
											</div>
											<br>
												<img src="<?php echo asset("public/videos/intro") ?>/<?= $video->bottom_banner ?>">
										</div>

										<div class="col-12">
											<input type="submit" class="btn btn-sm btn-primary" value="Update">
										</div>
									</div>
								</form>
 
   

							</div>
						</div>
					</div>
				</div>



			</div>
		</div>
	</div>
</div>

<!--<script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>-->

<!--<script type="text/javascript">-->
<!--config.extraPlugins = "{{ asset('public/admin_assets/colorbutton')}}";-->

<!--	 CKEDITOR.replace('page_content');-->

<!--</script>-->
 <script>
      $('#summernote').summernote({
      
        tabsize: 2,
        height: 400,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
@endsection