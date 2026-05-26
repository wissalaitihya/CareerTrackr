<x-app-layout>
    <div class="bg-[#F5F7FA] min-h-screen py-8">
        <div class="max-w-[1100px] mx-auto px-6">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('dashboard') }}" class="hover:text-gray-700">Tableau de bord</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">Archives</span>
            </nav>

            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-200 rounded-2xl flex items-center justify-center text-2xl">🗃️</div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Archives</h1>
                        <p class="text-gray-500 text-sm mt-0.5">{{ $candidatures->count() }} candidature{{ $candidatures->count() > 1 ? 's' : '' }} archivée{{ $candidatures->count() > 1 ? 's' : '' }}</p>
                    </div>
                </div>
                <a href="{{ route('candidatures.index') }}"
                   class="flex items-center gap-2 px-4 py-2.5 border border-gray-200 bg-white rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
                    ← Retour aux candidatures
                </a>
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse ($candidatures as $candidature)
                    <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-md transition-all">

                        {{-- Company Header --}}
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-gray-400 to-gray-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow">
                                {{ strtoupper(substr($candidature->company_name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $candidature->company_name)[1] ?? '', 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $candidature->company_name }}</h3>
                                <p class="text-sm text-gray-500">{{ $candidature->job_title }}</p>
                            </div>
                        </div>

                        {{-- Badges --}}
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                                @if($candidature->status == 'postulé') bg-blue-100 text-blue-700
                                @elseif($candidature->status == 'entretien_rh') bg-purple-100 text-purple-700
                                @elseif($candidature->status == 'test_technique') bg-yellow-100 text-yellow-700
                                @elseif($candidature->status == 'entretien_final') bg-orange-100 text-orange-700
                                @elseif($candidature->status == 'offre_reçue') bg-green-100 text-green-700
                                @elseif($candidature->status == 'refusé') bg-red-100 text-red-700
                                @endif">
                                • {{ ucfirst(str_replace('_', ' ', $candidature->status)) }}
                            </span>
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                🗃️ Archivée {{ $candidature->deleted_at->diffForHumans() }}
                            </span>
                        </div>

                        {{-- Notes --}}
                        @if($candidature->notes)
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $candidature->notes }}</p>
                        @endif

                        {{-- Actions --}}
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('candidatures.show', $candidature->id) }}"
                               class="text-sm text-gray-500 hover:text-gray-700 transition-colors">
                                Voir détail
                            </a>
                            <form action="{{ route('candidatures.restore', $candidature->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-xs font-semibold rounded-xl shadow-md hover:-translate-y-0.5 transition-all">
                                    ↩️ Restaurer
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16">
                        <p class="text-4xl mb-4">🗃️</p>
                        <p class="text-gray-500 font-medium">Aucune candidature archivée.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>