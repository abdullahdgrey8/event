<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div style="width: 100%; margin-bottom: 2.5rem;">
            <h1 style="font-weight: bold; color: #081185; font-size: 40px; line-height: 60px;">Sign In</h1>
            <p style="font-size: 16px; padding-top: 1.25rem;">This is a secure site. Please enter your login information
                to enter or you can register yourself</p>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />

        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                    autocomplete="current-password" />
                <button type="button" onclick="togglePasswordVisibility()"
                    style="position: absolute; top: 0; bottom: 0; right: 0; padding-right: 0.75rem; padding-left: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
                    <img src="{{ asset('/build/images/View.png') }}" alt="" style="width: 20px; height:20px;">
                </button>
            </div>

        </div>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="flex items-center justify-between">
                <div>
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-[#007FF2] shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </div>
                @if (Route::has('password.request'))
                <a style="transition-property: color; transition-duration: 0.2s; transition-timing-function: ease-in-out; transition-delay: initial; font-size: 0.875rem; color: #007FF2; padding-top: 0.25rem; padding-right: 0.5rem; padding-bottom: 0.25rem; padding-left: 0.5rem;"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class=" w-[100%] hidden">
                <!-- {{ __('Log in') }} -->
            </x-primary-button>
            <button type="submit"
                style="background: #081185; padding: 7px; color: white; font: 20px; width: 100%; font-weight: bold; border-radius: 5px; border: none;">Login</button>
        </div>
    </form>
</x-guest-layout>

<script>
function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var passwordToggleIcon = document.getElementById('password-toggle-icon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggleIcon.classList.remove('fa-eye');
        passwordToggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordToggleIcon.classList.remove('fa-eye-slash');
        passwordToggleIcon.classList.add('fa-eye');
    }
}
</script>