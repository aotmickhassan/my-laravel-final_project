@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <h1>Welcome, {{Auth::user()->name.', Role: '.Auth::user()->role}}</h1>
    <p></p>
@endsection
