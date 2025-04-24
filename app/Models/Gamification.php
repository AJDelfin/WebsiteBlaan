<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gamification extends Model
{
    protected $connection = 'mysql';
    protected $table = 'users';

    protected $fillable = [
        // ... existing fields ...
        'role', 'student_id', 'first_name', 'last_name', 'class_id',
        'level', 'xp', 'hearts', 'streak', 'lessons_completed',
        'perfect_lessons', 'words_learned'
    ];

    /**
     * @return HasMany<UserAchievement>
     */
    public function achievements(): HasMany
    {
        return $this->hasMany(UserAchievement::class, 'user_id');
    }

    /**
     * @return HasMany<LessonHistory>
     */
    public function lessonHistories(): HasMany
    {
        return $this->hasMany(LessonHistory::class, 'user_id');
    }

    /**
     * @return BelongsTo<ClassModel, Gamification>
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    // ... rest of your methods ...
}