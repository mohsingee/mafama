<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadFinancialTemplate extends Model
{
    protected $fillable = [
        'category', 'image', 'description',
    ];
}
