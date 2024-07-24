<x-guest-layout>
    @if (session()->has('message'))
        @include('messages.' . session('message')['type'], ['message' => session('message')['text']])
    @endif
    <x-authentication-card>
        <div class="border-b border-slate-200 dark:border-neutral-700 mb-16">
            <nav class="-mb-0.5 flex justify-center space-x-6" aria-label="Tabs" role="tablist">
                <button type="button" class="text-xl active hs-tab-active:font-semibold hs-tab-active:border-blue-violet-600 hs-tab-active:text-blue-violet-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-slate-500 hover:text-blue-violet-600 focus:outline-none focus:text-blue-violet-600"
                    id="jobseeker-tab" data-hs-tab="#jobseeker-registration"
                    aria-controls="jobseeker-registration" role="tab">
                    Jobseeker Registration
                </button>
            </nav>
        </div>
        <div class="mt-3">
            <div id="jobseeker-registration" role="tabpanel" aria-labelledby="jobseeker-tab" class="tab-panel active">
                <x-slot name="logo">
                    <x-authentication-card-logo />
                </x-slot>
                <x-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('register') }}">
                    @csrf
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
                <p class="w-full text-center mx-auto mt-6 mb-2">Register another way:</p>
                <div class="max-w-md mx-auto">
                    <div class="flex justify-center items-center">
                        <!-- Login with Facebook -->
                        <a class="mx-2" href="{{ url('/auth/facebook') }}">
                            <!-- Facebook -->
                            <span class="[&>svg]:h-7 [&>svg]:w-7 [&>svg]:fill-[#1877f2]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                                    <path
                                        d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z" />
                                </svg>
                            </span>
                        </a>
                        <!-- Login with Google -->
                        <a class="mx-2" href="{{ url('/auth/google') }}">
                            <!-- Google -->
                            <span class="[&>svg]:h-7 [&>svg]:w-7 [&>svg]:fill-[#ea4335]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                                    <path
                                        d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                                </svg>
                            </span>
                        </a>
                        <!-- Login with Twitter -->
                        <a class="mx-2" href="{{ url('/auth/twitter') }}">
                            <!-- X -->
                            <span class="[&>svg]:h-7 [&>svg]:w-7 [&>svg]:fill-black">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512">
                                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                                    <path
                                        d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </x-authentication-card>
    </div>
</x-guest-layout>