<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnage; // Assurez-vous que votre modèle Personnage est correctement importé

class MarchandController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('marchand.login');
    }

    // Gérer la soumission du formulaire de connexion
    public function login(Request $request)
    {
        // Valider le formulaire (le champ 'nom' est requis)
        $request->validate([
            'nom' => 'required|string',
        ]);

        // Vérifier si le personnage existe dans la base de données
        $personnage = Personnage::where('code_identification', $request->input('nom'))->first();

        if ($personnage) {
            // Si le personnage existe, le rediriger vers la page du marchand
            return redirect()->route('marchand.index')->with('personnage', $personnage);
        } else {
            // Si le personnage n'existe pas, renvoyer une erreur
            return back()->withErrors(['nom' => 'Personnage non trouvé ou code incorrect']);
        }
    }

    // Afficher la page du marchand
    public function index(Request $request)
    {
        // Récupérer le personnage connecté depuis la session
        $personnage = $request->session()->get('personnage');

        if (!$personnage) {
            return redirect()->route('marchand.login');
        }

        // Obtenir les objets du personnage
        $objets = $personnage->objets; // Assurez-vous que la relation avec les objets est bien définie dans votre modèle Personnage

        return view('marchand.index', compact('personnage', 'objets'));
    }
}
