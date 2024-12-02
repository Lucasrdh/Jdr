<?php

use App\Http\Controllers\PersonnageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjetController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\MarchandController;
use App\Http\Controllers\OrController;
use App\Http\Controllers\AdminPersonnageController;


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


Route::get('/marchand/login', [MarchandController::class, 'showLoginForm'])->name('marchand.login');
Route::post('/marchand/login', [MarchandController::class, 'login'])->name('marchand.login.post');
Route::post('/marchand/logout', [MarchandController::class, 'logout'])->name('marchand.logout');
Route::post('/marchand/acheter', [MarchandController::class, 'acheter'])->name('marchand.acheter');
Route::post('/marchand/vendre', [MarchandController::class, 'vendre'])->name('marchand.vendre');
Route::get('/marchand', [MarchandController::class, 'index'])->name('marchand.index');

Route::get('/marchand/resultat{message}{details}', [MarchandController::class, 'resultat'])->name('marchand.resultat');

Route::post('/consommable/utiliser', [PersonnageController::class, 'utiliserConsommable'])->name('consommable.utiliser');

//admin

Route::get('/admin/personnages/manage', [AdminPersonnageController::class, 'manage'])->name('admin.personnages.manage');

// Routes pour la mise à jour des propriétés du personnage
Route::post('/admin/personnages/{personnage}/update', [AdminPersonnageController::class, 'update'])->name('admin.personnages.update');

// Routes pour gérer les objets
Route::post('/admin/personnages/{personnage}/addObjet', [AdminPersonnageController::class, 'addObjet'])->name('admin.personnages.addObjet');
Route::post('/admin/personnages/{personnage}/updateObjet', [AdminPersonnageController::class, 'updateObjet'])->name('admin.personnages.updateObjet');
Route::post('/admin/personnages/{personnage}/removeObjet', [AdminPersonnageController::class, 'removeObjet'])->name('admin.personnages.removeObjet');

// Routes pour gérer les compétences
Route::post('/admin/personnages/{personnage}/addCompetence', [AdminPersonnageController::class, 'addCompetence'])->name('admin.personnages.addCompetence');
Route::post('/admin/personnages/{personnage}/removeCompetence', [AdminPersonnageController::class, 'removeCompetence'])->name('admin.personnages.removeCompetence');


//test
Route::get('/pagetest/{id}/{amount}', [OrController::class, 'updateOr']);

