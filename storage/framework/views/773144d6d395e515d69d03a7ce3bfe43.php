<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bla'an Language Learning Game</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #6366f1;
            --secondary: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --background: #f9fafb;
            --card-bg: #ffffff;
            --text: #1f2937;
            --text-light: #6b7280;
            --border: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 16px;
            background-color: var(--primary);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .back-btn:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
        }

        .back-btn i {
            margin-right: 8px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
        }

        .profile-name {
            font-weight: 500;
        }

        .logout-btn {
            padding: 8px 16px;
            background-color: var(--danger);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background-color: #dc2626;
        }

        /* Stats Bar */
        .stats-bar {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            text-align: center;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 24px;
            margin-bottom: 12px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 48px;
            height: 48px;
            border-radius: 50%;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 4px;
            color: var(--text);
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        /* Progress Bar */
        .progress-container {
            width: 100%;
            background-color: var(--border);
            border-radius: 8px;
            margin-bottom: 30px;
            height: 12px;
        }

        .progress-bar {
            height: 100%;
            border-radius: 8px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
            width: 0%;
            transition: width 0.5s ease;
        }

        /* Game Card */
        .game-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            position: relative;
        }

        .category-tag {
            display: inline-block;
            padding: 6px 12px;
            background-color: var(--primary-light);
            color: white;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .word-display {
            text-align: center;
            margin-bottom: 30px;
        }

        .blaan-text {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .pronunciation {
            font-size: 1.2rem;
            color: var(--text-light);
            font-style: italic;
        }

        .question {
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 500;
            color: var(--text);
        }

        .options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 30px;
        }

        .option-btn {
            padding: 18px;
            border: 2px solid var(--border);
            border-radius: 12px;
            background: none;
            cursor: pointer;
            font-size: 1.1rem;
            transition: all 0.2s;
            font-weight: 500;
            text-align: center;
        }

        .option-btn:hover:not(:disabled) {
            border-color: var(--primary);
            background-color: rgba(79, 70, 229, 0.05);
        }

        .option-btn:disabled {
            cursor: not-allowed;
        }

        .option-btn.correct {
            background-color: rgba(16, 185, 129, 0.1);
            border-color: var(--secondary);
            color: var(--secondary);
        }

        .option-btn.wrong {
            background-color: rgba(239, 68, 68, 0.1);
            border-color: var(--danger);
            color: var(--danger);
        }

        /* Hint Section */
        .hint-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .hint-btn {
            padding: 12px 24px;
            background-color: var(--warning);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hint-btn:hover {
            background-color: #e67e22;
        }

        .hint-text {
            margin-top: 16px;
            padding: 16px;
            background-color: rgba(245, 158, 11, 0.1);
            border-radius: 8px;
            color: var(--text);
            font-size: 1rem;
            display: none;
            width: 100%;
            text-align: center;
        }

        /* Feedback */
        .feedback {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 16px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 1000;
            display: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .feedback.correct {
            background-color: var(--secondary);
        }

        .feedback.wrong {
            background-color: var(--danger);
        }

        /* Game Over */
        .game-over {
            text-align: center;
            padding: 40px 20px;
        }

        .game-over h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--primary);
        }

        .game-over p {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--text);
        }

        .restart-btn {
            margin-top: 30px;
            padding: 16px 32px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .restart-btn:hover {
            transform: translateY(-2px);
        }

        /* Achievement Badge */
        .achievement-badge {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            z-index: 1000;
            display: none;
            max-width: 400px;
        }

        .achievement-badge i {
            font-size: 48px;
            color: var(--warning);
            margin-bottom: 20px;
        }

        .achievement-badge h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .achievement-badge p {
            font-size: 1rem;
            color: var(--text-light);
            margin-bottom: 20px;
        }

        /* Leaderboard */
        .leaderboard-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 100;
            transition: all 0.3s;
        }

        .leaderboard-btn:hover {
            transform: scale(1.1);
        }

        .leaderboard-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s;
        }

        .leaderboard-modal.active {
            opacity: 1;
            pointer-events: all;
        }

        .leaderboard-content {
            background: white;
            border-radius: 16px;
            padding: 30px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .leaderboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .leaderboard-header h2 {
            color: var(--primary);
        }

        .close-leaderboard {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-light);
        }

        .leaderboard-list {
            list-style: none;
        }

        .leaderboard-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .leaderboard-item:last-child {
            border-bottom: none;
        }

        .leaderboard-rank {
            font-weight: 700;
            color: var(--primary);
            width: 30px;
            text-align: center;
        }

        .leaderboard-user {
            display: flex;
            align-items: center;
            flex-grow: 1;
        }

        .leaderboard-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 12px;
            background-color: var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .leaderboard-name {
            font-weight: 500;
        }

        .leaderboard-score {
            font-weight: 700;
            color: var(--text);
        }

        /* Animations */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .stat-update {
            animation: pulse 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes slideInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideOutUp {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-50px); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-bar {
                grid-template-columns: repeat(2, 1fr);
            }

            .options-grid {
                grid-template-columns: 1fr;
            }

            .game-card {
                padding: 24px;
            }

            .blaan-text {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }

            .profile {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <a href="<?php echo e(route('blaan')); ?>" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Home
            </a>
            
            <div class="profile">
            
                <span class="profile-name" id="player-name"><?php echo e(Auth::user()->name); ?></span>
                <button class="logout-btn" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="progress-container">
            <div class="progress-bar" id="xp-progress"></div>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stat-card" id="hearts-card">
                <div class="stat-icon" style="background-color: rgba(239, 68, 68, 0.1); color: var(--danger);">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-value" id="hearts">3</div>
                <div class="stat-label">Lives</div>
            </div>
            <div class="stat-card" id="xp-card">
                <div class="stat-icon" style="background-color: rgba(79, 70, 229, 0.1); color: var(--primary);">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-value" id="xp">0</div>
                <div class="stat-label">Experience</div>
            </div>
            <div class="stat-card" id="level-card">
                <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.1); color: var(--warning);">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stat-value" id="level">1</div>
                <div class="stat-label">Level</div>
            </div>
            <div class="stat-card" id="streak-card">
                <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.1); color: var(--secondary);">
                    <i class="fas fa-fire"></i>
                </div>
                <div class="stat-value" id="streak">0</div>
                <div class="stat-label">Streak</div>
            </div>
        </div>

        <!-- Game Container -->
        <div id="game-container" class="game-card fade-in">
            <!-- Game content will be loaded here -->
        </div>

        <!-- Feedback Message -->
        <div class="feedback" id="feedback"></div>

        <!-- Achievement Badge -->
        <div class="achievement-badge" id="achievement-badge">
            <i class="fas fa-medal"></i>
            <h3 id="achievement-title">Achievement Unlocked!</h3>
            <p id="achievement-desc">You've reached a new milestone!</p>
            <button class="restart-btn" onclick="hideAchievement()">Continue</button>
        </div>
    </div>

    <!-- Leaderboard Button -->
    <div class="leaderboard-btn" onclick="showLeaderboard()">
        <i class="fas fa-crown"></i>
    </div>

    <!-- Leaderboard Modal -->
    <div class="leaderboard-modal" id="leaderboard-modal">
        <div class="leaderboard-content">
            <div class="leaderboard-header">
                <h2>Leaderboard</h2>
                <button class="close-leaderboard" onclick="hideLeaderboard()">&times;</button>
            </div>
            <ul class="leaderboard-list" id="leaderboard-list">
                <!-- Leaderboard items will be added here -->
            </ul>
        </div>
    </div>

    <script>
        // Blaan Language Database
        const blaanDatabase = {
            greetings: [
                {
                    blaan: "Fye",
                    pronunciation: "Fi-yeh",
                    english: "Hello",
                    category: "Greetings",
                    example: "Fye! (Hello!)"
                },
                {
                    blaan: "Fyi",
                    pronunciation: "F-yee",
                    english: "Good morning",
                    category: "Greetings",
                    example: "Fyi! (Good morning!)"
                },
                {
                    blaan: "Fye kel",
                    pronunciation: "Fi-yeh kel",
                    english: "Good evening",
                    category: "Greetings",
                    example: "Fye kel! (Good evening!)"
                },
                {
                    blaan: "Fye lam",
                    pronunciation: "Fi-yeh lam",
                    english: "Good night",
                    category: "Greetings",
                    example: "Fye lam! (Good night!)"
                }
            ],
            commonPhrases: [
                {
                    blaan: "Bong",
                    pronunciation: "Bong",
                    english: "Thank you",
                    category: "Common Phrases",
                    example: "Bong! (Thank you!)"
                },
                {
                    blaan: "Moy",
                    pronunciation: "Moy",
                    english: "How are you?",
                    category: "Common Phrases",
                    example: "Moy? (How are you?)"
                },
                {
                    blaan: "Mlat",
                    pronunciation: "M-lat",
                    english: "Beautiful",
                    category: "Common Phrases",
                    example: "Mlat! (Beautiful!)"
                },
                {
                    blaan: "Hulon",
                    pronunciation: "Hoo-lon",
                    english: "Goodbye",
                    category: "Common Phrases",
                    example: "Hulon! (Goodbye!)"
                }
            ],
            nouns: [
                {
                    blaan: "Naga",
                    pronunciation: "Na-ga",
                    english: "Rice",
                    category: "Food",
                    example: "Naga (Rice)"
                },
                {
                    blaan: "Paga",
                    pronunciation: "Pa-ga",
                    english: "Village",
                    category: "Places",
                    example: "Paga (Village)"
                },
                {
                    blaan: "Tana",
                    pronunciation: "Ta-na",
                    english: "House",
                    category: "Places",
                    example: "Tana (House)"
                },
                {
                    blaan: "Bla",
                    pronunciation: "Bla",
                    english: "Person",
                    category: "People",
                    example: "Bla (Person)"
                }
            ],
            adjectives: [
                {
                    blaan: "Mlat",
                    pronunciation: "M-lat",
                    english: "Beautiful",
                    category: "Adjectives",
                    example: "Mlat bla (Beautiful person)"
                },
                {
                    blaan: "Kusu",
                    pronunciation: "Ku-su",
                    english: "Happy",
                    category: "Adjectives",
                    example: "Kusu bla (Happy person)"
                },
                {
                    blaan: "Lom",
                    pronunciation: "Lom",
                    english: "Big",
                    category: "Adjectives",
                    example: "Lom tana (Big house)"
                },
                {
                    blaan: "Dik",
                    pronunciation: "Dik",
                    english: "Small",
                    category: "Adjectives",
                    example: "Dik tana (Small house)"
                }
            ],
            verbs: [
                {
                    blaan: "Mek",
                    pronunciation: "Mek",
                    english: "Eat",
                    category: "Actions",
                    example: "Mek naga (Eat rice)"
                },
                {
                    blaan: "Inom",
                    pronunciation: "I-nom",
                    english: "Drink",
                    category: "Actions",
                    example: "Inom tubig (Drink water)"
                },
                {
                    blaan: "Tulog",
                    pronunciation: "Tu-log",
                    english: "Sleep",
                    category: "Actions",
                    example: "Tulog (Sleep)"
                },
                {
                    blaan: "Lakad",
                    pronunciation: "La-kad",
                    english: "Walk",
                    category: "Actions",
                    example: "Lakad (Walk)"
                }
            ],
            numbers: [
                {
                    blaan: "Sana",
                    pronunciation: "Sa-na",
                    english: "One",
                    category: "Numbers",
                    example: "Sana (One)"
                },
                {
                    blaan: "Dua",
                    pronunciation: "Du-a",
                    english: "Two",
                    category: "Numbers",
                    example: "Dua (Two)"
                },
                {
                    blaan: "Talu",
                    pronunciation: "Ta-lu",
                    english: "Three",
                    category: "Numbers",
                    example: "Talu (Three)"
                },
                {
                    blaan: "Apat",
                    pronunciation: "A-pat",
                    english: "Four",
                    category: "Numbers",
                    example: "Apat (Four)"
                }
            ],
            colors: [
                {
                    blaan: "Milat",
                    pronunciation: "Mee-lat",
                    english: "Green",
                    category: "Colors",
                    example: "Milat (Green)"
                },
                {
                    blaan: "Mipula",
                    pronunciation: "Mee-poo-la",
                    english: "Red",
                    category: "Colors",
                    example: "Mipula (Red)"
                },
                {
                    blaan: "Mibiru",
                    pronunciation: "Mee-bee-roo",
                    english: "Blue",
                    category: "Colors",
                    example: "Mibiru (Blue)"
                },
                {
                    blaan: "Miyelo",
                    pronunciation: "Mee-ye-lo",
                    english: "Yellow",
                    category: "Colors",
                    example: "Miyelo (Yellow)"
                }
            ]
        };

        // Achievements
        const achievements = [
            {
                id: "first_lesson",
                title: "First Steps",
                description: "Complete your first lesson",
                unlocked: false,
                xpReward: 20
            },
            {
                id: "level_5",
                title: "Rising Star",
                description: "Reach level 5",
                unlocked: false,
                xpReward: 50
            },
            {
                id: "streak_5",
                title: "Hot Streak",
                description: "Get a 5-question streak",
                unlocked: false,
                xpReward: 30
            },
            {
                id: "perfect_lesson",
                title: "Perfect Score",
                description: "Complete a lesson without mistakes",
                unlocked: false,
                xpReward: 40
            },
            {
                id: "all_categories",
                title: "Jack of All Trades",
                description: "Try lessons from all categories",
                unlocked: false,
                xpReward: 60
            }
        ];

        // Leaderboard data (simulated)
        const leaderboardData = [
            { name: "Blaan Master", level: 15, xp: 1250, avatar: "BM" },
            { name: "Language Pro", level: 12, xp: 980, avatar: "LP" },
            { name: "Quick Learner", level: 10, xp: 800, avatar: "QL" },
            { name: "Player One", level: 1, xp: 0, avatar: "P1" },
            { name: "Cultural Explorer", level: 8, xp: 650, avatar: "CE" },
            { name: "Word Collector", level: 7, xp: 550, avatar: "WC" },
            { name: "Phrase Finder", level: 5, xp: 400, avatar: "PF" }
        ];

        // Game State
        let gameState = {
            currentLesson: null,
            hearts: 3,
            xp: 0,
            level: 1,
            streak: 0,
            answered: false,
            lessonsCompleted: 0,
            perfectLessons: 0,
            categoriesPlayed: new Set(),
            playerName: "Player One",
            achievementsUnlocked: 0
        };

        // DOM Elements
        const gameContainer = document.getElementById('game-container');
        const heartsEl = document.getElementById('hearts');
        const xpEl = document.getElementById('xp');
        const levelEl = document.getElementById('level');
        const streakEl = document.getElementById('streak');
        const xpProgressEl = document.getElementById('xp-progress');
        const feedbackEl = document.getElementById('feedback');
        const achievementBadge = document.getElementById('achievement-badge');
        const achievementTitle = document.getElementById('achievement-title');
        const achievementDesc = document.getElementById('achievement-desc');
        const playerNameEl = document.getElementById('player-name');
        const leaderboardModal = document.getElementById('leaderboard-modal');
        const leaderboardList = document.getElementById('leaderboard-list');

        // Initialize the game
        document.addEventListener('DOMContentLoaded', () => {
            // Load player name from localStorage if available
            const savedName = localStorage.getItem('blaanPlayerName');
            if (savedName) {
                gameState.playerName = savedName;
                playerNameEl.textContent = savedName;
            }
            
            // Load game state from localStorage if available
            const savedState = localStorage.getItem('blaanGameState');
            if (savedState) {
                const parsedState = JSON.parse(savedState);
                Object.assign(gameState, parsedState);
                
                // Convert categoriesPlayed back to Set
                if (parsedState.categoriesPlayedArray) {
                    gameState.categoriesPlayed = new Set(parsedState.categoriesPlayedArray);
                }
                
                updateStats();
            }
            
            // Load achievements from localStorage if available
            const savedAchievements = localStorage.getItem('blaanAchievements');
            if (savedAchievements) {
                const parsedAchievements = JSON.parse(savedAchievements);
                achievements.forEach((ach, index) => {
                    if (parsedAchievements[index]) {
                        ach.unlocked = parsedAchievements[index].unlocked;
                    }
                });
            }
            
            // Populate leaderboard
            populateLeaderboard();
            
            // Start the game
            getRandomLesson();
            loadLesson();
        });

        function saveGameState() {
            // Convert Set to Array for localStorage
            const stateToSave = {
                ...gameState,
                categoriesPlayedArray: Array.from(gameState.categoriesPlayed)
            };
            
            localStorage.setItem('blaanGameState', JSON.stringify(stateToSave));
            
            // Save achievements
            localStorage.setItem('blaanAchievements', JSON.stringify(achievements));
        }

        function updateStats() {
            // Add animation class to all stat cards
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach(card => card.classList.remove('stat-update'));
            
            // Update values
            heartsEl.textContent = gameState.hearts;
            xpEl.textContent = gameState.xp;
            levelEl.textContent = gameState.level;
            streakEl.textContent = gameState.streak;
            
            // Update XP progress bar
            const xpPercentage = (gameState.xp % 100);
            xpProgressEl.style.width = `${xpPercentage}%`;
            
            // Re-add animation class
            setTimeout(() => {
                statCards.forEach(card => card.classList.add('stat-update'));
            }, 10);
            
            // Save game state
            saveGameState();
        }

        function getRandomLesson() {
            // Flatten all categories into one array
            const allLessons = Object.values(blaanDatabase).flat();
            
            // Filter out the current lesson to avoid repeats
            const availableLessons = allLessons.filter(lesson => 
                !gameState.currentLesson || lesson.blaan !== gameState.currentLesson.blaan
            );
            
            // Select a random lesson
            const randomIndex = Math.floor(Math.random() * availableLessons.length);
            gameState.currentLesson = availableLessons[randomIndex];
            
            // Track categories played
            gameState.categoriesPlayed.add(gameState.currentLesson.category);
            
            return gameState.currentLesson;
        }

        function generateOptions(correctAnswer, category) {
            // Get all possible answers from the same category
            const categoryLessons = Object.values(blaanDatabase)
                .flat()
                .filter(lesson => lesson.category === category);
            
            // Get 3 random incorrect answers
            let options = [correctAnswer];
            while (options.length < 4 && options.length < categoryLessons.length) {
                const randomLesson = categoryLessons[Math.floor(Math.random() * categoryLessons.length)];
                if (!options.includes(randomLesson.english) && randomLesson.english !== correctAnswer) {
                    options.push(randomLesson.english);
                }
            }
            
            // If we don't have enough options, get random ones from other categories
            while (options.length < 4) {
                const randomCategory = Object.keys(blaanDatabase)[
                    Math.floor(Math.random() * Object.keys(blaanDatabase).length)
                ];
                const randomLesson = blaanDatabase[randomCategory][
                    Math.floor(Math.random() * blaanDatabase[randomCategory].length)
                ];
                if (!options.includes(randomLesson.english)) {
                    options.push(randomLesson.english);
                }
            }
            
            // Shuffle options
            return shuffleArray(options);
        }

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        function loadLesson() {
            gameState.answered = false;
            const lesson = gameState.currentLesson;
            
            // Generate question type (50% chance for each)
            const questionType = Math.random() > 0.5 ? 'meaning' : 'translation';
            
            let questionText, options, correctIndex;
            
            if (questionType === 'meaning') {
                // Question: What does [Blaan word] mean?
                questionText = `What does "${lesson.blaan}" mean?`;
                options = generateOptions(lesson.english, lesson.category);
                correctIndex = options.indexOf(lesson.english);
            } else {
                // Question: How do you say [English word] in Blaan?
                questionText = `How do you say "${lesson.english}" in Blaan?`;
                options = generateOptions(lesson.blaan, lesson.category);
                correctIndex = options.indexOf(lesson.blaan);
            }
            
            gameContainer.innerHTML = `
                <div class="category-tag">${lesson.category}</div>
                <div class="word-display">
                    <div class="blaan-text">${questionType === 'meaning' ? lesson.blaan : lesson.english}</div>
                    ${questionType === 'meaning' ? `<div class="pronunciation">${lesson.pronunciation}</div>` : ''}
                </div>
                <div class="question">${questionText}</div>
                <div class="options-grid">
                    ${options.map((option, index) => `
                        <button class="option-btn" onclick="checkAnswer(${index}, ${correctIndex})">
                            ${option}
                        </button>
                    `).join('')}
                </div>
                <div class="hint-section">
                    <button class="hint-btn" onclick="toggleHint()">
                        <i class="fas fa-lightbulb"></i> Show Hint
                    </button>
                    <div class="hint-text" id="hint">💡 ${lesson.example}</div>
                </div>
            `;
            
            // Add fade-in animation
            gameContainer.classList.add('fade-in');
        }

        function checkAnswer(selectedIndex, correctIndex) {
            if (gameState.answered) return;
            gameState.answered = true;
            
            const optionButtons = document.querySelectorAll('.option-btn');
            const hintBtn = document.querySelector('.hint-btn');
            
            // Disable all buttons
            optionButtons.forEach(btn => btn.disabled = true);
            if (hintBtn) hintBtn.disabled = true;
            
            if (selectedIndex === correctIndex) {
                // Correct answer
                optionButtons[selectedIndex].classList.add('correct');
                showFeedback("Correct! 🎉", "correct");
                
                // Update game state
                const xpEarned = 10 + Math.floor(gameState.streak / 2);
                gameState.xp += xpEarned;
                gameState.streak++;
                gameState.lessonsCompleted++;
                
                // Check for perfect lesson (no hearts lost)
                if (gameState.hearts === 3) {
                    gameState.perfectLessons++;
                    checkAchievement("perfect_lesson");
                }
                
                // Check for all categories played
                if (gameState.categoriesPlayed.size >= Object.keys(blaanDatabase).length) {
                    checkAchievement("all_categories");
                }
                
                // Check for first lesson achievement
                if (gameState.lessonsCompleted === 1) {
                    checkAchievement("first_lesson");
                }
                
                // Check for streak achievement
                if (gameState.streak === 5) {
                    checkAchievement("streak_5");
                }
                
                // Level up if enough XP
                if (gameState.xp >= gameState.level * 100) {
                    gameState.level++;
                    showLevelUpMessage();
                } else {
                    // Move to next question after delay
                    setTimeout(() => {
                        getRandomLesson();
                        loadLesson();
                        updateStats();
                    }, 1500);
                }
            } else {
                // Wrong answer
                optionButtons[selectedIndex].classList.add('wrong');
                optionButtons[correctIndex].classList.add('correct');
                showFeedback("Try again! 💡", "wrong");
                
                // Update game state
                gameState.hearts--;
                gameState.streak = 0;
                
                if (gameState.hearts <= 0) {
                    // Game over
                    setTimeout(showGameOver, 1500);
                } else {
                    // Next question after delay
                    setTimeout(() => {
                        getRandomLesson();
                        loadLesson();
                        updateStats();
                    }, 1500);
                }
            }
            
            updateStats();
        }

        function showFeedback(message, type) {
            feedbackEl.textContent = message;
            feedbackEl.className = `feedback ${type}`;
            feedbackEl.style.display = 'block';
            
            setTimeout(() => {
                feedbackEl.style.display = 'none';
            }, 1500);
        }

        function showLevelUpMessage() {
            gameContainer.innerHTML = `
                <div class="game-over">
                    <h2>Level Up! 🎉</h2>
                    <p>You've reached level ${gameState.level}!</p>
                    
                    ${gameState.level === 5 ? `
                        <p style="color: var(--warning); font-weight: 600; margin-top: 20px;">
                            <i class="fas fa-medal"></i> New Achievement Unlocked!
                        </p>
                    ` : ''}
                    
                    <button class="restart-btn" onclick="getRandomLesson(); loadLesson();">
                        Continue Learning
                    </button>
                </div>
            `;
            
            // Check for level achievement
            if (gameState.level === 5) {
                checkAchievement("level_5");
            }
        }

        function toggleHint() {
            const hint = document.getElementById('hint');
            const hintBtn = document.querySelector('.hint-btn');
            
            if (hint.style.display === 'block') {
                hint.style.display = 'none';
                hintBtn.innerHTML = '<i class="fas fa-lightbulb"></i> Show Hint';
            } else {
                hint.style.display = 'block';
                hintBtn.innerHTML = '<i class="fas fa-eye-slash"></i> Hide Hint';
            }
        }

        function showGameOver() {
            gameContainer.innerHTML = `
                <div class="game-over">
                    <h2>Game Over!</h2>
                    <p>You reached level ${gameState.level}</p>
                    <p>Lessons completed: ${gameState.lessonsCompleted}</p>
                    <p>Perfect lessons: ${gameState.perfectLessons}</p>
                    <p>Longest streak: ${gameState.streak}</p>
                    <button class="restart-btn" onclick="restartGame()">
                        <i class="fas fa-redo"></i> Try Again
                    </button>
                </div>
            `;
        }

        function restartGame() {
            gameState.hearts = 3;
            
            getRandomLesson();
            loadLesson();
            updateStats();
        }

        function checkAchievement(achievementId) {
            const achievement = achievements.find(a => a.id === achievementId);
            
            if (!achievement || achievement.unlocked) return;
            
            achievement.unlocked = true;
            gameState.xp += achievement.xpReward;
            gameState.achievementsUnlocked++;
            
            // Show achievement badge
            achievementTitle.textContent = achievement.title;
            achievementDesc.textContent = achievement.description;
            achievementBadge.style.display = 'block';
            
            updateStats();
            saveGameState();
        }

        function hideAchievement() {
            achievementBadge.style.display = 'none';
            getRandomLesson();
            loadLesson();
        }

        function populateLeaderboard() {
            // Sort leaderboard by level then XP
            const sortedLeaderboard = [...leaderboardData].sort((a, b) => {
                if (b.level !== a.level) return b.level - a.level;
                return b.xp - a.xp;
            });
            
            // Update current player's data
            const currentPlayerIndex = sortedLeaderboard.findIndex(p => p.name === "Player One");
            if (currentPlayerIndex !== -1) {
                sortedLeaderboard[currentPlayerIndex].level = gameState.level;
                sortedLeaderboard[currentPlayerIndex].xp = gameState.xp;
            }
            
            // Re-sort after updating
            sortedLeaderboard.sort((a, b) => {
                if (b.level !== a.level) return b.level - a.level;
                return b.xp - a.xp;
            });
            
            // Render leaderboard
            leaderboardList.innerHTML = sortedLeaderboard.map((player, index) => `
                <li class="leaderboard-item">
                    <div class="leaderboard-rank">${index + 1}</div>
                    <div class="leaderboard-user">
                        <div class="leaderboard-avatar">${player.avatar}</div>
                        <div class="leaderboard-name">${player.name}</div>
                    </div>
                    <div class="leaderboard-score">Lvl ${player.level}</div>
                </li>
            `).join('');
        }

        function showLeaderboard() {
            populateLeaderboard();
            leaderboardModal.classList.add('active');
        }

        function hideLeaderboard() {
            leaderboardModal.classList.remove('active');
        }

        function logout() {
            // Save player name
            localStorage.setItem('blaanPlayerName', gameState.playerName);
            
            // Redirect to login page (simulated)
            alert('Logging out...');
            window.location.href = "#";
        }

        // For demonstration: Change player name
        function changePlayerName() {
            const newName = prompt("Enter your name:", gameState.playerName);
            if (newName && newName.trim() !== "") {
                gameState.playerName = newName.trim();
                playerNameEl.textContent = gameState.playerName;
                localStorage.setItem('blaanPlayerName', gameState.playerName);
            }
        }

        // Attach click event to player name for changing it
        playerNameEl.addEventListener('click', changePlayerName);
    </script>
</body>
</html><?php /**PATH G:\xampp\htdocs\Blaan_Multi_Role\resources\views/basicLevel.blade.php ENDPATH**/ ?>