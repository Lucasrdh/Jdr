<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ObjetClasse extends Pivot
{
    use HasFactory;

    protected $table = 'objet_classe'; // Nom de la table dans la base de données
}
