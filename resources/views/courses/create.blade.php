<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Course</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-center">Create a Course</h1>

    <div class="container">
        <!-- Display validation errors, if any -->
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <!-- Course creation form -->
        <form action="{{ route('course.store') }}" method="POST">
            @csrf
            @method('post')
            
            <!-- Course Title -->
            <div class="form-group">
                <label for="course_title">Course Title:</label>
                <input type="text" class="form-control" id="course_title" name="course_title" value="{{ old('course_title') }}" required>
            </div>

            <!-- Course Code -->
            <div class="form-group">
                <label for="course_code">Course Code:</label>
                <input type="text" class="form-control" id="course_code" name="course_code" value="{{ old('course_code') }}" required>
            </div>

            <!-- Course Credit -->
            <div class="form-group">
                <label for="course_credit">Course Credit:</label>
                <input  class="form-control" id="course_credit" name="course_credit" value="{{ old('course_credit') }}">
            </div>

            <!-- Course Type -->
            <div class="form-group">
                <label for="course_type">Course Type:</label>
                <input type="text" class="form-control" id="course_type" name="course_type" value="{{ old('course_type') }}" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
