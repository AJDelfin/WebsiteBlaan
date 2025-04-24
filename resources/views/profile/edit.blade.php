<x-app-layout>
    <x-slot name="header">
        <div class="w-full">
            <div class="flex items-center space-x-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button - Fixed on left -->
                <a href="{{ url()->previous() }}" class="flex-shrink-0">
                    <button class="flex items-center space-x-1 bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-lg transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        <span>Back</span>
                    </button>
                </a>
                
                <!-- Title - Fixed beside back button -->
                <h2 class="font-semibold text-xl text-gray-800 leading-tight whitespace-nowrap">
                    {{ __('Personal Information') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>