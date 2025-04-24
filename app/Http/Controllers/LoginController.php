<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
// Show the login form
public function showLoginForm()
{
return view('auth.login');
}

// Handle login
public function login(Request $request)
{
// Your login logic here
}

// Handle logout
public function logout(Request $request)
{
Auth::logout(); // Log the user out
$request->session()->invalidate(); // Invalidate the session
$request->session()->regenerateToken(); // Regenerate the CSRF token

return redirect('/welcome'); // Redirect to the homepage or any other page
}
}