<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    protected $appends = ['likes', 'subject'];

    public function reaction()
    {
        return $this->belongsTo('App\Reaction', 'id');
    }

    public function subject()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getLikesAttribute()
    {
        $likes = $this->reaction()->count();
        return $likes;
    }

    public function getSubjectAttribute()
    {
        $subject = $this->subject()->first();
        return $subject;
    }
}
