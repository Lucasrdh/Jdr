<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    use HasFactory;

    protected $table = 'objets';

    public function personnages()
    {
        return $this->belongsToMany(Personnage::class, 'personnage_objet', 'objet_id', 'personnage_id');
    }

}
