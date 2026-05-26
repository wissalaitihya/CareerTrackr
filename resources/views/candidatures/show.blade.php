<x-app-layout>
    <div class="bg-[#f8fafc] min-h-screen">
        <div class="max-w-[1200px] mx-auto px-6 py-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('dashboard') }}" class="hover:text-gray-700 transition-colors">Tableau de bord</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('candidatures.index') }}" class="hover:text-gray-700 transition-colors">Candidatures</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900 font-medium">{{ $candidature->company_name }}</span>
            </nav>

            {{-- Hero Card --}}
            <div class="bg-gradient-to-br from-white via-white to-pink-50/50 border border-slate-200 rounded-2xl shadow-sm mb-6 overflow-hidden">
                <div class="p-8">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                        {{-- Left side --}}
                        <div class="flex-1">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center text-white text-xl font-bold shadow-lg shadow-purple-500/20 shrink-0">
                                    {{ strtoupper(substr($candidature->company_name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        @php
                                            $statusBadgeClass = match($candidature->status) {
                                                'entretien_rh', 'entretien_final', 'test_technique' => 'bg-blue-50 text-blue-700',
                                                'postulé' => 'bg-orange-50 text-orange-700',
                                                'en_attente' => 'bg-amber-50 text-amber-700',
                                                'offre_reçue', 'accepté' => 'bg-emerald-50 text-emerald-700',
                                                'refusé' => 'bg-red-50 text-red-700',
                                                default => 'bg-slate-100 text-slate-700',
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
                                                default => $candidature->status ?? 'Postulé',
                                            };
                                            $priorityBadgeClass = match($candidature->priority) {
                                                'haute' => 'bg-red-50 text-red-600',
                                                'moyenne' => 'bg-yellow-50 text-yellow-600',
                                                'basse' => 'bg-green-50 text-green-600',
                                                default => 'bg-yellow-50 text-yellow-600',
                                            };
                                            $daysAgo = now()->diffInDays(\Carbon\Carbon::parse($candidature->application_date));
                                            $dateLabel = $daysAgo === 0 ? "Aujourd'hui" : ($daysAgo === 1 ? 'Hier' : "il y a $daysAgo jours");
                                        @endphp
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium rounded-full {{ $statusBadgeClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium rounded-full {{ $priorityBadgeClass }}">
                                            @switch($candidature->priority)
                                                @case('haute')🔥 @break
                                                @case('moyenne')⚡ @break
                                                @case('basse')🌱 @break
                                            @endswitch
                                            {{ ucfirst($candidature->priority ?? 'moyenne') }}
                                        </span>
                                    </div>
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $candidature->company_name }}</h1>
                                    <p class="text-gray-500 mt-0.5">{{ $candidature->job_title }}</p>
                                    <div class="flex items-center gap-2 text-sm text-gray-400 mt-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Candidature du {{ \Carbon\Carbon::parse($candidature->application_date)->translatedFormat('j F Y') }}</span>
                                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                        <span>{{ $dateLabel }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right side actions --}}
                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ route('candidatures.edit', $candidature) }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-white border border-slate-200 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Modifier
                            </a>
                            <form action="{{ route('candidatures.destroy', $candidature) }}" method="POST" onsubmit="return confirm('Archiver cette candidature ?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-white border border-slate-200 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                    </svg>
                                    Archiver
                                </button>
                            </form>
                            @if($candidature->attachment)
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($candidature->attachment) }}" target="_blank"
                                   class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold rounded-xl shadow-lg shadow-emerald-500/20 hover:shadow-xl hover:shadow-emerald-500/30 hover:-translate-y-0.5 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Télécharger
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Quick Status Change --}}
                    <div class="mt-8 pt-6 border-t border-slate-200">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Changer le statut rapidement</p>
                        <div class="flex flex-wrap gap-2">
                            @php $currentStatus = $candidature->status; @endphp
                            @foreach([
                                ['value' => 'postulé', 'label' => 'Postulé'],
                                ['value' => 'entretien_rh', 'label' => 'Entretien planifié'],
                                ['value' => 'en_attente', 'label' => 'En attente'],
                                ['value' => 'offre_reçue', 'label' => 'Offre reçue'],
                                ['value' => 'accepté', 'label' => 'Accepté'],
                                ['value' => 'refusé', 'label' => 'Refusé'],
                            ] as $status)
                                <form action="{{ route('candidatures.update', $candidature) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="{{ $status['value'] }}">
                                    <input type="hidden" name="company_name" value="{{ $candidature->company_name }}">
                                    <input type="hidden" name="job_title" value="{{ $candidature->job_title }}">
                                    <input type="hidden" name="application_date" value="{{ $candidature->application_date }}">
                                    <input type="hidden" name="priority" value="{{ $candidature->priority ?? 'moyenne' }}">
                                    <button type="submit"
                                            class="px-3 py-1.5 text-xs font-medium rounded-full border transition-all duration-200
                                            {{ $currentStatus === $status['value'] ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-600 border-slate-200 hover:bg-gray-50' }}">
                                        {{ $status['label'] }}
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                {{-- Left Column --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Informations --}}
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">
                        <div class="p-6 border-b border-slate-100 flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Informations</h2>
                        </div>
                        <div class="p-6 space-y-5">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Date de candidature</p>
                                    <p class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($candidature->application_date)->translatedFormat('l j F Y') }}</p>
                                </div>
                                @if($candidature->offer_url)
                                <div>
                                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">URL de l'offre</p>
                                    <a href="{{ $candidature->offer_url }}" target="_blank"
                                       class="text-sm text-emerald-600 hover:text-emerald-700 font-medium transition-colors inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                        </svg>
                                        {{ preg_replace('/^https?:\/\//', '', $candidature->offer_url) }}
                                    </a>
                                </div>
                                @endif
                            </div>
                            @if($candidature->notes)
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Notes</p>
                                <div class="bg-gray-50 border border-slate-100 rounded-xl p-4">
                                    <p class="text-sm text-gray-700 leading-relaxed">{{ $candidature->notes }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Entretiens --}}
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">
                        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Entretiens ({{ $candidature->entretiens->count() }})</h2>
                            </div>
                            @if($candidature->entretiens->count() > 0)
                            <button onclick="document.getElementById('modal-entretien').classList.remove('hidden')"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-xs font-semibold rounded-lg shadow-sm hover:shadow-md transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Ajouter
                            </button>
                            @endif
                        </div>
                        <div class="p-6">
                            @forelse($candidature->entretiens as $entretien)
                                @php
                                    $dotColor = match($entretien->result) {
                                        'Réussi' => 'bg-emerald-500',
                                        'En attente', null => 'bg-amber-400',
                                        'Échoué', 'Annulé' => 'bg-red-500',
                                        default => 'bg-slate-300',
                                    };
                                    $badgeClass = match($entretien->result) {
                                        'Réussi' => 'bg-emerald-50 text-emerald-700',
                                        'En attente', null => 'bg-amber-50 text-amber-700',
                                        'Échoué', 'Annulé' => 'bg-red-50 text-red-700',
                                        default => 'bg-slate-100 text-slate-700',
                                    };
                                @endphp
                                <div class="relative pl-8 pb-6 last:pb-0">
                                    <div class="absolute left-0 top-1.5 w-3 h-3 rounded-full border-2 border-white shadow-sm {{ $dotColor }}"></div>
                                    @if(!$loop->last)
                                        <div class="absolute left-[5px] top-5 bottom-0 w-0.5 bg-slate-200"></div>
                                    @endif
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-0.5">
                                                <span class="font-semibold text-sm text-gray-900">{{ ucfirst($entretien->type) }}</span>
                                                @if($entretien->result)
                                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full {{ $badgeClass }}">
                                                        {{ ucfirst($entretien->result) }}
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-xs text-gray-400 mb-2">
                                                {{ \Carbon\Carbon::parse($entretien->scheduled_at)->translatedFormat('D j F · H:i') }}
                                            </p>
                                            @if($entretien->preparation_notes)
                                                <p class="text-sm text-gray-600">{{ $entretien->preparation_notes }}</p>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-1 shrink-0">
                                            <a href="{{ route('entretiens.edit', [$candidature, $entretien]) }}"
                                               class="p-1.5 text-gray-400 hover:text-gray-600 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('entretiens.destroy', [$candidature, $entretien]) }}" method="POST" onsubmit="return confirm('Supprimer cet entretien ?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-700 mb-1">Aucun entretien planifié</p>
                                    <p class="text-xs text-gray-400 mb-4">Ajoute ton premier entretien pour cette candidature.</p>
                                    <button onclick="document.getElementById('modal-entretien').classList.remove('hidden')"
                                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-xs font-semibold rounded-lg shadow-sm hover:shadow-md transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Planifier un entretien
                                    </button>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <a href="{{ route('entretiens.create', $candidature) }}"
   class="bg-blue-500 text-white px-4 py-2 rounded">
    + Ajouter un entretien
