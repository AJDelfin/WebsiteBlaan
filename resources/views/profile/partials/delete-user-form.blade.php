<section class="space-y-6">
    <div class="flex flex-col space-y-4">
        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="flex items-center px-4 py-2.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors duration-200 shadow-sm w-full sm:w-auto justify-center"
        >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            {{ __('Delete My Account') }}
        </button>

        <div class="bg-white p-4 rounded-lg shadow-sm border border-red-100">
            <div class="flex items-start">
                <div class="shrink-0 pt-0.5">
                    <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">
                        {{ __('Once deleted, your account and all associated data will be permanently removed. We recommend downloading any important information before proceeding.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-6">
            <div class="flex items-start">
                <div class="shrink-0 pt-0.5">
                    <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-semibold text-gray-900">
                        {{ __('Confirm Account Deletion') }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ __('This action cannot be undone. All your data will be permanently erased. To confirm, please enter your password below.') }}
                    </p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="mt-6">
                @csrf
                @method('delete')

                <div class="space-y-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Current Password') }}
                        </label>
                        <div class="relative">
                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="block w-full rounded-md shadow-sm border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50"
                                placeholder="{{ __('Enter your password') }}"
                                required
                            />
                        </div>
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <button
                        type="button"
                        x-on:click="$dispatch('close')"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                    >
                        {{ __('Cancel') }}
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                    >
                        {{ __('Permanently Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>