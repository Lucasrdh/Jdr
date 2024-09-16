<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route pour la page Personnages
Route::get('/personnages', [App\Http\Controllers\PersonnageController::class, 'index'])->name('personnages');


// Route pour la page Marchand
Route::get('/marchands', function () {
    return view('marchands');
})->name('marchands');

// Route pour la page Histoire
Route::get('/histoire', function () {
    return view('histoire');
})->name('histoire');

// Route pour la page Compétences
Route::get('/competences', function () {
    return view('competences');
})->name('competences');

// Route pour la page Objets
Route::get('/objets', function () {
    return view('objets');
})->name('objets');
