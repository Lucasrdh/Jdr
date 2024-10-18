<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnage;

class OrController extends Controller
{
    public function updateOr($id, $amount)
    {
        // Récupère le personnage via l'ID
        $personnage = Personnage::find($id);

        if (!$personnage) {
            return response()->json(['error' => 'Personnage non trouvé.'], 404);
        }

        // Mets à jour la quantité d'or
        $personnage->or += $amount;
        $personnage->save();

        return response()->json([
            'success' => true,
            'personnage_id' => $personnage->id,
            'nouveau_or' => $personnage->or,
        ]);
    }
}
