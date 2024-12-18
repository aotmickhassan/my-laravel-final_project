<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Include the styles -->
    <style>
        a:hover {
            background-color: indigo !important;
        }

        .btn-custom {
            background-color: blue;
            border-color: blue;
        }

        .btn-custom a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 10px;
            transition: background-color 0.3s ease-in-out;
            border-radius: 4px;
        }

        .btn-custom a:hover {
            background-color: indigo;
        }

        /* .center-content {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: white;
        } */

        .button-group {
            margin-bottom: 15px;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="center-content">
        <!-- Button for Teachers Table -->
        <div class="button-group">
            <button type="button" class="btn btn-custom">
                <a href="{{ route('teacher.index') }}">
                    <i><strong>View Teachers Table</strong></i>
                </a>
            </button>
        </div>

        <!-- Button for Courses Table -->
        <div class="button-group">
            <button type="button" class="btn btn-custom">
                <a href="{{ route('course.index') }}">
                    <i><strong>View Courses Table</strong></i>
                </a>
            </button>
        </div>

        <!-- Button for Departments Table -->
        <div class="button-group mt-4">
            <button type="button" class="btn btn-custom btn-primary">
                <a href="{{ route('department.index') }}" class="text-white text-decoration-none">
                    <i><strong>View Departments Table</strong></i>
                </a>
            </button>
            <a href="{{ route('billDetail.index') }}" 
   class="btn btn-primary btn-lg ml-3 d-inline-flex align-items-center custom-hover">
    <i class="fas fa-eye mr-2"></i> <strong>View Bill Details</strong>
            </a>

        </div>
    </div>
</x-app-layout>
