@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('components.input')
                    <div class="tweets">
                        <div class="row clonable-tweet">
                            <div class="col-md-12 panel">
                                <div class="panel-heading">
                                    <a href="">
                                        <img src="" alt="avatar">
                                        <div class="user-info">
                                            <h5></h5>
                                            <h6></h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="panel-body">
                                    <p></p>
                                </div>
                                <div class="panel-footer">
                                    <button class="btn">
                                        <i class="fas fa-heart"></i>
                                        
                                    </button>
                                </div>
                            </div>
                        </div>
                        @foreach ($tweets as $tweet)
                            <div class="row tweet">
                                <div class="col-md-12 panel">
                                    <div class="panel-heading">
                                        <a href={{'user/' . $tweet->subject->username}}>
                                            <img src={{$tweet->subject->avatar}} alt="avatar">
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
                                        <button class="btn">
                                            <i class="fas fa-heart"></i>
                                            {{$tweet->likes}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
