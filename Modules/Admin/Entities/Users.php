<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//spatie
use Spatie\Permission\Traits\HasRoles;

class Users extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;  //importante adicionar HasRoles

    protected $guard_name = 'web';
    
    protected $fillable = [
        'name', 
        'email', 
        'username', 
        'password',
        'terms'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function newFactory()
    {
        //return \Modules\Admin\Database\factories\UsersFactory::new();
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
