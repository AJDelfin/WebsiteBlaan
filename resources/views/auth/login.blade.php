<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <!-- Main Container -->
    <div class="max-w-md w-full mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8 space-y-6">
        <!-- School Branding -->
        <div class="flex flex-col items-center space-y-3">
            <div class="p-2 bg-white rounded-full shadow-sm">
                <img src="{{ asset('images/MaligyaElemSchool.jpg') }}" 
                     alt="Maligya Elementary School Logo" 
                     class="h-16 w-auto object-cover rounded-full">
            </div>
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-800">Maligya Elementary School</h1>
                <p class="text-sm text-indigo-600 font-medium">Student Learning Portal</p>
            </div>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            
            <!-- Form Header -->
            <div class="text-center">
                <h2 class="text-xl font-semibold text-gray-800">Welcome Back!</h2>
                <p class="text-sm text-gray-500 mt-1">Sign in to access your learning resources</p>
            </div>

            <!-- Email Field -->
            <div class="space-y-1">
                <x-input-label for="email" :value="__('Student Email')" class="text-sm font-medium text-gray-700" />
                <x-text-input 
                    id="email" 
                    class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" 
                    placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm" />
            </div>

            <!-- Password Field -->
            <div class="space-y-1">
                <div class="flex items-center justify-between">
                    <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-indigo-600 hover:text-indigo-500 font-medium">
                        {{ __('Forgot password?') }}
                    </a>
                    @endif
                </div>
                <x-text-input 
                    id="password" 
                    class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password" 
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" name="remember">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                    {{ __('Keep me signed in') }}
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                {{ __('Sign in as Student') }}
            </button>
        </form>

        <!-- Footer Links -->
        <div class="text-center text-sm text-gray-500 space-y-2">
            <p>Don't have an account? <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Contact administration</a></p>
            <a href="{{ url('/') }}" class="inline-block text-indigo-600 hover:text-indigo-500 font-medium">
                ← Return to homepage
            </a>
        </div>
    </div>
</x-guest-layout>