<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function updateRole($role = 'admin', $userId)
    {
        $user = User::findOrFail($userId);
        $user->role = $role;
        $user->save();

        return response()->json(['message' => 'User role updated successfully.']);
    }
    public function allUsers()
    {
        $users = User::with('department')->get(); // eager-load department relationship

        return view('user.index', compact('users'));
    }
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        $user->status = $user->status === 'active' ? 'pending' : 'active';
        $user->save();

        return response()->json(['status' => $user->status, 'message' => 'User status updated.']);
    }
}