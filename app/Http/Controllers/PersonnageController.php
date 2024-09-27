<?php

namespace App\Http\Controllers;

use App\Models\Personnage;
use Illuminate\Http\Request;

class PersonnageController extends Controller
{
    public function personnages()
    {
        $personnages = Personnage::all();  // Récupère tous les personnages
        return view('personnages', compact('personnages'));
    }
    public function show($id)
    {
        $personnage = Personnage::findOrFail($id); // Récupère le personnage ou lance une erreur 404 si non trouvé
        return view('personnage.show', compact('personnage')); // Retourne la vue avec les détails du personnage
    }


}
