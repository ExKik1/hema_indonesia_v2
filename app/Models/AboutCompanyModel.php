<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutCompanyModel extends Model
{
    protected $table = 'about_company';
    protected $fillable = [
        'name',
        'logo',
        'breadcrumb',
        'about_description_company',
        'about_img_company',
        'instagram',
        'tiktok',
        'facebook',
        'youtube',
    ];
}
