<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes Candidatures
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('candidatures.create') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded">
                    + Nouvelle candidature
                </a>
            </div>

            @forelse ($candidatures as $candidature)
                <div class="bg-white shadow mb-4 p-4 rounded">
                    <div class="flex justify-between">
                        <div>
                            <h3 class="font-bold text-lg">{{ $candidature->company_name }}</h3>
                            <p class="text-gray-600">{{ $candidature->job_title }}</p>
                            <p class="text-sm">Statut : {{ $candidature->status }}</p>
                            <p class="text-sm">Priorité : {{ $candidature->priority }}</p>
                            <p class="text-sm">Entretiens : {{ $candidature->entretiens_count }}</p>
                        </div>
                        <div>
                            <a href="{{ route('candidatures.show', $candidature) }}"
                               class="text-blue-500">Voir</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Aucune candidature pour le moment.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>