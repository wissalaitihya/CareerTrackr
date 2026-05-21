<x-app-layout>
    <div class="bg-[#f5f7fb] min-h-screen">
        <div class="max-w-3xl mx-auto px-6 py-8">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('dashboard') }}" class="hover:text-gray-700 transition-colors">Tableau de bord</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('candidatures.index') }}" class="hover:text-gray-700 transition-colors">Candidatures</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900 font-medium">Nouvelle candidature</span>
            </nav>

            <!-- Header -->
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

            <!-- Form Card -->
            <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
                <form action="{{ route('candidatures.store') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-slate-100">
                    @csrf

                    <!-- Section: Entreprise -->
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Entreprise</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="company_name" class="form-label">
                                    Nom de l'entreprise <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="company_name" name="company_name" 
                                       value="{{ old('company_name') }}" required
                                       class="form-input" placeholder="Ex : Doctolib">
                                @error('company_name')
                                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="offer_url" class="form-label">URL de l'offre</label>
                                <input type="url" id="offer_url" name="offer_url" 
                                       value="{{ old('offer_url') }}"
                                       class="form-input" placeholder="https://entreprise.com/careers/poste">
                                <p class="text-xs text-gray-400 mt-1.5">Optionnel — lien direct vers l'annonce</p>
                                @error('offer_url')
                                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section: Poste -->
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Poste</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="job_title" class="form-label">
                                    Intitulé du poste <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="job_title" name="job_title" 
                                       value="{{ old('job_title') }}" required
                                       class="form-input" placeholder="Ex : Développeur Full-Stack">
                                @error('job_title')
                                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="application_date" class="form-label">
                                    Date de candidature <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="application_date" name="application_date" 
                                       value="{{ old('application_date', date('Y-m-d')) }}" required
                                       class="form-input">
                                @error('application_date')
                                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section: Suivi -->
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Suivi</h2>
                        </div>

                        <div class="mb-6">
                            <label for="status" class="form-label">Statut</label>
                            <div class="relative">
                                <select id="status" name="status" class="form-select pr-10">
                                    <option value="postulé" {{ old('status') == 'postulé' ? 'selected' : '' }}>Postulé</option>
                                    <option value="entretien_rh" {{ old('status') == 'entretien_rh' ? 'selected' : '' }}>Entretien RH</option>
                                    <option value="test_technique" {{ old('status') == 'test_technique' ? 'selected' : '' }}>Test technique</option>
                                    <option value="entretien_final" {{ old('status') == 'entretien_final' ? 'selected' : '' }}>Entretien final</option>
                                    <option value="offre_reçue" {{ old('status') == 'offre_reçue' ? 'selected' : '' }}>Offre reçue</option>
                                    <option value="refusé" {{ old('status') == 'refusé' ? 'selected' : '' }}>Refusé</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Priorité</label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4" x-data="{ priority: '{{ old('priority', 'moyenne') }}' }">
                                <div class="priority-card" 
                                     :class="priority === 'haute' ? 'priority-card-selected-haute' : ''"
                                     @click="priority = 'haute'">
                                    <input type="radio" name="priority" value="haute" 
                                           {{ old('priority') == 'haute' ? 'checked' : '' }}
                                           class="hidden">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-lg">🔥</span>
                                        <span class="font-semibold text-sm" :class="priority === 'haute' ? 'text-orange-700' : 'text-gray-700'">Haute</span>
                                    </div>
                                    <p class="text-xs text-gray-500">Top priorité, à suivre de près</p>
                                </div>

                                <div class="priority-card" 
                                     :class="priority === 'moyenne' ? 'priority-card-selected-moyenne' : ''"
                                     @click="priority = 'moyenne'">
                                    <input type="radio" name="priority" value="moyenne" 
                                           {{ old('priority') == 'moyenne' ? 'checked' : '' }}
                                           class="hidden">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-lg">⚡</span>
                                        <span class="font-semibold text-sm" :class="priority === 'moyenne' ? 'text-blue-700' : 'text-gray-700'">Moyenne</span>
                                    </div>
                                    <p class="text-xs text-gray-500">Intéressant, suivi régulier</p>
                                </div>

                                <div class="priority-card" 
                                     :class="priority === 'basse' ? 'priority-card-selected-basse' : ''"
                                     @click="priority = 'basse'">
                                    <input type="radio" name="priority" value="basse" 
                                           {{ old('priority') == 'basse' ? 'checked' : '' }}
                                           class="hidden">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-lg">🌱</span>
                                        <span class="font-semibold text-sm" :class="priority === 'basse' ? 'text-green-700' : 'text-gray-700'">Basse</span>
                                    </div>
                                    <p class="text-xs text-gray-500">Option de secours</p>
                                </div>
                            </div>
                            @error('priority')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Section: Notes -->
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Notes</h2>
                        </div>

                        <div x-data="{ count: 0, max: 1000 }">
                            <textarea name="notes" rows="5" 
                                      class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 hover:border-slate-300 transition-all duration-200 resize-none"
                                      placeholder="Tes notes, points clés à retenir, questions à poser…"
                                      @input="count = $event.target.value.length"
                                      maxlength="1000">{{ old('notes') }}</textarea>
                            <p class="text-xs text-gray-400 mt-2 text-right">
                                <span x-text="count">0</span>/1000
                            </p>
                        </div>
                    </div>

                    <!-- Section: Pièce jointe -->
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Pièce jointe</h2>
                        </div>

                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center hover:border-green-400 hover:bg-green-50/30 transition-all duration-200"
                             x-data="{ dragging: false, fileName: '' }"
                             @dragover.prevent="dragging = true"
                             @dragleave.prevent="dragging = false"
                             @drop.prevent="dragging = false; if ($event.dataTransfer.files.length) { fileName = $event.dataTransfer.files[0].name; $refs.fileInput.files = $event.dataTransfer.files; }"
                             :class="dragging ? 'border-green-400 bg-green-50/50' : ''">
                            <input type="file" name="attachment" accept=".pdf,.doc,.docx" class="hidden" x-ref="fileInput" @change="fileName = $event.target.files[0]?.name || ''">
                            <div class="cursor-pointer" @click="$refs.fileInput.click()">
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
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bottom Actions -->
                    <div class="p-8 bg-gray-50/50">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('candidatures.index') }}" 
                               class="px-6 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all duration-200">
                                Annuler
                            </a>
                            <button type="submit" 
                                    class="flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm font-semibold rounded-xl shadow-lg shadow-green-500/25 hover:shadow-xl hover:shadow-green-500/30 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
