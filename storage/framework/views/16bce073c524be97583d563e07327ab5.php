<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translate - Indigenous Learn</title>
    <style>
        :root {
            --primary: #2C5530;
            --secondary: #8B4513;
            --accent: #E86F52;
            --background: #FAF6F1;
            --text: #333333;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            --card-shadow-hover: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
            padding-top: 90px;
        }

        header {
            background-color: white;
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            height: 90px;
            display: flex;
            justify-content: center;
        }

        .nav-container {
            max-width: 1200px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .school-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: 50px;
        }

        .school-logo {
            height: 60px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }

        .school-info {
            display: flex;
            flex-direction: column;
        }

        .school-name {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--primary);
            line-height: 1.2;
        }

        .school-district {
            font-size: 0.8rem;
            color: var(--secondary);
        }

        nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        nav a {
            font-size: 16px;
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: rgba(44, 85, 48, 0.1);
        }

        nav a.active {
            background-color: var(--primary);
            color: white;
        }

        .logout-btn {
            background-color: transparent;
            border: none;
            font-size: 16px;
            color: var(--text);
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: inherit;
        }

        .logout-btn:hover {
            background-color: rgba(232, 111, 82, 0.1);
            color: var(--accent);
        }

        .hamburger {
            display: block;
            cursor: pointer;
            padding: 10px;
            position: fixed;
            left: 5px;
            top: 15px;
            z-index: 1100;
            background: white;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: var(--primary);
            margin: 5px 0;
            transition: all 0.3s ease;
        }

        .sidebar {
            width: 250px;
            background-color: white;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 90px;
            left: 0;
            bottom: 0;
            padding: 20px;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 999;
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
            position: relative;
        }

        .sidebar-menu a {
            display: block;
            padding: 10px 15px;
            color: var(--text);
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .sidebar-menu a:hover {
            background-color: rgba(44, 85, 48, 0.1);
        }

        .sidebar-menu a.active {
            background-color: var(--primary);
            color: white;
        }

        .dropdown-menu {
            list-style: none;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            padding-left: 15px;
        }

        .dropdown-menu.show {
            max-height: 500px;
        }

        .dropdown-menu a {
            padding: 8px 15px;
            font-size: 0.9rem;
        }

        .dropdown-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown-toggle::after {
            content: '+';
            font-size: 1.2rem;
            transition: transform 0.3s;
        }

        .dropdown-toggle.active::after {
            content: '-';
        }

        .main-content {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s ease;
            max-width: 1200px;
            margin: 0 auto;
        }

        .sidebar.show + .main-content {
           margin-left: 250px;
           max-width: calc(1200px - 250px);
        }

        .translate-container {
            max-width: 1000px;
            margin: 20px auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: box-shadow 0.3s ease;
        }

        .translate-container:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .translate-container h2 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .translation-controls {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .language-selector {
            flex: 1;
            position: relative;
        }

        .language-selector label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--primary);
        }

        .language-selector select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            background: white;
            color: var(--text);
            transition: border-color 0.3s;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 1em;
        }

        .language-selector select:focus {
            outline: none;
            border-color: var(--primary);
        }

        .input-container {
            position: relative;
            margin-bottom: 20px;
        }

        .input-container textarea {
            width: 100%;
            min-height: 120px;
            padding: 16px;
            font-size: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            resize: none;
            transition: border-color 0.3s;
            background-color: white;
        }

        .input-container textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        .input-tools {
            position: absolute;
            right: 10px;
            bottom: 10px;
            display: flex;
            gap: 10px;
        }

        .tool-button {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .tool-button:hover {
            background: #f8fafc;
            transform: translateY(-2px);
        }

        .translation-results {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .language-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #e2e8f0;
        }

        .language-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }

        .language-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .language-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
        }

        .play-button {
            background: #f8fafc;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .play-button:hover {
            background: #f1f5f9;
        }

        .translation-content {
            margin-top: 15px;
        }

        .translation-text {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 15px;
            padding: 10px;
            background: #f8fafc;
            border-radius: 8px;
        }

        .brute-force-notice {
            font-size: 0.9rem;
            color: #666;
            font-style: italic;
            margin-top: -10px;
            margin-bottom: 15px;
        }

        .translation-detail {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f1f5f9;
        }

        .detail-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--primary);
        }

        .detail-content {
            font-size: 0.95rem;
            line-height: 1.5;
            color: #4b5563;
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(44, 85, 48, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .sidebar.show + .main-content {
                margin-left: 0;
                max-width: 100%;
            }
        
            body.sidebar-open {
                overflow-x: hidden;
                position: relative;
            }
            
            .translation-controls {
                flex-direction: column;
                gap: 15px;
            }
            
            .translation-results {
                grid-template-columns: 1fr;
            }
            
            .translate-container {
                padding: 20px;
            }

            .school-name {
                font-size: 1rem;
            }

            nav {
                gap: 10px;
            }

            nav a, .logout-btn {
                font-size: 14px;
                padding: 6px 8px;
            }

            .school-brand {
                margin-left: 40px;
                gap: 10px;
            }

            .school-logo {
                height: 50px;
            }
        }

        @media (max-width: 480px) {
            .school-brand {
                margin-left: 45px;
            }

            .school-info {
                display: none;
            }

            .school-logo {
                height: 40px;
            }

            nav {
                display: none;
            }
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }
    </style>
</head>

<body>
    <header>
        <div class="nav-container">
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="school-brand">
                <img src="<?php echo e(asset('images/MaligyaElemSchool.jpg')); ?>" alt="School Logo" class="school-logo">
                <div class="school-info">
                    <div class="school-name">Maligya Elementary School</div>
                    <div class="school-district">South Fatima District</div>
                </div>
            </div>
            <nav>
                <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                <a href="<?php echo e(route('translate')); ?>" class="active">Translate</a>
                <a href="<?php echo e(route('features')); ?>">Features</a>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="logout-btn">
                        Logout
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <aside class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li><a href="#">Dashboard</a></li>
            <li>
                <a href="#" class="dropdown-toggle">Translation</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Text Translation</a></li>
                    <li><a href="#">Image Translation</a></li>
                    <li><a href="#">Voice Translation</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">Vocabulary</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Word Lists</a></li>
                    <li><a href="#">Flashcards</a></li>
                    <li><a href="#">Saved Words</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">Lessons</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Beginner</a></li>
                    <li><a href="#">Intermediate</a></li>
                    <li><a href="#">Advanced</a></li>
                </ul>
            </li>
            <li><a href="#">Practice</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="translate-container">
            <h2>Translate Languages</h2>
            
            <div class="translation-controls">
                <div class="language-selector">
                    <label for="source-language">From Language</label>
                    <select id="source-language">
                        <option value="en">English</option>
                        <option value="tl">Tagalog</option>
                        <option value="blaan">Blaan</option>
                    </select>
                </div>
            </div>
            
            <div class="input-container">
                <textarea id="text-to-translate" placeholder="Enter text to translate..."></textarea>
                <div class="input-tools">
                    <button class="tool-button" title="Clear text" onclick="clearText()">
                        ✕
                    </button>
                    <button class="tool-button" title="Speech to text" onclick="startSpeechToText()">
                        🎤
                    </button>
                    <button class="tool-button" title="Text to speech" onclick="textToSpeech('input')">
                     🔊
                    </button>
                </div>
            </div>
            
            <div class="translation-results" id="translation-results">
                <!-- Dynamically generated translation cards will appear here -->
            </div>
        </div>
    </main>

    <script>
     // Language data and target language mapping
const languages = {
    'en': { name: 'English', speechCode: 'en-US', targets: ['tl', 'blaan'] },
    'tl': { name: 'Tagalog', speechCode: 'fil-PH', targets: ['en', 'blaan'] },
    'blaan': { name: 'Blaan', speechCode: 'en-US', targets: ['en', 'tl'] }
};

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    updateTranslationCards();
    
    document.getElementById('text-to-translate').addEventListener('input', translateText);
    document.getElementById('source-language').addEventListener('change', function() {
        updateTranslationCards();
        translateText();
    });

    // Initialize speech recognition if available
    initializeSpeechRecognition();
    
    // Hamburger menu functionality
    document.getElementById('hamburger').addEventListener('click', function() {
        this.classList.toggle('active');
        document.getElementById('sidebar').classList.toggle('show');
    });

    // Dropdown menu functionality
    document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const menu = this.nextElementSibling;
            menu.classList.toggle('show');
            this.classList.toggle('active');
        });
    });
});

