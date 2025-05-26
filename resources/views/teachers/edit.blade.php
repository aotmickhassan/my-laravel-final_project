@extends('layouts.main')

@section('title', 'Home')

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
        <p class="m-0" style="font-weight: 600; font-size: 20px;">Update Teacher Info</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-5 box1">
        <form action="{{ route('teacher.update', ['teacher' => $teacher]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $teacher->name) }}"
                    required
                >
            </div>

            <!-- Designation -->
            <div class="form-group">
                <label for="designation">Designation:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="designation" 
                    name="designation" 
                    value="{{ old('designation', $teacher->designation) }}"
                    required
                >
            </div>

            <!-- Department Dropdown -->
            <div class="form-group">
                <label for="department">Department:</label>
                <select name="department" id="department" class="form-control" required>
                    <option value="">-- Select Department --</option>
                    @foreach($departments as $dept)
                        <option 
                            value="{{ $dept->id }}" 
                            {{ old('department', $teacher->dept) == $dept->id ? 'selected' : '' }}
                        >
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Mobile -->
            <div class="form-group">
                <label for="mobile">Mobile No:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="mobile" 
                    name="mobile" 
                    maxlength="11" 
                    value="{{ old('mobile', $teacher->phone) }}"
                    required
                >
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', $teacher->email) }}"
                    required
                >
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</div>
@endsection
