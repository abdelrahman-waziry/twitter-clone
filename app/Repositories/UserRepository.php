<?php

namespace App\Repositories;

use App\User;
use App\Tweet;
use App\FollowUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function followUser($request)
    {

        $user = $this->model->where('username', $request->input('username'))->first();

        $payload = [
            'follower' => Auth::user()->id,
            'following' => $user->id,
        ];

        if($user->followed){
            $follow = FollowUser::where($payload)->update(['deleted_at' => Carbon::now()]);
        }
        else {
            $follow = FollowUser::firstOrCreate($payload);
            $follow->deleted_at = null;
            $follow->save();
        }

        return $follow;
    }
}
