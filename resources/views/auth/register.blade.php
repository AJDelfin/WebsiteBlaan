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
                <p class="text-sm text-indigo-600 font-medium">Student Registration</p>
            </div>
        </div>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            
            <!-- Form Header -->
            <div class="text-center">
                <h2 class="text-xl font-semibold text-gray-800">Create Your Account</h2>
                <p class="text-sm text-gray-500 mt-1">Join our learning community</p>
            </div>

            <!-- Name Field -->
            <div class="space-y-1">
                <x-input-label for="name" :value="__('Full Name')" class="text-sm font-medium text-gray-700" />
                <x-text-input 
                    id="name" 
                    class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition"
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name" 
                    placeholder=" " />
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm" />
            </div>

            <!-- Email Field -->
            <div class="space-y-1">
                <x-input-label for="email" :value="__('Email Address')" class="text-sm font-medium text-gray-700" />
                <x-text-input 
                    id="email" 
                    class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autocomplete="email" 
                    placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm" />
            </div>

            <!-- Password Field -->
            <div class="space-y-1">
                <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                <x-text-input 
                    id="password" 
                    class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition"
                    type="password"
                    name="password"
                    required 
                    autocomplete="new-password" 
                    placeholder="At least 8 characters" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm" />
            </div>

            <!-- Confirm Password Field -->
            <div class="space-y-1">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-medium text-gray-700" />
                <x-text-input 
                    id="password_confirmation" 
                    class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition"
                    type="password"
                    name="password_confirmation"
                    required 
                    autocomplete="new-password" 
                    placeholder="Re-enter your password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                {{ __('Create Account') }}
            </button>

            <!-- Already Registered Link -->
            <div class="text-center text-sm text-gray-500">
                <p>Already have an account? 
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Sign in here
                    </a>
                </p>
            </div>
        </form>

        <!-- Footer Links -->
        <div class="text-center text-xs text-gray-400">
            <p>By registering, you agree to our <a href="#" class="underline">Terms of Service</a></p>
            <a href="{{ url('/') }}" class="inline-block mt-2 text-indigo-600 hover:text-indigo-500 font-medium">
                ← Return to homepage
            </a>
        </div>
    </div>
</x-guest-layout>