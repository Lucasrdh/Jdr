<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objet;

class ObjetController extends Controller
{
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $equipements = Objet::where('type', 'équipement')->get();
        $consommables = Objet::where('type', 'consommable')->get();
        $autres = Objet::where('type', 'autre')->get();

        return view('objets', compact('equipements', 'consommables', 'autres'));
    }
}
