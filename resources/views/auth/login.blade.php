<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Logo & Header -->
    <div class="mb-10">
        <div class="flex items-center gap-2.5 mb-10">
            <div class="relative">
                <x-application-logo class="w-10 h-10" />
                <div class="absolute -top-1 -right-1">
                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>
            <div>
                <p class="font-bold text-lg text-gray-900 leading-tight">CandidatureTracker</p>
                <p class="text-xs text-gray-400 font-medium tracking-wide">JOB HUNT OS</p>
            </div>
        </div>

        <h1 class="text-[32px] font-extrabold text-gray-900 mb-3">
            Content de te revoir <span class="inline-block"></span>
        </h1>
        <p class="text-gray-500 text-sm max-w-[280px] leading-relaxed">
            Connecte-toi pour suivre tes candidatures et entretiens.
        </p>
    </div>

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Adresse email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                       class="input-field" placeholder="ton@email.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-semibold text-gray-700">Mot de passe</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-emerald-600 hover:text-emerald-700 font-medium transition-colors">
                        Oublié ?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                       class="input-field" placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="mb-7">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-md border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 focus:ring-offset-0" name="remember">
                <span class="ml-2.5 text-sm text-gray-600">Se souvenir de moi</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-primary-gradient">
            Se connecter
        </button>
    </form>

    <!-- Footer -->
    <div class="mt-7 text-center">
        <p class="text-sm text-gray-500">
            Pas encore de compte ? 
            <a href="{{ route('register') }}" class="text-emerald-600 font-semibold hover:text-emerald-700 transition-colors">
                S'inscrire
            </a>
        </p>
    </div>
</x-guest-layout>
