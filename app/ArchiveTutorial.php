<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveTutorial extends Model
{
    protected $fillable = [
        'video', 'name',
    ];
}
