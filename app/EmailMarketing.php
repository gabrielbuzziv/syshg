<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailMarketing extends Model
{
    protected $fillable = [
        'user_id',
        'titulo',
        'conteudo'
    ];

    public function users()
    {
        return $this->belongsTo('\App\User');
    }
}
