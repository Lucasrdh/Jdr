<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    use HasFactory;

    protected $table = 'objets'; // Nom de la table dans la base de données

    // Relation avec les classes
    public function classes() {
        return $this->belongsToMany(Classe::class, 'objet_classe');
    }
}
