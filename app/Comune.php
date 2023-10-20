<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comune extends Model
{
    protected $fillable = [
        'commune', 'abbreviation', 'arrondissement_id'
    ];


}
