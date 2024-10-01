<?php

namespace App\Http\Controllers;

use App\Models\Objet;
use App\Models\Personnage;
use Illuminate\Http\Request;

class PersonnageController extends Controller
{
    // Récupère tous les personnages avec leurs classes
    public function personnages()
    {
        $personnages = Personnage::with('classes')->get();
        return view('personnages', compact('personnages'));
    }

    // Affiche un personnage spécifique avec ses objets et compétences
    public function show($id)
    {
        // Récupérer le personnage avec ses objets et autres relations
        $personnage = Personnage::with(['objets', 'competences', 'classes'])->findOrFail($id);
        $objets = Objet::all()->groupBy('type'); // Groupement par type

        $niveau = $personnage->niveau;
        $modificateurBase = 2; // Modificateur de base
        $modificateurTotal = $modificateurBase + ($niveau * 2); // Modificateur total
        $modificateurAttaque = $modificateurTotal; // Initialisation du modificateur d'attaque
        $modificateurDefense = $modificateurTotal; // Initialisation du modificateur de défense

        // Ajouter les modificateurs des objets
        foreach ($personnage->objets as $objet) {
            if ($objet->type_modificateur === 'Attaque') {
                $modificateurAttaque += $objet->modificateur;
            } elseif ($objet->type_modificateur === 'Défense') {
                $modificateurDefense += $objet->modificateur;
            }
        }

        // Ajouter les modificateurs des compétences
        foreach ($personnage->competences as $competence) {
            if ($competence->type_modificateur === 'Attaque') {
                $modificateurAttaque += $competence->modificateur;
            } elseif ($competence->type_modificateur === 'Défense') {
                $modificateurDefense += $competence->modificateur;
            }
            // Si la compétence n'a pas de type_modificateur (par exemple, "confiant"), l'ajouter aux modificateurs
            if (is_null($competence->type_modificateur)) {
                $modificateurTotal += $competence->modificateur; // Augmenter le modificateur total
                $modificateurAttaque += $competence->modificateur; // Augmenter aussi l'attaque
                $modificateurDefense += $competence->modificateur; // Augmenter aussi la défense
            }
        }

        // Calcul du malus
        $malus = 0;

        if ($personnage->blesse) {
            $malus += 3; // Malus si blessé
        }
        if ($personnage->severement_blesse) {
            $malus += 8; // Malus si sévèrement blessé
        }
        if ($personnage->malade) {
            $malus += 3; // Malus si malade
        }
        if ($personnage->tres_malade) {
            $malus += 8; // Malus si très malade
        }

        // Appliquer le malus à tous les modificateurs
        $modificateurTotal -= $malus;
        $modificateurAttaque -= $malus;
        $modificateurDefense -= $malus;

        return view('personnage.show', compact('personnage', 'objets', 'modificateurTotal', 'modificateurAttaque', 'modificateurDefense', 'malus'));
    }


}
