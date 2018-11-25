<?php

namespace App\Repositories;

use App\Tweet;

class TweetRepository
{

    private $payload = ['id', 'body', 'author'];

    public function __consturct()
    {
        $this->model = new Tweet;
    }

    public function paginate(int $count = 15)
    {
        return $this->model->select($payload)->paginate($count);
    }

    public function findTweet(int $id)
    {
        $tweet = $this->model->$select($payload)->findOrFail($id);
    }
}
