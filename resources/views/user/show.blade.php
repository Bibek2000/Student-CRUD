@extends('layouts.app1')
@section('title','Profile View')

@section('content')

    <style>
        .profile{
            width: 90%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            font-family: "Big Caslon";
            text-align: center;
        }
        .title{
            color: #2d3748;
        }
    </style>

    <div class="profile">
        <h1 class="title">ADMIN PROFILE</h1>
        <p>Name: {{auth::user()->name}}</p>
        <p>Email: {{auth::user()->email}}</p>

        <div>
            <a href="{{route('profile.edit')}}"class="btn btn-outline-primary">Edit Profile<i class="fa fa-edit"></i></a>
            <a href="{{route('password.change')}}"class="btn btn-outline-danger">Change Password</a>


        </div>
    </div>

@endsection
