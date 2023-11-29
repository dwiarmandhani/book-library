<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the form to create a new user
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'is_admin' => 'required|in:1,0',
        ]);
        $validatedData['is_admin'] = intval($validatedData['is_admin']);
        $validatedData['password'] = Hash::make($request->password);

        User::create($validatedData);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // Show a specific user
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show the form to edit a user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update the specified user in the database
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'is_admin' => 'required|in:1,0',
        ]);
        $validatedData['is_admin'] = intval($validatedData['is_admin']);
        // Jika terdapat input kata sandi baru, enkripsi kata sandi.
        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Remove the specified user from the database
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function showResetForm()
    {

        return view('users.resetpassword');
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $email = Auth::user()->email;
        $password = $request->input('password');

        DB::table('users')
            ->where('email', $email)
            ->update(['password' => Hash::make($password)]);

        // Redirect ke halaman login atau halaman sukses reset password
        return redirect()->route('home')->with('success', 'Password berhasil direset.');
    }
}
