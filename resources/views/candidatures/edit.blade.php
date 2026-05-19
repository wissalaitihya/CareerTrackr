<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier la candidature
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow p-6 rounded">

                <form action="{{ route('candidatures.update', $candidature) }}"
                      method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Entreprise *</label>
                        <input type="text" name="company_name"
                               value="{{ old('company_name', $candidature->company_name) }}"
                               class="w-full border rounded px-3 py-2 mt-1">
                        @error('company_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Poste visé *</label>
                        <input type="text" name="job_title"
                               value="{{ old('job_title', $candidature->job_title) }}"
                               class="w-full border rounded px-3 py-2 mt-1">
                        @error('job_title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">URL de l'offre</label>
                        <input type="url" name="offer_url"
                               value="{{ old('offer_url', $candidature->offer_url) }}"
                               class="w-full border rounded px-3 py-2 mt-1">
                        @error('offer_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Statut *</label>
                        <select name="status" class="w-full border rounded px-3 py-2 mt-1">
                            @foreach(['envoyée', 'en_attente', 'entretien', 'offre', 'refusée'] as $status)
                                <option value="{{ $status }}"
                                    {{ old('status', $candidature->status) == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Priorité *</label>
                        <select name="priority" class="w-full border rounded px-3 py-2 mt-1">
                            @foreach(['basse', 'moyenne', 'haute'] as $priority)
                                <option value="{{ $priority }}"
                                    {{ old('priority', $candidature->priority) == $priority ? 'selected' : '' }}>
                                    {{ ucfirst($priority) }}
                                </option>
                            @endforeach
                        </select>
                        @error('priority')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Notes</label>
                        <textarea name="notes" rows="3"
                                  class="w-full border rounded px-3 py-2 mt-1">{{ old('notes', $candidature->notes) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Date de candidature *</label>
                        <input type="date" name="application_date"
                               value="{{ old('application_date', $candidature->application_date) }}"
                               class="w-full border rounded px-3 py-2 mt-1">
                        @error('application_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('candidatures.show', $candidature) }}"
                           class="text-gray-500">Annuler</a>
                        <button type="submit"
                                class="bg-blue-500 text-white px-6 py-2 rounded">
                            Mettre à jour
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>