<?php namespace NanoSoluctions\NanoConfigs\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use NanoUser;

class NanoNvaccess extends Authenticatable {

    protected $table = 'nano_nvaccess';

    /**
     * Usuários com mesmo nível de acesso
     */
    public function usuarios() {
        return $this->belongsToMany(NanoUser::class);
    }

}
