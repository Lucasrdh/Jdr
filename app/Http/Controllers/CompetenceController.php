<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    public function index()
    {
        // Récupérer toutes les classes avec leurs compétences associées
        $classes = Classe::with('competences')->get();

        // Récupérer les compétences disponibles pour toutes les classes (si tu en as)
        // Remarque : Assure-toi que les compétences sans classe sont gérées si nécessaire
        $competencesGlobales = Competence::whereNull('classe_id')->orWhere('classe_id', 0)->get();

        return view('competences', compact('classes', 'competencesGlobales'));
    }
    public function showCompetences()
    {
        // Récupérer toutes les classes avec leurs compétences
        $classes = Classe::with('competences')->get();

        // Récupérer les compétences générales (sans classe spécifique)
        $competencesGenerales = Competence::whereNull('classe_id')->get();

        return view('competences', compact('classes', 'competencesGenerales'));
    }
}
