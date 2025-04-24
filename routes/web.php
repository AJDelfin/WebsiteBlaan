<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\TeacherLoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Teacher\StudentController;
use App\Http\Controllers\Teacher\Auth\AuthenticatedSessionController;
use App\Http\Controllers\GamificationController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Student Routes (Default Auth)
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Features
    Route::get('/features', function () {
        return view('features');
    })->name('features');

    // Translate
    Route::get('/translate', function () {
        return view('translate');
    })->name('translate');

    // Blaan
    Route::get('/blaan', function () {
        return view('blaan');
    })->name('blaan');

    // Blaan
    Route::get('/blaanLevel', function () {
        return view('basicLevel');
    })->name('blaanLevel');

    Route::prefix('gamification')->group(function () {
        Route::post('/register', [GamificationController::class, 'register']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/lesson', [GamificationController::class, 'getNextLesson']);
            Route::post('/submit', [GamificationController::class, 'submitLesson']);
        });
    });


    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Student Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ✅ Teacher Routes
Route::middleware(['auth:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    // Teacher Dashboard
    Route::get('/dashboard', function () {
        return view('teacher.dashboard');
    })->name('dashboard');

    // Teacher Homebase
    Route::get('/homebase', function () {
        return view('teacher.home');
    })->name('homebase');

    // Teacher Modules
    Route::get('/modules', function () {
        return view('teacher.modules');
    })->name('modules');

    // Teacher Subjects
    Route::get('/subjects', function () {
        return view('teacher.subjects');
    })->name('subjects');

    // Teacher Classes
    Route::get('/classes', function () {
        return view('teacher.classes');
    })->name('classes');

    // Teacher Students
    Route::get('/students', function () {
        return view('teacher.students');
    })->name('students');

    // Teacher Students
    Route::get('/grades', function () {
        return view('teacher.grades');
    })->name('grades');
    

    // Teacher Profile
    Route::get('/profile', function () {
        return view('teacher.profile');
    })->name('profile'); // Correctly named as 'teacher.profile'
});

Route::get('/teacher/classes', function () {
    return view('teacher.classes');
})->name('classes');

   // Add mycourse
   Route::get('/my-courses', function () {
    return view('teacher.mycourses');
})->name('mycourses');

// Add mycourse
Route::get('/archived-Courses', function () {
    return view('teacher.archivedCourses');
})->name('archivedCourses');


Route::post('/clear-login-flag', [AuthenticatedSessionController::class, 'clearLoginFlag'])
->name('clear.login.flag')  // This will be 'teacher.clear.login.flag'
->middleware('auth:teacher');







// ✅ Admin Routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Admin Teacher Management
    Route::get('/teacher', function () {
        return view('admin.teacher');
    })->name('teacher');

    
});




// ✅ Separate Authentication Routes for Each User Type
require __DIR__ . '/auth.php';         // Student Login & Register
require __DIR__ . '/admin-auth.php';   // Admin Login & Register
require __DIR__ . '/teacher-auth.php'; // Teacher Login & Register