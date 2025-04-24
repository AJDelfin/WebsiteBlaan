<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gamification\BlaanWord;

class GamificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample Blaan words
        $words = [
            ['blaan' => 'Fye', 'pronunciation' => 'Fi-yeh', 'english' => 'Hello', 'category' => 'Greetings'],
            // Add more words
        ];
        
        foreach ($words as $word) {
            BlaanWord::create($word);
        }
    
        // Sample achievements
        $achievements = [
            ['achievement_id' => 'first_lesson', 'name' => 'First Steps', 'description' => 'Complete your first lesson', 'xp_reward' => 20],
            // Add more achievements
        ];
        
        // You'd typically store these in a separate table first
    }
}
