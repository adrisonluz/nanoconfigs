<?php namespace NanoSoluctions\NanoConfigs\Models;
 
use Illuminate\Foundation\Auth\User as Authenticatable;
 
class NanoNivel extends Authenticatable {
 
    protected $table = 'nano_niveis';
 
    /**
     * Usuários com mesmo nível de acesso
     */
    public function usuarios() {
        return $this->belongsToMany('NanoSoluctions\NanoConfigs\Models\NanoUser');
    }
 
}
