@extends('layouts.admin') 
@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content" style="margin-bottom: 20px;">
                    <h3 class="nk-block-title page-title">Terms & Conditions</h3>
                </div>
                <!-- .nk-block-head-content -->
                @if(permission_access('terms_conditions_add')==1)
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <form id="" action="{{ url('terms_conditions_entry') }}" method="POST" enctype="multipart/form-data">	
									@csrf
                                    <div class="row gy-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">User Type</label>
                                                <select class="form-control" name="user_type">
                                                    <option value="vip">VIP User</option>
                                                    <option value="business">Business User</option>
                                                    <option value="affilate">Affilate User</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Terms & conditions</label>
                                                <textarea class="form-control" placeholder="" name="description" required="required"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <input type="submit" class="btn btn-sm btn-primary" value="Save">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="col-md-12"></div>
                            <div class="card-inner">
                                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col"><span class="sub-text">Id</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">User Type</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">Content</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
											$i = 1;
						                  	foreach ($terms as $term) {
						                ?>
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col">
                                                <span><?= $i ?></span>
                                            </td>
                                            <td class="nk-tb-col">
                                            	<?php 
                                            		if($term->user_type == "vip"){ 
                                            			$user_type = "VIP User";
                                            		}
                                            		if($term->user_type == "business"){ 
                                            			$user_type = "Business User";
                                            		}
                                            		if($term->user_type == "affilate"){ 
                                            			$user_type = "Affilate User";
                                            		}
                                            	?>
                                                <span><?= $user_type ?></span>
                                            </td>
                                            <td class="nk-tb-col">
                                                <?= $term->description ?>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                @if(permission_access('terms_conditions_edit')==1)
                                                <a href="<?php echo url('editterms_condition') ?>/<?= $term->id ?>" class="btn btn-sm btn-success">Edit</a>
                                                @endif
                                                @if(permission_access('terms_conditions_delete')==1)
                                                <a href="<?php echo url('deleteterms_condition') ?>/<?= $term->id ?>" class="btn btn-sm btn-danger">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php 
											$i++;
											} 
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- .card -->
                </div>
                <!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@endsection