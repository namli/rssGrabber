<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feeds extends Model
{
    protected $fillable = ['url_rss', 'name', 'url', 'description', 'pub_time'];
}
