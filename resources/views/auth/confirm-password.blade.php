<x-guest-layout>
    <!-- Logo & Header -->
    <div class="mb-10">
        <div class="flex items-center gap-2.5 mb-10">
            <div class="relative">
                <x-application-logo class="w-10 h-10" />
                <div class="absolute -top-1 -right-1">
                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
            </div>
            <div>
                <p class="font-bold text-lg text-gray-900 leading-tight">CareerTrackr</p>
                <p class="text-xs text-gray-400 font-medium tracking-wide">JOB HUNT OS</p>
            </div>
        </div>

        <h1 class="text-[32px] font-extrabold text-gray-900 mb-3">
            Confirmation requise <span class="inline-block"></span>
        </h1>
        <p class="text-gray-500 text-sm max-w-[280px] leading-relaxed">
            Pour des raisons de sécurité, confirme ton mot de passe avant de continuer.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mb-7">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Mot de passe</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="input-field" placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-primary-gradient">
            Confirmer
        </button>
    </form>
</x-guest-layout>