<x-guest-layout>
    <!-- En-tête personnalisé NOVASYS -->
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center p-3 bg-red-50 dark:bg-red-950/40 rounded-full mb-3 border border-red-500/20">
            <img src="{{ asset('images/logo_novasys.png') }}" alt="Logo NOVASYS" class="h-10 w-auto object-contain">
        </div>
        <h2 class="text-xl font-bold tracking-tight text-black dark:text-white">
            Connexion au Stock Interne
        </h2>
        <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">
            NOVASYS — We Secure Your Business
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-black dark:text-neutral-200 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-neutral-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white focus:border-red-600 focus:ring-red-600 rounded-sm shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password avec option Afficher/Masquer -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-black dark:text-neutral-200 font-semibold" />

            <div class="relative mt-1">
                <x-text-input id="password" class="block w-full pr-10 border-neutral-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white focus:border-red-600 focus:ring-red-600 rounded-sm shadow-sm"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-neutral-500 hover:text-red-600 focus:outline-none">
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-neutral-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                <span class="ms-2 text-sm text-neutral-600 dark:text-neutral-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-neutral-600 dark:text-neutral-400 hover:text-red-600 dark:hover:text-red-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-black dark:bg-white text-white dark:text-black hover:bg-red-600 dark:hover:bg-red-600 dark:hover:text-white font-semibold text-sm rounded-sm transition shadow-md">
                {{ __('Log in') }}
            </button>
        </div>
    </form>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('text-red-600');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('text-red-600');
            }
        }
    </script>
</x-guest-layout>