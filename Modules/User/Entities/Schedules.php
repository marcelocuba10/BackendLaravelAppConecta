<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedules extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'check_in_time',
        'check_out_time',
        'address_latitude_in',
        'address_longitude_in',
        'address_latitude_out',
        'address_longitude_out'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\SchedulesFactory::new();
    }
}
