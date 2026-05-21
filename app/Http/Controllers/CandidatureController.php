<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Requests\UpdateCandidatureRequest;
use App\Models\Candidature;
use Illuminate\Support\Facades\Storage;

class CandidatureController extends Controller
{
    public function index()
    {
        $candidatures = auth()->user()->candidatures()->withCount('entretiens')->latest()->get();
        return view('candidatures.index', compact('candidatures'));
    }

    public function create()
    {
        return view('candidatures.create');
    }

    public function store(StoreCandidatureRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }
        
        auth()->user()->candidatures()->create($data);
        
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
        
        $data = $request->validated();
        
        if ($request->hasFile('attachment')) {
            if ($candidature->attachment) {
                Storage::delete($candidature->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }
        
        $candidature->update($data);

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
