<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * Array de campos editáveis no banco de dados.
     *
     * @var array
     */
    protected $fillable = [
        'quantidade',
        'item',
        'valor',
        'order'
    ];

    /**
     * Seta nome customizado da tabela.
     *
     * @var string
     */
    protected $table = 'itens';

    /**
     * Relação One to Many entre OrdemCompra e Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ordemCompra()
    {
        return $this->belongsTo('\App\OrdemCompra');
    }
}
