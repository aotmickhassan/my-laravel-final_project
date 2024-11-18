<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <!-- Include the style here -->
    <style>
        a:hover {
            background-color: indigo !important;
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
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh; background-color: white;">
        <div class="mb-3">
            <button type="button" class="btn btn-primary align-items-center" 
                    style="background-color: blue; border-color: blue;">
                <a href="{{ route('teacher.index') }}" 
                   class="text-decoration-none text-white" 
                   style="display: block; padding: 10px; transition: background-color 0.3s; border-radius: 4px;">
                    <i><strong>View Teachers Table</strong></i>
                </a>
            </button>
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-primary align-items-center" 
                    style="background-color: blue; border-color: blue;">
                <a href="{{ route('course.index') }}" 
                   class="text-decoration-none text-white" 
                   style="display: block; padding: 10px; transition: background-color 0.3s; border-radius: 4px;">
                    <i><strong>View Courses Table</strong></i>
                </a>
            </button>
        </div>
    </div>
    {{-- <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh; background-color: white;">
        <div class="mb-3">
            <button type="button" class="btn btn-primary align-items-center" 
                    style="background-color: blue; border-color: blue;">
                <a href="{{ route('department.index') }}" 
                   class="text-decoration-none text-white" 
                   style="display: block; padding: 10px; transition: background-color 0.3s; border-radius: 4px;">
                    <i><strong>View Department Table</strong></i>
                </a>
            </button>
        </div>
        
    </div> --}}
</div>
</x-app-layout>
