<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Entretien;
use App\Http\Requests\StoreEntretienRequest;

class EntretienController extends Controller
{
    public function create(Candidature $candidature)
    {
        $this->authorize('view', $candidature);

        return view('entretiens.create', compact('candidature'));
    }

    public function store(StoreEntretienRequest $request, Candidature $candidature)
    {
        $this->authorize('view', $candidature);
        $candidature->entretiens()->create($request->validated());

        return redirect()->route('candidatures.show', $candidature)
            ->with('success', 'Entretien ajouté.');
    }
}
