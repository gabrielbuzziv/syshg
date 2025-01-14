<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * Fields in database that can be fill.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /**
     * Get a list of permissions ids associated with the current article
     * @return array
     */
    public function getPermissionsListAttribute()
    {
        return $this->perms()->lists('id')->all();
    }
}
