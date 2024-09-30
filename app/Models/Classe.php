<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $table = 'classe'; // Nom de la table dans la base de données

    // Relation avec les objets
    public function objets() {
        return $this->belongsToMany(Objet::class, 'objet_classe');
    }

    // Relation avec les compétences
    public function competences()
    {
        return $this->hasMany(Competence::class, 'classe_id');
    }
}
