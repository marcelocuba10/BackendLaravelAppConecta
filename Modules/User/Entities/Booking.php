<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'ground_id',
        'user_id',
        'appointment',
        'total'
    ];
    
    protected static function newFactory()
    {
        //return \Modules\User\Database\factories\BookingFactory::new();
    }
}
