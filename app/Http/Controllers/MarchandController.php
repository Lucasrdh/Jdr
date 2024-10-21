<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnage;
use App\Models\Objet;
use Illuminate\Routing\Controller;

// Importation de la classe Controller

class MarchandController extends Controller
{
    public function showLoginForm()
    {
        return view('marchand.login');  // Assure-toi que c'est bien "login.blade.php" dans "resources/views/marchand/"
    }

    // Gérer la connexion
    public function login(Request $request)
    {
        // Valider le formulaire (le champ 'code_identification' est requis)
        $request->validate([
            'code_identification' => 'required|string',
        ]);

        // Vérifier si le personnage existe avec le code d'identification
        $personnage = Personnage::where('code_identification', $request->input('code_identification'))->first();

        if ($personnage) {
            // Si le personnage existe, le rediriger vers la page du marchand
            $request->session()->put(['personnage' => $personnage]);

            return redirect()->route('marchand.index');
        } else {
            // Si le personnage n'existe pas, renvoyer une erreur
            return back()->withErrors(['code_identification' => 'Code d\'identification incorrect']);
        }

    }


    // Méthode pour déconnexion
    public function logout(Request $request)
    {
        $request->session()->forget('personnage');
        return redirect()->route('marchand.login');  // Redirige vers la page de connexion après déconnexion
    }

    public function index(Request $request)
    {
        // Récupérer le personnage connecté depuis la session
        $personnage = $request->session()->get('personnage');

        if (!$personnage) {
            return redirect()->route('marchand.login');
        }

        // Obtenir les objets disponibles en vente
        $objets = Objet::whereNotNull('stock')->where('stock', '>', 0)->get();

        return view('marchand.index', compact('personnage', 'objets'));
    }


    // Méthode d'achat
    public function resultat(Request $request, $message, $details)
    {
        return view('marchand.resultat', [
            'message' => $message,
            'details' => $details
        ]);
    }

    public function acheter(Request $request)
    {
        $personnage = $request->session()->get('personnage');

        if (!$personnage) {
            return redirect()->route('marchand.login');
        }

        $objet = Objet::findOrFail($request->input('objet_id'));

        // Vérifier si l'objet est en stock et que le personnage a assez d'or
        if ($objet->stock > 0 && $personnage->or >= $objet->valeur) {
            // Réduire le stock de l'objet
            $objet->stock -= 1;
            $objet->save();

            // Réduire l'or du personnage
            $personnage->or -= $objet->valeur;
            $personnage->save();

            // Vérifier si le personnage possède déjà cet objet
            $existingObjet = $personnage->objets()->where('objet_id', $objet->id)->first();

            if ($existingObjet) {
                // Si le personnage possède déjà l'objet, augmenter la quantité
                $personnage->objets()->updateExistingPivot($objet->id, [
                    'quantite' => $existingObjet->pivot->quantite + 1
                ]);
            } else {
                // Sinon, ajouter l'objet avec une quantité de 1
                $personnage->objets()->attach($objet->id, ['quantite' => 1]);
            }

            // Rediriger vers la page de résultat avec succès
            return redirect()->route('marchand.resultat', [
                'message' => 'Objet acheté avec succès !',
                'details' => 'Le stock restant de cet objet est de ' . $objet->stock . '. Votre nouveau solde d\'or est de ' . $personnage->or . ' pièces.'
            ]);
        }

        // Si l'achat échoue, rediriger vers la page de résultat avec un message d'erreur
        return redirect()->route('marchand.resultat', [
            'message' => 'Erreur',
            'details' => 'Pas assez d\'or ou stock épuisé.'
        ]);
    }


    // Méthode de vente
    public function vendre(Request $request)
    {
        $personnage = $request->session()->get('personnage');
        if (!$personnage) {
            return redirect()->route('marchand.login');
        }

        $objet = Objet::findOrFail($request->input('objet_id'));

        // Vérifier si l'objet appartient au personnage
        $existingObjet = $personnage->objets()->where('objet_id', $objet->id)->first();

        if ($existingObjet) {
            if ($existingObjet->pivot->quantite > 1) {
                // Si le personnage a plus d'un exemplaire, diminuer la quantité
                $personnage->objets()->updateExistingPivot($objet->id, [
                    'quantite' => $existingObjet->pivot->quantite - 1
                ]);
            } else {
                // Sinon, détacher complètement l'objet de l'inventaire du personnage
                $personnage->objets()->detach($objet->id);
            }

            // Ajouter la valeur de l'objet à l'or du personnage
            $gainOr = $objet->valeur * 0.7;
            $personnage->or += $gainOr;
            $personnage->save();
            // Actualiser les données du personnage dans la session après la vente
            $personnageActualise = Personnage::with('objets')->find($personnage->id);
            $request->session()->put('personnage', $personnageActualise);

            // Rediriger vers la page de résultat avec succès
            return redirect()->route('marchand.resultat', [
                'message' => 'Objet vendu avec succès !',
                'details' => 'Vous avez vendu ' . $objet->nom . '. Votre nouveau solde d\'or est de ' . $personnageActualise->or . ' pièces.'
            ]);
        }

        // Si la vente échoue, rediriger vers la page de résultat avec un message d'erreur
        return redirect()->route('marchand.resultat', [
            'message' => 'Erreur',
            'details' => 'Vous ne possédez pas cet objet.'

        ]);
    }


}
