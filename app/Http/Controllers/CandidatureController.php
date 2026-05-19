<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidatureController extends Controller
{
   public function index()
    {
        $candidatures = auth()->user()->candidatures()->with('entretiens')->get();
        return view('candidatures.index', compact('candidatures'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
