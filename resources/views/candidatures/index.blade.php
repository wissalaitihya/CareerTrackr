<x-app-layout>
    <div class="bg-[#f5f7fa] min-h-screen">
        <div class="max-w-[1400px] mx-auto px-8 py-8">
            <!-- Page Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Mes candidatures</h1>
                    <p class="text-gray-500 mt-1">{{ $candidatures->count() }} sur {{ $candidatures->count() }} candidatures actives</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('candidatures.archives') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-50 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                        Archives
                    </a>
                    <a href="{{ route('candidatures.create') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-50 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Nouvelle candidature
                    </a>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 mb-8" x-data="{ activeFilter: 'toutes', searchQuery: '' }">
                <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                    <!-- Search Input -->
                    <div class="flex-1 relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" 
                               x-model="searchQuery"
                               placeholder="Entreprise, poste, notes..." 
                               class="w-full h-10 pl-10 pr-4 bg-gray-50 border-0 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 transition-all duration-200">
                    </div>

                    <!-- Filter Pills -->
                    <div class="flex items-center gap-2 flex-wrap">
                        <button @click="activeFilter = 'toutes'" 
                                :class="activeFilter === 'toutes' ? 'filter-pill-active' : 'filter-pill'"
                                class="filter-pill">
                            Toutes
                        </button>
                        <button @click="activeFilter = 'postulé'" 
                                :class="activeFilter === 'postulé' ? 'filter-pill-active' : 'filter-pill'"
                                class="filter-pill">
                            <span class="w-2 h-2 rounded-full bg-orange-400"></span>
                            Postulé
                        </button>
                        <button @click="activeFilter = 'entretien'" 
                                :class="activeFilter === 'entretien' ? 'filter-pill-active' : 'filter-pill'"
                                class="filter-pill">
                            <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                            Entretien
                        </button>
                        <button @click="activeFilter = 'en_attente'" 
                                :class="activeFilter === 'en_attente' ? 'filter-pill-active' : 'filter-pill'"
                                class="filter-pill">
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                            En attente
                        </button>
                        <button @click="activeFilter = 'offre'" 
                                :class="activeFilter === 'offre' ? 'filter-pill-active' : 'filter-pill'"
                                class="filter-pill">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            Offre
                        </button>
                        <button @click="activeFilter = 'accepté'" 
                                :class="activeFilter === 'accepté' ? 'filter-pill-active' : 'filter-pill'"
                                class="filter-pill">
                            <span class="w-2 h-2 rounded-full bg-green-400"></span>
                            Accepté
                        </button>
                        <button @click="activeFilter = 'refusé'" 
                                :class="activeFilter === 'refusé' ? 'filter-pill-active' : 'filter-pill'"
                                class="filter-pill">
                            <span class="w-2 h-2 rounded-full bg-red-400"></span>
                            Refusé
                        </button>
                    </div>

                    <!-- Priority Dropdown -->
                    <div class="relative" x-data="{ open: false, selected: 'Toutes priorités' }">
                        <button @click="open = !open" 
                                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-sm text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                            <span x-text="selected"></span>
                            <svg class="w-4 h-4" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" 
                             class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-200 py-2 z-50">
                            <button @click="selected = 'Toutes priorités'; open = false" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 text-left">Toutes priorités</button>
                            <button @click="selected = 'Haute'; open = false" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 text-left"> Haute</button>
                            <button @click="selected = 'Moyenne'; open = false" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 text-left">⚡ Moyenne</button>
                            <button @click="selected = 'Basse'; open = false" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 text-left">🌱 Basse</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @forelse ($candidatures as $candidature)
                    @php
                        $statusClass = match($candidature->status) {
                            'entretien_rh', 'entretien_final', 'test_technique' => 'border-entretien',
                            'postulé' => 'border-postule',
                            'en_attente' => 'border-attente',
                            'offre_reçue' => 'border-offre',
                            'accepté' => 'border-accepte',
                            'refusé' => 'border-refuse',
                            default => 'border-postule',
                        };
                        
                        $statusBadgeClass = match($candidature->status) {
                            'entretien_rh', 'entretien_final', 'test_technique' => 'status-entretien',
                            'postulé' => 'status-postule',
                            'en_attente' => 'status-attente',
                            'offre_reçue' => 'status-offre',
                            'accepté' => 'status-accepte',
                            'refusé' => 'status-refuse',
                            default => 'status-postule',
                        };
                        
                        $statusLabel = match($candidature->status) {
                            'entretien_rh' => 'Entretien RH',
                            'entretien_final' => 'Entretien final',
                            'test_technique' => 'Test technique',
                            'postulé' => 'Postulé',
                            'en_attente' => 'En attente',
                            'offre_reçue' => 'Offre reçue',
                            'accepté' => 'Accepté',
                            'refusé' => 'Refusé',
                            default => $candidature->status,
                        };
                        
                        $priorityClass = match($candidature->priority) {
                            'haute' => 'priority-haute',
                            'moyenne' => 'priority-moyenne',
                            'basse' => 'priority-basse',
                            default => 'priority-moyenne',
                        };
                        
                        $priorityLabel = match($candidature->priority) {
                            'haute' => '🔥 Haute',
                            'moyenne' => ' Moyenne',
                            'basse' => '🌱 Basse',
                            default => '⚡ Moyenne',
                        };
                        
                        $companyInitial = strtoupper(substr($candidature->company_name, 0, 1));
                        $companyColors = ['bg-blue-100 text-blue-700', 'bg-purple-100 text-purple-700', 'bg-pink-100 text-pink-700', 'bg-indigo-100 text-indigo-700', 'bg-teal-100 text-teal-700'];
                        $colorIndex = crc32($candidature->company_name) % count($companyColors);
                        $companyColor = $companyColors[$colorIndex];
                        
                        $daysAgo = now()->diffInDays(\Carbon\Carbon::parse($candidature->application_date));
                        $dateLabel = $daysAgo === 0 ? "Aujourd'hui" : ($daysAgo === 1 ? 'Hier' : "il y a $daysAgo jours");
                    @endphp
                    
                    <div class="candidature-card {{ $statusClass }}">
                        <!-- Top Section -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 {{ $companyColor }} rounded-full flex items-center justify-center text-sm font-bold">
                                    {{ $companyInitial }}
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $candidature->company_name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $candidature->job_title }}</p>
                                </div>
                            </div>
                            <button class="p-1 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Status Badges -->
                        <div class="flex items-center gap-2 mb-4">
                            <span class="status-badge {{ $statusBadgeClass }}">
                                {{ $statusLabel }}
                            </span>
                            <span class="status-badge {{ $priorityClass }}">
                                {{ $priorityLabel }}
                            </span>
                        </div>

                        <!-- Date -->
                        <p class="text-xs text-gray-400 text-right mb-4">{{ $dateLabel }}</p>

                        <!-- Description -->
                        @if($candidature->notes)
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ Str::limit($candidature->notes, 100) }}</p>
                        @endif

                        <!-- Divider -->
                        <div class="border-t border-slate-100 pt-4">
                            <!-- Bottom Actions -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-1.5 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-xs">0</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                        </svg>
                                        <span class="text-xs">{{ $candidature->attachment ? '1' : '0' }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                        </svg>
                                        <span class="text-xs">{{ $candidature->offer_url ? '1' : '0' }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('candidatures.show', $candidature) }}" 
                                   class="inline-flex items-center gap-1 text-sm font-semibold text-teal-600 hover:text-teal-700 transition-colors">
                                    Voir détail
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-12 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucune candidature</h3>
                            <p class="text-gray-500 mb-6">Commence par ajouter ta première candidature pour suivre tes opportunités.</p>
                            <a href="{{ route('candidatures.create') }}" 
                               class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold rounded-xl shadow-lg shadow-emerald-500/25 hover:shadow-xl hover:shadow-emerald-500/30 transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Nouvelle candidature
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($candidatures->count() > 0)
                <div class="flex items-center justify-end gap-2">
                    <button class="inline-flex items-center gap-1 px-3 py-2 bg-white border border-slate-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Précédent
                    </button>
                    <button class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold rounded-xl">
                        1
                    </button>
                    <button class="inline-flex items-center gap-1 px-3 py-2 bg-white border border-slate-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        Suivant
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 mt-12">
            <div class="max-w-[1400px] mx-auto px-8 py-6 flex items-center justify-between">
                <p class="text-sm text-gray-500">
                    © 2026 CandidatureTracker · Projet de soutenance · Laravel 11
                </p>
                <a href="#" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                    </svg>
                    GitHub
                </a>
            </div>
        </footer>
    </div>
</x-app-layout>
