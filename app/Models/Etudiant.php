<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    // Ajout de 'photo' dans la liste des champs autorisés
    protected $fillable = ['prenom', 'nom', 'email', 'date_naissance', 'filiere_id', 'photo'];

    public function filiere() {
        return $this->belongsTo(Filiere::class);
    }

    public function cours() {
        return $this->belongsToMany(Cours::class, 'cours_etudiant');
    }
}