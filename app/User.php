<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'usuario', 'password', 'telefono', 'dui'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];


    // relacion muchos a muchos
    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    // si tiene muchos roles
    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('usuario', $roles)->first();
    }

    // si tiene solo un rol
    public function hasAnyRole($role){
        return null !== $this->roles()->where('usuario', $role)->first();
    }
}
