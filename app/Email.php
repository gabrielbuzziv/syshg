<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * Array of fields that is fillable in database.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'email',
        'orcamento_id',
        'user_id'
    ];

    /**
     * Relationship One to Many between Email and Orcamento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orcamento()
    {
        return $this->belongsTo('\App\Orcamento');
    }

    /**
     * Relationship One to Many between Email and User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
