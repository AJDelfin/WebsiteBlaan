<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TeacherLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        session()->forget(['fresh_login_token', 'teacher_name']);
        return view('teacher.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(TeacherLoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        
        $loginToken = Str::random(40);
        
        // Set session data
        session([
            'fresh_login_token' => $loginToken,
            'teacher_name' => Auth::guard('teacher')->user()->name,
            'login_time' => now()->toDateTimeString()
        ]);
        
        // Flash the token
        session()->flash('valid_login_token', $loginToken);
        
        $request->session()->regenerate();

        Log::info('Teacher login successful', [
            'teacher_id' => Auth::guard('teacher')->id(),
            'name' => Auth::guard('teacher')->user()->name,
            'ip' => $request->ip(),
            'login_token' => $loginToken
        ]);

        return redirect()->intended(route('teacher.dashboard', absolute: false));
    }

    /**
     * Clear the login flag (AJAX endpoint)
     */
    public function clearLoginFlag(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action');
        }

        $token = session()->pull('fresh_login_token');
        $teacher = Auth::guard('teacher')->user();
        
        Log::debug('Login flag cleared', [
            'teacher_id' => $teacher->id,
            'name' => $teacher->name,
            'token' => $token,
            'ip' => $request->ip()
        ]);

        return response()->json([
            'success' => (bool)$token,
            'message' => $token ? 'Login flag cleared' : 'No flag to clear'
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $teacher = Auth::guard('teacher')->user();
        
        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info('Teacher logout', [
            'teacher_id' => $teacher->id ?? 'none',
            'name' => $teacher->name ?? 'unknown',
            'ip' => $request->ip()
        ]);

        return redirect('/');
    }
}