function updateTranslationCards() {
    const sourceLang = document.getElementById('source-language').value;
    const resultsContainer = document.getElementById('translation-results');
    resultsContainer.innerHTML = '';
    
    // Only show the two target languages for the selected source
    languages[sourceLang].targets.forEach(targetCode => {
        const langData = languages[targetCode];
        const card = document.createElement('div');
        card.className = 'language-card';
        card.innerHTML = `
            <div class="language-header">
                <div class="language-title">
                    ${langData.name}
                </div>
                <button class="play-button" onclick="speakText('', '${targetCode}')">
                    🔊
                </button>
            </div>
            <div class="translation-content">
                <div class="translation-text" id="${targetCode}-output">Translation will appear here</div>
                <div class="brute-force-notice" id="${targetCode}-notice"></div>
                <div id="${targetCode}-breakdown"></div>
                <div class="translation-detail">
                    <div class="detail-title">
                        Meaning
                    </div>
                    <div class="detail-content" id="${targetCode}-meaning">Meaning will appear here</div>
                </div>
                <div class="translation-detail">
                    <div class="detail-title">
                        Example
                    </div>
                    <div class="detail-content" id="${targetCode}-example">Example sentence will appear here</div>
                </div>
            </div>
        `;
        resultsContainer.appendChild(card);
    });
}

