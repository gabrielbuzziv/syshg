<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemCompra extends Model
{
    /**
     * Array of field is fillable in database.
     *
     * @var array
     */
    protected $fillable = [
        'empresa_id',
        'user_id',
        'para',
        'onde_comprar',
        'created_at',
        'status'
    ];

    /**
     * Set the custom name of table.
     *
     * @var string
     */
    protected $table = 'ordens_compra';

    /**
     * Relation One to Many between OrdemCompra and Empresa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo('\App\Empresa');
    }

    /**
     * Relation One to Many between OrdemCompra and User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    /**
     * Relação Many to One entre Item e OrdemCompra
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function item()
    {
        return $this->hasMany('\App\Item');
    }
}
