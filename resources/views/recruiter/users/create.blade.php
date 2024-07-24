<div class="w-full py-6">

    <x-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('recruiter.create') }}">
        @csrf

        <div class="mt-2 flex">
            <div class="w-1/2 mr-2">
                <x-label for="first_name" value="First Name" />
                <x-input id="first_name" class="block w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            </div>
            <div class=" w-1/2 ml-2">
                <x-label for="last_name" value="Last Name" />
                <x-input id="last_name" class="block w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            </div>
        </div>

        <div class="mt-2 flex">
            <div class="w-1/2 mr-2">
                <x-label for="password" value="Password" />
                <x-input id="password" class="blockw-full" type="password" name="password" required autocomplete="new-password" />
            </div>
            <div class=" w-1/2 ml-2">
                <x-label for="password_confirmation" value="Confirm Password" />
                <x-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
        </div>

        <div class="mt-2 flex">
            <div class="w-1/2 mr-2">
                <x-label for="email" value="Email" />
                <x-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
            <div class=" w-1/2 ml-2">
                <button type="submit" class="inline-flex items-center rounded-full font-bold px-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms] mx-auto mt-8 h-12">
                    Create
                </button>
            </div>
        </div>

    </form>
</div>