function clearText() {
    document.getElementById('text-to-translate').value = "";
    resetTranslationCards();
}

function resetTranslationCards() {
    const sourceLang = document.getElementById('source-language').value;
    languages[sourceLang].targets.forEach(targetCode => {
        document.getElementById(`${targetCode}-output`).textContent = 'Translation will appear here';
        document.getElementById(`${targetCode}-notice`).textContent = '';
        document.getElementById(`${targetCode}-meaning`).textContent = 'Meaning will appear here';
        document.getElementById(`${targetCode}-example`).textContent = 'Example sentence will appear here';
        document.getElementById(`${targetCode}-breakdown`).innerHTML = '';
    });
}

function isSingleWord(text) {
    return text.trim().split(/\s+/).length === 1;
}

async function translateText() {
    const text = document.getElementById('text-to-translate').value.trim().toLowerCase();
    const sourceLanguage = document.getElementById('source-language').value;

    if (!text) {
        resetTranslationCards();
        return;
    }

    // Show loading state for target languages
    languages[sourceLanguage].targets.forEach(targetCode => {
        document.getElementById(`${targetCode}-output`).innerHTML = '<span class="loading-spinner"></span> Translating...';
        document.getElementById(`${targetCode}-notice`).textContent = '';
        document.getElementById(`${targetCode}-meaning`).textContent = 'Loading...';
        document.getElementById(`${targetCode}-example`).textContent = 'Loading...';
        document.getElementById(`${targetCode}-breakdown`).innerHTML = '';
    });

    // Translate to each target language
    for (const targetLanguage of languages[sourceLanguage].targets) {
        try {
            const direction = `${sourceLanguage}_to_${targetLanguage}`;
            
            // First try direct translation (for both single words and phrases)
            const directResult = await fetchTranslation(text, direction);
            
            if (directResult && !directResult.error && directResult.translation) {
                document.getElementById(`${targetLanguage}-output`).textContent = directResult.translation;
                
                if (isSingleWord(text)) {
                    document.getElementById(`${targetLanguage}-notice`).textContent = '';
                    document.getElementById(`${targetLanguage}-meaning`).textContent = 
                        directResult.definition || "Direct translation from dictionary";
                    document.getElementById(`${targetLanguage}-example`).textContent = 
                        directResult.example || "Example usage from dictionary";
                } else {
                    // For phrases, show additional information
                    document.getElementById(`${targetLanguage}-notice`).innerHTML = 
                        '<span class="translation-method">Phrase translation</span>';
                    document.getElementById(`${targetLanguage}-meaning`).textContent = 
                        "This is a direct phrase translation. For word-by-word breakdown, see below.";
                    document.getElementById(`${targetLanguage}-example`).textContent = 
                        "For more accurate results, verify each word individually";
                    
                    // Always show word breakdown for phrases
                    if (directResult.word_details) {
                        showWordPairs(directResult.word_details, targetLanguage);
                    }
                }
            } else {
                // If direct translation fails, try brute force for multiple words
                if (!isSingleWord(text)) {
                    const bruteResult = await fetchTranslation(text, direction);
                    
                    if (bruteResult && bruteResult.translation) {
                        document.getElementById(`${targetLanguage}-output`).textContent = bruteResult.translation;
                        document.getElementById(`${targetLanguage}-notice`).innerHTML = 
                            '<span class="translation-method">Word-by-word translation</span>' + 
                            '<div class="phrase-notice">(May not be grammatically correct)</div>';
                        document.getElementById(`${targetLanguage}-meaning`).textContent = 
                            "This is a word-by-word translation. See breakdown below.";
                        document.getElementById(`${targetLanguage}-example`).textContent = 
                            "For more accurate results, verify each word individually";
                        
                        // Display word breakdown
                        if (bruteResult.word_details) {
                            showWordPairs(bruteResult.word_details, targetLanguage);
                        }
                    } else {
                        throw new Error('No translation found');
                    }
                } else {
                    throw new Error('No translation found');
                }
            }
        } catch (error) {
            console.error(`Translation error (${sourceLanguage} to ${targetLanguage}):`, error);
            document.getElementById(`${targetLanguage}-output`).textContent = 'No translation available';
            document.getElementById(`${targetLanguage}-notice`).textContent = '';
            document.getElementById(`${targetLanguage}-meaning`).textContent = 'Could not translate';
            document.getElementById(`${targetLanguage}-example`).textContent = 'Please try a different word';
        }
    }
}

