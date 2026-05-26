<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Entretien;
use App\Http\Requests\StoreEntretienRequest;
use App\Http\Requests\UpdateEntretienRequest;

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
    public function update(UpdateEntretienRequest $request, Candidature $candidature, Entretien $entretien)
   {
    $this->authorize('view', $candidature);
    $entretien->update($request->validated());

    return redirect()->route('candidatures.show', $candidature)
        ->with('success', 'Entretien mis à jour.');
    }

    public function destroy(Entretien $entretien){
        $this->authorize('view', $entretien->candidature);
        $entretien->delete();

        return redirect()->back()
            ->with('success', 'Entretien supprimé.');
    }
}
