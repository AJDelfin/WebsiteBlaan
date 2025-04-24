<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name', 'teacher_id'];
}