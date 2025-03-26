<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsEmail extends Model
{
    protected $table = 'news_email';
    protected $fillable = ['email'];
}
