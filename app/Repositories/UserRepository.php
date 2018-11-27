<?php

namespace App\Repositories;

use App\User;
use App\Tweet;

class UserRepository
{

    private $model;

    /**
     * Sets Repository model to App\User
     * @return void
     */
    public function __construct()
    {
        $this->model = new User();
    }


    public function userByName(string $username){
        return $this->model->where('username', $username)->first();
    }

    public function tweetsByUser(int $id)
    {
        return Tweet::where('user_id', $id)->orderBy('created_at', 'DESCT')->get();
    }
}
