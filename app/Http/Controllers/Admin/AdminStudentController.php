<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentSession;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    /**
     * Display list of students with online status
     */
    public function index(Request $request)
    {
        // Get search/filter parameters
        $grade = $request->input('grade');
        $status = $request->input('status');
        $search = $request->input('search');
        
        $query = Student::query()
            ->with(['latestSession'])
            ->select('students.*')
            ->leftJoin('student_sessions', function($join) {
                $join->on('students.id', '=', 'student_sessions.student_id')
                    ->where('student_sessions.last_activity', '>', now()->subMinutes(5));
            })
            ->selectRaw('CASE WHEN student_sessions.id IS NOT NULL THEN "Online" ELSE "Offline" END as status')
            ->selectRaw('MAX(student_sessions.last_activity) as last_active');
            
        // Apply filters
        if ($grade) {
            $query->where('grade_level', $grade);
        }
        
        if ($status === 'online') {
            $query->having('status', '=', 'Online');
        } elseif ($status === 'offline') {
            $query->having('status', '=', 'Offline');
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('blaan_id', 'like', "%{$search}%");
            });
        }
        
        $students = $query->groupBy('students.id')
            ->orderBy('status', 'desc') // Online first
            ->orderBy('last_name')
            ->paginate(20);
            
        return view('admin.students.index', compact('students'));
    }
    
    /**
     * Show individual student details with activity history
     */
    public function show(Student $student)
    {
        $activity = StudentSession::where('student_id', $student->id)
            ->orderBy('last_activity', 'desc')
            ->paginate(10);
            
        $online = StudentSession::where('student_id', $student->id)
            ->where('last_activity', '>', now()->subMinutes(5))
            ->exists();
            
        return view('admin.students.show', [
            'student' => $student,
            'activity' => $activity,
            'online' => $online
        ]);
    }
}