<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-3" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="flex flex-wrap mb-2">
                <div class="w-50 px-2 sm:w-full">
                    <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                    <x-jet-input id="first_name" class="block mt-1 w-full" type="text" 
                        name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                </div>

                <div class="w-50 px-2 sm:w-full">
                    <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                    <x-jet-input id="last_name" class="block mt-1 w-full" type="text" 
                        name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
                </div>
            </div>

            <div class=" px-2 mb-2">
                <x-jet-label for="phone_number" value="{{ __('Phone Number') }}" />
                <x-jet-input id="phone_number"
                            class="block mt-1 w-full" type="number" min="0" 
                            name="phone_number"  required autofocus autocomplete="phone_number" />
            </div>

            <div class=" px-2 mb-3">
                <x-jet-label for="address" value="{{ __('Address') }}" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" 
                    name="address" :value="old('address')" required autofocus autocomplete="address" />
            </div>

            <div class=" px-2 mb-2 flex justify-content-around">
                <div>
                    <x-jet-label for="M" value="{{__('Male')}}" class=" inline" />
                    <input type="radio" name="gender" {{ old('gender') === 'M' ? 'checked' : '' }} id="M" value="M" />
                </div>
                <div>
                    <x-jet-label for="F" value="{{__('Female')}}" class=" inline" />
                    <input class=" bg-accent" type="radio" name="gender" {{ old("gender") === "F" ? "checked" : "" }} id="F" value="F" />
            
                </div>
            </div>

            <div class="px-2 mb-2">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" 
                            name="email" :value="old('email')" required placeholder="email@example.com" />
            </div>

            <div class="px-2 mb-2">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" 
                            name="password" required autocomplete="new-password" />
            </div>

            <div class="px-2 mb-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" 
                            name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-2">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
