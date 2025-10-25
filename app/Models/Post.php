<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    protected $table = 'posts';

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'content',
        'image_url',
    ];
}
