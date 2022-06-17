<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'address',
        'customer'
    ];
    
    protected static function newFactory()
    {
        //return \Modules\User\Database\factories\OrderFactory::new();
    }
}
