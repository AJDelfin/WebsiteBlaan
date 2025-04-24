<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAchievement extends Model
{
    protected $table = 'user_achievements';
    protected $fillable = ['user_id', 'achievement_id', 'name', 'description', 'xp_reward'];
}