<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlaanWord extends Model
{
    protected $table = 'blaan_words';
    protected $fillable = ['blaan', 'pronunciation', 'english', 'category', 'example', 'difficulty'];
}