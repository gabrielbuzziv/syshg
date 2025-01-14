<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'status'
    ];

    public function listas()
    {
        return $this->belongsToMany('\App\Lista');
    }
}
