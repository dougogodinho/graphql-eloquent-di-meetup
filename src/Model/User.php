<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = [];
    protected $casts = ['address' => 'array'];
    protected $dates = ['birthday'];

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'user_id', 'followed_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}