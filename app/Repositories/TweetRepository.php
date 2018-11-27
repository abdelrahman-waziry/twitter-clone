<?php

namespace App\Repositories;

use App\Tweet;
use Illuminate\Support\Facades\Auth;

class TweetRepository
{

    protected $model;

    /**
     * Sets Repository model to App\User
     * @return void
     */
    public function __construct()
    {
        $this->model = new Tweet();
    }

    /**
     * Returns all tweets ordered descendingly by created_at
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    public function paginate(int $count = 15)
    {
        return $this->model->select($payload)->paginate($count);
    }

    public function findTweet(int $id)
    {
        return $this->model->$select($payload)->findOrFail($id);
    }

    /**
     *
     */
    public function storeTweet($request)
    {
        $tweet = $this->model->create([
            'body' => $request->input('body'),
            'user_id' => Auth::user()->id,
        ]);

        return $tweet;
    }

}
