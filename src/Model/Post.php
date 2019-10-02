<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}