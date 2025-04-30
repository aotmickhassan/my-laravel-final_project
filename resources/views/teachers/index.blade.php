@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="table-layout">
    {{-- <h2 class="m-3 p-2" style="text-align: center">Teachers Table</h2> --}}
    <div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-between mb-2">
        <p class="m-0" style="font-weight: 600; font-size: 20px;">Teachers</p>
        <a href="{{ route('teacher.create') }}" class="btn btn-sm btn-outline-success ">Add Teacher</a>
    </div>

    <table class="table table-bordered p-2">
        <thead>
            <tr class="m-3 p-2" style="text-align: center">
                <th>ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="m-3 p-2">
            @foreach($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->id }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->designation }}</td>
                    <td>{{ $teacher->mobile }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>
                        <a href="{{ route('teacher.edit', ['teacher'=>$teacher]) }}" class="btn btn-primary">Update</a>
                    </td>
                    <td>
                        <form action="{{ route('teacher.destroy', ['teacher'=>$teacher]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection





{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Index</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Include the style here -->
<style>
    a:hover {
        background-color: rgb(234, 83, 153) !important;
    }
    .btn-custom:hover {
            background-color: rgb(137, 193, 229);
        }
</style>
</head>
<body>
<div class="container">
    <h2 class="m-3 p-2" style="text-align: center">Teachers Table</h2>
    <div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </div>
    <a href="{{ route('teacher.create') }}" class="m-3 p-2 btn btn-success mb-3">Add Teacher</a><br/>
    <table class="table table-bordered m-3 p-2">
        <thead>
            <tr class="m-3 p-2" style="text-align: center">
                <th>ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="m-3 p-2">
            @foreach($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->id }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->designation }}</td>
                    <td>{{ $teacher->mobile }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>
                        <a href="{{ route('teacher.edit', ['teacher'=>$teacher]) }}" class="btn btn-primary">Update</a>
                    </td>
            <td>
                        <form action="{{ route('teacher.destroy', ['teacher'=>$teacher]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br/>
<br/>
<div class="mb-3">
    <button type="button" class="m-6 p-2  btn btn-primary align-items-center mb-3" style="background-color: blue; border-color: blue;">
        <a href="{{ route('course.index') }}" class="btn-custom text-white"><i><strong>View Courses Table</strong></i></a>
    </button>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> --}}
