<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">

        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" id="photo" class="hidden"
                wire:model.live="photo"
                x-ref="photo"
                x-on:change="
                    photoName = $refs.photo.files[0].name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        photoPreview = e.target.result;
                    };
                    reader.readAsDataURL($refs.photo.files[0]);
                " />
            <x-label for="photo" value="{{ __('Profile Photo') }}" />
            <!-- Current Profile Photo -->
            <div class="mt-3" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
            </div>
            <!-- New Profile Photo Preview -->
            <div class="mt-3" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>
            <x-secondary-button class="mt-3 me-2 rounded-2xl" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-secondary-button>
            @if ($this->user->profile_photo_path)
                <x-secondary-button type="button" class="mt-3" wire:click="deleteProfilePhoto">
                    {{ __('Remove Photo') }}
                </x-secondary-button>
            @endif
            <x-input-error for="photo" class="mt-3" />
        </div>

        <!-- First Name -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="first_name" value="{{ __('First Name') }}" />
            <x-input id="first_name" type="text" class="mt-1 block w-full" wire:model="state.first_name" required autocomplete="first_name" />
            <x-input-error for="first_name" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="last_name" value="{{ __('Last Name') }}" />
            <x-input id="last_name" type="text" class="mt-1 block w-full" wire:model="state.last_name" required autocomplete="last_name" />
            <x-input-error for="last_name" class="mt-2" />
        </div>

        <!-- City -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="city" value="{{ __('City') }}" />
            <x-input id="city" type="text" class="mt-1 block w-full" wire:model="state.city" required autocomplete="city" />
            <x-input-error for="city" class="mt-2" />
        </div>

        <!-- Country -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="country" value="{{ __('Country') }}" />
            <x-input id="country" type="text" class="mt-1 block w-full" wire:model="state.country" required autocomplete="country" />
            <x-input-error for="country" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="phone_number" value="{{ __('Phone') }}" />
            <x-input id="phone_number" type="text" class="mt-1 block w-full" wire:model="state.phone_number" required autocomplete="phone_number" />
            <x-input-error for="phone_number" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="rounded-full font-bold h-14 px-8 text-white border-1-cerise-red-500 bg-cerise-red-500 hover:bg-cerise-red-600 transition-bg duration-[600ms]" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            <span wire:loading="" class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full mr-2" role="status" aria-label="loading"></span>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
