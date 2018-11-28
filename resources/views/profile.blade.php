<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body profile-header">
                    <div class="text-center">    
                        <img src={{$user->avatar ?: 'https://via.placeholder.com/150'}} alt="avatar">
                        <h4>{{$user->name}}</h4>
                        <p>@ {{$user->username}}</p>
                        @if (Auth::user()->id != $user->id)
                        <button username="{{$user->username}}" class="btn btn-primary follow-btn">
                            {{$user->followed ? 'Following' : 'Follow'}}
                        </button>
                        @endif
                    </div>
                    <div class="tweets">
                        @if ($tweets->count() > 0)
                        @foreach ($tweets as $tweet)
                        <div class="row tweet">
                                <div class="col-md-12 panel">
                                    <div class="panel-heading">
                                        <a href={{'/user/' . $tweet->subject->username}}>
                                            <img src={{$tweet->subject->avatar ?: 'https://via.placeholder.com/150'}} alt="avatar">
                                            <div class="user-info">
                                                <h5>{{$tweet->subject->name}}</h5>
                                                <h6>@ {{$tweet->subject->username}}</h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="panel-body">
                                        <p>{{$tweet->body}}</p>
                                    </div>
                                    <div class="panel-footer">
                                        <button liked="{{$tweet->liked}}" tweet-id="{{$tweet->id}}" class="{{$tweet->liked ? 'btn like-btn liked' : 'btn like-btn'}}">
                                            <i class="fas fa-heart"></i>
                                            <p>{{$tweet->likes}}</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <div class="col-md-12 panel text-center">
                            <div class="panel-heading">
                                {{$user->name}} has not tweeted yet.
                            </div>
                        </div>
                        @endif
                </div> 
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/networkHandler.js') }}"></script>
</body>
</html>