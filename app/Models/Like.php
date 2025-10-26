<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    //
    protected $table = 'likes';

    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
