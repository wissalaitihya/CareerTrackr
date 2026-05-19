<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\StoreCandidatureRequest;

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
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
