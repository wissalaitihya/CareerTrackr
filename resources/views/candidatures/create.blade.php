<x-app-layout>
    <div class="bg-[#f5f7fb] min-h-screen">
        <div class="max-w-3xl mx-auto px-6 py-8">

            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('dashboard') }}" class="hover:text-gray-700">Tableau de bord</a>
                <span>/</span>
                <a href="{{ route('candidatures.index') }}" class="hover:text-gray-700">Candidatures</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">Nouvelle candidature</span>
            </nav>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <p class="text-sm text-emerald-700 font-medium">✅ {{ session('success') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <p class="text-sm text-red-700 font-medium">⚠️ Veuillez corriger les erreurs ci-dessous.</p>
                </div>
            @endif

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Nouvelle candidature</h1>
                <p class="text-gray-500 mt-1">Remplis le formulaire pour suivre cette opportunité.</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
                <form action="{{ route('candidatures.store') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-slate-100">
                    @csrf

                    {{-- Entreprise --}}
                    <div class="p-8">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">🏢 Entreprise</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nom de l'entreprise *</label>
                                <input type="text" name="company_name" value="{{ old('company_name') }}"
                                       class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500"
                                       placeholder="Ex : Doctolib">
                                @error('company_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">URL de l'offre</label>
                                <input type="url" name="offer_url" value="{{ old('offer_url') }}"
                                       class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500"
                                       placeholder="https://...">
                                @error('offer_url')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Poste --}}
                    <div class="p-8">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">💼 Poste</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Intitulé du poste *</label>
                                <input type="text" name="job_title" value="{{ old('job_title') }}"
                                       class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500"
                                       placeholder="Ex : Développeur Full-Stack">
                                @error('job_title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date de candidature *</label>
                                <input type="date" name="application_date"
                                       value="{{ old('application_date', date('Y-m-d')) }}"
                                       class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500">
                                @error('application_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Suivi --}}
                    <div class="p-8">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">📊 Suivi</h2>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                            <select name="status" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500">
                                <option value="postulé" {{ old('status') == 'postulé' ? 'selected' : '' }}>Postulé</option>
                                <option value="entretien_rh" {{ old('status') == 'entretien_rh' ? 'selected' : '' }}>Entretien RH</option>
                                <option value="test_technique" {{ old('status') == 'test_technique' ? 'selected' : '' }}>Test technique</option>
                                <option value="entretien_final" {{ old('status') == 'entretien_final' ? 'selected' : '' }}>Entretien final</option>
                                <option value="offre_reçue" {{ old('status') == 'offre_reçue' ? 'selected' : '' }}>Offre reçue</option>
                                <option value="refusé" {{ old('status') == 'refusé' ? 'selected' : '' }}>Refusé</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Priorité</label>
                            <input type="hidden" name="priority" id="priority-input" value="{{ old('priority', 'moyenne') }}">
                            <div class="grid grid-cols-3 gap-4">
                                <div onclick="selectPriority('haute')" id="priority-haute"
                                     class="cursor-pointer border-2 rounded-xl p-4 text-center {{ old('priority', 'moyenne') == 'haute' ? 'border-orange-400 bg-orange-50' : 'border-slate-200' }}">
                                    <span class="text-xl">🔥</span>
                                    <p class="font-semibold text-sm mt-1">Haute</p>
                                    <p class="text-xs text-gray-500">Top priorité</p>
                                </div>
                                <div onclick="selectPriority('moyenne')" id="priority-moyenne"
                                     class="cursor-pointer border-2 rounded-xl p-4 text-center {{ old('priority', 'moyenne') == 'moyenne' ? 'border-blue-400 bg-blue-50' : 'border-slate-200' }}">
                                    <span class="text-xl">⚡</span>
                                    <p class="font-semibold text-sm mt-1">Moyenne</p>
                                    <p class="text-xs text-gray-500">Suivi régulier</p>
                                </div>
                                <div onclick="selectPriority('basse')" id="priority-basse"
                                     class="cursor-pointer border-2 rounded-xl p-4 text-center {{ old('priority', 'moyenne') == 'basse' ? 'border-green-400 bg-green-50' : 'border-slate-200' }}">
                                    <span class="text-xl">🌱</span>
                                    <p class="font-semibold text-sm mt-1">Basse</p>
                                    <p class="text-xs text-gray-500">Option de secours</p>
                                </div>
                            </div>
                            @error('priority')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Notes --}}
                    <div class="p-8">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">📝 Notes</h2>
                        <textarea name="notes" rows="5"
                                  class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 resize-none"
                                  placeholder="Tes notes, points clés à retenir…"
                                  maxlength="1000">{{ old('notes') }}</textarea>
                    </div>

                    {{-- Pièce jointe --}}
                    <div class="p-8">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">📎 Pièce jointe</h2>
                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center hover:border-green-400 hover:bg-green-50/30 transition-all cursor-pointer"
                             x-data="{ fileName: '' }">
                            <input type="file" name="attachment" accept=".pdf,.doc,.docx" 
                                   class="hidden" x-ref="fileInput"
                                   @change="fileName = $event.target.files[0]?.name || ''">
                            <div @click="$refs.fileInput.click()">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-700" x-show="!fileName">Glissez votre CV ou <span class="text-green-600">cliquez</span></p>
                                <p class="text-sm font-medium text-green-600" x-show="fileName" x-text="fileName"></p>
                                <p class="text-xs text-gray-400 mt-1">PDF, DOC, DOCX • 5 Mo max</p>
                            </div>
                        </div>
                        @error('attachment')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="p-8 bg-gray-50/50">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('candidatures.index') }}"
                               class="px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-xl transition-all">
                                Annuler
                            </a>
                            <button type="submit"
                                    class="flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm font-semibold rounded-xl">
                                ✓ Enregistrer
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
    function selectPriority(value) {
        document.getElementById('priority-input').value = value;
        const colors = { haute: 'border-orange-400 bg-orange-50', moyenne: 'border-blue-400 bg-blue-50', basse: 'border-green-400 bg-green-50' };
        ['haute', 'moyenne', 'basse'].forEach(p => {
            const el = document.getElementById('priority-' + p);
            el.className = 'cursor-pointer border-2 rounded-xl p-4 text-center border-slate-200';
            if (p === value) el.classList.add(...colors[value].split(' '));
        });
    }
    </script>
</x-app-layout>