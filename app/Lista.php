<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $fillable = [
        'nome',
        'descricao'
    ];

    public function contatos()
    {
        return $this->belongsToMany('\App\Contato');
    }
}
