<x-guest-layout>
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
            Vérifie ton email <span class="inline-block"></span>
        </h1>
        <p class="text-gray-500 text-sm max-w-[280px] leading-relaxed">
            Un lien de vérification a été envoyé à <span class="font-medium text-gray-700">{{ Auth::user()->email }}</span>. Clique dessus pour activer ton compte.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl">
            <p class="text-sm text-emerald-700">
                ✅ Un nouveau lien de vérification vient d'être envoyé !
            </p>
        </div>
    @endif

    <div class="flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary-gradient">
                Renvoyer le lien de vérification
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-4 px-6 bg-gray-100 text-gray-700 font-semibold text-sm rounded-2xl hover:bg-gray-200 transition-colors">
                Se déconnecter
            </button>
        </form>
    </div>
</x-guest-layout>
