<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tweet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'user_id',
    ];

    protected $appends = ['likes', 'subject', 'liked'];

    public function reactions()
    {
        return $this->hasMany('App\Reaction', 'tweet_id' ,'id');
    }

    public function subject()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getLikesAttribute()
    {
        $likes = $this->reactions()->whereNull('deleted_at')->count();
        return $likes;
    }

    public function getSubjectAttribute()
    {
        $subject = $this->subject()->first();
        return $subject;
    }

    public function getLikedAttribute(){
        $payload = [
            'user_id' => Auth::user()->id,
            'tweet_id' => $this->id,
        ];

        $liked = $this->reactions()->whereNull('deleted_at')->where($payload)->first();
        return $liked ? true : false;
    }
}
