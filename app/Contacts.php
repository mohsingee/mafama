<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'telephone', 'email', 'folder', 'uid', 'image','from_lead','status',
    ];
}
