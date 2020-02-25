<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = ['title', 'description', 'link', 'guid', 'author', 'pub_time', 'feeds_id'];
}
