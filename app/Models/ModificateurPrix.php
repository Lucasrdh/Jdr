<?php
namespace App\Models;
class ModificateurPrix extends Model
{
    protected $fillable = ['source_type', 'source_id', 'personnage_id', 'modificateur'];

    public function personnage()
    {
        return $this->belongsTo(Personnage::class);
    }

    public function source()
    {
        return $this->morphTo();
    }
}