</a>

                {{-- Right Sidebar --}}
                <div class="space-y-6">
                    {{-- Pièce jointe --}}
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">
                        <div class="p-5 border-b border-slate-100 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                            </svg>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pièce jointe</p>
                        </div>
                        <div class="p-5">
                            @if($candidature->attachment)
                                <div class="flex items-center gap-3 p-3 bg-emerald-50/50 border border-emerald-100 rounded-xl">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ basename($candidature->attachment) }}</p>
                                        <p class="text-xs text-gray-500">Pièce jointe</p>
                                    </div>
                                    <a href="{{ \Illuminate\Support\Facades\Storage::url($candidature->attachment) }}" target="_blank"
                                       class="p-2 text-emerald-600 hover:text-emerald-700 hover:bg-emerald-100 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                    </a>
                                </div>
                            @else
                                <p class="text-sm text-gray-400 text-center py-4">Aucune pièce jointe</p>
                            @endif
                        </div>
                    </div>

                    {{-- Activité --}}
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">
                        <div class="p-5 border-b border-slate-100 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Activité</p>
                        </div>
                        <div class="p-5 space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Créée</p>
                                    <p class="text-xs text-gray-400">{{ $candidature->created_at->translatedFormat('j F Y') }} · {{ $candidature->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-2.5 h-2.5 rounded-full bg-blue-500 mt-1.5 shrink-0"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Dernière modification</p>
                                    <p class="text-xs text-gray-400">{{ $candidature->updated_at->translatedFormat('j F Y') }} · {{ $candidature->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions rapides --}}
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">
                        <div class="p-5 border-b border-slate-100 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions rapides</p>
                        </div>
                        <div class="p-5 space-y-2">
                            <button onclick="document.getElementById('modal-entretien').classList.remove('hidden')"
                                    class="flex items-center gap-2.5 w-full px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-xl transition-colors text-left">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Ajouter un entretien
                            </button>
                            <a href="{{ route('candidatures.edit', $candidature) }}"
                               class="flex items-center gap-2.5 w-full px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-xl transition-colors">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Modifier la candidature
                            </a>
                            <form action="{{ route('candidatures.destroy', $candidature) }}" method="POST" onsubmit="return confirm('Archiver cette candidature ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="flex items-center gap-2.5 w-full px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                    </svg>
                                    Archiver
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="bg-white border-t border-slate-200 mt-12">
            <div class="max-w-[1200px] mx-auto px-6 py-6 flex items-center justify-between">
                <p class="text-sm text-gray-500">© 2026 CandidatureTracker · Projet de soutenance · Laravel 11</p>
                <a href="#" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    GitHub
                </a>
            </div>
        </footer>
    </div>

    {{-- Modal Nouvel Entretien --}}
    <div id="modal-entretien" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Nouvel entretien</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Planifie un entretien pour cette candidature.</p>
                </div>
                <button onclick="document.getElementById('modal-entretien').classList.add('hidden')"
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100">
                    ✕
                </button>
            </div>
            <form action="{{ route('entretiens.store', $candidature) }}" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="type" id="type-input" value="Téléphonique">

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Type d'entretien</label>
                    <div class="grid grid-cols-4 gap-3">
                        @foreach(['Téléphonique' => '📞', 'Visioconférence' => '🎥', 'Sur site' => '🏢', 'Technique' => '💻', 'RH' => '👥'] as $type => $icon)
                            <div onclick="selectType('{{ $type }}')"
                                 id="type-{{ Str::slug($type) }}"
                                 class="type-card cursor-pointer border-2 rounded-xl p-3 text-center transition-all {{ $type == 'Téléphonique' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200' }}">
                                <div class="text-2xl mb-1">{{ $icon }}</div>
                                <p class="text-xs font-medium text-gray-700">{{ $type }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Date et heure *</label>
                    <input type="datetime-local" name="scheduled_at"
                           value="{{ now()->format('Y-m-d\TH:i') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                    @error('scheduled_at')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Résultat</label>
                    <select name="result"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                        <option value="En attente">En attente</option>
                        <option value="Réussi">Réussi</option>
                        <option value="Échoué">Échoué</option>
                        <option value="Annulé">Annulé</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Notes de préparation</label>
                    <textarea name="preparation_notes" rows="3"
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 resize-none"
                              placeholder="Points à préparer, questions à poser..."></textarea>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <button type="button"
                            onclick="document.getElementById('modal-entretien').classList.add('hidden')"
                            class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-xl transition-all">
                        Annuler
                    </button>
                    <button type="submit"
                            class="flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold rounded-xl shadow-lg hover:-translate-y-0.5 transition-all">
                        ✓ Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function selectType(value) {
        document.getElementById('type-input').value = value;
        document.querySelectorAll('.type-card').forEach(el => {
            el.classList.remove('border-emerald-500', 'bg-emerald-50');
            el.classList.add('border-gray-200');
        });
        const slug = value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        const el = document.getElementById('type-' + slug);
        if (el) {
            el.classList.remove('border-gray-200');
            el.classList.add('border-emerald-500', 'bg-emerald-50');
        }
    }
    </script>
</x-app-layout>