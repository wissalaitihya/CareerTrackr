<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CandidatureController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntretienController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function(){
    Route::resource('candidatures', CandidatureController::class);
});

Route::get('candidatures/archives', [CandidatureController::class, 'archives'])->name('candidatures.archives');

Route::get('candidatures/{id}/restore',[CandidatureController::class, 'restore'])->name('candidatures.restore');

Route::get('candidatures/{candidature}/entretiens/create', [EntretienController::class, 'create'])->name('entretiens.create');
Route::post('candidatures/{candidature}/entretiens', [EntretienController::class, 'store'])->name('entretiens.store');
Route::get('candidatures/{candidature}/entretiens/{entretien}/edit', [EntretienController::class, 'edit'])->name('entretiens.edit');
Route::put('candidatures/{candidature}/entretiens/{entretien}', [EntretienController::class, 'update'])->name('entretiens.update');
Route::delete('candidatures/{candidature}/entretiens/{entretien}', [EntretienController::class, 'destroy'])->name('entretiens.destroy');
require __DIR__.'/auth.php';
