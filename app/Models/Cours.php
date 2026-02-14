<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $fillable = ['id_Prof','Nom_Prof','Prenom_Prof',
     'id_Etd',
    ];
}
