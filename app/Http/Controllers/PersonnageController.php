<?php

namespace App\Http\Controllers;

use App\Models\Personnage;
use Illuminate\Http\Request;

class PersonnageController extends Controller
{
    public function personnages()
    {
        $personnages = Personnage::all();  // Récupère tous les personnages
        return view('personnages.personnages', compact('personnages'));
    }

}
