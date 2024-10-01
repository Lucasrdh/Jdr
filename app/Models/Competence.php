<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $table = 'competences';

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classe_competence', 'competence_id', 'classe_id');
    }

    public function personnages()
    {
        return $this->belongsToMany(Personnage::class, 'personnage_competence', 'competence_id', 'personnage_id');
    }


}
