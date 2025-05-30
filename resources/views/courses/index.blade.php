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
        <p class="m-0" style="font-weight: 600; font-size: 20px;">Courses</p>
        <a href="{{ route('course.create') }}" class="btn btn-sm btn-outline-success ">Add Course</a>
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
    <table class="table table-bordered p-2">
        <thead>
            <tr class="m-3 p-2" style="text-align: center">
                <th>ID</th>
                <th>Course Title</th>
                <th>Course Code</th>
                <th>Course Credit</th>
                <th>Course Type</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="m-3 p-2">
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->course_title }}</td>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->course_credit }}</td>
                    <td>{{ $course->course_type }}</td>
                    <td>
                        <!-- Update Button -->
                        <a href="{{ route('course.edit', ['course'=>$course]) }}" class="btn btn-primary">Update</a>
                    </td>
                    <td>
                        <!-- Delete Button -->
                        <form action="{{ route('course.destroy', ['course'=>$course]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- MAIN-SECTION-PARTS --}}

</div>
@endsection




















{{--

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Course Index</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <h2 class="m-3 p-2" style="text-align: center">Courses Table</h2>

    <!-- Success Message -->
    <div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </div>

    <!-- Add Course Button -->
    <a href="{{ route('course.create') }}" class="m-3 p-2 btn btn-success mb-3">Add Course</a><br/>

    <!-- Courses Table -->
    <table class="table table-bordered m-3 p-2">
        <thead>
            <tr class="m-3 p-2" style="text-align: center">
                <th>ID</th>
                <th>Course Title</th>
                <th>Course Code</th>
                <th>Course Credit</th>
                <th>Course Type</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="m-3 p-2">
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->course_title }}</td>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->course_credit }}</td>
                    <td>{{ $course->course_type }}</td>
                    <td>
                        <!-- Update Button -->
                        <a href="{{ route('course.edit', ['course'=>$course]) }}" class="btn btn-primary">Update</a>
                    </td>
                    <td>
                        <!-- Delete Button -->
                        <form action="{{ route('course.destroy', ['course'=>$course]) }}" method="POST" style="display: inline-block;">
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
<br>
    <br>
    <div class="mb-3">
        <button type="button" class="mb-3 m-6 p-2 btn btn-primary align-items-center mb-3" style="background-color: blue; border-color: blue;">
            <a href="{{ route('teacher.index') }}" class="btn-custom text-white"><i><strong>View Teachers Table</strong></i></a>
        </button>
    </div>

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> --}}
