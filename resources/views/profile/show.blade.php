<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-[75rem] mx-auto px-6 pt-20 sm:pb-12 lg:pb-24">
            @livewire('profile.update-profile-information-form')

            <div class="hidden sm:block">
                <div class="py-8">
                    <div class="border-t border-slate-50"></div>
                </div>
            </div>

            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>

            <div class="hidden sm:block">
                <div class="py-8">
                    <div class="border-t border-slate-50"></div>
                </div>
            </div>

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            <div class="hidden sm:block">
                <div class="py-8">
                    <div class="border-t border-slate-50"></div>
                </div>
            </div>

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
