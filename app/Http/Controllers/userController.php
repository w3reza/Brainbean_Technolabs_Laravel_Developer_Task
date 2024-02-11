<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function show()
   {
       return view('backend.pages.users');
   }
    public function create()
   {
       return view('backend.pages.user_create');
   }
   public function store(Request $request){
    // Validate the form data
    $request->validate([
        'first_name' => 'required|string|max:100',
        'last_name' => 'nullable|string|max:100',
        'email' => 'required|email|unique:users',
        'username' => 'required|string|max:100|unique:users',
        'password' => 'required|string',
        'role' => 'required|string|max:50',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle file upload if a photo is provided
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
    } else {
        $photoPath = null;
    }

    // Create a new user
    User::create([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
        'username' => $request->input('username'),
        'password' => bcrypt($request->input('password')),
        'role' => $request->input('role'),
        'photo' => $photoPath,
    ]);

    // Redirect to a success page or do whatever you need

    session()->flash('success', 'User created successfully.');
    
    return redirect()->route('user.create');
}
}
