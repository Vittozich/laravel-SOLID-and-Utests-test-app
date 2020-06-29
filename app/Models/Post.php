<?php

namespace App\Models;

use App\Models\Traits\LikeabilityTrait;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use LikeabilityTrait;

    protected $fillable = [
        'user_id',
        'title',
        'body'
    ];

}
