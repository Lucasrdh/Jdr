<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'objets';
    protected $fillable = ['nom', 'valeur', 'rarete', 'type', 'image', 'description','stock'];
    public function personnages()
    {
        return $this->belongsToMany(Personnage::class, 'personnage_objet')->withPivot('quantite');
    }


}


