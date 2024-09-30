<?php

namespace App\Http\Controllers;

use App\Models\Objet;
use App\Models\Personnage;
use Illuminate\Http\Request;

class PersonnageController extends Controller
{
    public function personnages()
    {
        $personnages = Personnage::with('classes')->get();
        return view('personnages', compact('personnages'));
    }

    public function show($id)
    {
        // Récupérer le personnage avec ses objets et autres relations
        $personnage = Personnage::with(['objets', 'competences', 'classes'])->findOrFail($id);

        $niveau = $personnage->niveau;
        $modificateurBase = 3; // Modificateur de base par niveau
        $modificateurTotal = $modificateurBase + ($niveau * 2);
        $modificateurAttaque = $modificateurTotal;
        $modificateurDefense = $modificateurTotal;

        // Vérification des objets associés
        $personnageArr = $personnage->toArray();
        //var_dump($personnageArr);
        foreach ($personnageArr as $key => $value) {
            //            var_dump($key);
            if ($key == "objets") {
                foreach ($personnageArr["objets"] as $insideKey => $insideValue) {
                    var_dump($insideValue);

                    /*
                     * Ici boucler dans les arrays pour choper if modificateur != NAN
                     *
                     * */


//                    if ($insideKey->modificateur && $objet->type_modificateur === 'Attaque') {
//                        $modificateurAttaque += $objet->modificateur;
//                    } elseif ($objet->modificateur != NAN && $objet->type_modificateur === 'Défense') {
//                        $modificateurDefense += $objet->modificateur;
//                    }
                }
            }


        }


        return view('personnage.show', compact('personnage', 'modificateurTotal', 'modificateurAttaque', 'modificateurDefense'));
    }


}

