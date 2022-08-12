<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

//spatie
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{

    use HasFactory, Notifiable, HasRoles, HasApiTokens;  //importante adicionar HasRoles

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'idMaster',
        'idReference',
        'last_name',
        'phone',
        'address',
        'email',
        'ci',
        'password',
        'exp_date_plan',
        'plan_id',
        'terms',
        'company_name',
        'manager',
        'ruc',
        'location_iframe',
    ];

    public function grounds()
    {
        return $this->hasMany(Ground::class);
    }

    public function reports()
    {
        return $this->hasMany(Reports::class);
    }

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
        return '\Modules\User\Database\factories\UserFactory'::new();
    }
}
