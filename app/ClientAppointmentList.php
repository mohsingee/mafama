<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientAppointmentList extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'address', 'zip_code', 'city',
        'state', 'country', 'dob', 'home_phone', 'work_phone', 'cell_phone',
        'password', 'company', 'comment', 'religion', 'category1', 'category2', 'uid', 'image',
        'birth_address',
        'birth_zip_code', 'birth_city', 'birth_state', 'birth_country',
        'birth_commune',
    ];
}