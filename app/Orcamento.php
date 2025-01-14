<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    /**
     * Array of fillable field in database.
     *
     * @var array
     */
    protected $fillable = [
        'cliente',
        'placa',
        'veiculo',
        'km',
        'observacao',
        'telefone_comercial',
        'telefone_residencial',
        'celular',
        'condicoes_pagamento',
        'user_id',
        'empresa_id',
        'total'
    ];

    public function setPlacaAttribute($placa)
    {
        $this->attributes['placa'] = strtoupper($placa);
    }

    /**
     * Relation One to Many between User and Orcamento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('\App\User');
    }

    /**
     * Relation One to Many between Empresa and Orcamento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa() {
        return $this->belongsTo('\App\Empresa');
    }

    /**
     * Relation Many to One between Orcamento and Servico
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicos()
    {
        return $this->hasMany('\App\Servico');
    }

    /**
     * Relation Many to One between Orcamento and Produto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produtos()
    {
        return $this->hasMany('\App\Produto');
    }

    /**
     * Relation Many to One between Orcamento and Email
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emails()
    {
        return $this->hasMany('\App\Email');
    }
}
