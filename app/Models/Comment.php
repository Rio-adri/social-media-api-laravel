<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    //
    protected $table = "comments";

    use SoftDeletes;

    protected $fillable = [
        'post_id',
        'user_id',
        'comment_text',
    ];
}
