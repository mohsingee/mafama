<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionAccess extends Model
{
    //

     protected $fillable = [
        'admin_role','permission','status'

    ];
}
