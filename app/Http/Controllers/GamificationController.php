<?php

namespace App\Http\Controllers;

use App\Models\Gamification;
use App\Models\BlaanWord;
use App\Models\LessonHistory; // Add this import
use App\Models\UserAchievement; // Add this if needed
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class GamificationController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:student,teacher',
            'first_name' => 'required_if:role,student,teacher',
            'last_name' => 'required_if:role,student,teacher',
            'student_id' => 'required_if:role,student|unique:users',
            'class_id' => 'required_if:role,student|exists:classes,id'
        ]);

        $user = Gamification::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'first_name' => $validated['first_name'] ?? null,
            'last_name' => $validated['last_name'] ?? null,
            'student_id' => $validated['student_id'] ?? null,
            'class_id' => $validated['class_id'] ?? null,
            'remember_token' => Str::random(10),
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    public function getNextLesson(Request $request)
    {
        $user = $request->user();
        
        if ($user->role !== 'student') {
            return response()->json(['error' => 'Only students can access lessons'], 403);
        }

        $word = BlaanWord::where('difficulty', '<=', $user->level)
            ->inRandomOrder()
            ->first();

        if (!$word) {
            return response()->json(['error' => 'No words available'], 404);
        }

        $questionType = rand(0, 1) ? 'meaning' : 'translation';
        
        if ($questionType === 'meaning') {
            $question = "What does '{$word->blaan}' mean?";
            $correctAnswer = $word->english;
            $options = $this->generateOptions($correctAnswer, $word->category, $questionType);
        } else {
            $question = "How do you say '{$word->english}' in Blaan?";
            $correctAnswer = $word->blaan;
            $options = $this->generateOptions($correctAnswer, $word->category, $questionType);
        }

        return response()->json([
            'lesson_id' => $word->id,
            'category' => $word->category,
            'word' => $questionType === 'meaning' ? $word->blaan : $word->english,
            'pronunciation' => $questionType === 'meaning' ? $word->pronunciation : null,
            'question' => $question,
            'options' => $options,
            'correct_index' => array_search($correctAnswer, $options),
            'hint' => $word->example,
            'question_type' => $questionType
        ]);
    }

    private function generateOptions(string $correctAnswer, string $category, string $questionType): array
    {
        $options = [$correctAnswer];
        
        // Get 3 other words from same category
        $sameCategory = BlaanWord::where('category', $category)
            ->where('english', '!=', $correctAnswer)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        
        foreach ($sameCategory as $word) {
            $option = $questionType === 'meaning' ? $word->english : $word->blaan;
            if (!in_array($option, $options)) {
                $options[] = $option;
            }
        }
        
        // If still not enough, get from other categories
        if (count($options) < 4) {
            $otherWords = BlaanWord::where('category', '!=', $category)
                ->inRandomOrder()
                ->limit(4 - count($options))
                ->get();
            
            foreach ($otherWords as $word) {
                $option = $questionType === 'meaning' ? $word->english : $word->blaan;
                if (!in_array($option, $options)) {
                    $options[] = $option;
                }
            }
        }
        
        // Final check to ensure 4 options
        while (count($options) < 4) {
            $options[] = $options[0]; // Fallback: duplicate correct answer
        }
        
        shuffle($options);
        return array_slice($options, 0, 4);
    }
}