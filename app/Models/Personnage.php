<?php

namespace App\Models;



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnage extends Model
{
    use HasFactory;

    protected $fillable = ['code_identification','niveau','or','blesse','severement_blesse','malade','tres_malade','bras_couper','jambe_couper',];


    public function objets()
    {
        return $this->belongsToMany(Objet::class, 'personnage_objet')->withPivot('quantite');
    }


    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'personnage_competence', 'personnage_id', 'competence_id');
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'personnage_classe', 'personnage_id', 'classe_id');
    }
    public function getPrixModifie(Objet $objet)
    {
        $modificateurs = ModificateurPrix::where(function ($query) use ($objet) {
            $query->where('objet_id', $objet->id) // Modificateurs spécifiques à cet objet
            ->orWhereNull('objet_id');      // Modificateurs globaux
        })
            ->where(function ($query) {
                $query->where('source_type', 'competence')
                    ->whereIn('source_id', $this->competences->pluck('id'))
                    ->orWhere('source_type', 'item')
                    ->whereIn('source_id', $this->objets->pluck('id'));
            })
            ->get();

        $totalModificateur = $modificateurs->sum('modificateur');
        return $objet->prix + ($objet->prix * $totalModificateur / 100);
    }

}

