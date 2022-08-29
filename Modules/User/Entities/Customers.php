<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'access_key',
        'puid',
        'total_machines',
        'pool',
        'userIdPool',
        'apiKey',
        'secretKey',
        'idReference'
    ];
    
    protected static function newFactory()
    {
        //return \Modules\User\Database\factories\CustomersFactory::new();
    }
}
