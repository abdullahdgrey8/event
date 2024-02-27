<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="w-[100%] mb-7">
            <h1 class="font-bold text-[#081185] text-[40px] line-height-60">Sign In</h1>
            <p class="text-[16px] pt-5">This is a secure site. Please enter your login information to enter or
                you can register yourself
            </p>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <!-- <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" /> -->
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                    autocomplete="current-password" />
                <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 px-3 py-1">
                    <img src="{{ asset('/build/images/View.png') }}" alt="" style="width: 20px; height:20px;">
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="flex items-center justify-between">
                <div>
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-[#007FF2] shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </div>
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class=" w-[100%]">
                {{ __('Log in') }}
            </x-primary-button>
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