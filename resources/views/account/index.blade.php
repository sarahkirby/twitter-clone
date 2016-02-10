@extends('master')

@section('title', 'Account')
@section('meta-description', 'Welcome to your account page')

@section('content')
{{-- ]Auth::user - when you know user is logged in. \blackslash - go to the root folder and start looking from there --}}
<h1>Hi there {{ \Auth::user()->name }}</h1>


@endsection