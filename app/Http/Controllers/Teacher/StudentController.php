<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $students = User::where('role', 'student')
                    ->when($search, function($query, $search) {
                        return $query->where(function($q) use ($search) {
                            $q->where('name', 'like', "%$search%")
                              ->orWhere('email', 'like', "%$search%");
                        });
                    })
                    ->with('class')
                    ->orderBy('name')
                    ->paginate(10);
                    
        return view('teacher.allstudents', compact('students'));
    }
}