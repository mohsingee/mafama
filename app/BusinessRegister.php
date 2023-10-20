<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessRegister extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'religion', 'email', 'password', 'cellphone', 'business_telephone', 'business_category', 'image', 'address', 'zip_code', 'city', 'state', 'country',
    ];
}
