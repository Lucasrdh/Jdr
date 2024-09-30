<?php

use App\Http\Controllers\PersonnageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjetController;
use App\Http\Controllers\CompetenceController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route pour la page Personnages
Route::get('/personnages', [PersonnageController::class, 'personnages'])->name('personnages');

// Route pour la page Marchand
Route::get('/marchands', function () {
    return view('marchands');
})->name('marchands');

// Route pour la page Histoire
Route::get('/histoire', function () {
    return view('histoire');
})->name('histoire');


// Route pour la page Compétences
Route::get('/competences', [CompetenceController::class, 'showCompetences'])->name('competences');

// Route pour la page Objets
Route::get('/objets', [ObjetController::class, 'index'])->name('objets');


Route::get('/personnages/{id}', [PersonnageController::class, 'show'])->name('personnage.show');
