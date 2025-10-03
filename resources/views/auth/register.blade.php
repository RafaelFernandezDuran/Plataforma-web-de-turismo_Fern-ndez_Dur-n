<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Teléfono')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- User Type -->
        <div class="mt-4">
            <x-input-label for="user_type" :value="__('Tipo de Usuario')" />
            <select id="user_type" name="user_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="tourist" {{ old('user_type') == 'tourist' ? 'selected' : '' }}>Turista</option>
                <option value="company_admin" {{ old('user_type') == 'company_admin' ? 'selected' : '' }}>Administrador de Empresa Turística</option>
            </select>
            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
        </div>

        <!-- Document Type and Number -->
        <div class="mt-4 grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="document_type" :value="__('Tipo de Documento')" />
                <select id="document_type" name="document_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="DNI" {{ old('document_type') == 'DNI' ? 'selected' : '' }}>DNI</option>
                    <option value="Passport" {{ old('document_type') == 'Passport' ? 'selected' : '' }}>Pasaporte</option>
                    <option value="CE" {{ old('document_type') == 'CE' ? 'selected' : '' }}>Carné de Extranjería</option>
                </select>
                <x-input-error :messages="$errors->get('document_type')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="document_number" :value="__('Número de Documento')" />
                <x-text-input id="document_number" class="block mt-1 w-full" type="text" name="document_number" :value="old('document_number')" />
                <x-input-error :messages="$errors->get('document_number')" class="mt-2" />
            </div>
        </div>

        <!-- Nationality -->
        <div class="mt-4">
            <x-input-label for="nationality" :value="__('Nacionalidad')" />
            <select id="nationality" name="nationality" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="PER" {{ old('nationality') == 'PER' ? 'selected' : '' }}>Peruana</option>
                <option value="USA" {{ old('nationality') == 'USA' ? 'selected' : '' }}>Estadounidense</option>
                <option value="ARG" {{ old('nationality') == 'ARG' ? 'selected' : '' }}>Argentina</option>
                <option value="CHL" {{ old('nationality') == 'CHL' ? 'selected' : '' }}>Chilena</option>
                <option value="COL" {{ old('nationality') == 'COL' ? 'selected' : '' }}>Colombiana</option>
                <option value="BRA" {{ old('nationality') == 'BRA' ? 'selected' : '' }}>Brasileña</option>
                <option value="ECU" {{ old('nationality') == 'ECU' ? 'selected' : '' }}>Ecuatoriana</option>
                <option value="BOL" {{ old('nationality') == 'BOL' ? 'selected' : '' }}>Boliviana</option>
                <option value="ESP" {{ old('nationality') == 'ESP' ? 'selected' : '' }}>Española</option>
                <option value="FRA" {{ old('nationality') == 'FRA' ? 'selected' : '' }}>Francesa</option>
                <option value="DEU" {{ old('nationality') == 'DEU' ? 'selected' : '' }}>Alemana</option>
                <option value="GBR" {{ old('nationality') == 'GBR' ? 'selected' : '' }}>Británica</option>
                <option value="other" {{ old('nationality') == 'other' ? 'selected' : '' }}>Otra</option>
            </select>
            <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
