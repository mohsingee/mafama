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
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <form id="" action="{{ url('terms_conditions_update') }}" method="POST" enctype="multipart/form-data">	
									@csrf
                                    <input type="hidden" name="id" value="<?= $terms[0]->id ?>">
                                    <div class="row gy-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">User Type</label>
                                                <select class="form-control" name="user_type">
                                                    <option value="vip" <?php if($terms[0]->user_type == "vip"){ ?> selected <?php } ?>>VIP User</option>
                                                    <option value="business" <?php if($terms[0]->user_type == "business"){ ?> selected <?php } ?>>Business User</option>
                                                    <option value="affilate" <?php if($terms[0]->user_type == "affilate"){ ?> selected <?php } ?>>Affilate User</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Terms & conditions</label>
                                                <textarea class="form-control" placeholder="" name="description" required="required"><?= $terms[0]->description ?></textarea>
                                            </div>
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

@endsection