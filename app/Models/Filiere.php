<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    // 1. Les champs qu'on a le droit de remplir via un formulaire
    protected $fillable = ['nom', 'description'];

    // 2. La relation : Une filière possède PLUSIEURS étudiants (One-to-Many)
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
}