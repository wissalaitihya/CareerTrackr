<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Candidatures Archivées
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('candidatures.index') }}"
                   class="text-gray-500">
                    ← Retour à la liste
                </a>
            </div>

            @forelse ($candidatures as $candidature)
            <form action="{{ route('candidatures.restore', $candidature->id) }}"
      method="POST">
    @csrf
    <button type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded">
        Restaurer
    </button>
</form>
                <div class="bg-white shadow mb-4 p-4 rounded">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-lg">{{ $candidature->company_name }}</h3>
                            <p class="text-gray-600">{{ $candidature->job_title }}</p>
                            <p class="text-sm">Statut : {{ $candidature->status }}</p>
                            <p class="text-sm">Archivée le : {{ $candidature->deleted_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Aucune candidature archivée.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>