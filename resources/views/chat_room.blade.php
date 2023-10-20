@extends('layouts.admin') 
@section('content')
<style type="text/css">
        .imageThumb {
  max-height: 40px;
  border: 1px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}

.chat-msg-reply {
    background: #dddddd73;
    font-size: 12px;
    padding: 2px;
}
</style>

<div class="nk-content p-0">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-chat">
                <div class="nk-chat-aside">
                    <div class="nk-chat-aside-head">
                        <div class="nk-chat-aside-user" style="width:100%;">
                            <div class="dropdown">
                                <a href="#" >
                                    <!--<div class="user-avatar">
                                        <img src="./images/avatar/b-sm.jpg') }}" alt="">
                                    </div>-->
                                    <div class="title">Chat Room</div>
                                </a>
                                
                            </div>
							 <div class="dropdown" style="float:right;margin-top:10px;display: none;">
								<a href="#" class="btn btn-icon btn-sm dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h" style="color:#fff;"></em></a>
								<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="link-list-opt">
										<li>
											<div class="custom-control custom-control-sm custom-radio" style="padding-left:30px;">
												<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
												<label class="custom-control-label" for="customRadio1">Active</label>
											</div>
										</li>
										<li>
											<div class="custom-control custom-control-sm custom-radio" style="padding-left:30px;">
												<input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
												<label class="custom-control-label" for="customRadio2">Away</label>
										</li>
										<li>
											<div class="custom-control custom-control-sm custom-radio" style="padding-left:30px;">
												<input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
												<label class="custom-control-label" for="customRadio3">Invisible</label>
											</div>
										</li>
										<li>
											<div class="custom-control custom-control-sm custom-radio" style="padding-left:30px;">
												<input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
												<label class="custom-control-label" for="customRadio4">Do not disturb</label>
											</div>
										</li>
										
									</ul>
								</div>
							</div>
                        </div><!-- .nk-chat-aside-user -->
                        
                    </div><!-- .nk-chat-aside-head -->
             <form method="post" id="manageadminchatform" enctype="multipart/form-data">
                 @csrf
                    <div class="nk-chat-aside-body" data-simplebar >

                   <input type="hidden" name="user_checked" id="user_checked">
                        <!-- <div class="col-md-12" style="margin-top:10px;">
						<a href="" class="btn btn-primary btn-xs" style="float:right;">View All</a>
						<a href="" class="btn btn-primary btn-xs" style="float:right;margin-right:10px;">Selected View</a>
                        </div> -->
						<div class="clearfix"></div>
                        <div class="nk-chat-list">
                            <div class="row" style="margin-top:20px;">
								<div class="col-md-4" style="padding:0px; padding-top:10px; padding-left:20px;">

								<input type="checkbox" id="selectAll" value="1">
								<label> Select All</label>
								</div>
								<div class="col-md-8" style="padding:0px;">
								<div class="nk-chat-aside-search" style="padding-right: 1rem;">
									<div class="form-group">
										<div class="form-control-wrap">
											<div class="form-icon form-icon-left">
												<em class="icon ni ni-search"></em>
											</div>
											<input type="text" class="form-control form-round" id="default-03" placeholder="Search by name" onkeyup="search_user(this.value)" >
										</div>
									</div>
								</div><!-- .nk-chat-aside-search -->
								</div>
								
							</div>
							<h6  class="title overline-title-alt">Messages</h6>
                            <ul class="chat-list">
                                <!---
                                <li class="chat-item">
                                    <a class="chat-link chat-open current" href="#">
                                        <div style="margin-right:10px;">
											<input type="checkbox" id="" name="" value="">
										</div>
										<div class="chat-media user-avatar">
                                            <img src="{{ asset('public/assets/images/demo/people/300x300/11-min.jpg') }}" style="width:100%;">
                                            <span class="status dot dot-lg dot-gray"></span>
                                        </div>
                                        <div class="chat-info">
                                            
											<div class="chat-from">
                                                <div class="name">Iliash Hossain</div>
                                                 <span class="time">12 Mar</span>
                                            </div>
                                            <div class="chat-context">
                                                <div class="text">You: Please confrim if you got my last messages.</div>
                                                <div class="status delivered">
                                                    <em class="icon ni ni-check-circle-fill"></em>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="chat-actions">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#">Delete Conversion</a></li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                 -->


                            </ul><!-- .chat-list -->
                        </div><!-- .nk-chat-list -->
                    </div>
                </div><!-- .nk-chat-aside -->
                <div class="nk-chat-body profile-shown">

                    <div class="nk-chat-head" style="display:block;padding:0px;">
                        <div class="col-md-12" style="padding: 1rem 1.75rem;">

                            <ul class="nk-chat-head-info">
                    <li class="nk-chat-body-close">
                        <a href="javascript:void(0)" class="btn btn-icon btn-trigger nk-chat-hide ml-n1"><em class="icon ni ni-arrow-left"></em></a>
                    </li>
                    <li class="nk-chat-head-user">
                        <div class="user-card">
                            <div class="user-avatar bg-purple">
                                <span><?=\App\Chat::short_name(Auth::user()->name);?></span>
                            </div>
                            <div class="user-info">
                                <div class="lead-text" style="color: #fff;"><?=Auth::user()->name;?></div>
                                <div class="sub-text">
                                    <span class="d-none d-sm-inline mr-1">Active </span>
                                     </div>
                            </div>
                        </div>
                    </li>
                </ul>
						</div>
						
						<div class="col-md-12" style="padding:0px;">
							<!-- <img src="{{ asset('public/images/maxresdefault.jpg') }}" style="width:100%;height:102px;"> -->
                             @if(!empty($banner))
                                <img  src="{{ asset('public/videos/'.$banner->img) }}" style="width: 100%; height: 102px;" >
                                @endif
						</div>

                        <!--<ul class="nk-chat-head-tools">
                            <li><a href="#" class="btn btn-icon btn-trigger text-primary"><em class="icon ni ni-call-fill"></em></a></li>
                            <li><a href="#" class="btn btn-icon btn-trigger text-primary"><em class="icon ni ni-video-fill"></em></a></li>
                            <li class="d-none d-sm-block">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger text-primary" data-toggle="dropdown"><em class="icon ni ni-setting-fill"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a class="dropdown-item" href="#"><em class="icon ni ni-archive"></em><span>Make as Archive</span></a></li>
                                            <li><a class="dropdown-item" href="#"><em class="icon ni ni-cross-c"></em><span>Remove Conversion</span></a></li>
                                            <li><a class="dropdown-item" href="#"><em class="icon ni ni-setting"></em><span>More Options</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="mr-n1 mr-md-n2"><a href="#" class="btn btn-icon btn-trigger text-primary chat-profile-toggle"><em class="icon ni ni-alert-circle-fill"></em></a></li>
                        </ul>-->
                        <!--<div class="nk-chat-head-search">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-search"></em>
                                    </div>
                                    <input type="text" class="form-control form-round" id="chat-search" placeholder="Search in Conversation">
                                </div>
                            </div>
                        </div>--><!-- .nk-chat-head-search -->
                    </div><!-- .nk-chat-head -->
                    <div class="nk-chat-panel chat_history"  id="chat_history" data-simplebar>

                            </div>
                   <!-- .nk-chat-panel -->
                   <!--
                    <div class="nk-chat-editor">
                        
                        <div class="nk-chat-editor-form">
                            <div class="form-control-wrap">
                                <textarea class="form-control" rows="1" id="default-textarea" placeholder="Type your message..." style="padding-left:10px;padding-right:10px;"></textarea>
								<div class="" style="padding-top:10px;">
									<ul class="" style="float:right; display:flex;">
										<li style="margin-right:10px;"><a href="javascript:void(0);" onclick="$('input[id=my_file]').click();"><em  style="font-size:20px;"  class="icon ni ni-img-fill"></em></a>
										<input type="file" id="my_file" style="display: none;" /></li>
										<li style="margin-right:10px;"><a href="javascript:void(0);" onclick="$('input[id=my_file1]').click();"><em  style="font-size:20px;" class="icon ni ni-camera-fill"></em></a><input type="file" id="my_file1" style="display: none;" /></li>
										<li style="margin-right:10px;"><a href="#"><em  style="font-size:20px;" class="icon ni ni-mic"></em></a></li>
										<li style="margin-right:10px;"><a href="#"><em   style="font-size:20px;" class="icon ni ni-grid-sq"></em></a></li>
									</ul>
								</div>
                            </div>
							
                        </div>
                        <ul class="nk-chat-editor-tools g-2" style="margin-top: -40px !important;" >
                            
							<li>
								<button class="btn btn-round btn-primary btn-icon"><em class="icon ni ni-send-alt"></em></button>
							</li>
						</ul>
						
						
                    </div>-->
					<div class="nk-chat-editor">
                                <div class="nk-chat-editor-form">
                                    <div class="form-control-wrap">
                                       <!--  <textarea class="form-control form-control-simple no-resize write_msg" rows="1" name="chat_message" id="default-textarea" placeholder="Type your message..." style="padding-left: 10px; padding-right: 10px;"></textarea> -->
                                       <div id="reply-msg"></div>
                                        <div id="chat_message" contenteditable="true" class="form-control form-control-simple no-resize write_msg" style="padding-left: 10px; padding-right: 10px;">
                                         </div>
                                        <div class="attach-sec" style="padding-top: 10px;">
                                            <ul class="" style="float: right; display: flex; list-style: none;">
                                                <li style="margin-right: 10px;">
                                                    <a href="javascript:void(0);" title="Upload Photo" onclick="$('input[id=my_file]').click();"><i style="font-size: 18px;" class="fa fa-image "></i></a> <input type="file" id="my_file" name="file" style="display: none;" accept="image/*" />
                                                </li>
                                               <li style="margin-right: 10px;">
                                                    <a href="javascript:void(0);" title="Upload Video" onclick="$('input[id=my_file1]').click();"><i style="font-size: 18px;" class="fa fa-camera "></i></a><input type="file" id="my_file1" name="video_link" style="display: none;" accept="video/*" />
                                                </li>
                                                <!-- <li style="margin-right: 10px;">
                                                    <a href="#"><i style="font-size: 18px;" class="fa fa-microphone"></i></a>
                                                </li>
                                                <li style="margin-right: 10px;">
                                                    <a href="#"><em style="font-size: 18px;" class="fa fa-arrows-alt"></em></a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                 <input type="hidden" name="to_user_id" id="to_user_id" >
                                 <input type="hidden" name="msg_id" id="msg_id" >
                                 <input type="hidden" name="reply_uid" id="reply_uid" >
                                <ul class="nk-chat-editor-tools g-2 " style="margin-top: -30px !important; list-style: none;">
                                    <li>
                                        <button type="submit" class="btn btn-round btn-blue btn-icon"><i class="fa fa-send-o"></i></button>
                                    </li>
                                </ul>

                            </div>
					</form>
					<div class="nk-chat-profile visible" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                        <div class="nk-chat-aside-head" >
							<div class="nk-chat-aside-user" style="height:50px;">
								
							</div>
							
						</div>
						<div class="user-card user-card-s2" >
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn btn-sm btn-info margin-right-10
                                                            videos-btn">Videos</button>
                                                            <button type="button" class="btn btn-sm btn-info margin-right-10 attachments-btn">Attachments</button>
                                                            <br/>
                                                            <br/>
                                                            <div class="videos-attachments" style="overflow-y: scroll;height: 400px;">
                                                                <div  class="col-md-12" id="videos" class="videos">
                                                                    @forelse($videos as $values1)
                                                                    <div>
                                                                        @if($values->video_link!='')
                                                                        <video width="150" height="150" controls><source src="{{asset('public/videos/'.$values1->video_link)}}" type="video/mp4"></video><br />
                                                                        @endif
                                                                    </div><br />
                                                                    @empty
                                                                        <div>No attachments found!</div>
                                                                    @endforelse

                                                                </div>
                                                                <div  class="col-md-12" id="attachments"  class="attachments">
                                                                    @forelse($attachments as $values)
                                                                    <div>
                                                                        @if($values->attachment!='')
                                                                        <img src="{{asset('public/images/'.$values->attachment)}}" class="img-thumbnail" width="150" height="150" /><br />
                                                                        @endif
                                                                    </div><br />
                                                                    @empty
                                                                        <div>No videos found!</div>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                        
                    </div></div></div></div><div class="simplebar-placeholder" style="width: 324px; height: 749px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 93px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
					
					
                    
                </div><!-- .nk-chat-body -->
            </div><!-- .nk-chat -->
        </div>
    </div>
</div>


@include('chat.chatroom_script')

@endsection