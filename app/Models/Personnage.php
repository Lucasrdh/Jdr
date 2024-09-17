<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnage extends Model
{
    // Spécifiez le nom de la table si elle ne suit pas la convention Laravel
    protected $table = 'personnages';

    // Si la table n'a pas de timestamps, vous pouvez désactiver cette fonctionnalité
    public $timestamps = false;

    // Définissez les attributs de la table que vous souhaitez utiliser
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
}
