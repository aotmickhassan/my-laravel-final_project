@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="content-layout">
    {{-- <h2 class="m-3 p-2" style="text-align: center">Teachers Table</h2> --}}
    <div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-between mb-2">
        <p class="m-0" style="font-weight: 600; font-size: 20px;">Teachers Update</p>
        {{-- <a href="{{ route('teacher.create') }}" class="btn btn-sm btn-outline-success ">Add Teacher</a> --}}
    </div>

    {{-- MAIN-SECTION-PARTS --}}
    <div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="container mt-5 box1">
        <form action="{{ route('teacher.update', ['teacher' =>$teacher]) }}" method="POST">
            @csrf
            @method('put')

            <!-- Name Input -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $teacher->name }}" >
            </div>

            <!-- Designation Input -->
            <div class="form-group">
                <label for="designation">Designation:</label>
                <input type="text" class="form-control" id="designation" name="designation" value="{{ $teacher->designation }}" >
            </div>

            <!-- Mobile No Input -->
            <div class="form-group">
                <label for="mobile">Mobile No:</label>
                <input type="mobile" maxlength="11" class="form-control p-input" id="mobile" name="mobile" value="{{$teacher->mobile }}">
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $teacher->email }}" >
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    {{-- MAIN-SECTION-PARTS --}}

</div>
@endsection
























{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Teacher</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-center">Update Teacher Information</h1>
    <div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="container mt-5 box1">
        <form action="{{ route('teacher.update', ['teacher' =>$teacher]) }}" method="POST">
            @csrf
            @method('put')

            <!-- Name Input -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $teacher->name }}" >
            </div>

            <!-- Designation Input -->
            <div class="form-group">
                <label for="designation">Designation:</label>
                <input type="text" class="form-control" id="designation" name="designation" value="{{ $teacher->designation }}" >
            </div>

            <!-- Mobile No Input -->
            <div class="form-group">
                <label for="mobile">Mobile No:</label>
                <input type="mobile" maxlength="11" class="form-control p-input" id="mobile" name="mobile" value="{{$teacher->mobile }}">
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $teacher->email }}" >
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> --}}
