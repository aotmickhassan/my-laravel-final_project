<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            margin: 0;
            background-color: #CDCDCD!important;
        }
        .content-layout,
        .table-layout {
            padding: 25px;
            background: white;
            border-radius: 4px;
        }
        .sidebar {
            width: 250px;
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;

        }
        .sidebar a {
            display: block;
            padding: 0.5rem 0;
            color: #343a40;
            text-decoration: none;
            padding-left: 15px;
            padding-right: 15px;
        }
        .sidebar a:hover {
            background-color: #f1f1f1;
        }
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .content {
            padding: 25px;
            flex: 1;
        }
        .form-control {
            margin-bottom: 15px;
            box-shadow: none;
            outline: none;
        }

        .form-control:focus {
            outline: none!important;
            box-shadow: none!important;
        }
        th {
            text-transform: uppercase;
            font-size: 12px!important;
        }

        td {
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h5 class="pt-2" style="padding-left:20px!important;">[APP]</h5>
        <hr class="m-0">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('teacher.index') }}">Teachers</a>
        <a href="{{ route('course.index') }}">Courses</a>
        <a href="{{ route('department.index') }}">Departments</a>
        <a href="{{ route('bills.index') }}">Bills</a>
    </div>

    <!-- Main Section -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div><strong>My App</strong></div>
            <div class="dropdown">
                <a href="#" class="text-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name ?? 'Username' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Yielded content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
