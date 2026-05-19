<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $candidature->company_name }} — {{ $candidature->job_title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Infos candidature --}}
            <div class="bg-white shadow p-6 rounded mb-6">
                <p><strong>Entreprise :</strong> {{ $candidature->company_name }}</p>
                <p><strong>Poste :</strong> {{ $candidature->job_title }}</p>
                <p><strong>Statut :</strong> {{ $candidature->status }}</p>
                <p><strong>Priorité :</strong> {{ $candidature->priority }}</p>
                <p><strong>Date :</strong> {{ $candidature->application_date }}</p>
                @if($candidature->offer_url)
                    <p><strong>Offre :</strong>
                        <a href="{{ $candidature->offer_url }}" target="_blank" class="text-blue-500">
                            Voir l'offre
                        </a>
                    </p>
                @endif
                @if($candidature->notes)
                    <p><strong>Notes :</strong> {{ $candidature->notes }}</p>
                @endif

                <div class="mt-4 flex gap-4">

    <a href="{{ route('candidatures.edit', $candidature) }}"
       class="bg-yellow-400 text-white px-4 py-2 rounded">
        Modifier
    </a>

    <form action="{{ route('candidatures.destroy', $candidature) }}"
          method="POST"
          onsubmit="return confirm('Archiver cette candidature ?')">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="bg-red-500 text-white px-4 py-2 rounded">
            Archiver
        </button>
    </form>

    <a href="{{ route('candidatures.index') }}"
       class="text-gray-500">
        Retour
    </a>

</div>

            {{-- Liste des entretiens --}}
            <div class="bg-white shadow p-6 rounded">
                <div class="flex justify-between mb-4">
                    <h3 class="font-bold text-lg">Entretiens</h3>
                </div>

                @forelse ($candidature->entretiens as $entretien)
                    <div class="border-b py-3">
                        <p><strong>Type :</strong> {{ $entretien->type }}</p>
                        <p><strong>Date :</strong> {{ $entretien->scheduled_at }}</p>
                        @if($entretien->preparation_notes)
                            <p><strong>Notes :</strong> {{ $entretien->preparation_notes }}</p>
                        @endif
                        @if($entretien->result)
                            <p><strong>Résultat :</strong> {{ $entretien->result }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">Aucun entretien pour cette candidature.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>