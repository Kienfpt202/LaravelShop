<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthentificationController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function store(Request $request)
    {
        $user = new User($request->all());
        $user->save();
        return redirect()->route('users.index');
    }
        /**
         * Display the specified resource.
         */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('users.index');
    }
    // Login view
    public function login()
    {
        return view('auth.login');
    }
    // Register view
    public function register()
    {
        if (auth()->check()) {
            return redirect()->route('success');
        }
        return view('auth.register');
    }
    // Login action
    public function doLogin(Request $request)
    {
        //Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        // Attempt to log the user in
        if (auth()->attempt($request->only('email', 'password'))) {
            // Redirect to success page
            return redirect()->route('success');
        }
        // Redirect to login page
        return redirect()->route('login')->withErrors('Email or password is incorrect');
    }
    // Register action
    public function doRegister(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Hash the password
            'password' => Hash::make($request->password)
        ]);
        // Sign the user in
        auth()->login($user);
        // Redirect to success page
        return redirect()->route('success');
    }

    // Logout action
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
