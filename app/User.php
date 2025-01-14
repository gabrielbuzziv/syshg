<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * BCrypt Password
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Show User Role List in Attribute
     *
     * @param $roles
     * @return mixed
     */
    public function getRolesListAttribute($roles)
    {
        return $this->roles()->lists('id')->all();
    }

    /**
     * Relation Many to One between Orcamento and User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orcamentos()
    {
        return $this->hasMany('\App\Orcamento');
    }

    /**
     * Relation Many to One between User and Email
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emails()
    {
        return $this->hasMany('\App\Email');
    }

    /**
     * Relation Many to One between OrdemCompra and User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordemCompra()
    {
        return $this->hasMany('\App\OrdemCompra');
    }

    /**
     * Relation Many to One between Log and User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function log()
    {
        return $this->hasMany('\App\Log');
    }
}
