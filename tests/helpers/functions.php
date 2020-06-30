<?php

use App\Models\Post;

function createPost($attributes = [])
{
    return factory(Post::class)->create($attributes);
}
