<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    /**
     * Array of fillable field in database.
     *
     * @var array
     */
    protected $fillable = [
        'codigo',
        'produto',
        'quantidade',
        'valor',
        'discount'
    ];

    /**
     * Relationship One to Many between Produto and Orçamento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orcamentos()
    {
        return $this->belongsTo('\App\Orcamento');
    }
}
