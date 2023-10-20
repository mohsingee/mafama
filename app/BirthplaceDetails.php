<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BirthplaceDetails extends Model
{
    protected $fillable = [
        'uid', 'uploaded_by', 'title', 'file_url', 'upload_type', 'description', 'dated',
    ];

}