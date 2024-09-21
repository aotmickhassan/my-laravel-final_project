<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Course</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-center">Update Course Information</h1>

    <!-- Display validation errors -->
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
        <!-- Update form for editing the course -->
        <form action="{{ route('course.update', ['course' => $course]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Course Title -->
            <div class="form-group">
                <label for="course_title">Course Title:</label>
                <input type="text" class="form-control" id="course_title" name="course_title" value="{{ $course->course_title }}" required>
            </div>

            <!-- Course Code -->
            <div class="form-group">
                <label for="course_code">Course Code:</label>
                <input type="text" class="form-control" id="course_code" name="course_code" value="{{ $course->course_code }}" required>
            </div>

            <!-- Course Credit -->
            <div class="form-group">
                <label for="course_credit">Course Credit:</label>
                <input type="number" step="0.01" class="form-control" id="course_credit" name="course_credit" value="{{ $course->course_credit }}">
            </div>

            <!-- Course Type -->
            <div class="form-group">
                <label for="course_type">Course Type:</label>
                <input type="text" class="form-control" id="course_type" name="course_type" value="{{ $course->course_type }}" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
