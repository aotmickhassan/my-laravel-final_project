@extends('layouts.main')

@section('title', 'Add Teacher')

@section('content')
<div class="content-layout">
    <div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-between mb-2">
        <p class="m-0" style="font-weight: 600; font-size: 20px;">Add New Teacher</p>
    </div>

    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.store') }}" method="POST">
            @csrf

            <!-- Full Name -->
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <!-- Designation -->
            <div class="form-group">
                <label for="designation">Designation:</label>
                <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation') }}" required>
            </div>

            <!-- Department Dropdown -->
            <div class="form-group">
                <label for="department">Department:</label>
                <select name="department" id="department" class="form-control" required>
                    <option value="">-- Select Department --</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ old('department') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Mobile -->
            <div class="form-group">
                <label for="mobile">Mobile No:</label>
                <input type="text" maxlength="11" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Temporary Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-success mt-3">Submit</button>
        </form>
    </div>
</div>
@endsection
