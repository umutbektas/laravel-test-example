<?php

namespace App\Models;

use App\Traits\Likeability;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Likeability;


    protected $fillable =  [
        'user_id', 'title', 'body'
    ];

}
