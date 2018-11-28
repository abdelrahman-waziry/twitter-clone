<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->users = new UserRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show(string $username)
    {
        $user = $this->users->userByName($username);
        $tweets = $this->users->tweetsByUser($user->id);   
        
        $data = [
            'user' => $user,
            'tweets' => $tweets
        ];
        

        return view('profile', $data);
    }

    /**
     * Follow a user
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request)
    {   
        return response()->json($this->users->followUser($request), 201);
    }
}
