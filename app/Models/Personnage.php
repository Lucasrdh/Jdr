<?php

namespace App\Models;



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnage extends Model
{
    use HasFactory;

    protected $fillable = ['code_identification', 'or','blesse','severement_blesse','malade','tres_malade','bras_couper','jambe_couper',];


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
}

