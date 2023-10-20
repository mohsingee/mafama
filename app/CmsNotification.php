<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsNotification extends Model
{
    protected $fillable = [
        'action_id', 'message',
    ];
}
