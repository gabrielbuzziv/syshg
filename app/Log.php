<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    protected $fillable = [
        'relacao_id',
        'user_id',
        'acao',
        'tipo',
        'created_at'
    ];

    /**
     * Salva o log
     *
     * @param $relacao
     * @param $acao
     * @param $tipo
     */
    public static function log($relacao, $acao, $tipo)
    {
        Log::create([
            'relacao_id' => $relacao,
            'user_id' => Auth::user()->id,
            'acao' => $acao,
            'tipo' => $tipo
        ]);
    }

    /**
     * Scope, lista onde o tipo é orcamentos
     *
     * @param $query
     * @return mixed
     */
    public function scopeOrcamentos($query)
    {
        return $query->where('tipo', '=', 'orcamentos');
    }

    /**
     * Scope, lista onde o tipo é ordemCompra
     *
     * @param $query
     * @return mixed
     */
    public function scopeOrdemCompra($query)
    {
        return $query->where('tipo', '=', 'ordemCompra');
    }

    /**
     * Reção One to Many entre User e Log
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
