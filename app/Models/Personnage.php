<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class Personnage extends Model
{
    use HasFactory;

    protected $table = 'personnages';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'niveau',
        'classe',
        'equipement',
        'objets',
        'competence',
        'blesse',
        'severement_blesse',
        'malade',
        'tres_malade',
    ];

// Modèle Personnage.php
    public function objets()
    {
        return $this->belongsToMany(Objet::class, 'personnage_objet', 'personnage_id', 'objet_id');
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
