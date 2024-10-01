<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnage;
use App\Models\Objet;

class MarchandController extends Controller
{
    protected $personnage; // Vous pouvez supprimer cette ligne si vous ne l'utilisez pas

    public function getPersonnageWithObjects($personnageId)
    {
        return Personnage::with('objets')->find($personnageId);
    }



    public function login(Request $request)
    {
        // Valider le nom du personnage
        $request->validate([
            'nom' => 'required|string',
        ]);

        // Rechercher le personnage dans la base de données
        $personnage = Personnage::where('nom', $request->nom)->first();

        if ($personnage) {
            // Si le personnage existe, stockez-le dans la session
            session(['personnage' => $personnage]);
            return redirect()->route('marchand.index')->with('success', 'Connexion réussie !');
        } else {
            // Si le personnage n'existe pas, vous pouvez rediriger avec un message d'erreur
            return redirect()->back()->withErrors(['nom' => 'Personnage non trouvé.']);
        }
    }

    public function index()
    {
        // Récupérer le personnage de la session
        $this->personnage = session('personnage');

        if (!$this->personnage) {
            // Rediriger vers la page de connexion si le personnage n'est pas trouvé
            return redirect()->route('marchand.login');
        }

        $objets = Objet::all(); // Récupère tous les objets disponibles
        return view('marchand.index', ['personnage' => $this->personnage, 'objets' => $objets]);
    }



    public function acheter(Request $request)
    {
        // Valider la requête
        $request->validate([
            'objet_id' => 'required|exists:objets,id',
        ]);

        // Récupérer le personnage de la session
        $this->personnage = session('personnage');

        // Récupérer l'objet à acheter
        $objet = Objet::find($request->objet_id);

        // Vérifier si le personnage a assez d'or
        if ($this->personnage->or >= $objet->prix) {
            // Met à jour l'or du personnage
            $this->personnage->or -= $objet->prix;
            $this->personnage->save();

            // Ajouter l'objet à la possession du personnage
            $this->personnage->objets()->attach($objet->id);

            return back()->with('success', 'Objet acheté avec succès !');
        } else {
            return back()->withErrors(['or' => 'Pas assez d\'or pour acheter cet objet.']);
        }
    }

    public function vendre(Request $request)
    {
        // Valider la requête
        $request->validate([
            'objet_id' => 'required|exists:personnage_objet,objet_id',
        ]);

        // Récupérer le personnage de la session
        $this->personnage = session('personnage');

        // Récupérer l'objet à vendre
        $objet = Objet::find($request->objet_id);

        // Retirer l'objet de la possession du personnage
        $this->personnage->objets()->detach($objet->id);

        // Met à jour l'or du personnage
        $this->personnage->or += $objet->prix; // Ajoute le prix à l'or
        $this->personnage->save();

        return back()->with('success', 'Objet vendu avec succès !');
    }


}
