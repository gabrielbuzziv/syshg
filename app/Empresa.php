<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    /**
     * Array of Fillable fields in database
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'apelido', 'cep', 'rua', 'numero', 'bairro',
        'cidade', 'estado', 'cnpj', 'ie', 'telefone', 'site',
        'email', 'email_nfe', 'logo', 'create_at', 'id'
    ];

    /**
     * Relation Many to One between Orcamento and Empresa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orcamentos()
    {
        return $this->hasMany('\App\Orcamento');
    }

    /**
     * Relation Many to One between OrdemCompra and Empresa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordemCompra()
    {
        return $this->hasMany('\App\OrdemCompra');
    }
}
