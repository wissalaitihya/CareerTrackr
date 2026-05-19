<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\StoreCandidatureRequest;
use App\Http\Requests\Auth\UpdateCandidatureRequest;
use App\Models\Candidature;

class CandidatureController extends Controller
{
   public function index()
    {
        $candidatures = auth()->user()->candidatures()->with('entretiens')->get();
        return view('candidatures.index', compact('candidatures'));
    }

    public function create()
    {
        return view ('candidatures.create');
    }

    public function store(StoreCandidatureRequest $request)
    {
        auth()->user()->candidatures()->create($request->validated());
        return redirect()->route('candidatures.index')->with('success', 'Candidature créée avec succès.');
    }

    public function show($id)
    {
        $candidature = auth()->user()->candidatures()->findOrFail($id);
        $this->authorize('view', $candidature);
        $candidature->load('entretiens');

        return view('candidatures.show', compact('candidature'));
    }

    public function edit(Candidature $candidature)
    {
        $this->authorize('update', $candidature);

    return view('candidatures.edit', compact('candidature'));
    }

    public function update(UpdateCandidatureRequest $request, Candidature $candidature)
    {
         $this->authorize('update', $candidature);
    $candidature->update($request->validated());

    return redirect()->route('candidatures.show', $candidature)
        ->with('success', 'Candidature mise à jour.');

    }

    public function archives()
    {
    $candidatures = auth()->user()->candidatures()->onlyTrashed()->latest()->get();

    return view('candidatures.archives', compact('candidatures'));
    }

    public function destroy(Candidature $candidature)
    {
    $this->authorize('delete', $candidature);
    $candidature->delete();

    return redirect()->route('candidatures.index')->with('success', 'Candidature archivée.');
    }
}
