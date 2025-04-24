<section class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-4">
            <div>
                <x-input-label for="update_password_current_password" :value="__('Current Password')" class="block text-sm font-medium text-gray-700 mb-1" />
                <div class="relative">
                    <x-text-input 
                        id="update_password_current_password" 
                        name="current_password" 
                        type="password" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2.5 px-4"
                        autocomplete="current-password"
                        placeholder="Enter your current password"
                    />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-sm text-red-600" />
                </div>
            </div>

            <div>
                <x-input-label for="update_password_password" :value="__('New Password')" class="block text-sm font-medium text-gray-700 mb-1" />
                <div class="relative">
                    <x-text-input 
                        id="update_password_password" 
                        name="password" 
                        type="password" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2.5 px-4"
                        autocomplete="new-password"
                        placeholder="Create a new password"
                    />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-sm text-red-600" />
                </div>
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm New Password')" class="block text-sm font-medium text-gray-700 mb-1" />
                <div class="relative">
                    <x-text-input 
                        id="update_password_password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2.5 px-4"
                        autocomplete="new-password"
                        placeholder="Re-enter your new password"
                    />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                </div>
            </div>
        </div>

        <div class="pt-4">
            <div class="flex items-start space-x-4 bg-blue-50 p-4 rounded-lg mb-4">
                <div class="shrink-0 pt-0.5">
                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div class="text-sm text-gray-600">
                    <p>{{ __('Use a strong, unique password to protect your account. We recommend a mix of letters, numbers, and symbols.') }}</p>
                    <p class="mt-1 text-xs text-gray-500">{{ __('Minimum 8 characters with at least one uppercase, one lowercase, and one number.') }}</p>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    @if (session('status') === 'password-updated')
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
                            {{ __('Password updated successfully!') }}
                        </div>
                    @endif
                </div>
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2.5 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                >
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('Update Password') }}
                </button>
            </div>
        </div>
    </form>
</section>