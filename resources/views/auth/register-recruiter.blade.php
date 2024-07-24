<x-guest-layout>
    @if (session()->has('message'))
        @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
    @endif
    <x-authentication-card>
        <div class="border-b border-slate-200 dark:border-neutral-700 mb-16">
            <nav class="-mb-0.5 flex justify-center space-x-6" aria-label="Tabs" role="tablist">
                <button type="button" class="text-xl active hs-tab-active:font-semibold hs-tab-active:border-blue-violet-600 hs-tab-active:text-blue-violet-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-slate-500 hover:text-blue-violet-600 focus:outline-none focus:text-blue-violet-600"
                    id="recruiter-tab" data-hs-tab="#recruiter-registration"
                    aria-controls="recruiter-registration" role="tab">
                    Recruiter Registration
                </button>
            </nav>
        </div>
        <div class="mt-3">
            <div id="recruiter-registration" role="tabpanel" aria-labelledby="recruiter-tab" class="tab-panel active">
                <x-slot name="logo">
                    <x-authentication-card-logo />
                </x-slot>
                <x-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="hidden" name="recruiter" value="true" />
                    <div class="mt-4">
                        <x-label for="first_name" value="{{ __('First Name') }}" />
                        <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')"
                            required autofocus autocomplete="first_name" />
                    </div>
                    <div class="mt-4">
                        <x-label for="last_name" value="{{ __('Last Name') }}" />
                        <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"
                            required autofocus autocomplete="last_name" />
                    </div>
                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                            required autocomplete="username" />
                    </div>
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                    </div>
                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                    </div>
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-8">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <div class="text-center w-full">
                                        <x-checkbox name="terms" id="terms" required class="mr-2" />
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' =>
                                                '<a target="_blank" href="' .
                                                route('terms.show') .
                                                '" class="underline text-sm text-slate-600 hover:text-slate-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-red-600">' .
                                                __('Terms of Service') .
                                                '</a>',
                                            'privacy_policy' =>
                                                '<a target="_blank" href="' .
                                                route('policy.show') .
                                                '" class="underline text-sm text-slate-600 hover:text-slate-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cerise-red-600">' .
                                                __('Privacy Policy') .
                                                '</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif
                    <div class="flex items-center justify-end mt-8">
                        <x-button class="mx-auto">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </x-authentication-card>
    </div>
</x-guest-layout>