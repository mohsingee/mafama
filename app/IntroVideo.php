<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntroVideo extends Model
{
    protected $fillable = [
        'video','title', 'register_link','clock_duration','page_content','top_heading','heading','sub_heading','link_text','title_bar','bottom_banner'
    ];
}
