<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonHistory extends Model
{
    protected $table = 'lesson_history';
    protected $fillable = ['user_id', 'word_id', 'correct', 'question_type', 'streak_at_time'];
}