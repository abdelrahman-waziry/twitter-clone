<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'username', 'avatar'
    ];

    protected $appends = ['followed'];

    public function followed()
    {
        return $this->hasMany('App\FollowUser', 'following', 'id');
    }

    public function getFollowedAttribute()
    {
        $payload = [
            'follower' => Auth::user()->id,
            'following' => $this->id,
        ];

        $isFollowed = $this->followed()->where($payload)->first();
        return $isFollowed ? true : false;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
