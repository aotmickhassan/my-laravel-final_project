@extends('layouts.main')

@section('title', 'User Management')

@section('content')
<div class="table-layout">
    <div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-between mb-3">
        <h2 class="m-0" style="font-weight: 600; font-size: 22px;">User Management</h2>
    </div>

    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Mobile No</th>
                <th>Department</th>
                @if (Auth::user()->role == 'admin')
                <th>Status</th>
                <th>Edit</th>
                <th>Action</th>
                    
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="align-middle text-center">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td id="role-{{ $user->id }}">{{ ucfirst($user->designation) }}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{ $user->department->name ?? 'N/A' }}</td>
                    @if (Auth::user()->role == 'admin')
                        
                    <td>
                        <label class="switch">
                            <input type="checkbox" class="status-toggle" data-id="{{ $user->id }}" {{ $user->status === 'active' ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </td>
                    {{-- <td>
                        <button class="btn btn-sm btn-outline-primary" onclick="updateRole('admin', {{ $user->id }})">Make Admin</button>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-secondary" onclick="updateRole('teacher', {{ $user->id }})">Make Teacher</button>
                    </td> --}}
                    <td>
                        <a href="{{ route('teacher.edit', ['teacher'=>$user]) }}" class="btn btn-primary">Update</a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('teacher.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Toggle Switch CSS --}}
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 46px;
    height: 24px;
}
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
.slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0;
    right: 0; bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}
.slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}
input:checked + .slider {
    background-color: #4CAF50;
}
input:checked + .slider:before {
    transform: translateX(22px);
}
</style>

{{-- JavaScript --}}
<script>
    function updateRole(role, userId) {
        fetch(`/admin/users/update-role/${role}/${userId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.message) {
                alert(data.message);
                document.getElementById('role-' + userId).innerText = role.charAt(0).toUpperCase() + role.slice(1);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Something went wrong!');
        });
    }

    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function () {
            const userId = this.dataset.id;
            fetch(`/admin/users/toggle-status/${userId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                alert(`User status updated to ${data.status}`);
            })
            .catch(() => {
                alert('Failed to update status');
                this.checked = !this.checked; // revert
            });
        });
    });
</script>
@endsection
