<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $table = 'competence'; // Nom de la table

    // Relation avec la classe
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }
}
