<?php

namespace App\Http\Controllers;

use App\Models\Personnage;
use Illuminate\Http\Request;

class PersonnageController extends Controller
{
    public function index()
    {
        $personnages = Personnage::with(['competences', 'equipements', 'objets'])->get();
        return view('personnages.index', compact('personnages'));
    }

}
