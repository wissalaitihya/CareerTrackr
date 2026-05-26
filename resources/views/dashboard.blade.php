<x-app-layout>
    <div class="bg-[#F5F7FA] min-h-screen py-8">
        <div class="max-w-[1100px] mx-auto px-6">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">
                        {{ now()->translatedFormat('l d F Y') }}
                    </p>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Bonjour, <span class="text-emerald-500">{{ Auth::user()->name }}</span> 👋
                    </h1>
                    <p class="text-gray-500 mt-1">
                        Tu as <strong>{{ $entretiensSemaine }} entretien{{ $entretiensSemaine > 1 ? 's' : '' }}</strong> cette semaine. Reste concentré{{ Auth::user()->name[-1] == 'a' ? 'e' : '' }} !
                    </p>
                </div>
                <a href="{{ route('candidatures.create') }}"
                   class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-full shadow-lg hover:-translate-y-0.5 transition-all">
                    + Nouvelle candidature
                </a>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total candidatures</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalCandidatures }}</p>
                </div>

                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Candidatures en cours</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $enCours }}</p>
                </div>

                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Entretiens cette semaine</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $entretiensSemaine }}</p>
                </div>

                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Taux de réponse</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalCandidatures > 0 ? round(($entretienPlanifie / $totalCandidatures) * 100) : 0 }}%</p>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                {{-- Prochains entretiens --}}
                <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="font-bold text-gray-900">Prochains entretiens</h2>
                            <p class="text-sm text-gray-400">{{ $prochainsEntretiens->count() }} entretiens planifiés</p>
                        </div>
                        <a href="{{ route('candidatures.index') }}" class="text-sm text-emerald-600 hover:underline">Voir tout</a>
                    </div>

                    @forelse($prochainsEntretiens as $entretien)
                        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-all cursor-pointer mb-2">
                            <div class="w-12 text-center">
                                <p class="text-xs font-semibold text-gray-400 uppercase">{{ \Carbon\Carbon::parse($entretien->scheduled_at)->translatedFormat('M') }}</p>
                                <p class="text-xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($entretien->scheduled_at)->format('d') }}</p>
                            </div>
                            <div class="w-px h-10 bg-gray-200"></div>
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-sm">
                                @if($entretien->type == 'Technique') 💻
                                @elseif($entretien->type == 'Téléphonique') 📞
                                @elseif($entretien->type == 'RH') 👥
                                @else 🎥
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-semibold text-blue-600">{{ $entretien->type }}</span>
                                    <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($entretien->scheduled_at)->format('H:i') }}</span>
                                </div>
                                <p class="font-semibold text-gray-900 text-sm">{{ $entretien->candidature->company_name }}</p>
                                <p class="text-xs text-gray-500">{{ $entretien->candidature->job_title }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-gray-400 text-sm">Aucun entretien planifié.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Funnel --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <h2 class="font-bold text-gray-900 mb-1">Funnel de conversion</h2>
                    <p class="text-sm text-gray-400 mb-6">De la candidature à l'offre</p>

                    @php
                        $funnelItems = [
                            ['label' => 'Postulé', 'count' => $postule, 'color' => 'bg-gray-400'],
                            ['label' => 'Entretien planifié', 'count' => $entretienPlanifie, 'color' => 'bg-blue-500'],
                            ['label' => 'Offre', 'count' => $offre, 'color' => 'bg-emerald-500'],
                        ];
                    @endphp

                    @foreach($funnelItems as $item)
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-700 font-medium">{{ $item['label'] }}</span>
                                <span class="text-gray-400">{{ $item['count'] }} · {{ $postule > 0 ? round(($item['count'] / $postule) * 100) : 0 }}%</span>
                            </div>
                            <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="{{ $item['color'] }} h-2 rounded-full transition-all"
                                     style="width: {{ $postule > 0 ? round(($item['count'] / $postule) * 100) : 0 }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if($postule > 0)
                        <div class="mt-4 p-3 bg-emerald-50 rounded-xl">
                            <p class="text-xs text-emerald-700">
                                ✨ <strong>{{ round(($offre / $postule) * 100) }}%</strong> de tes candidatures arrivent jusqu'à l'offre.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Candidatures récentes --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="font-bold text-gray-900">Candidatures récentes</h2>
                        <p class="text-sm text-gray-400">Tes 4 dernières candidatures</p>
                    </div>
                    <a href="{{ route('candidatures.index') }}" class="text-sm text-emerald-600 hover:underline">Voir toutes →</a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @forelse($candidaturesRecentes as $candidature)
                        <a href="{{ route('candidatures.show', $candidature) }}"
                           class="p-4 rounded-xl border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50/30 transition-all">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-lg flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr($candidature->company_name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-sm text-gray-900">{{ $candidature->company_name }}</p>
                                    <p class="text-xs text-gray-400">{{ $candidature->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mb-3">{{ $candidature->job_title }}</p>
                            <div class="flex items-center justify-between">
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                    @if($candidature->status == 'postulé') bg-blue-100 text-blue-700
                                    @elseif(in_array($candidature->status, ['entretien_rh','test_technique','entretien_final'])) bg-purple-100 text-purple-700
                                    @elseif($candidature->status == 'offre_reçue') bg-green-100 text-green-700
                                    @else bg-red-100 text-red-700
                                    @endif">
                                    • {{ ucfirst(str_replace('_', ' ', $candidature->status)) }}
                                </span>
                                @if($candidature->priority == 'haute') <span>🔥</span>
                                @elseif($candidature->priority == 'moyenne') <span>⚡</span>
                                @else <span>🌱</span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="col-span-4 text-center py-8">
                            <p class="text-gray-400 text-sm">Aucune candidature pour le moment.</p>
                            <a href="{{ route('candidatures.create') }}"
                               class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white text-sm font-semibold rounded-full">
                                + Nouvelle candidature
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>