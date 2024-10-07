<?php

use App\Http\Controllers\PersonnageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjetController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\MarchandController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route pour la page Personnages
Route::get('/personnages', [PersonnageController::class, 'personnages'])->name('personnages');

// Route pour la page Histoire
Route::get('/histoire', function () {
    return view('histoire');
})->name('histoire');


// Route pour la page Compétences
Route::get('/competences', [CompetenceController::class, 'showCompetences'])->name('competences');

// Route pour la page Objets
Route::get('/objets', [ObjetController::class, 'index'])->name('objets');


Route::get('/personnages/{id}', [PersonnageController::class, 'show'])->name('personnage.show');


// Route pour afficher le formulaire de connexion
// Afficher le formulaire de connexion
Route::get('/marchand/login', [MarchandController::class, 'showLoginForm'])->name('marchand.login');

// Soumettre le formulaire de connexion
Route::post('/marchand/login', [MarchandController::class, 'login'])->name('marchand.login.post');

// Afficher la page du marchand après connexion
Route::get('/marchand', [MarchandController::class, 'index'])->name('marchand.index');
