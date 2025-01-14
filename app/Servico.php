<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    /**
     * Array with fillable field in database.
     * @var array
     */
    protected $fillable = [
        'servico',
        'quantidade',
        'valor',
        'lancamento',
        'discount'
    ];

    /**
     * Relation One to Many between Servico and Orcamento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orcamentos()
    {
        return $this->belongsTo('\App\Orcamento');
    }
}
