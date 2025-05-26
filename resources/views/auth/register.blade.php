<x-guest-layout>
    <form
        method="POST"
        action="{{ route('register') }}"
        x-data="{
            departments: [],
            department_id: Number('{{ old('department_id', '') }}'),
            init() {
                fetch('{{ route('fetchDept.data') }}', {
                    headers: { 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(data => this.departments = data)
                .catch(() => this.departments = []);
            }
        }"
        x-init="init()"
    >
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number (Optional) -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone (optional)')" />
            <x-text-input
                id="phone"
                class="block mt-1 w-full"
                type="text"
                name="phone"
                :value="old('phone')"
                autocomplete="tel"
            />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Designation Dropdown -->
        <div class="mt-4">
            <x-input-label for="designation" :value="__('Designation')" />
            <select
                id="designation"
                name="designation"
                class="block mt-1 w-full"
                required
            >
                <option value="" disabled {{ old('designation') ? '' : 'selected' }}>
                    {{ __('Select Designation') }}
                </option>
                <option value="Professor"                {{ old('designation') == 'Professor' ? 'selected' : '' }}>Professor</option>
                <option value="Assistant Professor"       {{ old('designation') == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                <option value="Associate Professor"       {{ old('designation') == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                <option value="Lecturer"                  {{ old('designation') == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                <option value="Officer"                   {{ old('designation') == 'Officer' ? 'selected' : '' }}>Officer</option>
            </select>
            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
        </div>

        <!-- Department Dropdown -->
        <div class="mt-4">
            <x-input-label for="department_id" :value="__('Department')" />
            <select
                id="department_id"
                name="department_id"
                x-model="department_id"
                class="block mt-1 w-full"
                required
            >
                <option value="">{{ __('Select Department') }}</option>
                <template x-for="dept in departments" :key="dept.id">
                    <option :value="dept.id" x-text="dept.name"></option>
                </template>
            </select>
            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
        </div>
        <!-- Address (Optional) -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input
                id="address"
                class="block mt-1 w-full"
                type="text"
                name="address"
                :value="old('address')"
                autocomplete="street-address"
            />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>


        <!-- Actions -->
        <div class="flex items-center justify-end mt-6">
            <a
                class="underline text-sm text-gray-600 hover:text-gray-900"
                href="{{ route('login') }}"
            >
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
