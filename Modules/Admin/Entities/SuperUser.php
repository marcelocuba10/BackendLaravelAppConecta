<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//add
use Illuminate\Support\Facades\Hash;

//spatie
use Spatie\Permission\Traits\HasRoles;

class SuperUser extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;  //importante adicionar HasRoles

    protected $guard_name = 'admin';

    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'address',
        'email',
        'ci',
        'password',

        'company_name',
        'manager',
        'ruc',
        'location_iframe',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    protected static function newFactory()
    {
        //return \Modules\Admin\Database\factories\SuperUserFactory::new();
    }
}
