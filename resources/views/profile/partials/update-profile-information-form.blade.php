<section class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="flex items-start space-x-4 mb-6">
            <div class="shrink-0 p-2 bg-indigo-50 rounded-lg">
                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    {{ __('Profile Details') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Update your personal information and email address.') }}
                </p>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <x-input-label for="name" :value="__('Full Name')" class="block text-sm font-medium text-gray-700 mb-1" />
                <div class="relative">
                    <x-text-input 
                        id="name" 
                        name="name" 
                        type="text" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2.5 px-4"
                        :value="old('name', $user->name)" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Enter your full name"
                    />
                    <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('name')" />
                </div>
            </div>

            <div>
                <x-input-label for="email" :value="__('Email Address')" class="block text-sm font-medium text-gray-700 mb-1" />
                <div class="relative">
                    <x-text-input 
                        id="email" 
                        name="email" 
                        type="email" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2.5 px-4"
                        :value="old('email', $user->email)" 
                        required 
                        autocomplete="email"
                        placeholder="Enter your email address"
                    />
                    <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('email')" />
                </div>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4 p-3 bg-yellow-50 rounded-md border border-yellow-100">
                        <div class="flex">
                            <svg class="h-5 w-5 text-yellow-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div>
                                <p class="text-sm text-yellow-700">
                                    {{ __('Your email address is unverified.') }}
                                </p>
                                <button 
                                    form="send-verification" 
                                    class="mt-1 text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200"
                                >
                                    {{ __('Click to resend verification email') }}
                                </button>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-sm font-medium text-green-600">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center justify-between pt-4">
            <div>
                @if (session('status') === 'profile-updated')
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 3000)"
                        class="flex items-center text-sm font-medium text-green-600"
                    >
                        <svg class="h-5 w-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Profile updated successfully!') }}
                    </div>
                @endif
            </div>
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2.5 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
            >
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ __('Update Profile') }}
            </button>
        </div>
    </form>
</section>