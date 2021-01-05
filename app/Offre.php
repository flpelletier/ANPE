<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Offre extends Model
{
    use HasRoles;

    public $timestamps = false;
    protected $fillable = [
        'titre', 'description', 'niveau',
    ];
}
