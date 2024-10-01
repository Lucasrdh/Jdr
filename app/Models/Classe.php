<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $table = 'classes';

    public function personnages()
    {
        return $this->belongsToMany(Personnage::class, 'personnage_classe', 'classe_id', 'personnage_id');
    }
    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'classe_competence', 'classe_id', 'competence_id');
    }
}

