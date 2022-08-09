<?php

namespace Modules\Admin\Entities;

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
        'total_machines'
    ];
    
    protected static function newFactory()
    {
        //return \Modules\Admin\Database\factories\CustomersFactory::new();
    }
}
