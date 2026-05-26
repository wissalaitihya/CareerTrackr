@forelse ($candidature->entretiens as $entretien)
    <div class="border-b py-3 flex justify-between items-start">
        <div>
            <p><strong>Type :</strong> {{ $entretien->type }}</p>
            <p><strong>Date :</strong> {{ $entretien->scheduled_at }}</p>
            @if($entretien->preparation_notes)
                <p><strong>Notes :</strong> {{ $entretien->preparation_notes }}</p>
            @endif
            @if($entretien->result)
                <p><strong>Résultat :</strong> {{ $entretien->result }}</p>
            @endif
        </div>
        <div class="flex gap-2">
            <a href="{{ route('entretiens.edit', [$candidature, $entretien]) }}"
               class="bg-yellow-400 text-white px-3 py-1 rounded">
                Modifier
            </a>
            <form action="{{ route('entretiens.destroy', [$candidature, $entretien]) }}"
                  method="POST"
                  onsubmit="return confirm('Supprimer cet entretien ?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 text-white px-3 py-1 rounded">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
@empty
    <p class="text-gray-500">Aucun entretien pour cette candidature.</p>
@endforelse