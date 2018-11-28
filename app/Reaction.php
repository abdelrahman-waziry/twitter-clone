<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tweet_id', 'user_id',
    ];
}
