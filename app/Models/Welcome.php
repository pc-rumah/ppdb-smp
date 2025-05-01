<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Welcome extends Model
{
    protected $fillable = [
        'title1',
        'description1',
        'image1',
        'title2',
        'description2',
        'image2',
        'title3',
        'description3',
        'image3',
        'about_description',
        'about_image',
        'address',
        'phone',
        'email',
        'facebook',
        'instagram',
        'youtube'
    ];
}