function showWordPairs(wordPairs, targetLanguage) {
    const breakdownContainer = document.getElementById(`${targetLanguage}-breakdown`);
    
    if (!wordPairs || wordPairs.length === 0) {
        breakdownContainer.innerHTML = '';
        return;
    }
    
    let html = '<div class="word-breakdown"><div class="detail-title">Word-by-word breakdown:</div>';
    
    wordPairs.forEach(pair => {
        html += `
            <div class="word-pair">
                <span class="original-word">${pair.original}</span> ->
                <span class="translated-word">${pair.translated || '(no translation)'}</span>
            </div>
        `;
    });
    
    html += '</div>';
    breakdownContainer.innerHTML = html;
}

async function fetchTranslation(text, direction) {
    try {
        const response = await fetch(`http://127.0.0.1:5002/translate?text=${encodeURIComponent(text)}&direction=${direction}`);
        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
        return await response.json();
    } catch (error) {
        console.error('API Error:', error);
        return null;
    }
}

function speakText(text, lang) {
    if (!text) {
        text = document.getElementById(`${lang}-output`).textContent;
        
        if (text.includes('Translation will appear') || text.includes('No translation')) {
            return;
        }
    }
    
    speechSynthesis.cancel();
    
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = languages[lang]?.speechCode || 'en-US';
    
    speechSynthesis.speak(utterance);
}

function textToSpeech(type) {
    let text, language;
    if (type === 'input') {
        text = document.getElementById('text-to-translate').value.trim();
        language = document.getElementById('source-language').value;
    } else {
        return;
    }

    if (!text) {
        alert("Please enter some text to speak.");
        return;
    }

    speakText(text, language);
}

function initializeSpeechRecognition() {
    const inputField = document.getElementById('text-to-translate');
    
    if (!('webkitSpeechRecognition' in window)) {
        console.warn("Speech recognition not supported");
        return;
    }

    const recognition = new webkitSpeechRecognition();
    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.lang = 'en-US';

    document.getElementById('source-language').addEventListener('change', function() {
        recognition.lang = languages[this.value]?.speechCode || 'en-US';
    });

    window.startSpeechToText = function() {
        try {
            recognition.start();
            inputField.placeholder = "Listening...";
            inputField.value = "";
        } catch (error) {
            console.error("Mic error:", error);
            inputField.placeholder = "Error accessing microphone";
        }
    };

    recognition.onresult = function(event) {
        const transcript = event.results[0][0].transcript;
        inputField.value = transcript;
        inputField.placeholder = "Ready to translate...";
        translateText();
    };

    recognition.onerror = function(event) {
        const errorMessages = {
            'no-speech': 'No speech detected',
            'audio-capture': 'Microphone not available',
            'network': 'Network connection error',
            'not-allowed': 'Microphone access denied'
        };
        inputField.placeholder = errorMessages[event.error] || 'Try again';
    };

    recognition.onend = function() {
        if (!inputField.value) {
            inputField.placeholder = "Enter text to translate...";
        }
    };
}
    </script>
</body>
</html><?php /**PATH G:\xampp\htdocs\Blaan_Multi_Role\resources\views/translate.blade.php ENDPATH**/ ?>