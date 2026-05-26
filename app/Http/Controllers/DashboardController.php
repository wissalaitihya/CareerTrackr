<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalCandidatures = $user->candidatures()->count();
        $enCours = $user->candidatures()->whereNotIn('status', ['refusé', 'offre_reçue'])->count();
        $entretiensSemaine = $user->candidatures()
            ->with('entretiens')
            ->get()
            ->flatMap->entretiens
            ->where('scheduled_at', '>=', now()->startOfWeek())
            ->where('scheduled_at', '<=', now()->endOfWeek())
            ->count();
        $offresRecues = $user->candidatures()->where('status', 'offre_reçue')->count();

        $prochainsEntretiens = $user->candidatures()
            ->with(['entretiens' => function($q) {
                $q->where('scheduled_at', '>=', now())->orderBy('scheduled_at');
            }])
            ->get()
            ->flatMap->entretiens
            ->sortBy('scheduled_at')
            ->take(3);

        $candidaturesRecentes = $user->candidatures()
            ->latest()
            ->take(4)
            ->get();

        // Funnel
        $postule = $user->candidatures()->count();
        $entretienPlanifie = $user->candidatures()->whereIn('status', ['entretien_rh', 'test_technique', 'entretien_final'])->count();
        $offre = $user->candidatures()->where('status', 'offre_reçue')->count();

        return view('dashboard', compact(
            'totalCandidatures',
            'enCours',
            'entretiensSemaine',
            'offresRecues',
            'prochainsEntretiens',
            'candidaturesRecentes',
            'postule',
            'entretienPlanifie',
            'offre'
        ));
    }
}

