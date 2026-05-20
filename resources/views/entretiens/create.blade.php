<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un entretien — {{ $candidature->company_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow p-6 rounded">

                <form action="{{ route('entretiens.store', $candidature) }}"
                      method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Type *</label>
                        <select name="type" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="">-- Choisir --</option>
                            @foreach(['Téléphonique', 'Visio', 'Technique', 'RH', 'Sur site'] as $type)
                                <option value="{{ $type }}"
                                    {{ old('type') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Date et heure *</label>
                        <input type="datetime-local" name="scheduled_at"
                               value="{{ old('scheduled_at') }}"
                               class="w-full border rounded px-3 py-2 mt-1">
                        @error('scheduled_at')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Notes de préparation</label>
                        <textarea name="preparation_notes" rows="3"
                                  class="w-full border rounded px-3 py-2 mt-1">{{ old('preparation_notes') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Résultat</label>
                        <input type="text" name="result"
                               value="{{ old('result') }}"
                               class="w-full border rounded px-3 py-2 mt-1">
                        @error('result')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('candidatures.show', $candidature) }}"
                           class="text-gray-500">Annuler</a>
                        <button type="submit"
                                class="bg-blue-500 text-white px-6 py-2 rounded">
                            Enregistrer
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>