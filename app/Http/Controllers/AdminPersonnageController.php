<?php

namespace App\Http\Controllers;
use App\Models\Personnage;
use App\Models\Objet;
use App\Models\Competence;
class AdminPersonnageController
{
    public function manage()
    {
        $personnages = Personnage::all();
        $objets = Objet::all();
        $competences = Competence::all();

        return view('admin.personnages.manage', compact('personnages', 'objets', 'competences'));
    }
    public function update(Request $request, Personnage $personnage)
    {
        $request->validate([
            'niveau' => 'nullable|integer|min:1',
            'blesse' => 'nullable|boolean',
            'severement_blesse' => 'nullable|boolean',
            'malade' => 'nullable|boolean',
            'tres_malade' => 'nullable|boolean',
            'bras_couper' => 'nullable|boolean',
            'jambe_couper' => 'nullable|boolean',
            'or' => 'nullable|integer|min:0',
        ]);

        $personnage->update($request->only([
            'niveau', 'blesse', 'severement_blesse', 'malade',
            'tres_malade', 'bras_couper', 'jambe_couper', 'or'
        ]));

        return redirect()->back()->with('success', 'Propriétés du personnage mises à jour.');
    }
    public function addObjet(Request $request, Personnage $personnage)
    {
        $request->validate([
            'objet_id' => 'required|exists:objets,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $objet = Objet::findOrFail($request->input('objet_id'));
        $existingObjet = $personnage->objets()->where('objet_id', $objet->id)->first();

        if ($existingObjet) {
            $personnage->objets()->updateExistingPivot($objet->id, [
                'quantite' => $existingObjet->pivot->quantite + $request->input('quantite')
            ]);
        } else {
            $personnage->objets()->attach($objet->id, ['quantite' => $request->input('quantite')]);
        }

        return redirect()->back()->with('success', 'Objet ajouté avec succès.');
    }
    public function updateObjet(Request $request, Personnage $personnage)
    {
        $request->validate([
            'objet_id' => 'required|exists:objets,id',
            'quantite' => 'required|integer|min:0',
        ]);

        if ($request->input('quantite') == 0) {
            $personnage->objets()->detach($request->input('objet_id'));
        } else {
            $personnage->objets()->updateExistingPivot($request->input('objet_id'), [
                'quantite' => $request->input('quantite'),
            ]);
        }

        return redirect()->back()->with('success', 'Quantité mise à jour.');
    }
    public function removeObjet(Request $request, Personnage $personnage)
    {
        $request->validate(['objet_id' => 'required|exists:objets,id']);

        $personnage->objets()->detach($request->input('objet_id'));

        return redirect()->back()->with('success', 'Objet retiré avec succès.');
    }
    public function addCompetence(Request $request, Personnage $personnage)
    {
        $request->validate(['competence_id' => 'required|exists:competences,id']);

        if (!$personnage->competences->contains($request->input('competence_id'))) {
            $personnage->competences()->attach($request->input('competence_id'));
        }

        return redirect()->back()->with('success', 'Compétence ajoutée avec succès.');
    }
    public function removeCompetence(Request $request, Personnage $personnage)
    {
        $request->validate(['competence_id' => 'required|exists:competences,id']);

        $personnage->competences()->detach($request->input('competence_id'));

        return redirect()->back()->with('success', 'Compétence retirée avec succès.');
    }

}
