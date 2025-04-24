<x-guest-layout>
    <!-- Main Container -->
    <div class="max-w-md w-full mx-auto bg-white rounded-xl shadow-lg overflow-hidden p-8 space-y-6">
        <!-- School Branding -->
        <div class="flex flex-col items-center space-y-3">
            <div class="p-2 bg-white rounded-full shadow-sm">
                <img src="{{ asset('images/MaligyaElemSchool.jpg') }}" 
                     alt="Maligya Elementary School Logo" 
                     class="h-16 w-auto object-cover rounded-full">
            </div>
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-800">Maligya Elementary School</h1>
                <p class="text-sm text-indigo-600 font-medium">Teacher Portal</p>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form Tabs -->
        <div class="flex border-b border-gray-200">
            <a href="{{ route('teacher.login') }}" class="flex-1 py-2 px-4 text-center font-medium text-indigo-600 border-b-2 border-indigo-600">
                Sign In
            </a>
            <a href="{{ route('teacher.register') }}" class="flex-1 py-2 px-4 text-center font-medium text-gray-500 hover:text-gray-700">
                Register
            </a>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('teacher.login') }}" class="space-y-5">
            @csrf
            
            <!-- Form Header -->
            <div class="text-center">
                <h2 class="text-xl font-semibold text-gray-800">Teacher Login</h2>
                <p class="text-sm text-gray-500 mt-1">Access your teaching dashboard</p>
            </div>

            <!-- Email Field -->
            <div class="space-y-1">
                <x-input-label for="email" :value="__('School Email')" class="text-sm font-medium text-gray-700" />
                <x-text-input 
                    id="email" 
                    class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="email" 
                    placeholder="Email " />
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
                    {{ __('Remember this device') }}
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-2">
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    ← Return to homepage
                </a>

                <x-primary-button class="px-6 py-2.5">
                    {{ __('Sign In') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Additional Help -->
        <div class="text-center text-xs text-gray-400 pt-4 border-t border-gray-100">
            <p>Need help with your account? <a href="#" class="text-indigo-600 hover:text-indigo-500">Contact IT Support</a></p>
        </div>
    </div>
</x-guest-layout>