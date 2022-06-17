<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//spatie
use Spatie\Permission\Traits\HasRoles;

class SuperUser extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;  //importante adicionar HasRoles

    protected $guard_name = 'admin';
    protected $table = 'super_users';

    protected $fillable = [
        'email', 
        'name',
        'username', 
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    
}
