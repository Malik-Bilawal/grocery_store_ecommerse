<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        
        $users = $query->latest()->paginate(10);
    
        return view('admin.user', compact('users'));
    }
    public function toggleStatus(User $user)
{
    $user->status = $user->status === 'active' ? 'blocked' : 'active';
    $user->save();

    return redirect()->back()->with('success', 'User status updated successfully!');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'status' => 'active', 
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User added successfully!');
}
public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
}
}
