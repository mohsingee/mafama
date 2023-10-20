@extends('layouts.admin') 
@section('content')

<style>
  
.borderless tr td, .borderless tr th {
    
    text-align: left;
    
}
</style>

<link href="{{ asset('public/genealogy/tree_new.css') }}" rel="stylesheet">
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Team Network</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
							
								 <div class="row">
                            <div class="col-md-12">
                                <table style="width:100%">
                                    <tr>
                                        <td width="20%" class="ntest1 back-to-home" style="display:none">
                                            <a href="javascript:void(0);" class="back-btn-c1 ntest return-btn" onclick="return get_child(<?=Auth::user()->id;?>,<?=Auth::user()->id;?>)" ><i class="fa fa-angle-left btn-g"></i> Back </a>
                                        <span ></span>
                                        </td>
                                        <td width="20%" class="ntest1">
                                            <a href="javascript:void(0);" class="back-btn-c1 ntest" onclick="return get_child(<?=Auth::user()->id;?>,<?=Auth::user()->id;?>)" ><i class="fa fa-home btn-g"></i> Home </a>
                                        
                                        </td>
                                        <td width="20%" align="left"><span class="ntest">Jump to user</span>  </td>
                                        <td width="20%"><input type="text" class="form-control" id="sponserid" placeholder="Insert User Id"></td>
                                        <td>
                                             <button class="bbn" id="SearchID"><i class="fa fa-search btn-g"></i></button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                          
                        </div>
                        
                         <div class="row">
                      
                        
                         <div class="col-sm-12"  >
                              
                            <hr>
                             <div class="pan-container" >
                              <ul class="tree" id="genealogy_id">
                                           @if(!empty($networks)) 
                                           {!! $networks !!}
                                            @endif 
                                        
                                  </ul>
                               <div class="clearfix"></div>
                            </div>
                            
                        
                         </div>
                        </div> 
                        
                        
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection